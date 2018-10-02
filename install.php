<?php
if (file_exists(__DIR__ . '/storage/installed')) {
    header('Location: /');
    exit;
}

$errors = [];

if (!version_compare(phpversion(), '7.0.0', 'ge'))
    $errors[] = 'PHP <b>7.0.0</b> or higher should be installed.';

foreach(['openssl','pdo','mbstring','tokenizer','xml','curl'] as $extension)
    if (!extension_loaded($extension))
        $errors[] = sprintf('PHP extension <b>%s</b> should be loaded.', $extension);

foreach(['public',
        'storage',
        'storage/app/public/assets',
        'storage/app/public/avatars',
        'storage/framework',
        'storage/framework/cache',
        'storage/framework/cache/data',
        'storage/framework/sessions',
        'storage/framework/views',
        'storage/logs',
        'bootstrap/cache'] as $folder)
    if (!is_writable(__DIR__ . DIRECTORY_SEPARATOR . $folder))
        $errors[] = sprintf('Folder <b>%s</b> should be writable', $folder);

if (!is_writable(__DIR__))
    $errors[] = 'Folder <b>..</b> (web root) should be writable';

if (!file_exists('.env.install'))
    $errors[] = 'Please check that <b>.env.install</b> file exists in the web root folder.';

if (in_array('set_time_limit', explode(',', ini_get('disable_functions'))))
    $errors[] = 'PHP function <b>set_time_limit</b> should be enabled.';

if (empty($errors)) {
    header('Location: /install/1');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Installation</title>
    <link rel="stylesheet" type="text/css" href="public/vendor/semantic/semantic.min.css">
</head>
<body class="{{ str_replace('.','-',Route::currentRouteName()) }} color-{{ $settings->color }}">
    <div class="ui basic segment">
        <div class="ui one column stackable grid container">
            <div class="column">
                <h1 class="ui teal dividing header">Installation</h1>
            </div>
            <div class="column">
                <h2 class="ui teal header"><i class="cogs icon"></i> System requirements</h2>
                <div class="ui error message">
                    <div class="header">
                        Please resolve the following issues before proceeding with installation:
                    </div>
                    <ul class="list">
                        <?php foreach ($errors as $error):?>
                            <li><?php print $error?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>