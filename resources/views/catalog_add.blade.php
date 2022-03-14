@extends('layout')

@section('title')
    Add product
@endsection

@section('content')
    <a href="/catalog"><button class="btn btn-primary">Back</button></a>
    <hr class="md">
    <form method="post" class="p-4 p-md-5 border rounded-3 bg-light" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-12">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name of product">
        </div>

        <div class="col-12">
            <label for="info" class="form-label">Description</label>
            <input type="text" class="form-control" id="info" name="info" placeholder="Description info">
        </div>

        <div class="col-12">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control" id="code" name="code" placeholder="Unique code">
        </div>

        <div class="col-12">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Price">
        </div>

        <br>
        <div class="col-12">
            <input type="file" name="filePhoto" id="filePhoto" >
        </div>

        <br>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="access" name="access" checked="checked">
            <label class="form-check-label" for="access">Access for users</label>
        </div>
        <hr class="md">
        <button class="w-100 btn btn-lg btn-primary" type="submit">Add</button>
    </form>
@endsection
