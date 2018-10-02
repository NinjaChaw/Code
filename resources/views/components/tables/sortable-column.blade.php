<th class="{{ isset($class) ? $class : '' }}">
    @if($id == $sort)
        <i class="angle {{ $order == 'asc' ? 'up' : 'down' }} icon"></i>
    @endif
    <a href="{{ route(Route::currentRouteName(), array_merge(request()->route()->parameters, ['sort' => $id, 'order' => $id != $sort ? 'asc' : ($order == 'asc'  ? 'desc' : 'asc')])) }}">
        {{ $slot }}
    </a>
</th>