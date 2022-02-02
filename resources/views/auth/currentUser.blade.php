@extends('base.base')
@section('title')
    {{ Auth::user()->first_name }}
@endsection
@section('main')
    <div class="border-top p-3">
        <div class="container-custom my-3">
            <div class="fv-title-normal fvSlideOn my-3 row">
                <h3 class="text-fv-primary col col-10"><span class="dbslash">//</span> &nbsp; Utilisateur / {{ Auth::user()->email }}</h3>
                <a href="{{ route('logout') }}" class="text-end btn btn-danger col text-center">Deconnectez-Vous</a>
            </div>
            <div class="my-2 text-center">
                <h3> <pre>{{Auth::user()}}</pre> </h3>
            </div>
        </div>
    </div>
@endsection


