@extends('layouts.frontend')

@section('title')
    {{ __('app.rankings') }}
@endsection

@section('content')
    <div class="ui one column tablet stackable grid container">
        <div class="column">
            <table id="rankings-table" class="ui selectable tablet stackable {{ $inverted }} table">
                <thead>
                    <tr>
                        <th>{{ __('app.rank') }}</th>
                        <th>{{ __('users.name') }}</th>
                        <th class="right aligned">
                            <i class="angle down icon"></i>
                            {{ __('app.points') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $i => $user)
                    <tr>
                        <td data-title="{{ __('app.rank') }}">{{ ++$i + $users->perPage() * ($users->currentPage()-1) }}</td>
                        <td data-title="{{ __('users.name') }}">
                            <a href="{{ route('frontend.users.show', $user->id) }}">
                                <img class="ui avatar image" src="{{ $user->avatar_url }}">
                                {{ $user->name }}
                            </a>
                            @if($user->id == auth()->user()->id)
                                <span class="ui {{ $settings->color }} left pointing label">{{ __('app.you') }}</span>
                            @endif
                        </td>
                        <td data-title="{{ __('app.points') }}" class="right aligned">
                            {{ $user->points }}
                            @if(!$user->closedTrades->isEmpty())
                                <span class="tooltip" data-tooltip="{{ __('app.profitable_trades') }}">
                                    <span class="ui tiny green basic label">{{ $user->closedTrades->where('pnl', '>', 0)->count() }}</span>
                                </span>
                                <span class="tooltip" data-tooltip="{{ __('app.unprofitable_trades') }}">
                                    <span class="ui tiny red basic label">{{ $user->closedTrades->where('pnl', '<=', 0)->count() }}</span>
                                </span>
                            @else
                                <span class="tooltip" data-tooltip="{{ __('app.no_closed_trades2') }}">
                                    <span class="ui tiny {{ $settings->color }} basic label">0</span>
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="right aligned column">
            {{ $users->links() }}
        </div>
    </div>
@endsection