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
                    <h1>Subject <small>View</small></h1>

                    <!-- S: Breadcrumb -->
                    <ol class="breadcrumb">
                      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                      <li><a href="{{ route('subj.create') }}"><i class="fa fa-plus"></i> Create</a></li>
                      <li><a href="{{ route('subj.index') }}"><i class="fa fa-list"></i> List</a></li>
                      <li class="active"><i class="fa fa-eye"></i> Show</li>
                    </ol>
                    <!-- E: Breadcrumb -->

                    <div class="table-responsive">

                        @include('include.error')

                        <table class="table table-hover table-striped tablesorter">
                            <tr>
                                <td>ID:</td>
                                <td><strong>{{ $subj->id }}</strong></td>
                            </tr>
                            <tr>
                                <td>Code:</td>
                                <td><strong>{{ $subj->code }}</strong></td>
                            </tr>
                            <tr>
                                <td>Description:</td>
                                <td><strong>{{ $subj->name }}</strong></td>
                            </tr>
                        </table>
                        <div align="center" class="col-lg-10">
                            <a href="{{ route('subj.edit', $subj->id) }}" class='btn btn-info'><i class="fa fa-pencil"></i> Edit</a>
                            {{ link_to('subject', 'Cancel', ['class' => 'btn btn-default']); }}
                            <!-- <a href="{{ route('subj.delete', $subj->id) }}" class='btn btn-warning'><i class="fa fa-eraser"></i> Delete</a> -->
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->

        </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    @include('include.javascript')
@stop