@props(['class'])
<div class="my-3" style="font-size:22px">
    <form method="POST" class="fv-w-50-lg">
        <div class="form-group my-2 fvSlideOn position-relative" style="z-index:5">
            <label for="q" class="form-text d-none">Rechercher : </label>
            <input type="text" name="q" id="q" placeholder="Entrer un mot clé pour rechercher" class="form-control" autocomplete="off">
            <div class="position-absolute start-0 w-100 bg-white border d-none">
                <h4 class="p-2">Meilleurs Resultats de recherche pour <strong> </strong> </h4>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-action border animate__animated animate__fadeInDown" v-for="p in data" :key="p.id">
                        <a href="javascript:void(0)" class="nav-link"></a>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</div>
