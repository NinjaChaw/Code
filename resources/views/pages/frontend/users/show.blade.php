@extends('layouts.frontend')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
    <div class="ui stackable equal width grid container">
        <div class="five wide column">
            <div class="ui cards">
            <div class="ui card">
                <div class="image">
                    <div class="ui {{ $settings->color }} right ribbon label">
                        <i class="star icon"></i> {{ __('app.rank') }} {{ $user->rank }}
                    </div>
                    <img src="{{ $user->avatar_url }}">
                </div>
                <div class="content">
                    <div class="header">{{ $user->name }}</div>
                    <div class="meta">
                        <i class="calendar outline icon"></i>
                        {{ __('users.joined') }} {{ $user->created_at->diffForHumans() }}
                    </div>
                </div>
                @if (auth()->user()->id == $user->id)
                    <div class="extra content">
                        <a class="ui basic {{ $settings->color }} button" href="{{ route('frontend.users.edit', $user) }}">{{ __('users.edit') }}</a>
                    </div>
                @endif
            </div>
            </div>
        </div>
        <div class="eleven wide column">
            <div id="user-stats" class="ui equal width stackable grid">
                <div class="center aligned column">
                    <div class="ui {{ $inverted }} segment">
                        <div class="ui {{ $inverted }} statistic">
                            <div class="value">
                                {{ $trades_count }}
                            </div>
                            <div class="label">
                                {{ __('app.closed_trades') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="center aligned column">
                    <div class="ui {{ $inverted }} segment">
                        <div class="ui {{ $inverted }} green statistic">
                            <div class="value">
                                {{ $profitable_trades_count }}
                            </div>
                            <div class="label">
                                {{ __('app.profitable_trades') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="center aligned column">
                    <div class="ui {{ $inverted }} segment">
                        <div class="ui {{ $inverted }} red statistic">
                            <div class="value">
                                {{ $unprofitable_trades_count }}
                            </div>
                            <div class="label">
                                {{ __('app.unprofitable_trades') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui stackable grid">
                <div class="column">
                    <h2 class="ui {{ $settings->color }} dividing header">{{ __('app.recent_trades') }}</h2>
                    @if($recent_trades->isEmpty())
                        <div class="ui segment">
                            <p>{{ __('app.trades_empty') }}</p>
                        </div>
                    @else
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection