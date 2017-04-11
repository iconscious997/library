@extends('layouts.app')

@section('content')

<form role="form" method="POST" action="{{ route('login') }}" id="sign-in">
    {{ csrf_field() }}

    <label for="email">E-Mail Address</label>
    <input id="email" type="email" class="{{ $errors->has('email') ? ' has-error' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
    @if ($errors->has('email'))
        {{ $errors->first('email') }}
    @endif

    <label for="password">Password</label>
    <input id="password" type="password" class="{{ $errors->has('password') ? ' has-error' : '' }}" name="password" required>
    @if ($errors->has('password'))
        {{ $errors->first('password') }}
    @endif

    {{--
    <label>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
    </label>
    --}}

    <button type="submit">
        Login
    </button>

    <a href="{{ route('password.request') }}" class="button secondary">
        Forgot Your Password?
    </a>
</form>
@endsection
