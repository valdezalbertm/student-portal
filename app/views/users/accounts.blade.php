@extends('layouts.default')

@section('title')
	<h3>Account Lists of {{ $type }}</h3>
@stop

@section('data')
	{{$accounts->count()}}
	@if ($accounts->count())
	@foreach ($accounts as $account)
		<ul>
			<li>{{ link_to("users/{$account->username}",$account->username) }}</li>
		</ul>
	@endforeach
	@else
		<h2> Nothing Accounts for Account type {{$type}} </h2>
	@endif
@stop