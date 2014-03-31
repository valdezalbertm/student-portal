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
                    <h1>{{ $stud->first_name }} {{ $stud->middle_name }}. {{ $stud->last_name }}<small> Encode</small></h1>

                    <!-- S: Breadcrumb -->
                    <ol class="breadcrumb">
                      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                      <li><a href="{{ route('sec.create') }}"><i class="fa fa-plus"></i> Create</a></li>
                      <li><a href="{{ route('sec.index') }}"><i class="fa fa-list"></i> List</a></li>
                      <li class="active"><i class="fa fa-eye"></i> Show</li>
                    </ol>
                    <!-- E: Breadcrumb -->
                    
                    <!-- S: Prompt -->
                    @include('admin.prompt')
                    @include('include.error')
                    <!-- E: Prompt -->

                    <div class="table-responsive"> 
                        <!-- S: First Grading -->
                        {{ Form::open( array('route' => ['grade.store', $sec->id, $stud->id], 'method' => 'POST')) }}
                        <h4>First Grading Period</h4>
                        <table class="table table-hover table-striped tablesorter">
                            <thead>
                                <tr>
                                    @foreach ($grade as $g)
                                        @if ($g->school_year == 1)
                                            <th> {{ $g->name }} </th>    
                                        @endif
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($grade as $g)
                                        @if ($g->school_year == 1)
                                            <td>{{ Form::input('text', $g->code, $g->score, ['class' => 'form-control']) }}</td>
                                        @endif
                                    @endforeach            
                                </tr>
                            </tbody>
                        </table>
                        <br />
                        <!-- E: First Grading -->

                        <!-- S: Second Grading -->
                            <h4>Second Grading Period</h4>
                            <table class="table table-hover table-striped tablesorter">
                                <thead>
                                    <tr>
                                        @foreach ($grade as $g)
                                            @if ($g->school_year == 2)
                                                <th> {{ $g->name }} </th>    
                                            @endif
                                        @endforeach
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($grade as $g)
                                            @if ($g->school_year == 2)
                                                <td>{{ Form::input('text', $g->code, $g->score, ['class' => 'form-control']) }}</td>
                                            @endif
                                        @endforeach            
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                        <!-- E: Second Grading -->

                        <!-- S: Third Grading-->
                        <h4>Third Grading Period</h4>
                        <table class="table table-hover table-striped tablesorter">
                            <thead>
                                <tr>
                                    @foreach ($grade as $g)
                                        @if ($g->school_year == 3)
                                            <th> {{ $g->name }} </th>    
                                        @endif
                                    @endforeach
                              </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($grade as $g)
                                        @if ($g->school_year == 3)
                                            <td>{{ Form::input('text', $g->code, $g->score, ['class' => 'form-control']) }}</td>
                                        @endif
                                    @endforeach            
                                </tr>
                            </tbody>
                        </table>
                        <br />
                        <!-- E: Third Grading -->

                        <!-- S: Fourth Grading -->
                        <h4>Fourth Grading Period</h4>
                        <table class="table table-hover table-striped tablesorter">
                            <thead>
                                <tr>
                                    @foreach ($grade as $g)
                                        @if ($g->school_year == 4)
                                            <th> {{ $g->name }} </th>    
                                        @endif
                                    @endforeach
                              </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($grade as $g)
                                        @if ($g->school_year == 4)
                                            <td>{{ Form::input('text', $g->code, $g->score, ['class' => 'form-control']) }}</td>
                                        @endif
                                    @endforeach            
                                </tr>
                            </tbody>
                        </table>
                        <br />
                        <!-- E: Fourth Grading -->
                    <center>
                            {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
                            {{ link_to('grade', 'Cancel', ['class' => 'btn btn-default']); }}
                        </center>
                        {{ Form::close() }}
                    </div>
                </div>
            </div><!-- /.row -->

        </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    @include('include.javascript')
@stop