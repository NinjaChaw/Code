<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\PackageManager;
use App\Http\Controllers\Controller;

class AddonController extends Controller
{
    public function index() {
        $packageManager = new PackageManager();

        return view('pages.backend.addons', [
            'packages' => $packageManager->getAll()
        ]);
    }
}
