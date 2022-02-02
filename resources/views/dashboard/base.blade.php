@extends('base.base')
@section('main')
    <div class="border-top py-3">
        <div class="container">
            <div class="row">
                <div class="col col-4">
                    @include('dashboard.sidebar')
                </div>
                <div class="col col-8">
                    @yield('dash.main')
                </div>
            </div>
        </div>
    </div>
@endsection
