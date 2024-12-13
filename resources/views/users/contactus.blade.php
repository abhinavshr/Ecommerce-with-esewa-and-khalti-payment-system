<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Organic Store</title>
    <link rel="stylesheet" href="{{ asset('css/user/contactus.css') }}">
</head>
<body>
    <div style="background-color: #ffffff">
        @include('Shared.Nav')
    </div>
    <header>
        <h1>Organic Store</h1>
        <p>Contact Us for Fresh and Healthy Organic Products</p>
    </header>

    <div class="container">
        <section class="contact-info">
            <div>
                <h2>Our Location</h2>
                <p>Sanapa Height, Lalitpur, Nepal</p>
                <p>Opening Hours: Mon - Fri, 9:00 AM - 6:00 PM</p>
            </div>

            <div>
                <h2>Get in Touch</h2>
                <p>If you have any questions or inquiries, feel free to reach out to us. We'd love to hear from you!</p>
            </div>
        </section>

        <section class="contact-form">
            <h2>Contact Form</h2>
            <form action=" {{ route('user.contactus.store') }} " method="POST">
                @csrf
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </section>
    </div>
    <div class="footer">
        @include('Shared.Footer')
    </div>
</body>
</html>
