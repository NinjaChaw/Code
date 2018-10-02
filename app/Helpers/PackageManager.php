<?php

namespace App\Helpers;

/**
 * Class PackageManager - manage extra packages (add-ons)
 *
 * @package App\Helpers
 */
class PackageManager
{
    private $packages = [];
    private $appDirectory;

    function __construct()
    {
        $this->appDirectory = __DIR__ . '/../../';

        // loop through packages definitions and load config from composer.json
        foreach (glob($this->appDirectory . 'packages/*/config.json') as $configFile) {
            if ($package = json_decode(file_get_contents($configFile))) {
                $this->packages[$package->id] = $package;
                $this->packages[$package->id]->installed = $this->installed($package->id);
                if ($this->packages[$package->id]->installed) {
                    $this->packages[$package->id]->version = config($package->id . '.version');
                }
            }
        }

        return $this;
    }

    /**
     * Get all supported packages
     *
     * @return array
     */
    public function getAll()
    {
        return $this->packages;
    }


    /**
     * Get all installed packages
     *
     * @return array
     */
    public function getInstalled() {
        return array_filter($this->packages, function($package) {
            return $package->installed;
        });
    }

    /**
     * Check whether given package is installed
     *
     * @param $id
     * @return bool
     */
    public function installed($id) {
        $package = $this->getAll()[$id];
        return file_exists($this->appDirectory . 'packages/' . $package->base_path . '/' . $package->source_path . '/' . str_replace([$package->namespace, '\\'], ['','/'], $package->providers[0]) . '.php');
    }

    /**
     * Auto load necessary file when a package class is called
     *
     * @param $className
     */
    public function autoload($className)
    {
        foreach ($this->getInstalled() as $package) {
            // classes that are mapped one by one
            $static = (array) $package->static;

            // if specific class (such as seed) should be loaded
            if (in_array($className, array_keys($static))) {
                $classPath = __DIR__ . '/../../packages/' . $package->base_path . '/' . $static[$className] . '/' . $className . '.php';
                include_once $classPath;
                // otherwise try to match by namespace
            } elseif (strpos($className, $package->namespace) !== FALSE) {
                $classPath = __DIR__ . '/../../packages/' . $package->base_path . '/' . $package->source_path . '/' . str_replace([$package->namespace, '\\'], ['','/'], $className) . '.php';
                include_once $classPath;
            }
        }

    }
}