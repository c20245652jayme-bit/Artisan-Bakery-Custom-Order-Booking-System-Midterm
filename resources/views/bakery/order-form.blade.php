<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arabelle's Bakery</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#f5ebdd] text-[#493323]">

    <!-- HEADER -->
    <header class="bg-[#5c4033] text-[#f5ebdd] shadow-md">
        <div class="max-w-6xl mx-auto px-6 py-5 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">
                    Arabelle's Bakery
                </h1>
                <p class="text-[#d7bfa5] text-sm mt-1">
                    Sweet Moments, Beautiful Cakes!
                </p>
            </div>

            <nav aria-label="Main navigation" class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-2 text-sm font-semibold text-[#f5ebdd] transition hover:bg-[#795548] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#f5ebdd]">
                    Dashboard
                </a>
                <span class="hidden bg-[#795548] px-4 py-2 rounded-lg text-sm md:block">
                    Custom Cake Booking
                </span>
            </nav>
        </div>
    </header>

    <!-- HERO -->
    <section class="bg-[#e8d5bd] py-10">
        <div class="max-w-6xl mx-auto px-6">
            <p class="text-[#795548] font-semibold">
                WELCOME TO OUR BAKERY
            </p>

            <h2 class="text-4xl font-bold mt-2 text-[#493323]">
                Create Your Dream Cake!
            </h2>

            <p class="mt-3 text-[#795548]">
                Customize your cake and make every celebration sweeter.
            </p>
        </div>
    </section>

    <!-- MAIN -->
    <main class="max-w-6xl mx-auto p-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">

            <!-- ORDER FORM -->
            <section class="md:col-span-2 bg-[#fffaf3] rounded-2xl shadow-md p-7 border border-[#d7bfa5]">

                <form action="{{ route('bakery.order.store') }}" method="POST">

                    @csrf

                    <!-- SUCCESS MESSAGE -->
                    @if(session('success'))
                        <div class="bg-[#e8d5bd] text-[#493323] p-4 rounded-lg mb-5">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- ERROR MESSAGES -->
                    @if($errors->any())
                        <div class="bg-[#e8d5bd] text-[#5c4033] p-4 rounded-lg mb-5">
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
                        <h3 class="text-2xl font-bold text-[#5c4033]">
                            Customer Information
                        </h3>

                        <p class="text-[#795548] text-sm mt-1">
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
                                class="w-full border border-[#d7bfa5] rounded-lg p-3 outline-none focus:border-[#795548]">
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
                                class="w-full border border-[#d7bfa5] rounded-lg p-3 outline-none focus:border-[#795548]">
                        </div>

                    </div>

                    <hr class="my-7 border-[#d7bfa5]">

                    <!-- CAKE DETAILS -->
                    <h3 class="text-2xl font-bold text-[#5c4033] mb-2">
                        Cake Details
                    </h3>

                    <p class="text-[#795548] text-sm mb-5">
                        Choose your favorite cake and customize it.
                    </p>

                    <div class="mb-5">
                        <label class="block font-semibold mb-2">
                            Select Cake Product
                        </label>

                        <select name="cake_product_id"
                            id="cake"
                            required
                            class="w-full border border-[#d7bfa5] rounded-lg p-3 outline-none focus:border-[#795548]">

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
                            class="w-full border border-[#d7bfa5] rounded-lg p-3 outline-none focus:border-[#795548]">
                    </div>

                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <label class="block font-semibold mb-2">
                                Decorations
                            </label>

                            <select name="add_on_decorations"
                                class="w-full border border-[#d7bfa5] rounded-lg p-3 outline-none focus:border-[#795548]">

                                <option value="">No decorations</option>

                                <option value="Flowers"
                                    {{ old('add_on_decorations') == 'Flowers' ? 'selected' : '' }}>
                                    Flowers
                                </option>

                                <option value="Chocolate Drip"
                                    {{ old('add_on_decorations') == 'Chocolate Drip' ? 'selected' : '' }}>
                                    Chocolate Drip
                                </option>

                                <option value="Fondant Design"
                                    {{ old('add_on_decorations') == 'Fondant Design' ? 'selected' : '' }}>
                                    Fondant Design
                                </option>

                                <option value="Birthday Topper"
                                    {{ old('add_on_decorations') == 'Birthday Topper' ? 'selected' : '' }}>
                                    Birthday Topper
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
                                class="w-full border border-[#d7bfa5] rounded-lg p-3 outline-none focus:border-[#795548]">
                        </div>

                    </div>

                    <div class="mt-5">
                        <label class="block font-semibold mb-2">
                            Pickup Date and Time
                        </label>

                        <input type="datetime-local"
                            name="pickup_datetime"
                            value="{{ old('pickup_datetime') }}"
                            required
                            class="w-full border border-[#d7bfa5] rounded-lg p-3 outline-none focus:border-[#795548]">
                    </div>

                    <hr class="my-7 border-[#d7bfa5]">

                    <!-- PAYMENT -->
                    <h3 class="text-2xl font-bold text-[#5c4033] mb-5">
                        Payment Information
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
                            class="w-full border border-[#d7bfa5] rounded-lg p-3 outline-none focus:border-[#795548]">
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <button type="submit"
                        class="w-full mt-7 bg-[#5c4033] hover:bg-[#795548] text-[#fffaf3] font-bold p-4 rounded-lg transition">

                        Place Custom Order

                    </button>

                </form>

            </section>

            <!-- ORDER SUMMARY -->
            <aside class="bg-[#e8d5bd] rounded-2xl shadow-md p-6 h-fit border border-[#d7bfa5]">

                <div class="text-center mb-6">

                    <h3 class="text-2xl font-bold text-[#5c4033]">
                        Order Summary
                    </h3>

                    <p class="text-sm text-[#795548] mt-1">
                        Your sweet order details
                    </p>

                </div>

                <div class="bg-[#fffaf3] rounded-xl p-5 space-y-5">

                    <div class="flex justify-between">
                        <span>Base Price</span>
                        <strong id="basePrice">₱0.00</strong>
                    </div>

                    <div class="flex justify-between">
                        <span>Add-on Price</span>
                        <strong id="addonPrice">₱0.00</strong>
                    </div>

                    <hr class="border-[#d7bfa5]">

                    <div class="flex justify-between text-lg font-bold text-[#5c4033]">
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

                    <hr class="border-[#d7bfa5]">

                    <div class="bg-[#e8d5bd] p-4 rounded-lg">
                        <p class="text-sm text-[#5c4033] font-semibold">
                            Remaining Balance
                        </p>

                        <h2 class="text-3xl font-bold text-[#493323] mt-1"
                            id="balanceDue">
                            ₱0.00
                        </h2>
                    </div>

                    <div id="depositMessage"
                        class="bg-[#e8d5bd] text-[#493323] text-sm p-3 rounded-lg">

                        Select a cake to calculate your order.

                    </div>

                </div>

                <p class="text-center text-[#5c4033] text-sm mt-5">
                    Thank you for choosing our bakery!
                </p>

            </aside>

        </div>

    </main>

    <!-- FOOTER -->
    <footer class="bg-[#5c4033] text-[#f5ebdd] text-center p-7 mt-12">

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
                    'bg-[#e8d5bd] text-[#493323] text-sm p-3 rounded-lg';

            } else if (payment > total) {

                message.textContent =
                    'Deposit cannot exceed total price.';

                message.className =
                    'bg-[#d7bfa5] text-[#493323] text-sm p-3 rounded-lg';

            } else if (payment < minimum) {

                message.textContent =
                    'Minimum 50% deposit required: ₱' +
                    minimum.toFixed(2);

                message.className =
                    'bg-[#d7bfa5] text-[#493323] text-sm p-3 rounded-lg';

            } else {

                message.textContent =
                    'Deposit requirement satisfied!';

                message.className =
                    'bg-[#d7bfa5] text-[#493323] text-sm p-3 rounded-lg';

            }
        }

        cake.addEventListener('change', calculateTotal);
        addon.addEventListener('input', calculateTotal);
        deposit.addEventListener('input', calculateTotal);

        calculateTotal();

    </script>

</body>
</html>