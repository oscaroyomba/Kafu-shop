<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    
    

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="<?php echo e(url('/')); ?>" class="text-lg font-bold text-blue-600">SM</a>

            <div class="space-x-4 flex items-center">
                <a href="<?php echo e(route('products.index')); ?>" class="text-sm text-gray-700 hover:underline">Products</a>
                <a href="<?php echo e(route('cart.index')); ?>" class="text-sm text-gray-700 hover:underline">Cart</a>

                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('dashboard')); ?>" class="text-sm text-gray-700 hover:underline">Dashboard</a>

                    <?php if(auth()->user()?->is_admin): ?>
                        <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-sm text-red-600 font-semibold hover:underline">
                            Admin Panel
                        </a>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="text-sm text-gray-700 hover:underline bg-transparent border-none p-0 cursor-pointer">
                            Logout
                        </button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="text-sm text-gray-700 hover:underline">Login</a>
                    <a href="<?php echo e(route('register')); ?>" class="text-sm text-gray-700 hover:underline">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="py-6">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

</body>
</html><?php /**PATH C:\Users\User\kafu\resources\views/layouts/app.blade.php ENDPATH**/ ?>