<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto mt-20">
    <h2 class="text-xl font-bold mb-4 text-center">Login</h2>

    
    <?php if($errors->any()): ?>
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc pl-5">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('login')); ?>" method="POST" class="bg-white p-6 rounded shadow">
        <?php echo csrf_field(); ?>
        <input type="email" name="email" placeholder="Email" class="w-full mb-3 border p-2 rounded" required>
        <input type="password" name="password" placeholder="Password" class="w-full mb-3 border p-2 rounded" required>
        <button type="submit" class="bg-lime-500 w-full py-2 text-white rounded hover:bg-lime-600">Masuk</button>
    </form>

    <p class="mt-4 text-center text-sm">
        Belum punya akun?
        <a href="<?php echo e(route('register')); ?>" class="text-blue-600 hover:underline">Daftar di sini</a>
    </p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\tabungan-kelas-real\resources\views/auth/login.blade.php ENDPATH**/ ?>