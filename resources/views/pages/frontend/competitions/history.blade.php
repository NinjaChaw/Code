@extends('layouts.frontend')

@section('title')
    {{ $competition->title }}
@endsection

@section('content')

    @include('pages.frontend.competitions.header')

    <div class="ui one column tablet stackable grid container">
        <div class="column">
            @if($trades->isEmpty())
                <div class="ui segment">
                    <p>{{ __('app.no_closed_trades') }}</p>
                </div>
            @else
                <table class="ui selectable tablet stackable {{ $inverted }} table">
                    <thead>
                    <tr>
                        @component('components.tables.sortable-column', ['id' => 'asset', 'sort' => $sort, 'order' => $order])
                            {{ __('app.asset') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'direction', 'sort' => $sort, 'order' => $order])
                            {{ __('app.buy_sell') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'volume', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned'])
                            {{ __('app.volume') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'price_open', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned'])
                            {{ __('app.open_price') }}, {{ $competition->currency->code }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'price_close', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned'])
                            {{ __('app.close_price') }}, {{ $competition->currency->code }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'pnl', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned'])
                            {{ __('app.pnl') }}, {{ $competition->currency->code }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'created', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned'])
                            {{ __('app.created_at') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'closed', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned'])
                            {{ __('app.closed_at') }}
                        @endcomponent
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($trades as $trade)
                        <tr>
                            <td data-title="{{ __('app.asset') }}">
                                <img src="{{ $trade->asset->logo_url }}" class="ui avatar image">
                                {{ $trade->asset->symbol }}
                                ({{ $trade->asset->name }})
                            </td>
                            <td data-title="{{ __('app.buy_sell') }}">
                                @if($trade->direction == \App\Models\Trade::DIRECTION_BUY)
                                    <span class="ui tiny basic green label">
                                        <i class="arrow up icon"></i>
                                        {{ __('app.trade_direction_' . \App\Models\Trade::DIRECTION_BUY) }}
                                    </span>
                                @else
                                    <span class="ui tiny basic red label">
                                        <i class="arrow down icon"></i>
                                        {{ __('app.trade_direction_' . \App\Models\Trade::DIRECTION_SELL) }}
                                    </span>
                                @endif
                            </td>
                            <td data-title="{{ __('app.volume') }}" class="right aligned">{{ $trade->_volume }}</td>
                            <td data-title="{{ __('app.open_price') }}" class="right aligned">{{ $trade->_price_open }}</td>
                            <td data-title="{{ __('app.close_price') }}" class="right aligned">{{ $trade->_price_close }}</td>
                            <td data-title="{{ __('app.pnl') }}" class="{{ $trade->pnl > 0 ? 'positive' : ($trade->pnl < 0 ? 'negative' : '') }} right aligned">
                                {{ $trade->_pnl }}
                            </td>
                            <td data-title="{{ __('app.created_at') }}" class="right aligned">
                                {{ $trade->created_at->diffForHumans() }}
                                <span data-tooltip="{{ $trade->created_at }}">
                                    <i class="calendar outline tooltip icon"></i>
                                </span>
                            </td>
                            <td data-title="{{ __('app.closed_at') }}" class="right aligned">
                                {{ $trade->closed_at->diffForHumans() }}
                                <span data-tooltip="{{ $trade->closed_at }}">
                                    <i class="calendar outline tooltip icon"></i>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="right aligned column">
            {{ $trades->appends(['sort' => $sort])->appends(['order' => $order])->links() }}
        </div>
    </div>
@endsection