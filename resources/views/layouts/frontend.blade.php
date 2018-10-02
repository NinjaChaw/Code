<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.frontend.head')
</head>
<body class="frontend {{ str_replace('.','-',Route::currentRouteName()) }} background-{{ $settings->background }} color-{{ $settings->color }}">
    @includeWhen(config('settings.gtm_container_id'), 'includes.frontend.gtm-body')

    <div id="app">

        @include('includes.frontend.header')

        <div id="before-content">
            @includeWhen(config('settings.adsense_client_id') && config('settings.adsense_top_slot_id'),
                'includes.frontend.adsense',
                ['client_id' => config('settings.adsense_client_id'), 'slot_id' => config('settings.adsense_top_slot_id')]
            )

            @yield('before-content')
        </div>

        <div id="content">
            <div class="ui stackable grid container">
                <div class="column">
                    <h1 class="ui {{ $settings->color }} header">
                        @yield('title')
                    </h1>
                    @section('messages')
                        @component('components.session.messages')
                        @endcomponent
                    @show
                </div>
            </div>
            @yield('content')
        </div>

        <div id="after-content">
            @yield('after-content')

            @includeWhen(config('settings.adsense_client_id') && config('settings.adsense_bottom_slot_id'),
                'includes.frontend.adsense',
                ['client_id' => config('settings.adsense_client_id'), 'slot_id' => config('settings.adsense_bottom_slot_id')]
            )
        </div>

        @includeFirst(['includes.frontend.footer-udf','includes.frontend.footer'])

    </div>

    @include('includes.frontend.scripts')

</body>
</html>