<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="col-md-9 p-lg-5 mx-auto my-5">
        <h2 class="display-4 font-weight-normal">{{['Тестування','Анкетування'][$test[0]->type]}}</h2>
        <h3>"{{$test[0]->title}}"</h3>
        <h3>{{auth()->user()->name}}, {{auth()->user()->group}}, {{auth()->user()->year_in}}</h3>
        <form method="post" action="{{route('testsave',['test_id'=>$test[0]->id])}}">
            @csrf
        <table class="table table-striped table-sm text-left" style="border: 1px solid silver">
            <thead>
            <tr>
                <th style="width: 1%">#</th>
                <th>Назва анкети</th>
            </tr>
            </thead>
            <tbody>

            @foreach($questions as $key => $item)
            <tr>
                <td style="font-weight: 600">{{$loop->index+1}}).
                </td>
                <td>
                    <div style="font-weight: 600">{{$item->text_q}}

{{--                        @if($item->params_q!=null) {{$item->params_q}} @endif--}}

                    </div>
                    <div style="margin-left: 20px">Відповід{{!count($item->relshipQuestionsAnswers)? 'ь' : 'і'}}:</div>
                    @foreach($item->relshipQuestionsAnswers as $k => $answer)
                        <input type="hidden" name="q{{$item->id}}[{{$key+1}}][]" value="hidden">
                        <div style="margin-left: 20px">{{chr(64+$loop->index+1)}}.
                            @if($item->type_q == 0)
                                <input type="radio" name="q{{$item->id}}[{{$key+1}}][]" id="q{{$item->id}}a{{$answer->id}}" value="{{$answer->bal_a}}">
                            @endif
                            @if($item->type_q == 1)
                                <input type="checkbox" name="q{{$item->id}}[{{$key+1}}][]" id="q{{$item->id}}a{{$answer->id}}" value="{{$answer->bal_a}}">
                            @endif
                            <label style="margin-bottom: 0" for="q{{$item->id}}a{{$answer->id}}">{{$answer->text_a}}</label>
                         </div>
                    @endforeach
                    @if(!count($item->relshipQuestionsAnswers))
                        @if($item->type_q == 2)
                            <input type="text" name="q{{$item->id}}[{{$key+1}}][]" id="q{{$item->id}}" value="">
                        @endif
                    @endif

                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
            <input type="submit" value="Відправити">
        </form>
    </div>
    <div class="product-device shadow-sm d-none d-md-block">
        <a href="https://zakon.rada.gov.ua/laws/show/2297-17" target="_blank">Закон України "Про захист персональних даних"</a></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block" style="color: red">Авторизований користувач з правами перегляду персональних даних студентів несе відповідальність про їх нерозголошення!</div>
</div>
