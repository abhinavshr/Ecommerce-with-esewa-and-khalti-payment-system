<link rel="stylesheet" href="{{ asset('css/Nav/footer.css') }}">
<footer class="footer">
    <div class="footer-content">
        <!-- Left side: Logo and Description -->
        <div class="footer-left">
            <img src=" {{ asset('images/whitelogo.svg') }} " alt="Organic Store Logo" class="footer-logo">
            <p class="footer-description">
                Choosing a name for an organic store is key to creating a brand that connects with customers seeking natural and sustainable products...
            </p>
        </div>

        <!-- Center: Quick Links -->
        <div class="footer-center">
            <h3>Quick Links</h3>
            <ul>
                <li><a href=" {{ route('user.aboutus') }} ">About</a></li>
                <li><a href=" {{  route('user.cart') }} ">Cart</a></li>
                <li><a href=" {{ route('user.payment') }} ">Checkout</a></li>
                <li><a href=" {{ route('user.contactus') }} ">Contact</a></li>
                <li><a href=" {{ route('user.home') }} ">Home</a></li>
                <li><a href=" {{ route('user.profile') }} ">My Account</a></li>
                <li><a href=" {{ route('user.everythingdisplay') }} ">Shop</a></li>
            </ul>
        </div>

        <!-- Right side: Site Links -->
        <div class="footer-right">
            <h3>Site Links</h3>
            <ul>
                <li><a href=" {{  route('user.privacypolicy') }} ">Privacy Policy</a></li>
                <li><a href=" {{  route('user.terms') }} ">Terms & Conditions</a></li>
            </ul>
            <div class="footer-social">
                <a href="https://www.facebook.com/"><img src=" {{ asset('images/facebook.png') }} " alt="Facebook"></a>
                <a href="https://x.com/"><img src=" {{ asset('images/twitter.webp') }} " alt="Twitter"></a>
                <a href="https://www.instagram.com/"><img src=" {{ asset('images/instagram.jpg') }} " alt="Instagram"></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2024 | Ecommerce</p>
    </div>
</footer>
