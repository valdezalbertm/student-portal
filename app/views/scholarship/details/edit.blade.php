@extends('layouts.scholarship')
@extends('layouts.scholarship')

@section('title')
	<title>Edit Scholarship Discount</title>
@stop

@section('data.title')
	<h3>Edit Scholarship Discount</h3>
@stop


@section('data.info')
    <?php  
    	$btn_link_add	 = URL::route('administrator.scholarship.discount.create',$scholarship->id);
    	$btn_disable_add = ($btn_link_add == Request::url()) ? 'disabled' : '' ; 

    	$btn_link_view	 = URL::route('administrator.scholarship.show',$scholarship->id);
    	$btn_disable_view = ($btn_link_view == Request::url()) ? 'disabled' : '' ; 
    ?>
	<a href="{{$btn_link_add}}" class="btn btn-danger {{$btn_disable_add}}" type="button">
        <i class="fa fa-plus"></i>
	    Add Scholarship Discount
	</a>
	<a href="{{$btn_link_view}}" class="btn btn-default {{$btn_disable_view}}" type="button">
        <i class="fa fa-list"></i>
	    View Scholarship Discount List
	</a>
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
			<?php
				$url_data = array($scholarship->id,$discount->id); 
				$post_url = URL::route('administrator.scholarship.discount.update',$url_data); 
			?>
			{{ Form::model($discount, array('route'=>array('administrator.scholarship.discount.update',$scholarship->id,$discount->id),'method' => 'PUT' )) }}
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

<!--  -->

	</div>
	<br>
	<br>
	<br>
@stop