<link rel="stylesheet" href="{{ asset('css/Nav/Side-Nav.css') }}">
<div class="container">
    <input type="search" name="searchProduct" id="searchProduct" class="searchProduct" placeholder="Search Product...">
    <h2>Filter By Price</h2>
    <?php
    $maxPrice = \App\Models\Product::max('product_price');
    ?>
    <input type="range" id="priceSlider" min="0" max="{{ $maxPrice }}" step="10"
        value="{{ $maxPrice }}" oninput="updatePrice(this.value)" class="slider" oninput="updatePrice(this.value)"
        class="slider" />
    <div class="price-range">
        <input type="text" id="minPrice" value="Rs 0" class="minPrice" readonly
            style="border: none; background: transparent; font-size: 14px;" />
        <input type="text" id="maxPrice" value="Rs {{ $maxPrice }}" class="maxPrice" readonly
            style="border: none; background: transparent; font-size: 14px; text-align: right;" />
    </div>
    <div class="links">
            <a href="#">Fruits ({{ \App\Models\Product::where('product_category', 'Fruit')->count() }})</a><br>
            <a href="#">Juice ({{ \App\Models\Product::where('product_category', 'Drink')->count() }})</a>
        </ul>
    </div>
    <script>
        function updatePrice(value) {
            document.getElementById('maxPrice').value = `Rs ${value}`;
        }
    </script>
</div>
