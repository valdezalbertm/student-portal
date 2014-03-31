@extends('layout')

@section('head')
    <title>{{ Session::get('account_type') }}</title>

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
                    <h1>{{ $sec->name }} <small>{{ $sec->year_level }}</small></h1>

                    <!-- S: Breadcrumb -->
                    <ol class="breadcrumb">
                      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                      <li><a href="{{ route('sec.create') }}"><i class="fa fa-plus"></i> Create</a></li>
                      <li><a href="{{ route('sec.index') }}"><i class="fa fa-list"></i> List</a></li>
                      <li class="active"><i class="fa fa-eye"></i> Show</li>
                      <li><a href="{{ route('sec_stud.create', $sec->id) }}"><i class="fa fa-trash-o"></i> Register Student</a></li>
                    </ol>
                    <!-- E: Breadcrumb -->

                    <div class="table-responsive">
                        @include('admin.prompt')
                        @include('include.error')
                        <h3>Enrolled Students</h3>
                        <table class="table table-hover table-striped tablesorter">
                            <thead>
                              <tr>
                                <th>ID <i class="fa fa-sort"></i></th>
                                <th>First Name <i class="fa fa-sort"></i></th>
                                <th>Middle Name <i class="fa fa-sort"></i></th>
                                <th>Last Name <i class="fa fa-sort"></i></th>
                                <th>Action <i class="fa fa-sort"></i></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($studs as $stud)
                                    <tr>
                                        <td><b>{{ $stud->id }}</b></td>
                                        <td>{{ $stud->first_name }}</td>
                                        <td>{{ $stud->middle_name }}</td>
                                        <td>{{ $stud->last_name }}</td>
                                        <td>
                                            <a href="{{ route('sec_stud.delete', [$sec->id, $stud->student_id] ) }}" class='btn btn-warning'><i class="fa fa-eraser"></i> Remove</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                    </div>
                </div>
            </div><!-- /.row -->

        </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    @include('include.javascript')
@stop