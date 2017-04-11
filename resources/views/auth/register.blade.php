@extends('layouts.app')

@section('content')
<form role="form" method="POST" action="{{ route('register') }}" id="sign-up">
    {{ csrf_field() }}

    <label for="name" class="{{ $errors->has('name') ? ' has-error' : '' }}">Name</label>
    <input id="name" type="text" class="{{ $errors->has('name') ? ' has-error' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
    @if ($errors->has('name'))
        {{ $errors->first('name') }}
    @endif

    <label for="email" class="{{ $errors->has('name') ? ' has-error' : '' }}">E-Mail Address</label>
    <input id="email" type="email" class="{{ $errors->has('email') ? ' has-error' : '' }}" name="email" value="{{ old('email') }}" required>
    @if ($errors->has('email'))
        {{ $errors->first('email') }}
    @endif

    <label for="password" class="{{ $errors->has('name') ? ' has-error' : '' }}">Password</label>
    <input id="password" type="password" class="{{ $errors->has('password') ? ' has-error' : '' }}" name="password" required>
    @if ($errors->has('password'))
        {{ $errors->first('password') }}
    @endif

    <label for="password-confirm">Confirm Password</label>
    <input id="password-confirm" type="password" name="password_confirmation" required>

    <button type="submit">
        Register
    </button>
</form>
@endsection