<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan form login + captcha acak
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
                // Supaya tidak negatif
                if ($a < $b) {
                    [$a, $b] = [$b, $a];
                }
                $result = $a - $b;
                break;

            case 'x':
                $result = $a * $b;
                break;
        }

        // Simpan hasil captcha ke session
        $request->session()->put('captcha_result', $result);

        return view('auth.login', [
            'captcha_question' => "{$a} {$operator} {$b} = ?",
        ]);
    }

    /**
     * Proses submit login
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'login'    => ['required', 'string'],
            'password' => ['required', 'string'],
            'captcha'  => ['required', 'numeric'],
        ]);

        // Cek captcha
        if ((int) $request->captcha !== (int) session('captcha_result')) {
            return back()
                ->withErrors(['captcha' => 'Jawaban captcha salah.'])
                ->withInput();
        }

        // Hapus captcha (sekali pakai)
        $request->session()->forget('captcha_result');

        $login = $request->login;
        $password = $request->password;

        // Tentukan field login berdasarkan input
        $field = $this->determineLoginField($login);

        // Coba login dengan field yang sudah ditentukan
        $credentials = [$field => $login, 'password' => $password];

        // Jika field adalah 'nama_tele', tambahkan juga pengecekan dengan email
        // yang di-generate dari nama_tele
        if ($field === 'nama_tele') {
            // Coba login dengan nama_tele
            if (Auth::attempt($credentials, $request->boolean('remember'))) {
                $request->session()->regenerate();
                return $this->redirectBasedOnRole();
            }
            
            // Jika gagal dengan nama_tele, coba dengan email yang di-generate
            $generatedEmail = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $login)) . '@ayastore.com';
            if (Auth::attempt(['email' => $generatedEmail, 'password' => $password], $request->boolean('remember'))) {
                $request->session()->regenerate();
                return $this->redirectBasedOnRole();
            }
        } else {
            // Untuk email atau whatsapp, langsung attempt
            if (Auth::attempt($credentials, $request->boolean('remember'))) {
                $request->session()->regenerate();
                return $this->redirectBasedOnRole();
            }
        }

        // Jika semua gagal, coba dengan whatsapp (untuk format 0xxx)
        if (preg_match('/^0[0-9]{9,12}$/', $login)) {
            $whatsapp = '62' . substr($login, 1);
            if (Auth::attempt(['whatsapp' => $whatsapp, 'password' => $password], $request->boolean('remember'))) {
                $request->session()->regenerate();
                return $this->redirectBasedOnRole();
            }
        }

        // Cek juga dengan format 62xxxx
        if (preg_match('/^62[0-9]{9,12}$/', $login)) {
            if (Auth::attempt(['whatsapp' => $login, 'password' => $password], $request->boolean('remember'))) {
                $request->session()->regenerate();
                return $this->redirectBasedOnRole();
            }
        }

        return back()
            ->withErrors(['login' => 'Email / Username / WhatsApp atau password salah.'])
            ->withInput();
    }

    /**
     * Tentukan field login berdasarkan input
     */
    private function determineLoginField(string $login): string
    {
        // Jika mengandung @, itu email
        if (strpos($login, '@') !== false) {
            return 'email';
        }
        
        // Jika hanya angka, kemungkinan whatsapp
        if (preg_match('/^[0-9]+$/', $login)) {
            return 'whatsapp';
        }
        
        // Jika tidak mengandung @ dan tidak semua angka, itu nama_tele
        return 'nama_tele';
    }

    /**
     * Redirect berdasarkan role user
     */
    private function redirectBasedOnRole(): RedirectResponse
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('guest.home');
    }

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}