<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#fffaf7">
    <title>Order a custom cake | Arabelle's Bakery</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fffaf7] text-stone-900 antialiased">
    <header class="border-b border-stone-200/80 bg-white/80">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 sm:px-8">
            <a href="{{ route('bakery.order.create') }}" class="flex items-center gap-3" aria-label="Arabelle's Bakery home">
                <span class="flex size-10 items-center justify-center rounded-xl bg-rose-100 text-xl" aria-hidden="true">🍰</span>
                <span>
                    <span class="block text-sm font-semibold tracking-tight">Arabelle's Bakery</span>
                    <span class="block text-xs text-stone-500">Handmade for your celebration</span>
                </span>
            </a>
            <nav aria-label="Main navigation" class="flex items-center gap-2">
                <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-stone-600 transition hover:bg-stone-100 hover:text-stone-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-stone-400">
                    Dashboard
                </a>
                <span class="hidden items-center gap-2 rounded-full border border-stone-200 bg-white px-3 py-1.5 text-xs font-medium text-stone-600 sm:inline-flex">
                    <span class="size-2 rounded-full bg-emerald-500"></span>
                    Custom cake bookings
                </span>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-5 pb-16 pt-10 sm:px-8 sm:pt-14">
        <div class="mx-auto mb-9 max-w-3xl text-center">
            <span class="inline-flex items-center gap-2 rounded-full border border-rose-200 bg-rose-50 px-3 py-1 text-xs font-medium text-rose-700">
                Made fresh, just for you
            </span>
            <h1 class="mt-4 text-3xl font-semibold tracking-tight sm:text-4xl">Let's make it a little sweeter.</h1>
            <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-stone-500 sm:text-base">
                Tell us about your celebration and we'll prepare a cake that's made to be remembered.
            </p>
        </div>

        @if(session('success'))
            <div class="mx-auto mb-6 flex max-w-5xl gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-900" role="status">
                <svg class="mt-0.5 size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="mx-auto mb-6 max-w-5xl rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-900" role="alert">
                <div class="flex gap-3">
                    <svg class="mt-0.5 size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/></svg>
                    <div>
                        <p class="font-medium">There are a few things to check</p>
                        <ul class="mt-1 list-inside list-disc text-red-800">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="mx-auto grid max-w-5xl items-start gap-6 lg:grid-cols-[minmax(0,1fr)_340px]">
            <form action="{{ route('bakery.order.store') }}" method="POST" class="rounded-xl border border-stone-200 bg-white shadow-sm">
                @csrf
                <section class="border-b border-stone-200 p-5 sm:p-7">
                    <div class="mb-6 flex items-start gap-3">
                        <span class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-stone-100 text-sm font-semibold text-stone-700">01</span>
                        <div>
                            <h2 class="text-base font-semibold tracking-tight">Your details</h2>
                            <p class="mt-1 text-sm text-stone-500">Who should we prepare this order for?</p>
                        </div>
                    </div>
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="customer_name" class="mb-2 block text-sm font-medium">Full name <span class="text-rose-600">*</span></label>
                            <input id="customer_name" name="customer_name" type="text" value="{{ old('customer_name') }}" placeholder="e.g. Jamie Santos" autocomplete="name" required maxlength="100" class="form-control">
                            @error('customer_name') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="contact_phone" class="mb-2 block text-sm font-medium">Contact number <span class="text-rose-600">*</span></label>
                            <input id="contact_phone" name="contact_phone" type="tel" value="{{ old('contact_phone') }}" placeholder="09XX XXX XXXX" autocomplete="tel" required maxlength="20" class="form-control">
                            @error('contact_phone') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>

                <section class="border-b border-stone-200 p-5 sm:p-7">
                    <div class="mb-6 flex items-start gap-3">
                        <span class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-stone-100 text-sm font-semibold text-stone-700">02</span>
                        <div>
                            <h2 class="text-base font-semibold tracking-tight">Your cake</h2>
                            <p class="mt-1 text-sm text-stone-500">Pick a favorite and make it your own.</p>
                        </div>
                    </div>
                    <div class="space-y-5">
                        <div>
                            <label for="cake" class="mb-2 block text-sm font-medium">Cake flavor and size <span class="text-rose-600">*</span></label>
                            <select id="cake" name="cake_product_id" required class="form-control">
                                <option value="">Choose a cake</option>
                                @foreach($cakes as $cake)
                                    <option value="{{ $cake->cake_product_id }}" data-price="{{ $cake->base_price }}" {{ old('cake_product_id') == $cake->cake_product_id ? 'selected' : '' }}>
                                        {{ $cake->cake_flavor }} · {{ $cake->cake_size }} — ₱{{ number_format($cake->base_price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            @if($cakes->isEmpty())
                                <p class="mt-2 text-xs text-amber-700">Cake options are currently unavailable. Please check back soon.</p>
                            @endif
                            @error('cake_product_id') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="custom_inscription" class="mb-2 block text-sm font-medium">Cake inscription <span class="font-normal text-stone-400">· optional</span></label>
                            <input id="custom_inscription" name="custom_inscription" type="text" value="{{ old('custom_inscription') }}" placeholder="e.g. Happy Birthday, Alex!" maxlength="100" class="form-control">
                            <p class="mt-1.5 text-xs text-stone-500">A short message to make it extra special.</p>
                        </div>
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label for="add_on_decorations" class="mb-2 block text-sm font-medium">Decorations <span class="font-normal text-stone-400">· optional</span></label>
                                <select id="add_on_decorations" name="add_on_decorations" class="form-control">
                                    <option value="">No decorations</option>
                                    <option value="Flowers" {{ old('add_on_decorations') === 'Flowers' ? 'selected' : '' }}>Fresh flowers</option>
                                    <option value="Chocolate Drip" {{ old('add_on_decorations') === 'Chocolate Drip' ? 'selected' : '' }}>Chocolate drip</option>
                                    <option value="Fondant Design" {{ old('add_on_decorations') === 'Fondant Design' ? 'selected' : '' }}>Fondant design</option>
                                    <option value="Birthday Topper" {{ old('add_on_decorations') === 'Birthday Topper' ? 'selected' : '' }}>Birthday topper</option>
                                </select>
                            </div>
                            <div>
                                <label for="addon" class="mb-2 block text-sm font-medium">Decoration price <span class="text-rose-600">*</span></label>
                                <div class="relative">
                                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-sm text-stone-500">₱</span>
                                    <input id="addon" name="add_on_price" type="number" value="{{ old('add_on_price', 0) }}" min="0" step="0.01" class="form-control pl-8">
                                </div>
                                @error('add_on_price') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </section>

                <section class="p-5 sm:p-7">
                    <div class="mb-6 flex items-start gap-3">
                        <span class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-stone-100 text-sm font-semibold text-stone-700">03</span>
                        <div>
                            <h2 class="text-base font-semibold tracking-tight">Pickup and payment</h2>
                            <p class="mt-1 text-sm text-stone-500">Choose when you'll pick up your cake.</p>
                        </div>
                    </div>
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="pickup_datetime" class="mb-2 block text-sm font-medium">Pickup date and time <span class="text-rose-600">*</span></label>
                            <input id="pickup_datetime" name="pickup_datetime" type="datetime-local" value="{{ old('pickup_datetime') }}" required class="form-control">
                            @error('pickup_datetime') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="payment_method" class="mb-2 block text-sm font-medium">Payment method <span class="text-rose-600">*</span></label>
                            <select id="payment_method" name="payment_method" required class="form-control">
                                <option value="">Select a method</option>
                                <option value="Cash" {{ old('payment_method') === 'Cash' ? 'selected' : '' }}>Cash</option>
                                <option value="GCash" {{ old('payment_method') === 'GCash' ? 'selected' : '' }}>GCash</option>
                                <option value="Bank Transfer" {{ old('payment_method') === 'Bank Transfer' ? 'selected' : '' }}>Bank transfer</option>
                            </select>
                            @error('payment_method') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="deposit" class="mb-2 block text-sm font-medium">Deposit amount <span class="text-rose-600">*</span></label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-sm text-stone-500">₱</span>
                                <input id="deposit" name="total_deposit" type="number" value="{{ old('total_deposit', 0) }}" min="0" step="0.01" required class="form-control pl-8">
                            </div>
                            <p class="mt-1.5 text-xs text-stone-500">A deposit of at least 50% is needed to confirm your booking.</p>
                            @error('total_deposit') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <button type="submit" class="mt-7 inline-flex w-full items-center justify-center gap-2 rounded-lg bg-stone-900 px-4 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-stone-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-stone-500 focus-visible:ring-offset-2">
                        Place your cake order
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                    </button>
                    <p class="mt-3 text-center text-xs text-stone-500">We'll be in touch to confirm your custom order.</p>
                </section>
            </form>

            <aside class="lg:sticky lg:top-6">
                <section class="rounded-xl border border-stone-200 bg-white shadow-sm">
                    <div class="border-b border-stone-200 p-5">
                        <div class="flex items-center justify-between">
                            <h2 class="text-base font-semibold tracking-tight">Order summary</h2>
                            <span class="rounded-full bg-stone-100 px-2.5 py-1 text-xs font-medium text-stone-600">Estimate</span>
                        </div>
                        <p class="mt-1 text-sm text-stone-500">Your celebration, made to order.</p>
                    </div>
                    <div class="space-y-4 p-5">
                        <div class="flex justify-between gap-4 text-sm">
                            <span class="text-stone-500">Cake</span>
                            <span id="summaryCake" class="text-right font-medium">Not selected</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-stone-500">Cake price</span>
                            <span id="basePrice" class="font-medium">₱0.00</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-stone-500">Decoration</span>
                            <span id="addonPrice" class="font-medium">₱0.00</span>
                        </div>
                        <div class="border-t border-dashed border-stone-200 pt-4">
                            <div class="flex items-baseline justify-between">
                                <span class="font-medium">Total</span>
                                <span id="totalPrice" class="text-xl font-semibold tracking-tight">₱0.00</span>
                            </div>
                        </div>
                        <div class="rounded-lg bg-stone-50 p-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-stone-500">Minimum deposit (50%)</span>
                                <span id="minimumDeposit" class="font-medium">₱0.00</span>
                            </div>
                            <div class="mt-3 flex justify-between text-sm">
                                <span class="text-stone-500">Your deposit</span>
                                <span id="depositAmount" class="font-medium">₱0.00</span>
                            </div>
                            <div class="mt-3 flex justify-between border-t border-stone-200 pt-3">
                                <span class="text-sm font-medium">Balance due</span>
                                <span id="balanceDue" class="text-sm font-semibold">₱0.00</span>
                            </div>
                        </div>
                        <div id="depositMessage" class="rounded-lg border border-stone-200 bg-white px-3 py-2.5 text-xs leading-5 text-stone-600" aria-live="polite">
                            Choose a cake to see your estimate.
                        </div>
                    </div>
                </section>
                <p class="mt-4 flex items-center justify-center gap-2 text-xs text-stone-500">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg>
                    Your details are only used for this order.
                </p>
            </aside>
        </div>
    </main>

    <footer class="border-t border-stone-200 bg-white">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 px-5 py-6 text-xs text-stone-500 sm:flex-row sm:px-8">
            <span>© {{ date('Y') }} Arabelle's Bakery</span>
            <span>Freshly baked with love.</span>
        </div>
    </footer>
</body>
</html>
