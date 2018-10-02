<?php $__env->startSection('title'); ?>
    <?php echo e($user->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui stackable equal width grid container">
        <div class="five wide column">
            <div class="ui cards">
            <div class="ui card">
                <div class="image">
                    <div class="ui <?php echo e($settings->color); ?> right ribbon label">
                        <i class="star icon"></i> <?php echo e(__('app.rank')); ?> <?php echo e($user->rank); ?>

                    </div>
                    <img src="<?php echo e($user->avatar_url); ?>">
                </div>
                <div class="content">
                    <div class="header"><?php echo e($user->name); ?></div>
                    <div class="meta">
                        <i class="calendar outline icon"></i>
                        <?php echo e(__('users.joined')); ?> <?php echo e($user->created_at->diffForHumans()); ?>

                    </div>
                </div>
                <?php if(auth()->user()->id == $user->id): ?>
                    <div class="extra content">
                        <a class="ui basic <?php echo e($settings->color); ?> button" href="<?php echo e(route('frontend.users.edit', $user)); ?>"><?php echo e(__('users.edit')); ?></a>
                    </div>
                <?php endif; ?>
            </div>
            </div>
        </div>
        <div class="eleven wide column">
            <div id="user-stats" class="ui equal width stackable grid">
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
            <div class="ui stackable grid">
                <div class="column">
                    <h2 class="ui <?php echo e($settings->color); ?> dividing header"><?php echo e(__('app.recent_trades')); ?></h2>
                    <?php if($recent_trades->isEmpty()): ?>
                        <div class="ui segment">
                            <p><?php echo e(__('app.trades_empty')); ?></p>
                        </div>
                    <?php else: ?>
                        <div class="ui large feed">
                            <?php $__currentLoopData = $recent_trades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent_trade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="event">
                                    <div class="label">
                                        <div class="tooltip" data-tooltip="<?php echo e($recent_trade->asset->name); ?>" <?php echo e($inverted ? 'data-inverted="false"' : ''); ?>>
                                            <img src="<?php echo e($recent_trade->asset->logo_url); ?>">
                                        </div>
                                    </div>
                                    <div class="content">
                                        <div class="date">
                                            <?php echo e($recent_trade->created_at->diffForHumans()); ?>

                                        </div>
                                        <div class="content">
                                            <i class="arrow <?php echo e($recent_trade->direction == \App\Models\Trade::DIRECTION_BUY ? 'up green' : 'down red'); ?> icon"></i>
                                            <span class="ui <?php echo e($recent_trade->direction == \App\Models\Trade::DIRECTION_BUY ? 'green' : 'red'); ?> tiny basic ">
                                                <?php echo e(__('app.trade_direction_' . $recent_trade->direction)); ?>

                                            </span>
                                            <?php echo e($recent_trade->_lot_size); ?> x <?php echo e($recent_trade->_volume); ?> <b><?php echo e($recent_trade->asset->symbol); ?></b> (<?php echo e($recent_trade->asset->name); ?>) @ <?php echo e($recent_trade->_price_open); ?> <?php echo e($recent_trade->currency->code); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="ui divider"></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>