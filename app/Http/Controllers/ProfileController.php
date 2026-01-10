<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function index()
    {
        $user = Auth::user();
        
        return view('profile', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        // Validasi untuk username (nama_tele) berdasarkan role
        if ($user->isDirty('nama_tele') || $request->nama_tele != $user->nama_tele) {
            if (!$user->canChangeUsername()) {
                $nextDate = $user->getNextUsernameChangeDate();
                $daysLeft = now()->diffInDays($nextDate, false);
                
                if ($daysLeft > 0) {
                    return back()->with('error', 
                        'Anda hanya bisa mengganti username setiap ' . 
                        ($user->role === 'reseller' ? '7' : '14') . 
                        ' hari sekali. Anda bisa ganti lagi dalam ' . 
                        $user->getRemainingTimeForChange('username')
                    );
                }
            }
        }
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nama_tele' => 'required|string|max:255|unique:users,nama_tele,' . $user->id,
            'whatsapp' => 'required|string|max:20',
        ], [
            'nama_tele.unique' => 'Username Telegram sudah digunakan.',
            'whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        // Simpan perubahan
        $user->name = $request->name;
        $user->whatsapp = $request->whatsapp;
        
        // Update nama_tele jika berubah
        if ($user->nama_tele != $request->nama_tele) {
            $user->nama_tele = $request->nama_tele;
            // Email akan otomatis diupdate oleh boot method
        }
        
        $user->save();
        
        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        
        // Cek apakah bisa ganti password berdasarkan role
        if (!$user->canChangePassword()) {
            $nextDate = $user->getNextPasswordChangeDate();
            $daysLeft = now()->diffInDays($nextDate, false);
            
            if ($daysLeft > 0) {
                return back()->with('error', 
                    'Anda hanya bisa mengganti password setiap ' . 
                    ($user->role === 'reseller' ? '7' : '14') . 
                    ' hari sekali. Anda bisa ganti lagi dalam ' . 
                    $user->getRemainingTimeForChange('password')
                );
            }
        }
        
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'old_password.required' => 'Password lama wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        // Verifikasi password lama
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Password lama salah.');
        }
        
        // Update password
        $user->password = Hash::make($request->new_password);
        $user->last_password_change = now(); // Update timestamp perubahan password
        $user->save();
        
        return back()->with('success', 'Password berhasil diubah!');
    }

    /**
     * Update the user's profile photo.
     */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $user = Auth::user();
        
        // Hapus foto lama jika ada
        if ($user->profile_photo) {
            Storage::delete('public/profile/' . $user->profile_photo);
        }
        
        // Simpan foto baru
        $fileName = time() . '_' . $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('public/profile', $fileName);
        
        $user->profile_photo = $fileName;
        $user->save();
        
        return back()->with('success', 'Foto profil berhasil diubah!');
    }
}