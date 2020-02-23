<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="/">E-pass</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                @foreach($mainMenu as $item)
                    <li class="nav-item active">
                        @if (($item->link!='/register' && $item->link!='/login') ||
                            (!Auth::check() && ($item->link=='/register' || $item->link=='/login')))
                        <a class="nav-link" href="{{$item->link}}">{{$item->title}}</a>
                        @endif
                    </li>
                @endforeach

 @if(Auth::check())
    <div onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
        <center style="cursor:pointer">{{Auth::user()->name}}[{{ ('Вихід') }}]</center>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
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
