@extends('administrator/layout')

@section('content')
  <body>

    <div id="wrapper">

        @include('administrator.sidebar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1>
                        <i class="fa fa-list"></i> CHOICE LIST
                         <a href="{{ URL::to('administrator/quiz/'.$quiz_id.'/question/'.$question_id.'/choice/create') }}" type="button" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> ADD CHOICE</a>
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

                    @if(count($choices) == 0)
                        <div class="alert alert-warning center">
                            THERE ARE NO CHOICES. <a href="{{ URL::to('administrator/quiz/'.$quiz_id.'/question/'.$question_id.'/choice/create') }}"><i class='fa fa-plus'></i> ADD CHOICE</a> 
                        </div>
                    @else
                        <table class="table table-striped table-bordered tablesorter">
                            <thead>
                                <tr>
                                    <th class="col-md-1">ID <i class="fa fa-sort"></i></th>
                                    <th class="main">CONTENT <i class="fa fa-sort"></i></th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                @foreach($choices as $choice)
                                    <tr id="answer-{{ $choice->choice_id }}">
                                        <td class="id">{{ $choice->choice_id }}</td>
                                        <td>
                                            <div>
                                                {{ $choice->choice->content }}
                                            </div>
                                            <div class="answer">
                                                <span class="loading"><i class="fa fa-spinner fa-spin"></i></span>
                                                {{ Question::isCorrect($choice->answer, 'icon', false) }}
                                                <input type="hidden" id="question_id" value="{{ $choice->question_id }}"/>
                                                <input type="hidden" id="choice_id" value="{{ $choice->choice_id }}"/>
                                                <input type="hidden" id="answer" value="{{ $choice->answer }}"/>
                                            </div>
                                        </td>
                                        <td>
                                            <span>
                                            <div class="btn-group action">
                                                <button type="button" class="btn btn-success choose-action-choice">CHOOSE ACTION</button>
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="{{ URL::to('administrator/quiz/'.$quiz_id.'/question/'.$choice->question_id.'/choice/'.$choice->choice_id.'/edit') }}"><i class="fa fa-edit"></i> EDIT</a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#delete-{{ $choice->choice_id }}"><i class="fa fa-trash-o"></i> DELETE</a></li>
                                                    <li class="divider"></li>
                                                    <li><a id="answer-{{ $choice->choice_id }}" class="mark-as" href="#"><i class="fa fa-bookmark-o"></i> MARK AS {{ Question::isCorrect($choice->answer, 'icon', true) }}</a></li>
                                                </ul>
                                            </div>
                                            </span>
                                        </td>
                                    </tr>

                                    <!-- S: DELETE CHOICE MODAL -->
                                    <div class="modal fade" id="delete-{{ $choice->choice_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h2 class="modal-title" id="myModalLabel"><i class="fa fa-trash-o"></i> DELETE</h2>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        ARE YOU SURE YOU WANT TO DELETE THIS CHOICE?
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    {{ Form::open(array('route' => array('administrator.quiz.question.choice.destroy', $quiz_id, $choice->question_id, $choice->choice_id), 'method' => 'delete','class' => 'pull-right')) }}
                                                        <button type="submit" href="{{ URL::route('administrator.quiz.question.choice.destroy', array($quiz_id, $choice->question_id, $choice->choice_id)) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> DELETE</button>
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- S: DELETE CHOICE MODAL -->
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function($) {
            $('.loading').hide();

            $('.mark-as').on('click', function() {
                $answer_id      = this.id

                $question_id    = $('#' + $answer_id + ' #question_id').val();
                $choice_id      = $('#' + $answer_id + ' #choice_id').val();
                $answer         = $('#' + $answer_id + ' #answer').val();

                $loading        = $('#' + $answer_id + ' .loading').hide();
                $answer_icon    = $('#' + $answer_id + ' .answer-icon').hide();

                $(document)
                    .ajaxStart(function () {
                        $loading.show();
                        $answer_icon.hide();
                    })
                    .ajaxStop(function () {
                        $loading.hide();
                        $answer_icon.show();
                    });

                $.ajax({
                    type: "POST",
                    url     : "{{ URL::to('administrator/update-choice-answer') }}",
                    data    : { question_id : $question_id,
                                choice_id   : $choice_id,
                                answer      : $answer }
                }).done(function(response) {
                    $('#' + $answer_id + ' .answer .answer-icon').toggleClass(response[0] + ' ' + response[1]);
                    $('#' + $answer_id + ' .answer .answer-icon i').attr('class', response[2]);

                    $('#' + $answer_id + ' .mark-as .answer-icon').toggleClass(response[1] + ' ' + response[0]);
                    $('#' + $answer_id + ' .mark-as .answer-icon i').attr('class', response[3]);


                    $('#' + $answer_id + ' #answer').val(response[4]);
                });
            } );
         
        });
    </script>
@stop