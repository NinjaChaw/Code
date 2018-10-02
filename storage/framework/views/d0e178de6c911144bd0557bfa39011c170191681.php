<?php $__env->startSection('title'); ?>
    <?php echo e(__('app.competitions')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui one column stackable grid container">
        <div class="center aligned column">
            <a href="<?php echo e(route('backend.competitions.create')); ?>" class="ui big <?php echo e($settings->color); ?> button">
                <i class="trophy icon"></i>
                <?php echo e(__('app.create_competition')); ?>

            </a>
        </div>
        <div class="column">
            <?php if($competitions->isEmpty()): ?>
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
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'title', 'sort' => $sort, 'order' => $order]); ?>
                            <?php echo e(__('app.title')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'balance', 'sort' => $sort, 'order' => $order]); ?>
                        <?php echo e(__('app.start_balance')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'duration', 'sort' => $sort, 'order' => $order]); ?>
                            <?php echo e(__('app.duration')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'slots', 'sort' => $sort, 'order' => $order]); ?>
                            <?php echo e(__('app.slots_taken')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <th><a href="#"><?php echo e(__('app.details')); ?></a></th>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'status', 'sort' => $sort, 'order' => $order]); ?>
                            <?php echo e(__('app.status')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'created', 'sort' => $sort, 'order' => $order]); ?>
                            <?php echo e(__('app.created_at')); ?>

                        <?php echo $__env->renderComponent(); ?>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $competitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td data-title="<?php echo e(__('app.id')); ?>"><?php echo e($competition->id); ?></td>
                            <td data-title="<?php echo e(__('app.title')); ?>">
                                <a href="<?php echo e(route('backend.competitions.edit', $competition)); ?>">
                                    <?php echo e($competition->title); ?>

                                </a>
                            </td>
                            <td data-title="<?php echo e(__('app.start_balance')); ?>"><?php echo e($competition->_start_balance); ?> <?php echo e($competition->currency->code); ?></td>
                            <td data-title="<?php echo e(__('app.duration')); ?>">
                                <?php echo e(__('app.duration_' . $competition->duration)); ?>

                                <?php if($competition->start_time && $competition->end_time): ?>
                                    <span data-tooltip="<?php echo e($competition->start_time); ?> &mdash; <?php echo e($competition->end_time); ?>">
                                        <i class="calendar outline tooltip icon"></i>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td data-title="<?php echo e(__('app.slots_taken')); ?>"><?php echo e($competition->slots_taken); ?> / <?php echo e($competition->slots_max); ?></td>
                            <td>
                                <div class="ui two column grid">
                                    <div class="column">
                                        <div><?php echo e(__('app.lot_size')); ?>:</div>
                                        <div><?php echo e(__('app.leverage')); ?>:</div>
                                        <div><?php echo e(__('app.volume')); ?>:</div>
                                        <div><?php echo e(__('app.min_margin_level')); ?>:</div>
                                        <?php if($competition->fee > 0): ?>
                                            <div><?php echo e(__('app.fee')); ?>:</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="column">
                                        <div><?php echo e($competition->_lot_size); ?></div>
                                        <div><?php echo e($competition->_leverage); ?>:1</div>
                                        <div><?php echo e($competition->_volume_min); ?> &mdash; <?php echo e($competition->_volume_max); ?></div>
                                        <div><?php echo e($competition->_min_margin_level); ?></div>
                                        <?php if($competition->fee > 0): ?>
                                            <div><?php echo e($competition->_fee); ?> <?php echo e($competition->currency->code); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td data-title="<?php echo e(__('app.status')); ?>">
                                <?php if($competition->status==\App\Models\Competition::STATUS_COMPLETED): ?>
                                    <i class="green checkmark icon"></i>
                                <?php endif; ?>
                                <?php echo e(__('app.competition_status_' . $competition->status)); ?>

                            </td>
                            <td data-title="<?php echo e(__('app.created_at')); ?>">
                                <?php echo e($competition->created_at->diffForHumans()); ?>

                                <span data-tooltip="<?php echo e($competition->created_at); ?>">
                                    <i class="calendar outline tooltip icon"></i>
                                </span>
                            </td>
                            <td class="right aligned tablet-and-below-center">
                                <a class="ui icon <?php echo e($settings->color); ?> basic button" href="<?php echo e(route('backend.competitions.edit', $competition)); ?>">
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
            <?php echo e($competitions->appends(['sort' => $sort])->appends(['order' => $order])->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>