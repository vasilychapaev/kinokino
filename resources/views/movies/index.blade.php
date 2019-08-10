@extends('layouts.sbadmin2')

@section('content')

    @foreach (range(1,3) as $i)
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-2">
            <h1 class="h3 mb-0 text-gray-800">Newest</h1>
            {{--                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>--}}
        </div>

        <div class="row">

            @foreach (range(1,6) as $item)
                {{--<div class="col-lg-2 mb-3">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Primary
                            <div class="text-white-50 small">#4e73df</div>
                        </div>
                    </div>
                </div>--}}

                <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
                    <div class="card bg-primary text-white shadow">
                        <img src="//cdn.service-kp.com/poster/item/small/52750.jpg" class="card-img-top card-img-bottom" alt="...">

                    </div>
                </div>

                {{--<div class="col-lg-2 mb-2">
                    <div class="card bg-light text-white shadow">
                        <div class="card-body p-1">
                            <img src="//cdn.service-kp.com/poster/item/small/52750.jpg" class="card-img-top_" alt="...">
                        </div>
                    </div>
                </div>--}}

                {{--<div class="card" >
                    <img src="//cdn.service-kp.com/poster/item/small/52750.jpg" class="card-img-top card-img-bottom" alt="...">
                </div>--}}

                {{--<div class="card" style="max-width:200px">
                    <img class="card-img-top" src="//cdn.service-kp.com/poster/item/small/52750.jpg" alt="Card image">
                    <div class="card-img-overlay">
                        <h4 class="card-title">John Doe</h4>
                        <p class="card-text">Some example text.</p>
                        <a href="#" class="btn btn-primary">See Profile</a>
                    </div>
                </div>--}}


            @endforeach

        </div>
    @endforeach

@endsection