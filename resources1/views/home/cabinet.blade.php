<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="col-md-9 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">Дані студента</h1>
        <table class="table table-striped table-sm text-left" style="border: 1px solid silver">
            <thead>
            <tr>
                <th>#</th>
                <th>ПІБ</th>
                <th>Група</th>
                <th>Абетка</th>
                <th>Рік вступу</th>
                <th>Дата народження</th>
                <th>Контакти</th>
                <th>Батьки</th>
            </tr>
            </thead>
            <tbody>

            @foreach($student as $key => $item)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td><a href="/cabinet/{{$item->id}}">{{$item->name}}</a></td>
                    <td><a href="/students/groups/{{$item->group}}">{{$item->group}}</a></td>
                    <td><a href="/students/abetka/{{mb_substr($item->name,0,1)}}">{{mb_substr($item->name,0,1)}}</a></td>
                    <td><a href="/students/years/{{$item->year_in}}">{{$item->year_in}}</a></td>
                    <td>{{date("d.m.Y",strtotime($item->birthday))}}</td>
                    <td>{{$item->address}}</td>
                    <td>{{$item->parents}}</td>

                </tr>
                @endforeach

            </tbody>
        </table>

        <div class="container">
            <div class="card-deck mb-3 text-center">
                @foreach($passportMenu as $item)
                    @if($loop->index%3 == 0) <div class="row">  @endif
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">{{$item->title}}</h4>
                    </div>
                    <div class="card-body">
                        <img src="{{$item->image ?? 'good_food.jpg'}}" style="height: 200px;">
                        <a href="{{$item->link}}/{{request()->id}}" class="btn btn-outline-secondary btn-block">Переглянути</a>
                    </div>
                </div>
                        @if($loop->index%3 == 2 || $loop->last) </div>  @endif
                @endforeach
{{--                <div class="card mb-4 shadow-sm">--}}
{{--                    <div class="card-header">--}}
{{--                        <h4 class="my-0 font-weight-normal">Pro</h4>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>--}}
{{--                        <ul class="list-unstyled mt-3 mb-4">--}}
{{--                            <li>20 users included</li>--}}
{{--                            <li>10 GB of storage</li>--}}
{{--                            <li>Priority email support</li>--}}
{{--                            <li>Help center access</li>--}}
{{--                        </ul>--}}
{{--                        <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card mb-4 shadow-sm">--}}
{{--                    <div class="card-header">--}}
{{--                        <h4 class="my-0 font-weight-normal">Enterprise</h4>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>--}}
{{--                        <ul class="list-unstyled mt-3 mb-4">--}}
{{--                            <li>30 users included</li>--}}
{{--                            <li>15 GB of storage</li>--}}
{{--                            <li>Phone and email support</li>--}}
{{--                            <li>Help center access</li>--}}
{{--                        </ul>--}}
{{--                        <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>

    </div>
    <div class="product-device shadow-sm d-none d-md-block">
        <a href="https://zakon.rada.gov.ua/laws/show/2297-17" target="_blank">Закон України "Про захист персональних даних"</a></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block" style="color: red">Авторизований користувач з правами перегляду персональних даних студентів несе відповідальність про їх нерозголошення!</div>
</div>
