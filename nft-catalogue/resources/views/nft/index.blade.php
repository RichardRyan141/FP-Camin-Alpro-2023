@extends('master')
@section('content')
    <h1>NFT List</h1>
    <div class="row">
        @foreach ($nfts as $nft)
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="{{ $nft->image_link }}" alt="{{ $nft->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $nft->name }}</h5>
                        <p class="card-text">{{ $nft->description }}</p>
                    </div>
                    <div class="card-footer">
                        <label>Owner: {{ $nft->pengguna->name }}</label>
                        <form action="{{ route('nft.destroy', $nft->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('nft.edit', $nft->id) }}" class="btn btn-primary btn-create">Update</a>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this NFT?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-between" style="padding-top: 20px">
        <a href="/user" class="btn btn-light"><< Back</a>    
        <a href="/nft/create" class="btn btn-primary btn-create">
            Create NFT
        </a>
    </div>
@endsection
