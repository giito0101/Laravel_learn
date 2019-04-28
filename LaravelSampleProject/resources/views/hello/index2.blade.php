@extends('hello.layouts.layout')
@section('title', 'Index')

@section('menuber')
	@parent
@endsection

@section('content')
	<p>ここが本文のコンテンツです。</p>
	<p>必要なだけ記述できます。</p>
	@each('components.item', $data, 'item')
	@include('components.message', ['msg_title'=>'OK', 'msg_content'=>'サブビューです'])
@endsection

@section('fotter')
copyright 2017 tuyano
@endsection