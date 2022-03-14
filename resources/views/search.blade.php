@extends('layout')

@section('title')
    Search
@endsection

@section('content')

    <div class="bg-light p-5 rounded">
    <center><h1 class="fw-light">Search User</h1></center>

    <form method="post">
        <input type="text" class="form-control" id="search" name="search" placeholder="User name">
        <button class="btn btn-primary my-4" type="submit">Search</button>
    </form>

    <div class="list-group list-group-checkable col-md-6 mx-auto">

        @foreach ($users as $user)
            <a href="/profile/{{ $user->id }}">
                <div class="list-group-item py-3">
                    {{ $user->name }}
                    <span class="d-block small opacity-50">Has {{ App\Models\Users::getSales($user->id) }} products</span>
                </div>
            </a>
        @endforeach
    </div>
    </div>
@endsection
