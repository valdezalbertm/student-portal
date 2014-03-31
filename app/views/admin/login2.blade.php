<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign-in</title>
    <link href="{{ URL::asset('assets/css/bootstrap_old.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/bootstrap-responsive.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/extra.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="form-signin">
            <h2 class="form-signin-heading">Sign-in</h2>
                <!-- S: prompt if login failed -->
                @if (Session::get('action') == 'LOGIN_FAILED')
                    {{ Form::label('', 'Username/password did not match!', ['class' => 'input-block-level']) }}
                @endif

                {{ Form::open( ['method' => 'POST', 'route' => 'admin.login'] ) }}

                <?php $data =  array( 'value' => '',
                        'name' => 'username', 'id' => 'username',
                        'class' => 'input-block-level', 'placeholder' => 'Username',
                        'data-toggle' => 'tooltip', 'data-placement' => 'right',
                        'title' => 'Username must be greater than 7 letter/words.',
                        'onKeyUp' => 'usernameKeyUp()', 'onFocus' => 'usernameFocus()',
                        );
                ?>
                {{ Form::input('text', 'username', '' , $data) }}

                <?php $data =  array('name' => 'password', 'id' => 'password', 'value' => '',
                    'class' => 'input-block-level',  'placeholder' => 'Password',
                    'data-toggle' => 'tooltip', 'data-placement' => 'right',
                    'title' => 'Password must be greater than 7 letter/words.',
                    'onKeyUp' => 'passwordKeyUp()', 'onFocus' => 'passwordFocus()',
                    );
                ?>
                {{ Form::input('password', 'password', '', $data) }}

                <?php
                $data =  array('name' => 'signin', 'class' => 'btn btn-large btn-primary', 'content' => 'Signin',
                    'onClick' => 'form_submit()'
                );
                ?>
                <center>
                {{ Form::submit('Signin', $data) . "&nbsp;&nbsp;"}}
                <a href="{{ route('admin.index') }}">{{ Form::button('Cancel', array('class' => 'btn btn-large')) }}</a>
            </center>
                {{ Form::close() }}
        </div>
    </div>

    <script src="{{ URL::asset('assets/js/jquery-1.10.2.js') }}"></script>

</body>
</html>