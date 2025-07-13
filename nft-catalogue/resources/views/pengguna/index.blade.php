@extends('master')
@section('content')
    <h1>Your Stats</h1>
    
    @if(session()->has('error'))
        <div class="alert alert-danger" style="margin-top: 20px">
            {{ session()->get('error') }}
        </div>
    @endif

    @if(session()->has('success'))
        <div class="alert alert-success" style="margin-top: 20px">
            {{ session()->get('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>UID</th>
                <th>Name</th>
                <th>Number of NFTs Owned</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $user->uid }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->nft_count }}</td>
                <td>
                    <form action="{{ route('pengguna.destroy', $user->uid) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    <a href="/user/logout" class="btn btn-primary mb-2">Logout</a>
    <a href="/user/change-password" class="btn btn-primary mb-2">Change Password</a>
@endsection
