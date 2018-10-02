<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <?php echo $__env->make('includes.frontend.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body class="<?php echo e(str_replace('.','-',Route::currentRouteName())); ?> background-<?php echo e($settings->background); ?> color-<?php echo e($settings->color); ?>">
    <?php echo $__env->renderWhen(config('settings.gtm_container_id'), 'includes.frontend.gtm-body', array_except(get_defined_vars(), array('__data', '__path'))); ?>

    <div id="app">

        <div id="before-auth">
            <?php echo $__env->yieldContent('before-auth'); ?>
        </div>

        <div id="auth">
            <?php echo $__env->yieldContent('auth'); ?>
        </div>

    </div>

    <?php echo $__env->make('includes.frontend.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>