<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">

    <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">Студенти</h1>
        <h3 class="display-10 font-weight-normal">За абеткою "{{request()->alpha}}"</h3>
        <table class="table table-striped table-sm text-left" style="border: 1px solid silver">
            <thead>
            <tr>
                <th>#</th>
                <th>ПІБ</th>
                <th>Група</th>
                <th>Рік вступу</th>
            </tr>
            </thead>
            <tbody>

            @foreach($students as $key => $item)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td><a href="/cabinet/{{$item->id}}">{{$item->name}}</a></td>
                    <td><a href="/students/groups/{{$item->group}}">{{$item->group}}</a></td>
                    <td><a href="/students/years/{{$item->year_in}}">{{$item->year_in}}</a></td>
                </tr>
                @endforeach

            </tbody>
        </table>
{{--        <a  href="#">Coming soon</a>--}}
    </div>

</div>
<section class="students">
    <div class="container">
        @include('home.lawUkraine')
    </div>
</section>
