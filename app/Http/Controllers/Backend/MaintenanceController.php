<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class MaintenanceController extends Controller
{
    public function index() {
        return view('pages.backend.maintenance');
    }

    /**
     * Clear all caches
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cache() {
        Cache::flush();
        Artisan::call('view:clear');
        return $this->success();
    }

    /**
     * Run migrations
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function migrate() {
        // Forcing Migrations To Run In Production
        Artisan::call('migrate', [
            '--force' => TRUE,
        ]);
        // run seeders
        Artisan::call('db:seed');

        return $this->success();
    }

    /**
     * Run cron
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cron() {
        set_time_limit(1800);
        Artisan::call('schedule:run');
        return $this->success();
    }

    public function cronAssetsMarketData() {
        set_time_limit(1800);
        Artisan::call('asset:update');
        return $this->success();
    }

    public function cronCurrenciesMarketData() {
        set_time_limit(1800);
        Artisan::call('currency:update');
        return $this->success();
    }

    private function success() {
        return redirect()->route('backend.maintenance.index')->with('success', __('maintenance.success'));
    }
}
