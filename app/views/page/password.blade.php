{{ Form::open() }}

    {{ Form::label('Password') }}
    {{ Form::password('password') }}
    {{ Form::submit() }}

{{ Form::close() }}