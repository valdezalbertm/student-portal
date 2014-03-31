@extends('layouts.violation')

@section('title')
	<title>Add Student Violation Record</title>
@stop


@section('data.info.title')
	Student Info
@stop

@section('data.title')
	<h3>Add Student Violation Form</h3>
@stop

@section('data')
	<div class="row col-lg-12">
		<div class="col-lg-9" style="padding-left:0px; padding-right:0px;">
			<?php $post_url = URL::route('administrator.student.penalty.store',$student->id); ?>
			{{ Form::open(array('url' => $post_url, 'method' => 'post')) }}
				<div class="form-group">
					<i class="fa fa-list-alt"></i>
					{{ Form::label('type', 'Type') }}
					{{ Form::select(
						'type', 
						array( 'minor' => 'Minor Offense', 'major' => 'Major Offense'),
						Input::old('type'),
						array('class' => 'form-control','required' => 'true')
						) }}
				</div>
				<div class="form-group">
					<i class="fa fa-camera-retro"></i>
					{{ Form::label('description', 'Description of Violation') }}
					{{ Form::textarea('description', 
						Input::old('description'), 
						array(
							'class' => 'form-control','placeholder' => 'Description',
							'required' => 'true','maxlenght' => '450')); }}
				</div>
				<div class="form-group">
					<i class="fa fa-calendar"></i>
					{{ Form::label('date', 'Date of Violation'); }}
					{{ Form::text('date', 
						Input::old('date'), 
						array(
							'class' => 'form-control','placeholder' => 'Date','required' => 'true')); }}
				</div>
				{{ Form::hidden('id',$student->id) }}
				{{ Form::reset('Reset', array('class' => 'btn btn-default')); }}
				{{ Form::submit('Save Violation', array('class' => 'btn btn-primary pull-right')); }}
			{{ Form::close() }}
		</div>
	</div>
	<br>
	<br>
	<br>
@stop

@section('footer')

@stop
