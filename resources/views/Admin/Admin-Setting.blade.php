<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Setting</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/Admin-Setting.css') }}">
</head>
<body>
    @include('Admin.Admin-Nav')
    <div class="container">
        <h1>Admin Setting</h1>
        <form action="{{ route('adminsetting.update', auth()->user()->id) }}" method="POSt">
            @csrf
            @method('PUT')
            <table>
                <tr>
                    <td><label for="name">Full Name:</label></td>
                    <td><input type="text" name="name" id="name" value="{{ auth()->user()->name }}" placeholder="Enter your name">
                        @error('name')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" name="email" id="email" value="{{ auth()->user()->email }}" placeholder="Enter your email">
                        @error('email')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" name="password" id="password" placeholder="Enter your password">
                        @error('password')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="password_confirmation">Confirm Password:</label></td>
                    <td><input type="password" name="password_confirmation" id="password_confirmation" placeholder="Enter your password again">
                        @error('password_confirmation')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="btn-update">Update</button>
                    </td>
                </tr>
            </table><br>
        </form>
        <form action="{{ route('adminsetting.destroy', auth()->user()->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">Delete</button>
        </form>
    </div>
</body>
</html>
