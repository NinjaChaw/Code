<?php $__env->startSection('title'); ?>
    <?php echo e(__('app.rankings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui one column tablet stackable grid container">
        <div class="column">
            <table id="rankings-table" class="ui selectable tablet stackable <?php echo e($inverted); ?> table">
                <thead>
                    <tr>
                        <th><?php echo e(__('app.rank')); ?></th>
                        <th><?php echo e(__('users.name')); ?></th>
                        <th class="right aligned">
                            <i class="angle down icon"></i>
                            <?php echo e(__('app.points')); ?>

                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td data-title="<?php echo e(__('app.rank')); ?>"><?php echo e(++$i + $users->perPage() * ($users->currentPage()-1)); ?></td>
                        <td data-title="<?php echo e(__('users.name')); ?>">
                            <a href="<?php echo e(route('frontend.users.show', $user->id)); ?>">
                                <img class="ui avatar image" src="<?php echo e($user->avatar_url); ?>">
                                <?php echo e($user->name); ?>

                            </a>
                            <?php if($user->id == auth()->user()->id): ?>
                                <span class="ui <?php echo e($settings->color); ?> left pointing label"><?php echo e(__('app.you')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td data-title="<?php echo e(__('app.points')); ?>" class="right aligned">
                            <?php echo e($user->points); ?>

                            <?php if(!$user->closedTrades->isEmpty()): ?>
                                <span class="tooltip" data-tooltip="<?php echo e(__('app.profitable_trades')); ?>">
                                    <span class="ui tiny green basic label"><?php echo e($user->closedTrades->where('pnl', '>', 0)->count()); ?></span>
                                </span>
                                <span class="tooltip" data-tooltip="<?php echo e(__('app.unprofitable_trades')); ?>">
                                    <span class="ui tiny red basic label"><?php echo e($user->closedTrades->where('pnl', '<=', 0)->count()); ?></span>
                                </span>
                            <?php else: ?>
                                <span class="tooltip" data-tooltip="<?php echo e(__('app.no_closed_trades2')); ?>">
                                    <span class="ui tiny <?php echo e($settings->color); ?> basic label">0</span>
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="right aligned column">
            <?php echo e($users->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>