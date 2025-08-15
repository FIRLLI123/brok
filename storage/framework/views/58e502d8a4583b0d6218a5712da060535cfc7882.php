<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Ulasan Kost')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <?php if(session('success')): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline"><?php echo e(session('error')); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if($reviews->isEmpty()): ?>
                        <div class="text-center py-8">
                            <p class="text-gray-500">Belum ada ulasan untuk kost Anda.</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-6">
                            <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="border rounded-lg p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center">
                                            <span class="font-semibold text-lg"><?php echo e($review->user->name); ?></span>
                                            <div class="flex items-center ml-3">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <span class="text-yellow-400 <?php echo e($i <= $review->rating ? '' : 'text-gray-300'); ?>">
                                                        ★
                                                    </span>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-500">
                                            <?php echo e($review->created_at->format('d M Y H:i')); ?>

                                        </span>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <p class="text-gray-700"><?php echo e($review->comment); ?></p>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <span class="text-sm text-gray-500">
                                            Kost: <?php echo e($review->kost->name); ?> | 
                                            Kamar: <?php echo e($review->booking->room->room_number); ?>

                                        </span>
                                    </div>

                                    <!-- Review Replies -->
                                    <?php if($review->replies->isNotEmpty()): ?>
                                        <div class="ml-6 border-l-2 border-gray-200 pl-4 mb-4">
                                            <?php $__currentLoopData = $review->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="mb-3">
                                                    <div class="flex items-center justify-between">
                                                        <span class="font-semibold text-sm text-indigo-600"><?php echo e($reply->user->name); ?> (Anda)</span>
                                                        <span class="text-xs text-gray-500">
                                                            <?php echo e($reply->created_at->format('d M Y H:i')); ?>

                                                        </span>
                                                    </div>
                                                    <p class="text-sm text-gray-600 mt-1"><?php echo e($reply->reply); ?></p>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Reply Form -->
                                    <?php if($review->replies->where('user_id', auth()->id())->isEmpty()): ?>
                                        <form action="<?php echo e(route('mitra.reviews.reply', $review)); ?>" method="POST" class="mt-4">
                                            <?php echo csrf_field(); ?>
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-1">
                                                    <label for="reply-<?php echo e($review->id); ?>" class="block text-sm font-medium text-gray-700 mb-1">
                                                        Balas Ulasan
                                                    </label>
                                                    <textarea name="reply" id="reply-<?php echo e($review->id); ?>" rows="2" 
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
                                    <?php else: ?>
                                        <div class="mt-4">
                                            <span class="text-sm text-green-600">✓ Anda sudah membalas ulasan ini</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="mt-6">
                            <?php echo e($reviews->links()); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?> <?php /**PATH C:\laragon\www\Brock\resources\views/mitra/reviews/index.blade.php ENDPATH**/ ?>