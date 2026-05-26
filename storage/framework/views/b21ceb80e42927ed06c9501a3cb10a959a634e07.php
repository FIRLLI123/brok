<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Admin Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-4">Ringkasan Admin</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                        <!-- Total Mitra Card -->
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-blue-800">Total Mitra</h3>
                            <p class="text-3xl font-bold text-blue-600"><?php echo e($totalMitra); ?></p>
                        </div>

                        <!-- Pending Mitra Card -->
                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-yellow-800">Pending Mitra</h3>
                            <p class="text-3xl font-bold text-yellow-600"><?php echo e($pendingMitra); ?></p>
                        </div>

                        <div class="bg-emerald-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-emerald-800">Mitra Aktif</h3>
                            <p class="text-3xl font-bold text-emerald-600"><?php echo e($activeMitra); ?></p>
                        </div>

                        <!-- Total Kost Card -->
                        <div class="bg-green-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-green-800">Total Kost</h3>
                            <p class="text-3xl font-bold text-green-600"><?php echo e($totalKost); ?></p>
                        </div>

                        <div class="bg-sky-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-sky-800">Kost Disetujui</h3>
                            <p class="text-3xl font-bold text-sky-600"><?php echo e($approvedKost); ?></p>
                        </div>

                        <div class="bg-rose-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-rose-800">Kost Ditolak</h3>
                            <p class="text-3xl font-bold text-rose-600"><?php echo e($rejectedKost); ?></p>
                        </div>
                    </div>

                    <!-- Recent Mitra Registrations -->
                    <div class="mt-8">
                        <div class="flex items-center justify-between gap-4 mb-4">
                            <h3 class="text-xl font-semibold">Recent Mitra Registrations</h3>
                            <a href="<?php echo e(route('admin.mitra.index')); ?>" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                Lihat semua mitra
                            </a>
                        </div>

                        <div class="bg-white shadow overflow-x-auto sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Akun</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Verifikasi Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Kost</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $__empty_1 = true; $__currentLoopData = $recentMitras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mitra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900"><?php echo e($mitra->name); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e($mitra->email); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e($mitra->phone ?: '-'); ?></td>
                                            <td class="px-6 py-4 min-w-[220px] text-sm text-gray-700"><?php echo e($mitra->address ?: '-'); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-700">
                                                    <?php echo e(ucfirst($mitra->role)); ?>

                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($mitra->is_active ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'); ?>">
                                                    <?php echo e($mitra->is_active ? 'Aktif' : 'Pending'); ?>

                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($mitra->email_verified_at ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-700'); ?>">
                                                    <?php echo e($mitra->email_verified_at ? 'Terverifikasi' : 'Belum'); ?>

                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e($mitra->kost_count); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e(optional($mitra->created_at)->format('d M Y H:i') ?: '-'); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="<?php echo e(route('admin.mitra.index')); ?>" class="text-indigo-600 hover:text-indigo-900">Kelola</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="10" class="px-6 py-4 text-center text-sm text-gray-500">
                                                Belum ada data mitra.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
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
<?php endif; ?> 
<?php /**PATH C:\laragon\www\Brock\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>