<html>
<head>
    <title>Delivery Location</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/Location.css') }}">
</head>
<body>
    <div class="container">
        <h1>Delivery Location</h1>
        <form action="{{ route('addlocation.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}">
                @error('location')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}">
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save Location</button>
        </form>
    </div>
</body>
</html>

