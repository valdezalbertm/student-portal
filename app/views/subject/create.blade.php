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
                    <h1>Subject <small>Create</small></h1>

                    <!-- S: Breadcrumb -->
                    <ol class="breadcrumb">
                      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                      <li class="active"><i class="fa fa-plus"></i> Create</li>
                      <li><a href="{{ route('subj.index') }}"><i class="fa fa-list"></i> List</a></li>
                    </ol>
                    <!-- E: Breadcrumb -->

                    <div class="table-responsive">

                        @include('include.error')

                        <table class="table table-hover table-striped tablesorter">
                        <!-- <table class="table table-hover tablesorter"> -->
                        {{ Form::open( array('route' => 'subj.store', 'method' => 'POST')) }}
                        <tr>
                            <td>{{ Form::label('scode', 'Code:') }}</td>
                            <td>{{ Form::input('text', 'scode', '', ['class' => 'form-control']) }} </td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('sname', 'Description:') }}</td>
                            <td>{{ Form::input('text', 'sname', '', ['class' => 'form-control']) }} </td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td>
                                {{ Form::submit('Create', ['class' => 'btn btn-success']) }}
                                {{ link_to('subject', 'Cancel', ['class' => 'btn btn-default']); }}
                            </td>
                        </tr>
                        {{ Form::close() }}
                        </table>
                    </div>
                </div>
            </div><!-- /.row -->

        </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    @include('include.javascript')

@stop