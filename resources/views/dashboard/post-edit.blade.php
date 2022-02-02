@extends('dashboard.base')
@section('title')
    Editer {{ $post->sup_title }} | Admin
@endsection
@section('dash.main')
    <div class="row justify-content-end">
        <a href="{{ route('post.index') }}" role="button" class="btn btn-dark col col-auto"> <i
                class="mdi mdi-grid"></i> </a>
    </div>
    <form action="{{ route('post.update', $post) }}" method="POST" enctype="multipart/form-data">
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
            <label for="title" class="form-text">Titre Inferieur *</label>
            <input type="text" name="titre_inferieur" value="{{ $post->sub_title }}" id="title"
                   placeholder="Entrer le titre Inferieur" class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="title2" class="form-text">Titre Superieur *</label>
            <input type="text" name="titre_superieur" value="{{ $post->sup_title }}" id="title2"
                   placeholder="Entrer le titre Superieur" class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="cover" class="form-text">Image de Couverture *</label>
            <input type="file" name="cover" value="{{ asset('assets/' . $post->cover) }}" id="cover"
                   class="form-control">
            <a href="{{ Storage::url($post->cover) }}" target="_blank">Visualiser l'image</a>
        </div>
        <div class="form-group my-2">
            <label for="editor" class="form-text">Contenu*</label>
            <textarea name="desc" id="editor" cols="30" rows="6" class="form-control">
                {{ $post->content }}
            </textarea>
        </div>
        <div class="form-group my-3 text-center">
            <button class="btn btn-success w-50 m-auto">Editer</button>
        </div>
    </form>
@endsection
