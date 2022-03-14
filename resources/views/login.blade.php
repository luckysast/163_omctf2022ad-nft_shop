@extends('layout')

@section('title')
    Login
@endsection

@section('content')
    <div class="col-md-10 mx-auto col-lg-6">
        @if($error != '')
            <div class="alert alert-danger">
                Authorisation Error!
            </div>
        @endif
        <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="/login">
            <h2>Authorization</h2>
            <div class="form-floating mb-3">
                <input name="name" type="name" class="form-control" id="floatingInput" placeholder="name">
                <label for="floatingInput">Nickname / Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit"><i class="bi-door-closed"></i> Login</button>
        </form>
    </div>
@endsection
