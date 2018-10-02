<div id="header" class="ui container">
    <div class="ui equal width middle aligned grid">
        <div id="menu-top-bar" class="row">
            <div class="mobile only column">
                <!-- Mobile menu -->
                <div class="ui vertical icon <?php echo e($inverted); ?> menu">
                    <div class="ui left pointing dropdown icon item">
                        <i class="bars icon"></i>
                        <div class="ui stackable large menu">
                            <a href="<?php echo e(route('frontend.dashboard')); ?>" class="item <?php echo e(Route::currentRouteName()=='frontend.dashboard' ? 'active' : ''); ?>">
                                <i class="home icon"></i>
                                <?php echo e(__('app.dashboard')); ?>

                            </a>
                            <a href="<?php echo e(route('frontend.competitions.index')); ?>" class="item <?php echo e(strpos(Route::currentRouteName(),'frontend.competitions.')!==FALSE ? 'active' : ''); ?>">
                                <i class="trophy icon"></i>
                                <?php echo e(__('app.competitions')); ?>

                            </a>
                            <a href="<?php echo e(route('frontend.assets.index')); ?>" class="item <?php echo e(Route::currentRouteName()=='frontend.assets.index' ? 'active' : ''); ?>">
                                <i class="bitcoin icon"></i>
                                <?php echo e(__('app.coins')); ?>

                            </a>
                            <a href="<?php echo e(route('frontend.rankings')); ?>" class="item <?php echo e(Route::currentRouteName()=='frontend.rankings' ? 'active' : ''); ?>">
                                <i class="star icon"></i>
                                <?php echo e(__('app.rankings')); ?>

                            </a>
                            <a href="<?php echo e(route('frontend.help')); ?>" class="item <?php echo e(Route::currentRouteName()=='frontend.help' ? 'active' : ''); ?>">
                                <i class="question icon"></i>
                                <?php echo e(__('app.help')); ?>

                            </a>
                            <div class="item">
                                <div class="text">
                                    <img class="ui avatar image" src="<?php echo e(auth()->user()->avatar_url); ?>">
                                    <?php echo e(auth()->user()->name); ?>

                                </div>
                                <div class="menu">
                                    <?php if(auth()->user()->admin()): ?>
                                        <a href="<?php echo e(route('backend.dashboard')); ?>" class="item">
                                            <i class="setting icon"></i>
                                            <?php echo e(__('app.backend')); ?>

                                        </a>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('frontend.users.show', auth()->user())); ?>" class="item">
                                        <i class="user icon"></i>
                                        <?php echo e(__('users.profile')); ?>

                                    </a>

                                    

                                    <log-out-button token="<?php echo e(csrf_token()); ?>" class="item">
                                        <i class="sign out alternate icon"></i>
                                        <?php echo e(__('auth.logout')); ?>

                                    </log-out-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Mobile menu -->
            </div>
            <div class="tablet only computer only column">
                <h4>
                    <a href="<?php echo e(route('frontend.index')); ?>">
                        <img src="<?php echo e(asset('images/logo.png')); ?>" class="ui image">
                        <?php echo e(__('app.app_name')); ?>

                    </a>
                </h4>
            </div>
            <div class="right aligned column">
                <locale-select :locales="<?php echo e(json_encode($locale->locales())); ?>" :locale="<?php echo e(json_encode($locale->locale())); ?>"></locale-select>
            </div>
        </div>
        <div class="row">
            <div class="tablet only computer only column">
                <!-- Desktop menu -->
                <div class="ui stackable <?php echo e($inverted); ?> menu">
                    <a href="<?php echo e(route('frontend.dashboard')); ?>" class="item <?php echo e(Route::currentRouteName()=='frontend.dashboard' ? 'active' : ''); ?>">
                        <i class="home icon"></i>
                        <?php echo e(__('app.dashboard')); ?>

                    </a>
                    <a href="<?php echo e(route('frontend.competitions.index')); ?>" class="item <?php echo e(strpos(Route::currentRouteName(),'frontend.competitions.')!==FALSE ? 'active' : ''); ?>">
                        <i class="trophy icon"></i>
                        <?php echo e(__('app.competitions')); ?>

                    </a>
                    <a href="<?php echo e(route('frontend.assets.index')); ?>" class="item <?php echo e(Route::currentRouteName()=='frontend.assets.index' ? 'active' : ''); ?>">
                        <i class="bitcoin icon"></i>
                        <?php echo e(__('app.coins')); ?>

                    </a>
                    <a href="<?php echo e(route('frontend.rankings')); ?>" class="item <?php echo e(Route::currentRouteName()=='frontend.rankings' ? 'active' : ''); ?>">
                        <i class="star icon"></i>
                        <?php echo e(__('app.rankings')); ?>

                    </a>
                    <a href="<?php echo e(route('frontend.help')); ?>" class="item <?php echo e(Route::currentRouteName()=='frontend.help' ? 'active' : ''); ?>">
                        <i class="question icon"></i>
                    </a>
                    <div class="right menu">
                        <div class="ui item dropdown">
                            <div class="text">
                                <img class="ui avatar image" src="<?php echo e(auth()->user()->avatar_url); ?>">
                                <?php echo e(auth()->user()->name); ?>

                                <?php if(!empty(Auth::user()->points->first()->points)): ?>
                                    <?php if(!empty($badges)): ?>
                                        <?php $__currentLoopData = $badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(Auth::user()->points->first()->points >= $badge->points): ?>
                                                <img src="<?php echo e(asset('images/badges/'.$badge->avatar)); ?>" alt="Badge" height="25px" width="25px">
                                                <?php break; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <i class="dropdown icon"></i>
                            <div class="menu">
                                <?php if(auth()->user()->admin()): ?>
                                    <a href="<?php echo e(route('backend.dashboard')); ?>" class="item">
                                        <i class="setting icon"></i>
                                        <?php echo e(__('app.backend')); ?>

                                    </a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('frontend.users.show', auth()->user())); ?>" class="item">
                                    <i class="user icon"></i>
                                    <?php echo e(__('users.profile')); ?>

                                </a>

                                

                                <log-out-button token="<?php echo e(csrf_token()); ?>" class="item">
                                    <i class="sign out alternate icon"></i>
                                    <?php echo e(__('auth.logout')); ?>

                                </log-out-button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Desktop menu -->
            </div>
        </div>
    </div>
</div>