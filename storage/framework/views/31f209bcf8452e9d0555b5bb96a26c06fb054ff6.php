<?php if($errors->any()): ?>
    <message :messages="<?php echo e(json_encode($errors->all())); ?>" class="negative">
        <?php echo e(__('app.error')); ?>

    </message>
<?php elseif(session('error')): ?>
    <message message="<?php echo e(session('error')); ?>" class="error">
        <?php echo e(__('app.error')); ?>

    </message>
<?php elseif(session('warning')): ?>
    <message message="<?php echo e(session('warning')); ?>" class="warning">
        <?php echo e(__('app.warning')); ?>

    </message>
<?php elseif(session('success')): ?>
    <message message="<?php echo e(session('success')); ?>" class="positive">
        <?php echo e(__('app.success')); ?>

    </message>
<?php elseif(session('status')): ?>
    <message message="<?php echo e(session('status')); ?>" class="info">
        <?php echo e(__('app.success')); ?>

    </message>
<?php endif; ?>