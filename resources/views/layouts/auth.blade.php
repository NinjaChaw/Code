<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.frontend.head')
</head>
<body class="{{ str_replace('.','-',Route::currentRouteName()) }} background-{{ $settings->background }} color-{{ $settings->color }}">
    @includeWhen(config('settings.gtm_container_id'), 'includes.frontend.gtm-body')

    <div id="app">

        <div id="before-auth">
            @yield('before-auth')
        </div>

        <div id="auth">
            @yield('auth')
        </div>

    </div>

    @include('includes.frontend.scripts')

</body>
</html>