<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Organic Store</title>
    <link rel="stylesheet" href="{{ asset('css/user/privacypolicy.css') }}">
</head>
<body>
    <div class="header" style="background-color: #ffffff">
        @include('shared.Nav')
    </div>
    <div class="container">
        <h1>Privacy Policy</h1>
        <p>Welcome to Organic Store. We value your trust and are committed to protecting your personal information. This Privacy Policy outlines how we collect, use, and safeguard your data.</p>

        <h2>Information We Collect</h2>
        <ul>
            <li><strong>Personal Information:</strong> Name, email address, phone number, shipping address.</li>
            <li><strong>Payment Information:</strong> Credit/debit card details, billing address.</li>
            <li><strong>Usage Data:</strong> Browser type, pages visited, time spent on the site.</li>
        </ul>

        <h2>How We Use Your Information</h2>
        <p>We use your information to:</p>
        <ul>
            <li>Process and deliver your orders.</li>
            <li>Improve our website and services.</li>
            <li>Send promotional emails (with your consent).</li>
        </ul>

        <h2>Sharing Your Information</h2>
        <p>We do not sell, trade, or rent your personal information. However, we may share your data with:</p>
        <ul>
            <li>Service providers for payment processing and order fulfillment.</li>
            <li>Law enforcement if required by law.</li>
        </ul>

        <h2>Data Security</h2>
        <p>We implement strict measures to safeguard your personal data. Our website uses SSL encryption to ensure secure transactions.</p>

        <h2>Your Rights</h2>
        <p>You have the right to:</p>
        <ul>
            <li>Access your personal data.</li>
            <li>Request corrections to your data.</li>
            <li>Request the deletion of your data.</li>
        </ul>

        <h2>Contact Us</h2>
        <p>If you have any questions or concerns about this Privacy Policy, please contact us at <a href="mailto:info@organicstore.com">info@organicstore.com</a>.</p>
    </div>
    <div class="footer">
        @include('Shared.Footer')
    </div>
</body>
</html>
