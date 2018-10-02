<?php $__env->startSection('title'); ?>
    <?php echo e(__('app.coins')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <data-feed></data-feed>
    <div class="ui one column tablet stackable grid container">
        <div class="column">
            <?php if($assets->isEmpty()): ?>
                <div class="ui segment">
                    <p><?php echo e(__('app.competitions_empty')); ?></p>
                </div>
            <?php else: ?>
                <assets-table :assets-list="<?php echo e($assets->getCollection()); ?>" class="ui selectable <?php echo e($inverted); ?> table">
                    <template slot="header">
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'symbol', 'sort' => $sort, 'order' => $order]); ?>
                            <?php echo e(__('app.symbol')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'name', 'sort' => $sort, 'order' => $order]); ?>
                            <?php echo e(__('app.name')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'price', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned']); ?>
                            <?php echo e(__('app.price')); ?>, <?php echo e(config('settings.currency')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'change_abs', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned']); ?>
                            <?php echo e(__('app.change_abs')); ?>, <?php echo e(config('settings.currency')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'change_pct', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned']); ?>
                            <?php echo e(__('app.change_pct')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'market_cap', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned']); ?>
                            <?php echo e(__('app.market_cap')); ?>, <?php echo e(config('settings.currency')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'trades_count', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned']); ?>
                            <?php echo e(__('app.trades')); ?>

                        <?php echo $__env->renderComponent(); ?>
                    </template>
                </assets-table>
            <?php endif; ?>
        </div>
        <div class="right aligned column">
            <?php echo e($assets->appends(['sort' => $sort])->appends(['order' => $order])->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>