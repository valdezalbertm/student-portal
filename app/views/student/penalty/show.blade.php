@extends('layouts.violation')

@section('title')
	<title>Edit Student Violation</title>
@stop


@section('data.info.title')
	Student Info
@stop

@section('data.title')
	<h3>Student Violation</h3>
@stop

@section('data')
	<div class="row col-lg-12">
		<div class="col-lg-9" style="padding-left:0px; padding-right:0px;">
				<div class="form-group">
					<i class="fa fa-list-alt"></i>
					{{ Form::label('type', 'Type') }}
					<div class="well">{{$penalty->type}}</div>
				</div>
				<div class="form-group">
					<i class="fa fa-camera-retro"></i>
					{{ Form::label('description', 'Description of Violation') }}
					<div class="well"> {{e($penalty->description)}}</div>
				</div>
				<div class="form-group">
					<i class="fa fa-calendar"></i>
					{{ Form::label('date', 'Date of Violation'); }}
					<div class="well"> {{e($penalty->date)}}</div>
				</div>
				<?php 
					$url_data = array($student->id,$penalty->id);
					$url_edit = URL::route('administrator.student.penalty.edit', $url_data); 
				?>
				<a href="{{$url_edit}}" title="Edit" class="btn btn-danger pull-right" style="outline:none;">
					<i class="fa fa-edit"></i>
					Edit Violation
				</a>
		</div>
	</div>
	<br>
	<br>
	<br>
@stop

@section('footer')

@stop
