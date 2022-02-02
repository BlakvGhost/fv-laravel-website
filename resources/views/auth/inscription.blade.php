@extends('base.base')
@section('title')
    Inscription
@endsection
@section('main')
    <div class="border-top p-3">
        <div class="container-custom my-3">
            <div class="my-3" style="font-size:22px">
                <form method="POST" class="fv-w-50-lg fv-w-100-sm m-auto">
                    <div class="fv-title-normal fvSlideOn my-3">
                        <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp; OUVRIR UN COMPTE</h3>
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
                    <div >
                        <div class="form-group my-2 fvSlideOn">
                            <label for="yourname" class="form-text">Prenom* : </label>
                            <input type="text" name="first_name" id="yourname" placeholder="Entrer votre Prenom" class="form-control" required>
                        </div>
                        <div class="form-group my-2 fvSlideOn">
                            <label for="yourfirstname" class="form-text">Nom de Famille* : </label>
                            <input type="text" name="last_name" id="yourfirstname" placeholder="Entrer votre Nom" class="form-control" required>
                        </div>
                        <div class="form-group my-2 fvSlideOn">
                            <label for="youremail" class="form-text">Email* : </label>
                            <input type="email" name="email" id="youremail" placeholder="Entrer votre Email" class="form-control" required>
                        </div>
                        <div class="form-group my-2 fvSlideOn">
                            <label for="yourpass" class="form-text">Mot de Passe* : </label>
                            <input type="password" name="password" id="yourpass" placeholder="Entrer un Mot de Passe" class="form-control" required>
                        </div>
                        <div class="form-group my-2 fvSlideOn">
                            <label for="yourpass2" class="form-text">Confirmer le Mot de Passe* : </label>
                            <input type="password" name="password2" id="yourpass2" placeholder="Entrer de nouveau le Mot de Passe" class="form-control" required>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="btn btn-link">Déjà un Compte ?</a>
                        </div>
                        <div class="text-center my-2 fvSlideOn">
                            <button type="submit" class="btn btn-success fv-w-50-lg fv-w-75-sm m-auto">S'inscrire</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
