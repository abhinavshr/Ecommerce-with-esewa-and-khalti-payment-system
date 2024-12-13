<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href=" {{ asset('css/user/profile.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/user/profilesetting.css') }}">
</head>

<body>
    <div class="header" style="background-color: #ffffff">
        @include('Shared.Nav')
    </div>
    <div class="container">
        <div class="sidebar" id="sidebar">
            <h2>My account</h2>
            <ul>
                <li><a href="#" class="menu-item" data-section="dashboard">Dashboard</a></li>
                <li><a href="#" class="menu-item" data-section="orders">Orders</a></li>
                <li><a href="#" class="menu-item" data-section="account-details">Account details</a></li>
                <li><a href=" {{ route('user.logout') }} " class="menu-item" data-section="logout">Log out</a></li>
            </ul>
        </div>
        <div class="main-content" id="main-content">
            <h3>Hello <span class="username">{{ auth()->user()->username }}</span></h3>
            <p>From your account dashboard, you can view your recent orders edit your password and account details.</p>
        </div>
    </div>

    <script>
        // JavaScript to handle sidebar navigation
        const menuItems = document.querySelectorAll('.menu-item');
        const mainContent = document.getElementById('main-content');

        menuItems.forEach(item => {
            item.addEventListener('click', function(e) {
                // Remove active class from all menu items
                menuItems.forEach(i => i.classList.remove('active'));

                // Add active class to the clicked menu item
                this.classList.add('active');

                // Update the main content based on the section
                const section = this.getAttribute('data-section');
                updateContent(section);
            });
        });

        function updateContent(section) {
            if (section === 'dashboard') {
                mainContent.innerHTML =
                    `<h3>Hello <span class="username">{{ auth()->user()->username }}</span></h3>
            <p>From your account dashboard, you can view your recent orders edit your password and account details.</p>`;
            } else if (section === 'orders') {
                const orders = @json(\App\Models\Orders::where('user_id', auth()->user()->id)->get());
                let orderListHtml = `<div class="order-list-container">
                    <h3>Your Orders</h3>
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Date</th>
                                <th>Payment Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>`;

                orders.forEach(order => {
                    orderListHtml += `<tr>
                        <td>#${order.id}</td>
                        <td>${new Date(order.created_at).toLocaleDateString()}</td>
                        <td class="${order.payment_status}">${order.payment_status}</td>
                        <td>${order.total}</td>
                    </tr>`;
                });

                orderListHtml += `</tbody></table></div>`;
                mainContent.innerHTML = orderListHtml;
            } else if (section === 'account-details') {
                mainContent.innerHTML = `
                <form action="{{ route('user.userprofile.update', ['user' => auth()->user()]) }}" method="POST" class="update-form">
                    @csrf
                    @method('PUT')

                    <!-- Username -->
                    <div class="form-group">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" id="username" name="username" value="{{ old('username', auth()->user()->username) }}" required class="form-input">
                        @error('username')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="form-input">
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" id="password" name="password" class="form-input">
                        <small>Leave blank if you don't want to change the password.</small>
                        @if ($errors->has('password'))
                            <div class="error">{{ $errors->first('password') }}</div>
                        @else
                            <div class="error">Please enter your current password to update your profile.</div>
                        @endif
                    </div>

                    <!-- Phone Number -->
                    <div class="form-group">
                        <label for="phone_number" class="form-label">Phone Number:</label>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', auth()->user()->phone_number) }}" required class="form-input">
                        @error('phone_number')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="form-group">
                        <label for="address" class="form-label">Address:</label>
                        <input type="text" id="address" name="address" value="{{ old('address', auth()->user()->address) }}" required class="form-input">
                        @error('address')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn">Update</button>
                </form>
                `;
            }
        }
    </script>
    <div class="footer">
        @include('Shared.Footer')
    </div>
</body>

</html>

