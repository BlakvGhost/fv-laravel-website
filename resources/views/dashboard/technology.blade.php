@extends('dashboard.base')
@section('title')
    Voir les technologies | Admin
@endsection
@section('dash.main')
    <div class="row justify-content-end">
        <a href="{{ route('technology.create') }}" role="button" class="btn btn-dark col col-auto"> <i
                class="mdi mdi-plus-circle"></i> </a>
    </div>
    <div class="my-4">
        @if( session('status'))
            <div class="alert alert-dismissible alert-success" role="alert" id="OkliveAlert">
                <div class="msg-alert">
                    <small> {{ session('status')}} </small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('technology.destroy') }}" method="POST">
            @csrf
            <div class="my-3 text-end">
                <button type="submit" class="btn btn-danger">Supprimer les technologies Selectionner</button>
            </div>
            <h2 class="text-fv-primary my-2"> {{ $posts->count() }} technology </h2>
            <ul class="list-group">
                @foreach($posts as $post)
                    <li class="list-group-item list-group-item-action">
                        <input type="checkbox" name="{{ $post->id }}" class="form-check-input">
                        <a href="{{ route('technology.edit', $post) }}"
                           class="text-decoration-none">{{ $post->name }}</a>
                    </li>
                @endforeach
            </ul>
        </form>
    </div>
@endsection
