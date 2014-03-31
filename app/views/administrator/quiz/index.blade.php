@extends('administrator/layout')

@section('content')
  <body>

    <div id="wrapper">

        @include('administrator.sidebar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1>
                        <i class="fa fa-list"></i> EXAMINATION LIST
                        <a href="{{ URL::to('administrator/quiz/create') }}" type="button" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> ADD EXAMINATION</a>
                    </h1>
                    <ol class="breadcrumb">
                        {{ $ux->breadcrumbs }}
                    </ol> 
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- S: SHOW MESSAGE STATUS -->
                    @if(Session::has('message'))
                        <div class="alert {{ Session::get('class') }} alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <!-- S: EDIT MESSAGE STATUS -->

                    @if(count($quizzes) == 0)      
                        <div class="alert alert-warning center">
                            THERE ARE NO EXAMINATION. <a href="{{ URL::to('administrator/quiz/create') }}"><i class='fa fa-plus'></i> ADD EXAMINATION</a> 
                        </div>
                    @else             
                        <table class="table table-striped table-bordered tablesorter">
                            <thead>
                                <tr>
                                    <th class="col-md-1">ID <i class="fa fa-sort"></i></th>
                                    <th class="main">TITLE <i class="fa fa-sort"></i></th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quizzes as $quiz)
                                    <tr>
                                        <td class="center">{{ $quiz->id }}</td>
                                        <td>{{ $quiz->title }}</td>
                                        <td>
                                            <div class="btn-group action">
                                                <button type="button" class="btn btn-success choose-action-quiz">CHOOSE ACTION</button>
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#" data-toggle="modal" data-target="#show-{{ $quiz->id }}"><i class="fa fa-eye"></i> SHOW</a></li>
                                                    <li><a href="{{ URL::to('administrator/quiz/' . $quiz->id . '/edit') }}"><i class="fa fa-edit"></i> EDIT</a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#delete-{{ $quiz->id }}"><i class="fa fa-trash-o"></i> DELETE</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="{{ URL::to('administrator/quiz/' . $quiz->id . '/scholarship') }}"><i class="fa fa-certificate"></i> SET SCHOLARSHIP</a></li>
                                                    <li><a href="{{ URL::to('administrator/quiz/' . $quiz->id . '/schedule') }}"><i class="fa fa-calendar"></i> SET SCHEDULE</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="{{ URL::to('administrator/quiz/'.$quiz->id.'/question') }}"><i class="fa fa-question"></i> MANAGE QUESTION</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- S: SHOW QUIZ INFO MODAL -->
                                    <div class="modal fade" id="show-{{ $quiz->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h2 class="modal-title" id="myModalLabel">{{ $quiz->title }}</h2>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        <h4>DESCRIPTION</h4>
                                                    </div>
                                                    <div>
                                                        {{ $quiz->description }}
                                                    </div>
                                                    <div>
                                                        <h4>INSTRUCTION</h4>
                                                    </div>
                                                    <div>
                                                        {{ $quiz->instruction }}
                                                    </div>
                                                    <div>
                                                        <h4>TIME LIMIT</h4>
                                                    </div>
                                                    <div>
                                                        {{ $quiz->time_limit }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- S: SHOW QUIZ INFO MODAL -->

                                    <!-- S: DELETE QUIZ MODAL -->
                                    <div class="modal fade" id="delete-{{ $quiz->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h2 class="modal-title" id="myModalLabel"><i class="fa fa-trash-o"></i> DELETE</h2>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        ARE YOU SURE YOU WANT TO DELETE THIS QUIZ?
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    {{ Form::open(array('route' => array('administrator.quiz.destroy', $quiz->id), 'method' => 'delete','class' => 'pull-right')) }}
                                                        <button type="submit" href="{{ URL::route('administrator.quiz.destroy', $quiz->id) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> DELETE</button>
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- S: DELETE QUIZ MODAL -->

                                    <!-- S: SETTINGS QUIZ MODAL -->
                                    <div class="modal fade" id="settings-{{ $quiz->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h2 class="modal-title" id="myModalLabel"><i class="fa fa-gear"></i> SETTINGS</h2>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        ARE YOU SURE YOU WANT TO DELETE THIS QUIZ?
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    {{ Form::open(array('route' => array('administrator.quiz.destroy', $quiz->id), 'method' => 'delete','class' => 'pull-right')) }}
                                                        <button type="submit" href="{{ URL::route('administrator.quiz.destroy', $quiz->id) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> DELETE</button>
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- S: SETTINGS QUIZ MODAL -->
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</html>
@stop