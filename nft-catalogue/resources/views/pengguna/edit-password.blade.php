@extends('master')
@section('content')
    <h1>Change Password {{$pengguna->id}}</h1>

    @if(session()->has('error'))
        <div class="alert alert-danger" style="margin-top: 20px">
            {{ session()->get('error') }}
        </div>
    @endif

    <form action="/user/change-password" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Current Password</label>
            <input type="password" class="form-control" name="current_password" placeholder="Enter Password">
            @error('current_password')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>New Password</label>
            <input type="password" class="form-control" name="new_password" placeholder="Enter New Password">
            <input type="password" class="form-control" name="new_password_confirmation" placeholder="Retype your New Password">
            @error('new_password')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit">Change Password</button>
    </form>
@endsection
