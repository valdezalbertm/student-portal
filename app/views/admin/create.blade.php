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

      <!-- Sidebar -->
      @include('administrator.sidebar')

      <div id="page-wrapper">
	    <div class="row">
        <div class="col-lg-12">
            <h1>User Account <small>Edit</small></h1>

            <div class="table-responsive">
              	<table class="table table-hover table-striped tablesorter">
              	<!-- <table class="table table-hover tablesorter"> -->
				{{ Form::open( array('route' => 'admin.store', 'method' => 'POST')) }}
				<tr>
					<td>{{ Form::label('username', 'Username:') }}</td>
					<td>{{ Form::input('text', 'username', '', ['class' => 'form-control']) }}</td>
				</tr>
				<tr>
					<td>{{ Form::label('account_type', 'Account Type:') }}</td>
					<td>
						{{ Form::select('account_type',
							array(
								'1' => 'Administrator',
								'2' => 'Instructor',
								'3' => 'Student'
							), '1', ['class' => 'form-control'])
						}}
					</td>
				</tr>
				<tr>
					<td>{{ Form::label('password1', 'Password:') }}</td>
					<td>{{ Form::input('password', 'password1', '',['class' => 'form-control']) }}</td>
				</tr>
				<tr>
					<td>{{ Form::label('password2', 'Verify Password:') }}</td>
					<td>{{ Form::input('password', 'password2', '', ['class' => 'form-control']) }}</td>
				</tr>
				<tr>
					<td></td>
					<td>
						{{ Form::submit('Create', ['class' => 'btn btn-success']) }}
						{{ link_to('administrator', 'Cancel', ['class' => 'btn btn-default']); }}
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