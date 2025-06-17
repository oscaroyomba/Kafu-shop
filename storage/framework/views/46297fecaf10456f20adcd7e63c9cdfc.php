<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <?php echo e(__("You're logged in!")); ?>

                </div>
            </div>

            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Your Recent Orders</h3>

                    <?php if($orders->count()): ?>
                        <table class="w-full text-left border-collapse text-sm">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="p-2 border-b">Order ID</th>
                                    <th class="p-2 border-b">Total</th>
                                    <th class="p-2 border-b">Status</th>
                                    <th class="p-2 border-b">Date</th>
                                    <th class="p-2 border-b text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="hover:bg-gray-50 border-b">
                                        <td class="p-2">#<?php echo e($order->id); ?></td>
                                        <td class="p-2">ETB <?php echo e(number_format($order->total_amount, 2)); ?></td>
                                        <td class="p-2">
                                            <span class="inline-block px-2 py-1 rounded-full text-xs
                                                <?php if($order->status == 'pending'): ?> bg-yellow-200 text-yellow-800
                                                <?php elseif($order->status == 'shipped'): ?> bg-blue-200 text-blue-800
                                                <?php elseif($order->status == 'delivered'): ?> bg-green-200 text-green-800
                                                <?php else: ?> bg-gray-200 text-gray-700
                                                <?php endif; ?>">
                                                <?php echo e(ucfirst($order->status)); ?>

                                            </span>
                                        </td>
                                        <td class="p-2"><?php echo e($order->created_at->format('M d, Y')); ?></td>
                                        <td class="p-2 text-right">
                                            <a href="<?php echo e(route('orders.show', $order->id)); ?>"
                                               class="text-blue-600 hover:underline text-sm">View</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-gray-600">You have not placed any orders yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\User\kafu\resources\views/dashboard.blade.php ENDPATH**/ ?>