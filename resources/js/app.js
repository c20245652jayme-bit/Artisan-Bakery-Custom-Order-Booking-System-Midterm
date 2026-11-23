const cake = document.getElementById('cake');
const addon = document.getElementById('addon');
const deposit = document.getElementById('deposit');

if (cake && addon && deposit) {
    const money = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP',
    });

    const summaryCake = document.getElementById('summaryCake');
    const basePrice = document.getElementById('basePrice');
    const addonPrice = document.getElementById('addonPrice');
    const totalPrice = document.getElementById('totalPrice');
    const minimumDeposit = document.getElementById('minimumDeposit');
    const depositAmount = document.getElementById('depositAmount');
    const balanceDue = document.getElementById('balanceDue');
    const depositMessage = document.getElementById('depositMessage');

    function calculateTotal() {
        const selectedCake = cake.options[cake.selectedIndex];
        const base = Number(selectedCake?.dataset.price || 0);
        const extra = Math.max(0, Number(addon.value || 0));
        const payment = Math.max(0, Number(deposit.value || 0));
        const total = base + extra;
        const minimum = total * 0.5;

        summaryCake.textContent = selectedCake?.value
            ? selectedCake.textContent.trim().split(' — ')[0]
            : 'Not selected';
        basePrice.textContent = money.format(base);
        addonPrice.textContent = money.format(extra);
        totalPrice.textContent = money.format(total);
        minimumDeposit.textContent = money.format(minimum);
        depositAmount.textContent = money.format(payment);
        balanceDue.textContent = money.format(Math.max(0, total - payment));

        depositMessage.className = 'rounded-lg border px-3 py-2.5 text-xs leading-5';

        if (total === 0) {
            depositMessage.textContent = 'Choose a cake to see your estimate.';
            depositMessage.classList.add('border-stone-200', 'bg-white', 'text-stone-600');
        } else if (payment > total) {
            depositMessage.textContent = 'Your deposit cannot be more than the total price.';
            depositMessage.classList.add('border-red-200', 'bg-red-50', 'text-red-800');
        } else if (payment < minimum) {
            depositMessage.textContent = `A deposit of at least ${money.format(minimum)} is needed to book.`;
            depositMessage.classList.add('border-amber-200', 'bg-amber-50', 'text-amber-900');
        } else {
            depositMessage.textContent = 'Your deposit meets the minimum booking amount.';
            depositMessage.classList.add('border-emerald-200', 'bg-emerald-50', 'text-emerald-800');
        }
    }

    const pickup = document.getElementById('pickup_datetime');
    if (pickup && !pickup.min) {
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        pickup.min = now.toISOString().slice(0, 16);
    }

    cake.addEventListener('change', calculateTotal);
    addon.addEventListener('input', calculateTotal);
    deposit.addEventListener('input', calculateTotal);

    calculateTotal();
}
