<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-film"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>

    <hr class="sidebar-divider">
    <div class="sidebar-heading mb-2">Все фильмы</div>

    @foreach ($genres as $genre)
        <li class="nav-item">
            <a class="nav-link pt-2 pb-1" href="{!! url('genre/'.$genre->slug) !!}"><i class="fas fa-fw fa-film"></i> <span>{{ $genre->name }}</span></a>
        </li>
    @endforeach

    <hr class="sidebar-divider mt-3">
    <div class="sidebar-heading mb-2">Разделы</div>

<!--
    <li class="nav-item">
{{--        <a class="nav-link pt-2 pb-1" href="#"><i class="far fa-bookmark"></i><span>Watching</span></a>--}}
        <a class="nav-link pt-2 pb-1" href="#"><i class="fas fa-ellipsis-h"></i><span>Watching</span></a>
    </li>
    <li class="nav-item">
{{--        <a class="nav-link pt-2 pb-1" href="#"><i class="fas fa-check"></i><span>Watched</span></a>--}}
{{--        <a class="nav-link pt-2 pb-1" href="#"><i class="far fa-check-circle"></i><span>Watched</span></a>--}}
        <a class="nav-link pt-2 pb-1" href="#"><i class="far fa-flag"></i><span>Watched</span></a>
    </li>
-->
    <li class="nav-item">
        <a class="nav-link collapsed pt-2 pb-1" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-folder"></i><span>Актеры</span>
{{--            <i class="fas fa-archive"></i><span>Collections</span>--}}
{{--            <i class="fas fa-inbox"></i><span>Collections</span>--}}
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
{{--                <h6 class="collapse-header">Login Screens:</h6>--}}
                @foreach ($actors as $actor)
                    <a class="collapse-item" href="{!! url('actor/'.$actor->slug) !!}">{{ $actor->name }}</a>
                @endforeach
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed pt-2 pb-1" href="#" data-toggle="collapse" data-target="#collapsePagesC" aria-expanded="true" aria-controls="collapsePagesC">
            <i class="fas fa-folder"></i><span>Страны</span>
            {{--            <i class="fas fa-archive"></i><span>Collections</span>--}}
            {{--            <i class="fas fa-inbox"></i><span>Collections</span>--}}
        </a>
        <div id="collapsePagesC" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{--                <h6 class="collapse-header">Login Screens:</h6>--}}
                @foreach ($countries as $country)
                    <a class="collapse-item" href="{!! url('country/'.$country->slug) !!}">{{ $country->name }}</a>
                @endforeach
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block mt-3">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>