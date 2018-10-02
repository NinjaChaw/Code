<?php $__env->startSection('title'); ?>
    <?php echo e(__('app.dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui stackable grid container">
        <div class="ten wide column">
            <h2 class="ui <?php echo e($settings->color); ?> dividing header">
                <?php echo e(__('app.top_traded')); ?>

            </h2>
            <div class="ui equal width stackable grid">
                <?php if($top_traded_assets->isEmpty()): ?>
                    <div class="column">
                        <div class="ui segment">
                            <p><?php echo e(__('app.no_open_trades')); ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php $__currentLoopData = $top_traded_assets->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top_traded_assets_chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                            <?php $__currentLoopData = $top_traded_assets_chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="center aligned column">
                                    <div class="ui <?php echo e($inverted); ?> segment">
                                        <div class="ui small <?php echo e($inverted); ?> statistic">
                                            <div>
                                                <img src="<?php echo e($asset->logo_url); ?>">
                                            </div>
                                            <div class="value">
                                                <?php echo e($asset->symbol); ?>

                                            </div>
                                            <div class="label">
                                                <?php echo e($asset->_trades_count); ?>

                                                <?php echo e(__('app.trades')); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <h2 class="ui <?php echo e($settings->color); ?> dividing header">
                <?php echo e(__('app.top_traders')); ?>

            </h2>
            <div class="ui equal width stackable grid">
                <?php if($top_traders->isEmpty()): ?>
                    <div class="column">
                        <div class="ui segment">
                            <p><?php echo e(__('app.no_closed_trades')); ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php $__currentLoopData = $top_traders->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top_traders_chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                            <?php $__currentLoopData = $top_traders_chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trader): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="column">
                                <div class="ui cards">
                                    <div class="top-trader card">
                                        <div class="content">
                                            <a href="<?php echo e(route('frontend.users.show', $trader->user)); ?>">
                                                <img class="right floated mini ui image" src="<?php echo e($trader->user->avatar_url); ?>">
                                            </a>
                                            <div class="header">
                                                <?php echo e($trader->user->name); ?>

                                            </div>
                                            <div class="meta">
                                                <?php echo e(__('app.joined')); ?>

                                                <?php echo e($trader->user->append('created_at')->created_at->diffForHumans()); ?>

                                            </div>
                                            <div class="description">
                                                <span class="ui circular <?php echo e($settings->color); ?> label"><?php echo e($trader->profitable_trades); ?></span>
                                                <?php echo e(__('app.profitable_trades')); ?>

                                            </div>
                                        </div>
                                        <div class="extra content">
                                            <div class="ui two buttons">
                                                <a href="<?php echo e(route('frontend.users.show', $trader->user)); ?>" class="ui basic <?php echo e($settings->color); ?> button"><?php echo e(__('app.view_profile')); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="six wide column">
            <h2 class="ui <?php echo e($settings->color); ?> dividing header">
                <?php echo e(__('app.top_trades')); ?>

            </h2>
            <div class="ui one column stackable grid">
                <?php if($top_trades->isEmpty()): ?>
                    <div class="column">
                        <div class="ui segment">
                            <p><?php echo e(__('app.no_closed_trades')); ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="column">
                        <div class="ui large feed">
                            <?php $__currentLoopData = $top_trades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top_trade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="event">
                                    <div class="label">
                                        <a href="<?php echo e(route('frontend.users.show', $top_trade->user)); ?>">
                                            <img src="<?php echo e($top_trade->user->avatar_url); ?>">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <div class="date">
                                            <?php echo e(__('app.closed_at')); ?>

                                            <?php echo e($top_trade->closed_at->diffForHumans()); ?>

                                        </div>
                                        <div class="content">
                                            <i class="arrow <?php echo e($top_trade->direction == \App\Models\Trade::DIRECTION_BUY ? 'up green' : 'down red'); ?> icon"></i>
                                            <span class="ui <?php echo e($top_trade->direction == \App\Models\Trade::DIRECTION_BUY ? 'green' : 'red'); ?> tiny basic ">
                                                <?php echo e(__('app.trade_direction_' . $top_trade->direction)); ?>

                                            </span>
                                            <?php echo e($top_trade->lot_size); ?> x <?php echo e($top_trade->volume); ?> <img class="ui avatar asset image" src="<?php echo e($top_trade->asset->logo_url); ?>"> <b><?php echo e($top_trade->asset->symbol); ?></b>
                                        </div>
                                        <div class="content">
                                            <span class="ui right pointing <?php echo e($settings->color); ?> basic label"><?php echo e(__('app.profit')); ?></span>
                                            <span class="tooltip" data-tooltip="<?php echo e(__('app.open_price')); ?>: <?php echo e($top_trade->_price_open); ?>, <?php echo e(__('app.close_price')); ?>: <?php echo e($top_trade->_price_close); ?>" <?php echo e($inverted ? 'data-inverted="false"' : ''); ?>>
                                                <?php echo e($top_trade->_pnl); ?> <?php echo e($top_trade->currency->code); ?>

                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui divider"></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <h2 class="ui <?php echo e($settings->color); ?> dividing header">
                <?php echo e(__('app.my_competitions')); ?>

            </h2>
            <div class="ui one column stackable grid">
                <?php if($my_competitions->isEmpty()): ?>
                    <div class="column">
                        <div class="ui segment">
                            <p><?php echo e(__('app.no_competitions_joined')); ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="column">
                        <table class="ui basic <?php echo e($inverted); ?> table">
                            <tbody>
                                <?php $__currentLoopData = $my_competitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="tablet-and-below-center">
                                            <a href="<?php echo e(route('frontend.competitions.show', $competition)); ?>">
                                                <?php echo e($competition->title); ?>

                                            </a>
                                            (<?php echo e(__('app.competition_status_' . $competition->status)); ?>)
                                        </td>
                                        <td class="right aligned tablet-and-below-center">
                                            <a class="ui small basic <?php echo e($settings->color); ?> icon submit button" href="<?php echo e(route('frontend.competitions.show', $competition)); ?>">
                                                <i class="eye icon"></i>
                                                <?php echo e(__('app.view')); ?>

                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>