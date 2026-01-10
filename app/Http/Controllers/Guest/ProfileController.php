<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    // VIEW PROFILE
    public function index()
    {
        $user = Auth::user();
        return view('guest.profile', compact('user'));
    }

    // UPDATE DATA PROFIL — NAMA, EMAIL, WHATSAPP, NAMA_TELE
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name'      => 'required|string|max:50',
            'nama_tele' => 'required|string|max:50|regex:/^[a-zA-Z0-9_]+$/|unique:users,nama_tele,' . $user->id,
            'whatsapp'  => 'required|string|max:20'
        ]);

        // Update data user
        $user->update([
            'name'      => $request->name,
            'nama_tele' => $request->nama_tele,
            'whatsapp'  => $request->whatsapp,
        ]);

        // Email akan otomatis di-update melalui boot method di model User
        // karena sudah ada observer untuk update email ketika nama_tele berubah

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // UPDATE PASSWORD (tetap sama)
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Password lama salah!');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui!');
    }

    // UPDATE FOTO (tetap sama)
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048|mimes:jpg,jpeg,png,webp'
        ]);

        $user = Auth::user();

        // Hapus foto lama jika ada
        if ($user->profile_photo && Storage::disk('public')->exists('profile/'.$user->profile_photo)) {
            Storage::disk('public')->delete('profile/'.$user->profile_photo);
        }

        // Simpan baru
        $filename = time().'.'.$request->photo->getClientOriginalExtension();
        $request->photo->storeAs('profile', $filename, 'public');

        $user->profile_photo = $filename;
        $user->save();

        return back()->with('success', 'Foto profil berhasil diganti!');
    }
}