<link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Outlined" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/Admin/Admin-Nav.css') }}">
<div class="Nav-Container">
    <div class="Left-Nav">
        <ul class="nav-list">
            <li class="nav-item"><img src="{{ asset('images/Logo.svg') }}" alt="Website Logo"></li>
        </ul>
    </div>
    <div class="Center-Nav">
        <ul>
            <li class="nav-item"><a href=" {{ route('product') }} ">Product List</a></li>
            <li class="nav-item"><a href=" {{ route('adminlist') }} ">Admin List</a></li>
            <li class="nav-item"><a href=" {{ route('userlist') }} ">User List</a></li>
            <li class="nav-item"><a href=" {{ route('adminsetting') }} ">Setting</a></li>
        </ul>
    </div>
    <div class="Right-Nav">
        <ul class="nav-list">
            <li><a href=" {{ route('logout') }} "><button class="Login-Button">Logout</button></a></li>
        </ul>
    </div>
</div>

