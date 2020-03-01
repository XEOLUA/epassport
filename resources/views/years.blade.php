@extends('layouts.app')
@section('title','Years in')

@section('content')
    @include('home.header')
    @include('home.years')

{{--    @include('auth.register')--}}
    @include('home.footer')
@endsection
