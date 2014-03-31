@extends('administrator/layout')

@section('content')
  <body>

    <div id="wrapper">

        @include('administrator.sidebar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1>
                        <i class="fa fa-certificate"></i> SET SCHOLARSHIP
                        <a href="{{ URL::to('administrator/quiz/'.$quiz_id.'/scholarship/create') }}" type="button" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> ADD SCHOLARSHIP</a>
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

                    @if($scholarships->count() == 0)
                        <div class="alert alert-warning center">
                            NO SCHOLARSHIP ASSIGNED YET
                        </div>
                    @else
                        <table class="table table-striped table-bordered tablesorter">
                            <thead>
                                <tr>
                                    <th class="col-md-1">ID <i class="fa fa-sort"></i></th>
                                    <th class="main">NAME <i class="fa fa-sort"></i></th>
                                    <th class="type">TYPE <i class="fa fa-sort"></i></th>
                                    <th style="min-width:100px;">VALUE <i class="fa fa-sort"></i></th>
                                    <th>SY <i class="fa fa-sort"></i></th>
                                    <th style="width:0px;">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($scholarships as $scholarship)
                                    <tr>
                                        <td class="id">{{ $scholarship->id }}</td>
                                        <td>{{ $scholarship->scholarship->name }}</td>
                                        @foreach($scholarship->scholarship->scholarship_discount as $scholarship_details)
                                            @if($scholarship_details->school_year == $scholarship->school_year)
                                                <td class="center">{{ Str::upper($scholarship_details->type) }}</td>
                                                <td class="center">{{ $scholarship_details->value }}</td>
                                            @endif
                                        @endforeach
                                        <td class="center">{{ $scholarship->school_year }}</td>
                                        <td>
                                            <button href="#" data-toggle="modal" data-target="#delete-{{ $scholarship->id }}" type="button" class="btn btn-warning btn-sm"><i class="fa fa-trash-o"></i> DELETE</button>
                                        </td>
                                    </tr>

                                  <!-- S: DELETE QUIZ MODAL -->
                                    <div class="modal fade" id="delete-{{ $scholarship->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h2 class="modal-title" id="myModalLabel"><i class="fa fa-trash-o"></i> DELETE</h2>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        ARE YOU SURE YOU WANT TO DELETE THIS SCHOLARSHIP?
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    {{ Form::open(array('route' => array('administrator.quiz.scholarship.destroy', $quiz_id, $scholarship->id), 'method' => 'delete','class' => 'pull-right')) }}
                                                        <button type="submit" href="{{ URL::route('administrator.quiz.scholarship.destroy', array($quiz_id, $scholarship->id)) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> DELETE</button>
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