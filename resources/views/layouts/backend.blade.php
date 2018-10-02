<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.backend.head')
</head>
<body class="{{ str_replace('.','-',Route::currentRouteName()) }} background-{{ $settings->background }} color-{{ $settings->color }}">

    <div id="app">

        @include('includes.backend.header')

        <div class="pusher">

            <div id="before-content">
                @yield('before-content')
            </div>

            <div id="content">
                <div class="ui stackable grid container">
                    <div class="column">
                        <h1 class="ui block {{ $inverted }} header">
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
            </div>

            @include('includes.backend.footer')

        </div>

    </div>

    @include('includes.backend.scripts')

</body>
</html>