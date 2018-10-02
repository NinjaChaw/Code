<div class="ui stackable grid container">
    <div class="column">
        <div class="ui labels">
            @if($competition->fee > 0)
                <span class="ui {{ $settings->color }} popup-trigger icon label">
                    <i class="dollar sign icon"></i>
                    {{ __('app.cash_prizes') }}
                </span>
                @component('components.popups.payout', ['competition' => $competition])
                @endcomponent
            @endif
            <span class="ui {{ $settings->color }} basic label"><i class="balance scale icon"></i>{{ __('app.leverage') }} {{ $competition->_leverage }}:1</span>
            <span class="ui {{ $settings->color }} basic label"><i class="weight icon"></i>{{ __('app.lot_size') }} {{ $competition->_lot_size }}</span>
            <span class="ui {{ $settings->color }} basic label"><i class="chart bar icon"></i>{{ __('app.volume') }} {{ $competition->_volume_min }} - {{ $competition->_volume_max }}</span>
            <span class="ui {{ $settings->color }} basic label"><i class="users icon"></i>{{ __('app.slots_taken') }} {{ $competition->slots_taken }} / {{ $competition->slots_max }}</span>
            <span class="ui {{ $settings->color }} basic label"><i class="money bill alternate outline icon"></i>{{ __('app.start_balance') }} {{ $competition->_start_balance }} {{ $competition->currency->code }}</span>
            <span class="ui {{ $settings->color }} basic label"><i class="flag outline icon"></i>{{ __('app.status') }} {{ __('app.competition_status_'.$competition->status) }}</span>
        </div>
        <div class="ui secondary {{ $settings->color }} pointing stackable {{ $inverted }} menu">
            @if($competition->status == \App\Models\Competition::STATUS_IN_PROGRESS && $participant)
                <a href="{{ route('frontend.competitions.show', $competition) }}" class="item {{ Route::currentRouteName()=='frontend.competitions.show' ? 'active' : '' }}">
                    {{ __('app.trading') }}
                </a>
            @endif
            <a href="{{ route('frontend.competitions.leaderboard', $competition) }}" class="item {{ Route::currentRouteName()=='frontend.competitions.leaderboard' ? 'active' : '' }}">
                {{ __('app.leaderboard') }}
            </a>
            @if($participant)
                <a href="{{ route('frontend.competitions.history', $competition) }}" class="item {{ Route::currentRouteName()=='frontend.competitions.history' ? 'active' : '' }}">
                    {{ __('app.history') }}
                </a>
            @endif
        </div>
    </div>
</div>