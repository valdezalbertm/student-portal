@extends('layouts.scholarship')

@section('title')
	<title>Scholarship Manager</title>
    <link href="{{ asset('css/bootstrap-responsive.min.css'); }}" rel="stylesheet">
@stop

@section('data.info.title')
	
@stop

@section('data.info')
    <?php  
    	$btn_link_add	 = URL::route('administrator.scholarship.create');
    	$btn_disable_add = ($btn_link_add == Request::url()) ? 'disabled' : '' ; 

    	$btn_link_view	 = URL::route('administrator.scholarship.index');
    	$btn_disable_view = ($btn_link_view == Request::url()) ? 'disabled' : '' ; 
    ?>
	<a href="{{$btn_link_add}}" class="btn btn-danger {{$btn_disable_add}}" type="button">
        <i class="fa fa-plus"></i>
	    Add Scholarship
	</a>
	<a href="{{$btn_link_view}}" class="btn btn-default {{$btn_disable_view}}" type="button">
        <i class="fa fa-list"></i>
	    View Scholarship List
	</a>
@stop

@section('data.title')
	<h3>List Of Scholarship</h3>
@stop

@section('data')
	@if ($scholarships->count())
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
		    <th class="header" style="width:100px;"> &nbsp; </th>
		</tr>
		</thead>
		<?php $no = 1; ?>
		@foreach ($scholarships as $scholarship)
		<tr>
			<td> {{ $no }} </td>
			<?php 
				//set up links
				$url_id 	= 'delete_form__'.$scholarship->id;
				$url_data 	= array($scholarship->id);
				$url_edit 	= URL::route('administrator.scholarship.edit', $url_data); 
				$url_show 	= URL::route('administrator.scholarship.show', $url_data); 
				$url_delete = URL::route('administrator.scholarship.destroy',$url_data); 

				$name = 
					strlen($scholarship->name) > 50 ?
						substr($scholarship->name, 0, 50)."..." :
						$scholarship->name;

			?>
			<td> 
				{{ e($scholarship->name) }} 
				<a href="{{$url_show}}" class="pull-right">
					Show More
					<i class="fa fa-arrow-circle-right"></i>
				</a>
			</td>
			<td> 
				<a href="{{$url_edit}}" title="Edit" class="btn btn-default" style="outline:none;">
					<i class="fa fa-edit"></i>
				</a>
				<a href="#" onclick="$('#{{$url_id}}').submit();" title="Delete" class="btn btn-default" style="outline:none;">
					<i class="fa fa-times"></i>
				</a>
				{{ Form::open(array('url' => $url_delete, 'method' => 'DELETE', 'id' => $url_id, 'style' => 'display:none;')) }}
					{{ Form::hidden('id',$scholarship->id) }}
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
		    <div class="panel-body"> No Scholarship Yet.</div>
		</div>
	@endif
	{{ $scholarships->links() }}
@stop

@section('footer')
    <!-- Page Specific Plugins -->
    <script src="{{ asset('js/tablesorter/jquery.tablesorter.js'); }}"></script>
    <script src="{{ asset('js/tablesorter/tables.js'); }}"></script>
@stop