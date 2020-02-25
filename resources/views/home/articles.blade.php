<hr class="featurette-divider">
<a name="articles" style="padding-bottom: 30px"></a>
<h2 align="center" style="padding: 70px; font-weight: 300;text-transform: uppercase">Корисні статті</h2>

<!-- START THE FEATURETTES -->
@foreach($articles as $item)

<div class="row featurette">
    @if(!($loop->index & 1))
    <div class="col-md-7">
        <h2 class="featurette-heading">{{$item->title ?? 'First featurette heading.'}}</h2>
        <p class="lead">
            {{ $item->description ?? 'Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.
            ' }}
        </p>
            </div>

    <div class="col-md-5">
        <img width="500" height="500" src="
        @if($item->image){{url($item->image)}} @else {{url('images/good_food.jpg')}} @endif">
{{--        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>--}}
    </div>
    @else
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading">{{$item->title ?? 'First featurette heading.'}}</h2>
                <p class="lead">
                {{ $item->description ?? 'Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.
                ' }}
                </p>
            </div>
            <div class="col-md-5 order-md-1">
                <img style="padding-right: 25px;" width="500" height="500" src="
        @if($item->image){{url($item->image)}} @else {{url('images/good_food.jpg')}} @endif">
{{--                <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>--}}
            </div>
    @endif
</div>
<hr class="featurette-divider">
@endforeach


{{--<hr class="featurette-divider">--}}

{{--<div class="row featurette">--}}
{{--    <div class="col-md-7">--}}
{{--        <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>--}}
{{--        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>--}}
{{--    </div>--}}
{{--    <div class="col-md-5">--}}
{{--        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>--}}
{{--    </div>--}}
{{--</div>--}}

<!-- /END THE FEATURETTES -->
