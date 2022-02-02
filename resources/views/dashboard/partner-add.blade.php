@extends('dashboard.base')
@section('title')
    Ajouter Un Partenaire | Admin
@endsection
@section('dash.main')
    <div class="row justify-content-end">
        <a href="{{ route('partner.index') }}" role="button" class="btn btn-dark col col-auto"> <i
                class="mdi mdi-grid"></i> </a>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        @if( $errors->any())
            <div class="alert alert-dismissible alert-danger" role="alert" id="liveAlert">
                <div class="msg-alert">
                    @foreach($errors->all() as $error)
                        <p>
                            <small>{{ $error }}</small>
                        </p>
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
            <input type="text" name="name" id="title" placeholder="Entrer le Nom"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="title2" class="form-text">Classe mdi du Logo </label>
            <input type="text" name="icon" id="title2" placeholder="Entrer le nom du Logo"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="cover" class="form-text">Logo </label>
            <input type="file" name="logo" id="cover" class="form-control">
        </div>
        <div class="form-group my-3 text-center">
            <button class="btn btn-success w-50 m-auto">Publié</button>
        </div>
    </form>
@endsection
