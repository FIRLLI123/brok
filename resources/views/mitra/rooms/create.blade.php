<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Tambah Kamar Baru</h2>
                    <a href="{{ route('mitra.rooms.index') }}" 
                       class="text-indigo-600 hover:text-indigo-900">
                        &larr; Kembali ke Daftar Kamar
                    </a>
                </div>

                <form action="{{ route('mitra.rooms.store') }}" method="POST">
                    @csrf

                    {{-- Pilih Kost --}}
                    <div class="mb-4">
                        <label class="block mb-1 font-medium text-gray-700">
                            Pilih Kost <span class="text-red-500">*</span>
                        </label>
                        <select name="kost_id" 
                                class="w-full border rounded px-3 py-2 @error('kost_id') border-red-500 @enderror"
                                required>
                            <option value="">-- Pilih Kost --</option>
                            @forelse($kosts as $kost)
                                <option value="{{ $kost->id }}" {{ (old('kost_id', request('kost_id')) == $kost->id) ? 'selected' : '' }}>
                                    {{ $kost->name }} ({{ $kost->city }})
                                </option>
                            @empty
                                <option value="" disabled>Anda belum memiliki kost</option>
                            @endforelse
                        </select>
                        @error('kost_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nomor Kamar --}}
                    <div class="mb-4">
                        <label class="block mb-1 font-medium text-gray-700">
                            Nomor Kamar <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="room_number" 
                               value="{{ old('room_number') }}"
                               class="w-full border rounded px-3 py-2 @error('room_number') border-red-500 @enderror"
                               placeholder="Contoh: A1, B2, 101"
                               required>
                        @error('room_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-4">
                        <label class="block mb-1 font-medium text-gray-700">
                            Deskripsi Kamar <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" 
                                  rows="3"
                                  class="w-full border rounded px-3 py-2 @error('description') border-red-500 @enderror"
                                  placeholder="Deskripsikan fasilitas kamar..."
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    <div class="mb-4">
                        <label class="block mb-1 font-medium text-gray-700">
                            Harga per Bulan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500"></span>
                            <input type="number" 
                                   name="price" 
                                   value="{{ old('price') }}"
                                   class="w-full border rounded px-3 py-2 pl-10 @error('price') border-red-500 @enderror"
                                   placeholder="0"
                                   required
                                   min="0">
                        </div>
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="mt-8 flex justify-end gap-3">
                        <a href="{{ route('mitra.rooms.index') }}"
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Simpan Kamar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
