<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('mitra.rooms.index') }}" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Kembali ke Daftar Kamar
                        </a>
                    </div>

                    <h1 class="text-2xl font-bold mb-6">Edit Kamar</h1>

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('mitra.rooms.update', $room) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="kost_id" class="block text-sm font-medium text-gray-700 mb-2">Kost</label>
                            <select name="kost_id" id="kost_id" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach($kosts as $kost)
                                    <option value="{{ $kost->id }}" {{ $room->kost_id == $kost->id ? 'selected' : '' }}>
                                        {{ $kost->name }} - {{ $kost->city }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="room_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Kamar</label>
                            <input type="text" name="room_number" id="room_number" required
                                   value="{{ old('room_number', $room->room_number) }}"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                   placeholder="Contoh: 101, A1, etc">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="description" id="description" rows="4" required
                                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                      placeholder="Deskripsi kamar...">{{ old('description', $room->description) }}</textarea>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga per Bulan (Rp)</label>
                            <input type="number" name="price" id="price" required min="0"
                                   value="{{ old('price', $room->price) }}"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                   placeholder="Contoh: 1500000">
                        </div>

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('mitra.rooms.index') }}"
                               class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
