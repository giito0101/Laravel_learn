@extends('board.layouts.layout')

@section('title', 'Board Add')

@section('menubar')
	@parent
	投稿ページ
@endsection
	@if(count($errors) > 0)
	<div>
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
@section('content')
	<table>
	<form action="/LaravelSampleProject/board/add" method="POST">
		{{ csrf_field()}}
		<tr><th>test id:</th><td><input type="number" name="test_id"></td></tr>
		<tr><th>title:</th><td><input type="text" name="title"></td></tr>
		<tr><th>message:</th><td><input type="test" name="message"></td></tr>
		<tr><th></th><td><input type="submit" value="send"></td></tr>
	</form>
	</table>
@endsection
@section('footer')
copyright 2017 itoga
@endsection