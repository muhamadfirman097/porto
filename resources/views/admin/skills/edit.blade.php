<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Skill') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl">
                
                <div class="p-6 bg-indigo-600 border-b border-indigo-500 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white">Edit: {{ $skill->name }}</h3>
                    <a href="{{ route('skills.index') }}" class="text-indigo-200 hover:text-white text-sm">
                        &larr; Kembali
                    </a>
                </div>

                <div class="p-8 bg-white">
                    <form action="{{ route('skills.update', $skill->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Skill</label>
                            <input type="text" name="name" value="{{ old('name', $skill->name) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Persentase (%)</label>
                            <div class="flex items-center gap-4">
                                <input type="number" name="percentage" value="{{ old('percentage', $skill->percentage) }}" min="1" max="100" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <span class="text-gray-500 font-bold">%</span>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Logo / Icon</label>
                            
                            @if($skill->image)
                                <div class="mb-3 flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200 w-fit">
                                    <img src="{{ asset('storage/' . $skill->image) }}" class="h-10 w-10 object-contain">
                                    <span class="text-xs text-gray-500">Logo Saat Ini</span>
                                </div>
                            @endif

                            <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                            <p class="text-xs text-gray-400 mt-2">Biarkan kosong jika tidak ingin mengganti logo.</p>
                        </div>

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('skills.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition">Batal</a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 shadow-lg transition transform hover:-translate-y-0.5">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>