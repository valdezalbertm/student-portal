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
            <h2>Student <small>Edit</small></h2>
            <div class="table-responsive">

                @include('include.error')

                <table class="table table-hover table-striped tablesorter">
                <!-- <table class="table table-hover tablesorter"> -->
                {{ Form::open( array('route' => ['stud.update', $user->id], 'method' => 'PUT', 'files'=> true, 'enctype' => 'multipart/form-data')) }}
                <tr>
                    <td>{{ Form::label('studno', 'Student Number:') }}</td>
                    <td>{{ Form::input('text', 'studno', $user->username, ['class' => 'form-control', 'readonly' => 'readonly']) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('account_type', 'Account Type:') }}</td>
                    <td>{{ Form::input('text', 'account_type', 'Student', ['class' => 'form-control', 'readonly' => 'readonly']) }} </td>
                </tr>
                <tr>
                    <td>{{ Form::label('fname', 'First Name:') }}</td>
                    <td>{{ Form::input('text', 'fname', $user->first_name, ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('mi', 'Middle Name:') }}</td>
                    <td>{{ Form::input('text', 'mi', $user->middle_name, ['class' => 'form-control', 'size' => '2']) }} </td>
                </tr>
                <tr>
                    <td>{{ Form::label('lname', 'Last Name:') }}</td>
                    <td>{{ Form::input('text', 'lname', $user->last_name, ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('gender', 'Gender:') }}</td>
                    <td>
                        @if ($user->gender == 'Male')
                            <div class="col-lg-2">
                                {{ Form::radio('gender', 'Male', true) }} Male
                            </div>
                            <div class="col-lg-2">
                                {{ Form::radio('gender', 'Female') }} Female
                            </div>
                        @else
                            <div class="col-lg-2">
                                {{ Form::radio('gender', 'Male') }} Male
                            </div>
                            <div class="col-lg-2">
                                {{ Form::radio('gender', 'Female', true) }} Female
                            </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td> {{ Form::label('bday', 'Birthday:') }} </td>
                    <td>
                        <div class="col-lg-2">
                            {{ Form::select('bdate', $bdate, $user->bdate, ['class' => 'form-control']) }}
                        </div>
                        <div class="col-lg-3">
                            {{ Form::select('bmonth', $bmonth, $user->bmonth, ['class' => 'form-control']) }}
                        </div>
                        <div class="col-lg-3">
                            {{ Form::select('byear', $byear, $user->byear, ['class' => 'form-control']) }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>{{ Form::label('yr', 'Year Level:') }}</td>
                    <td>
                        {{ Form::select('yr', $yr, $user->year_id, ['class' => 'form-control']) }}
                    </td>
                </tr>
                <tr>
                    <td>{{ Form::label('password1', 'Password:') }}</td>
                    <td>{{ Form::input('password', 'password1', '',['class' => 'form-control', 'placeholder' => 'Leave blank to retain password.']) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('password2', 'Verify Password:') }}</td>
                    <td>{{ Form::input('password', 'password2', '', ['class' => 'form-control', 'placeholder' => 'Leave blank to retain password.']) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('contact', 'Contact Number:') }}</td>
                    <td>{{ Form::input('text', 'contact', $user->contact, ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('email', 'E-mail Address:') }}</td>
                    <td> {{ Form::input('email', 'email', $user->email, ['class' => 'form-control']) }} </td>
                </tr>
                <tr>
                    <td>{{ Form::label('picture', 'Browse Picture:') }}</td>
                    <td>{{ Form::file('picture', ['class' => 'form-control']) }}</td>
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