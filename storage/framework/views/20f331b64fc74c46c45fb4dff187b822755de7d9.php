<?php $__env->startSection('title'); ?>
    <?php echo e(__('auth.login')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('before-auth'); ?>
    <div id="particles"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('auth'); ?>
    <div class="ui middle aligned center aligned grid auth-form-container">
        <div class="column">
            <div class="ui segment">
                <h2 class="ui <?php echo e($settings->color); ?> image header">
                    <a href="<?php echo e(route('frontend.index')); ?>">
                        <img src="<?php echo e(asset('images/logo.png')); ?>" class="image">
                    </a>
                    <div class="content">
                        <?php echo e(__('app.app_name')); ?>

                        <div class="sub header"><?php echo e(__('auth.login_header')); ?></div>
                    </div>
                </h2>
                <?php $__env->startComponent('components.session.messages'); ?>
                <?php echo $__env->renderComponent(); ?>
                <loading-form v-cloak inline-template>
                    <form class="ui form" method="POST" action="<?php echo e(route('login')); ?>" @submit="disableButton">
                        <?php echo e(csrf_field()); ?>

                        <div class="field">
                            <div class="ui left icon input">
                                <i class="mail icon"></i>
                                <input type="email" name="email" placeholder="<?php echo e(__('auth.email')); ?>" value="<?php echo e(old('email')); ?>" required autofocus>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="key icon"></i>
                                <input type="password" name="password" placeholder="<?php echo e(__('auth.password')); ?>" required>
                            </div>
                        </div>
                        <div class="left aligned field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="remember" tabindex="0" class="hidden" <?php echo e(old('remember') ? 'checked="checked"' : ''); ?>>
                                <label><?php echo e(__('auth.remember')); ?></label>
                            </div>
                        </div>
                        <button :class="[{disabled: submitted, loading: submitted}, 'ui <?php echo e($settings->color); ?> fluid large submit button']"><?php echo e(__('auth.login')); ?></button>
                    </form>
                </loading-form>
                <?php if (\Illuminate\Support\Facades\Blade::check('social')): ?>
                    <div id="social-login-divider" class="ui horizontal divider">
                        <?php echo e(__('auth.social_login')); ?>

                    </div>
                    <div>
                        <?php if (\Illuminate\Support\Facades\Blade::check('social', 'facebook')): ?>
                            <a href="<?php echo e(url('login/facebook')); ?>" class="ui circular facebook icon button">
                                <i class="facebook icon"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (\Illuminate\Support\Facades\Blade::check('social', 'twitter')): ?>
                            <a href="<?php echo e(url('login/twitter')); ?>" class="ui circular twitter icon button">
                                <i class="twitter icon"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (\Illuminate\Support\Facades\Blade::check('social', 'linkedin')): ?>
                            <a href="<?php echo e(url('login/linkedin')); ?>" class="ui circular linkedin icon button">
                                <i class="linkedin icon"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (\Illuminate\Support\Facades\Blade::check('social', 'google')): ?>
                            <a href="<?php echo e(url('login/google')); ?>" class="ui circular google plus icon button">
                                <i class="google plus icon"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="ui message">
                <div><?php echo e(__('auth.sign_up_question')); ?> <a href="<?php echo e(route('register')); ?>"><?php echo e(__('auth.sign_up')); ?></a></div>
                <div class="ui divider"></div>
                <div><?php echo e(__('auth.forgot_password')); ?> <a href="<?php echo e(route('password.request')); ?>"><?php echo e(__('auth.reset')); ?></a></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/auth.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>