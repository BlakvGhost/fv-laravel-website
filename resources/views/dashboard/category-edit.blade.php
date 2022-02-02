@extends('dashboard.base')
@section('title')
    Editer {{ $post->name }} | Admin
@endsection
@section('dash.main')
    <div class="row justify-content-end my-2">
        <a href="{{ route('category.index') }}" role="button" class="btn btn-dark col col-auto"> <i
                class="mdi mdi-grid"></i> </a>
    </div>
    <form action="{{ route('category.update', $post) }}" method="POST" enctype="multipart/form-data">
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
            <input type="text" name="name" value="{{ $post->name }}" id="title" placeholder="Entrer le nom de la categorie :"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="title" class="form-text">Icon *</label>
            <input type="text" name="icon" value="{{ $post->icon }}" id="title" placeholder="Entrer la classe MDI du logo :"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="editorI" class="form-text">Contenu *</label>
            <textarea name="desc" id="editorI" cols="30" rows="6" class="form-control">
                {{ $post->desc }}
            </textarea>
        </div>
        <div class="form-group my-3 text-center">
            <button class="btn btn-success w-50 m-auto">Editer</button>
        </div>
    </form>
@endsection
