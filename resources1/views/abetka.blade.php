@extends('layouts.app')
@section('title','Abetka')

@section('content')
    @include('home.header')
    @include('home.abetka')

{{--    @include('auth.register')--}}
    @include('home.footer')
@endsection
