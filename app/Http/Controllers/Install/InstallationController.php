<?php

namespace App\Http\Controllers\Install;

use App\Models\User;
use App\Services\DotEnvService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;

class InstallationController extends Controller
{
    private $env;
    private $dotEnvService;

    public function __construct(Request $request)
    {
        $this->dotEnvService = new DotEnvService();

        if (!$this->env = $this->dotEnvService->load()) {
            if (!$this->dotEnvService->createFromDefault())
                die('Can not create env file');
        }

        // update the default APP_KEY in .env
        if (!env('APP_KEY')) {
            // it's important to use --force flag in all artisan commands when APP_ENV=production
            Artisan::call('key:generate', ['--force' => TRUE]);
            // create public/storage --> storage/app/public symbolic link
            Artisan::call('storage:link');
        }
    }

    public function step1() {
        return view('pages.install.step1');
    }

    public function db(Request $request) {
        try {
            // check if DB connection can be created
            new \pdo(
                'mysql:host='.$request->host.';port='.$request->port.';dbname='.$request->name,
                $request->username,
                $request->password,
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
            );
        } catch (\Exception $e) {
            return redirect()->route('install.step1')->withInput()->withErrors($e->getMessage());
        }

        // save DB settings
        $this->env['DB_HOST'] = $request->host;
        $this->env['DB_PORT'] = $request->port;
        $this->env['DB_DATABASE'] = $request->name;
        $this->env['DB_USERNAME'] = $request->username;
        $this->env['DB_PASSWORD'] = $request->password;
        $this->dotEnvService->save($this->env);

        // redirect to next step (because DB config variables are not saved in runtime)
        return redirect()->route('install.step2');
    }

    public function step2(Request $request) {
        try {
            set_time_limit(1800);
            // run migrations and seeds
            Artisan::call('migrate:fresh', [
                '--force' => TRUE,
                '--seed' => TRUE,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('install.step1')->withInput()->withErrors($e->getMessage());
        }

        return view('pages.install.step2');
    }

    public function step3(Request $request) {
        try {
            User::create([
                'name'              => $request->name,
                'email'             => $request->email,
                'role'              => User::ROLE_ADMIN,
                'status'            => User::STATUS_ACTIVE,
                'last_login_time'   => Carbon::now(),
                'last_login_ip'     => request()->ip(),
                'password'          => bcrypt($request->password),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('install.step3')->withErrors($e->getMessage());
        }

        return view('pages.install.step3');
    }

    public function step4(Request $request) {
        try {
            set_time_limit(1800);
            Artisan::call('asset:update');
        } catch (\Exception $e) {
            return redirect()->route('install.step2')->withInput()->withErrors($e->getMessage());
        }

        // unset debug mode
        unset($this->env['APP_DEBUG']);
        unset($this->env['APP_LOG_LEVEL']);
        $this->dotEnvService->save($this->env);

        // mark isntallation as completed
        touch(base_path() . '/storage/installed');

        return view('pages.install.step4');
    }
}
