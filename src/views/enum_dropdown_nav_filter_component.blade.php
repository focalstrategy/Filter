<li class="nav-item dropdown split-button-nav
  {{ $filter->has($field) ? 'active' : '' }} {{ count($data) == 0 ? 'disabled' : '' }}">

    @if($filter->has($field))
      <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">
        <span class="origin_name">{{ $display }}</span>
        @if(!isset($data[$filter->value($field)]))
          <span class="text-danger">Value for {{ $filter->value($field) }} does not exist</span>
        @else
          <span>{{ $data[$filter->value($field)] }}</span>
        @endif
      </a>
    @else
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <span class="origin_name">{{ $display }}</span>&nbsp;<span class="caret"></span>
      </a>
    @endif

    @if(count($data) > 0)
      <div class="dropdown-menu" role="menu">
        @foreach($data as $k => $v)
          <a class="dropdown-item {{ $filter->hasWhere($field,$k) ? 'active' : '' }}"
            href="{{ route(Route::currentRouteName(), $filter->set([$field => $k, 'type' => null]) ) }}">{{ $v }}</a>
        @endforeach
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route(Route::currentRouteName(),$filter->except([$field])) }}">
          <span class="text-danger fa fa-remove"></span> Remove
        </a>
      </div>
    @endif

</li>
