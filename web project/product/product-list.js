document.addEventListener("DOMContentLoaded", function () {
    const productListContainer = document.getElementById("productList");
    const productsPerPage = 6; // Number of products to display per page
    const products = []; // Empty array to store fetched data

    // Function to update product list on page load
    function updateProductList() {
        // Fetch data from PHP script
        fetch('getData.php')
            .then(response => response.json())
            .then(data => {
                // Store fetched data in the 'products' array
                products.push(...data);

                // Call function to update product list display
                updateProductListDisplay();
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    // Function to update product list display
    function updateProductListDisplay() {
        // Clear existing product listings
        productListContainer.innerHTML = "";

        // Calculate the number of pages
        const totalPages = Math.ceil(products.length / productsPerPage);

        // Loop through products and create product listings based on the current page
        for (let i = 0; i < totalPages; i++) {
            const start = i * productsPerPage;
            const end = start + productsPerPage;
            const currentPageProducts = products.slice(start, end);

            // Call function to create product listings based on the current page's data
            createProductListings(currentPageProducts);
        }
    }

    // Function to create product listings
    function createProductListings(productsToDisplay) {
        // Loop through products and create product listings
        productsToDisplay.forEach((product, index) => {
            const productListing = document.createElement("div");
            productListing.classList.add("product-listing");

            // Use the Blob directly as the source of the image
            const imageUrl = product.productImage instanceof Blob
                ? URL.createObjectURL(product.productImage)
                : 'fallback-image.jpg'; // Provide a fallback if needed

            productListing.innerHTML = `
                <!-- Display product details based on the fetched data -->
                <h2>${product.productName}</h2>
                <p><strong>Full Name:</strong> ${product.fullName}</p>
                <p><strong>Quantity Available:</strong> ${product.quantityAvailable} liters</p>
                <p><strong>Fat Content:</strong> ${product.fatContent}%</p>
                <p><strong>Packaging Type:</strong> ${product.packagingType}</p>
                <p><strong>Price per Liter:</strong> $${product.pricePerLiter}</p>
                <p><strong>Location:</strong> ${product.location}</p>
                <p><strong>Availability Status:</strong> ${product.availabilityStatus}</p>
                <img src="${imageUrl}" alt="${product.productName} Image" class="product-image">
                <button onclick="alert('Contacting seller...')">Contact Seller</button>
            `;

            productListContainer.appendChild(productListing);
        });
    }

    // Initial update to show the first page of products on page load
    updateProductList();



});
