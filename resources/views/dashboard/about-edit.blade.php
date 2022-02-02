@extends('dashboard.base')
@section('title')
    Editer {{ $post->title }} | Admin
@endsection
@section('dash.main')
    <div class="row justify-content-end">
        <a href="{{ route('about.index') }}" role="button" class="btn btn-dark col col-auto"> <i
                class="mdi mdi-grid"></i> </a>
    </div>
    <form action="{{ route('about.update', $post) }}" method="POST" enctype="multipart/form-data">
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
            <input type="text" name="title" value="{{ $post->title }}" id="title" placeholder="Entrer le titre"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="title2" class="form-text">Experience</label>
            <input type="text" name="experience" value="{{ $post->experience }}" id="title2" placeholder="Entrer le contenu de l'Experience"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="title3" class="form-text">Support</label>
            <input type="text" name="support" value="{{ $post->support }}" id="title3" placeholder="Entrer le contenu de Support"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="cover" class="form-text">Images *</label>
            <select name="cover[]" id="cover" multiple class="form-select">
                @foreach($galleries as $gallery)
                    @foreach($post->galleries as $already)
                        <option @selected(old('id') == $already) value="{{ $gallery->id }}"> {{ $gallery->title }} </option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <div class="form-group my-2">
            <label for="editor" class="form-text">Contenu *</label>
            <textarea name="content" id="editor" cols="30" rows="6" class="form-control">
                {{ $post->content }}
            </textarea>
        </div>
        <div class="form-group my-3 text-center">
            <button class="btn btn-success w-50 m-auto">Publié</button>
        </div>
    </form>
@endsection
