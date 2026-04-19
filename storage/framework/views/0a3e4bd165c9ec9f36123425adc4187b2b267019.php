<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="<?php echo e(route('user.kost.index')); ?>" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Kembali ke Daftar Kost
                        </a>
                    </div>

                    <!-- Kost Images -->
                    <div class="mb-8">
                        <?php if($kost->images->isNotEmpty()): ?>
                            <div class="relative w-full">
                                <div class="user-kost-swiper rounded-lg overflow-hidden shadow-lg border border-gray-200">
                                    <div class="swiper-wrapper">
                                        <?php $__currentLoopData = $kost->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="swiper-slide">
                                                <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>"
                                                     alt="<?php echo e($kost->name); ?>"
                                                     class="w-full h-full object-cover">
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <div class="user-kost-swiper-next swiper-button-next swiper-button-white"></div>
                                    <div class="user-kost-swiper-prev swiper-button-prev swiper-button-white"></div>
                                    <div class="user-kost-swiper-pagination"></div>
                                </div>
                            </div>
                            <div class="mt-3 flex items-center justify-between gap-3">
                                <p class="text-sm text-gray-600"><?php echo e($kost->images->count()); ?> gambar tersedia</p>
                                <button id="open-gallery-modal" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold text-sm hover:bg-indigo-700">
                                    Lihat Gambar
                                </button>
                            </div>

                            <div id="gallery-modal" class="fixed inset-0 z-50 hidden p-4 md:p-6 overflow-y-auto">
                                <div class="absolute inset-0 bg-black/70" id="gallery-backdrop"></div>
                                <div class="relative w-full max-w-2xl mx-auto mt-6 md:mt-10 bg-white rounded-lg shadow-xl p-4 md:p-5">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold">Galeri Gambar</h3>
                                        <button id="close-gallery-modal" type="button" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700">Tutup</button>
                                    </div>

                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 max-h-[55vh] overflow-y-auto pr-1">
                                        <?php $__currentLoopData = $kost->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e(asset('storage/' . $image->image_path)); ?>"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="block border border-gray-200 rounded-md overflow-hidden hover:border-indigo-500 transition">
                                                <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>"
                                                     alt="<?php echo e($kost->name); ?> thumbnail <?php echo e($index + 1); ?>"
                                                     class="w-full aspect-[4/3] object-cover">
                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                <span class="text-gray-400">No Images Available</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Kost Details -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="md:col-span-2">
                            <h1 class="text-3xl font-bold mb-4"><?php echo e($kost->name); ?></h1>
                            
                            <div class="mb-6">
                                <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
                                <p class="text-gray-600"><?php echo e($kost->description); ?></p>
                            </div>

                            <div class="mb-6">
                                <h2 class="text-xl font-semibold mb-2">Lokasi</h2>
                                <p class="text-gray-600"><?php echo e($kost->address); ?></p>
                                <p class="text-gray-600"><?php echo e($kost->city); ?></p>
                            </div>

                            <div class="mb-6">
                                <h2 class="text-xl font-semibold mb-2">Fasilitas</h2>
                                <ul class="list-disc list-inside text-gray-600">
                                    <li>Kamar Mandi Dalam</li>
                                    <li>Wifi</li>
                                    <li>Listrik</li>
                                    <li>Air</li>
                                    <li>Parkir</li>
                                </ul>
                            </div>

                            <!-- Reviews Section -->
                            <div class="mb-6">
                                <h2 class="text-xl font-semibold mb-4">Ulasan Pengguna</h2>
                                <?php if($kost->reviews->isNotEmpty()): ?>
                                    <div class="space-y-4">
                                        <?php $__currentLoopData = $kost->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="border rounded-lg p-4">
                                                <div class="flex items-center justify-between mb-2">
                                                    <div class="flex items-center">
                                                        <span class="font-semibold"><?php echo e($review->user->name); ?></span>
                                                        <div class="flex items-center ml-2">
                                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                                <span class="text-yellow-400 <?php echo e($i <= $review->rating ? '' : 'text-gray-300'); ?>">
                                                                    ★
                                                                </span>
                                                            <?php endfor; ?>
                                                        </div>
                                                    </div>
                                                    <span class="text-sm text-gray-500">
                                                        <?php echo e($review->created_at->format('d M Y')); ?>

                                                    </span>
                                                </div>
                                                <p class="text-gray-700 mb-3"><?php echo e($review->comment); ?></p>
                                                
                                                <!-- Review Replies -->
                                                <?php if($review->replies->isNotEmpty()): ?>
                                                    <div class="ml-6 border-l-2 border-gray-200 pl-4">
                                                        <?php $__currentLoopData = $review->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="mb-2">
                                                                <div class="flex items-center justify-between">
                                                                    <span class="font-semibold text-sm"><?php echo e($reply->user->name); ?> (Pemilik)</span>
                                                                    <span class="text-xs text-gray-500">
                                                                        <?php echo e($reply->created_at->format('d M Y')); ?>

                                                                    </span>
                                                                </div>
                                                                <p class="text-sm text-gray-600"><?php echo e($reply->reply); ?></p>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php else: ?>
                                    <p class="text-gray-500">Belum ada ulasan untuk kost ini.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="md:col-span-1">
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h2 class="text-2xl font-bold text-indigo-600 mb-4">
                                    Mulai Rp <?php echo e(number_format($kost->price, 0, ',', '.')); ?>/bulan
                                </h2>

                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold mb-2">Kamar Tersedia</h3>
                                    <?php if($kost->rooms->isNotEmpty()): ?>
                                        <div class="space-y-4">
                                            <?php $__currentLoopData = $kost->rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="border rounded-lg p-4 bg-white">
                                                    <div class="flex justify-between items-center mb-2">
                                                        <div class="flex items-center gap-2">
                                                            <span class="font-semibold">Kamar <?php echo e($room->room_number); ?></span>
                                                            <?php if($room->is_available == 1): ?>
                                                                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                                                    Tersedia
                                                                </span>
                                                            <?php elseif($room->is_available == 2): ?>
                                                                <span class="inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                                                                    Dipesan
                                                                </span>
                                                            <?php elseif($room->is_available == 3): ?>
                                                                <span class="inline-flex items-center px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                                                                    Terisi
                                                                </span>
                                                            <?php else: ?>
                                                                <span class="inline-flex items-center px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                                                                    Tidak Tersedia
                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <span class="text-indigo-600 font-bold">
                                                            Rp <?php echo e(number_format($room->price, 0, ',', '.')); ?>/bulan
                                                        </span>
                                                    </div>
                                                    <p class="text-sm text-gray-600 mb-4"><?php echo e($room->description); ?></p>
                                                    
                                                    <!-- Booking Form -->
                                                    <form action="<?php echo e(route('user.bookings.store')); ?>" method="POST" class="space-y-3">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="room_id" value="<?php echo e($room->id); ?>">
                                                        <input type="hidden" name="room_price" value="<?php echo e($room->price); ?>">
                                                        
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                                                            <input type="date" name="start_date" required
                                                                   min="<?php echo e(date('Y-m-d', strtotime('+1 day'))); ?>"
                                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                        </div>
                                                        
                                                        <div class="bg-blue-50 p-3 rounded">
                                                            <p class="text-sm text-blue-800">
                                                                <strong>Total Harga:</strong> 
                                                                <span id="total-price-<?php echo e($room->id); ?>" class="font-bold">
                                                                    Rp <?php echo e(number_format($room->price, 0, ',', '.')); ?>

                                                                </span>
                                                            </p>
                                                        </div>
                                                        
                                                        <?php if($kost->is_active == 1): ?>
                                                            <button type="submit" 
                                                                    class="w-full mt-4 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 font-semibold text-sm">
                                                                Booking Sekarang
                                                            </button>
                                                        <?php else: ?>
                                                            <div class="w-full mt-4 text-center">
                                                                <?php if($kost->is_active == 2): ?>
                                                                    <span class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                                                                        Sedang Dipesan
                                                                    </span>
                                                                <?php elseif($kost->is_active == 3): ?>
                                                                    <span class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                                                                        Sudah Terisi
                                                                    </span>
                                                                <?php else: ?>
                                                                    <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                                                                        Tidak Tersedia
                                                                    </span>
                                                                <?php endif; ?>
                                                                <p class="text-xs text-gray-500 mt-2">Booking tidak tersedia untuk kost ini</p>
                                                            </div>
                                                        <?php endif; ?>
                                                    </form>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php else: ?>
                                        <p class="text-gray-500">Tidak ada kamar yang tersedia</p>
                                    <?php endif; ?>
                                </div>

                                <div class="border-t pt-4">
                                    <h3 class="text-lg font-semibold mb-2">Kontak Pemilik</h3>
                                    <p class="text-gray-600"><?php echo e($kost->user->name); ?></p>
                                    <?php if($kost->user->phone): ?>
                                        <p class="text-gray-600"><?php echo e($kost->user->phone); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        function initializeKostImageSlider() {
            if (typeof Swiper === 'undefined') return;
            if (!document.querySelector('.user-kost-swiper')) return;

            new Swiper('.user-kost-swiper', {
                loop: true,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.user-kost-swiper-next',
                    prevEl: '.user-kost-swiper-prev',
                },
                pagination: {
                    el: '.user-kost-swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
            });
        }

        function initializeGalleryModal() {
            const openButton = document.getElementById('open-gallery-modal');
            const modal = document.getElementById('gallery-modal');
            const closeButton = document.getElementById('close-gallery-modal');
            const backdrop = document.getElementById('gallery-backdrop');

            if (!openButton || !modal || !closeButton || !backdrop) return;

            const openModal = () => {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            };

            const closeModal = () => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            };

            openButton.addEventListener('click', openModal);
            closeButton.addEventListener('click', closeModal);
            backdrop.addEventListener('click', closeModal);

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });

        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                initializeKostImageSlider();
                initializeGalleryModal();
            });
        } else {
            initializeKostImageSlider();
            initializeGalleryModal();
        }

    </script>

    <style>
        .user-kost-swiper {
            width: 100%;
            position: relative;
            padding-bottom: calc(320 / 800 * 100%);
            height: 0;
            margin: 0 auto;
            background: #f3f4f6;
        }

        .user-kost-swiper .swiper-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .user-kost-swiper .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .user-kost-swiper .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .user-kost-swiper-next,
        .user-kost-swiper-prev {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.62);
            width: 56px;
            height: 56px;
            border-radius: 9999px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-kost-swiper-next:hover,
        .user-kost-swiper-prev:hover {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .user-kost-swiper-next::after,
        .user-kost-swiper-prev::after {
            font-size: 28px;
            font-weight: 700;
        }

        .user-kost-swiper-next {
            right: 10px;
        }

        .user-kost-swiper-prev {
            left: 10px;
        }

        .user-kost-swiper-pagination {
            position: absolute;
            bottom: 10px !important;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 10;
        }

        .user-kost-swiper-pagination .swiper-pagination-bullet {
            background: #fff;
            opacity: 0.6;
            width: 7px;
            height: 7px;
        }

        .user-kost-swiper-pagination .swiper-pagination-bullet-active {
            opacity: 1;
            transform: scale(1.1);
        }
    </style>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?> 



<?php /**PATH C:\laragon\www\Brock\resources\views/user/kost/show.blade.php ENDPATH**/ ?>