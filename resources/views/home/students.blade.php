<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">Студенти</h1>
        <h3 class="display-10 font-weight-normal">За абеткою</h3>
        <p class="lead font-weight-normal">

            @foreach($abetka as $key => $item)
                <a class="btn btn-outline-secondary" href="/students/abetka/{{$key}}">{{$key}}<sub>{{count($item)}}</sub></a>
                @endforeach
        </p>
        <h3 class="display-10 font-weight-normal">За роками вступу</h3>
        <p class="lead font-weight-normal">

            @foreach($years as $key => $item)
                <a class="btn btn-outline-secondary" href="/students/years/{{$key}}">{{$key}}<sub>{{count($item)}}</sub></a>
            @endforeach
        </p>
        <h3 class="display-10 font-weight-normal">За групами</h3>
        <p class="lead font-weight-normal">

            @foreach($groups as $key => $item)
                <a class="btn btn-outline-secondary" href="/students/groups/{{$key}}">{{$key}}<sub>{{count($item)}}</sub></a>
            @endforeach
        </p>
{{--        <a  href="#">Coming soon</a>--}}
    </div>
    <div class="product-device shadow-sm d-none d-md-block">
        <a href="https://zakon.rada.gov.ua/laws/show/2297-17" target="_blank">Закон України "Про захист персональних даних"</a></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block" style="color: red">Авторизований користувач з правами перегляду персональних даних студентів несе відповідальність про їх нерозголошення!</div>
</div>
