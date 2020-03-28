@extends('layouts.app')
@section('title','Антропометричні форми')

@section('content')
    @include('home.header')
    @include('home.results')

{{--    @include('auth.register')--}}
    @include('home.footer')
@endsection
