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
                    <h1>Enroll Section <small>{{ $prof->first_name }}</small></h1>

                    <!-- S: Breadcrumb -->
                    <ol class="breadcrumb">
                      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                      <li><a href="{{ route('sec.create') }}"><i class="fa fa-plus"></i> Create</a></li>
                      <li><a href="{{ route('prof_sec.index') }}"><i class="fa fa-list"></i> List</a></li>
                      <li><a href="{{ route('prof_sec.show', [$prof->id]) }}"><i class="fa fa-eye"></i> Show</a></li>
                      <li class="active"><i class="fa fa-plus"></i> Register Section</a></li>
                    </ol>
                    <!-- E: Breadcrumb -->

                </div>
            </div><!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        @include('admin.prompt')
                        @include('include.error')
                        <table class="table table-hover table-striped tablesorter">
                            <thead>
                              <tr>
                                <th>ID <i class="fa fa-sort"></i></th>
                                <th>Name <i class="fa fa-sort"></i></th>
                                <th>Action <i class="fa fa-sort"></i></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($secs as $sec)
                                    <tr>
                                        <td><b>{{ $sec['id'] }}</b></td>
                                        <td>{{ $sec['name'] }}</td>
                                        <td>
                                            @if ($sec['enrolled'] == 'YES')
                                                <a disabled href="{{ route('prof_sec.delete', [$prof->id, $sec['id']] ) }}" class='btn btn-success'><i class="fa fa-plus"></i> Enrolled</a>
                                            @else
                                                {{ Form::open( ['route' => ['prof_sec.store', $prof->id, $sec['id']]], 'POST') }}
                                                    {{ Form::submit('Enroll', ['class' => 'btn btn-info'] ) }}
                                                {{ form::close() }}
                                            @endif
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