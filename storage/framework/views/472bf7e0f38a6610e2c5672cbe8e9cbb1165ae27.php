<?php $__env->startSection('title'); ?>
    <?php echo e(__('app.dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui equal width stackable grid container">
        <div class="row">
            <div class="center aligned column">
                <div class="ui <?php echo e($inverted); ?> segment">
                    <div class="ui <?php echo e($inverted); ?> statistic">
                        <div class="value">
                            <?php echo e($users_count); ?>

                        </div>
                        <div class="label">
                            <?php echo e(__('users.users')); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="center aligned column">
                <div class="ui <?php echo e($inverted); ?> segment">
                    <div class="ui <?php echo e($inverted); ?> green statistic">
                        <div class="value">
                            <?php echo e($active_users_count); ?>

                        </div>
                        <div class="label">
                            <?php echo e(__('users.status_' . \App\Models\User::STATUS_ACTIVE)); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="center aligned column">
                <div class="ui <?php echo e($inverted); ?> segment">
                    <div class="ui <?php echo e($inverted); ?> red statistic">
                        <div class="value">
                            <?php echo e($blocked_users_count); ?>

                        </div>
                        <div class="label">
                            <?php echo e(__('users.status_' . \App\Models\User::STATUS_BLOCKED)); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="center aligned column">
                <div class="ui <?php echo e($inverted); ?> segment">
                    <div class="ui <?php echo e($inverted); ?> statistic">
                        <div class="value">
                            <?php echo e($competitions_count); ?>

                        </div>
                        <div class="label">
                            <?php echo e(__('app.competitions')); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="center aligned column">
                <div class="ui <?php echo e($inverted); ?> segment">
                    <div class="ui <?php echo e($inverted); ?> green statistic">
                        <div class="value">
                            <?php echo e($open_competitions_count); ?>

                        </div>
                        <div class="label">
                            <?php echo e(__('app.competition_status_' . \App\Models\Competition::STATUS_OPEN)); ?>

                            /
                            <?php echo e(__('app.competition_status_' . \App\Models\Competition::STATUS_IN_PROGRESS)); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="center aligned column">
                <div class="ui <?php echo e($inverted); ?> segment">
                    <div class="ui <?php echo e($inverted); ?> red statistic">
                        <div class="value">
                            <?php echo e($closed_competitions_count); ?>

                        </div>
                        <div class="label">
                            <?php echo e(__('app.competition_status_' . \App\Models\Competition::STATUS_COMPLETED)); ?>

                            /
                            <?php echo e(__('app.competition_status_' . \App\Models\Competition::STATUS_CANCELLED)); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="center aligned column">
                <div class="ui <?php echo e($inverted); ?> segment">
                    <div class="ui <?php echo e($inverted); ?> statistic">
                        <div class="value">
                            <?php echo e($trades_count); ?>

                        </div>
                        <div class="label">
                            <?php echo e(__('app.closed_trades')); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="center aligned column">
                <div class="ui <?php echo e($inverted); ?> segment">
                    <div class="ui <?php echo e($inverted); ?> green statistic">
                        <div class="value">
                            <?php echo e($profitable_trades_count); ?>

                        </div>
                        <div class="label">
                            <?php echo e(__('app.profitable_trades')); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="center aligned column">
                <div class="ui <?php echo e($inverted); ?> segment">
                    <div class="ui <?php echo e($inverted); ?> red statistic">
                        <div class="value">
                            <?php echo e($unprofitable_trades_count); ?>

                        </div>
                        <div class="label">
                            <?php echo e(__('app.unprofitable_trades')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>