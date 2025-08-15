<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-200">
                <div class="p-6 md:p-10">
                    <!-- Tombol Kembali -->
                    <div class="mb-8 flex items-center">
                        <a href="<?php echo e(route('mitra.kost.index')); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition duration-150 ease-in-out text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Kembali ke Daftar Kost
                        </a>
                    </div>

                    <!-- Slider Gambar -->
                    <div class="mb-8 relative w-full">
                        <div class="swiper-container rounded-lg overflow-hidden shadow-lg border border-gray-200">
                            <div class="swiper-wrapper">
                                <?php $__currentLoopData = $kost->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="swiper-slide">
                                        <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" 
                                             alt="<?php echo e($kost->name); ?>" 
                                             class="w-full h-full object-cover">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <!-- Navigation -->
                            <div class="swiper-button-next swiper-button-white"></div>
                            <div class="swiper-button-prev swiper-button-white"></div>
                            <!-- Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    <!-- Informasi Kost -->
                    <div class="space-y-4 px-2 md:px-4 pb-2 md:pb-4">
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 leading-tight mb-3"><?php echo e($kost->name); ?></h1>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-6 text-gray-700">
                            <div class="flex items-center text-base">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span><?php echo e($kost->address); ?></span>
                            </div>

                            <div class="flex items-center text-base">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span><?php echo e($kost->city); ?></span>
                            </div>

                            <div class="flex items-center text-blue-700 font-bold text-xl col-span-full mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Rp <?php echo e(number_format($kost->price, 0, ',', '.')); ?>/bulan</span>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <h2 class="text-xl font-bold text-gray-800 mb-3">Deskripsi Kost</h2>
                            <p class="text-gray-700 leading-relaxed text-base"><?php echo e($kost->description); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.swiper-container', {
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
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
            });
        });
    </script>

    <style>
        /* Custom styles for Swiper */
        .swiper-container {
            width: 100%;
            position: relative;
            padding-bottom: calc(200 / 600 * 100%); /* Mengubah rasio aspek menjadi lebih kecil (200px height) */
            height: 0;
            max-width: 800px; /* Membatasi lebar maksimum */
            margin: 0 auto; /* Membuat slider berada di tengah */
        }

        .swiper-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            background: none;
        }

        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: white !important;
            background-color: rgba(0, 0, 0, 0.4);
            padding: 15px 12px; /* Memperkecil padding tombol navigasi */
            border-radius: 4px;
            transition: background-color 0.3s ease;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem; /* Memperkecil ukuran ikon navigasi */
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .swiper-pagination-bullet {
            background: white !important;
            opacity: 0.6;
            width: 6px; /* Memperkecil ukuran bullet */
            height: 6px;
        }

        .swiper-pagination-bullet-active {
            opacity: 1;
            transform: scale(1.1);
        }
    </style>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?> <?php /**PATH C:\laragon\www\Brock\resources\views/mitra/kost/show.blade.php ENDPATH**/ ?>