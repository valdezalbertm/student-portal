@extends('administrator/layout')

@section('content')
    <div id="wrapper">

        @include('administrator.sidebar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i class="fa fa-calendar"></i> ADD SCHEDULE</h1>
                    <ol class="breadcrumb">
                        {{ $ux->breadcrumbs }}
                    </ol> 
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- S: SHOW FORM VALIDATION ERRORS -->
                    @if($errors->has())
                        <div class="alert alert-danger alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ HTML::ul($errors->all()) }}
                        </div>
                    @endif
                    <!-- E: SHOW FORM VALIDATION ERRORS -->
                        
                    {{ Form::open(array('url' => 'administrator/quiz/'.$quiz_id.'/schedule','role' => 'form')) }}
                        <div class="form-group col-md-4">
                            {{ Form::label('id', 'START OF EXAMINATION', array('class' => 'label-md')) }}
                            <div class='input-group date' id='datetimepicker_from'>
                                {{ Form::text('from', Input::old('from'), array('class' => 'form-control', 'placeholder' => 'SET DATE AND TIME', 'readonly', 'required')) }}
                                    
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            {{ Form::label('id', 'END OF EXAMINATION', array('class' => 'label-md')) }}
                            <div class='input-group date' id='datetimepicker_to'>
                                {{ Form::text('to', Input::old('to'), array('class' => 'form-control', 'placeholder' => 'SET DATE AND TIME', 'readonly', 'required')) }}
                                    
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>

                        <div class="form-group col-md-1">
                            {{ Form::label('slots', 'SLOTS', array('class' => 'label-md')) }}
                            {{ Form::text('slots', Input::old('slots'), array('class' => 'form-control center slots', 'placeholder' => '00', 'required')) }}
                        </div>

                        <div class="form-group col-md-2">
                            {{ Form::label('time_limit', 'ALLOW', array('class' => 'label-md')) }}
                            {{ Form::select('allow', array('0' => 'NO', '1' => 'YES'), null, array('class' => 'form-control allow')); }}
                        </div>

                        <div class="pull-right">
                            {{ HTML::decode(Form::button('SUBMIT <i class="fa fa-angle-double-right"></i>', array('type' => 'submit','class'=>'btn btn-success'))) }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</html>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker_from, #datetimepicker_to').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });
    });
</script>
@stop