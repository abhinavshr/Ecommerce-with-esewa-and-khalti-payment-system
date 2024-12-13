<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User List</title>
    <link rel="stylesheet" href="  {{ asset('css/Admin/User-List.css') }}">
</head>
<body>
    @include('Admin.Admin-Nav')
    <div class="container">
        <h1>User List</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Profile Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->address }}</td>
                        <td> <img src="{{ asset('storage/images/users/' . $user->profile_image ) }}"
                            alt="{{ $user->username }}" class="profile-picture"
                            onerror="this.onerror=null;this.src='{{ asset('images/Profile-Picture.png') }}';"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

