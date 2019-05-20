@extends('hello.layouts.db')
@section('content')
<table>
	<tr><th>Name</th><th>Mail</th><th>Age</th></tr>
	@foreach($items as $item)
		<tr>
			<td>{{$item->name}}</td>
			<td>{{$item->email}}</td>
			<td>{{$item->userid}}</td>
		</tr>
	@endforeach
</table>
@endsection