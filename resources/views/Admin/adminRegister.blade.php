<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Register</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/Register.css') }}">
</head>

<body>
    <div class="mainContainer">
        <div class="container">
            <form action="{{ route('admin.adminregister.store') }}" method="POST">
                @csrf
                <h1>Admin Register</h1>
                <table>
                    <tr>
                        <td><label for="name">Full Name:</label></td>
                        <td>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="{{ $errors->first('name') ? $errors->first('name') : 'Enter your name' }}" style="{{ $errors->first('name') ? 'border-color: red;' : '' }}">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="{{ $errors->first('email') ? $errors->first('email') : 'Enter your email' }}" style="{{ $errors->first('email') ? 'border-color: red;' : '' }}"></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" name="password" id="password" placeholder="{{ $errors->first('password') ? $errors->first('password') : 'Enter your password' }}" style="{{ $errors->first('password') ? 'border-color: red;' : '' }}">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="confirm_password">Confirm Password:</label></td>
                        <td><input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ $errors->first('password_confirmation') ? $errors->first('password_confirmation') : 'Enter the password again' }}" style="{{ $errors->first('password_confirmation') ? 'border-color: red;' : '' }}"></td>
                    </tr>
                </table>
                <button class="btn-register">Register</button>
            </form>
        </div>
    </div>
</body>
</html>

