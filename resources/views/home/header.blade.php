<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
{{--        <a class="navbar-brand" href="/">E-pass</a>--}}
        <a href="{{route('index')}}"><img src="/images/logo.svg" height="40" title="Головна"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse" style="margin-left: 10px;">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('index')}}">Головна</a>
                </li>
                @foreach($mainMenu as $item)
                    <li class="nav-item active">
                        <a class="nav-link" href="/{{$item->link}}">{{$item->title}}</a>
                    </li>
                @endforeach

                @if(Auth::check())
                    @if(auth()->user()->role==0 || auth()->user()->role==2)
                        <li class="nav-item active">
                            <a class="nav-link" href="/students">Студенти</a>
                        </li>
                    @endif
                    @if(auth()->user()->role==1)
                        <li class="nav-item active">
                            <a class="nav-link" href="/cabinet/{{auth()->user()->id}}">Кабінет</a>
                        </li>
                    @endif
{{--                    @foreach($userMenu as $item)--}}
{{--                        <li class="nav-item active">--}}
{{--                            <a class="nav-link" href="{{$item->link}}">{{$item->title}}</a>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
                @endif
                @if(!auth()->check())
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('register')}}">Реєстрація</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('login')}}">Вхід</a>
                    </li>
                @else
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('profile')}}">Профіль</a>
                    </li>
                @endif

 @if(Auth::check())
    <li class="nav-item active">
    <div onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <center style="cursor:pointer">{{explode("@",Auth::user()->email)[0]}}[{{ ('Вихід') }}]</center>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    </li>
 @endif
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="#">Link</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>--}}
{{--                </li>--}}
            </ul>
            <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</header>
