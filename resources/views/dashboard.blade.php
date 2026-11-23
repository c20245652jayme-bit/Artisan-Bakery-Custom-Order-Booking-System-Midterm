<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-[#fff8ee] text-[#493323]">

    <header class="bg-[#8b5e3c] text-white p-6">
        <h1 class="text-2xl font-bold">Arabelle's Bakery</h1>
        <p>Custom Cake Order Dashboard</p>
    </header>

    <main class="p-8">
        <h2 class="text-2xl font-bold mb-6">Dashboard</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="bg-white p-6 rounded-xl shadow">
                <h3>Total Customers</h3>
                <p class="text-3xl font-bold">0</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3>Total Cake Products</h3>
                <p class="text-3xl font-bold">0</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3>Total Orders</h3>
                <p class="text-3xl font-bold">0</p>
            </div>
        </div>

        <div class="mt-8">
            <a href="/bakery"
               class="bg-[#8b5e3c] text-white px-6 py-3 rounded-lg">
                Create New Cake Order
            </a>
        </div>
    </main>

</body>
</html>
