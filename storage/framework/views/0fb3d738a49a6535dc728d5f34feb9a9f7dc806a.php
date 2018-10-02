<?php $__env->startSection('title'); ?>
    <?php echo e(__('settings.settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui one column stackable grid container">
        <div class="column">
            <form class="ui <?php echo e($inverted); ?> form" method="POST" action="<?php echo e(route('backend.settings.update')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="ui <?php echo e($inverted ? 'inverted' : 'styled'); ?> fluid accordion">
                    <div class="title">
                        <i class="dropdown icon"></i>
                        <?php echo e(__('settings.main')); ?>

                    </div>
                    <div class="content">
                        <div class="field">
                            <label><?php echo e(__('settings.background')); ?></label>
                            <div id="background-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="BACKGROUND">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    <?php $__currentLoopData = $backgrounds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $background): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item" data-value="<?php echo e($background); ?>">
                                            <?php echo e(__('settings.color_'.$background)); ?>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.color')); ?></label>
                            <div id="color-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="COLOR">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item" data-value="<?php echo e($color); ?>">
                                            <i class="<?php echo e($color); ?> square full icon"></i>
                                            <?php echo e(__('settings.color_'.$color)); ?>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.default_locale')); ?></label>
                            <div id="locale-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="LOCALE">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item" data-value="<?php echo e($code); ?>">
                                            <i class="<?php echo e($locale->flag); ?> flag"></i>
                                            <?php echo e($locale->name); ?>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label><?php echo e(__('app.currency')); ?></label>
                            <div id="currency-dropdown" class="ui selection search dropdown">
                                <input type="hidden" name="CURRENCY">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item" data-value="<?php echo e($currency->code); ?>"><?php echo e($currency->code); ?> &mdash; <?php echo e($currency->name); ?></div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="title">
                        <i class="dropdown icon"></i>
                        <?php echo e(__('settings.number_formatting')); ?>

                    </div>
                    <div class="content">
                        <div class="field">
                            <label><?php echo e(__('settings.number_decimals')); ?></label>
                            <div id="number-decimals-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="NUMBER_DECIMALS">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    <?php $__currentLoopData = [0,1,2,3,4,5,6,7,8]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $digit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item">
                                            <?php echo e($digit); ?>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.number_decimal_point')); ?></label>
                            <div id="number-decimal-point-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="NUMBER_DECIMAL_POINT">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    <?php $__currentLoopData = $separators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $separator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item" data-value="<?php echo e($code); ?>">
                                            <?php echo e($separator); ?>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.number_thousands_separator')); ?></label>
                            <div id="number-thousands-separator-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="NUMBER_THOUSANDS_SEPARATOR">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    <?php $__currentLoopData = $separators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $separator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item" data-value="<?php echo e($code); ?>">
                                            <?php echo e($separator); ?>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="title">
                        <i class="dropdown icon"></i>
                        <?php echo e(__('settings.email')); ?>

                    </div>
                    <div class="content">
                        <div class="field">
                            <label><?php echo e(__('settings.mail_driver')); ?></label>
                            <div id="mail-driver-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="MAIL_DRIVER">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    <div class="item">smtp</div>
                                    <div class="item">sendmail</div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.smtp_server')); ?></label>
                            <input type="text" name="MAIL_HOST" value="<?php echo e(config('mail.host')); ?>">
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.smtp_port')); ?></label>
                            <input type="text" name="MAIL_PORT" value="<?php echo e(config('mail.port')); ?>">
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.smtp_mail_from')); ?></label>
                            <input type="text" name="MAIL_FROM_ADDRESS" value="<?php echo e(config('mail.from.address')); ?>">
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.smtp_username')); ?></label>
                            <input type="text" name="MAIL_USERNAME" value="<?php echo e(config('mail.username')); ?>">
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.smtp_password')); ?></label>
                            <input type="password" name="MAIL_PASSWORD" value="<?php echo e(config('mail.password')); ?>">
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.smtp_encryption')); ?></label>
                            <div id="mail-encryption-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="MAIL_ENCRYPTION">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    <div class="item" data-value=""><?php echo e(__('settings.none')); ?></div>
                                    <div class="item" data-value="tls">TLS</div>
                                    <div class="item" data-value="ssl">SSL</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="title">
                        <i class="dropdown icon"></i>
                        <?php echo e(__('settings.points_system')); ?>

                    </div>
                    <div class="content">
                        <div class="field">
                            <label><?php echo e(__('settings.points_type_trade_loss')); ?></label>
                            <input type="text" name="POINTS_TYPE_TRADE_LOSS" value="<?php echo e(config('settings.points_type_trade_loss')); ?>">
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.points_type_trade_profit')); ?></label>
                            <input type="text" name="POINTS_TYPE_TRADE_PROFIT" value="<?php echo e(config('settings.points_type_trade_profit')); ?>">
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.points_type_competition_join')); ?></label>
                            <input type="text" name="POINTS_TYPE_COMPETITION_JOIN" value="<?php echo e(config('settings.points_type_competition_join')); ?>">
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.points_type_competition_place1')); ?></label>
                            <input type="text" name="POINTS_TYPE_COMPETITION_PLACE1" value="<?php echo e(config('settings.points_type_competition_place1')); ?>">
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.points_type_competition_place2')); ?></label>
                            <input type="text" name="POINTS_TYPE_COMPETITION_PLACE2" value="<?php echo e(config('settings.points_type_competition_place2')); ?>">
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.points_type_competition_place3')); ?></label>
                            <input type="text" name="POINTS_TYPE_COMPETITION_PLACE3" value="<?php echo e(config('settings.points_type_competition_place3')); ?>">
                        </div>
                    </div>
                    <div class="title">
                        <i class="dropdown icon"></i>
                        <?php echo e(__('settings.integration')); ?>

                    </div>
                    <div class="content">
                        <div class="field">
                            <label><?php echo e(__('settings.openexchangerates_api_key')); ?></label>
                            <input type="text" name="OPENEXCHANGERATES_API_KEY" value="<?php echo e(config('settings.openexchangerates_api_key')); ?>" placeholder="8d35458771084ae391be6959d1c4d10f">
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.gtm_container_id')); ?></label>
                            <input type="text" name="GTM_CONTAINER_ID" value="<?php echo e(config('settings.gtm_container_id')); ?>" placeholder="GTM-XXXXXXX">
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.adsense_client_id')); ?></label>
                            <input type="text" name="ADSENSE_CLIENT_ID" value="<?php echo e(config('settings.adsense_client_id')); ?>" placeholder="ca-pub-1234567890">
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.adsense_top_slot_id')); ?></label>
                            <input type="text" name="ADSENSE_TOP_SLOT_ID" value="<?php echo e(config('settings.adsense_top_slot_id')); ?>" placeholder="505123456">
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.adsense_bottom_slot_id')); ?></label>
                            <input type="text" name="ADSENSE_BOTTOM_SLOT_ID" value="<?php echo e(config('settings.adsense_bottom_slot_id')); ?>" placeholder="505123456">
                        </div>
                        <?php $__currentLoopData = ['facebook','google','twitter','linkedin']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="field">
                                <label><?php echo e(__('settings.social_'.$provider.'_client_id')); ?></label>
                                <input type="text" name="<?php echo e(strtoupper($provider)); ?>_CLIENT_ID" value="<?php echo e(config('services.'.$provider.'.client_id')); ?>">
                            </div>
                            <div class="field">
                                <label><?php echo e(__('settings.social_'.$provider.'_client_secret')); ?></label>
                                <input type="text" name="<?php echo e(strtoupper($provider)); ?>_CLIENT_SECRET" value="<?php echo e(config('services.'.$provider.'.client_secret')); ?>">
                            </div>
                            <div class="disabled field">
                                <label><?php echo e(__('settings.social_'.$provider.'_redirect')); ?></label>
                                <input type="text" value="<?php echo e(config('services.'.$provider.'.redirect')); ?>">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="field">
                            <label><?php echo e(__('settings.assets_api_type')); ?></label>
                            <div id="assets-api-type-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="ASSETS_QUOTES_API">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    <?php $__currentLoopData = $api_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $api_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item" data-value="<?php echo e($api_type); ?>">
                                            <?php echo e(__('settings.assets_api_type_'.$api_type)); ?>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="title">
                        <i class="dropdown icon"></i>
                        <?php echo e(__('settings.developer')); ?>

                    </div>
                    <div class="content">
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="hidden" name="APP_DEBUG" value="false">
                                <input type="checkbox" name="APP_DEBUG" <?php echo e(config('app.debug') ? 'checked="checked"' : ''); ?> tabindex="0" class="hidden" value="true">
                                <label><?php echo e(__('settings.debug')); ?></label>
                            </div>
                        </div>
                        <div class="field">
                            <label><?php echo e(__('settings.log_level')); ?></label>
                            <div id="log-level-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="APP_LOG_LEVEL">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    <?php $__currentLoopData = $log_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log_level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item">
                                            <?php echo e($log_level); ?>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
                <div class="ui hidden divider"></div>
                <button class="ui large <?php echo e($settings->color); ?> submit button">
                    <i class="save icon"></i>
                    <?php echo e(__('settings.save')); ?>

                </button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $('#background-dropdown').dropdown('set selected', '<?php echo e(config('settings.background')); ?>');
        $('#color-dropdown').dropdown('set selected', '<?php echo e(config('settings.color')); ?>');
        $('#locale-dropdown').dropdown('set selected', '<?php echo e(env('LOCALE', 'en')); ?>');
        $('#currency-dropdown').dropdown('set selected', '<?php echo e(config('settings.currency')); ?>');
        $('#mail-driver-dropdown').dropdown('set selected', '<?php echo e(config('mail.driver')); ?>');
        $('#mail-encryption-dropdown').dropdown('set selected', '<?php echo e(config('mail.encryption')); ?>');
        $('#number-decimals-dropdown').dropdown('set selected', '<?php echo e(config('settings.number_decimals')); ?>');
        $('#number-decimal-point-dropdown').dropdown('set selected', '<?php echo e(config('settings.number_decimal_point')); ?>');
        $('#number-thousands-separator-dropdown').dropdown('set selected', '<?php echo e(config('settings.number_thousands_separator')); ?>');
        $('#log-level-dropdown').dropdown('set selected', '<?php echo e(config('app.log_level')); ?>');
        $('#assets-api-type-dropdown').dropdown('set selected', '<?php echo e(config('settings.assets_quotes_api')); ?>');
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>