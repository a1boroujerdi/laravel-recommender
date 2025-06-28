<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product Recommendation System</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/heroicons@2.0.18/dist/24/outline.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-blue-50 py-10">
    <div class="mx-auto max-w-4xl px-4">
        <div class="overflow-hidden rounded-3xl bg-white shadow-2xl ring-1 ring-gray-200/50 backdrop-blur-sm">
            <!-- Header -->
            <header class="bg-gradient-to-r from-indigo-600 via-blue-600 to-indigo-700 px-8 py-6">
                <h1 class="text-3xl font-bold text-white tracking-tight flex items-center gap-3">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5">
                        <use href="#heroicon-o-sparkles" />
                    </svg>
                    Product Recommendation System
                </h1>
            </header>

            <!-- Content -->
            <main class="p-8 space-y-8">
                <!-- Tabs -->
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button id="recommend-tab" class="border-indigo-500 text-indigo-600 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium transition-all duration-200">
                            Get Recommendations
                        </button>
                        <button id="add-product-tab" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium transition-all duration-200">
                            Add New Product
                        </button>
                    </nav>
                </div>

                <!-- Recommendation Form -->
                <div id="recommend-section" class="space-y-4 animate-fade-in">
                    <form id="recommendation-form" class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700" for="product">
                            Enter Product Name
                        </label>

                        <div class="flex flex-col gap-3 sm:flex-row">
                            <input
                                id="product"
                                name="product"
                                type="text"
                                placeholder="e.g. iPhone, Laptop, Headphones..."
                                required
                                class="flex-1 rounded-xl border border-gray-300 px-4 py-3 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200"
                            />

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600 px-6 py-3 font-medium text-white transition-all duration-200 hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 shadow-lg hover:shadow-xl"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <use href="#heroicon-o-sparkles" />
                                </svg>
                                Get Recommendations
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Add Product Form -->
                <div id="add-product-section" class="hidden space-y-4 animate-fade-in">
                    <form id="add-product-form" class="space-y-4">
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="order-id">
                                    Order ID
                                </label>
                                <input
                                    id="order-id"
                                    name="order_id"
                                    type="text"
                                    required
                                    class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200"
                                />
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-medium text-gray-900">Products in Cart</h3>
                                <button
                                    type="button"
                                    id="add-product-row"
                                    class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600 px-4 py-2 text-sm font-medium text-white transition-all duration-200 hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 shadow-lg hover:shadow-xl"
                                >
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <use href="#heroicon-o-plus" />
                                    </svg>
                                    Add Product
                                </button>
                            </div>

                            <div id="product-rows" class="space-y-3">
                                <!-- Product rows will be added here -->
                            </div>
                        </div>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-green-600 to-emerald-600 px-6 py-3 font-medium text-white transition-all duration-200 hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-400 shadow-lg hover:shadow-xl"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5">
                                <use href="#heroicon-o-check" />
                            </svg>
                            Submit Order
                        </button>
                    </form>
                </div>

                <!-- Loading -->
                <div id="loading" class="hidden text-center">
                    <div class="inline-flex items-center justify-center">
                        <div class="h-12 w-12 animate-spin rounded-full border-4 border-indigo-500 border-t-transparent"></div>
                        <span class="ml-3 text-lg font-medium text-gray-700">Processing request&hellip;</span>
                    </div>
                </div>

                <!-- Error -->
                <div id="error-message" class="hidden rounded-xl border-l-4 border-red-500 bg-red-50 px-6 py-4 text-red-700 shadow-sm"></div>

                <!-- Success -->
                <div id="success-message" class="hidden rounded-xl border-l-4 border-green-500 bg-green-50 px-6 py-4 text-green-700 shadow-sm"></div>

                <!-- Results -->
                <section id="results" class="hidden space-y-4 animate-fade-in">
                    <div class="rounded-xl bg-indigo-50 p-6">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Found Product:
                            <span id="matched-product" class="font-bold text-indigo-600"></span>
                        </h2>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-700">Recommended Products</h3>

                    <div id="recommendations" class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3"></div>
                </section>
            </main>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Heroicons sprite -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
        <symbol id="heroicon-o-sparkles" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75V4m0 0L9.75 6.25M12 4l2.25 2.25M12 17.25v2.75m0 0L9.75 17.75M12 20l2.25-2.25M6.75 12H4m0 0l2.25-2.25M4 12l2.25 2.25M20 12h-2.75m0 0l2.25-2.25M17.25 12l2.25 2.25"/>
        </symbol>
        <symbol id="heroicon-o-plus" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </symbol>
        <symbol id="heroicon-o-check" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
        </symbol>
        <symbol id="heroicon-o-trash" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
        </symbol>
    </svg>

    <!-- Script -->
    <script>
        $(function () {
            // Setup CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Tab switching
            $('#recommend-tab').on('click', function() {
                $(this).addClass('border-indigo-500 text-indigo-600').removeClass('border-transparent text-gray-500');
                $('#add-product-tab').addClass('border-transparent text-gray-500').removeClass('border-indigo-500 text-indigo-600');
                $('#recommend-section').removeClass('hidden');
                $('#add-product-section').addClass('hidden');
            });

            $('#add-product-tab').on('click', function() {
                $(this).addClass('border-indigo-500 text-indigo-600').removeClass('border-transparent text-gray-500');
                $('#recommend-tab').addClass('border-transparent text-gray-500').removeClass('border-indigo-500 text-indigo-600');
                $('#add-product-section').removeClass('hidden');
                $('#recommend-section').addClass('hidden');
            });

            // Add product row template
            function createProductRow() {
                const rowId = 'product-' + Date.now();
                return `
                    <div id="${rowId}" class="flex items-center gap-3 animate-fade-in">
                        <div class="flex-1">
                            <input
                                type="text"
                                name="products[]"
                                placeholder="Enter product name"
                                required
                                class="block w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200"
                            />
                        </div>
                        <button
                            type="button"
                            class="text-red-600 hover:text-red-700 transition-colors duration-200"
                            onclick="removeProductRow('${rowId}')"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5">
                                <use href="#heroicon-o-trash" />
                            </svg>
                        </button>
                    </div>
                `;
            }

            // Add product row
            $('#add-product-row').on('click', function() {
                $('#product-rows').append(createProductRow());
            });

            // Remove product row
            window.removeProductRow = function(rowId) {
                $(`#${rowId}`).fadeOut(200, function() {
                    $(this).remove();
                });
            };

            // Add initial product row
            $('#product-rows').append(createProductRow());

            // Recommendation form submission
            $("#recommendation-form").on("submit", function (e) {
                e.preventDefault();
                $("#loading").removeClass("hidden");
                $("#error-message, #success-message, #results").addClass("hidden");

                const productName = $("#product").val().trim();

                $.getJSON("{{ route('recommendations.get') }}", { product: productName })
                    .done(function ({ error, matched_product, recommendations }) {
                        $("#loading").addClass("hidden");

                        if (error) {
                            $("#error-message").text(error).removeClass("hidden");
                            return;
                        }

                        $("#matched-product").text(matched_product);
                        $("#recommendations").empty();

                        if (recommendations.length) {
                            recommendations.forEach((item) => {
                                $("#recommendations").append(`
                                    <article class="flex h-full flex-col justify-center rounded-xl border border-gray-200 bg-white p-6 text-center shadow-sm transition-all duration-200 hover:shadow-lg card-hover">
                                        <h4 class="text-base font-medium text-gray-800">${item}</h4>
                                    </article>
                                `);
                            });
                        } else {
                            $("#recommendations").html(`
                                <p class="col-span-full text-gray-500">No recommendations found.</p>
                            `);
                        }

                        $("#results").removeClass("hidden");
                    })
                    .fail(function (xhr) {
                        $("#loading").addClass("hidden");
                        const msg = xhr.responseJSON?.error || "An error occurred while fetching recommendations.";
                        $("#error-message").text(msg).removeClass("hidden");
                    });
            });

            // Add product form submission
            $("#add-product-form").on("submit", function (e) {
                e.preventDefault();
                $("#loading").removeClass("hidden");
                $("#error-message, #success-message").addClass("hidden");

                const orderId = $("#order-id").val().trim();
                const products = [];
                
                // Collect all product names
                $('input[name="products[]"]').each(function() {
                    const productName = $(this).val().trim();
                    if (productName) {
                        products.push(productName);
                    }
                });

                if (products.length === 0) {
                    $("#error-message").text("Please add at least one product").removeClass("hidden");
                    $("#loading").addClass("hidden");
                    return;
                }

                if (!orderId) {
                    $("#error-message").text("Please enter an Order ID").removeClass("hidden");
                    $("#loading").addClass("hidden");
                    return;
                }

                $.ajax({
                    url: "{{ route('recommendations.add-product') }}",
                    method: "POST",
                    data: JSON.stringify({
                        order_id: orderId,
                        products: products
                    }),
                    contentType: 'application/json',
                    success: function(response) {
                        $("#loading").addClass("hidden");
                        $("#success-message").text(response.message).removeClass("hidden");
                        $("#add-product-form")[0].reset();
                        // Reset to single product row
                        $("#product-rows").empty().append(createProductRow());
                    },
                    error: function(xhr) {
                        $("#loading").addClass("hidden");
                        let errorMsg = "An error occurred while adding the products.";
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMsg = xhr.responseJSON.error;
                        }
                        $("#error-message").text(errorMsg).removeClass("hidden");
                    }
                });
            });
        });
    </script>
</body>
</html>
