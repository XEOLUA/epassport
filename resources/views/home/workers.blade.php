<!-- Three columns of text below the carousel -->
<section class="workers">
    <a name="workers"></a>
        <h2 align="center" class="title">Над проєктом працюють</h2>
    <div class="row row_workers">
        @foreach($workers as $item)
        <div class="col-lg-4">
    {{--        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>--}}
            <img class="photo_workers" src="
                @if($item->image) {{url($item->image)}}
                 @else
                  @if ($item->sex) {{url('images/worker_men.png')}} @else {{url('images/worker_women.png')}} @endif
                @endif ">

            <h2>{{$item->name}}</h2><h4>{{$item->position}}</h4>
            <p>{{$item->description}}</p>
            <p><a class="btn btn-secondary" href="#" role="button">Прочитати</a></p>
        </div><!-- /.col-lg-4 -->
        @endforeach

    </div><!-- /.row -->
</section>


