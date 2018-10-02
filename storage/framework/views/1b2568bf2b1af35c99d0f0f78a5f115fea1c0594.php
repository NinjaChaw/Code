<?php $__env->startSection('title'); ?>
    <?php echo e(__('settings.addons')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui one column stackable grid container">
        <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="column">
                <div class="ui <?php echo e($package->installed ? 'green' : ''); ?> segment">
                    <h2 class="ui dividing header"><?php echo e($package->name); ?></h2>
                    <p>
                        <?php echo e($package->description); ?>

                    </p>
                    <div>
                        <?php if($package->installed): ?>
                            <button class="ui icon basic <?php echo e($settings->color); ?> disabled button">
                                <i class="green checkmark icon"></i>
                                <?php echo e(__('settings.installed')); ?>

                            </button>
                            <span class="ui large basic label"><?php echo e($package->version); ?></span>
                        <?php else: ?>
                            <a href="<?php echo e($package->purchase_url); ?>" class="ui <?php echo e($settings->color); ?> button" target="_blank"><?php echo e(__('settings.purchase')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>