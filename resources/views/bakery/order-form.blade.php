<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#18181b">
    <meta name="description" content="Create a custom cake order with Arabelle's Bakery.">
    <title>Custom Cake Order | Arabelle's Bakery</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-zinc-50 text-zinc-950 antialiased">
    <header class="border-b border-zinc-200 bg-white">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6">
            <a href="{{ route('bakery.order.create') }}" class="flex items-center gap-3 rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                <span class="grid size-9 place-items-center rounded-md bg-zinc-950 text-xs font-bold text-white" aria-hidden="true">AB</span>
                <span class="text-sm font-semibold">Arabelle's Bakery</span>
            </a>
            <a href="{{ route('dashboard') }}" class="shadcn-button-outline h-9">Dashboard</a>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 sm:py-12">
        <div class="mb-8">
            <p class="text-sm font-medium text-zinc-500">Custom booking</p>
            <h1 class="mt-1 text-3xl font-semibold tracking-tight">Create your cake order</h1>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">
                <p class="font-medium">Please check the highlighted information.</p>
                <ul class="mt-1 list-inside list-disc">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_320px]">
            <form action="{{ route('bakery.order.store') }}" method="POST" class="shadcn-card divide-y divide-zinc-200">
                @csrf

                <section class="p-5 sm:p-6">
                    <h2 class="mb-5 text-base font-semibold">Customer details</h2>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="customer_name" class="mb-2 block text-sm font-medium">Full name</label>
                            <input id="customer_name" name="customer_name" type="text" value="{{ old('customer_name') }}" placeholder="Your name" autocomplete="name" required maxlength="100" class="form-control">
                            @error('customer_name') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="contact_phone" class="mb-2 block text-sm font-medium">Contact number</label>
                            <input id="contact_phone" name="contact_phone" type="tel" value="{{ old('contact_phone') }}" placeholder="09XX XXX XXXX" autocomplete="tel" required maxlength="20" class="form-control">
                            @error('contact_phone') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>

                <section class="p-5 sm:p-6">
                    <h2 class="mb-5 text-base font-semibold">Cake details</h2>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="cake" class="mb-2 block text-sm font-medium">Cake flavor and size</label>
                            <select id="cake" name="cake_product_id" required class="form-control">
                                <option value="">Choose a cake</option>
                                @foreach($cakes as $cake)
                                    <option value="{{ $cake->cake_product_id }}" data-price="{{ $cake->base_price }}" {{ old('cake_product_id') == $cake->cake_product_id ? 'selected' : '' }}>
                                        {{ $cake->cake_flavor }} · {{ $cake->cake_size }} — ₱{{ number_format($cake->base_price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('cake_product_id') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="custom_inscription" class="mb-2 block text-sm font-medium">Cake inscription <span class="font-normal text-zinc-500">(optional)</span></label>
                            <input id="custom_inscription" name="custom_inscription" type="text" value="{{ old('custom_inscription') }}" placeholder="Happy Birthday!" maxlength="255" class="form-control">
                        </div>
                        <div>
                            <label for="add_on_decorations" class="mb-2 block text-sm font-medium">Decorations <span class="font-normal text-zinc-500">(optional)</span></label>
                            <select id="add_on_decorations" name="add_on_decorations" class="form-control">
                                <option value="">None</option>
                                @foreach(['Flowers', 'Chocolate Drip', 'Fondant Design', 'Birthday Topper'] as $decoration)
                                    <option value="{{ $decoration }}" {{ old('add_on_decorations') === $decoration ? 'selected' : '' }}>{{ $decoration }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="addon" class="mb-2 block text-sm font-medium">Decoration price</label>
                            <input id="addon" name="add_on_price" type="number" value="{{ old('add_on_price', 0) }}" min="0" step="0.01" class="form-control">
                        </div>
                    </div>
                </section>

                <section class="p-5 sm:p-6">
                    <h2 class="mb-5 text-base font-semibold">Pickup and payment</h2>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="pickup_datetime" class="mb-2 block text-sm font-medium">Pickup date and time</label>
                            <input id="pickup_datetime" name="pickup_datetime" type="datetime-local" value="{{ old('pickup_datetime') }}" required class="form-control">
                            @error('pickup_datetime') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="payment_method" class="mb-2 block text-sm font-medium">Payment method</label>
                            <select id="payment_method" name="payment_method" required class="form-control">
                                <option value="">Choose method</option>
                                @foreach(['Cash', 'GCash', 'Bank Transfer'] as $method)
                                    <option value="{{ $method }}" {{ old('payment_method') === $method ? 'selected' : '' }}>{{ $method }}</option>
                                @endforeach
                            </select>
                            @error('payment_method') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="deposit" class="mb-2 block text-sm font-medium">Deposit amount</label>
                            <input id="deposit" name="total_deposit" type="number" value="{{ old('total_deposit', 0) }}" min="0" step="0.01" required class="form-control">
                            <p class="mt-1.5 text-xs text-zinc-500">Minimum deposit is 50% of the estimated total.</p>
                            @error('total_deposit') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <button type="submit" class="shadcn-button-primary mt-6 w-full">Place cake order</button>
                </section>
            </form>

            <aside class="lg:sticky lg:top-6">
                <section class="shadcn-card p-5" aria-label="Order summary">
                    <div class="flex items-center justify-between">
                        <h2 class="font-semibold">Order summary</h2>
                        <span class="shadcn-badge">Estimate</span>
                    </div>
                    <dl class="mt-5 space-y-3 text-sm">
                        <div class="flex justify-between gap-4">
                            <dt class="text-zinc-500">Cake</dt>
                            <dd id="summaryCake" class="text-right font-medium">Not selected</dd>
                        </div>
                        <div class="flex justify-between"><dt class="text-zinc-500">Cake price</dt><dd id="basePrice" class="font-medium">₱0.00</dd></div>
                        <div class="flex justify-between"><dt class="text-zinc-500">Decorations</dt><dd id="addonPrice" class="font-medium">₱0.00</dd></div>
                        <div class="flex justify-between border-t border-zinc-200 pt-3">
                            <dt class="font-medium">Total</dt>
                            <dd id="totalPrice" class="text-lg font-semibold">₱0.00</dd>
                        </div>
                        <div class="flex justify-between"><dt class="text-zinc-500">Minimum deposit</dt><dd id="minimumDeposit" class="font-medium">₱0.00</dd></div>
                        <div class="flex justify-between"><dt class="text-zinc-500">Balance due</dt><dd id="balanceDue" class="font-medium">₱0.00</dd></div>
                    </dl>
                    <p id="depositMessage" class="mt-5 rounded-md border border-zinc-200 bg-zinc-50 px-3 py-2.5 text-xs text-zinc-600" aria-live="polite">
                        Choose a cake to see your estimate.
                    </p>
                </section>
            </aside>
        </div>
    </main>
</body>
</html>
