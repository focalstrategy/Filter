 <ul class="nav nav-tabs {{ $additional_cl }}">
 	@foreach($components as $nc)
 		{{ $nc->render() }}
 	@endforeach
 </ul>
