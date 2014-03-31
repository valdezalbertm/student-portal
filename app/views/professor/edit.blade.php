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
            <h1>Account <small>Add Professor</small></h1>

            <!-- S: Breadcrumb -->
            <ol class="breadcrumb">
              <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li><a href="{{ route('admin.list') }}"><i class="fa fa-list"></i> List</a></li>
              <li><a href="{{ route('prof.create') }}"><i class="fa fa-plus"></i> Create</a></li>
              <li class="active"><i class="fa fa-pencil"></i> Edit</li>
            </ol>
            <!-- E: Breadcrumb -->

            <div class="table-responsive">

                @include('include.error')

              	<table class="table table-hover table-striped tablesorter">
              	<!-- <table class="table table-hover tablesorter"> -->
				{{ Form::open(['route' => ['prof.update', $user->id], 'method' => 'PUT']) }}
				<tr>
					<td>{{ Form::label('username', 'Username:') }}</td>
					<td>{{ Form::input('text', 'username',  $user->username, ['class' => 'form-control', 'readonly' => 'readonly']) }}</td>
				</tr>
                <tr>
                    <td>{{ Form::label('fname', 'First Name:') }}</td>
                    <td>{{ Form::input('text', 'fname', $user->first_name, ['class' => 'form-control']) }}
                    </td>
                </tr>
                <tr>
                    <td>{{ Form::label('mi', 'Middle Name:') }}</td>
                    <td>{{ Form::input('text', 'mi', $user->middle_name, ['class' => 'form-control', 'size' => '2']) }} </td>
                </tr>
                <tr>
                    <td>{{ Form::label('lname', 'Last Name:') }}</td>
                    <td>{{ Form::input('text', 'lname', $user->last_name, ['class' => 'form-control'] ) }}</td>
                </tr>
				<tr>
					<td>{{ Form::label('password1', 'Password:') }}</td>
					<td>{{ Form::input('password', 'password1', '',['class' => 'form-control', 'placeholder' => 'Leave blank to retain password.'] ) }}</td>
				</tr>
				<tr>
					<td>{{ Form::label('password2', 'Verify Password:') }}</td>
					<td>{{ Form::input('password', 'password2', '', ['class' => 'form-control', 'placeholder' => 'Leave blank to retain password.'] ) }}</td>
				</tr>
                <tr>
                    <td>{{ Form::label('contact', 'Contact Number:') }}</td>
                    <td>{{ Form::input('text', 'contact', $user->contact, ['class' => 'form-control'] ) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('email', 'E-mail Address:') }}</td>
                    <td> {{ Form::input('email', 'email', $user->email, ['class' => 'form-control']) }} </td>
                </tr>
                <tr>
                    <td>{{ Form::label('dept', 'Department:') }}</td>
                    <td>
                        {{ Form::select('dept',
                            $dept, $user->dept_id, ['class' => 'form-control'])
                        }}
                    </td>
                </tr>
				<tr>
					<td></td>
					<td>
						{{ Form::submit('Update', ['class' => 'btn btn-success']) }}
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