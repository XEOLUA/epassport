@extends('layouts.app')

@section('title','Index')

@section('content')
    @include('home.header')
    @include('home.slider')
    <div class="container marketing">
    @include('home.workers')
    @include('home.articles')
    </div><!-- /.container -->
    @include('home.footer')
@endsection
