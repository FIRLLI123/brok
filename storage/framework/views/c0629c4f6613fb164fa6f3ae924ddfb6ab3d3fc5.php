<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold mb-4">Browse Kost</h2>
                        
                        <!-- Search and Filter Form -->
                        <form action="<?php echo e(route('user.kost.index')); ?>" method="GET" class="space-y-4">
                            <div class="flex flex-wrap gap-4">
                                <!-- Search Input -->
                                <div class="flex-1 min-w-[200px]">
                                    <input type="text" name="search" placeholder="Cari nama kost..." 
                                           value="<?php echo e(request('search')); ?>"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>

                                <!-- City Filter -->
                                <div class="w-[200px]">
                                    <select name="city" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">Semua Kota</option>
                                        <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($city); ?>" <?php echo e(request('city') == $city ? 'selected' : ''); ?>>
                                                <?php echo e($city); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <!-- Price Range -->
                                <div class="flex gap-2">
                                    <input type="number" name="min_price" placeholder="Harga Min" 
                                           value="<?php echo e(request('min_price')); ?>"
                                           class="w-[150px] rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="self-center">-</span>
                                    <input type="number" name="max_price" placeholder="Harga Max" 
                                           value="<?php echo e(request('max_price')); ?>"
                                           class="w-[150px] rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>

                                <!-- Search Button -->
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    Cari
                                </button>

                                <!-- Reset Button -->
                                <?php if(request()->hasAny(['search', 'city', 'min_price', 'max_price'])): ?>
                                    <a href="<?php echo e(route('user.kost.index')); ?>" 
                                       class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Reset
                                    </a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>

                    <!-- Kost Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php $__empty_1 = true; $__currentLoopData = $kosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow cursor-pointer">
                                <a href="<?php echo e(route('user.kost.show', $kost)); ?>" class="block">
                                    <?php if($kost->images->isNotEmpty()): ?>
                                        <img src="<?php echo e(asset('storage/' . $kost->images->first()->image_path)); ?>" 
                                             alt="<?php echo e($kost->name); ?>" 
                                             class="w-full h-48 object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-400">No Image</span>
                                        </div>
                                    <?php endif; ?>

                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold mb-2 text-gray-900 hover:text-indigo-600"><?php echo e($kost->name); ?></h3>
                                        <p class="text-gray-600 mb-2"><?php echo e($kost->city); ?></p>
                                        <p class="text-gray-600 mb-4"><?php echo e(Str::limit($kost->description, 100)); ?></p>
                                        
                                        <div class="flex justify-between items-center">
                                            <span class="text-lg font-bold text-indigo-600">
                                                Rp <?php echo e(number_format($kost->price, 0, ',', '.')); ?>/bulan
                                            </span>
                                            <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                                Tersedia
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-span-3 text-center py-8">
                                <p class="text-gray-500">Tidak ada kost yang tersedia</p>
                                <p class="text-sm text-gray-400 mt-2">Coba ubah filter pencarian Anda</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mt-6">
                        <?php echo e($kosts->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?> <?php /**PATH C:\laragon\www\Brock\resources\views/user/kost/index.blade.php ENDPATH**/ ?>