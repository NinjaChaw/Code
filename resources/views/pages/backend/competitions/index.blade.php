@extends('layouts.backend')

@section('title')
    {{ __('app.competitions') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        <div class="center aligned column">
            <a href="{{ route('backend.competitions.create') }}" class="ui big {{ $settings->color }} button">
                <i class="trophy icon"></i>
                {{ __('app.create_competition') }}
            </a>
        </div>
        <div class="column">
            @if($competitions->isEmpty())
                <div class="ui segment">
                    <p>{{ __('app.competitions_empty') }}</p>
                </div>
            @else
                <table class="ui selectable tablet stackable {{ $inverted }} table">
                    <thead>
                    <tr>
                        @component('components.tables.sortable-column', ['id' => 'id', 'sort' => $sort, 'order' => $order])
                            {{ __('app.id') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'title', 'sort' => $sort, 'order' => $order])
                            {{ __('app.title') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'balance', 'sort' => $sort, 'order' => $order])
                        {{ __('app.start_balance') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'duration', 'sort' => $sort, 'order' => $order])
                            {{ __('app.duration') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'slots', 'sort' => $sort, 'order' => $order])
                            {{ __('app.slots_taken') }}
                        @endcomponent
                        <th><a href="#">{{ __('app.details') }}</a></th>
                        @component('components.tables.sortable-column', ['id' => 'status', 'sort' => $sort, 'order' => $order])
                            {{ __('app.status') }}
                        @endcomponent
                        @component('components.tables.sortable-column', ['id' => 'created', 'sort' => $sort, 'order' => $order])
                            {{ __('app.created_at') }}
                        @endcomponent
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($competitions as $competition)
                        <tr>
                            <td data-title="{{ __('app.id') }}">{{ $competition->id }}</td>
                            <td data-title="{{ __('app.title') }}">
                                <a href="{{ route('backend.competitions.edit', $competition) }}">
                                    {{ $competition->title }}
                                </a>
                            </td>
                            <td data-title="{{ __('app.start_balance') }}">{{ $competition->_start_balance }} {{ $competition->currency->code }}</td>
                            <td data-title="{{ __('app.duration') }}">
                                {{ __('app.duration_' . $competition->duration) }}
                                @if($competition->start_time && $competition->end_time)
                                    <span data-tooltip="{{ $competition->start_time }} &mdash; {{ $competition->end_time }}">
                                        <i class="calendar outline tooltip icon"></i>
                                    </span>
                                @endif
                            </td>
                            <td data-title="{{ __('app.slots_taken') }}">{{ $competition->slots_taken }} / {{ $competition->slots_max }}</td>
                            <td>
                                <div class="ui two column grid">
                                    <div class="column">
                                        <div>{{ __('app.lot_size') }}:</div>
                                        <div>{{ __('app.leverage') }}:</div>
                                        <div>{{ __('app.volume') }}:</div>
                                        <div>{{ __('app.min_margin_level') }}:</div>
                                        @if($competition->fee > 0)
                                            <div>{{ __('app.fee') }}:</div>
                                        @endif
                                    </div>
                                    <div class="column">
                                        <div>{{ $competition->_lot_size }}</div>
                                        <div>{{ $competition->_leverage }}:1</div>
                                        <div>{{ $competition->_volume_min }} &mdash; {{ $competition->_volume_max }}</div>
                                        <div>{{ $competition->_min_margin_level }}</div>
                                        @if($competition->fee > 0)
                                            <div>{{ $competition->_fee }} {{ $competition->currency->code }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td data-title="{{ __('app.status') }}">
                                @if($competition->status==\App\Models\Competition::STATUS_COMPLETED)
                                    <i class="green checkmark icon"></i>
                                @endif
                                {{ __('app.competition_status_' . $competition->status) }}
                            </td>
                            <td data-title="{{ __('app.created_at') }}">
                                {{ $competition->created_at->diffForHumans() }}
                                <span data-tooltip="{{ $competition->created_at }}">
                                    <i class="calendar outline tooltip icon"></i>
                                </span>
                            </td>
                            <td class="right aligned tablet-and-below-center">
                                <a class="ui icon {{ $settings->color }} basic button" href="{{ route('backend.competitions.edit', $competition) }}">
                                    <i class="edit icon"></i>
                                    {{ __('app.edit') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="right aligned column">
            {{ $competitions->appends(['sort' => $sort])->appends(['order' => $order])->links() }}
        </div>
    </div>
@endsection