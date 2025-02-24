@extends('layouts.public')

@section('content')
    <cart-page
        :initial-items='@json($cartItems)'
        csrf="{{ csrf_token() }}"
        :restaurant-slug='@json($restaurant->slug)'
    ></cart-page>
@endsection
