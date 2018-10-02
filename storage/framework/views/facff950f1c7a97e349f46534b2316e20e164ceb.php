<?php $__env->startSection('content'); ?>
    <div class="ui inverted vertical masthead center aligned segment">
        <div class="ui container">
            <div class="ui large secondary inverted pointing menu">
                <div class="right item">
                    <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>" class="ui inverted button"><?php echo e(__('auth.log_in')); ?></a>
                    <?php endif; ?>
                    <?php if(auth()->guard()->check()): ?>
                        <form class="ui form" method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <a href="<?php echo e(route('frontend.dashboard')); ?>" class="ui inverted button"><?php echo e(__('app.dashboard')); ?></a>
                            <button href="#" class="ui inverted button"><?php echo e(__('auth.logout')); ?></button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="ui text container">
            <h1 class="ui inverted header"><?php echo e(__('app.app_name')); ?></h1>
            <h2><?php echo e(__('app.app_slogan')); ?></h2>
            <a href="<?php echo e(route('register')); ?>" class="ui huge <?php echo e($settings->color); ?> button">
                <?php echo e(__('app.start_trading')); ?><i class="right arrow icon"></i>
            </a>
        </div>
    </div>

    <div class="ui vertical stripe segment">
        <div class="ui stackable three column grid center aligned container">
            <div class="column">
                <h3 class="ui center aligned <?php echo e($inverted); ?> icon header">
                    <i class="<?php echo e($inverted); ?> circular trophy <?php echo e($settings->color); ?> icon"></i>
                    <?php echo e(__('app.competitions')); ?>

                </h3>
                <p>
                    <?php echo e(__('app.front_text01')); ?>

                </p>
            </div>
            <div class="column">
                <h3 class="ui center aligned <?php echo e($inverted); ?> icon header">
                    <i class="<?php echo e($inverted); ?> circular chart area <?php echo e($settings->color); ?> icon"></i>
                    <?php echo e(__('app.trading')); ?>

                </h3>
                <p>
                    <?php echo e(__('app.front_text02')); ?>

                </p>
            </div>
            <div class="column">
                <h3 class="ui center aligned <?php echo e($inverted); ?> icon header">
                    <i class="<?php echo e($inverted); ?> circular star <?php echo e($settings->color); ?> icon"></i>
                    <?php echo e(__('app.rankings')); ?>

                </h3>
                <p>
                    <?php echo e(__('app.front_text03')); ?>

                </p>
            </div>
        </div>
    </div>

    <div class="ui vertical stripe segment">
        <div class="ui stackable grid container">
            <div class="row">
                <div class="eight wide column">
                    <h3 class="ui mobile-center <?php echo e($inverted); ?> header"><?php echo e(__('app.what_we_offer')); ?></h3>
                    <div class="ui list">
                        <div class="item">
                            <i class="large green checkmark icon"></i>
                            <div class="content">
                                <?php echo e(__('app.front_offer01')); ?>

                            </div>
                        </div>
                        <div class="item">
                            <i class="large green checkmark icon"></i>
                            <div class="content">
                                <?php echo e(__('app.front_offer02')); ?>

                            </div>
                        </div>
                        <div class="item">
                            <i class="large green checkmark icon"></i>
                            <div class="content">
                                <?php echo e(__('app.front_offer03')); ?>

                            </div>
                        </div>
                        <div class="item">
                            <i class="large green checkmark icon"></i>
                            <div class="content">
                                <?php echo e(__('app.front_offer04')); ?>

                            </div>
                        </div>
                        <div class="item">
                            <i class="large green checkmark icon"></i>
                            <div class="content">
                                <?php echo e(__('app.front_offer05')); ?>

                            </div>
                        </div>
                        <div class="item">
                            <i class="large green checkmark icon"></i>
                            <div class="content">
                                <?php echo e(__('app.front_offer06')); ?>

                            </div>
                        </div>
                        <div class="item">
                            <i class="large green checkmark icon"></i>
                            <div class="content">
                                <?php echo e(__('app.front_offer07')); ?>

                            </div>
                        </div>
                    </div>
                    <div class="ui hidden divider"></div>
                    <div class="mobile-center">
                        <a href="<?php echo e(route('register')); ?>" class="ui huge <?php echo e($settings->color); ?> button">
                            <?php echo e(__('app.try')); ?><i class="right arrow icon"></i>
                        </a>
                    </div>
                </div>
                <div class="eight wide column">
                    <img src="<?php echo e(asset('images/front-trading-terminal.png')); ?>">
                </div>
            </div>
        </div>
    </div>

    <?php if(!$recent_trades->isEmpty()): ?>
        <div class="ui basic stripe segment">
            <div class="ui stackable grid container">
                <div class="row">
                    <div class="six wide mobile-center column">
                        <img src="<?php echo e(asset('images/front-recent-trades.png')); ?>">
                    </div>
                    <div class="ten wide mobile-center column">
                        <h3 class="ui <?php echo e($inverted); ?> header"><?php echo e(__('app.trading_now')); ?></h3>
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
                        <div class="ui hidden divider"></div>
                        <a href="<?php echo e(route('register')); ?>" class="ui huge <?php echo e($settings->color); ?> button">
                            <?php echo e(__('app.join_competition')); ?><i class="right arrow icon"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>