@extends('layouts.sbadmin2')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-2">
        <h1 class="h3 mb-0 text-gray-800">{{ $movie->title_ru }} <br/><small>{{ $movie->title_en  }}</small></h1>
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
            <h3>{{ $movie->tagline }}</h3>
            <p>
                {{ $movie->description }}
            </p>
        </div>



        <!-- Poster -->
        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <img src="{{ $movie->poster }}" class="card-img-top card-img-bottom" alt="..."
                     style="max-height: 375px">
            </div>

            <p>Жанры: {{ $genres }}</p>
            <p>Год: {{ $movie->year }}</p>
            <p>Рейтинг: {{ $movie->kinopoisk_rating }}</p>
            <p>Голосов: {{ $movie->kinopoisk_votes }}</p>
            <p>Актеры: {{ $actors }}</p>
            <p>Директор: {{ $directors }}</p>
            <p>Страна: {{ $countries }}</p>
            <p>Возраст: {{ $movie->age }}</p>
        </div>


    </div>


@endsection