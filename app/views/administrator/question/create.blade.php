@extends('administrator/layout')

@section('content')
    <div id="wrapper">
        @include('administrator.sidebar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i class="fa fa-plus"></i> ADD QUESTION</h1>
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

                    {{ Form::open(array('url' => 'administrator/quiz/'.$quiz_id.'/question','role' => 'form')) }}
                        <div class="form-group">
                            {{ Form::label('question_type_id', 'QUESTION TYPE', array('class' => 'label-md')) }}
                            {{ Form::select('question_type_id', $question_types, null, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('subject_id', 'SUBJECT', array('class' => 'label-md')) }}
                            {{ Form::select('subject_id', $subjects, null, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('content', 'CONTENT', array('class' => 'label-md')) }}
                            {{ Form::textarea('content', Input::old('content'), array('id' => 'content')) }}
                        </div>

                        <div class="pull-right">
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