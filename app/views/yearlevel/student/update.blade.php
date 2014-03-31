@extends('layout')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ Session::get('account_type') }}</title>

    <!-- Bootstrap core CSS -->
    @include('include.css')
    <!-- Page Specific CSS -->
@stop

@section('body')
    <div id="wrapper">

      <!-- Sidebar -->
      @include('administrator.sidebar')

      <div id="page-wrapper">

        <div class="col-lg-12">
            <h2>Year Level <small>Edit</small></h2>
            <div class="table-responsive">

                @include('include.error')
                @include('admin.prompt')

                <table class="table table-hover table-striped tablesorter">
                <!-- <table class="table table-hover tablesorter"> -->
                {{ Form::open( array('route' => ['admin.yr.update', $user->id], 'method' => 'PUT')) }}
                <tr>
                    <td>{{ Form::label('studno', 'Student Number:') }}</td>
                    <td>{{ Form::input('text', 'studno', $user->username, ['class' => 'form-control', 'readonly' => 'readonly']) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('fname', 'Full Name:') }}</td>
                    <td>{{ Form::input('text', 'fname', $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name, ['class' => 'form-control', 'readonly']) }}</td>
                </tr>

                <tr>
                    <td>{{ Form::label('yr', 'Year Level:') }}</td>
                    <td>
                        {{ Form::select('yr', $yr, $user->year_id, ['class' => 'form-control']) }}
                    </td>
                </tr>
                <tr>
                    <td> </td>
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
