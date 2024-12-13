    const searchInput = document.getElementById('searchProduct');
    const rightContainer = document.getElementById('right');

    function displayProducts(filteredProducts) {
        rightContainer.innerHTML = "";

        filteredProducts.forEach(product => {
            const productElement = document.createElement('div');
            productElement.classList.add('product');
            productElement.innerHTML = `<h3>${product.product_name}</h3><p>${product.product_description}</p>`;
            rightContainer.appendChild(productElement);
        });

        if (filteredProducts.length === 0) {
            rightContainer.innerHTML = "<p>No products found</p>";
        }
    }

    searchInput.addEventListener('input', function () {
        const query = searchInput.value;

        fetch(`/search-products?query=${query}`)
            .then(response => response.json())
            .then(data => {
                const filteredProducts = data.products.filter(product => product.product_name.toLowerCase().includes(query.toLowerCase()));
                displayProducts(filteredProducts);
            })
            .catch(error => console.error('Error:', error));
    });

