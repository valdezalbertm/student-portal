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

				@if (Session::get('action') == 'UPDATE_FAILED')
					<div class="alert alert-danger alert-dismissable">
				          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				          <center>Update failed. Password did not match!</center>
				    </div>
				@endif

				<div class="col-lg-12">
			    	<h1>Password <small>Edit</small></h1>

                        <!-- S: Breadcrumb -->
                        <ol class="breadcrumb">
                          <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                          <li><a href="{{ route('prof.create') }}"><i class="fa fa-plus"></i> Instructor</a></li>
                          <li><a href="{{ route('stud.create') }}"><i class="fa fa-plus"></i> Student</a></li>
                          <li><a href="{{ route('stud.create') }}"><i class="fa fa-list"></i> List</a></li>
                          <li class="active"><i class="fa fa-pencil"></i> Edit</li>
                        </ol>
                        <!-- E: Breadcrumb -->

			    	<div class="table-responsive">
			      		<!-- <table class="table table-hover table-striped tablesorter"> -->
				      	<table class="table table-hover table-striped tablesorter">
						{{ Form::open( array('route' => ['admin.update', $user->id], 'method' => 'PUT')) }}
						<tr>
							<td>{{ Form::label('username', 'Username:') }}</td>
							<td>{{ Form::input('text', 'username', $user->username,
								['readonly' => 'readonly', 'class' => 'form-control']) }}</td>
						</tr>
                        <tr>
                            <td>{{ Form::label('account_type', 'Account Type:') }}</td>
                            <td>{{ Form::input('text', 'account_type', 'Administrator',['class' => 'form-control', 'readonly']) }}</td>
                        </tr>
						<tr>
							<td>{{ Form::label('password1', 'Password:') }}</td>
							<td>{{ Form::input('password', 'password1', '',['class' => 'form-control', 'placeholder' => 'Enter new password', 'required']) }}</td>
						</tr>
						<tr>
							<td>{{ Form::label('password2', 'Verify Password:') }}</td>
							<td>{{ Form::input('password', 'password2', '', ['class' => 'form-control', 'placeholder' => 'Re-enter new password.', 'required']) }}</td>
						</tr>
						<tr>
							<td> </td>
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
    <script src="{{ URL::asset('js/jquery-1.10.2.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.js') }}"></script>

    <!-- Page Specific Plugins -->
    @include('include.javascript')
@stop