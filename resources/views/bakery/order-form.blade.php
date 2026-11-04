
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arabelle's Bakery</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#fff3f5] text-[#59364b]">

    <!-- HEADER -->
    <header class="bg-gradient-to-r from-pink-500 via-rose-400 to-orange-300 text-white shadow-lg">
        <div class="max-w-6xl mx-auto px-6 py-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-extrabold">
                    🍰 Arabelle's Bakery
                </h1>
                <p class="text-pink-50 text-sm mt-1">
                    Sweet Moments, Beautiful Cakes!
                </p>
            </div>

            <span class="hidden md:block bg-white/20 px-4 py-2 rounded-full text-sm">
                Custom Cake Booking
            </span>
        </div>
    </header>

    <!-- HERO -->
    <section class="bg-gradient-to-r from-yellow-100 via-pink-100 to-purple-100 py-10">
        <div class="max-w-6xl mx-auto px-6">
            <p class="text-pink-500 font-bold">WELCOME TO OUR BAKERY ✨</p>
            <h2 class="text-4xl font-extrabold mt-2">
                Create Your Dream Cake!
            </h2>
            <p class="mt-3 text-gray-600">
                Customize your cake and make every celebration sweeter.
            </p>
        </div>
    </section>

    <!-- MAIN -->
    <main class="max-w-6xl mx-auto p-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">

            <!-- ORDER FORM -->
            <section class="md:col-span-2 bg-white rounded-3xl shadow-xl p-7 border border-pink-100">

                <!-- CONNECTED TO LARAVEL -->
                <form action="{{ route('bakery.order.store') }}" method="POST">

                    @csrf

                    <!-- SUCCESS MESSAGE -->
                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-5">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- ERROR MESSAGES -->
                    @if($errors->any())
                        <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-5">
                            <strong>Please fix the following errors:</strong>

                            <ul class="list-disc ml-5 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- CUSTOMER INFORMATION -->
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-pink-600">
                            👤 Customer Information
                        </h3>
                        <p class="text-gray-400 text-sm mt-1">
                            Please enter your personal information.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <label class="block font-semibold mb-2">
                                Customer Name
                            </label>

                            <input type="text"
                                name="customer_name"
                                value="{{ old('customer_name') }}"
                                placeholder="Enter your name"
                                required
                                class="w-full border-2 border-pink-100 rounded-xl p-3 outline-none focus:border-pink-400">
                        </div>

                        <div>
                            <label class="block font-semibold mb-2">
                                Contact Number
                            </label>

                            <input type="text"
                                name="contact_phone"
                                value="{{ old('contact_phone') }}"
                                placeholder="09XXXXXXXXX"
                                required
                                class="w-full border-2 border-pink-100 rounded-xl p-3 outline-none focus:border-pink-400">
                        </div>

                    </div>

                    <hr class="my-7 border-pink-100">

                    <!-- CAKE DETAILS -->
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">
                        🎂 Cake Details
                    </h3>

                    <p class="text-gray-400 text-sm mb-5">
                        Choose your favorite cake and customize it.
                    </p>

                    <div class="mb-5">
                        <label class="block font-semibold mb-2">
                            Select Cake Product
                        </label>

                        <select name="cake_product_id"
                            id="cake"
                            required
                            class="w-full border-2 border-purple-100 rounded-xl p-3 outline-none focus:border-purple-400">

                            <option value="">Choose a cake</option>

                            @foreach($cakes as $cake)
                                <option
                                    value="{{ $cake->cake_product_id }}"
                                    data-price="{{ $cake->base_price }}"
                                    {{ old('cake_product_id') == $cake->cake_product_id ? 'selected' : '' }}>

                                    {{ $cake->cake_flavor }}
                                    - {{ $cake->cake_size }}
                                    (₱{{ number_format($cake->base_price, 2) }})

                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="block font-semibold mb-2">
                            Custom Inscription
                        </label>

                        <input type="text"
                            name="custom_inscription"
                            value="{{ old('custom_inscription') }}"
                            maxlength="100"
                            placeholder="Example: Happy Birthday!"
                            class="w-full border-2 border-purple-100 rounded-xl p-3 outline-none focus:border-purple-400">
                    </div>

                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <label class="block font-semibold mb-2">
                                Decorations
                            </label>

                            <select name="add_on_decorations"
                                class="w-full border-2 border-yellow-200 rounded-xl p-3 outline-none focus:border-yellow-400">

                                <option value="">No decorations</option>

                                <option value="Flowers"
                                    {{ old('add_on_decorations') == 'Flowers' ? 'selected' : '' }}>
                                    🌸 Flowers
                                </option>

                                <option value="Chocolate Drip"
                                    {{ old('add_on_decorations') == 'Chocolate Drip' ? 'selected' : '' }}>
                                    🍫 Chocolate Drip
                                </option>

                                <option value="Fondant Design"
                                    {{ old('add_on_decorations') == 'Fondant Design' ? 'selected' : '' }}>
                                    🎀 Fondant Design
                                </option>

                                <option value="Birthday Topper"
                                    {{ old('add_on_decorations') == 'Birthday Topper' ? 'selected' : '' }}>
                                    🎉 Birthday Topper
                                </option>

                            </select>
                        </div>

                        <div>
                            <label class="block font-semibold mb-2">
                                Add-on Price (₱)
                            </label>

                            <input type="number"
                                name="add_on_price"
                                id="addon"
                                value="{{ old('add_on_price', 0) }}"
                                min="0"
                                step="0.01"
                                class="w-full border-2 border-yellow-200 rounded-xl p-3 outline-none focus:border-yellow-400">
                        </div>

                    </div>

                    <div class="mt-5">
                        <label class="block font-semibold mb-2">
                            📅 Pickup Date and Time
                        </label>

                        <input type="datetime-local"
                            name="pickup_datetime"
                            value="{{ old('pickup_datetime') }}"
                            required
                            class="w-full border-2 border-green-100 rounded-xl p-3 outline-none focus:border-green-400">
                    </div>

                    <hr class="my-7 border-pink-100">

                    <!-- PAYMENT -->
                    <h3 class="text-2xl font-bold text-green-600 mb-5">
                        💰 Payment Information
                    </h3>

                    <div>
                        <label class="block font-semibold mb-2">
                            Total Deposit (₱)
                        </label>

                        <input type="number"
                            name="total_deposit"
                            id="deposit"
                            value="{{ old('total_deposit', 0) }}"
                            min="0"
                            step="0.01"
                            required
                            class="w-full border-2 border-green-100 rounded-xl p-3 outline-none focus:border-green-400">
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <button type="submit"
                        class="w-full mt-7 bg-gradient-to-r from-pink-500 to-orange-400 hover:from-pink-600 hover:to-orange-500 text-white font-bold p-4 rounded-xl shadow-lg transition hover:scale-[1.01]">

                        🍰 Place Custom Order

                    </button>

                </form>

            </section>

            <!-- ORDER SUMMARY -->
            <aside class="bg-gradient-to-br from-purple-100 via-pink-100 to-yellow-100 rounded-3xl shadow-xl p-6 h-fit border border-white">

                <div class="text-center mb-6">
                    <div class="text-5xl mb-3">🧁</div>

                    <h3 class="text-2xl font-extrabold text-purple-700">
                        Order Summary
                    </h3>

                    <p class="text-sm text-purple-500 mt-1">
                        Your sweet order details
                    </p>
                </div>

                <div class="bg-white/80 rounded-2xl p-5 space-y-5">

                    <div class="flex justify-between">
                        <span>Base Price</span>
                        <strong id="basePrice">₱0.00</strong>
                    </div>

                    <div class="flex justify-between">
                        <span>Add-on Price</span>
                        <strong id="addonPrice">₱0.00</strong>
                    </div>

                    <hr class="border-purple-200">

                    <div class="flex justify-between text-lg font-bold text-purple-700">
                        <span>Total Price</span>
                        <span id="totalPrice">₱0.00</span>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span>Minimum 50% Deposit</span>
                        <strong id="minimumDeposit">₱0.00</strong>
                    </div>

                    <div class="flex justify-between">
                        <span>Your Deposit</span>
                        <strong id="depositAmount">₱0.00</strong>
                    </div>

                    <hr class="border-purple-200">

                    <div class="bg-pink-100 p-4 rounded-xl">
                        <p class="text-sm text-pink-600 font-semibold">
                            Remaining Balance
                        </p>

                        <h2 class="text-3xl font-extrabold text-pink-700 mt-1"
                            id="balanceDue">
                            ₱0.00
                        </h2>
                    </div>

                    <div id="depositMessage"
                        class="bg-yellow-100 text-yellow-800 text-sm p-3 rounded-xl">

                        Select a cake to calculate your order.

                    </div>

                </div>

                <p class="text-center text-purple-600 text-sm mt-5 font-medium">
                    💕 Thank you for choosing our bakery!
                </p>

            </aside>

        </div>

    </main>

    <!-- FOOTER -->
    <footer class="bg-gradient-to-r from-purple-700 via-pink-600 to-rose-500 text-white text-center p-7 mt-12">

        <h3 class="text-xl font-bold">🍰 Arabelle's Bakery</h3>

        <p class="text-sm mt-2">
            Freshly Baked With Love!
        </p>

        <p class="text-xs mt-3 text-pink-100">
            © 2026 Arabelle's Bakery. All Rights Reserved.
        </p>

    </footer>

    <!-- CALCULATION -->
    <script>

        const cake = document.getElementById('cake');
        const addon = document.getElementById('addon');
        const deposit = document.getElementById('deposit');

        function calculateTotal() {

            const selectedCake = cake.options[cake.selectedIndex];

            const base = Number(selectedCake.dataset.price || 0);
            const extra = Number(addon.value || 0);
            const payment = Number(deposit.value || 0);

            const total = base + extra;
            const minimum = total * 0.50;

            const balance = total - payment;

            document.getElementById('basePrice').textContent =
                '₱' + base.toFixed(2);

            document.getElementById('addonPrice').textContent =
                '₱' + extra.toFixed(2);

            document.getElementById('totalPrice').textContent =
                '₱' + total.toFixed(2);

            document.getElementById('minimumDeposit').textContent =
                '₱' + minimum.toFixed(2);

            document.getElementById('depositAmount').textContent =
                '₱' + payment.toFixed(2);

            document.getElementById('balanceDue').textContent =
                '₱' + balance.toFixed(2);

            const message = document.getElementById('depositMessage');

            if (total === 0) {

                message.textContent = 'Please select a cake.';

                message.className =
                    'bg-yellow-100 text-yellow-800 text-sm p-3 rounded-xl';

            } else if (payment > total) {

                message.textContent =
                    '⚠️ Deposit cannot exceed total price.';

                message.className =
                    'bg-red-100 text-red-700 text-sm p-3 rounded-xl';

            } else if (payment < minimum) {

                message.textContent =
                    '⚠️ Minimum 50% deposit required: ₱' +
                    minimum.toFixed(2);

                message.className =
                    'bg-red-100 text-red-700 text-sm p-3 rounded-xl';

            } else {

                message.textContent =
                    '✓ Deposit requirement satisfied!';

                message.className =
                    'bg-green-100 text-green-700 text-sm p-3 rounded-xl';

            }
        }

        cake.addEventListener('change', calculateTotal);
        addon.addEventListener('input', calculateTotal);
        deposit.addEventListener('input', calculateTotal);

        calculateTotal();

    </script>

</body>
</html>
