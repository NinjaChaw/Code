@extends('layouts.frontend')

@section('title')
    {{ __('app.competitions') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        <div class="column">
            @env('demo')
                <div class="ui info message">
                    <div class="header">
                        Demo environment notice
                    </div>
                    <p>
                        Please note that accounts, deposits, withdrawals and cash competitions functionality is <b>not</b> included into
                        Crypto Trading Competitions application package by default. This functionality can be purchased and installed
                        as an extra add-on.
                    </p>
                </div>
            @endenv
            @if($competitions->isEmpty())
                <div class="ui segment">
                    <p>{{ __('app.competitions_empty') }}</p>
                </div>
            @else
                <table class="ui selectable tablet stackable {{ $inverted }} table">
                    <thead>
                    <tr>
                        <th></th>
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
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($competitions as $competition)
                        <tr>
                            <td class="left aligned">
                                @if($competition->fee > 0)
                                    <a class="ui {{ $settings->color }} ribbon popup-trigger label">
                                        <i class="dollar icon"></i>
                                        {{ __('app.cash_prizes') }}
                                    </a>
                                    @component('components.popups.payout', ['competition' => $competition])
                                    @endcomponent
                                @endif
                            </td>
                            <td data-title="{{ __('app.title') }}">
                                <a href="{{ route('frontend.competitions.show', $competition) }}">
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
                                @elseif($competition->status==\App\Models\Competition::STATUS_IN_PROGRESS)
                                    <i class="spinner loading icon"></i>
                                @endif
                                {{ __('app.competition_status_' . $competition->status) }}
                                @if($competition->status==\App\Models\Competition::STATUS_OPEN)
                                    <span data-tooltip="{{ trans_choice('app.competition_participants_left', $competition->slots_required, ['n' => $competition->slots_required]) }}">
                                        <i class="question circle outline tooltip icon"></i>
                                    </span>
                                @endif
                            </td>
                            <td class="right mobile-center aligned">
                                @if (!$competition->is_participant && (new \App\Rules\UserCanJoinCompetition($competition, auth()->user()))->passes())
                                    <form action="{{ route('frontend.competitions.join', $competition) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button class="ui small basic {{ $settings->color }} icon submit button">
                                            <i class="checkmark icon"></i>
                                            {{ $competition->fee > 0 ? __('app.join_for', ['fee' => $competition->_fee, 'ccy' => $competition->currency->code]) : __('app.join') }}
                                        </button>
                                    </form>
                                @else
                                    <a class="ui small basic {{ $settings->color }} icon submit button" href="{{ route('frontend.competitions.show', $competition) }}">
                                        <i class="eye icon"></i>
                                        {{ __('app.view') }}
                                    </a>
                                @endif
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