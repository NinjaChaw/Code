<?php $__env->startSection('title'); ?>
    <?php echo e(__('app.help')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui one column tablet stackable <?php echo e($inverted); ?> grid container">
        <div class="column">
            <div class="ui basic segment">
            <div class="ui fluid <?php echo e($inverted ? 'inverted' : 'styled'); ?> accordion">
                <div class="active title">
                    <i class="dropdown icon"></i>
                    <?php echo e(__('app.help_q1')); ?>

                </div>
                <div class="active content">
                    <p><?php echo e(__('app.help_a1')); ?></p>
                </div>
                <div class="title">
                    <i class="dropdown icon"></i>
                    <?php echo e(__('app.help_q2')); ?>

                </div>
                <div class="content">
                    <p><?php echo __('app.help_a2', ['url' => route('frontend.competitions.index')]); ?></p>
                    <p><?php echo e(__('app.help_a21')); ?></p>
                    <p><?php echo e(__('app.help_a22')); ?></p>
                </div>
                <div class="title">
                    <i class="dropdown icon"></i>
                    <?php echo e(__('app.help_q3')); ?>

                </div>
                <div class="content">
                    <p><?php echo e(__('app.help_a3')); ?></p>
                </div>
                <div class="title">
                    <i class="dropdown icon"></i>
                    <?php echo e(__('app.help_q4')); ?>

                </div>
                <div class="content">
                    <p><?php echo __('app.help_a4'); ?></p>
                    <p><?php echo e(__('app.help_a41')); ?></p>
                </div>
                <div class="title">
                    <i class="dropdown icon"></i>
                    <?php echo e(__('app.help_q5')); ?>

                </div>
                <div class="content">
                    <p><?php echo e(__('app.help_a5')); ?></p>
                </div>
                <div class="title">
                    <i class="dropdown icon"></i>
                    <?php echo e(__('app.help_q6')); ?>

                </div>
                <div class="content">
                    <p><?php echo __('app.help_a6'); ?></p>
                </div>
                <div class="title">
                    <i class="dropdown icon"></i>
                    <?php echo e(__('app.help_q7')); ?>

                </div>
                <div class="content">
                    <p><?php echo e(__('app.help_a7')); ?></p>
                </div>
                <div class="title">
                    <i class="dropdown icon"></i>
                    <?php echo e(__('app.help_q8')); ?>

                </div>
                <div class="content">
                    <p><?php echo e(__('app.help_a8')); ?></p>
                    <p><?php echo e(__('app.help_a81')); ?></p>
                    <div class="ui bulleted list">
                        <div class="item"><?php echo __('app.help_a8_p1', ['n' => config('settings.points_type_trade_loss')]); ?></div>
                        <div class="item"><?php echo __('app.help_a8_p2', ['n' => config('settings.points_type_trade_profit')]); ?></div>
                        <div class="item"><?php echo __('app.help_a8_p3', ['n' => config('settings.points_type_competition_join')]); ?></div>
                        <div class="item"><?php echo __('app.help_a8_p4', ['n' => config('settings.points_type_competition_place1')]); ?></div>
                        <div class="item"><?php echo __('app.help_a8_p5', ['n' => config('settings.points_type_competition_place2')]); ?></div>
                        <div class="item"><?php echo __('app.help_a8_p6', ['n' => config('settings.points_type_competition_place3')]); ?></div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>