<!DOCTYPE html>
<html lang="en">
<head>
    <title>Installation | @yield('title')</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/semantic/semantic.min.css') }}">
</head>
<body>
    <div id="app">
        <div class="ui basic segment">
            <div class="ui one column stackable grid container">
                <div class="column">
                    <h1 class="ui teal dividing header">Installation:@yield('title')</h1>
                </div>
                <div class="column">
                    @component('components.session.messages')
                    @endcomponent
                </div>
                @yield('content')
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/manifest.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/vendor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/semantic/semantic.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/variables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(event) {
                $(this).find('.submit').addClass('disabled loading');
            });
        });
    </script>
</body>
</html>