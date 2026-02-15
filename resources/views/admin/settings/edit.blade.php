<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Website') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r shadow-sm flex items-center">
                    <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span class="text-green-800 font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r shadow-sm">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-red-800 font-bold text-sm">Ada kesalahan input:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs text-red-700 ml-7">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-8">
                        
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                                <h3 class="text-lg font-bold text-gray-900">Identitas & Hero Section</h3>
                            </div>
                            <div class="p-6 space-y-6">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Website / Brand</label>
                                    <input type="text" name="site_name" value="{{ old('site_name', $setting->site_name) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Judul Besar (Headline)</label>
                                    <input type="text" name="hero_title" value="{{ old('hero_title', $setting->hero_title) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Singkat</label>
                                    <textarea name="hero_description" rows="4" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('hero_description', $setting->hero_description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                                <h3 class="text-lg font-bold text-gray-900">Kontak & Sosial Media</h3>
                            </div>
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-2">Email Kontak</label>
                                        <input type="email" name="contact_email" value="{{ old('contact_email', $setting->contact_email) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-2">No. WhatsApp (Admin)</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 font-bold text-sm">+62</span>
                                            </div>
                                            <input type="number" name="contact_whatsapp" value="{{ old('contact_whatsapp', $setting->contact_whatsapp) }}" class="pl-10 w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="812345xxx">
                                        </div>
                                        <p class="text-xs text-gray-400 mt-1">Nomor untuk tombol "Chat WA" di footer.</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-2">Username Instagram</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 text-sm">@</span>
                                            </div>
                                            <input type="text" name="contact_instagram" value="{{ old('contact_instagram', $setting->contact_instagram) }}" class="pl-8 w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="username_kamu">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-2">Link Github</label>
                                        <input type="url" name="contact_github" value="{{ old('contact_github', $setting->contact_github) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="https://github.com/...">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Teks Footer</label>
                                    <input type="text" name="footer_text" value="{{ old('footer_text', $setting->footer_text) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                            </div>
                        </div>

                        <div class="sticky top-4">
                            <button type="submit" class="w-full bg-gray-900 hover:bg-gray-800 text-white font-bold py-4 px-6 rounded-2xl shadow-lg transition transform hover:-translate-y-1 flex justify-center items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                                Simpan Perubahan
                            </button>
                        </div>

                    </div> 
                    
                    <div class="lg:col-span-1 space-y-8">
                        
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                                <h3 class="text-lg font-bold text-gray-900">Media & Dokumen</h3>
                            </div>
                            
                            <div class="p-6 text-center">
                                <div class="relative w-32 h-32 mx-auto mb-4">
                                    @if($setting->profile_image)
                                        {{-- PERBAIKAN DI SINI: Support ImgBB (http) dan Local Storage --}}
                                        <img src="{{ \Illuminate\Support\Str::startsWith($setting->profile_image, 'http') ? $setting->profile_image : asset('storage/' . $setting->profile_image) }}" 
                                             class="w-full h-full rounded-full object-cover border-4 border-white shadow-lg">
                                    @else
                                        <div class="w-full h-full rounded-full bg-indigo-100 flex items-center justify-center text-indigo-500 text-3xl font-bold border-4 border-white shadow-lg">
                                            {{ substr($setting->site_name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <input type="file" name="profile_image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 mb-2"/>
                                <p class="text-[10px] text-gray-400 mb-6">Format: JPG/PNG (Max 2MB)</p>

                                <div class="mt-8 border-t border-gray-100 pt-6">
                                    <h4 class="text-sm font-bold text-gray-900 mb-3 flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        Upload CV / Resume
                                    </h4>
                                    
                                    @if($setting->cv_file)
                                        <div class="mb-4 flex items-center justify-between p-3 bg-green-50 rounded-lg border border-green-100">
                                            <span class="text-xs font-semibold text-green-700">CV Aktif</span>
                                            {{-- CV TETAP MENGGUNAKAN LOCAL STORAGE (KARENA PDF) --}}
                                            <a href="{{ asset('storage/' . $setting->cv_file) }}" target="_blank" class="text-xs text-indigo-600 hover:underline font-bold">Lihat File</a>
                                        </div>
                                    @endif
                                    
                                    <input type="file" name="cv_file" accept=".pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer"/>
                                    <p class="text-[10px] text-gray-400 mt-2">Format: PDF (Max 5MB)</p>
                                </div>

                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                                <h3 class="text-lg font-bold text-gray-900">Tema Web</h3>
                            </div>
                            <div class="p-6 space-y-6">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Warna Utama</label>
                                    <div class="flex items-center space-x-3">
                                        <input type="color" name="primary_color" value="{{ old('primary_color', $setting->primary_color) }}" class="h-10 w-16 p-1 rounded border cursor-pointer">
                                        <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ $setting->primary_color }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Jenis Font</label>
                                    <select name="font_family" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="sans" {{ old('font_family', $setting->font_family) == 'sans' ? 'selected' : '' }}>Sans Serif</option>
                                        <option value="serif" {{ old('font_family', $setting->font_family) == 'serif' ? 'selected' : '' }}>Serif</option>
                                        <option value="mono" {{ old('font_family', $setting->font_family) == 'mono' ? 'selected' : '' }}>Monospace</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div> 
                </div>
            </form>
        </div>
    </div>
</x-app-layout>