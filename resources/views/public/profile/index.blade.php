@extends('layouts.public')

@section('title', 'Мой профиль')

@section('content')
    <div class="container-xl py-5">
        <user-profile :user='@json($user)' logout-url="{{ route('logout') }}"> </user-profile>
        <user-orders class="mt-5 d-block" />
    </div>

    <location-modal></location-modal>
@endsection
