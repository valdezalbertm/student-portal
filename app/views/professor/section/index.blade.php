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
            <h1>Professor <small>List</small></h1>

            <!-- S: Breadcrumb -->
            <ol class="breadcrumb">
              <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li><a href="{{ route('sec.create') }}"><i class="fa fa-plus"></i> Create</a></li>
              <li><a href="{{ route('sec.index') }}"><i class="fa fa-list"></i> List</a></li>
            </ol>
            <!-- E: Breadcrumb -->

          </div>

          @include('admin.prompt')

          <div class="row">
            <div class="table-responsive">
              <table class="table table-hover table-striped tablesorter" id="user_table" class="user_table">
                <thead>
                  <tr>
                    <th>ID <i class="fa fa-sort"></i></th>
                    <th>First Name <i class="fa fa-sort"></i></th>
                    <th>Middle Name <i class="fa fa-sort"></i></th>
                    <th>Last Name <i class="fa fa-sort"></i></th>
                    <th>Section <i class="fa fa-sort"></i></th>
                    <th><center>Action <i class="fa fa-sort"></i></center></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td> <b>{{ $user->id }}</b> </td>
                      <td> {{ $user->first_name }} </td>
                      <td> {{ $user->middle_name }} </td>
                      <td> {{ $user->last_name }} </td>
                      <td> {{ $user->section_handled }} </td>
                      <td><center>
                        <a class="btn btn-info btn-sm" href="{{ route('prof_sec.show', $user->id) }}"> <i class="fa fa-eye"></i> View </a>
                        </center>
                      </td>
                      <td>

                      <td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    @include('include.javascript')
@stop