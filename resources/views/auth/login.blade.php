@extends('base.base')
@section('title')
    Connexion
@endsection
@section('main')
    <div class="border-top p-3">
        <div class="container-custom my-3">
            <div class="my-3" style="font-size:22px">
                <form method="POST" class="fv-w-50-lg fv-w-100-sm m-auto">
                    <div class="fv-title-normal fvSlideOn my-3">
                        <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp; Se Connecter</h3>
                    </div>
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
                    <div class="form-group my-2 fvSlideOn">
                        <label for="youremail" class="form-text">Email* : </label>
                        <input type="email" name="email" id="youremail" placeholder="Entrer votre Email" class="form-control" required>
                    </div>
                    <div class="form-group my-2 fvSlideOn">
                        <label for="yourpass" class="form-text">Mot de Passe* : </label>
                        <input type="password" name="password" id="yourpass" placeholder="Entrer votre Mot de Passe" class="form-control" required>
                    </div>
                    <div class="text-center">
                        <a href="/membres/reset-password" class="btn btn-link">Mot de Passe Oublié</a>
                        <a href="{{ route('register') }}" class="btn btn-link">Ouvrir Un Compte</a>
                    </div>
                    <div class="text-center my-2 fvSlideOn">
                        <button type="submit" class="btn btn-success fv-w-50-lg fv-w-75-sm m-auto">Se Connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
