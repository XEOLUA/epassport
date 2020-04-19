<section class="students">
    <div class="container">
        <h2 class="display-4 font-weight-normal title">Студенти</h2>
        <div class="row students_row">
            <div class="col-12 block_list">
                <h3 class="display-10 font-weight-normal">За абеткою</h3>
                <p class="lead font-weight-normal">
                    @foreach($abetka as $key => $item)
                        <a class="btn btn-outline-secondary" href="/students/abetka/{{$key}}">{{$key}}<sub>{{count($item)}}</sub></a>
                    @endforeach
                </p>
            </div>
            <div class="col-12 block_list">
                <h3 class="font-weight-normal">За роками вступу</h3>
                <p class="lead font-weight-normal">
                    @foreach($years as $key => $item)
                        <a class="btn btn-outline-secondary" href="/students/years/{{$key}}">{{$key}}<sub>{{count($item)}}</sub></a>
                    @endforeach
                </p>
            </div>
            <div class="col-12 block_list">
                <h3 class="font-weight-normal">За групами</h3>
                <p class="lead font-weight-normal">
                    @foreach($groups as $key => $item)
                        <a class="btn btn-outline-secondary" href="/students/groups/{{$key}}">{{$key}}<sub>{{count($item)}}</sub></a>
                    @endforeach
                </p>
            </div>
        </div>
        @include('home.lawUkraine')
        </div>
</section>
