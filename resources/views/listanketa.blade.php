@extends('layouts.app')
@section('title','Анкети здоров\'я')

@section('content')
    @include('home.header')
    @include('home.listanketa')

{{--    @include('auth.register')--}}
    @include('home.footer')
@endsection
