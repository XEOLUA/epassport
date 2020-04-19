<section class="header">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark my_navbar row">
        {{--        <a class="navbar-brand" href="/">E-pass</a>--}}
        <div class="col-xl-3 col-lg-3 col-md-2 col-12 mobi_bar">
            <a  class="logo" href="{{route('index')}}"><img src="/images/logo.svg" height="40" title="Головна"></a>
            <button class="navbar-toggler" id="nb_toggle" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-7 navbar-collapse pr-0 pl-0 ml-0 collapse " id="navbarCollapse1"  style="margin-left: 10px;">
            <ul class="navbar-nav mr-auto my_navbar-nav block_center" >
                <li class="nav-item active">
                    <a class="nav-link nav-item_big" href="{{route('index')}}">Головна</a>
                </li>
                @foreach($mainMenu as $item)
                    <li class="nav-item nav-item_big active">
                        <a class="nav-link" href="/{{$item->link}}">{{$item->title}}</a>
                    </li>
                @endforeach

                @if(Auth::check())
                    @if(auth()->user()->role==0 || auth()->user()->role==2)
                        <li class="nav-item nav-item_big active">
                            <a class="nav-link" href="/students">Студенти</a>
                        </li>
                    @endif
                    @if(auth()->user()->role==1)
                        <li class="nav-itemnav-item_big  active">
                            <a class="nav-link" href="/cabinet/{{auth()->user()->id}}">Кабінет</a>
                        </li>
                    @endif
                @endif
            </ul>
            <ul class="navbar-nav mr-auto my_navbar-nav nav_hide hide" >
                @if(!auth()->check())
                    <li class="nav-item active">
                        <a class="nav-link btn_registr" href="{{route('register')}}">Реєстрація</a>
                    </li>
                    <li class="nav-item nav-item_big active">
                        <a class="nav-link" href="{{route('login')}}">Вхід</a>
                    </li>
                @endif
                @if(Auth::check())
                    <li class="nav-item active user_block">
                        <a class="nav-link nav-item_big " href="{{route('profile')}}">Профіль </a>
                        <span onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{--                            {{explode("@",Auth::user()->email)[0]}}[{{ ('Вихід') }}]--}}
                            <center style="cursor:pointer">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sign-out-alt" class="svg-inline--fa fa-sign-out-alt fa-w-16 svg_exit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"></path></svg>
                            </center>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </span>
                    </li>
                @endif
            </ul>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-3 collapse navbar-collapse block_registr " id="navbarRegist" >
            <ul class="navbar-nav mr-auto my_navbar-nav" style="justify-content: flex-end">
                @if(!auth()->check())
                    <li class="nav-item active">
                        <a class="nav-link btn_registr" href="{{route('register')}}">Реєстрація</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link nav-item_big" href="{{route('login')}}">Вхід</a>
                    </li>
                @else
                    <li class="nav-item active">
                        <a class="nav-link nav-item_big" href="{{route('profile')}}">Профіль</a>
                    </li>
                @endif

                @if(Auth::check())
                    <li class="nav-item active">
                        <div onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
{{--                            {{explode("@",Auth::user()->email)[0]}}[{{ ('Вихід') }}]--}}
                            <center style="cursor:pointer">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sign-out-alt" class="svg-inline--fa fa-sign-out-alt fa-w-16 svg_exit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"></path></svg>
                            </center>
                            <form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</section>


