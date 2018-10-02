@extends('layouts.frontend')

@section('title')
    {{ __('app.coins') }}
@endsection

@section('content')
    <data-feed></data-feed>
    <div class="ui one column tablet stackable grid container">
        <div class="column">
            @if($assets->isEmpty())
                <div class="ui segment">
                    <p>{{ __('app.competitions_empty') }}</p>
                </div>
            @else
                <assets-table :assets-list="{{ $assets->getCollection() }}" class="ui selectable {{ $inverted }} table">
                    <template slot="header">
                        @component('components.tables.sortable-column', ['id' => 'symbol', 'sort' => $sort, 'order' => $order])
                            {{ __('app.symbol') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'name', 'sort' => $sort, 'order' => $order])
                            {{ __('app.name') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'price', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned'])
                            {{ __('app.price') }}, {{ config('settings.currency') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'change_abs', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned'])
                            {{ __('app.change_abs') }}, {{ config('settings.currency') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'change_pct', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned'])
                            {{ __('app.change_pct') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'market_cap', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned'])
                            {{ __('app.market_cap') }}, {{ config('settings.currency') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'trades_count', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned'])
                            {{ __('app.trades') }}
                        @endcomponent
                    </template>
                </assets-table>
            @endif
        </div>
        <div class="right aligned column">
            {{ $assets->appends(['sort' => $sort])->appends(['order' => $order])->links() }}
        </div>
    </div>
@endsection