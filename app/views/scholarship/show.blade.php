@extends('layouts.scholarship')

@section('title')
	<title>Manage Scholarship Discounts</title>
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
	@if($discounts->count() < 1)
	    <div class="alert alert-dismissable alert-warning">
	        <button class="close" data-dismiss="alert" type="button">&times;</button>
	         <strong>No Scholarship Discounts!</strong> Please fill-up the Form given below.
	    </div>
	@endif

	<h3>Manage Scholarship Discounts</h3>
@stop

@section('data')
	<div class="row col-lg-12">
		<div class="col-lg-9" style="padding-left:0px; padding-right:0px;">
				<div class="form-group">
					<i class="fa fa-list-alt"></i>
					{{ Form::label('name', 'Scholarship Name') }}
					<div class="well">{{e($scholarship->name)}}</div>
				</div>
<!--  -->

		@if ($discounts->count())
		<div class="form-group">
			<i class="fa fa-list-alt"></i>
			{{ Form::label('name', 'Scholarship Discounts') }}
			<?php $url_create = URL::route('administrator.scholarship.discount.create', $scholarship->id); ?>
			<a href="{{$url_create}}" title="Edit" class="btn btn-default btn-sm pull-right" style="outline:none;">
				<i class="fa fa-plus"></i>
				Add Scholarship Discounts
			</a>
		</div>
		<table class="table table-bordered table-hover table-striped tablesorter">
	        <thead>
			<tr>
			    <th class="header"> No. <i class="close fa fa-sort pull-right hidden-phone"></i></th>
			    <th class="header"><i class="fa fa-list-alt"></i> Type <i class="close fa fa-sort pull-right hidden-phone"></i></th>
			    <th class="header"><i class="fa fa-dollar"></i> Value <i class="close fa fa-sort pull-right hidden-phone"></i></th>
			    <th class="header"><i class="fa fa-calendar"></i> School Year <i class="close fa fa-sort pull-right hidden-phone"></i></th>
			    <th class="header" style="width:100px;"> &nbsp; </th>
			</tr>
			</thead>
			<?php $no = 1; ?>
			@foreach ($discounts as $discount)
			<tr>
				<td> {{ $no }} </td>
				<?php 
					//set up links
					$url_id 	= 'delete_form_'.$scholarship->id.'_'.$discount->id;
					$url_data 	= array($scholarship->id,$discount->id);
					$url_edit 	= URL::route('administrator.scholarship.discount.edit', $url_data); 
					$url_show 	= URL::route('administrator.scholarship.discount.show', $url_data); 
					$url_delete = URL::route('administrator.scholarship.discount.destroy',$url_data); 
				?>
				<td> {{ e($discount->type) }} </td>
				<td> {{ e($discount->value) }} </td>
				<td> {{ e($discount->school_year) }} </td>
				<td> 
					<a href="{{$url_edit}}" title="Edit" class="btn btn-default" style="outline:none;">
						<i class="fa fa-edit"></i>
					</a>
					<a href="#" onclick="$('#{{$url_id}}').submit();" title="Delete" class="btn btn-default" style="outline:none;">
						<i class="fa fa-times"></i>
					</a>
					{{ Form::open(array('url' => $url_delete, 'method' => 'DELETE', 'id' => $url_id, 'style' => 'display:none;')) }}
						{{ Form::hidden('id',$discount->id) }}
					{{ Form::close() }}

				</td>
				<?php $no++; ?>
			</tr>
			@endforeach
		</table>
		@else
			<?php
				$url_data = array($scholarship->id); 
				$post_url = URL::route('administrator.scholarship.discount.store',$url_data); 
			?>
			{{ Form::open(array('url' => $post_url, 'method' => 'post')) }}
				<div class="form-group">
					<i class="fa fa-list-alt"></i>
					{{ Form::label('type', 'Type') }}
					{{ Form::select(
						'type', 
						array( 'fix' => 'Fix', 'percentage' => 'Percentage'),
						Input::old('type'),
						array('class' => 'form-control','required' => 'true')
						) }}
				</div>
				<div class="form-group">
					<i class="fa fa-list-alt"></i>
					{{ Form::label('value', 'Discount Value') }}
					{{ Form::text('value', 
						Input::old('value'), 
						array(
							'class' => 'form-control','placeholder' => 'Discount','required' => 'true')); }}
				</div>
				<div class="form-group">
					<i class="fa fa-list-alt"></i>
					{{ Form::label('school_year', 'School Year Implemented') }}
					{{ Form::select(
						'school_year', 
						$school_year,
						Input::old('school_year'),
						array('class' => 'form-control','required' => 'true')
						) }}
				</div>
				{{ Form::hidden('scholarship_id',$scholarship->id); }}
				{{ Form::reset('Reset', array('class' => 'btn btn-default')); }}
				{{ Form::submit('Save Discount', array('class' => 'btn btn-primary pull-right')); }}
			{{ Form::close() }}
		@endif
		{{ $discounts->links() }}
<!--  -->
				<?php 
					$url_data = array($scholarship->id);
					$url_edit = URL::route('administrator.scholarship.edit', $url_data); 
				?>
				<!-- <a href="{{$url_edit}}" title="Edit" class="btn btn-danger pull-right" style="outline:none;">
					<i class="fa fa-edit"></i>
					Edit Scholarship
				</a> -->
		</div>
	</div>
	<br>
	<br>
	<br>
@stop

@section('footer')
    <!-- Page Specific Plugins -->
    <script src="{{ asset('js/tablesorter/jquery.tablesorter.js'); }}"></script>
    <script src="{{ asset('js/tablesorter/tables.js'); }}"></script>
@stop