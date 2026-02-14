<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Project Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-8 text-gray-900">
                    
                    <!-- PENTING: enctype="multipart/form-data" wajib ada untuk upload file -->
                    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <!-- Nama Project -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Project</label>
                            <input type="text" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition" 
                                   placeholder="Contoh: Website E-Commerce Toko Baju" required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Project</label>
                            <textarea name="description" 
                                      rows="4" 
                                      class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition"
                                      placeholder="Jelaskan fitur utama dan tujuan project ini..." required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tech Stack -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tech Stack (Pisahkan dengan koma)</label>
                            <input type="text" 
                                   name="tech_stack" 
                                   value="{{ old('tech_stack') }}"
                                   class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition" 
                                   placeholder="Contoh: Laravel, Tailwind, MySQL, React">
                            @error('tech_stack')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Link Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Link Demo (Opsional)</label>
                                <input type="url" 
                                       name="demo_url" 
                                       value="{{ old('demo_url') }}"
                                       class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition"
                                       placeholder="https://namaproject.vercel.app">
                                @error('demo_url')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Link Source Code (GitHub)</label>
                                <input type="url" 
                                       name="source_url" 
                                       value="{{ old('source_url') }}"
                                       class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition"
                                       placeholder="https://github.com/username/repo">
                                @error('source_url')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Upload Gambar + Preview -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Gambar Project (Cover)</label>
                            <div class="mt-1 flex flex-col items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-2xl hover:border-indigo-500 transition bg-gray-50 relative overflow-hidden group">
                                
                                <!-- Area Preview Gambar -->
                                <div id="preview-container" class="hidden mb-4 relative z-10">
                                    <img id="image-preview" src="#" alt="Preview" class="max-h-48 rounded-lg shadow-md border-4 border-white">
                                    <button type="button" id="remove-preview" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 shadow-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>

                                <div id="upload-placeholder" class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-indigo-500 transition" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="image-upload" class="relative cursor-pointer bg-white rounded-md font-bold text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                            <span>Klik untuk upload gambar</span>
                                            <input id="image-upload" name="image" type="file" class="sr-only" accept="image/*" required>
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">Gambar akan otomatis disimpan ke ImgBB</p>
                                </div>
                            </div>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('projects.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition text-sm font-bold">
                                Batal
                            </a>
                            <button type="submit" class="px-8 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition text-sm font-bold shadow-lg shadow-indigo-200">
                                Simpan Project 🚀
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Preview Gambar -->
    <script>
        const imageUpload = document.getElementById('image-upload');
        const imagePreview = document.getElementById('image-preview');
        const previewContainer = document.getElementById('preview-container');
        const uploadPlaceholder = document.getElementById('upload-placeholder');
        const removePreview = document.getElementById('remove-preview');

        imageUpload.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.setAttribute('src', e.target.result);
                    previewContainer.classList.remove('hidden');
                    uploadPlaceholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        removePreview.addEventListener('click', function() {
            imageUpload.value = '';
            previewContainer.classList.add('hidden');
            uploadPlaceholder.classList.remove('hidden');
        });
    </script>
</x-app-layout>
