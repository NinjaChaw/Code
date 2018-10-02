<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <?php echo $__env->make('includes.frontend.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body class="<?php echo e(str_replace('.','-',Route::currentRouteName())); ?> background-<?php echo e($settings->background); ?> color-<?php echo e($settings->color); ?>">
    <?php echo $__env->renderWhen(config('settings.gtm_container_id'), 'includes.frontend.gtm-body', array_except(get_defined_vars(), array('__data', '__path'))); ?>

    <div id="app">

        <div id="before-content">
            <?php echo $__env->yieldContent('before-content'); ?>
        </div>

        <div class="ui container">
            <?php $__env->startSection('messages'); ?>
                <?php $__env->startComponent('components.session.messages'); ?>
                <?php echo $__env->renderComponent(); ?>
            <?php echo $__env->yieldSection(); ?>
        </div>

        <div id="content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <div id="after-content">
            <?php echo $__env->yieldContent('after-content'); ?>
        </div>

        <?php echo $__env->first(['includes.frontend.footer-udf','includes.frontend.footer'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div>

    <?php echo $__env->make('includes.frontend.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>