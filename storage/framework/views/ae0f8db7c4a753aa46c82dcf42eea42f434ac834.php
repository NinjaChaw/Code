<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <?php echo $__env->make('includes.backend.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body class="<?php echo e(str_replace('.','-',Route::currentRouteName())); ?> background-<?php echo e($settings->background); ?> color-<?php echo e($settings->color); ?>">

    <div id="app">

        <?php echo $__env->make('includes.backend.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="pusher">

            <div id="before-content">
                <?php echo $__env->yieldContent('before-content'); ?>
            </div>

            <div id="content">
                <div class="ui stackable grid container">
                    <div class="column">
                        <h1 class="ui block <?php echo e($inverted); ?> header">
                            <?php echo $__env->yieldContent('title'); ?>
                        </h1>
                        <?php $__env->startSection('messages'); ?>
                            <?php $__env->startComponent('components.session.messages'); ?>
                            <?php echo $__env->renderComponent(); ?>
                        <?php echo $__env->yieldSection(); ?>
                    </div>
                </div>
                <?php echo $__env->yieldContent('content'); ?>
            </div>

            <div id="after-content">
                <?php echo $__env->yieldContent('after-content'); ?>
            </div>

            <?php echo $__env->make('includes.backend.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </div>

    </div>

    <?php echo $__env->make('includes.backend.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>