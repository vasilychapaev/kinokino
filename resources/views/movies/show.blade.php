@extends('layouts.sbadmin2')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-2">
        <h1 class="h3 mb-0 text-gray-800">Смотреть {{ $movie->title_ru }} <br/><small>{{ $movie->title_en  }}</small></h1>
        {{--                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>--}}
    </div>

    <div class="row">

        <!-- Movie.player -->
        <div class="col-lg-9">
            <div class="card shadow mb-4" >
                <div class="embed-responsive embed-responsive-21by9">
{{--                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/F40TxFHNPQA" allowfullscreen=""></iframe>--}}
                    {{--<iframe class="embed-responsive-item" src="https://player.vimeo.com/video/137857207" allowfullscreen></iframe>--}}
                    {{--<video class="video-fluid z-depth-1" autoplay loop controls muted>
                        <source src="https://mdbootstrap.com/img/video/Sail-Away.mp4" type="video/mp4" />
                    </video>--}}
                    <iframe class="embed-responsive-item" src="{{ $movie->iframe_url }}" allowfullscreen=""></iframe>
                </div>

            </div>
            <h4>{{ $movie->tagline }}</h4>
            <h5>{{ $movie->description }}</h5>

            <!-- Trailer.player -->
            @if ($movie->trailer_iframe_url)
            <hr />
            <h4>Трейлер к {{ $movie->title_ru }}</h4>
            <div class="card shadow mb-4" >
                <div class="embed-responsive embed-responsive-21by9">
                    {{--                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/F40TxFHNPQA" allowfullscreen=""></iframe>--}}
                    {{--<iframe class="embed-responsive-item" src="https://player.vimeo.com/video/137857207" allowfullscreen></iframe>--}}
                    {{--<video class="video-fluid z-depth-1" autoplay loop controls muted>
                        <source src="https://mdbootstrap.com/img/video/Sail-Away.mp4" type="video/mp4" />
                    </video>--}}
                    <iframe class="embed-responsive-item" src="{{ $movie->trailer_iframe_url }}" allowfullscreen=""></iframe>
                </div>

            </div>
            @endif
        </div>


        <!-- Poster -->
        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <img src="{{ $movie->poster }}" class="card-img-top card-img-bottom" alt="{{ $movie->title_ru }}"
                     title="{{ $movie->title_ru }} - {{ $movie->title_en }}"
                     {{--style="max-height: 375px"--}}>
            </div>

            @if($genres)<p>Жанры: {!! $genres !!}</p>@endif
            @if($movie->year)<p>Год: {!! $year !!}</p>@endif
            @if($movie->kinopoisk_rating)<p>Рейтинг: {{ $movie->kinopoisk_rating }}</p>@endif
            @if($movie->kinopoisk_votes)<p>Голосов: {{ $movie->kinopoisk_votes }}</p>@endif
            @if($actors)<p>Актеры: {!! $actors !!}</p>@endif
            @if($directors)<p>Директор: {!! $directors !!}</p>@endif
            @if($countries)<p>Страна: {!! $countries !!}</p>@endif
            @if($movie->age)<p>Возраст: {{ $movie->age }}</p>@endif
        </div>


    </div>


@endsection