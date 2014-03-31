@extends('layout')

@section('head')
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
            <h1>Section <small>List</small></h1>

            <!-- S: Breadcrumb -->
            <ol class="breadcrumb">
              <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li><a href="{{ route('sec.create') }}"><i class="fa fa-plus"></i> Create</a></li>
              <li class="active"><i class="fa fa-table"></i> List</li>
            </ol>
            <!-- E: Breadcrumb -->

            @include('admin.prompt')

            <!-- <div class="col-lg-7">
              <div class="row">
              </div>
            </div>
            <div class="col-lg-5">
              <div class="row">
                <div class="form-group input-group">
                  {{ Form::open(['route' => 'sec.search', 'method' => 'POST'] ) }}
                  <table>
                    <tr>
                      <td>{{ Form::label('skey', 'Search: &nbsp;') }}</td>
                      <td>
                        {{ Form::input('text', 'skey', isset($skey) ? $skey : '', ['class' => 'form-control', 'placeholder' => 'Enter search key . . .']) }}
                      </td>
                      <td>
                        {{ Form::submit('Search', ['class' => 'btn btn-success']) }}
                      </td>
                    </tr>
                  </table>
                  {{ Form::close() }}
                </div>
              </div>
            </div> -->
            <div class="table-responsive">
              <table class="table table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th>ID <i class="fa fa-sort"></i></th>
                    <th>Description <i class="fa fa-sort"></i></th>
                    <th>Year Level <i class="fa fa-sort"></i></th>
                    <th>Students <i class="fa fa-sort"></i></th>
                    <th><center>Action <i class="fa fa-sort"></i></center></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($secs as $sec)
                  <tr>
                    <td> <b>{{ $sec->id }}</b> </td>
                    <td> {{ $sec->name }} </td>
                    <td> {{ $sec->year_level }} </td>
                    <td> {{ $sec->student_no }} </td>
                    <td><center>
                      <a class="btn btn-info btn-sm" href="{{ route('sec.show', $sec->id) }}"> <i class="fa fa-eye"></i> View </a>&nbsp;&nbsp;&nbsp;
                      <a class="btn btn-warning btn-sm" href="{{ route('sec.edit', $sec->id) }}"> <i class="fa fa-edit"></i> Edit </a>&nbsp;&nbsp;&nbsp;
                      <a class="btn btn-danger btn-sm" href="{{ route('sec.delete', $sec->id) }}"> <i class="fa fa-trash-o"></i> Delete </a>
                      </center>
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