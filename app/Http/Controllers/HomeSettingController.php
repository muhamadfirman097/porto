<?php

namespace App\Http\Controllers;

use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSettingController extends Controller
{
    public function edit()
    {
        // Menyiapkan data default jika database kosong
        $setting = HomeSetting::firstOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Portofolio Saya',
                'hero_title' => 'Membangun Solusi Digital',
                'hero_description' => 'Web Developer spesialis Laravel dan Modern Web.',
                'primary_color' => '#4f46e5',
                'font_family' => 'sans',
                'contact_email' => 'email@contoh.com',
                'contact_instagram' => 'username', 
                'contact_whatsapp' => '628123456789',
                'contact_github' => 'https://github.com',
                'footer_text' => '© ' . date('Y') . ' Portofolio Saya. All rights reserved.'
            ]
        );

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = HomeSetting::first();

        // 1. Validasi Input (Termasuk validasi cv_file)
        $validated = $request->validate([
            'site_name' => 'required|string|max:50',
            'hero_title' => 'required|string|max:100',
            'hero_description' => 'nullable|string',
            'profile_image' => 'nullable|image|max:2048',
            'cv_file' => 'nullable|mimes:pdf|max:5120', // WAJIB PDF, Max 5MB
            'primary_color' => 'required|string',
            'font_family' => 'required|in:sans,serif,mono',
            
            // Validasi Kontak
            'contact_email' => 'nullable|email',
            'contact_instagram' => 'nullable|string|max:255', 
            'contact_whatsapp' => 'nullable|numeric', 
            'contact_github' => 'nullable|url',
            
            'footer_text' => 'required|string',
        ]);

        // 2. Upload Foto Profil (Jika ada)
        if ($request->hasFile('profile_image')) {
            // Hapus foto lama jika ada
            if ($setting->profile_image) {
                Storage::disk('public')->delete($setting->profile_image);
            }
            // Simpan foto baru
            $setting->profile_image = $request->file('profile_image')->store('profile', 'public');
        }

        // 3. Upload File CV (Jika ada file baru yang diupload)
        if ($request->hasFile('cv_file')) {
            // Hapus file CV lama agar storage tidak menumpuk
            if ($setting->cv_file) {
                Storage::disk('public')->delete($setting->cv_file);
            }
            // Simpan file CV baru ke folder storage/app/public/cv
            $setting->cv_file = $request->file('cv_file')->store('cv', 'public');
        }

        // 4. Simpan Data Teks ke Database
        $setting->site_name = $request->site_name;
        $setting->hero_title = $request->hero_title;
        $setting->hero_description = $request->hero_description;
        $setting->primary_color = $request->primary_color;
        $setting->font_family = $request->font_family;
        
        // Simpan Kontak
        $setting->contact_email = $request->contact_email;
        $setting->contact_instagram = $request->contact_instagram;
        $setting->contact_whatsapp = $request->contact_whatsapp; 
        $setting->contact_github = $request->contact_github;
        
        $setting->footer_text = $request->footer_text;
        
        $setting->save();

        return redirect()->back()->with('success', 'Pengaturan website berhasil diperbarui!');
    }
}