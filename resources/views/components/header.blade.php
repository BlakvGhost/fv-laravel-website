<header>
    <div class="header-color w-100 overflow-hidden fv-d-none-sm" id="a">
        <div class="container-custom" style="height: 23px">
            <nav class="navbar navbar-expand bg-transparent navbar-light justify-content-between h-100">
                <div class="navbar-nav">
                    <a href="javascript:void(0)" class="nav-link text-light border-start"><i class="mdi mdi-twitter"></i></a>
                    <a href="javascript:void(0)" class="nav-link text-light border-start"><i class="mdi mdi-facebook"></i></a>
                    <a href="javascript:void(0)" class="nav-link text-light border-end border-start"><i class="mdi mdi-linkedin"></i></a>
                </div>
                <div class="navbar-nav">
                    <a href="javascript:void(0)" class="nav-link text-white-50 border-start border-end"><i class="mdi mdi-phone mdi-light"></i>&nbsp;&nbsp; +229 964 311 50 </a>
                    <a href="javascript:void(0)" class="nav-link text-white-50 border-end"><i class="mdi mdi-email mdi-light"></i>&nbsp;&nbsp; futura.vision@yahoo.com </a>
                </div>
            </nav>
        </div>
    </div>
    <div class="bg-white w-100 position-relative" id="static-header">
        <div class="container-custom">
            <nav class="navbar navbar-expand bg-white navbar-light justify-content-between pb-0">
                <div class="navbar-nav">
                    <a href="/" class="nav-link px-0">
                        <img src="/logo.jpg" alt="logo de futuravision" style="width:160px; max-height:40px">
                    </a>
                </div>
                <div class="navbar-nav fv-d-none-sm">
                    <div class="navbar-brand fv-list dropdown animate__animated animate__fadeInDown">
                        <a href="/" class="nav-link fw-bold" id="home">Acceuil</a>
                    </div>
                    <div class="navbar-brand fv-list dropdown animate__animated animate__fadeInDown fv-zd">
                        <a href="javascript:void(0)" class="nav-link fw-bold dropdown-toggle" data-bs-toggle="dropdown" id="serviceH">Nos-Services</a>
                        <div class="fv-list-group dropdown-menu animate__animated animate__fadeInDown" aria-labelledby="serviceH">
                            <ul class="list-group animate__animated animate__fadeInDown">
                                <li class="list-group-item list-group-item-action border-0">
                                    <a href="{{ route('service.all') }}" class="nav-link">
                                        <i class="mdi mdi-arrow-right-thin align-middle"></i>
                                        &nbsp; <span>Tout Nos Services</span>
                                    </a>
                                </li>
                                @foreach ($services as $item)
                                    <li class="list-group-item list-group-item-action border-0">
                                        <a href="{{ route('service.show', [$item , str_replace(' ', '-', Str::lower($item->name))]) }}"" class="nav-link">
                                            <i class="mdi mdi-arrow-right-thin align-middle"></i>
                                            &nbsp;
                                            <span> {{ $item->name }} </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="navbar-brand fv-list dropdown animate__animated animate__fadeInDown fv-zd">
                        <a href="javascript:void(0)" class="nav-link fw-bold dropdown-toggle" data-bs-toggle="dropdown" id="public">Public</a>
                        <div class="fv-list-group dropdown-menu animate__animated animate__fadeInDown" aria-labelledby="public">
                            <ul class="list-group animate__animated animate__fadeInDown">
                                <li class="list-group-item list-group-item-action border-0">
                                    <a href="{{ route('blog.all') }}" class="nav-link">
                                        <i class="mdi mdi-arrow-right-thin align-middle"></i>
                                        &nbsp; <span>Blog</span>
                                    </a>
                                </li>
                                <li class="list-group-item list-group-item-action border-0">
                                    <a href="/forum" class="nav-link">
                                        <i class="mdi mdi-arrow-right-thin align-middle"></i>
                                        &nbsp; <span>Forum</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="navbar-brand fv-list animate__animated animate__fadeInDown">
                        <a href="{{ route('contact') }}" class="nav-link fw-bold">Contactez-Nous</a>
                    </div>
                </div>
                <div class="navbar-nav">
                    <div class="navbar-brand fv-m-0-sm">
                        @auth
                            <a href="{{ route('account.current') }}" class="nav-link position-relative">
                                <i class="mdi mdi-account-cog mdi-24px"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="nav-link position-relative">
                                <i class="mdi mdi-account-outline mdi-24px"></i>
                            </a>
                        @endauth
                    </div>
                    <div class="navbar-brand fv-m-0-sm">
                        <a href="javascript:void(0)" class="nav-link position-relative" data-bs-toggle="collapse" data-bs-target="#searchBarH">
                            <i class="mdi mdi-search-web mdi-24px"></i>
                        </a>
                    </div>
                    <div class="navbar-brand fv-m-0-sm">
                        <a href="javascript:void(0)" id="openGridShow" class="nav-link position-relative" data-bs-toggle="offcanvas" data-bs-target="#gridShow" aria-controls="gridShowLabel">
                            <i class="mdi mdi-view-grid-outline mdi-24px"></i>
                        </a>
                    </div>
                </div>
            </nav>
            <nav class="border-top w-100 collapse" id="searchBarH">
                <x-search model="blog"></x-search>
            </nav>
        </div>
    </div>
</header>
