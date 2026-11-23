<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#f7f2eb">

        <title>Arabelle's Bakery Dashboard</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#f7f2eb] text-[#3d3027] antialiased">
        <header class="border-b border-[#e8dccb] bg-[#fffdf9]">
            <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-5 py-5 sm:px-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-[#795548]">
                    <span class="grid size-11 place-items-center rounded-xl bg-[#5c4033] text-lg font-bold text-[#fffaf3]" aria-hidden="true">A</span>
                    <span>
                        <span class="block text-lg font-bold leading-tight">Arabelle's Bakery</span>
                        <span class="block text-xs text-[#806d5d]">Order dashboard</span>
                    </span>
                </a>

                <nav aria-label="Main navigation" class="flex items-center gap-2 sm:gap-4">
                    <a href="{{ route('dashboard') }}" aria-current="page" class="hidden rounded-lg px-3 py-2 text-sm font-semibold text-[#5c4033] sm:inline-flex">
                        Dashboard
                    </a>
                    <a href="{{ route('bakery.order.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-[#5c4033] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#493323] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#795548] focus-visible:ring-offset-2">
                        <span aria-hidden="true">+</span>
                        <span>New booking</span>
                    </a>
                </nav>
            </div>
        </header>

        <main class="mx-auto flex max-w-7xl flex-col gap-8 px-5 py-8 sm:px-8 sm:py-12">
            <section class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div class="flex flex-col gap-2">
                    <p class="text-sm font-bold uppercase tracking-[0.16em] text-[#9a6b45]">Bakery overview</p>
                    <h1 class="text-3xl font-bold tracking-tight text-[#3d3027] sm:text-4xl">Your bakery at a glance</h1>
                    <p class="max-w-2xl text-sm leading-6 text-[#806d5d] sm:text-base">
                        A quick snapshot of today's bookings and your cake menu.
                    </p>
                </div>
                <p class="text-sm font-medium text-[#806d5d]">{{ now()->format('l, F j, Y') }}</p>
            </section>

            <section aria-label="Bakery statistics" class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <article class="flex min-h-40 flex-col justify-between gap-5 rounded-2xl border border-[#eadfd2] bg-[#fffdf9] p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-semibold text-[#806d5d]">Orders today</p>
                        <span class="grid size-10 place-items-center rounded-xl bg-[#f4e8d9] text-lg text-[#795548]" aria-hidden="true">↗</span>
                    </div>
                    <p class="text-4xl font-bold tracking-tight">{{ number_format($ordersToday) }}</p>
                </article>

                <article class="flex min-h-40 flex-col justify-between gap-5 rounded-2xl border border-[#eadfd2] bg-[#fffdf9] p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-semibold text-[#806d5d]">Pending orders</p>
                        <span class="grid size-10 place-items-center rounded-xl bg-[#fbf0d7] text-lg text-[#9a6b22]" aria-hidden="true">◷</span>
                    </div>
                    <p class="text-4xl font-bold tracking-tight">{{ number_format($pendingOrders) }}</p>
                </article>

                <article class="flex min-h-40 flex-col justify-between gap-5 rounded-2xl border border-[#eadfd2] bg-[#fffdf9] p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-semibold text-[#806d5d]">All orders</p>
                        <span class="grid size-10 place-items-center rounded-xl bg-[#e7eee5] text-lg text-[#526c4c]" aria-hidden="true">▤</span>
                    </div>
                    <p class="text-4xl font-bold tracking-tight">{{ number_format($totalOrders) }}</p>
                </article>

                <article class="flex min-h-40 flex-col justify-between gap-5 rounded-2xl border border-[#eadfd2] bg-[#fffdf9] p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-semibold text-[#806d5d]">Cake varieties</p>
                        <span class="grid size-10 place-items-center rounded-xl bg-[#f3e5e9] text-lg text-[#8c5362]" aria-hidden="true">✿</span>
                    </div>
                    <p class="text-4xl font-bold tracking-tight">{{ number_format($cakeProducts) }}</p>
                </article>
            </section>

            <section class="flex flex-col justify-between gap-5 rounded-2xl bg-[#5c4033] p-6 text-[#fffaf3] shadow-sm sm:flex-row sm:items-center sm:p-8">
                <div class="flex flex-col gap-2">
                    <h2 class="text-xl font-bold sm:text-2xl">Make someone's celebration sweeter.</h2>
                    <p class="max-w-xl text-sm leading-6 text-[#ead8c5]">
                        Start a custom cake booking and capture the details for the next special occasion.
                    </p>
                </div>
                <a href="{{ route('bakery.order.create') }}" class="inline-flex shrink-0 items-center justify-center rounded-lg bg-[#fffaf3] px-5 py-3 text-sm font-bold text-[#5c4033] transition hover:bg-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-[#5c4033]">
                    Open booking form
                </a>
            </section>
        </main>
    </body>
</html>
