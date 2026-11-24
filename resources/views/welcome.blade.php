<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#18181b">
        <meta name="description" content="Manage bakery orders and custom cake bookings.">

        <title>Arabelle's Bakery Dashboard</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-zinc-50/50 text-zinc-950 antialiased">
        <header class="sticky top-0 z-20 border-b border-zinc-200 bg-white/95 backdrop-blur">
            <div class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-6 px-5 sm:px-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-md focus:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                    <span class="grid size-9 place-items-center rounded-lg bg-zinc-950 text-sm font-semibold text-white" aria-hidden="true">A</span>
                    <span>
                        <span class="block text-sm font-semibold leading-tight">Arabelle's Bakery</span>
                        <span class="block text-xs text-zinc-500">Order dashboard</span>
                    </span>
                </a>

                <nav aria-label="Main navigation" class="flex items-center gap-2 sm:gap-4">
                    <a href="{{ route('dashboard') }}" aria-current="page" class="hidden rounded-md px-3 py-2 text-sm font-medium text-zinc-950 sm:inline-flex">
                        Dashboard
                    </a>
                    <a href="{{ route('bakery.order.create') }}" class="shadcn-button-primary">
                        <span class="text-base leading-none" aria-hidden="true">+</span>
                        <span>New booking</span>
                    </a>
                </nav>
            </div>
        </header>

        <main class="mx-auto flex max-w-7xl flex-col gap-6 px-5 py-8 sm:px-8 sm:py-10">
            <section class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div class="flex flex-col gap-2">
                    <p class="text-sm font-medium text-zinc-500">Bakery overview</p>
                    <h1 class="text-3xl font-semibold tracking-tight text-zinc-950 sm:text-4xl">Your bakery at a glance</h1>
                    <p class="max-w-2xl text-sm leading-6 text-zinc-500 sm:text-base">
                        A quick snapshot of today's bookings and your cake menu.
                    </p>
                </div>
                <p class="text-sm text-zinc-500">{{ now()->format('l, F j, Y') }}</p>
            </section>

            <section aria-label="Bakery statistics" class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <article class="shadcn-card flex min-h-36 flex-col justify-between gap-5 p-6">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-medium text-zinc-500">Orders today</p>
                        <span class="grid size-9 place-items-center rounded-md border border-zinc-200 bg-zinc-50 text-zinc-700" aria-hidden="true">↗</span>
                    </div>
                    <p class="text-3xl font-semibold tracking-tight">{{ number_format($ordersToday) }}</p>
                </article>

                <article class="shadcn-card flex min-h-36 flex-col justify-between gap-5 p-6">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-medium text-zinc-500">Pending orders</p>
                        <span class="grid size-9 place-items-center rounded-md border border-zinc-200 bg-zinc-50 text-zinc-700" aria-hidden="true">◷</span>
                    </div>
                    <p class="text-3xl font-semibold tracking-tight">{{ number_format($pendingOrders) }}</p>
                </article>

                <article class="shadcn-card flex min-h-36 flex-col justify-between gap-5 p-6">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-medium text-zinc-500">All orders</p>
                        <span class="grid size-9 place-items-center rounded-md border border-zinc-200 bg-zinc-50 text-zinc-700" aria-hidden="true">▤</span>
                    </div>
                    <p class="text-3xl font-semibold tracking-tight">{{ number_format($totalOrders) }}</p>
                </article>

                <article class="shadcn-card flex min-h-36 flex-col justify-between gap-5 p-6">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-medium text-zinc-500">Cake varieties</p>
                        <span class="grid size-9 place-items-center rounded-md border border-zinc-200 bg-zinc-50 text-zinc-700" aria-hidden="true">✿</span>
                    </div>
                    <p class="text-3xl font-semibold tracking-tight">{{ number_format($cakeProducts) }}</p>
                </article>
            </section>

            <section aria-labelledby="recent-orders-title" class="shadcn-card overflow-hidden">
                <div class="flex flex-col gap-1 border-b border-zinc-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 id="recent-orders-title" class="text-base font-semibold">Recent orders</h2>
                        <p class="mt-1 text-sm text-zinc-500">The latest cake bookings and pickup times.</p>
                    </div>
                    <span class="text-sm text-zinc-500">Latest 5</span>
                </div>

                @if($recentOrders->isEmpty())
                    <div class="px-6 py-12 text-center">
                        <p class="text-sm font-medium text-zinc-900">No orders yet</p>
                        <p class="mt-1 text-sm text-zinc-500">New cake bookings will appear here.</p>
                        <a href="{{ route('bakery.order.create') }}" class="shadcn-button-outline mt-4">Create a booking</a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[36rem] text-left text-sm">
                            <thead class="bg-zinc-50 text-xs font-medium uppercase tracking-wide text-zinc-500">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Order</th>
                                    <th scope="col" class="px-6 py-3">Cake</th>
                                    <th scope="col" class="px-6 py-3">Pickup</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100">
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td class="whitespace-nowrap px-6 py-4 font-medium text-zinc-900">#{{ $order->order_id }}</td>
                                        <td class="px-6 py-4 text-zinc-700">
                                            {{ $order->cakeProduct->cake_flavor }} · {{ $order->cakeProduct->cake_size }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-zinc-600">
                                            {{ $order->pickup_datetime->format('M j, Y · g:i A') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span @class([
                                                'inline-flex rounded-md border px-2 py-1 text-xs font-medium capitalize',
                                                'border-amber-200 bg-amber-50 text-amber-800' => strtolower($order->order_status) === 'pending',
                                                'border-emerald-200 bg-emerald-50 text-emerald-800' => strtolower($order->order_status) === 'completed',
                                                'border-zinc-200 bg-zinc-50 text-zinc-700' => ! in_array(strtolower($order->order_status), ['pending', 'completed'], true),
                                            ])>
                                                {{ $order->order_status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>

            <section class="flex flex-col justify-between gap-5 rounded-xl border border-zinc-200 bg-zinc-950 p-6 text-white shadow-sm sm:flex-row sm:items-center sm:p-8">
                <div class="flex flex-col gap-2">
                    <h2 class="text-xl font-semibold tracking-tight sm:text-2xl">Make someone's celebration sweeter.</h2>
                    <p class="max-w-xl text-sm leading-6 text-zinc-300">
                        Start a custom cake booking and capture the details for the next special occasion.
                    </p>
                </div>
                <a href="{{ route('bakery.order.create') }}" class="inline-flex h-10 shrink-0 items-center justify-center rounded-md bg-white px-4 text-sm font-medium text-zinc-950 shadow-sm transition-colors hover:bg-zinc-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-zinc-950">
                    Open booking form
                </a>
            </section>
        </main>
    </body>
</html>
