@extends('layout')

@section('title')
    Product
@endsection

@section('content')

    <div class="bg-light p-5 rounded">
    <div class="row ">
        <div class="col-md-6">
            @if($catalog->url_pic != '')
                <img src="{{ $catalog->url_pic }}" class=" d-block" width="100%" height="225">
            @else
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="40%" y="50%" fill="#eceeef" dy=".3em">Picture</text></svg>
            @endif
        </div>
        <div class="col-md-6">
            <h2>{{  $catalog->name  }}</h2>
            <p class="card-text mb-auto">Info: {{  $catalog->info  }}</p>
            <p class="card-text mb-auto">Price: {{  $catalog->price  }}</p>
            <p class="card-text mb-auto">Owner: <a href="/profile/{{ $user_owner->id }}">{{  $user_owner->name  }}</p></a>
            @if(App\Models\Sales::getOwner($catalog->id, $user->id))
                <small class="text-muted">Code: {{ $catalog->code }}</small>
            @endif
            <hr class="md">
            <div class="btn-group">
                @if($catalog->owner_id == $user->id)
                    <a href="/catalog/rem/{{  $catalog->id  }}"><button type="button" class="btn btn-lg btn-danger">Remove</button></a>
                @endif
                @if(! App\Models\Sales::getOwner($catalog->id, $user->id) )
                    <a href="/catalog/buy/{{  $catalog->id  }}"><button type="button" class="btn btn-lg btn-success">Buy</button></a>
                @endif
            </div>
        </div>
    </div>

    <div class="row ">
        <div class="col-md-6">
            <h2>Buyers:</h2>
            <ul class="icon-list">
                @foreach (App\Models\Sales::getListBuyers($catalog->id) as $user)
                    <li><a href="/profile/{{ $user->id }}">{{ $user->name }}</a></li>
                @endforeach
            </ul>
        </div>

    </div>
    </div>
@endsection
