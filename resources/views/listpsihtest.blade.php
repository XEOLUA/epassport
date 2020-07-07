@extends('layouts.app')
@section('title','Психологічні тести')

@section('content')
    @include('home.header')
    @include('home.listpsihtest')

{{--    @include('auth.register')--}}
    @include('home.footer')
@endsection
