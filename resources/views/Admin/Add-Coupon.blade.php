<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Coupon</title>

    <link rel="stylesheet" href="{{ asset('css/Admin/add-coupon.css') }}">
</head>
<body>
    <div class="container">
        <form action="{{ route('addcoupon.store') }}" method="post">
            @csrf
            <label for="coupon_name">Name:</label>
            <input type="text" name="coupon_name" id="coupon_name" value="{{ old('coupon_name') }}" required>
            <span style="color:red;">{{ $errors->first('coupon_name') }}</span><br><br>

            <label for="coupon_discount">Discount Percentage:</label>
            <input type="number" name="coupon_discount" id="coupon_discount" value="{{ old('coupon_discount') }}" required>
            <span style="color:red;">{{ $errors->first('coupon_discount') }}</span><br><br>

            <label for="min_price">Min Price:</label>
            <input type="number" name="min_price" id="min_price" value="{{ old('min_price') }}">
            <span style="color:red;">{{ $errors->first('min_price') }}</span><br><br>

            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
            <span style="color:red;">{{ $errors->first('start_date') }}</span><br><br>

            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" required>
            <span style="color:red;">{{ $errors->first('end_date') }}</span><br><br>

            <button type="submit" class="add-coupon">Add Coupon</button>
        </form>
    </div>
</body>
</html>
