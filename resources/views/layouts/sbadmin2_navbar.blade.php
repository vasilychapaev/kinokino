<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>


@if (Route::currentRouteName() == 'movie.detail' )
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-film"></i>
    </div>
    <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
</a>
@endif

<!-- Topbar Search -->
<form action="/" method="post" id="FormSearch" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    {{ csrf_field() }}
    <div class="input-group">
        <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Поиск..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search fa-sm"></i></button>
        </div>
    </div>
</form>


<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
            <form action="/" method="post" class="form-inline mr-auto w-100 navbar-search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input name="search" type="text" class="form-control bg-light border-0 small" placeholder="Поиск..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>

    @include('layouts.sbadmin2_navbar_notify')


    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    @include('layouts.sbadmin2_navbar_user')


</ul>

