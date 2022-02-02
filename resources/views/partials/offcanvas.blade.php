<div class="offcanvas offcanvas-end" tabindex="-1" id="gridShow" aria-labelledby="gridShowLabel" style="z-index:500000">
    <div class="offcanvas-header">
        <a href="/" class="offcanvas-title"  id="gridShowLabel">
            <img src="/logo.jpg" alt="logo de futuravision" style="width:160px; max-height:40px">
        </a>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="navbar-nav fv-d-none-lg mb-3">
            <div class="fv-slide-title-big">
                <h4 class="oswald-bold fw-bold text-dark text-decoration-underline">Pages</h4>
            </div>
                <div class="navbar-brand fv-list animate__animated animate__fadeInDown">
                    <a href="/" class="nav-link fw-bold">Acceuil</a>
                </div>
                <div class="navbar-brand fv-list animate__animated animate__fadeInDown fv-zd">
                    <a href="javascript:void(0)" class="nav-link text-dark fw-bold dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#home2Label" id="home2">Nos-Services</a>
                    <div class="fv-list-group collapse animate__animated animate__fadeInDown" aria-labelledby="home" id="home2Label">
                        <ul class="list-group animate__animated animate__fadeInDown">
                            <li class="list-group-item list-group-item-action border-0">
                                <a href="/services" class="nav-link">
                                    <i class="mdi mdi-arrow-right-thin align-middle"></i>
                                        &nbsp; <span>Tout Nos Services</span>
                                </a>
                            </li>
                            @foreach ($partials['services'] as $item)
                                <li class="list-group-item list-group-item-action border-0">
                                    <a :to="`/service/${sv.id}/${sv.name}`" class="nav-link">
                                        <i class="mdi mdi-arrow-right-thin align-middle"></i>
                                        &nbsp;
                                        <span> {{ $item.name }} </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="navbar-brand fv-list animate__animated animate__fadeInDown fv-zd">
                    <a href="javascript:void(0)" class="nav-link text-dark fw-bold dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#public2Label" id="home">Public</a>
                    <div class="fv-list-group collapse animate__animated animate__fadeInDown" aria-labelledby="home" id="public2Label">
                        <ul class="list-group animate__animated animate__fadeInDown">
                            <li class="list-group-item list-group-item-action border-0">
                                <a href="/blog" class="nav-link">
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
                    <a href="/contact" class="nav-link fw-bold">Contactez-Nous</a>
                </div>
            </div>
        <div class="fv-slide-title-normal fvSlideOn">
            <div class="fv-slide-title-big mb-3">
                <h4 class="oswald-bold fw-bold text-dark text-decoration-underline">A Propos de Nous</h4>
            </div>
            <h5>
                {{-- {{ $about.content }} --}}
            </h5>
        </div>
        <div class="my-3">
            <div class="fv-slide-title-big fvSlideOn">
                <h4 class="oswald-bold fw-bold text-dark">Gallery</h4>
            </div>
            <div class="my-2">
                <div class="container-fluid h-75">
                    <div class="row w-100 h-100">
                        {{-- <div class="fv-img-fluid col col-6 p-2" v-for="img in about.gallery" :key="img.id">
                            <img :src="img.cover" :alt="img.title" :title="img.title" class="shadow img-thumbnail">
                        </div>                         --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="my-3">
            <div class="fv-slide-title-big fvSlideOn">
                <h4 class="oswald-bold fw-bold text-dark">Contacts</h4>
            </div>
            <div class="my-2">
                <div class="fv-slide-title-normal fvSlideOn">
                    <h5><a href="javascript:void(0)" class="nav-link text-black"><i class="mdi mdi-earth text-fv-primary mdi-24px align-middle"></i>&nbsp;&nbsp; Lycée Technique de Natitingou, Benin Africa </a></h5>
                </div>
                <div class="fv-slide-title-normal fvSlideOn">
                    <h5><a href="javascript:void(0)" class="nav-link text-black"><i class="mdi mdi-phone text-fv-primary mdi-24px align-middle"></i>&nbsp;&nbsp; +229 964 311 50 </a></h5>
                </div>
                <div class="fv-slide-title-normal fvSlideOn">
                    <h5><a href="javascript:void(0)" class="nav-link text-black"><i class="mdi mdi-email text-fv-primary mdi-24px align-middle"></i>&nbsp;&nbsp; futura.vision@yahoo.com</a></h5>
                </div>
            </div>
        </div>
        <div>
            <div class="text-center my-3">
                <h4 class="text-dark fvSlideOn">Copyright {{ 2022 }} - FuturaVision All Right Reserved</h4>
            </div>
            <div class="text-center mb-2">
                <a href="javascript:void(0)" class="text-black-50 text-decoration-none"><i class="mdi mdi-facebook"></i></a>
                <a href="javascript:void(0)" class="text-black-50 text-decoration-none"><i class="mdi mdi-twitter"></i></a>
                <a href="javascript:void(0)" class="text-black-50 text-decoration-none"><i class="mdi mdi-whatsapp"></i></a>
                <a href="javascript:void(0)" class="text-black-50 text-decoration-none"><i class="mdi mdi-linkedin"></i></a>
            </div>
        </div>
    </div>
</div>

{{-- <style scoped>
    .dropdown-toggle::after {float: right;}
</style> --}}
