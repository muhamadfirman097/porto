<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                
                <div class="p-6 bg-white border-b border-gray-100 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Edit Data Project</h3>
                        <p class="text-sm text-gray-500">Perbarui informasi portfolio Anda.</p>
                    </div>
                    <a href="{{ route('projects.index') }}" class="text-gray-500 hover:text-indigo-600 font-medium text-sm flex items-center transition">
                        &larr; Kembali
                    </a>
                </div>

                <div class="p-8">
                    <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            <!-- Kolom Kiri: Informasi Teks -->
                            <div class="space-y-6">
                                
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Judul Project</label>
                                    <input type="text" 
                                           name="title" 
                                           value="{{ old('title', $project->title) }}" 
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition" 
                                           required>
                                    @error('title')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Tech Stack</label>
                                    <input type="text" 
                                           name="tech_stack" 
                                           value="{{ old('tech_stack', $project->tech_stack) }}" 
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition" 
                                           placeholder="Laravel, React, MySQL">
                                    <p class="text-xs text-gray-400 mt-1">Pisahkan dengan koma.</p>
                                    @error('tech_stack')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Link Live Demo (Website)</label>
                                    <div class="flex rounded-xl shadow-sm">
                                        <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </span>
                                        <input type="url" 
                                               name="demo_url" 
                                               value="{{ old('demo_url', $project->demo_url) }}" 
                                               class="flex-1 rounded-r-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition" 
                                               placeholder="https://website-kamu.com">
                                    </div>
                                    @error('demo_url')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Link Repository (GitHub)</label>
                                    <div class="flex rounded-xl shadow-sm">
                                        <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                        </span>
                                        <input type="url" 
                                               name="source_url" 
                                               value="{{ old('source_url', $project->source_url) }}" 
                                               class="flex-1 rounded-r-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition" 
                                               placeholder="https://github.com/username/repo">
                                    </div>
                                    @error('source_url')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Detail</label>
                                    <textarea name="description" 
                                              rows="5" 
                                              class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition" 
                                              required>{{ old('description', $project->description) }}</textarea>
                                    @error('description')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>

                            <!-- Kolom Kanan: Upload Gambar -->
                            <div class="space-y-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Thumbnail Project</label>
                                
                                <div class="bg-gray-50 p-6 rounded-2xl border-2 border-dashed border-gray-300 text-center hover:border-indigo-500 transition group relative">
                                    
                                    <!-- Logika Tampilan Gambar (ImgBB vs Storage Lokal) -->
                                    <div class="mb-4 relative overflow-hidden rounded-lg shadow-md border-4 border-white">
                                        @if($project->image)
                                            <!-- PENTING: Cek apakah link ImgBB atau path lokal -->
                                            <img id="current-image" 
                                                 src="{{ str_contains($project->image, 'http') ? $project->image : asset('storage/' . $project->image) }}" 
                                                 class="w-full h-56 object-cover bg-white">
                                        @else
                                            <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-400">
                                                No Image
                                            </div>
                                        @endif
                                        
                                        <!-- Image Preview Container (Hidden by default) -->
                                        <img id="image-preview" class="hidden absolute inset-0 w-full h-full object-cover z-20">
                                    </div>

                                    <div class="relative z-10">
                                        <label for="image-upload" class="cursor-pointer inline-flex items-center px-5 py-2.5 bg-white border border-gray-300 rounded-xl font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-300 focus:outline-none transition ease-in-out duration-150">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                            Ganti Gambar
                                        </label>
                                        <input type="file" name="image" id="image-upload" class="hidden" accept="image/*" onchange="previewImage(event)">
                                        <p class="text-xs text-gray-400 mt-3">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                                        <p id="file-name" class="text-xs text-indigo-500 font-medium mt-1 hidden"></p>
                                    </div>
                                </div>
                                @error('image')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
                            <a href="{{ route('projects.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition text-sm">
                                Batal
                            </a>
                            <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition transform hover:-translate-y-1 text-sm">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const file = event.target.files[0];
            
            if (file) {
                reader.onload = function(){
                    const output = document.getElementById('image-preview');
                    output.src = reader.result;
                    output.classList.remove('hidden'); // Tampilkan preview menimpa gambar lama
                    
                    // Tampilkan nama file
                    const fileName = document.getElementById('file-name');
                    fileName.textContent = 'File terpilih: ' + file.name;
                    fileName.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
