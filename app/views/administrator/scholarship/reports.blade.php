@extends('administrator/layout')

@section('content')
    <body>

    <div id="wrapper">

        @include('administrator.sidebar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i class="fa fa-copy"></i> SCHOLARSHIP REPORT</h1>
                    <ol class="breadcrumb">
                        {{ $ux->breadcrumbs }}
                    </ol> 
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <span class="pull-right"><i class="fa fa-asterisk"></i> UF = UNFINISHED</span>
                    <!-- S: SHOW MESSAGE STATUS -->
                    @if(Session::has('message'))
                        <div class="alert {{ Session::get('class') }} alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <!-- S: EDIT MESSAGE STATUS -->

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#students" data-toggle="tab">STUDENT</a></li>
                        <li><a href="#applicants" data-toggle="tab">APPLICANT</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="students">
                            @if(count($students) != 0)
                                <a href="{{ URL::to('administrator/scholarship/report/student/print/passed') }}" class="pull-right" target="_blank"><i class="fa fa-print" style="margin-left:10px;"></i> PRINT PASSED</a>

                                <a href="{{ URL::to('administrator/scholarship/report/student/print/all') }}" class="pull-right" target="_blank"><i class="fa fa-print"></i> PRINT ALL</a>
                                <table class="table table-striped table-bordered tablesorter">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">ID <i class="fa fa-sort"></i></th>
                                            <th>NAME <i class="fa fa-sort"></i></th>
                                            <th>SCHOLARSHIP <i class="fa fa-sort"></i></th>
                                            <th class="score">SCORE <i class="fa fa-sort"></i></th>
                                            <th class="percent"><i class="icon-percent"></i> <i class="fa fa-sort"></i></th>
                                            <th>DATE TAKEN <i class="fa fa-sort"></i></th>
                                            <th class="validation">VALIDATION <i class="fa fa-sort"></i></th>
                                            <th ><i class="fa fa-bookmark-o"></i></th>
                                            <th class="validation">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                            <tr id="student-result-{{ $student->id }}">
                                                <td class="center">{{ $student->id }}</td>
                                                <td>{{ $student->student->last_name .', '.$student->student->first_name.' '.$student->student->middle_name.'.'}}</td>
                                                <td class="center">{{ $student->scholarship->name.' - '. $student->school_year }}</td>
                                                <td class="center">{{ ($student->procedure == 'pass' ) ? $student->score.'/'.$student->overall : "UF" }}</td>
                                                <td class="center">{{ ($student->procedure == 'pass' ) ? round(($student->score / $student->overall) * 100, 2) : "UF" }}</td>
                                                <td>{{ date('F d, Y', strtotime($student->date_started)) }}</td>
                                                <td class="center">{{ $student->validation_key or 'UNFINISHED' }}</td>
                                                <td>
                                                    <div class="answer">
                                                        <span class="loading"><i class="fa fa-spinner fa-spin"></i></span>
                                                        {{ StudentScholarshipQuizResult::isPass($student->is_pass, 'icon', false) }}
                                                        <input type="hidden" id="user" value="student"/>
                                                        <input type="hidden" id="result_id" value="{{ $student->id }}"/>
                                                        <input type="hidden" id="is_pass" value="{{ $student->is_pass }}"/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group action">
                                                        <button type="button" class="btn btn-success">CHOOSE ACTION</button>
                                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#" data-toggle="modal" data-target="#delete-{{ $student->id }}"><i class="fa fa-trash-o"></i> DELETE</a></li>
                                                            <?php if($student->procedure == 'pass') { ?>
                                                                <li class="divider"></li>
                                                                <li><a href="{{ URL::to('administrator/scholarship/quiz/student/'.$student->id.'/result') }}" target="_blank"><i class="fa fa-print"></i> PRINT RESULT</a></li>
                                                                <li class="divider"></li>
                                                                <li><a id="student-result-{{ $student->id }}" class="mark-as" href="#"><i class="fa fa-bookmark-o"></i> 
                                                                MARK AS {{ StudentScholarshipQuizResult::isPass($student->is_pass, 'icon', true) }}</a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- S: DELETE QUIZ MODAL -->
                                            <div class="modal fade" id="delete-{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h2 class="modal-title" id="myModalLabel"><i class="fa fa-trash-o"></i> DELETE</h2>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div>
                                                                ARE YOU SURE YOU WANT TO DELETE THIS STUDENT RESULT?
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            {{ Form::open(array('route' => array('administrator.scholarship.report', 'student', $student->id), 'method' => 'delete','class' => 'pull-right')) }}
                                                                <button type="submit" href="{{ URL::route('administrator.scholarship.report', $student->id) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> DELETE</button>
                                                            {{ Form::close() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- S: DELETE QUIZ MODAL -->
                                        @endforeach
                                    </tbody>
                                    </div>
                                </table>
                            @else
                                <div class="alert alert-warning center">
                                    NO STUDENT EXAMINATION YET
                                </div>
                            @endif
                            </div>
                        <div class="tab-pane" id="applicants">
                            @if(count($applicants) != 0)
                                <a href="{{ URL::to('administrator/scholarship/report/applicant/print/passed') }}" class="pull-right" target="_blank"><i class="fa fa-print" style="margin-left:10px;"></i> PRINT PASSED</a>

                                <a href="{{ URL::to('administrator/scholarship/report/applicant/print/all') }}" class="pull-right" target="_blank"><i class="fa fa-print"></i> PRINT ALL</a>
                                <table class="table table-striped table-bordered tablesorter">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">ID <i class="fa fa-sort"></i></th>
                                            <th>NAME <i class="fa fa-sort"></i></th>
                                            <th>SCHOLARSHIP <i class="fa fa-sort"></i></th>
                                            <th class="score">SCORE <i class="fa fa-sort"></i></th>
                                            <th class="percent"><i class="icon-percent"></i> <i class="fa fa-sort"></i></th>
                                            <th>DATE TAKEN <i class="fa fa-sort"></i></th>
                                            <th class="validation">VALIDATION <i class="fa fa-sort"></i></th>
                                            <th ><i class="fa fa-bookmark-o"></i></th>
                                            <th class="validation">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($applicants as $applicant)
                                            <tr id="applicant-result-{{ $applicant->id }}">
                                                <td class="center">{{ $applicant->id }}</td>
                                                <td>{{ $applicant->applicant->last_name .', '.$applicant->applicant->first_name.' '.$applicant->applicant->middle_name.'.'}}</td>
                                                <td class="center">{{ $applicant->scholarship->name.' - '. $applicant->school_year }}</td>
                                                <td class="center">{{ ($applicant->procedure == 'pass' ) ? $applicant->score.'/'.$applicant->overall : "UF" }}</td>
                                                <td class="center">{{ ($applicant->procedure == 'pass' ) ? round(($applicant->score / $applicant->overall) * 100, 2) : "UF" }}</td>
                                                <td>{{ date('F d, Y', strtotime($applicant->date_started)) }}</td>
                                                <td class="center">{{ $applicant->validation_key or 'UNFINISHED' }}</td>
                                                <td>
                                                    <div class="answer">
                                                        <span class="loading"><i class="fa fa-spinner fa-spin"></i></span>
                                                        {{ ApplicantScholarshipQuizResult::isPass($applicant->is_pass, 'icon', false) }}
                                                        <input type="hidden" id="user" value="applicant"/>
                                                        <input type="hidden" id="result_id" value="{{ $applicant->id }}"/>
                                                        <input type="hidden" id="is_pass" value="{{ $applicant->is_pass }}"/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group action">
                                                        <button type="button" class="btn btn-success">CHOOSE ACTION</button>
                                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#" data-toggle="modal" data-target="#delete-{{ $applicant->id }}"><i class="fa fa-trash-o"></i> DELETE</a></li>
                                                            <?php if($applicant->procedure == 'pass') { ?>
                                                                <li class="divider"></li>
                                                                <li><a href="{{ URL::to('administrator/scholarship/quiz/applicant/'.$applicant->id.'/result') }}" target="_blank"><i class="fa fa-print"></i> PRINT RESULT</a></li>
                                                                <li class="divider"></li>
                                                                <li><a id="applicant-result-{{ $applicant->id }}" class="mark-as" href="#"><i class="fa fa-bookmark-o"></i> 
                                                                MARK AS {{ ApplicantScholarshipQuizResult::isPass($applicant->is_pass, 'icon', true) }}</a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- S: DELETE QUIZ MODAL -->
                                            <div class="modal fade" id="delete-{{ $applicant->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h2 class="modal-title" id="myModalLabel"><i class="fa fa-trash-o"></i> DELETE</h2>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div>
                                                                ARE YOU SURE YOU WANT TO DELETE THIS APPLICANT RESULT?
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            {{ Form::open(array('route' => array('administrator.scholarship.report', 'applicant', $applicant->id), 'method' => 'delete','class' => 'pull-right')) }}
                                                                <button type="submit" href="{{ URL::route('administrator.scholarship.report', $applicant->id) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> DELETE</button>
                                                            {{ Form::close() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- S: DELETE QUIZ MODAL -->
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-warning center">
                                    NO APPLICANT EXAMINATION YET
                                </div>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function($) {
            $('.loading').hide();

            $('.mark-as').on('click', function() {
                $result_id_tr      = this.id

                $user       = $('#' + this.id + ' #user').val();
                $result_id  = $('#' + this.id + ' #result_id').val();
                $is_pass    = $('#' + this.id + ' #is_pass').val();

                $loading        = $('#' + this.id + ' .loading').hide();
                $answer_icon    = $('#' + this.id + ' .answer-icon').hide();

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
                    url     : "{{ URL::to('administrator/update-scholarship-status') }}",
                    data    : { user        : $user,
                                result_id   : $result_id,
                                is_pass     : $is_pass }
                }).done(function(response) {
                    $('#' + $result_id_tr + ' .answer .answer-icon').toggleClass(response[0] + ' ' + response[1]);
                    $('#' + $result_id_tr + ' .answer .answer-icon i').attr('class', response[2]);

                    $('#' + $result_id_tr + ' .mark-as .answer-icon').toggleClass(response[1] + ' ' + response[0]);
                    $('#' + $result_id_tr + ' .mark-as .answer-icon i').attr('class', response[3]);


                    $('#' + $result_id_tr + ' #is_pass').val(response[4]);
                });
            } );
         
        });
    </script>
@stop