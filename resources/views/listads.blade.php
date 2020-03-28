@extends('layouts.app')
@section('title','Антропометричні форми')

@section('content')
    @include('home.header')
    @include('home.listads')

{{--    @include('auth.register')--}}
    @include('home.footer')
@endsection
