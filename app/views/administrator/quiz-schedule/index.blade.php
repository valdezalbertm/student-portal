@extends('administrator/layout')

@section('content')
  <body>

    <div id="wrapper">

        @include('administrator.sidebar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1>
                        <i class="fa fa-calendar"></i> SET SCHEDULE
                        <a href="{{ URL::to('administrator/quiz/'.$quiz_id.'/schedule/create') }}" type="button" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> ADD SCHEDULE</a>
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

                    @if($schedules->count() == 0)
                        <div class="alert alert-warning center">
                            NO SCHOLARSHIP ASSIGNED YET
                        </div>
                    @else
                        <table class="table table-striped table-bordered tablesorter">
                            <thead>
                                <tr>
                                    <th class="col-md-1">ID <i class="fa fa-sort"></i></th>
                                    <th>FROM <i class="fa fa-sort"></i></th>
                                    <th>TO <i class="fa fa-sort"></i></th>
                                    <th class="slot">SLOTS <i class="fa fa-sort"></i></th>
                                    <th class="registered">REGISTERED <i class="fa fa-sort"></i></th>
                                    <th class="available">AVAILABLE <i class="fa fa-sort"></i></th>
                                    <th class="allow-to-take">ALLOW <i class="fa fa-sort"></i></th>
                                    <th style="width: 0px;">ACTIONS <i class="fa fa-sort"></i></th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td class="id center">{{ $schedule->id }}</td>
                                        <td class="center">{{ date('m/d/Y g:i A', strtotime($schedule->from)) }}</td>
                                        <td class="center">{{ date('m/d/Y g:i A', strtotime($schedule->to)) }}</td>
                                        <td class="center">{{ $schedule->slots }}</td>
                                        <td class="center">{{ $schedule->registered }}</td>
                                        <td class="center">{{ $schedule->slots - $schedule->registered }}</td>
                                        <td class="center">{{ ($schedule->allow_to_take == 1) ? 'YES' : 'NO' }}</td>

                                        <td>
                                            <div class="btn-group action">
                                                <button type="button" class="btn btn-success choose-action-schedule">CHOOSE ACTION</button>
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="{{ URL::to('administrator/quiz/' . $quiz_id . '/schedule/' . $schedule->id . '/edit') }}"><i class="fa fa-edit"></i> EDIT</a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#delete-{{ $schedule->id }}"><i class="fa fa-trash-o"></i> DELETE</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                  <!-- S: DELETE QUIZ MODAL -->
                                    <div class="modal fade" id="delete-{{ $schedule->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h2 class="modal-title" id="myModalLabel"><i class="fa fa-trash-o"></i> DELETE</h2>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        ARE YOU SURE YOU WANT TO DELETE THIS SCHEDULE?
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    {{ Form::open(array('route' => array('administrator.quiz.schedule.destroy', $quiz_id, $schedule->id), 'method' => 'delete','class' => 'pull-right')) }}
                                                        <button type="submit" href="{{ URL::route('administrator.quiz.schedule.destroy', array($quiz_id, $schedule->id)) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> DELETE</button>
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