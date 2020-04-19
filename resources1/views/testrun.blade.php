@extends('layouts.app')
@section('title','Тест/Анкета')

@section('content')
    @include('home.header')
    @include('home.testrun')

{{--    @include('auth.register')--}}
    @include('home.footer')
@endsection
