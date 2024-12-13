<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coupon</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/coupon.css') }}">
</head>
<body>

<h1>Coupon</h1>

<a href=" {{ route('addcoupon') }} "><button type="submit" class="add-coupon">Add Coupon</button></a>

<table>
    <tr>
        <th>Name</th>
        <th>Discount Percentage</th>
        <th>Min Price</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Action</th>
    </tr>
    @foreach($coupons as $coupon)
        <tr>
            <td>{{ $coupon->coupon_name }}</td>
            <td>{{ $coupon->coupon_discount }}%</td>
            <td>{{ $coupon->min_price }}</td>
            <td>{{ $coupon->start_date }}</td>
            <td>{{ $coupon->end_date }}</td>
            <td>
                <form action="" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button" style="border-radius: 16px; width: 80%; font-size: 16px;">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>
