<div class="container mainContent">
    <div class="section_infoUser">
        <h1 class="title">Дані студента4</h1>
        <div class="row title_row">
            <div class="col-5 item_title">
                <span>ПІБ</span>
            </div>
            <div class="col-2 item_title">
                <span>Група</span>
            </div>
            <div class="col-2 item_title">
                <span>Абетка</span>
            </div>

            <div class="col-3 item_title">
                <span>Рік вступу</span>
            </div>
        </div>
        <div class="row userInfo_row">
            @foreach($student as $key => $item)
                <div class="col-5 item_info">
                   <a href="/cabinet/{{$item->id}}">{{$item->name}}</a>
{{--                    <span>ПІБ</span>--}}
                </div>
                <div class="col-2 item_info">
                    <a href="/students/groups/{{$item->group}}">{{$item->group}}</a>
                </div>
                <div class="col-2 item_info">
                    <a href="/students/abetka/{{mb_substr($item->name,0,1)}}">{{mb_substr($item->name,0,1)}}</a>
                </div>
                <div class="col-3 item_info">
                    <a href="/students/years/{{$item->year_in}}">{{$item->year_in}}</a>
                </div>
            @endforeach
            </div>
        </div>
        <div class="row menuBlock_row">
        @foreach($passportMenu as $item)
            @if($loop->index%3 == 0)
                    @endif
                    <div class="col-4 shadow-sm menuBlock_col">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">{{$item->title}}</h4>
                        </div>
                        <div class="card-body">
                            <img class="menu_img" src="{{$item->image ?? 'good_food.jpg'}}">
                            <a href="{{$item->link}}/{{request()->id}}" class="btn btn-outline-secondary btn-block">Переглянути</a>
                        </div>
                    </div>
                        @if($loop->index%3 == 2 || $loop->last)
                  @endif
        @endforeach
        </div>
    <div class="product-device shadow-sm d-none d-md-block">
        <a href="https://zakon.rada.gov.ua/laws/show/2297-17" target="_blank">Закон України "Про захист персональних даних"</a></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block" style="color: red">Авторизований користувач з правами перегляду персональних даних студентів несе відповідальність про їх нерозголошення!</div>
    </div>


