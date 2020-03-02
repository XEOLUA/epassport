<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="col-md-9 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">Амбулаторні записи студента</h1>
        <h2>{{$student[0]->name}}, {{$student[0]->group}}, {{$student[0]->year_in}}</h2>
        <table class="table table-striped table-sm text-left" style="border: 1px solid silver">
            <thead>
            <tr>
                <th>#</th>
                <th>Діагноз</th>
                <th>Опис</th>
                <th>Дата</th>
                <th>Зображення</th>
            </tr>
            </thead>
            <tbody>

            @foreach($ambulatRecords as $key => $item)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$item->diagnosis}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{date('d.m.Y H:i:s',strtotime($item->updated_at ?? '01-01-01'))}}</td>
                    <td style="width: 1%">@if($item->image)<a href="/{{$item->image}}" target="_blank"><img src="/{{$item->image}}" height="30"></a> @endif</td>
                </tr>
                @endforeach

            </tbody>
        </table>



    </div>
    <div class="product-device shadow-sm d-none d-md-block">
        <a href="https://zakon.rada.gov.ua/laws/show/2297-17" target="_blank">Закон України "Про захист персональних даних"</a></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block" style="color: red">Авторизований користувач з правами перегляду персональних даних студентів несе відповідальність про їх нерозголошення!</div>
</div>
