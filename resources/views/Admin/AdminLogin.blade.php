
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/Login.css') }}">
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>
        <form action=" {{ route('admin.adminlogin.check') }} " method="POST">
            @csrf
            <table>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter your email" style="{{ $errors->first('email') ? 'border-color: red;' : '' }}"></td>
                    <td style="color:red;">{{ $errors->first('email') }}</td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>
                    <td><input type="password" name="password" id="password" placeholder="Enter your password" style="{{ $errors->first('password') ? 'border-color: red;' : '' }}"></td>
                    <td style="color:red;">{{ $errors->first('password') }}</td>
                </tr>
                <tr>
                    <td colspan="2"><button class="btn-login">Login</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>

