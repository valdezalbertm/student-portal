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
                    <h1>{{ $prof->first_name }} {{ $prof->middle_name }} {{ $prof->last_name }}<small></small></h1>

                    <!-- S: Breadcrumb -->
                    <ol class="breadcrumb">
                      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                      <li><a href="{{ route('sec.create') }}"><i class="fa fa-plus"></i> Create</a></li>
                      <li><a href="{{ route('prof_sec.index') }}"><i class="fa fa-list"></i> List</a></li>
                      <li class="active"><i class="fa fa-eye"></i> Show</a></li>
                      <li><a href="{{ route('prof_sec.create', [$prof->id]) }}"><i class="fa fa-plus"></i> Register Section</a></li>
                    </ol>
                    <!-- E: Breadcrumb -->

                    <div class="table-responsive">
                        @include('admin.prompt')
                        @include('include.error')
                        <h3>Enrolled Sections</h3>
                        <table class="table table-hover table-striped tablesorter">
                            <thead>
                              <tr>
                                <th>ID <i class="fa fa-sort"></i></th>
                                <th>Section ID <i class="fa fa-sort"></i></th>
                                <th>Name <i class="fa fa-sort"></i></th>
                                <th>Action <i class="fa fa-sort"></i></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($secs as $sec)
                                    <tr>
                                        <td><b>{{ $sec->id }}</b></td>
                                        <td>{{ $sec->section_id }}</td>
                                        <td>{{ $sec->section_name }}</td>
                                        <td>
                                            <a href="{{ route('prof_sec.delete', [$prof->id, $sec->section_id]) }}" class='btn btn-warning'><i class="fa fa-eraser"></i> Remove</a>
                                        </td>
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