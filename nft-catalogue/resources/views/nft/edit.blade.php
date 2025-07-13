@extends('master')
@section('content')
<h1>Edit NFT</h1>
<form action="{{ route('nft.update', $nft->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')

    <img src="{{ $nft->image_link }}" alt="{{ $nft->name }}" style="margin-bottom: 20px;">

    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $nft->name }}">
        @error('name')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label>Description</label>
        <input type="text" name="description" class="form-control" value="{{ $nft->description }}">
        @error('description')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label>Owner: </label>
        <label style="font-weight: bold;">{{ $pemilik->name }}</label>
    </div>

    <div class="d-flex justify-content-between">
        <a href="/nft" class="btn btn-light"><< Back</a>
        <button type="submit">Update</button>
    </div>
</form>
@endsection
