@extends('layout')

@section('title')
    Catalog
@endsection

@section('content')
    <div class="bg-light p-5 rounded">
    <center><h1 class="fw-light">Catalog</h1></center>
    <a href="/catalog/add" class="btn btn-primary my-4">Add new product</a>


    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        @foreach ($catalogs as $catalog)
            <div class="col">
                <div class="card shadow-sm">
                    @if($catalog->url_pic != '')
                    <img src="{{ $catalog->url_pic }}" class=" d-block" width="100%" height="225">
                    @else
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="40%" y="50%" fill="#eceeef" dy=".3em">Picture</text></svg>
                    @endif
                    <div class="card-body">
                        <b class="card-text">name: {{ $catalog->name }}</b>
                        <p class="card-text">info: {{ $catalog->info }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="/catalog/{{  $catalog->id  }}"><button type="button" class="btn btn-lg btn-outline-secondary">View</button></a>
                                @if($catalog->owner_id == $user->id)
                                    <a href="/catalog/rem/{{  $catalog->id  }}"><button type="button" class="btn btn-lg btn-danger">Remove</button></a>
                                @endif
                                @if(! App\Models\Sales::getOwner($catalog->id, $user->id))
                                    <a href="/catalog/buy/{{  $catalog->id  }}"><button type="button" class="btn btn-lg btn-success">Buy</button></a>
                                @endif
                            </div>
                            <small class="text-muted">Price: {{ $catalog->price }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    </div>
@endsection
