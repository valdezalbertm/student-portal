@extends('layouts.scholarship')

@section('title')
	<title>Edit Scholarship</title>
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
	<h3>Edit Scholarship Form</h3>
@stop

@section('data')
	<div class="row col-lg-12">
		<div class="col-lg-9" style="padding-left:0px; padding-right:0px;">
			{{ Form::model($scholarship, array('route'=>array('administrator.scholarship.update',$scholarship->id),'method' => 'PUT' )) }}
				<div class="form-group">
					<i class="fa fa-list-alt"></i>
					{{ Form::label('name', 'Scholarship Name') }}
					{{ Form::text('name', 
						Input::old('name'), 
						array(
							'class' => 'form-control','placeholder' => 'Scholarship','required' => 'true')); }}
				</div>
				{{ Form::hidden('id',$scholarship->id) }}
				{{ Form::reset('Reset', array('class' => 'btn btn-default')); }}
				{{ Form::submit('Save Scholarship', array('class' => 'btn btn-primary pull-right')); }}
			{{ Form::close() }}
		</div>
	</div>
	<br>
	<br>
	<br>
@stop

@section('footer')
@stop