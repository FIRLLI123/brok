<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Manajemen Mitra')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900">Daftar Mitra</h3>

                    <div class="mt-4">
                        <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Akun</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Verifikasi Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Kost</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__empty_1 = true; $__currentLoopData = $mitras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mitra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($mitra->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                                <?php echo e($mitra->is_active ? 'Aktif' : 'Tidak Aktif'); ?>

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
                                            <?php if(!$mitra->is_active): ?>
                                                <form action="<?php echo e(route('admin.mitra.approve', ['user' => $mitra])); ?>" method="POST" class="inline-block">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <button type="submit" class="text-indigo-600 hover:text-indigo-900">Aktifkan</button>
                                                </form>
                                            <?php else: ?>
                                                <form action="<?php echo e(route('admin.mitra.reject', ['user' => $mitra])); ?>" method="POST" class="inline-block">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Nonaktifkan</button>
                                                </form>
                                            <?php endif; ?>
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
<?php /**PATH C:\laragon\www\Brock\resources\views/admin/mitra/index.blade.php ENDPATH**/ ?>