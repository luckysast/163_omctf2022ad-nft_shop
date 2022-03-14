@extends('layout')

@section('title')
    Home
@endsection

@section('content')
    <div class="row">
        @if(App\Models\Users::checkAuth())
            <div class="bg-light p-5 rounded">
        <div class="col-md-10 mx-auto col-lg-10">
            <h1 class="display-4 fw-bold lh-1 mb-3">Shop selling nft-pictures</h1>
            <p class="col-lg-10 fs-4">
                Here you can buy, sell and exchange your pictures for nft tokens. All products are offered in the catalog section. Your profile displays pictures posted by you, as well as pictures purchased on our site.
            </p>
        </div>
            </div>
        @endif
        @if(!App\Models\Users::checkAuth())
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">Shop selling nft-pictures</h1>
                <p class="col-lg-10 fs-4">
                    Here you can buy, sell and exchange your pictures for nft tokens. All products are offered in the catalog section. Your profile displays pictures posted by you, as well as pictures purchased on our site.
                </p>
            </div>
            <div class="col-md-10 mx-auto col-lg-6">
                <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="/login">
                    <div class="form-floating mb-3">
                        <input name="name" type="name" class="form-control" id="floatingInput" placeholder="name">
                        <label for="floatingInput">Nickname / Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit"><i class="bi-door-closed"></i> Login</button>
                    <div class="row" style="text-align: -webkit-right;" ><a href="/register">Register</a></div>
                    <hr class="my-4">
                    <small class="text-muted">By clicking Register, you agree to the terms of use.</small>
                </form>
            </div>
        @endif
    </div>
@endsection
