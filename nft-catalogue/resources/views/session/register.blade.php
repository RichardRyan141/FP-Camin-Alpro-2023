<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NFT Catalogue</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />                
</head>
    <body>
        <div class="bg-dark text-white py-2">
            <div class="d-flex justify-content-between mx-5">
                <h3>NFT Catalogue</h3>
            </div>
        </div>
        <div class="content mx-5 my-4">
            <h1>Create User</h1>
            <form action="/" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="nama" placeholder="Enter Username">
                    @error('nama')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Password">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Retype your Password">
                    @error('password')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="/" class="btn btn-light"><< Back</a>
                    <button type="submit" class="btn btn-primary" style="border-radius: 3px">
                        <i class="nav-icon fas fa-plus-circle"></i>
                        Add User
                    </button>
                </div>
            </form>
        </div>
    </body>
</html>