@extends('layouts.backend')

@section('title')
    {{ __('users.users') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        <div class="column">
            <table class="ui selectable tablet stackable {{ $inverted }} table">
                <thead>
                <tr>
                    @component('components.tables.sortable-column', ['id' => 'id', 'sort' => $sort, 'order' => $order])
                        {{ __('users.id') }}
                    @endcomponent
                    @component('components.tables.sortable-column', ['id' => 'name', 'sort' => $sort, 'order' => $order])
                        {{ __('users.name') }}
                    @endcomponent
                    @component('components.tables.sortable-column', ['id' => 'email', 'sort' => $sort, 'order' => $order])
                        {{ __('users.email') }}
                    @endcomponent
                    @component('components.tables.sortable-column', ['id' => 'status', 'sort' => $sort, 'order' => $order])
                        {{ __('users.status') }}
                    @endcomponent
                    @component('components.tables.sortable-column', ['id' => 'last_login_time', 'sort' => $sort, 'order' => $order, 'class' => 'right aligned'])
                        {{ __('users.last_login_time') }}
                    @endcomponent
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td data-title="{{ __('users.id') }}">{{ $user->id }}</td>
                        <td data-title="{{ __('users.name') }}">
                            <a href="{{ route('backend.users.edit', $user) }}">
                                <img class="ui avatar image" src="{{ $user->avatar_url }}">
                                {{ $user->name }}
                            </a>
                            {!! $user->role == App\Models\User::ROLE_ADMIN ? '<span class="ui basic tiny red label">' . __('users.role_'.$user->role) . '</span>' : '' !!}
                            @if($user->profiles)
                                @foreach($user->profiles as $profile)
                                    <span class="tooltip" data-tooltip="{{ __('app.profile_id') }}: {{ $profile->provider_user_id }}">
                                        <i class="grey {{ $profile->provider_name }} icon"></i>
                                    </span>
                                @endforeach
                            @endif
                        </td>
                        <td data-title="{{ __('users.email') }}">
                            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                        <td data-title="{{ __('users.status') }}"><i class="{{ $user->status == App\Models\User::STATUS_ACTIVE ? 'check green' : 'red ban' }} large icon"></i> {{ __('users.status_' . $user->status) }}</td>
                        <td data-title="{{ __('users.last_login_time') }}">
                            {{ $user->last_login_time->diffForHumans() }}
                            <span data-tooltip="{{ $user->last_login_time }}">
                                <i class="calendar outline tooltip icon"></i>
                            </span>
                        </td>
                        <td class="right aligned tablet-and-below-center">
                            <a class="ui icon {{ $settings->color }} basic button" href="{{ route('backend.users.edit', $user) }}">
                                <i class="edit icon"></i>
                                {{ __('users.edit') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="right aligned column">
            {{ $users->appends(['sort' => $sort])->appends(['order' => $order])->links() }}
        </div>
    </div>
@endsection