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
        <div class="col-lg-12">
          <div class="row">
            <h1>Account <small>List</small></h1>

            <!-- S: Breadcrumb -->
            <ol class="breadcrumb">
              <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li><a href="{{ route('prof.create') }}"><i class="fa fa-plus"></i> Instructor</a></li>
              <li><a href="{{ route('stud.create') }}"><i class="fa fa-plus"></i> Student</a></li>
              <li class="active"><i class="fa fa-list"></i> List</li>
            </ol>
            <!-- E: Breadcrumb -->

          </div>

          @include('admin.prompt')
          @include('admin.accountlist')
          
        </div><!-- /.row -->
      </div><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    @include('include.javascript')
    
@stop