@extends('layouts.app')
@section('title','Groups')

@section('content')
    @include('home.header')
    @include('home.groups')

{{--    @include('auth.register')--}}
    @include('home.footer')
@endsection
