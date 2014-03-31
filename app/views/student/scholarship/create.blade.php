@extends('layouts.student_scholarship')

@section('title')
	<title>Assign Student Scholarship</title>
    <link href="{{ URL::asset('/public/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
@stop


@section('data.info.title')
	Student Info
@stop

@section('data.title')
	<h3>Assign Student Scholarship Form</h3>
@stop

@section('data')

	<table class="table table-bordered table-hover table-striped tablesorter">
        <thead>
		<tr>
		    <th class="header"> No. <i class="close fa fa-sort pull-right hidden-phone"></i></th>
		    <th class="header"><i class="fa fa-list-alt"></i> Name <i class="close fa fa-sort pull-right hidden-phone"></i></th>
		    <th class="header"><i class="fa fa-camera-retro"></i> School Year <i class="close fa fa-sort pull-right hidden-phone"></i></th>
		    <th class="header"><i class="fa fa-calendar"></i> Type <i class="close fa fa-sort pull-right hidden-phone"></i></th>
		    <th class="header"><i class="fa fa-calendar"></i> Value <i class="close fa fa-sort pull-right hidden-phone"></i></th>
		</tr>
		</thead>
		<?php $no = 1; ?>
		@foreach ($scholarships as $scholarship)
		<tr>
			<td> {{ $no }} </td>
			<td> {{ $scholarship->scholarship->name }} </td>
			<td> {{ $scholarship->school_year }} </td>
			<td> {{ $scholarship->type  }} </td>
			<td> {{ $scholarship->value }} </td>
			<?php $no++; ?>
		</tr>
		@endforeach
	</table>

	<div class="row col-lg-12">
		<div class="col-lg-9" style="padding-left:0px; padding-right:0px;">
			<?php $post_url = URL::route('administrator.student.scholarship.store',$student->id); ?>
			{{ Form::open(array('url' => $post_url, 'method' => 'post')) }}
				<div class="form-group">
					<i class="fa fa-list-alt"></i>
					{{ Form::label('scholarship_id', 'Scholarship') }}
					{{ Form::select(
						'scholarship_id', 
						$scholarship_options,
						Input::old('scholarship'),
						array('class' => 'form-control','required' => 'true')
						) }}
				</div>
				{{ Form::hidden('student_id',$student->id) }}
				{{ Form::hidden('school_year',$scholarship->school_year) }}
				{{ Form::reset('Reset', array('class' => 'btn btn-default')); }}
				{{ Form::submit('Assign Scholarship', array('class' => 'btn btn-primary pull-right')); }}
			{{ Form::close() }}
		</div>
	</div>
	<br>
	<br>
	<br>
@stop

@section('footer')

@stop
