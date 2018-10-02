<?php

namespace App\Services;

class LocaleService
{
    private $flags = [
        'en' => 'us',
        'da' => 'dk',
        'el' => 'gr',
    ];

    private $locales;
    private $locale; // current user locale

    public function __construct()
    {
        $this->locale = app()->getLocale();

        $this->locales = new \stdClass();
        // loop through language folders
        foreach (glob(resource_path('lang/*'), GLOB_ONLYDIR) as $folder) {
            $languageCode = substr($folder, strrpos($folder, '/') + 1);
            $this->locales->$languageCode = new \stdClass();
            $this->locales->$languageCode->flag = array_key_exists($languageCode, $this->flags) ? $this->flags[$languageCode] : $languageCode;
            $this->locales->$languageCode->name = __('language.' . $languageCode);
        }
    }


    /**
     * Get currenct language code
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public function locale() {
        return $this->locales->{$this->locale};
    }

    /**
     * Get all locales
     *
     * @return \stdClass
     */
    public function locales()
    {
        return $this->locales;
    }

    /**
     * Get all locales codes, i.e. en, de, fr etc
     * @return array
     */
    public function codes() {
        return array_keys(get_object_vars($this->locales));
    }

    /**
     * Get current locale code
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public function code() {
        return $this->locale;
    }

}