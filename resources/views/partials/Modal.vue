<template>
    <div id="search" class="position-fixed collapse top-0 start-0 w-100 modal-backdrop h-100 bg-opacity-75 bg-dark animated rotateIn">
    <div class="position-absolute" style="top: 10%;right:10%;" id="closeSearch">
        <a href="javascript:void(0)" class="btn btn-outline-light"><i class="mdi mdi-close-circle-outline mdi-24px"></i></a>
    </div>
    <div class="container-fluid position-absolute start-0 top-50">
        <div class="row">
            <div class="col col-6 m-auto fv-w-100-sm">
                <div style="height: 60px;" class="w-100">
                    <form action="" class="input-group h-100 shadow">
                        <input type="text" name="q" class="form-control" placeholder="Entrer un mot..." style="font-size: 24px;">
                        <button class="btn btn-dark" type="submit"><i class="mdi mdi-search-web mdi-36px"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="WindowPreloader" class="position-fixed top-0 start-0 w-100 modal-backdrop h-100 bg-black">
    <div class="container-fluid position-absolute start-0 top-50">
        <div class="row">
            <div class="col col-6 m-auto">
                <div class="text-center">
                    <h2 class="m-auto"><a href="javascript:void(0)" class="text-white-50 text-decoration-none">FuturaVision</a></h2>
                </div>
            </div>
        </div>
    </div>
</div>
</template>