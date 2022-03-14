@extends('layout')

@section('title')
    Register
@endsection

@section('content')
    <div class="col-md-10 mx-auto col-lg-6">
            @if($error != '')
                <div class="alert alert-danger">
                    This user already exists!
                </div>
            @endif
        <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="/registration">
            <h2>Registration</h2>
            <div class="form-floating mb-3">
                <input name="name" type="text" class="form-control" id="name" placeholder="name">
                <label for="floatingInput">Nickname</label>
            </div>
            <div class="form-floating mb-3">
                <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
        </form>

    </div>
@endsection
