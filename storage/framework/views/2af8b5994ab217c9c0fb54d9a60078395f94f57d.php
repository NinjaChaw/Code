<?php $__env->startSection('title'); ?>
    <?php echo e(__('app.competitions')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui one column stackable grid container">
        <div class="column">
            <?php if (\Illuminate\Support\Facades\Blade::check('env', 'demo')): ?>
                <div class="ui info message">
                    <div class="header">
                        Demo environment notice
                    </div>
                    <p>
                        Please note that accounts, deposits, withdrawals and cash competitions functionality is <b>not</b> included into
                        Crypto Trading Competitions application package by default. This functionality can be purchased and installed
                        as an extra add-on.
                    </p>
                </div>
            <?php endif; ?>
            <?php if($competitions->isEmpty()): ?>
                <div class="ui segment">
                    <p><?php echo e(__('app.competitions_empty')); ?></p>
                </div>
            <?php else: ?>
                <table class="ui selectable tablet stackable <?php echo e($inverted); ?> table">
                    <thead>
                    <tr>
                        <th></th>
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
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $competitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="left aligned">
                                <?php if($competition->fee > 0): ?>
                                    <a class="ui <?php echo e($settings->color); ?> ribbon popup-trigger label">
                                        <i class="dollar icon"></i>
                                        <?php echo e(__('app.cash_prizes')); ?>

                                    </a>
                                    <?php $__env->startComponent('components.popups.payout', ['competition' => $competition]); ?>
                                    <?php echo $__env->renderComponent(); ?>
                                <?php endif; ?>
                            </td>
                            <td data-title="<?php echo e(__('app.title')); ?>">
                                <a href="<?php echo e(route('frontend.competitions.show', $competition)); ?>">
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
                                <?php elseif($competition->status==\App\Models\Competition::STATUS_IN_PROGRESS): ?>
                                    <i class="spinner loading icon"></i>
                                <?php endif; ?>
                                <?php echo e(__('app.competition_status_' . $competition->status)); ?>

                                <?php if($competition->status==\App\Models\Competition::STATUS_OPEN): ?>
                                    <span data-tooltip="<?php echo e(trans_choice('app.competition_participants_left', $competition->slots_required, ['n' => $competition->slots_required])); ?>">
                                        <i class="question circle outline tooltip icon"></i>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="right mobile-center aligned">
                                <?php if(!$competition->is_participant && (new \App\Rules\UserCanJoinCompetition($competition, auth()->user()))->passes()): ?>
                                    <form action="<?php echo e(route('frontend.competitions.join', $competition)); ?>" method="POST">
                                        <?php echo e(csrf_field()); ?>

                                        <button class="ui small basic <?php echo e($settings->color); ?> icon submit button">
                                            <i class="checkmark icon"></i>
                                            <?php echo e($competition->fee > 0 ? __('app.join_for', ['fee' => $competition->_fee, 'ccy' => $competition->currency->code]) : __('app.join')); ?>

                                        </button>
                                    </form>
                                <?php else: ?>
                                    <a class="ui small basic <?php echo e($settings->color); ?> icon submit button" href="<?php echo e(route('frontend.competitions.show', $competition)); ?>">
                                        <i class="eye icon"></i>
                                        <?php echo e(__('app.view')); ?>

                                    </a>
                                <?php endif; ?>
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
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>