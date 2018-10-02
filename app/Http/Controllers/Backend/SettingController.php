<?php

namespace App\Http\Controllers\Backend;

use App\Events\BeforeSettingsSaved;
use App\Models\Currency;
use App\Services\DotEnvService;
use App\Services\LocaleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index(Request $request) {
        $locale = new LocaleService();
        $locales = $locale->locales();
        $currencies = Currency::get();
        $backgrounds = ['white','black'];
        $colors = ['red','orange','yellow','olive','green','teal','blue','violet','purple','pink','brown','grey','black'];
        $logLevels = ['debug', 'info', 'notice', 'warning', 'error', 'critical', 'alert', 'emergency'];
        $apiTypes = ['WS', 'REST'];
        $separators = [ord('.') => '.', ord(',') => ',', ord(' ') => __('settings.space'), ord(':') => ':', ord(';') => ';', ord('-') => '-'];

        if (config('settings.currency') != 'USD' && !config('settings.openexchangerates_api_key')) {
            $request->session()->flash('warning', __('app.openexchangerates_api_key_missing', ['url' => 'https://openexchangerates.org/signup/free']));
        }

        return view('pages.backend.settings', [
            'backgrounds'   => $backgrounds,
            'colors'        => $colors,
            'locales'       => $locales,
            'currencies'    => $currencies,
            'log_levels'    => $logLevels,
            'separators'    => $separators,
            'api_types'     => $apiTypes,
        ]);
    }

    public function update(Request $request) {
        event(new BeforeSettingsSaved($request));

        // merging saved variables (settings) into current env variables
        $dotEnvService = new DotEnvService();
        $env = $dotEnvService->load();
        $env = array_merge($env, $request->except(['_token', 'nonenv']));

        // save settings to .env file
        if (!$dotEnvService->save($env))
            return redirect()->back()->withErrors(__('settings.not_saved'));

        // clear JS cache
        Cache::forget('variables.js');
        return redirect()->back()->with('success', __('settings.saved'));
    }
}
