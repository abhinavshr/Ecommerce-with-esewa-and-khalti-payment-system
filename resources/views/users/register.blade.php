<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/user/register.css') }}">

</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form action=" {{ route('user.userregister.store') }} " method="POST" enctype="multipart/form-data">
            @csrf
            <table>
                <tr>
                    <td><label for="username">Username:</label></td>
                    <td><input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Enter your username" style="{{ $errors->first('username') ? 'border-color: red;' : '' }}"></td>
                    <td style="color:red;">{{ $errors->first('username') }}</td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter your email" style="{{ $errors->first('email') ? 'border-color: red;' : '' }}"></td>
                    <td style="color:red;">{{ $errors->first('email') }}</td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" name="password" id="password" placeholder="Enter your password" style="{{ $errors->first('password') ? 'border-color: red;' : '' }}"></td>
                    <td style="color:red;">{{ $errors->first('password') }}</td>
                </tr>
                <tr>
                    <td><label for="password_confirmation">Confirm Password:</label></td>
                    <td><input type="password" name="password_confirmation" id="password_confirmation" placeholder="Enter your password again" style="{{ $errors->first('password_confirmation') ? 'border-color: red;' : '' }}"></td>
                    <td style="color:red;">{{ $errors->first('password_confirmation') }}</td>
                </tr>

                <tr>
                    <td><label for="phone_number">Phone Number:</label></td>
                    <td><input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" placeholder="Enter your phone number" style="{{ $errors->first('phone_number') ? 'border-color: red;' : '' }}"></td>
                    <td style="color:red;">{{ $errors->first('phone_number') }}</td>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Enter your address" style="{{ $errors->first('address') ? 'border-color: red;' : '' }}"></td>
                    <td style="color:red;">{{ $errors->first('address') }}</td>
                </tr>
                <tr>
                    <td><label for="profile_image">Profile Image:</label></td>
                    <td><input type="file" name="profile_image" id="profile_image" value="{{ old('profile_image') }}" placeholder="Enter your profile image" style="{{ $errors->first('profile_image') ? 'border-color: red;' : '' }}"></td>
                    <td style="color:red;">{{ $errors->first('profile_image') }}</td>
                </tr>
                <tr>
                    <td colspan="2"><button class="btn-register">Register</button></td>
                </tr>
            </table>
            <p>Already have an account? <a href="{{ route('user.userlogin') }}">Login</a></p>
        </form>
    </div>
</body>
</html>


