@extends('dashboard.base')
@section('title')
    Editer {{ $post->title }} | Admin
@endsection
@section('dash.main')
    <div class="row justify-content-end my-2">
        <a href="{{ route('blog.index') }}" role="button" class="btn btn-dark col col-auto"> <i
                class="mdi mdi-grid"></i> </a>
    </div>
    <form action="{{ route('blog.update', $post) }}" method="POST" enctype="multipart/form-data">
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
            <label for="title" class="form-text">Titre *</label>
            <input type="text" name="title" value="{{ $post->title }}" id="title" placeholder="Entrer le titre du post :"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="title2" class="form-text">Categorie *</label>
            <select name="category_id" id="title2" class="form-select">>
                @foreach ($categories as $cat)
                    <option {{ $post->category_id === $cat->id ? 'selected': null }} value="{{ $cat->id }}"> {{ $cat->name }} </option>
                @endforeach
            </select>
        </div>
        <div class="form-group my-2">
            <label for="title3" class="form-text">Image de Couverture *</label>
            <input type="file" name="screen" id="title3" class="form-control">
            @if($post->cover)
               <a href="{{ Storage::url($post->cover) }}" target="_blank">Visualiser l'image</a>
            @endif
        </div>
        <div class="form-group my-2">
            <label for="editor" class="form-text">Contenu *</label>
            <textarea name="content" id="editor" cols="30" rows="6" class="form-control">
                {{ $post->content }}
            </textarea>
        </div>
        <div class="form-group my-3 text-center">
            <button class="btn btn-success w-50 m-auto">Editer</button>
        </div>
    </form>
@endsection
