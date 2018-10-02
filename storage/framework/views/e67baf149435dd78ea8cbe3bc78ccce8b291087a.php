<?php $__env->startSection('title'); ?>
    <?php echo e(__('maintenance.maintenance')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui one column stackable grid container">
        <div class="column">
            <div class="ui divided items">
                <div class="item">
                    <div class="content">
                        <span class="header"><?php echo e(__('maintenance.cache')); ?></span>
                        <div class="description">
                            <p><?php echo e(__('maintenance.cache_description')); ?></p>
                        </div>
                        <div class="extra">
                            <form class="ui <?php echo e($inverted); ?> form" method="POST" action="<?php echo e(route('backend.maintenance.cache')); ?>">
                                <?php echo e(csrf_field()); ?>

                                <button class="ui <?php echo e($settings->color); ?> submit button"><?php echo e(__('maintenance.clear_cache')); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="content">
                        <span class="header"><?php echo e(__('maintenance.db_updates')); ?></span>
                        <div class="description">
                            <p><?php echo e(__('maintenance.db_updates_description')); ?></p>
                        </div>
                        <div class="extra">
                            <form class="ui form" method="POST" action="<?php echo e(route('backend.maintenance.migrate')); ?>">
                                <?php echo e(csrf_field()); ?>

                                <button class="ui <?php echo e($settings->color); ?> submit button"><?php echo e(__('maintenance.migrate')); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="content">
                        <span class="header"><?php echo e(__('maintenance.cron')); ?></span>
                        <div class="description">
                            <p><?php echo e(__('maintenance.cron_description')); ?></p>
                            <div class="ui <?php echo e($settings->color); ?> message">
                                <pre>* * * * * php <?php echo e(base_path()); ?>/artisan schedule:run >> /dev/null 2>&1</pre>
                            </div>
                            <p><?php echo e(__('maintenance.cron_description2')); ?></p>
                        </div>
                        <div class="extra">
                            <form class="ui inline form" method="POST" action="<?php echo e(route('backend.maintenance.cron')); ?>">
                                <?php echo e(csrf_field()); ?>

                                <button class="ui <?php echo e($settings->color); ?> submit button"><?php echo e(__('maintenance.run_cron')); ?></button>
                            </form>
                            <form class="ui inline form" method="POST" action="<?php echo e(route('backend.maintenance.cron_assets_market_data')); ?>">
                                <?php echo e(csrf_field()); ?>

                                <button class="ui <?php echo e($settings->color); ?> basic submit button"><?php echo e(__('maintenance.update_assets_market_data')); ?></button>
                            </form>
                            <form class="ui inline form" method="POST" action="<?php echo e(route('backend.maintenance.cron_currencies_market_data')); ?>">
                                <?php echo e(csrf_field()); ?>

                                <button class="ui <?php echo e($settings->color); ?> basic submit button"><?php echo e(__('maintenance.update_currencies_market_data')); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>