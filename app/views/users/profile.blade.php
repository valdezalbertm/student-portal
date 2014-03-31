@extends('layouts.default')

@section('title')
	<h3>Profile</h3>
@stop

@section('data')
	<h4>
		Hello, {{ $username }}
	</h4>
	<a href="#" onclick="history.back()">&lt;&lt; Back</a>
@stop