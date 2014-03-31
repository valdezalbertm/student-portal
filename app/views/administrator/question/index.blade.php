@extends('administrator/layout')

@section('content')
  <body>

    <div id="wrapper">

        @include('administrator.sidebar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1>
                        <i class="fa fa-list"></i> QUESTION LIST
                        <a href="{{ URL::to('administrator/quiz/'.$quiz_id.'/question/create') }}" type="button" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> ADD QUESTION</a>
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

                    @if(count($questions) == 0)
                        <div class="alert alert-warning center">
                            THERE ARE NO QUESTIONS. <a href="{{ URL::to('administrator/quiz/'.$quiz_id.'/question/create') }}"><i class='fa fa-plus'></i> ADD QUESTION</a> 
                        </div>
                    @else
                        <table class="table table-striped table-bordered tablesorter">
                            <thead>
                                <tr>
                                    <th class="col-md-1">ID <i class="fa fa-sort"></i></th>
                                    <th class="col-md-2">SUBJECT <i class="fa fa-sort"></i></th>
                                    <th class="main">QUESTION <i class="fa fa-sort"></i></th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($questions as $question)
                                    <tr>
                                        <td class="id">{{ $question->question->id }}</td>
                                        <td class="center">{{ $question->subject->name }}</td>
                                        <td>{{ $question->question->content }}</td>
                                        <td>
                                            <div class="btn-group action">
                                                <button type="button" class="btn btn-success choose-action-question">CHOOSE ACTION</button>
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#" data-toggle="modal" data-target="#show-{{ $question->question_id }}"><i class="fa fa-eye"></i> SHOW</a></li>
                                                    <li><a href="{{ URL::to('administrator/quiz/'.$question->quiz_id.'/question/'.$question->question_id.'/edit') }}"><i class="fa fa-edit"></i> EDIT</a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#delete-{{ $question->question_id }}"><i class="fa fa-trash-o"></i> DELETE</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="{{ URL::to('administrator/quiz/'.$question->quiz_id.'/question/'.$question->question_id.'/choice') }}"><i class="fa fa-list-ul"></i> MANAGE CHOICES</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- S: SHOW QUIZ INFO MODAL -->
                                    <div class="modal fade" id="show-{{ $question->question->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <div>
                                                        <h2>QUESTION</h2>
                                                    </div>
                                                    <div class="modal-show">
                                                        {{ $question->question->content }}
                                                    </div>
                                                </div>
                                                <div class="modal-body">

                                                    <div>
                                                        <h4>NO OF CHOICES</h4>
                                                    </div>
                                                    <div class="modal-show">
                                                        {{ count($question->question->question_choice) }}
                                                    </div>
                                                    <div>
                                                        <h4>ANSWER</h4>
                                                    </div>
                                                    <div class="modal-show">    
                                                        <?php $answer = 0; ?>    

                                                        @if(count($question->question->question_choice) != 0) 
                                                            @foreach($question->question->question_choice as $choice)
                                                                @if($choice->answer == '1')
                                                                    <li>{{ $choice->choice->content }}</li>
                                                                    <?php $answer += 1; ?>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        {{ $answer == 0 ? 'NOT SET' : '' }}
                                                    </div>
                                                    <div>
                                                        <h4>TYPE</h4>
                                                    </div>
                                                    <div class="modal-show">
                                                        {{ $question->question->question_type->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- S: SHOW QUIZ INFO MODAL -->

                                    <!-- S: DELETE QUIZ MODAL -->
                                    <div class="modal fade" id="delete-{{ $question->question_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                    {{ Form::open(array('route' => array('administrator.quiz.question.destroy', $question->quiz_id, $question->question_id), 'method' => 'delete','class' => 'pull-right')) }}
                                                        <button type="submit" href="{{ URL::route('administrator.quiz.question.destroy', array($question->quiz_id, $question->question_id)) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> DELETE</button>
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- S: DELETE QUIZ MODAL -->
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