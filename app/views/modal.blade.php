@extends('layout')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ Session::get('account_type') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('css\bootstrap.css') }}" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="{{ URL::asset('css\sb-admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('font-awesome/css/font-awesome.min.css') }}">
    <!-- Page Specific CSS -->
    <!-- <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css"> -->
@stop

@section('body')
    <!-- S: DELETE QUIZ MODAL -->
    <div class="modal fade" id="deleter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    {{ Form::open(array('route' => array('admin.create'), 'method' => 'delete','class' => 'pull-right')) }}
                        <button type="submit" href="" class="btn btn-danger"><i class="fa fa-trash-o"></i> DELETE</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- S: DELETE QUIZ MODAL -->

    <a data-toggle="modal" data-target="#deleter"><i class="fa fa-trash-o"></i> DELETE</a>

    <link href="css\bootstrap.css" rel="stylesheet">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery-1.10.2.js"></script>
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/transition.js"></script>

    <script src="{{ URL::asset('js/morris/chart-data-morris.js') }}"></script>
        <script src="{{ URL::asset('js/tablesorter/jquery.tablesorter.js') }}"></script>
        <script src="{{ URL::asset('js/tablesorter/tables.js') }}"></script>


@stop