@extends('administrator/layout')

@section('content')
  <body>

    <div id="wrapper">

        @include('administrator.sidebar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i class="fa fa-certificate"></i> ADD SCHOLARSHIP</h1>
                    <ol class="breadcrumb">
                        {{ $ux->breadcrumbs }}
                    </ol> 
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- S: SHOW MESSAGE STATUS -->
                    @if(Session::has('message'))
                        <div class="alert {{ Session::get('class') }} alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <!-- S: EDIT MESSAGE STATUS -->

                    {{ Form::open(array('url' => 'administrator/quiz/'.$quiz_id.'/scholarship','role' => 'form')) }}
                        <div class="form-group">
                            {{ Form::label('id', 'SCHOLARSHIP DETAILS', array('class' => 'label-md')) }}
                            {{ Form::select('id', $scholarship_name, null, array('class' => 'form-control')) }}
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
@stop