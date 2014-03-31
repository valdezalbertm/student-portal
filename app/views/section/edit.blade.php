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
                    <h1>Section <small>Update</small></h1>

                    <!-- S: Breadcrumb -->
                    <ol class="breadcrumb">
                      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                      <li><a href="{{ route('sec.create') }}"><i class="fa fa-plus"></i> Create</a></li>
                      <li><a href="{{ route('sec.index') }}"><i class="fa fa-list"></i> List</a></li>
                      <li class="active"><i class="fa fa-pencil"></i> Edit</li>
                    </ol>
                    <!-- E: Breadcrumb -->

                    <div class="table-responsive">

                        @include('include.error')

                        <table class="table table-hover table-striped tablesorter">
                        <!-- <table class="table table-hover tablesorter"> -->
                        {{ Form::open( ['route' => ['sec.update', $sec->id], 'method' => 'PUT']) }}
                        <tr>
                            <td>{{ Form::label('id', 'ID:') }}</td>
                            <td>{{ Form::input('text', 'id', $sec->id, ['class' => 'form-control', 'readonly', 'readonly']) }} </td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('name', 'Description:') }}</td>
                            <td>{{ Form::input('text', 'name', $sec->name, ['class' => 'form-control', 'required']) }} </td>
                        </tr>
                    <tr>
                        <td>{{ Form::label('yr_lvl', 'Year Level: ') }}</td>
                        <td>
                            {{ Form::select('yr_lvl', $yr_lvl, $sec->year_id, ['class' => 'form-control', 'required']) }}
                        </td>
                    </tr>
                        <tr>
                            <td> </td>
                            <td>
                                {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
                                {{ link_to('section/index', 'Cancel', ['class' => 'btn btn-default']); }}
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