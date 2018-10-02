<?php $__env->startSection('title'); ?>
    <?php echo e(__('app.assets')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui one column stackable grid container">
        <div class="center aligned column">
            <a href="<?php echo e(route('backend.assets.create')); ?>" class="ui big <?php echo e($settings->color); ?> button">
                <i class="bitcoin icon"></i>
                <?php echo e(__('app.create_asset')); ?>

            </a>
        </div>
        <div class="column">
            <?php if($assets->isEmpty()): ?>
                <div class="ui segment">
                    <p><?php echo e(__('app.competitions_empty')); ?></p>
                </div>
            <?php else: ?>
                <table class="ui selectable tablet stackable <?php echo e($inverted); ?> table">
                    <thead>
                    <tr>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'id', 'sort' => $sort, 'order' => $order]); ?>
                            <?php echo e(__('app.id')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'symbol', 'sort' => $sort, 'order' => $order]); ?>
                            <?php echo e(__('app.symbol')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'name', 'sort' => $sort, 'order' => $order]); ?>
                            <?php echo e(__('app.name')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'price', 'sort' => $sort, 'order' => $order]); ?>
                            <?php echo e(__('app.price')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'change_abs', 'sort' => $sort, 'order' => $order]); ?>
                            <?php echo e(__('app.change_abs')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'change_pct', 'sort' => $sort, 'order' => $order]); ?>
                            <?php echo e(__('app.change_pct')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'status', 'sort' => $sort, 'order' => $order]); ?>
                            <?php echo e(__('app.status')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td data-title="<?php echo e(__('app.id')); ?>"><?php echo e($asset->id); ?></td>
                            <td data-title="<?php echo e(__('app.symbol')); ?>">
                                <a href="<?php echo e(route('backend.assets.edit', $asset)); ?>">
                                    <img src="<?php echo e($asset->logo_url); ?>" class="ui avatar image">
                                    <?php echo e($asset->symbol); ?>

                                </a>
                            </td>
                            <td data-title="<?php echo e(__('app.name')); ?>">
                                <a href="<?php echo e(route('backend.assets.edit', $asset)); ?>">
                                    <?php echo e($asset->name); ?>

                                </a>
                            </td>
                            <td data-title="<?php echo e(__('app.price')); ?>"><?php echo e($asset->_price); ?></td>
                            <td data-title="<?php echo e(__('app.change_abs')); ?>" class="<?php echo e($asset->change_abs > 0 ? 'positive' : ($asset->change_abs < 0 ? 'negative' : '')); ?>"><?php echo e($asset->_change_abs); ?></td>
                            <td data-title="<?php echo e(__('app.change_pct')); ?>" class="<?php echo e($asset->change_pct > 0 ? 'positive' : ($asset->change_pct < 0 ? 'negative' : '')); ?>"><?php echo e($asset->_change_pct); ?></td>
                            <td data-title="<?php echo e(__('app.status')); ?>"><i class="<?php echo e($asset->status == App\Models\Asset::STATUS_ACTIVE ? 'check green' : 'red ban'); ?> large icon"></i> <?php echo e(__('app.asset_status_' . $asset->status)); ?></td>
                            <td class="right aligned tablet-and-below-center">
                                <a class="ui icon <?php echo e($settings->color); ?> basic button" href="<?php echo e(route('backend.assets.edit', $asset)); ?>">
                                    <i class="edit icon"></i>
                                    <?php echo e(__('app.edit')); ?>

                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <div class="right aligned column">
            <?php echo e($assets->appends(['sort' => $sort])->appends(['order' => $order])->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>