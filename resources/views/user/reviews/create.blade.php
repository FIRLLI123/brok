<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Ulasan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('user.bookings.index') }}" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Kembali ke Daftar Booking
                        </a>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Detail Booking</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p><strong>Kost:</strong> {{ $booking->room->kost->name }}</p>
                            <p><strong>Kamar:</strong> {{ $booking->room->room_number }}</p>
                            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</p>
                            <p><strong>Total Harga:</strong> Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <form action="{{ route('user.reviews.store', $booking) }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <div class="flex items-center space-x-4">
                                @for($i = 1; $i <= 5; $i++)
                                    <label class="flex items-center">
                                        <input type="radio" name="rating" value="{{ $i }}" 
                                               class="mr-2" {{ old('rating') == $i ? 'checked' : '' }} required>
                                        <span class="text-yellow-400">
                                            @for($j = 1; $j <= $i; $j++)
                                                ★
                                            @endfor
                                        </span>
                                    </label>
                                @endfor
                            </div>
                            @error('rating')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Ulasan</label>
                            <textarea name="comment" id="comment" rows="4" 
                                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                      placeholder="Bagikan pengalaman Anda selama menginap di kost ini..." required>{{ old('comment') }}</textarea>
                            @error('comment')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Kirim Ulasan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 