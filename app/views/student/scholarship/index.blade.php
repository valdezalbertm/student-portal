@extends('layouts.student_scholarship')

@section('title')
	<title>Student Scholarship Records</title>
    <link href="{{ URL::asset('/public/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
@stop

@section('data.info.title')
	Student Info
@stop

@section('data.title')
	<h3>List of Assigned Scholarships</h3>
@stop

@section('data')
	@if ($student->scholarship->count())
	<!-- <div class="alert alert-info alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<pre>
			
		</pre>
	</div> -->
	<table class="table table-bordered table-hover table-striped tablesorter">
        <thead>
		<tr>
		    <th class="header"> No. <i class="close fa fa-sort pull-right hidden-phone"></i></th>
		    <th class="header"><i class="fa fa-list-alt"></i> Name <i class="close fa fa-sort pull-right hidden-phone"></i></th>
		    <th class="header"><i class="fa fa-camera-retro"></i> School Year <i class="close fa fa-sort pull-right hidden-phone"></i></th>
		    <th class="header"><i class="fa fa-calendar"></i> Type <i class="close fa fa-sort pull-right hidden-phone"></i></th>
		    <th class="header"><i class="fa fa-calendar"></i> Value <i class="close fa fa-sort pull-right hidden-phone"></i></th>
		    <th class="header" style="width:100px;"> &nbsp; </th>
		</tr>
		</thead>
		<?php $no = 1; ?>
		@foreach ($student->scholarship as $scholarship)
		<tr>
			<?php 
				//set up links
				$url_id 	= 'delete_form_'.$student->id.'_'.$scholarship->scholarship_id.'_'.$scholarship->school_year;
				$url_data 	= array($student->id,$scholarship->scholarship_id);
				$url_delete = URL::route('administrator.student.scholarship.destroy',$url_data); 

			?>
			<td> {{ $no }} </td>
			<td> {{ $scholarship->scholarship->name }} </td>
			<td> {{ $scholarship->school_year }} </td>
			@foreach ($scholarship->scholarship->discount as $discount)
				@if ($discount->school_year == $scholarship->school_year)
					<td> {{ $discount->type  }} </td>
					<td> {{ $discount->value }} </td>
				@endif
			@endforeach
			<td> 
				<a href="#" onclick="$('#{{$url_id}}').submit();" title="Delete" class="btn btn-default" style="outline:none;">
					<i class="fa fa-times"></i>
				</a>
				{{ Form::open(array('url' => $url_delete, 'method' => 'DELETE', 'id' => $url_id, 'style' => 'display:none;')) }}
					{{ Form::hidden('student',$student->id) }}
					{{ Form::hidden('scholarship',$scholarship->scholarship_id) }}
					{{ Form::hidden('school_year',$scholarship->school_year) }}
				{{ Form::close() }}

			</td>
			<?php $no++; ?>
		</tr>
		@endforeach
	</table>
	@else
		<div class="panel panel-warning">
		    <div class="panel-heading">
			    <i class="fa fa-info-circle"></i>
			    Messages 
		    </div>
		    <div class="panel-body"> No scholarships assigned. </div>
		</div>
	@endif
	 <!-- $scholarships->links()  -->
@stop

@section('footer')
    <!-- Page Specific Plugins -->
    <script src="{{ URL::asset('/public/js/tablesorter/jquery.tablesorter.js'); }}"></script>
    <script src="{{ URL::asset('/public/js/tablesorter/tables.js'); }}"></script>
@stop