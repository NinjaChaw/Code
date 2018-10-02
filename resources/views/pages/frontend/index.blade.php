@extends('layouts.index')

@section('content')
    <div class="ui inverted vertical masthead center aligned segment">
        <div class="ui container">
            <div class="ui large secondary inverted pointing menu">
                <div class="right item">
                    @guest
                        <a href="{{ route('login') }}" class="ui inverted button">{{ __('auth.log_in') }}</a>
                    @endguest
                    @auth
                        <form class="ui form" method="POST" action="{{ route('logout') }}">
                            {{ csrf_field() }}
                            <a href="{{ route('frontend.dashboard') }}" class="ui inverted button">{{ __('app.dashboard') }}</a>
                            <button href="#" class="ui inverted button">{{ __('auth.logout') }}</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
        <div class="ui text container">
            <h1 class="ui inverted header">{{ __('app.app_name') }}</h1>
            <h2>{{ __('app.app_slogan') }}</h2>
            <a href="{{ route('register') }}" class="ui huge {{ $settings->color }} button">
                {{ __('app.start_trading') }}<i class="right arrow icon"></i>
            </a>
        </div>
    </div>

    <div class="ui vertical stripe segment">
        <div class="ui stackable three column grid center aligned container">
            <div class="column">
                <h3 class="ui center aligned {{ $inverted }} icon header">
                    <i class="{{ $inverted }} circular trophy {{ $settings->color }} icon"></i>
                    {{ __('app.competitions') }}
                </h3>
                <p>
                    {{ __('app.front_text01') }}
                </p>
            </div>
            <div class="column">
                <h3 class="ui center aligned {{ $inverted }} icon header">
                    <i class="{{ $inverted }} circular chart area {{ $settings->color }} icon"></i>
                    {{ __('app.trading') }}
                </h3>
                <p>
                    {{ __('app.front_text02') }}
                </p>
            </div>
            <div class="column">
                <h3 class="ui center aligned {{ $inverted }} icon header">
                    <i class="{{ $inverted }} circular star {{ $settings->color }} icon"></i>
                    {{ __('app.rankings') }}
                </h3>
                <p>
                    {{ __('app.front_text03') }}
                </p>
            </div>
        </div>
    </div>

    <div class="ui vertical stripe segment">
        <div class="ui stackable grid container">
            <div class="row">
                <div class="eight wide column">
                    <h3 class="ui mobile-center {{ $inverted }} header">{{ __('app.what_we_offer') }}</h3>
                    <div class="ui list">
                        <div class="item">
                            <i class="large green checkmark icon"></i>
                            <div class="content">
                                {{ __('app.front_offer01') }}
                            </div>
                        </div>
                        <div class="item">
                            <i class="large green checkmark icon"></i>
                            <div class="content">
                                {{ __('app.front_offer02') }}
                            </div>
                        </div>
                        <div class="item">
                            <i class="large green checkmark icon"></i>
                            <div class="content">
                                {{ __('app.front_offer03') }}
                            </div>
                        </div>
                        <div class="item">
                            <i class="large green checkmark icon"></i>
                            <div class="content">
                                {{ __('app.front_offer04') }}
                            </div>
                        </div>
                        <div class="item">
                            <i class="large green checkmark icon"></i>
                            <div class="content">
                                {{ __('app.front_offer05') }}
                            </div>
                        </div>
                        <div class="item">
                            <i class="large green checkmark icon"></i>
                            <div class="content">
                                {{ __('app.front_offer06') }}
                            </div>
                        </div>
                        <div class="item">
                            <i class="large green checkmark icon"></i>
                            <div class="content">
                                {{ __('app.front_offer07') }}
                            </div>
                        </div>
                    </div>
                    <div class="ui hidden divider"></div>
                    <div class="mobile-center">
                        <a href="{{ route('register') }}" class="ui huge {{ $settings->color }} button">
                            {{ __('app.try') }}<i class="right arrow icon"></i>
                        </a>
                    </div>
                </div>
                <div class="eight wide column">
                    <img src="{{ asset('images/front-trading-terminal.png') }}">
                </div>
            </div>
        </div>
    </div>

    @if(!$recent_trades->isEmpty())
        <div class="ui basic stripe segment">
            <div class="ui stackable grid container">
                <div class="row">
                    <div class="six wide mobile-center column">
                        <img src="{{ asset('images/front-recent-trades.png') }}">
                    </div>
                    <div class="ten wide mobile-center column">
                        <h3 class="ui {{ $inverted }} header">{{ __('app.trading_now') }}</h3>
                        <div class="ui large feed">
                            @foreach($recent_trades as $recent_trade)
                                <div class="event">
                                    <div class="label">
                                        <div class="tooltip" data-tooltip="{{ $recent_trade->asset->name }}" {{ $inverted ? 'data-inverted="false"' : '' }}>
                                            <img src="{{ $recent_trade->asset->logo_url }}">
                                        </div>
                                    </div>
                                    <div class="content">
                                        <div class="date">
                                            {{ $recent_trade->created_at->diffForHumans() }}
                                        </div>
                                        <div class="content">
                                            <i class="arrow {{ $recent_trade->direction == \App\Models\Trade::DIRECTION_BUY ? 'up green' : 'down red' }} icon"></i>
                                            <span class="ui {{ $recent_trade->direction == \App\Models\Trade::DIRECTION_BUY ? 'green' : 'red' }} tiny basic ">
                                                {{ __('app.trade_direction_' . $recent_trade->direction) }}
                                            </span>
                                            {{ $recent_trade->_lot_size }} x {{ $recent_trade->_volume }} <b>{{ $recent_trade->asset->symbol }}</b> ({{ $recent_trade->asset->name }}) @ {{ $recent_trade->_price_open }} {{ $recent_trade->currency->code }}
                                        </div>
                                    </div>
                                </div>
                                <div class="ui divider"></div>
                            @endforeach
                        </div>
                        <div class="ui hidden divider"></div>
                        <a href="{{ route('register') }}" class="ui huge {{ $settings->color }} button">
                            {{ __('app.join_competition') }}<i class="right arrow icon"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection