@extends('dashboard.base')
@section('title')
    Ajouter Un Client | Admin
@endsection
@section('dash.main')
    <div class="row justify-content-end">
        <a href="{{ route('customer.index') }}" role="button" class="btn btn-dark col col-auto"> <i
                class="mdi mdi-grid"></i> </a>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
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
            <input type="text" name="Nom" id="title" placeholder="Entrer le nom du client :"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="title2" class="form-text">Titre *</label>
            <input type="text" name="Titre" id="title2" placeholder="Entrer le titre :"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="title4" class="form-text">Icon en classe mdi</label>
            <input type="text" name="Icon" id="title4" placeholder="Entrer l'icon :"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="title3" class="form-text">Logo en Image</label>
            <input type="file" name="Logo" id="title3" class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="editor" class="form-text">Description *</label>
            <textarea name="Description" id="editor" cols="30" rows="6" class="form-control"></textarea>
        </div>
        <div class="form-group my-3 text-center">
            <button class="btn btn-success w-50 m-auto">Publié</button>
        </div>
    </form>
@endsection
