<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo e(asset('js/manifest.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('vendor/vendor.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('vendor/semantic/semantic.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/variables.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php if(config('settings.adsense_client_id') && (config('settings.adsense_top_slot_id') || config('settings.adsense_bottom_slot_id'))): ?>
    <script>
        <?php if(config('settings.adsense_top_slot_id') && config('settings.adsense_bottom_slot_id')): ?>
            // 2 ad slots
            var adsbygoogle = [{}, {}];
        <?php else: ?>
            // 1 ad slot
            var adsbygoogle = [{}];
        <?php endif; ?>
    </script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<?php endif; ?>
<?php if(!$cookie_usage_accepted): ?>
    <script type="text/javascript" src="<?php echo e(asset('js/cookie.js')); ?>"></script>
<?php endif; ?>
<?php echo $__env->yieldPushContent('scripts'); ?>