<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="col-md-9 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">Результати {{['тестування','опитування'][$test[0]->type]}}</h1>
        <h2>{{$student[0]->name}}, {{$student[0]->group}}, {{$student[0]->year_in}}</h2>
        <h2>{{$test[0]->title}}</h2>
        <h2 align="left">
            <a class="btn btn-primary mt-2" href="/test/run/{{$test[0]->id}}"> + {{['Тестування','Опитування'][$test[0]->type]}}</a>
        </h2>
         <table class="table table-striped table-sm text-left" style="border: 1px solid silver">
            <thead>
            <tr>
                <th>#</th>
                <th>Питання</th>
                @foreach($results as $item)
                <th>
                    <div style="font-weight: 500">{{date("d.m.Y",strtotime($item->created_at))}}</div>
                    <div style="font-weight: 100">{{date("H:i:s",strtotime($item->created_at))}}</div>
                </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
{{--            {{dd(unserialize($results[0]->answers))[1]}}--}}

            @foreach($questions as $key => $item)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$questions[$key]->text_q}}</td>
                @if(count($results)>0)
                    @foreach($results as $k => $res)
                    <td>
                    @if(isset(array_values(unserialize($res->answers))[$key+1]))
                         @foreach(array_values(unserialize($res->answers))[$key+1] as $var => $ans)
{{--                             <pre>{{print_r($ans ?? '-')}}</pre>--}}
                                @foreach($ans as $a => $v)
                                    @if($v!='hidden')
                                        @if(ceil(0.5*$a)==0) {{$v}} @else
                                        {{chr(ceil(0.5*$a)+64)}}({{$v}}),
                                         @endif
                                        @endif
                                @endforeach
                         @endforeach
                    @endif
                     </td>
                    @endforeach
                @endif
            </tr>
            @endforeach
                @if(count($proc)>0)
                <tr>
                    <td colspan="2">&nbsp;</td>
                @foreach($proc as $p)
                    <td>
                        {!! $p !!}
                    </td>
                @endforeach
                </tr>
                @endif


            </tbody>
        </table>
    </div>
    <div class="product-device shadow-sm d-none d-md-block">
        <a href="https://zakon.rada.gov.ua/laws/show/2297-17" target="_blank">Закон України "Про захист персональних даних"</a></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block" style="color: red">Авторизований користувач з правами перегляду персональних даних студентів несе відповідальність про їх нерозголошення!</div>
</div>
