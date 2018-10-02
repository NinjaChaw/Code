<th class="<?php echo e(isset($class) ? $class : ''); ?>">
    <?php if($id == $sort): ?>
        <i class="angle <?php echo e($order == 'asc' ? 'up' : 'down'); ?> icon"></i>
    <?php endif; ?>
    <a href="<?php echo e(route(Route::currentRouteName(), array_merge(request()->route()->parameters, ['sort' => $id, 'order' => $id != $sort ? 'asc' : ($order == 'asc'  ? 'desc' : 'asc')]))); ?>">
        <?php echo e($slot); ?>

    </a>
</th>