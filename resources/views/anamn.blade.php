@extends('layouts.app')
@section('title','Анамнестичні дані')

@section('content')
    @include('home.header')
    @include('home.anamn')

{{--    @include('auth.register')--}}
    @include('home.footer')
@endsection
