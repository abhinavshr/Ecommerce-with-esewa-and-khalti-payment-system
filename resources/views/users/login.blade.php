<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="  {{ asset('css/user/login.css') }}">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="" method="POST">
            @csrf
            <table>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter your email"></td>
                    <td>@error('email')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror</td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>
                    <td><input type="password" name="password" id="password" placeholder="Enter your password"></td>
                    <td>@error('password')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;">
                        <button type="submit">Login</button>
                    </td>
                </tr>
            </table>
            <p style="text-align: center;">Don't Have an Account? <a href="{{ route('user.userregister') }}">Sign Up</a></p>
        </form>
    </div>
</body>
</html>


