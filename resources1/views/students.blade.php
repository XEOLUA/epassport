@extends('layouts.app')
@section('title','Students')

@section('content')
    @include('home.header')
    @include('home.students')

{{--    @include('auth.register')--}}
    @include('home.footer')
@endsection
