@extends('dashboard.base')
@section('title')
    Editer {{ $post->role }} | Admin
@endsection
@section('dash.main')
    <div class="row justify-content-end">
        <a href="{{ route('team.index') }}" role="button" class="btn btn-dark col col-auto"> <i
                class="mdi mdi-grid"></i> </a>
    </div>
    <form action="{{ route('team.update') }}" method="POST" enctype="multipart/form-data">
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
            <input type="text" name="Nom" value="{{ $post->last_name }}" id="title" placeholder="Entrer le nom :"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="title2" class="form-text">Prenom *</label>
            <input type="text" name="Prenom" value="{{ $post->first_name }}" id="title2" placeholder="Entrer le Prenom :"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="title4" class="form-text">Role *</label>
            <input type="text" name="Role" value="{{ $post->role }}" id="title4" placeholder="Entrer son Role :"
                   class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="cover" class="form-text">Image *</label>
            <input type="file" name="Photo" id="cover" class="form-control">
            @if($post->avatar)
               <a href="{{ Storage::url($post->avatar) }}" target="_blank">Visualiser l'image</a>
            @endif
        </div>
        <div class="form-group my-2">
            <label for="editor" class="form-text">Biographie *</label>
            <textarea name="Biographie" id="editor" cols="30" rows="6" class="form-control">
                {{ $post->bio }}
            </textarea>
        </div>
        <div class="form-group my-3 text-center">
            <button class="btn btn-success w-50 m-auto">Editer</button>
        </div>
    </form>
@endsection
