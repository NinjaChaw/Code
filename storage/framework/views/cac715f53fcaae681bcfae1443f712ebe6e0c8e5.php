<?php $__env->startSection('title'); ?>
    <?php echo e(__('Badges')); ?> :: <?php echo e(__('app.create')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui one column stackable grid container">
        <div class="column">
            <div class="ui <?php echo e($inverted); ?> segment">
                <form class="ui <?php echo e($inverted); ?> form" method="POST" action="<?php echo e(route('backend.badges.store')); ?>" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <image-upload-input name="logo" default-image-url="<?php echo e(asset('images/badges/initial.jpg')); ?>" class="<?php echo e($errors->has('logo') ? 'error' : ''); ?>" color="<?php echo e($settings->color); ?>">
                        <?php echo e(__('app.logo')); ?>

                    </image-upload-input>
                    <div class="field <?php echo e($errors->has('label') ? 'error' : ''); ?>">
                        <label><?php echo e(__('Achievement label')); ?></label>
                        <div class="ui input">
                            <input type="text" name="label" placeholder="<?php echo e(__('Achievement label')); ?>" value="<?php echo e(old('label')); ?>" required autofocus>
                        </div>
                    </div>
                    <div class="field <?php echo e($errors->has('points') ? 'error' : ''); ?>">
                        <label><?php echo e(__('Points required to achieve this badge')); ?></label>
                        <div class="ui input">
                            <input type="number" name="points" placeholder="<?php echo e(__('Badge points')); ?>" value="<?php echo e(old('points')); ?>" required autofocus>
                        </div>
                    </div>
                    <button class="ui large <?php echo e($settings->color); ?> submit button">
                        <i class="save icon"></i>
                        <?php echo e(__('app.save')); ?>

                    </button>
                </form>
            </div>
        </div>
        <div class="column">
            <a href="<?php echo e(route('backend.badge.index')); ?>"><i class="left arrow icon"></i> <?php echo e(__('Back to all badges')); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>