<?php $__env->startSection('title'); ?>
    <?php echo e(__('users.users')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui one column stackable grid container">
        <div class="column">
            <table class="ui selectable tablet stackable <?php echo e($inverted); ?> table">
                <thead>
                <tr>
                    <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'id', 'sort' => $sort, 'order' => $order]); ?>
                        <?php echo e(__('users.id')); ?>

                    <?php echo $__env->renderComponent(); ?>
                    <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'name', 'sort' => $sort, 'order' => $order]); ?>
                        <?php echo e(__('users.name')); ?>

                    <?php echo $__env->renderComponent(); ?>
                    <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'email', 'sort' => $sort, 'order' => $order]); ?>
                        <?php echo e(__('users.email')); ?>

                    <?php echo $__env->renderComponent(); ?>
                    <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'status', 'sort' => $sort, 'order' => $order]); ?>
                        <?php echo e(__('users.status')); ?>

                    <?php echo $__env->renderComponent(); ?>
                    <?php $__env->startComponent('components.tables.sortable-column', ['id' => 'last_login_time', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned']); ?>
                        <?php echo e(__('users.last_login_time')); ?>

                    <?php echo $__env->renderComponent(); ?>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td data-title="<?php echo e(__('users.id')); ?>"><?php echo e($user->id); ?></td>
                        <td data-title="<?php echo e(__('users.name')); ?>">
                            <a href="<?php echo e(route('backend.users.edit', $user)); ?>">
                                <img class="ui avatar image" src="<?php echo e($user->avatar_url); ?>">
                                <?php echo e($user->name); ?>

                            </a>
                            <?php echo $user->role == App\Models\User::ROLE_ADMIN ? '<span class="ui basic tiny red label">' . __('users.role_'.$user->role) . '</span>' : ''; ?>

                            <?php if($user->profiles): ?>
                                <?php $__currentLoopData = $user->profiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="tooltip" data-tooltip="<?php echo e(__('app.profile_id')); ?>: <?php echo e($profile->provider_user_id); ?>">
                                        <i class="grey <?php echo e($profile->provider_name); ?> icon"></i>
                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </td>
                        <td data-title="<?php echo e(__('users.email')); ?>">
                            <a href="mailto:<?php echo e($user->email); ?>"><?php echo e($user->email); ?></a></td>
                        <td data-title="<?php echo e(__('users.status')); ?>"><i class="<?php echo e($user->status == App\Models\User::STATUS_ACTIVE ? 'check green' : 'red ban'); ?> large icon"></i> <?php echo e(__('users.status_' . $user->status)); ?></td>
                        <td data-title="<?php echo e(__('users.last_login_time')); ?>">
                            <?php echo e($user->last_login_time->diffForHumans()); ?>

                            <span data-tooltip="<?php echo e($user->last_login_time); ?>">
                                <i class="calendar outline tooltip icon"></i>
                            </span>
                        </td>
                        <td class="right aligned tablet-and-below-center">
                            <a class="ui icon <?php echo e($settings->color); ?> basic button" href="<?php echo e(route('backend.users.edit', $user)); ?>">
                                <i class="edit icon"></i>
                                <?php echo e(__('users.edit')); ?>

                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="right aligned column">
            <?php echo e($users->appends(['sort' => $sort])->appends(['order' => $order])->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>