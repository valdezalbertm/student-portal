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
            <h1>Year Level <small>List</small></h1>

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

          <div class="row">
            <div class="table-responsive">
              <table class="table table-hover table-striped tablesorter" id="user_table" class="user_table">
                <thead>
                  <tr>
                    <th>ID <i class="fa fa-sort"></i></th>
                    <th>Username <i class="fa fa-sort"></i></th>
                    <th>Full Name <i class="fa fa-sort"></i></th>
                    <th>Year Level <i class="fa fa-sort"></i></th>
                    <th><center>Action <i class="fa fa-sort"></i></center></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td> <b>{{ $user->id }}</b> </td>
                      <td> {{ $user->username }} </td>
                      <td> {{ $user->first_name }} {{ $user->last_name }}</td>
                      <td> {{ $user->year_name }} </td>
                      <td><center>
                        <a class="btn btn-info btn-sm" href="{{ route('admin.show', $user->id) }}"> <i class="fa fa-eye"></i> View </a>&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-warning btn-sm" href="{{ route('admin.yr.edit', $user->id) }}"> <i class="fa fa-edit"></i> Update </a>&nbsp;&nbsp;&nbsp;
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