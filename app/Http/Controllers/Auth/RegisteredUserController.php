<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Tampilkan form register + captcha acak
     */
    public function create(Request $request): View
    {
        $a = rand(1, 9);
        $b = rand(1, 9);

        $operators = ['+', '-', 'x'];
        $operator = $operators[array_rand($operators)];

        // Hitung hasil captcha
        switch ($operator) {
            case '+':
                $result = $a + $b;
                break;

            case '-':
                // Supaya hasil tidak negatif
                if ($a < $b) {
                    [$a, $b] = [$b, $a];
                }
                $result = $a - $b;
                break;

            case 'x':
                $result = $a * $b;
                break;

            default:
                $result = $a + $b;
                break;
        }

        // Simpan hasil captcha ke session
        $request->session()->put('captcha_result', $result);

        return view('auth.register', [
            'captcha_question' => "{$a} {$operator} {$b} = ?",
        ]);
    }

    /**
     * Proses submit register
     */
    public function store(Request $request): RedirectResponse
    {
        // 1) Normalisasi input whatsapp:
        $whatsapp = preg_replace('/[^0-9]/', '', (string) $request->input('whatsapp', ''));

        if ($whatsapp !== '' && str_starts_with($whatsapp, '0')) {
            $whatsapp = '62' . substr($whatsapp, 1);
        }

        // 2) Validasi form
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'whatsapp'  => ['required'],
            'nama_tele' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z0-9_]+$/', 'unique:users,nama_tele'],
            // Hapus validasi email karena akan di-generate otomatis
            'password'  => ['required', 'confirmed', 'min:8'],
            'captcha'   => ['required', 'numeric'],
        ], [
            'whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'nama_tele.required' => 'Username Telegram wajib diisi.',
            'nama_tele.regex' => 'Username hanya boleh berisi huruf, angka, dan underscore (_).',
            'nama_tele.unique' => 'Username Telegram sudah terdaftar.',
        ]);

        // Validasi whatsapp final
        if (!preg_match('/^62[0-9]{9,13}$/', $whatsapp)) {
            return back()
                ->withErrors(['whatsapp' => 'Nomor WhatsApp harus angka dan format Indonesia (08xxx / 62xxx).'])
                ->withInput();
        }

        // Cek unique whatsapp manual
        $exists = User::where('whatsapp', $whatsapp)->exists();
        if ($exists) {
            return back()
                ->withErrors(['whatsapp' => 'Nomor WhatsApp sudah terdaftar.'])
                ->withInput();
        }

        // 3) Validasi captcha manual
        if ((int) $request->captcha !== (int) session('captcha_result')) {
            return back()
                ->withErrors(['captcha' => 'Jawaban captcha salah.'])
                ->withInput();
        }

        // Hapus captcha dari session
        $request->session()->forget('captcha_result');

        // 4) Generate email otomatis berdasarkan nama_tele
        $email = $request->nama_tele . '@telegram.com';
        
        // 5) Buat user
        $user = User::create([
            'name'      => $request->name,
            'whatsapp'  => $whatsapp,
            'nama_tele' => $request->nama_tele,
            'email'     => $email, // Email di-generate otomatis
            'password'  => $request->password,
            'role'      => 'guest',
        ]);

        // ============================
        // ✅ KIRIM NOTIFIKASI KE TELEGRAM
        // ============================
        $this->sendRegistrationNotification($user, $request->ip());

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('guest.home');
    }

    /**
     * Kirim notifikasi registrasi ke Telegram
     */
    private function sendRegistrationNotification(User $user, string $ip): void
    {
        try {
            $token = config('services.telegram.bot_token');
            $chatId = config('services.telegram.gc_daftar');
            
            if (empty($token) || empty($chatId)) {
                Log::warning('Telegram token atau chat_id daftar kosong');
                return;
            }
            
            $memberCount = User::count();
            $memberPosition = $memberCount;
            $waktu = now()->format('d/m/Y : H.i') . ' WIB';
            
            $displayWhatsapp = $user->whatsapp;
            if (str_starts_with($displayWhatsapp, '62')) {
                $displayWhatsapp = '0' . substr($displayWhatsapp, 2);
            }
            
            // Update pesan untuk menampilkan nama_tele dan email yang di-generate
            $message =
"✅ *REGISTRASI BERHASIL*\n" .
"━━━━━━━━━━━━━━━━━━━━━━\n" .
"🔐 *Informasi Akun*\n" .
"📍 IP Address : `{$ip}`\n" .
"👤 Nama        : {$user->name}\n" .
"📧 Email       : {$user->email}\n" .
"🔗 Username TG : @{$user->nama_tele}\n" .
"📱 WhatsApp    : {$displayWhatsapp}\n" .
"⏰ Waktu Daftar : {$waktu}\n" .
"👥 Member Ke   : {$memberPosition}\n" .
"━━━━━━━━━━━━━━━━━━━━━━\n" .
"🎉 *Selamat bergabung!*\n" .
"Terima kasih telah mendaftar di *STORE INI*.\n" .
"Semoga layanan kami bermanfaat 🙌";
            
            // Kirim ke Telegram
            $response = Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'Markdown',
                'disable_web_page_preview' => true,
            ]);
            
            if (!$response->ok()) {
                Log::error('Gagal kirim notifikasi registrasi ke Telegram', [
                    'response' => $response->body(),
                    'user_id' => $user->id
                ]);
            }
            
        } catch (\Throwable $e) {
            Log::error('Error saat mengirim notifikasi registrasi: ' . $e->getMessage());
        }
    }
}