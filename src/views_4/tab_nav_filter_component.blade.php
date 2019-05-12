<li class='nav-item'>
	@if($value != null)
	<a class="nav-link {{ $route == Route::currentRouteName() && $filter->hasWhere($field,$value) ? "active" : "" }}"
		href="{{ route($route, $filter->set([$field => $value])) }}">{{ $display }}</a>
	@else
	<a class="nav-link {{ $route == Route::currentRouteName() && !$filter->has($field) ? "active" : "" }}"
		href="{{ route($route, $filter->set([$field => $value])) }}">{{ $display }}</a>
	@endif
</li>
