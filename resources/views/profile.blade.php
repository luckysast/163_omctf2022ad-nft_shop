@extends('layout')

@section('title')
    Profile
@endsection

@section('content')
    <div class="bg-light p-5 rounded">
    <h1>Name: {{ $user->name }}</h1>
    <h1>Email: {{ $user->email }}</h1>
        @if(App\Models\Users::getUser()->id == $user->id)
    <h1>Money: {{ $user->money }}</h1>
        @else
            <form action="/profile/give/{{ $user->id }}">
                <div class="input-group col-lg-6 mb-3">
                    <div class="col-md-5 mb-3">
                        <h2>You have money: {{ App\Models\Users::getUser()->money }}</h2>
                    </div>
                    <div class="col-md-3 mb-3">
                    <input type="text" name="cash" class="form-control col-3" placeholder="Give money">
                    </div>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Donate</button>
                    </div>
                </div>
            </form>
        @endif

    <hr class="col-3 col-md-4 mb-5">

    <div class="row g-5">

        <div class="col-md-6">
            <h2>User products</h2>
            <ul class="icon-list">
                @foreach ($catalogs as $catalog)
                    <li><a href="/catalog/{{ $catalog->id }}">{{ $catalog->name }}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-6">
            <h2>Purchased products</h2>
            <ul class="icon-list">
                @foreach ($sales as $sale)
                    <li><a href="/catalog/{{ $sale->id }}">{{ $sale->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    </div>
@endsection
