<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Wajib di-import

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->name = $request->name;

        if ($request->hasFile('profile_photo')) {
            // 1. Hapus foto lama di storage jika sebelumnya sudah ada
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            
            $file = $request->file('profile_photo');
            
            // 2. Buat nama file unik memakai ID user agar tidak tertukar dengan orang lain
            $filename = $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // 3. Simpan ke dalam folder 'avatars' di dalam disk 'public' privat
            $path = $file->storeAs('avatars', $filename, 'public');
            
            // 4. Masukkan path (contoh: 'avatars/1_171892.jpg') ke properti user
            $user->profile_photo = $path;
        }

        // 5. Simpan perubahan ke database & sinkronkan session login
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}