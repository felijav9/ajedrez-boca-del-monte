<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="dark">
    <head>
        <?php echo $__env->make('partials.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </head>
    <body class="bg-[#C0C0C0] min-h-screen bg-white dark:bg-zinc-800">

        <?php echo e($slot); ?>



        <?php app('livewire')->forceAssetInjection(); ?>
<?php echo app('flux')->scripts(); ?>

    </body>
</html>

<?php /**PATH C:\laragon\www\Sistema\resources\views/layouts/app-plantilla.blade.php ENDPATH**/ ?>