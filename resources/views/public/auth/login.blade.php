@extends('layouts.public')

@section('title', __('Вход'))

@section('content')
    <login-form
        route="{{ route('login') }}"
        register-route="{{ route('register.form') }}"
        csrf="{{ csrf_token() }}"
        :errors='@json($errors->getMessages())'
        :old-values='@json(old())'
    ></login-form>
@endsection
