<ul class="list-group">
    <li class="list-group-item list-group-item-action list-group-item-dark link" data-url="post">
        <a href="{{ route('post.index') }}" class="oswald-bold text-decoration-none">Postes</a>
        <a href="{{ route('post.create') }}" class="float-end oswald-bold"><i
                class="mdi mdi-plus-circle-outline"></i></a>
    </li>
    <li class="list-group-item list-group-item-action list-group-item-dark link" data-url="partner">
        <a href="{{ route('partner.index') }}" class="oswald-bold text-decoration-none">Nos Partenaires</a>
        <a href="{{ route('partner.create') }}" class="float-end oswald-bold"><i
                class="mdi mdi-plus-circle-outline"></i></a>
    </li>
    <li class="list-group-item list-group-item-action list-group-item-dark link" data-url="gallery">
        <a href="{{ route('gallery.index') }}" class="oswald-bold text-decoration-none">Gallerie</a>
        <a href="{{ route('gallery.create') }}" class="float-end oswald-bold"><i
                class="mdi mdi-plus-circle-outline"></i></a>
    </li>
    <li class="list-group-item list-group-item-action list-group-item-dark link" data-url="technology">
        <a href="{{ route('technology.index') }}" class="oswald-bold text-decoration-none">Nos Technologies</a>
        <a href="{{ route('technology.create') }}" class="float-end oswald-bold"><i
                class="mdi mdi-plus-circle-outline"></i></a>
    </li>
    <li class="list-group-item list-group-item-action list-group-item-dark link" data-url="service">
        <a href="{{ route('service.index') }}" class="oswald-bold text-decoration-none">Nos Services</a>
        <a href="{{ route('service.create') }}" class="float-end oswald-bold"><i
                class="mdi mdi-plus-circle-outline"></i></a>
    </li>
    <li class="list-group-item list-group-item-action list-group-item-dark link" data-url="about">
        <a href="{{ route('about.index') }}" class="oswald-bold text-decoration-none">A Propos</a>
        <a href="{{ route('about.create') }}" class="float-end oswald-bold"><i
                class="mdi mdi-plus-circle-outline"></i></a>
    </li>
    <li class="list-group-item list-group-item-action list-group-item-dark link" data-url="exploit">
        <a href="{{ route('exploit.index') }}" class="oswald-bold text-decoration-none">Pourquoi-Nous</a>
        <a href="{{ route('exploit.create') }}" class="float-end oswald-bold"><i
                class="mdi mdi-plus-circle-outline"></i></a>
    </li>
    <li class="list-group-item list-group-item-action list-group-item-dark link" data-url="customer">
        <a href="{{ route('customer.index') }}" class="oswald-bold text-decoration-none">Les Clients</a>
        <a href="{{ route('customer.create') }}" class="float-end oswald-bold"><i
                class="mdi mdi-plus-circle-outline"></i></a>
    </li>
    <li class="list-group-item list-group-item-action list-group-item-dark link" data-url="team">
        <a href="{{ route('team.index') }}" class="oswald-bold text-decoration-none">Notre Equipe</a>
        <a href="{{ route('team.create') }}" class="float-end oswald-bold"><i
                class="mdi mdi-plus-circle-outline"></i></a>
    </li>
    <li class="list-group-item list-group-item-action list-group-item-dark link" data-url="project">
        <a href="{{ route('project.index') }}" class="oswald-bold text-decoration-none">Nos Projets</a>
        <a href="{{ route('project.create') }}" class="float-end oswald-bold"><i
                class="mdi mdi-plus-circle-outline"></i></a>
    </li>
    <li class="list-group-item list-group-item-action list-group-item-dark link" data-url="blog">
        <a href="{{ route('blog.index') }}" class="oswald-bold text-decoration-none">Blogs</a>
        <a href="{{ route('blog.create') }}" class="float-end oswald-bold"><i
                class="mdi mdi-plus-circle-outline"></i></a>
    </li>
    <li class="list-group-item list-group-item-action list-group-item-dark link" data-url="category">
        <a href="{{ route('category.index') }}" class="oswald-bold text-decoration-none">Les Categories</a>
        <a href="{{ route('category.create') }}" class="float-end oswald-bold"><i
                class="mdi mdi-plus-circle-outline"></i></a>
    </li>
</ul>

<script>
    $('.link').each(function (key, elt) {
        if (window.location.pathname.includes($(elt).data('url'))){
            $(elt).removeClass('list-group-item-dark').addClass('list-group-item-light');
        }
    })
</script>