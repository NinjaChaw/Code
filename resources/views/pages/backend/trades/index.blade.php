@extends('layouts.backend')

@section('title')
    {{ __('app.trades') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        <div class="column">
            @if($trades->isEmpty())
                <div class="ui segment">
                    <p>{{ __('app.trades_empty') }}</p>
                </div>
            @else
                <table class="ui selectable tablet stackable {{ $inverted }} table">
                    <thead>
                    <tr>
                        @component('components.tables.sortable-column', ['id' => 'id', 'sort' => $sort, 'order' => $order])
                            {{ __('app.id') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'competition', 'sort' => $sort, 'order' => $order])
                            {{ __('app.competition') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'asset', 'sort' => $sort, 'order' => $order])
                            {{ __('app.asset') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'direction', 'sort' => $sort, 'order' => $order])
                        {{ __('app.buy_sell') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'lot', 'sort' => $sort, 'order' => $order])
                        {{ __('app.lot_size') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'volume', 'sort' => $sort, 'order' => $order])
                            {{ __('app.volume') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'price_open', 'sort' => $sort, 'order' => $order])
                            {{ __('app.open_price') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'price_close', 'sort' => $sort, 'order' => $order])
                            {{ __('app.close_price') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'margin', 'sort' => $sort, 'order' => $order])
                            {{ __('app.margin') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'pnl', 'sort' => $sort, 'order' => $order])
                            {{ __('app.pnl') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'created', 'sort' => $sort, 'order' => $order])
                            {{ __('app.created_at') }}
                        @endcomponent
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($trades as $trade)
                        <tr>
                            <td data-title="{{ __('app.id') }}">
                                <a href="{{ route('backend.trades.edit', $trade) }}">{{ $trade->id }}</a>
                            </td>
                            <td data-title="{{ __('app.competition') }}">
                                <a href="{{ route('backend.competitions.edit', $trade->competition) }}">
                                    {{ $trade->competition->title }}
                                </a>
                            </td>
                            <td data-title="{{ __('app.asset') }}">
                                <a href="{{ route('backend.assets.edit', $trade->asset) }}">
                                    <img src="{{ $trade->asset->logo_url }}" class="ui avatar image">
                                    {{ $trade->asset->symbol }}
                                </a>
                            </td>
                            <td data-title="{{ __('app.buy_sell') }}">
                                <i class="arrow {{ $trade->direction == \App\Models\Trade::DIRECTION_BUY ? 'up green' : 'down red' }} icon"></i>
                                {{ __('app.trade_direction_' . $trade->direction) }}
                            </td>
                            <td data-title="{{ __('app.lot_size') }}">{{ $trade->_lot_size }}</td>
                            <td data-title="{{ __('app.volume') }}">{{ $trade->_volume }}</td>
                            <td data-title="{{ __('app.open_price') }}">{{ $trade->_price_open }}</td>
                            <td data-title="{{ __('app.close_price') }}">{{ $trade->_price_close }}</td>
                            <td data-title="{{ __('app.margin') }}">{{ $trade->_margin }}</td>
                            <td data-title="{{ __('app.pnl') }}" class="{{ $trade->pnl > 0 ? 'positive' : ($trade->pnl < 0 ? 'negative' : '') }}">
                                {{ $trade->_pnl }}
                            </td>
                            <td data-title="{{ __('app.created_at') }}">
                                {{ $trade->created_at->diffForHumans() }}
                                <span data-tooltip="{{ $trade->created_at }}">
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