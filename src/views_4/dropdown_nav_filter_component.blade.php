<li class="nav-item dropdown split-button-nav {{ $filter->has($field) ? 'active' : '' }} {{ count($data) == 0 ? 'disabled' : '' }}" {{ count($data) <= 0 ? 'data-toggle="tooltip" data-placement="top" title="There is no data to filter on. Try changing other filters or date ranges"' : '' }}>

    @if($filter->has($field))
      <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">
        <span class="origin_name">{{ $display }}</span>
        @if(!isset($data[$filter->value($field)]))
          <span class="text-danger">Value for {{ $filter->value($field) }} does not exist</span>
        @else
          <span>{{ $data->get($filter->value($field)) ? $data->get($filter->value($field))->name : 'Unknown' }}</span>
        @endif
      </a>
    @else
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <span class="origin_name">{{ $display }}</span>&nbsp;<span class="caret"></span>
      </a>
    @endif

    @if(count($data) > 0)
      <div class="dropdown-menu" role="menu">
        @foreach($data as $row)
          <a class="dropdown-item {{ $filter->hasWhere($field,$row->id) ? 'active' : '' }}" href="{{ route(Route::currentRouteName(), $filter->set([$field => $row->id, 'type' => null] + $unset_on_change) ) }}" >{{ $row->name }}</a>
        @endforeach
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route(Route::currentRouteName(),$filter->except([$field]+$unset_on_remove)) }}"><span class="text-danger fa fa-remove"></span> Remove</a>
      </div>
    @endif
</li>
