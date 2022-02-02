@extends('dashboard.base')
@section('title')
    Editer {{ $post->title }} | Admin
@endsection
@section('dash.main')
    <div class="row justify-content-end">
        <a href="{{ route('gallery.index') }}" role="button" class="btn btn-dark col col-auto"> <i
                class="mdi mdi-grid"></i> </a>
    </div>
    <form action="{{ route('gallery.update', $post) }}" method="POST" enctype="multipart/form-data">
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
            <label for="title" class="form-text">Titre de L'image</label>
            <input type="text" name="name" value="{{ $post->title }}" id="title" placeholder="Entrer le Nom"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="cover" class="form-text">Cover </label>
            <input type="file" name="cover" value="{{ asset('assets/' . $post->cover) }}" id="cover"
                   class="form-control">
            <a href="{{ Storage::url($post->cover) }}" target="_blank">Visualiser l'image</a>
        </div>
        <div class="form-group my-3 text-center">
            <button class="btn btn-success w-50 m-auto">Edité</button>
        </div>
    </form>
@endsection
