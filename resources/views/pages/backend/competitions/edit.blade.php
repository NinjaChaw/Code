@extends('layouts.backend')

@section('title')
    {{ $competition->title }} :: {{ __('app.edit') }}
@endsection

@section('content')
    <competition-form :input="{fee: {{ old('fee', $competition->fee) }}, maxParticipants: {{ old('slots_max', $competition->slots_max) }}, payouts: {amounts: {{ json_encode(old('payouts_amounts', $payouts_amounts)) }}, types: {{ json_encode(old('payouts_types', $payouts_types)) }}}, editable: {{ $editable ? 'true' : 'false' }} }" inline-template>
        <div class="ui one column stackable grid container">
            <div class="column">
                <div class="ui {{ $inverted }} segment">
                    <form class="ui {{ $inverted }} form" method="POST" action="{{ route('backend.competitions.update', $competition) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="field {{ $errors->has('title') ? 'error' : '' }}">
                            <label>{{ __('app.title') }}</label>
                            <div class="ui input">
                                <input type="text" name="title" placeholder="{{ __('app.title') }}" value="{{ old('title', $competition->title) }}" required autofocus {{ $editable ? '' : 'disabled' }}>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('duration') ? 'error' : '' }}">
                            <label>{{ __('app.duration') }}</label>
                            <div id="competition-duration-dropdown" class="ui selection disabled dropdown">
                                <input type="hidden" name="duration">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
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
                                <input type="text" name="slots_required" placeholder="{{ __('app.slots_required') }}" value="{{ old('slots_required', $competition->slots_required) }}" required autofocus {{ $editable ? '' : 'disabled' }}>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('slots_max') ? 'error' : '' }}">
                            <label>{{ __('app.slots_max') }} <span data-tooltip="{{ __('app.slots_max_hint') }}"><i class="question circle outline tooltip large icon"></i></span></label>
                            <div class="ui input">
                                <input v-model="fields.maxParticipants" type="text" name="slots_max" placeholder="{{ __('app.slots_max') }}" required autofocus {{ $editable ? '' : 'disabled' }}>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('start_balance') ? 'error' : '' }}">
                            <label>{{ __('app.start_balance') }} <span data-tooltip="{{ __('app.start_balance_hint') }}"><i class="question circle outline large tooltip icon"></i></span></label>
                            <div class="ui right labeled input">
                                <input type="text" name="start_balance" placeholder="{{ __('app.start_balance') }}" value="{{ old('start_balance', $competition->start_balance) }}" required autofocus {{ $editable ? '' : 'disabled' }}>
                                <div class="ui basic label">{{ $competition->currency->code }}</div>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('lot_size') ? 'error' : '' }}">
                            <label>{{ __('app.lot_size') }} <span data-tooltip="{{ __('app.lot_size_hint') }}"><i class="question circle outline large tooltip icon"></i></span></label>
                            <div class="ui input">
                                <input type="text" name="lot_size" placeholder="{{ __('app.lot_size') }}" value="{{ old('lot_size', $competition->lot_size) }}" required autofocus {{ $editable ? '' : 'disabled' }}>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('leverage') ? 'error' : '' }}">
                            <label>{{ __('app.leverage') }} <span data-tooltip="{{ __('app.leverage_hint') }}"><i class="question circle outline large tooltip icon"></i></span></label>
                            <div class="ui input">
                                <input type="text" name="leverage" placeholder="{{ __('app.leverage') }}" value="{{ old('leverage', $competition->leverage) }}" required autofocus {{ $editable ? '' : 'disabled' }}>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('volume_min') ? 'error' : '' }}">
                            <label>{{ __('app.volume_min') }} <span data-tooltip="{{ __('app.volume_min_hint') }}"><i class="question circle outline large tooltip icon"></i></span></label>
                            <div class="ui input">
                                <input type="text" name="volume_min" placeholder="{{ __('app.volume_min') }}" value="{{ old('volume_min', $competition->volume_min) }}" required autofocus {{ $editable ? '' : 'disabled' }}>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('volume_max') ? 'error' : '' }}">
                            <label>{{ __('app.volume_max') }} <span data-tooltip="{{ __('app.volume_max_hint') }}"><i class="question circle outline large tooltip icon"></i></span></label>
                            <div class="ui input">
                                <input type="text" name="volume_max" placeholder="{{ __('app.volume_max') }}" value="{{ old('volume_max', $competition->volume_max) }}" required autofocus {{ $editable ? '' : 'disabled' }}>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('min_margin_level') ? 'error' : '' }}">
                            <label>{{ __('app.min_margin_level') }} <span data-tooltip="{{ __('app.min_margin_level_hint') }}"><i class="question circle outline large tooltip icon"></i></span></label>
                            <div class="ui right labeled input">
                                <input type="text" name="min_margin_level" placeholder="{{ __('app.min_margin_level') }}" value="{{ old('min_margin_level', $competition->min_margin_level) }}" required autofocus {{ $editable ? '' : 'disabled' }}>
                                <div class="ui basic label">%</div>
                            </div>
                        </div>
                        <div class="field {{ $errors->has('status') ? 'error' : '' }}">
                            <label>{{ __('app.status') }}</label>
                            <div id="competition-status-dropdown" class="ui selection {{ $editable ? '' : 'disabled' }} dropdown">
                                <input type="hidden" name="status">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    <div class="item" data-value="{{ $competition->status }}">{{ __('app.competition_status_'.$competition->status) }}</div>
                                    <div class="item" data-value="{{ \App\Models\Competition::STATUS_CANCELLED }}">{{ __('app.competition_status_'.\App\Models\Competition::STATUS_CANCELLED) }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>{{ __('app.start_time') }}</label>
                            <div class="ui input">
                                <input value="{{ $competition->start_time }}" disabled>
                            </div>
                        </div>
                        <div class="field">
                            <label>{{ __('app.end_time') }}</label>
                            <div class="ui input">
                                <input value="{{ $competition->end_time }}" disabled>
                            </div>
                        </div>

                        @packageview('pages.backend.competitions.edit')

                        <div class="field">
                            <label>{{ __('app.created_at') }}</label>
                            <div class="ui input">
                                <input value="{{ $competition->created_at }} ({{ $competition->created_at->diffForHumans() }})" disabled>
                            </div>
                        </div>
                        <div class="field">
                            <label>{{ __('app.created_by') }}</label>
                            <div class="ui input">
                                <input value="{{ $competition->user->name }}" disabled>
                            </div>
                        </div>
                        <div class="field">
                            <label>{{ __('app.updated_at') }}</label>
                            <div class="ui input">
                                <input value="{{ $competition->updated_at }} ({{ $competition->updated_at->diffForHumans() }})" disabled>
                            </div>
                        </div>
                        <button class="ui large {{ $settings->color }} submit {{ $editable ? '' : 'disabled' }} button">
                            <i class="save icon"></i>
                            {{ __('app.save') }}
                        </button>
                        <a href="{{ route('backend.competitions.delete', $competition) }}" class="ui large red submit right floated icon button">
                            <i class="trash icon"></i>
                            {{ __('app.delete') }}
                        </a>
                    </form>
                </div>
            </div>
            <div class="column">
                <a href="{{ route('backend.competitions.index') }}"><i class="left arrow icon"></i> {{ __('app.back_all_competitions') }}</a>
            </div>
        </div>
    </competition-form>
@endsection

@push('scripts')
    <script>
        $('#competition-duration-dropdown').dropdown('set selected', '{{ old('duration', $competition->duration) }}');
        $('#competition-status-dropdown').dropdown('set selected', '{{ old('status', $competition->status) }}');
    </script>
@endpush