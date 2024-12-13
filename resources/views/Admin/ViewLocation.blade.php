<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Locations</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/ViewLocation.css') }}">
</head>
<body>
    <div class="container">
        <h1>Delivery Locations</h1>
        <div class="add-location">
            <a href=" {{ route('addlocation') }} ">
                <button class="add-location-button">Add Location</button>
            </a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Location</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($locations as $location)
                    <tr>
                        <td>{{ $location->id }}</td>
                        <td>{{ $location->location }}</td>
                        <td>{{ $location->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

