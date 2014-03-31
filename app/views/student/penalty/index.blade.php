@extends('layouts.violation')

@section('title')
	<title>Student Violation Records</title>
    <link href="{{ URL::asset('/public/css/bootstrap-responsive.min.css'); }}" rel="stylesheet">
@stop

@section('data.info.title')
	Student Info
@stop

@section('data.title')
	<h3>List Of student penalty</h3>
@stop

@section('data')
	@if ($records->count())
	<!-- <div class="alert alert-info alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<pre>
			
		</pre>
	</div> -->
	<table class="table table-bordered table-hover table-striped tablesorter">
        <thead>
		<tr>
		    <th class="header"> No. <i class="close fa fa-sort pull-right hidden-phone"></i></th>
		    <th class="header"><i class="fa fa-list-alt"></i> Type <i class="close fa fa-sort pull-right hidden-phone"></i></th>
		    <th class="header"><i class="fa fa-camera-retro"></i> Description <i class="close fa fa-sort pull-right hidden-phone"></i></th>
		    <th class="header"><i class="fa fa-calendar"></i> Date Reported <i class="close fa fa-sort pull-right hidden-phone"></i></th>
		    <th class="header" style="width:100px;"> &nbsp; </th>
		</tr>
		</thead>
		<?php $no = 1; ?>
		@foreach ($records as $record)
		<tr>
			<td> {{ $no }} </td>
			<td> {{ $record->type }} </td>
			<td> 
				<?php 
					//set up links
					$url_id 	= 'delete_form_'.$student->id.'_'.$record->id;
					$url_data 	= array($student->id,$record->id);
					$url_edit 	= URL::route('administrator.student.penalty.edit', $url_data); 
					$url_show 	= URL::route('administrator.student.penalty.show', $url_data); 
					$url_delete = URL::route('administrator.student.penalty.destroy',$url_data); 

					$description = 
						strlen($record->description) > 50 ?
							substr($record->description, 0, 50)."..." :
							$record->description;

				?>
				{{ e($description) }} 
				<a href="{{$url_show}}" class="pull-right">
					Show More
					<i class="fa fa-arrow-circle-right"></i>
				</a>
			</td>
			<td> {{ e($record->date) }} </td>
			<td> 
				<a href="{{$url_edit}}" title="Edit" class="btn btn-default" style="outline:none;">
					<i class="fa fa-edit"></i>
				</a>
				<a href="#" onclick="$('#{{$url_id}}').submit();" title="Delete" class="btn btn-default" style="outline:none;">
					<i class="fa fa-times"></i>
				</a>
				{{ Form::open(array('url' => $url_delete, 'method' => 'DELETE', 'id' => $url_id, 'style' => 'display:none;')) }}
					{{ Form::hidden('student',$student->id) }}
					{{ Form::hidden('record',$record->id) }}
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
		    <div class="panel-body"> No penalty records. </div>
		</div>
	@endif
	{{ $records->links() }}
@stop

@section('footer')
    <!-- Page Specific Plugins -->
    <script src="{{ URL::asset('/public/js/tablesorter/jquery.tablesorter.js'); }}"></script>
    <script src="{{ URL::asset('/public/js/tablesorter/tables.js'); }}"></script>
@stop