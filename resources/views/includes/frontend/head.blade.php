@if(Route::currentRouteName()=='frontend.index')
    <title>{{ __('app.app_name') }} | {{ __('app.app_slogan') }}</title>
@else
    <title>{{ __('app.app_name') }} | @yield('title')</title>
@endif
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="{{ __('app.meta_description') }}" />
<meta name="keywords" content="{{ __('app.meta_keywords') }}" />
<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
<link rel="mask-icon" href="{{ asset('images/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
<link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-config" content="{{ asset('images/favicon/browserconfig.xml') }}">
<meta name="theme-color" content="#ffffff">
<!-- END Favicon -->
<!--Open Graph tags-->
<meta property="og:url" content="{{ url()->full() }}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{ __('app.app_name') }}" />
<meta property="og:description" content="{{ __('app.meta_description') }}" />
<meta property="og:image" content="{{ asset('images/og-image.jpg') }}" />
<!--END Open Graph tags-->
@includeWhen(config('settings.gtm_container_id'), 'includes.frontend.gtm-head')
@include('includes.frontend.styles')