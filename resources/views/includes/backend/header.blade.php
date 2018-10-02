<div id="backend-sidebar" class="ui left vertical {{ $inverted }} menu sidebar">
    <div class="header item">{{ __('app.frontend') }}</div>
    <a href="{{ route('frontend.index') }}" class="item">
        {{ __('app.home_page') }}
        <i class="home icon"></i>
    </a>
    <div class="header item">{{ __('app.backend') }}</div>
    <a href="{{ route('backend.dashboard') }}" class="item{{ Route::currentRouteName()=='backend.dashboard' ? ' active' : '' }}">
        {{ __('app.dashboard') }}
        <i class="heartbeat icon"></i>
    </a>
    <a href="{{ route('backend.assets.index') }}" class="item{{ strpos(Route::currentRouteName(),'backend.assets.')!==FALSE ? ' active' : '' }}">
        {{ __('app.assets') }}
        <i class="bitcoin icon"></i>
    </a>
    <a href="{{ route('backend.competitions.index') }}" class="item{{ strpos(Route::currentRouteName(),'backend.competitions.')!==FALSE ? ' active' : '' }}">
        {{ __('app.competitions') }}
        <i class="trophy icon"></i>
    </a>
    <a href="{{ route('backend.trades.index') }}" class="item{{ strpos(Route::currentRouteName(),'backend.trades.')!==FALSE ? ' active' : '' }}">
        {{ __('app.trades') }}
        <i class="retweet icon"></i>
    </a>
    <a href="{{ route('backend.users.index') }}" class="item{{ strpos(Route::currentRouteName(),'backend.users.')!==FALSE ? ' active' : '' }}">
        {{ __('users.users') }}
        <i class="users icon"></i>
    </a>

    @packageview('includes.backend.header')

    <a href="{{ route('backend.addons.index') }}" class="item{{ strpos(Route::currentRouteName(),'backend.addons.')!==FALSE ? ' active' : '' }}">
        {{ __('settings.addons') }}
        <i class="codepen icon"></i>
    </a>
    <a href="{{ route('backend.settings.index') }}" class="item{{ strpos(Route::currentRouteName(),'backend.settings.')!==FALSE ? ' active' : '' }}">
        {{ __('settings.settings') }}
        <i class="settings icon"></i>
    </a>
    <a href="{{ route('backend.maintenance.index') }}" class="item{{ strpos(Route::currentRouteName(),'backend.maintenance.')!==FALSE ? ' active' : '' }}">
        {{ __('maintenance.maintenance') }}
        <i class="server icon"></i>
    </a>
    <a href="{{ route('backend.badge.index') }}" class="item{{ strpos(Route::currentRouteName(),'backend.badge.')!==FALSE ? ' active' : '' }}">
        {{ __('Badges') }}
        <i class="badge icon"></i>
    </a>
    <log-out-button token="{{ csrf_token() }}" class="item">
        {{ __('auth.logout') }}
        <i class="sign out alternate icon"></i>
    </log-out-button>
</div>
<div id="backend-menu" class="ui top fixed {{ $inverted }} menu">
    <div class="ui container">
        <a id="backend-sidebar-toggle" class="item"><i class="bars icon"></i></a>
        <span class="header item">
            <a href="{{ route('backend.dashboard') }}">{{ __('app.app_name') }}</a>
            <span class="ui basic {{ $settings->color }} label">{{config('app.version') }}</span>
        </span>
    </div>
</div>

@push('scripts')
    <script>
        $('#backend-sidebar')
            .sidebar('setting', 'transition', 'overlay')
            .sidebar('attach events', '#backend-sidebar-toggle');
    </script>
@endpush