<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// images generation route
if (config('settings.image_url_generation') == 'route') {
    Route::get('storage/images/{type}/{image}', function ($type, $image) {
        try {
            $image = Storage::get($type . '/' . $image);
        } catch (Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
            abort(404);
        }

        return Image::make($image)->response();
    })->name('assets.image');
}

// Auth routes
Auth::routes();

// Social login
Route::prefix('login')
    ->name('login.')
    ->namespace('Auth')
    ->middleware('guest','social')
    ->group(function () {
        Route::get('{provider}', 'SocialLoginController@redirect');
        Route::get('{provider}/callback', 'SocialLoginController@сallback');
});


// Frontend routes (public)
Route::name('frontend.')
    ->namespace('Frontend')
    ->middleware('cookie-consent')
    ->group(function () {
        Route::get('/', 'PageController@index')->name('index');
        Route::get('page/{slug}', 'PageController@display');
        Route::post('cookie/accept', 'PageController@acceptCookies');
});

// Frontend routes (logged in users)
Route::name('frontend.')
    ->namespace('Frontend')
    ->middleware('auth','cookie-consent')
    ->group(function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::resource('users', 'UserController',  ['only' => ['show','edit','update']]);
        Route::resource('competitions', 'CompetitionController', ['only' => ['index','show']]);
        Route::post('competitions/{competition}/join', 'CompetitionController@join')->name('competitions.join');
        Route::post('competitions/{competition}/assets/{asset}/trade', 'CompetitionController@openTrade')->name('competitions.trade.open');
        Route::post('competitions/{competition}/trades/{trade}/close', 'CompetitionController@closeTrade')->name('competitions.trade.close');
        Route::get('competitions/{competition}/history', 'CompetitionController@history')->name('competitions.history');
        Route::get('competitions/{competition}/leaderboard', 'CompetitionController@leaderboard')->name('competitions.leaderboard');
        Route::get('competitions/{competition}/trades', 'CompetitionController@trades')->name('competitions.trades');
        Route::get('competitions/{competition}/participants', 'CompetitionController@participants')->name('competitions.participants');
        Route::get('assets', 'AssetController@index')->name('assets.index');
        Route::get('assets/search/{query}', 'AssetController@search')->name('assets.search');
        Route::get('assets/{asset}/info', 'AssetController@infoSingle')->name('assets.info.single');
        Route::post('assets/info', 'AssetController@infoMany')->name('assets.info.many');
        Route::post('assets/{asset}/remember', 'AssetController@remember')->name('assets.remember');
        Route::get('rankings', 'RankingController@index')->name('rankings');
        Route::post('locale/{locale}/remember', 'LocaleController@remember')->name('locale.remember');
        Route::get('help', 'PageController@help')->name('help');
});

// Pass some config variables and translations strings to the client side via variables.js
// read more: https://medium.com/@serhii.matrunchyk/using-laravel-localization-with-javascript-and-vuejs-23064d0c210e
Route::get('js/variables.js', function () {
    $variables = Cache::rememberForever('variables.js', function () {
        $strings = require resource_path('lang/' . config('app.locale') . '/app.php');
        $config = [
            'number_decimal_point'              => config('settings.number_decimal_point'),
            'number_thousands_separator'        => config('settings.number_thousands_separator'),
            'assets_quotes_api'                 => config('settings.assets_quotes_api'),
            'assets_quotes_refresh_freq'        => config('settings.assets_quotes_refresh_freq'),
        ];

        return 'var cfg = ' . json_encode(['settings' => $config]) . '; var i18n = ' . json_encode(['app' => $strings]) . ';';
    });
    return $variables;
})->name('assets.i18n');

// Backend routes
Route::prefix('admin')
    ->name('backend.')
    ->namespace('Backend')
    ->middleware('auth','role:' . App\Models\User::ROLE_ADMIN)
    ->group(function () {
        // admin dashoard
        Route::get('/', 'DashboardController@index')->name('dashboard');
        // assets management
        Route::resource('assets', 'AssetController', ['except' => ['show']]);
        Route::get('assets/{asset}/delete', 'AssetController@delete')->name('assets.delete');
        // users management
        Route::resource('users', 'UserController',  ['except' => ['create','store','show']]);
        Route::get('users/{user}/delete', 'UserController@delete')->name('users.delete');
        // competitions management
        Route::resource('competitions', 'CompetitionController',  ['except' => ['show']]);
        Route::get('competitions/{competition}/delete', 'CompetitionController@delete')->name('competitions.delete');
        // trades management
        Route::resource('trades', 'TradeController',  ['only' => ['index','edit']]);
        // add-ons
        Route::get('add-ons', 'AddonController@index')->name('addons.index');
        // settings
        Route::get('settings', 'SettingController@index')->name('settings.index');
        Route::post('settings', 'SettingController@update')->name('settings.update');
        // maintenance
        Route::get('maintenance', 'MaintenanceController@index')->name('maintenance.index');
        Route::post('maintenance/cache/clear', 'MaintenanceController@cache')->name('maintenance.cache');
        Route::post('maintenance/migrate', 'MaintenanceController@migrate')->name('maintenance.migrate');
        Route::post('maintenance/cron', 'MaintenanceController@cron')->name('maintenance.cron');
        Route::post('maintenance/cron/assets-market-data', 'MaintenanceController@cronAssetsMarketData')->name('maintenance.cron_assets_market_data');
        Route::post('maintenance/cron/currencies-market-data', 'MaintenanceController@cronCurrenciesMarketData')->name('maintenance.cron_currencies_market_data');
        // badge
        Route::get('badges', 'BadgeController@index')->name('badge.index');
        Route::get('badges/create', 'BadgeController@create')->name('badges.create');
        Route::post('badges/store', 'BadgeController@store')->name('badges.store');
        Route::get('badges/edit/{id}', 'BadgeController@edit')->name('badge.edit');
        Route::post('badge/update/{id}', 'BadgeController@update')->name('badge.update');
});

// Installation
Route::prefix('install')
    ->name('install.')
    ->namespace('Install')
    ->middleware('install')
    ->group(function () {
        Route::get('1', 'InstallationController@step1')->name('step1');
        Route::post('db', 'InstallationController@db')->name('db');
        Route::get('2', 'InstallationController@step2')->name('step2');
        Route::post('3', 'InstallationController@step3')->name('step3');
        Route::post('4', 'InstallationController@step4')->name('step4');
});