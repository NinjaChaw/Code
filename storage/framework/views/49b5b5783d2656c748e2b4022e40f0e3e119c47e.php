<?php $__env->startSection('title'); ?>
    <?php echo e(__('Badges')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui one column stackable grid container">
        <div class="center aligned column">
            <a href="<?php echo e(route('backend.badges.create')); ?>" class="ui big <?php echo e($settings->color); ?> button">
                <i class="trophy icon"></i>
                <?php echo e(__('Create badge')); ?>

            </a>
        </div>
    </div>
    <div class="ui equal width stackable grid container">
        <div class="row">
            <?php $__currentLoopData = $badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="center aligned column">
                    <div class="ui <?php echo e($inverted); ?> segment">
                        <div class="ui <?php echo e($inverted); ?> statistic">
                            <div class="label">
                                Badge point: <?php echo e($badge->points); ?>

                            </div>
                            <div class="value">
                                <img src="<?php echo e(asset('images/badges/'.$badge->avatar)); ?>" alt="Badge image">
                            </div>
                            <div class="label">
                                <?php echo e($badge->title); ?>

                            </div>
                            <br>
                            <a class="ui icon <?php echo e($settings->color); ?> basic button" href="<?php echo e(route('backend.badge.edit', $badge->id)); ?>">
                                <i class="edit icon"></i>
                                <?php echo e(__('Edit')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>