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
            <h1>Announcement <small>List</small></h1>

            <!-- S: Breadcrumb -->
            <ol class="breadcrumb">
              <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-list"></i> List</li>
              <li><a href="{{ route('announce.create') }}"><i class="fa fa-plus"></i> Create</a></li>
            </ol>
            <!-- E: Breadcrumb -->

          </div>

            @if (Session::get('action') == 'ANNOUNCEMENT_SUCCESS')
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <center>Announcement posted successfully!</center>
              </div>
            @endif

          <div class="row">
            <div class="table-responsive">
              <table class="table table-hover table-striped tablesorter" id="user_table" class="user_table">
                  <tr>
                    <td>Subject:</td>
                    <td> <b>{{ $ann[0]->subject }}</b> </td>
                  </tr>
                  <tr>
                    <td>Description: </td>
                    <td> <b>{{ $ann[0]->description }}</b> </td>
                  </tr>
                  <tr>
                    <td>Date Modified:</td>
                    <td> <b>{{ $ann[0]->create_date }}</b> </td>
                  </tr>
              </table>
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    @include('include.javascript')
@stop