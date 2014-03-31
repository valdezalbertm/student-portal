<script src="{{ URL::asset('assets/js/jquery-1.10.2.js') }}"></script>
<script>
    $(document).ready(function(){
        $( '#form-add-setting' ).on( 'submit', function() {

            //.....
            //show some spinner etc to indicate operation in progress
            //.....
     
            $.post(
                $( this ).prop( 'action' ),
                {
                    "_token": $( this ).find( 'input[name=_token]' ).val(),
                    "setting_name": $( '#setting_name' ).val(),
                    "setting_value": $( '#setting_value' ).val()
                },
                function( data ) {
                    alert(data.status);
                },
                'json'
            );
     
            //.....
            //do anything else you might want to do
            //.....
     
            //prevent the form from actually submitting in browser
     
            //.....
            //do anything else you might want to do
            //.....
     
            //prevent the form from actually submitting in browser
            return false;
        });
    });
</script>

<div class="x">1123</div>
{{ Form::open( array(
    'route' => 'settings.create',
    'method' => 'post',
    'id' => 'form-add-setting'
) ) }}
 
{{ Form::label( 'setting_name', 'Setting Name:' ) }}
{{ Form::text( 'setting_name', '123', array(
    'id' => 'setting_name',
    'placeholder' => 'Enter Setting Name',
    'maxlength' => 20,
    'required' => true
) ) }}
{{ Form::label( 'setting_value', 'Setting Value:' ) }}
{{ Form::text( 'setting_value', '123', array(
    'id' => 'setting_value',
    'placeholder' => 'Enter Setting Value',
    'maxlength' => 30,
    'required' => true
) ) }}
 
{{ Form::submit( 'Add Setting', array(
    'id' => 'btn-add-setting',
) ) }}
 
{{ Form::close() }}

