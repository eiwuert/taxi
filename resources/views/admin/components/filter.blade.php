@php
$filters = Request::all();
@endphp
@foreach($filters as $filterKey => $filterValue)
<span class="label label-primary">{{ $filterKey }}: {{ $filterValue }}</span>
@endforeach
