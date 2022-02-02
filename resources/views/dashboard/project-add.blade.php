@extends('dashboard.base')
@section('title')
    Ajouter Un Projet | Admin
@endsection
@section('dash.main')
    <div class="row justify-content-end">
        <a href="{{ route('project.index') }}" role="button" class="btn btn-dark col col-auto"> <i
                class="mdi mdi-grid"></i> </a>
    </div>
    <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if( $errors->any())
            <div class="alert alert-dismissible alert-danger" role="alert" id="liveAlert">
                <div class="msg-alert">
                    @foreach($errors->all() as $error)
                        <small>{{ $error }}</small> <br>
                    @endforeach
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if( session('status'))
            <div class="alert alert-dismissible alert-success" role="alert" id="OkliveAlert">
                <div class="msg-alert">
                    <small> {{ session('status')}} </small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="form-group my-2">
            <label for="title" class="form-text">Nom *</label>
            <input type="text" name="Nom" id="title" placeholder="Entrer le nom du Projet:"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="title2" class="form-text">Lien URL *</label>
            <input type="url" name="URL" id="title2" placeholder="Entrer le lien URL du Projet :"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="title4" class="form-text">Categorie *</label>
            <input type="text" name="Category" id="title4" placeholder="Entrer la Categorie :"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="cover" class="form-text">Image *</label>
            <input type="file" name="Image" id="cover" class="form-control">
        </div>
        <div class="form-group my-3 text-center">
            <button class="btn btn-success w-50 m-auto">Publié</button>
        </div>
    </form>
@endsection
