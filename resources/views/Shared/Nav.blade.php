<link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Outlined" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/Nav/Nav.css') }}">
<div class="Nav-Container">
    <div class="Left-Nav">
        <ul class="nav-list">
            <a href=" {{ route('user.home') }} "><li class="nav-item"><img src="{{ asset('images/Logo.svg') }}" alt="Website Logo"></li></a>
            <li class="nav-item"><a href=" {{ route('user.everythingdisplay') }} ">Everything</a></li>
            <li class="nav-item"><a href=" {{ route('user.fruit') }} ">Friuts</a></li>
            <li class="nav-item"><a href=" {{ route('user.drink') }} ">Juice</a></li>
        </ul>
    </div>
    <div class="Right-Nav">
        <ul class="nav-list">
            <li><a href=" {{ route('user.aboutus') }} ">About</a></li>
            <li><a href=" {{ route('user.contactus') }} ">Contact</a></li>
            <li>
                <a href=" {{ route('user.cart') }} ">
                    @if (Auth::check())
                        <?php
                            $totalPrice = 0;
                            $userCartItems = \App\Models\CartItem::where('user_id', auth()->user()->id)->get();
                            foreach ($userCartItems as $item) {
                                $totalPrice += $item->product->product_price * $item->quantity;
                            }
                        ?>
                        Rs {{ $totalPrice }}  <span class="material-symbols-outlined">shopping_basket
                        </span>
                    @endif
                </a>
            </li>
            @if (Auth::check())
                <li class="dropdown-container">
                    <div class="dropdown" onclick="toggleDropdown(event)">
                        <img src="{{ asset('storage/images/users/' . auth()->user()->profile_image ) }}"
                            alt="{{ auth()->user()->username }}" class="profile-picture"
                            onerror="this.onerror=null;this.src='{{ asset('images/Profile-Picture.png') }}';">
                        <div id="dropdown-content" class="dropdown-content">
                            <a href="  {{ route('user.profile') }}">Profile</a>
                            <a href="{{ route('user.logout') }}">Logout</a>
                        </div>
                    </div>
                </li>
            @else
                <li>
                    <a href="{{ route('user.userlogin') }}">
                        <button class="Login-Button">Login</button>
                    </a>
                </li>
            @endif
            <script>
                function toggleDropdown(event) {
                    event.stopPropagation();
                    document.getElementById("dropdown-content").classList.toggle("show");
                }
                window.onclick = function() {
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    for (var i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
            </script>
        </ul>
    </div>
</div>
