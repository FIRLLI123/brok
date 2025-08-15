<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ulasan Kost') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if($reviews->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500">Belum ada ulasan untuk kost Anda.</p>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($reviews as $review)
                                <div class="border rounded-lg p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center">
                                            <span class="font-semibold text-lg">{{ $review->user->name }}</span>
                                            <div class="flex items-center ml-3">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <span class="text-yellow-400 {{ $i <= $review->rating ? '' : 'text-gray-300' }}">
                                                        ★
                                                    </span>
                                                @endfor
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-500">
                                            {{ $review->created_at->format('d M Y H:i') }}
                                        </span>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <p class="text-gray-700">{{ $review->comment }}</p>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <span class="text-sm text-gray-500">
                                            Kost: {{ $review->kost->name }} | 
                                            Kamar: {{ $review->booking->room->room_number }}
                                        </span>
                                    </div>

                                    <!-- Review Replies -->
                                    @if($review->replies->isNotEmpty())
                                        <div class="ml-6 border-l-2 border-gray-200 pl-4 mb-4">
                                            @foreach($review->replies as $reply)
                                                <div class="mb-3">
                                                    <div class="flex items-center justify-between">
                                                        <span class="font-semibold text-sm text-indigo-600">{{ $reply->user->name }} (Anda)</span>
                                                        <span class="text-xs text-gray-500">
                                                            {{ $reply->created_at->format('d M Y H:i') }}
                                                        </span>
                                                    </div>
                                                    <p class="text-sm text-gray-600 mt-1">{{ $reply->reply }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- Reply Form -->
                                    @if($review->replies->where('user_id', auth()->id())->isEmpty())
                                        <form action="{{ route('mitra.reviews.reply', $review) }}" method="POST" class="mt-4">
                                            @csrf
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-1">
                                                    <label for="reply-{{ $review->id }}" class="block text-sm font-medium text-gray-700 mb-1">
                                                        Balas Ulasan
                                                    </label>
                                                    <textarea name="reply" id="reply-{{ $review->id }}" rows="2" 
                                                              class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                              placeholder="Tulis balasan Anda..." required></textarea>
                                                </div>
                                                <button type="submit"
                                                    style="background: linear-gradient(90deg, #ff5858 0%, #f857a6 100%); color: #fff; border: none; border-radius: 5px; padding: 6px 20px; font-size: 1rem; font-weight: 600; box-shadow: 0 1.5px 6px 0 rgba(248,87,166,0.10); margin-top: 8px; margin-left: 12px; transition: transform 0.13s, box-shadow 0.13s; letter-spacing: 0.2px; cursor: pointer; outline: none;"
                                                    onmouseover="this.style.transform='translateY(-1px) scale(1.03)';this.style.boxShadow='0 4px 12px 0 rgba(248,87,166,0.16)';"
                                                    onmouseout="this.style.transform='none';this.style.boxShadow='0 1.5px 6px 0 rgba(248,87,166,0.10)';">
                                                    Balas
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <div class="mt-4">
                                            <span class="text-sm text-green-600">✓ Anda sudah membalas ulasan ini</span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $reviews->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 