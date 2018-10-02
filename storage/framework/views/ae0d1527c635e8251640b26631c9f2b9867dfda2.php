<?php if(Route::currentRouteName()=='frontend.index'): ?>
    <title><?php echo e(__('app.app_name')); ?> | <?php echo e(__('app.app_slogan')); ?></title>
<?php else: ?>
    <title><?php echo e(__('app.app_name')); ?> | <?php echo $__env->yieldContent('title'); ?></title>
<?php endif; ?>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="<?php echo e(__('app.meta_description')); ?>" />
<meta name="keywords" content="<?php echo e(__('app.meta_keywords')); ?>" />
<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('images/favicon/apple-touch-icon.png')); ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('images/favicon/favicon-32x32.png')); ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('images/favicon/favicon-16x16.png')); ?>">
<link rel="manifest" href="<?php echo e(asset('images/favicon/site.webmanifest')); ?>">
<link rel="mask-icon" href="<?php echo e(asset('images/favicon/safari-pinned-tab.svg')); ?>" color="#5bbad5">
<link rel="shortcut icon" href="<?php echo e(asset('images/favicon/favicon.ico')); ?>">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-config" content="<?php echo e(asset('images/favicon/browserconfig.xml')); ?>">
<meta name="theme-color" content="#ffffff">
<!-- END Favicon -->
<!--Open Graph tags-->
<meta property="og:url" content="<?php echo e(url()->full()); ?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php echo e(__('app.app_name')); ?>" />
<meta property="og:description" content="<?php echo e(__('app.meta_description')); ?>" />
<meta property="og:image" content="<?php echo e(asset('images/og-image.jpg')); ?>" />
<!--END Open Graph tags-->
<?php echo $__env->renderWhen(config('settings.gtm_container_id'), 'includes.frontend.gtm-head', array_except(get_defined_vars(), array('__data', '__path'))); ?>
<?php echo $__env->make('includes.frontend.styles', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>