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
            <h1>Account <small>List</small></h1>

            <!-- S: Breadcrumb -->
            <ol class="breadcrumb">
              <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li><a href="{{ route('prof.create') }}"><i class="fa fa-plus"></i> Instructor</a></li>
              <li><a href="{{ route('stud.create') }}"><i class="fa fa-plus"></i> Student</a></li>
              <li class="active"><i class="fa fa-list"></i> List</li>
            </ol>
            <!-- E: Breadcrumb -->

          </div>

          @include('admin.prompt')

          <div class="col-lg-6">
            <div class="row">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="form-group input-group">
                {{ Form::open(['route' => 'admin.search', 'method' => 'POST', 'id' => 'searcher'] ) }}
                <table>
                  <tr>
                    <td>{{ Form::label('user_type', 'Search: &nbsp;') }}</td>
                    <td>
                      {{ Form::select('user_type', ['' => 'All Users', 'Instructor' => 'Instructor', 'Student' => 'Students'], '', ['class' => 'form-control', 'id' => 'user_type',] ) }}
                    </td>
                    <td>
                      {{ Form::input('text', 'skey', '',['class' => 'form-control', 'id' => 'skey', 'placeholder' => 'Enter search key . . .', 'autofocus']) }}
                    </td>
                    <td>
                      {{ Form::submit('Search', ['class' => 'btn btn-success']) }}
                    </td>
                    <td>
                      <i id="spinner" class="fa-li fa fa-spinner fa-spin fa-2x"></i>
                    </td>
                  </tr>
                </table>
                {{ Form::close() }}
              </div>
            </div>
          </div>

          <div class="row">
            <div class="table-responsive">
              <table class="table table-hover table-striped tablesorter" id="user_table" class="user_table">
                <thead>
                  <tr>
                    <th>ID <i class="fa fa-sort"></i></th>
                    <th>Username <i class="fa fa-sort"></i></th>
                    <th>Account Type <i class="fa fa-sort"></i></th>
                    <th>Last Login <i class="fa fa-sort"></i></th>
                    <th><center>Action <i class="fa fa-sort"></i></center></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td> <b>{{ $user->id }}</b> </td>
                      <td> {{ $user->username }} </td>
                      <td> {{ $user->type }} </td>
                      <td> {{ $user->last_login }} </td>
                      <td><center>
                        <a class="btn btn-info btn-sm" href="{{ route('admin.show', $user->id) }}"> <i class="fa fa-eye"></i> View </a>&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-warning btn-sm" href="{{ route('admin.edit', $user->id) }}"> <i class="fa fa-edit"></i> Edit </a>&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-danger btn-sm" href="{{ route('admin.delete', $user->id) }}"> <i class="fa fa-trash-o"></i> Delete </a>
                        </center>
                      </td>
                      <td>

                      <td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->
    @include('admin.accountlist')

    <!-- JavaScript -->
    @include('include.javascript')
    <script>
      var tbnum = {{ $count }};

      $(document).ready(function(){
        //hide spinner
        $("#spinner").hide();

        $('#searcher').bind('submit', function(){
          $.post(
              $(this).prop('action'),
                {"skey": $('#skey').val(), "user_type": $('#user_type').val() }, function(data) {
                for(i = 0; i < tbnum; i++){
                    document.getElementById("user_table").deleteRow(1);
                }
                //set new count
                tbnum = data.count;

                if (data.count > 0) {
                  for(i = 0; i < data.count; i++){
                    var table = document.getElementById("user_table");
                    var row = table.insertRow(1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    var cell5 = row.insertCell(4);
                    cell1.innerHTML = "<b>" + data[i].id + "</b>";
                    cell2.innerHTML = data[i].username;
                    cell3.innerHTML = data[i].type;
                    cell4.innerHTML = data[i].last_login;
                    cell5.innerHTML = "<center><a class='btn btn-info btn-sm' href='http://localhost/web/public/administrator/" + data[i].id + "'> <i class='fa fa-eye'></i> View </a>&nbsp;&nbsp;&nbsp; <a class='btn btn-warning btn-sm' href='http://localhost/studentportal/public/administrator/" + data[i].id + "/edit'> <i class='fa fa-edit'></i> Edit </a>&nbsp;&nbsp;&nbsp;<a class='btn btn-danger btn-sm' href='http://localhost/studentportal/public/administrator/" + data[i].id + "/delete'> <i class='fa fa-trash-o'></i> Delete </a></center>";
                  }
                }
              },
              'json'
          );
          //do anything else you might want to do

          //hide spinner

          //prevent the form from actually submitting in browser
          $("#spinner").hide();
          return false;
        });

        // bind for user keypress
        $('#skey').bind('keyup', function(){
          //show spinner
          $("#spinner").show();
          $('#searcher').submit();
        });

        // bind for combo click
        $('#user_type').bind('click', function(){
          //show spinner
          $("#spinner").show();
          $('#searcher').submit();
        });
      });
    </script>
@stop