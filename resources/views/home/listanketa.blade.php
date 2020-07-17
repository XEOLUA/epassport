<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="col-md-9 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">Анкети здоров'я</h1>
        <h2>{{$student[0]->name}}, {{$student[0]->group}}, {{$student[0]->year_in}}</h2>
        <table class="table table-striped table-sm text-left" style="border: 1px solid silver">
            <thead>
            <tr>
                <th>#</th>
                <th>Назва анкети</th>
            </tr>
            </thead>
            <tbody>

            @foreach($tests as $key => $item)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td><a href="/test/results/{{$item->id}}/{{$student[0]->id}}">{{$item->title}}</a></td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>
    <div class="product-device shadow-sm d-none d-md-block">
        <a href="https://zakon.rada.gov.ua/laws/show/2297-17" target="_blank">Закон України "Про захист персональних даних"</a></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block" style="color: red">Авторизований користувач з правами перегляду персональних даних студентів несе відповідальність про їх нерозголошення!</div>
</div>
