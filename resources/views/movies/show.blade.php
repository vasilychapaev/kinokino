@extends('layouts.sbadmin2')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-2">
        <h1 class="h3 mb-0 text-gray-800">Terminator 8</h1>
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
                    <iframe class="embed-responsive-item" src="http://moonwalk.cc/video/c963de22bf697c3e/iframe" allowfullscreen=""></iframe>
                </div>

            </div>

            <p>
                Прошло более десяти лет с тех пор, как киборг-терминатор из 2029 года пытался уничтожить Сару Коннор - женщину, чей будущий сын выиграет войну человечества против машин.
                <br>
                Теперь у Сары родился сын Джон и время, когда он поведёт за собой выживших людей на борьбу с машинами, неумолимо приближается. Именно в этот момент из постапокалиптического будущего прибывает новый терминатор - практически неуязвимый и способный принимать любое обличье. Цель нового терминатора уже не Сара, а уничтожение молодого Джона Коннора.
                <br>
                Однако шансы Джона на спасение существенно повышаются, когда на помощь приходит перепрограммированный сопротивлением терминатор предыдущего поколения. Оба киборга вступают в смертельный бой, от исхода которого зависит судьба человечества.
            </p>
        </div>



        <!-- Poster -->
        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <img src="//cdn.service-kp.com/poster/item/big/87.jpg" class="card-img-top card-img-bottom" alt="..."
                     style="max-height: 375px">
            </div>

            <p>Жанры: комедия боевик</p>
            <p>Год: 2018</p>
            <p>Рейтинг: 7</p>
            <p>Актеры: Арнольд Шварценегер, Брюс Ли, Томи Ли Джонс, Индиана Джонс</p>
        </div>


    </div>


@endsection