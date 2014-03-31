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
              <li><a href="{{ route('announce.index') }}"><i class="fa fa-list"></i> List</a></li>
              <li class="active"><i class="fa fa-plus"></i> Create</li>
            </ol>
            <!-- E: Breadcrumb -->

          </div>

          @include('admin.prompt')

          <div class="table-responsive">

                        @include('include.error')

                        <table class="table table-hover table-striped tablesorter">
                        <!-- <table class="table table-hover tablesorter"> -->
                        {{ Form::open( array('route' => 'announce.store', 'method' => 'POST')) }}
                        <tr>
                            <td>{{ Form::label('subject', 'Subject:') }}</td>
                            <td>{{ Form::input('text', 'subject', '', ['class' => 'form-control']) }} </td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('description', 'Description:') }}</td>
                            <td>{{ Form::input('text', 'description', '', ['class' => 'form-control']) }} </td>
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
        </div><!-- /.row -->
      </div><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    @include('include.javascript')
@stop