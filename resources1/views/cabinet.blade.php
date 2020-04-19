@extends('layouts.app')
@section('title','Cabinet')

@section('content')
    @include('home.header')
    @include('home.cabinet')

{{--    @include('auth.register')--}}
    @include('home.footer')
@endsection
