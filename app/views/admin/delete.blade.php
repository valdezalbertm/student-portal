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

      <!-- Sidebar -->
      @include('administrator.sidebar')

      <div id="page-wrapper">

        <div class="col-lg-12">
            <h1>User Account <small>Delete</small></h1>

            <!-- S: Breadcrumb -->
            <ol class="breadcrumb">
              <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li><a href="{{ route('prof.create') }}"><i class="fa fa-plus"></i> Instructor</a></li>
              <li><a href="{{ route('stud.create') }}"><i class="fa fa-plus"></i> Student</a></li>
              <li><a href="{{ route('stud.create') }}"><i class="fa fa-list"></i> List</a></li>
              <li class="active"><i class="fa fa-trash-o"></i> Delete</li>
            </ol>
            <!-- E: Breadcrumb -->

            <div class="table-responsive">

            	<div class="alert alert-dismissable alert-danger">
                <h4>Delete Forbidden</h4>
                <p align="center">
                	You cannot delete <b>Administrator</b> account.
                	<br /><br />
                  <a href="{{ route('admin.index') }}" class='btn btn-warning'><i class="fa fa-arrow-circle-o-left"></i> Back</a>
                </p>
              </div>
              	<table class="table table-hover tablesorter">

				</table>
            </div>
          </div>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="{{ URL::asset('js/jquery-1.10.2.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.js') }}"></script>

    <!-- Page Specific Plugins -->
    @include('include.javascript')
@stop