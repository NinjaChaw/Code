@extends('layouts.backend')

@section('title')
    {{ __('app.competitions') }} :: {{ __('app.create') }}
@endsection

@section('content')
    <competition-form :input="{fee: {{ old('fee',0) }}, maxParticipants: {{ old('slots_max', 'null') }}, payouts: {amounts: {{ json_encode(old('payouts_amounts', [])) }}, types: {{ json_encode(old('payouts_types', [])) }} }, editable: true }" inline-template>
        <div class="ui stackable grid container">
            <div class="column">
                <div class="ui {{ $inverted }} segment">
                    <form class="ui {{ $inverted }} form" method="POST" action="{{ route('backend.competitions.store') }}">
                        {{ csrf_field() }}
                        <div class="field {{ $errors->has('title') ? 'error' : '' }}">
                            <label>{{ __('app.title') }}</label>
                            <div class="ui input">
                                <input type="text" name="title" placeholder="{{ __('app.title') }}" value="{{ old('title') }}" required autofocus>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('duration') ? 'error' : '' }}">
                            <label>{{ __('app.duration') }}</label>
                            <div id="competition-duration-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="duration">
                                <i class="dropdown icon"></i>
                                <div class="default text">{{ __('app.duration') }}</div>
                                <div class="menu">
                                    @foreach($durations as $duration)
                                        <div class="item" data-value="{{ $duration }}">{{ __('app.duration_'.$duration) }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('slots_required') ? 'error' : '' }}">
                            <label>{{ __('app.slots_required') }} <span data-tooltip="{{ __('app.slots_required_hint') }}"><i class="question circle outline large tooltip icon"></i></span></label>
                            <div class="ui input">
                                <input type="text" name="slots_required" placeholder="{{ __('app.slots_required') }}" value="{{ old('slots_required') }}" required autofocus>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('slots_max') ? 'error' : '' }}">
                            <label>{{ __('app.slots_max') }} <span data-tooltip="{{ __('app.slots_max_hint') }}"><i class="question circle outline tooltip large icon"></i></span></label>
                            <div class="ui input">
                                <input v-model="fields.maxParticipants" type="text" name="slots_max" placeholder="{{ __('app.slots_max') }}" required autofocus>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('start_balance') ? 'error' : '' }}">
                            <label>{{ __('app.start_balance') }} <span data-tooltip="{{ __('app.start_balance_hint') }}"><i class="question circle outline large tooltip icon"></i></span></label>
                            <div class="ui right labeled input">
                                <input type="text" name="start_balance" placeholder="{{ __('app.start_balance') }}" value="{{ old('start_balance', 10000) }}" required autofocus>
                                <div class="ui basic label">{{ config('settings.currency') }}</div>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('lot_size') ? 'error' : '' }}">
                            <label>{{ __('app.lot_size') }} <span data-tooltip="{{ __('app.lot_size_hint') }}"><i class="question circle outline large tooltip icon"></i></span></label>
                            <div class="ui input">
                                <input type="text" name="lot_size" placeholder="{{ __('app.lot_size') }}" value="{{ old('lot_size', 100000) }}" required autofocus>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('leverage') ? 'error' : '' }}">
                            <label>{{ __('app.leverage') }} <span data-tooltip="{{ __('app.leverage_hint') }}"><i class="question circle outline large tooltip icon"></i></span></label>
                            <div class="ui input">
                                <input type="text" name="leverage" placeholder="{{ __('app.leverage') }}" value="{{ old('leverage', 100) }}" required autofocus>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('volume_min') ? 'error' : '' }}">
                            <label>{{ __('app.volume_min') }} <span data-tooltip="{{ __('app.volume_min_hint') }}"><i class="question circle outline large tooltip icon"></i></span></label>
                            <div class="ui input">
                                <input type="text" name="volume_min" placeholder="{{ __('app.volume_min') }}" value="{{ old('volume_min', 0.1) }}" required autofocus>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('volume_max') ? 'error' : '' }}">
                            <label>{{ __('app.volume_max') }} <span data-tooltip="{{ __('app.volume_max_hint') }}"><i class="question circle outline large tooltip icon"></i></span></label>
                            <div class="ui input">
                                <input type="text" name="volume_max" placeholder="{{ __('app.volume_max') }}" value="{{ old('volume_max', 100) }}" required autofocus>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('min_margin_level') ? 'error' : '' }}">
                            <label>{{ __('app.min_margin_level') }} <span data-tooltip="{{ __('app.min_margin_level_hint') }}"><i class="question circle outline large tooltip icon"></i></span></label>
                            <div class="ui right labeled input">
                                <input type="text" name="min_margin_level" placeholder="{{ __('app.min_margin_level') }}" value="{{ old('min_margin_level', 10) }}" required autofocus>
                                <div class="ui basic label">%</div>
                            </div>
                        </div>

                        @packageview('pages.backend.competitions.create')

                        <button class="ui large {{ $settings->color }} submit button">
                            <i class="save icon"></i>
                            {{ __('app.save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </competition-form>
@endsection

@push('scripts')
    <script>
        $('#competition-duration-dropdown').dropdown('set selected', '{{ old('duration') }}');
    </script>
@endpush