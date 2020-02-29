@extends('layouts.app')

@section('content')
    @include('home.header')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">@if(Session::has('flash_message'))
                <div class="alert
@if(Session::has('success') && request()->session()->get('success'))alert-success @else alert-danger @endif " role="alert" >{{Session::get('flash_message')}}</div>
            @endif
            <div class="card">
                <div class="card-header">@if(!auth()->check()) Реєстрація @else Змінити дані @endif

                </div>
                <div class="card-body">
                    <form method="POST"
                          action="@if(!Auth::check())
                          {{ route('register') }}
                          @else
                          {{ route('editprofile')}}
                        @endif">
                      @csrf
                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">ПІБ *</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}{{auth()->user()->name ?? ''}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="group" class="col-md-4 col-form-label text-md-right">Група *</label>
                            <div class="col-md-6">

                                <input id="group" type="text" class="form-control @error('group') is-invalid @enderror" name="group" value="{{ old('group') }}{{auth()->user()->group ?? ''}}" required autocomplete="group">
                                @error('group')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail *</label>

                            <div class="col-md-6">
                                @if(!auth()->check())
                                 <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @else
                                 <div class="form-control" style="background-color: #f7f7f7">{{auth()->user()->email}}</div>
                                @endif
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Пароль *</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if(auth()->check())<div class="form-group" style="text-align: center"><a href="/password/reset">Змінити пароль</a></div>@endif
                        @if(!auth()->check())
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Підтвердження пароля *</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        @endif
                        <div class="form-group row">
                            <label for="group" class="col-md-4 col-form-label text-md-right">Стать</label>
                            <div class="col-md-6">
                                <input type="radio" name="sex" id="sexMen" @if((auth()->check() && !auth()->user()->sex) || !auth()->check())checked @endif value="0" class="@error('sex') is-invalid @enderror"> <label for="sexMen">жіноча</label><br>
                                <input type="radio" name="sex" id="sexWomen" @if(auth()->check() && auth()->user()->sex)checked @endif value="1" class=" @error('sex') is-invalid @enderror"> <label for="sexWomen">чоловіча</label>
                                @error('sex')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birthday" class="col-md-4 col-form-label text-md-right">Дата народження *</label>

                            <div class="col-md-6">
                                <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}@if(auth()->check()){{auth()->user()->birthday ?? ''}}@endif" required autocomplete="data">

                                @error('birthday')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Контакти *</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}@if(auth()->check()){{auth()->user()->address ?? ''}}@endif" required>

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="year_in" class="col-md-4 col-form-label text-md-right">Рік вступу *</label>

                            <div class="col-md-6">
                                <input id="year_in" type="text" class="form-control @error('year_in') is-invalid @enderror" name="year_in" value="{{ old('year_in') }}@if(auth()->check()){{auth()->user()->year_in ?? ''}}@endif" required>

                                @error('year_in')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="parents" class="col-md-4 col-form-label text-md-right">Контакти батьків</label>

                            <div class="col-md-6">
                                <input id="parents" type="text" class="form-control @error('parents') is-invalid @enderror" name="parents" value="{{ old('parents') }}@if(auth()->check()){{auth()->user()->parents ?? ''}}@endif">

                                @error('parents')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @if(!auth()->check()) Реєстрація @else Змінити @endif
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>@include('home.footer')
@endsection

