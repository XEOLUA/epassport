<div class="container mainContent">
    <div class="section_infoUser">
        <h1 class="title">Студенти</h1>
        <h3 class="text">За абеткою "{{request()->alpha}}"</h3>
        <div class="row title_row">
            <div class="col-1 item_title">
                <span>#</span>
            </div>
            <div class="col-5 item_title">
                <span>ПІБ</span>
            </div>
            <div class="col-3 item_title">
                <span>Група</span>
            </div>
            <div class="col-3 item_title">
                <span>Рік вступу</span>
            </div>
        </div>

            @foreach($students as $key => $item)
            <div class="row userInfo_row">
                <div class="col-1 item_info">
                    <span>{{$loop->index+1}}</span>
                    {{--                    <span>ПІБ</span>--}}
                </div>
                <div class="col-5 item_info">
                    <a href="/cabinet/{{$item->id}}">{{$item->name}}</a>
                </div>
                <div class="col-3 item_info">
                    <a href="/students/groups/{{$item->group}}">{{$item->group}}</a>
                </div>
                <div class="col-3 item_info">
                    <a href="/students/years/{{$item->year_in}}">{{$item->year_in}}</a>
                </div>
            </div>
            @endforeach
{{--        <a  href="#">Coming soon</a>--}}
    </div>

</div>
<section class="students">
    <div class="container">
        @include('home.lawUkraine')
    </div>
</section>
