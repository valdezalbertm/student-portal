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
              <li class="active"><i class="fa fa-list"></i> List</li>
            </ol>
            <!-- E: Breadcrumb -->

          </div>

          @include('admin.prompt')

          <div class="row">
            <div class="form-group input-group">
              {{ Form::open(['route' => 'admin.search', 'method' => 'POST', 'id' => 'searcher'] ) }}
              <table>
                <tr>
                  <td>{{ Form::label('user_type', 'Student Number: &nbsp;') }}</td>
                  <td>
                    {{ Form::input('text', 'studno', '',['class' => 'form-control', 'id' => 'studno', 'placeholder' => 'Student Number', 'autofocus']) }}
                  </td>
                  <td>
                    {{ Form::submit('View Grades', ['class' => 'btn btn-success']) }}
                  </td>
                </tr>
              </table>
              {{ Form::close() }}
            </div>
          </div>

          <div class="row">
            <div class="table-responsive">
              <table class="table table-hover table-striped tablesorter" id="user_table" class="user_table">
                <thead>
                  <tr>
                    <th>ID <i class="fa fa-sort"></i></th>
                    <th>Username <i class="fa fa-sort"></i></th>
                    <th>First Name <i class="fa fa-sort"></i></th>
                    <th>Middle Name <i class="fa fa-sort"></i></th>
                    <th>Last Name <i class="fa fa-sort"></i></th>
                    <th>Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($studs as $stud)
                    <tr>
                      <td> <b>{{ $stud->id }}</b> </td>
                      <td> {{ $stud->username }} </td>
                      <td> {{ $stud->first_name }} </td>
                      <td> {{ $stud->middle_name }} </td>
                      <td> {{ $stud->last_name }} </td>
                      </td>
                      <td>
                          <a class="btn btn-info btn-sm" href="{{ route('admin.grade.view', $stud->id) }}"> <i class="fa fa-eye"></i> View </a>&nbsp;&nbsp;&nbsp;
                      <td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div><!-- /.row -->

        </div>
      </div><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    @include('include.javascript')

@stop