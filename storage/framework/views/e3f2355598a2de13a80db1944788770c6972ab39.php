<?php $__env->startSection('title'); ?>
    <?php echo e(__('app.assets')); ?> :: <?php echo e(__('app.create')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui one column stackable grid container">
        <div class="column">
            <div class="ui <?php echo e($inverted); ?> segment">
                <form class="ui <?php echo e($inverted); ?> form" method="POST" action="<?php echo e(route('backend.assets.store')); ?>" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <image-upload-input name="logo" default-image-url="<?php echo e(asset('images/asset.png')); ?>" class="<?php echo e($errors->has('logo') ? 'error' : ''); ?>" color="<?php echo e($settings->color); ?>">
                        <?php echo e(__('app.logo')); ?>

                    </image-upload-input>
                    <div class="field <?php echo e($errors->has('symbol') ? 'error' : ''); ?>">
                        <label><?php echo e(__('app.symbol')); ?></label>
                        <div class="ui input">
                            <input type="text" name="symbol" placeholder="<?php echo e(__('app.symbol')); ?>" value="<?php echo e(old('symbol')); ?>" required autofocus>
                        </div>
                    </div>
                    <div class="field <?php echo e($errors->has('name') ? 'error' : ''); ?>">
                        <label><?php echo e(__('app.name')); ?></label>
                        <div class="ui input">
                            <input type="text" name="name" placeholder="<?php echo e(__('app.name')); ?>" value="<?php echo e(old('name')); ?>" required autofocus>
                        </div>
                    </div>
                    <div class="field <?php echo e($errors->has('price') ? 'error' : ''); ?>">
                        <label><?php echo e(__('app.price')); ?></label>
                        <div class="ui input">
                            <input type="text" name="price" placeholder="<?php echo e(__('app.price')); ?>" value="<?php echo e(old('price')); ?>" required autofocus>
                        </div>
                    </div>
                    <div class="field <?php echo e($errors->has('change_abs') ? 'error' : ''); ?>">
                        <label><?php echo e(__('app.change_abs')); ?></label>
                        <div class="ui input">
                            <input type="text" name="change_abs" placeholder="<?php echo e(__('app.change_abs')); ?>" value="<?php echo e(old('change_abs')); ?>" required autofocus>
                        </div>
                    </div>
                    <div class="field <?php echo e($errors->has('change_pct') ? 'error' : ''); ?>">
                        <label><?php echo e(__('app.change_pct')); ?></label>
                        <div class="ui input">
                            <input type="text" name="change_pct" placeholder="<?php echo e(__('app.change_pct')); ?>" value="<?php echo e(old('change_pct')); ?>" required autofocus>
                        </div>
                    </div>
                    <div class="field <?php echo e($errors->has('volume') ? 'error' : ''); ?>">
                        <label><?php echo e(__('app.volume')); ?></label>
                        <div class="ui input">
                            <input type="text" name="volume" placeholder="<?php echo e(__('app.volume')); ?>" value="<?php echo e(old('volume')); ?>" required autofocus>
                        </div>
                    </div>
                    <div class="field <?php echo e($errors->has('supply') ? 'error' : ''); ?>">
                        <label><?php echo e(__('app.supply')); ?></label>
                        <div class="ui input">
                            <input type="text" name="supply" placeholder="<?php echo e(__('app.supply')); ?>" value="<?php echo e(old('supply')); ?>" required autofocus>
                        </div>
                    </div>
                    <div class="field <?php echo e($errors->has('market_cap') ? 'error' : ''); ?>">
                        <label><?php echo e(__('app.market_cap')); ?></label>
                        <div class="ui input">
                            <input type="text" name="market_cap" placeholder="<?php echo e(__('app.market_cap')); ?>" value="<?php echo e(old('market_cap')); ?>" required autofocus>
                        </div>
                    </div>
                    <button class="ui large <?php echo e($settings->color); ?> submit button">
                        <i class="save icon"></i>
                        <?php echo e(__('app.save')); ?>

                    </button>
                </form>
            </div>
        </div>
        <div class="column">
            <a href="<?php echo e(route('backend.assets.index')); ?>"><i class="left arrow icon"></i> <?php echo e(__('app.back_all_assets')); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>