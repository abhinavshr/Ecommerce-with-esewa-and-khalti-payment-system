<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Organic Store</title>
    <link rel="stylesheet" href="{{ asset('css/user/aboutus.css') }}">
</head>

<body>
    <div style="height: auto">
        <div style="background-color: #ffffff">
            @include('Shared.Nav')
        </div>
        <header>
            <h1>Organic Store</h1>
            <p>Bringing You Fresh and Healthy Organic Products</p>
        </header>

        <div class="container">
            <section class="about-us">
                <div class="about-text">
                    <h2>About Us</h2>
                    <p>At Organic Store, we are committed to providing high-quality, fresh, and sustainable organic
                        products. Our mission is to promote healthy living by offering a wide range of organic
                        groceries, skincare products, and more. Every product we sell is carefully sourced from trusted
                        organic farms and suppliers who share our values of sustainability and eco-conscious practices.
                    </p>
                    <p>We believe in making organic living accessible to everyone. Whether you're looking for fresh
                        produce, pantry staples, or eco-friendly products, we have something for you. Join us in our
                        mission to create a healthier planet, one organic product at a time!</p>
                </div>

                <div class="about-image">
                    <img src="{{ asset('images/Logo.svg') }}" alt="Logo">
                </div>
            </section>
        </div>
    </div>
    <div class="footer">
        @include('Shared.Footer')
    </div>
</body>
</html>

