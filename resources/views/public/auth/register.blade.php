@extends('layouts.public')

@section('title', __('Регистрация'))

@section('content')
    <register-form
        route="{{ route('register') }}"
        login-route="{{ route('login.form') }}"
        csrf="{{ csrf_token() }}"
        :errors='@json($errors->getMessages())'
        :old-values='@json(old())'
    ></register-form>
@endsection
