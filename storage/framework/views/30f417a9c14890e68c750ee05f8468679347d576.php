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
                    <h2 class="text-2xl font-semibold mb-4">Dashboard Pengguna</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Active Bookings Card -->
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-blue-800">Pemesanan Aktif</h3>
                            <p class="text-3xl font-bold text-blue-600">
                                <?php echo e(auth()->user()->bookings()->where('status', 'approved')->count()); ?>

                            </p>
                        </div>

                        <!-- Pending Bookings Card -->
                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-yellow-800">Pemesanan Menunggu</h3>
                            <p class="text-3xl font-bold text-yellow-600">
                                <?php echo e(auth()->user()->bookings()->where('status', 'pending')->count()); ?>

                            </p>
                        </div>

                        <!-- Total Reviews Card -->
                        <div class="bg-green-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-green-800">Total Ulasan</h3>
                            <p class="text-3xl font-bold text-green-600">
                                <?php echo e(auth()->user()->reviews()->count()); ?>

                            </p>
                        </div>
                    </div>

                    <!-- Active Bookings -->
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold mb-4">Pemesanan Aktif</h3>
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kost</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Kamar</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Selesai</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $__currentLoopData = auth()->user()->bookings()->where('status', 'approved')->latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($booking->room->kost->name); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($booking->room->room_number); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($booking->start_date->format('d M Y')); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($booking->end_date->format('d M Y')); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <?php if(!$booking->review): ?>
                                                <a href="<?php echo e(route('user.reviews.create', ['booking' => $booking->id])); ?>" 
                                                   class="px-3 py-1 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                                                    Tambah Ulasan
                                                </a>
                                            <?php else: ?>
                                                <span class="text-gray-500">Sudah Diulas</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Recent Reviews -->
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold mb-4">Ulasan Terbaru</h3>
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kost</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Komentar</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $__currentLoopData = auth()->user()->reviews()->latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($review->kost->name); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <svg class="w-4 h-4 <?php echo e($i <= $review->rating ? 'text-yellow-400' : 'text-gray-300'); ?>" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                <?php endfor; ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4"><?php echo e(Str::limit($review->comment, 50)); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($review->created_at->format('d M Y')); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
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
<?php endif; ?> <?php /**PATH C:\laragon\www\Brock\resources\views/user/dashboard.blade.php ENDPATH**/ ?>