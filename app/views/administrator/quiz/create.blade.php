@extends('administrator/layout')

@section('content')
    <div id="wrapper">
        @include('administrator.sidebar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i class="fa fa-plus"></i> ADD EXAMINATION</h1>
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

                    {{ Form::open(array('url' => 'administrator/quiz','role' => 'form')) }}
                        <div class="form-group">
                            {{ Form::label('title', 'TITLE', array('class' => 'label-md')) }}
                            {{ Form::text('title', Input::old('title'), array('class' => 'form-control', 'placeholder' => 'TITLE')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('description', 'DESCRIPTION', array('class' => 'label-md')) }}
                            {{ Form::textarea('description', Input::old('description'), array('id' => 'description')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('instruction', 'INSTRUCTION', array('class' => 'label-md')) }}
                            {{ Form::textarea('instruction', Input::old('instruction'), array('id' => 'instruction')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('time_limit', 'TIME LIMIT : ', array('class' => 'label-md')) }}
                            {{ Form::text('time_limit', Input::old('time_limit'), array('class' => 'form-control time-limit', 'placeholder' => '00')) }}
                            {{ Form::label('time_limit', 'MINUTES (PUT 0 FOR NO TIME LIMIT)', array('class' => 'label-md')) }}
                        </div>

                        <div class="form-group pull-right">
                            {{ HTML::decode(Form::button('SUBMIT <i class="fa fa-angle-double-right"></i>', array('type' => 'submit','class'=>'btn btn-success'))) }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <!-- S: LOAD TINYMCE -->
    <script src="{{ URL::asset('assets/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | preview "
    });
    </script>
    <!-- E: LOAD TINYMCE -->
</html>
@stop