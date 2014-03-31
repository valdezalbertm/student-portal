@extends('layout')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ Session::get('account_type') }} - Delete Section</title>

    <!-- Bootstrap core CSS -->
    @include('include.css')
@stop

@section('body')
    <div id="wrapper">

      <!-- Sidebar -->
      @include('administrator.sidebar')

      <div id="page-wrapper">
        <div class="row">
        <div class="col-lg-12">
            <h1>Section <small>Delete</small></h1>

            <!-- S: Breadcrumb -->
            <ol class="breadcrumb">
              <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li><a href="{{ route('sec.create') }}"><i class="fa fa-plus"></i> Create</a></li>
              <li><a href="{{ route('sec.index') }}"><i class="fa fa-list"></i> List</a></li>
              <li class="active"><i class="fa fa-trash"></i> Delete</li>
            </ol>
            <!-- E: Breadcrumb -->

            <div class="table-responsive">

                <div class="alert alert-dismissable alert-warning">
                <h4>Delete Account</h4>
                <p align="center">
                    Do you really want to delete account {{ $id }}?
                    <br /><br />
                    {{ Form::open( ['route' => ['sec.destroy', $id], 'method' => 'DELETE'] ) }}
                        <center>
                            {{ Form::submit('OK', ['class' => 'btn btn-warning']) }}
                            {{ link_to('section', 'Cancel', ['class' => 'btn btn-default']); }}
                        </center>
                    {{ Form::close() }}
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
    @include('include.javascript')
@stop