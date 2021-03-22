<div class="container px-lg-5 navbar navbar-light">
    <div class="container py-3 px-lg-5">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center col-7 col-sm-6 col-md-5 col-lg-12">
            <a href=" {{route('home')}}" id="title" class="navbar-brand mb-2 mb-lg-0">Binutrima</a>
            <form class="d-flex mb-0 h-75" method="GET" action="{{  route('search') }}">
                <input class="form-control me-2 zaobljeno" type="search" placeholder="Pretraga" name="search" id="search" aria-label="Search"/>
                <button class="btn border zaobljeno bg-dark zelelnaPrevlaka" id="searchButton" type="submit"><i class="fas fa-search text-white"></i></button>
            </form>
        </div>
        <button class="navbar-toggler d-block d-lg-none mb-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</div>
<div class="container px-lg-5">
    <nav class=" container px-lg-4 navbar navbar-expand-lg navbar-light text-uppercase mb-sm-5">
        <div class="container-fluid">
            <div class="collapse navbar-collapse text-end" id="navbarNav">
                <ul class="navbar-nav">
                    @foreach($menu as $menuTab)
                        <li class="nav-item">
                            <a class="nav-link navFont" aria-current="page" href="{{route($menuTab->route, $menuTab->cat_id)}}">
                                @empty($menuTab->name)
                                    {{$menuTab->text}}
                                @endempty
                                @empty($menuTab->text)
                                    {{$menuTab->name}}
                                @endempty
                            </a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" id="auth"
                           href="@guest {{route('login.index')}} @endguest @auth {{route('logout')}} @endauth ">@guest <i class="fas fa-sign-in-alt mt-xxl-1 mt-xl-2 mt-lg-1 iconFont"></i>  @endguest  @auth <i class="fas fa-share-square mt-xxl-1 mt-xl-2 mt-lg-1 iconFont"></i>  @endauth
                        </a>
                    </li>
                    @auth
                        @if(Auth::user()->role_id == Config::get('constants.admin_id'))
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page"  href="#">
                                    <i class="fas fa-tools iconFont mt-xxl-1 mt-xl-2 mt-lg-1"></i>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page"  href="{{route('users.edit', Auth::id())}}">
                                <i class="fas fa-user iconFont mt-xxl-1 mt-xl-2 mt-lg-1"></i>
                                <span class="text-lowercase ms-1 mt-xxl-1 mt-xl-2 mt-lg-1">{{Auth::user()->username}}</span>
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</div>
