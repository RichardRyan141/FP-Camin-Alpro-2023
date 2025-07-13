@extends('master')
@section('content')
    <h1>Users List</h1>

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
        @foreach ($user as $pengguna)
            <tr>
                <td>{{ $pengguna->uid }}</td>
                <td>{{ $pengguna->name }}</td>
                <td>{{ $pengguna->nft_count }}</td>
                <td>                
                    @if ($pengguna->name !== 'Admin')
                        <form action="{{ route('pengguna.destroy', $pengguna->uid) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <a href="/user/create" class="btn btn-primary mb-2">Create User</a>
    <a href="/user/logout" class="btn btn-primary mb-2">Logout</a>
@endsection
