@extends('layout')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ Session::get('account_type') }}</title>

    <!-- Bootstrap core CSS -->
    @include('include.css')
@stop

@section('body')
    <div id="wrapper">

      @include('administrator.sidebar')

      <div id="page-wrapper">
        
      @if (Session::get('account_type') == 'Student')
          @include('dashboard.stud')
      @elseif (Session::get('account_type') == 'Professor')
          @include('dashboard.prof')
      @elseif (Session::get('account_type') == 'Administrator')
          @include('dashboard.admin')
      @else
          "No dashboard"
      @endif

      </div><!-- /#page-wrapper -->

      

    </div><!-- /#wrapper -->


    @include('include.javascript')

@stop