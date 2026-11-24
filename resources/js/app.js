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
    const balanceDue = document.getElementById('balanceDue');
    const depositMessage = document.getElementById('depositMessage');

    const setText = (element, value) => {
        if (element) element.textContent = value;
    };

    function calculateTotal() {
        const selectedCake = cake.options[cake.selectedIndex];
        const base = Number(selectedCake?.dataset.price || 0);
        const extra = Math.max(0, Number(addon.value || 0));
        const payment = Math.max(0, Number(deposit.value || 0));
        const total = base + extra;
        const minimum = total * 0.5;

        setText(summaryCake, selectedCake?.value
            ? selectedCake.textContent.trim().split(' — ')[0]
            : 'Not selected');
        setText(basePrice, money.format(base));
        setText(addonPrice, money.format(extra));
        setText(totalPrice, money.format(total));
        setText(minimumDeposit, money.format(minimum));
        setText(balanceDue, money.format(Math.max(0, total - payment)));

        if (!depositMessage) return;

        depositMessage.className = 'mt-5 rounded-md border px-3 py-2.5 text-xs';

        let message = 'Choose a cake to see your estimate.';
        let classes = 'border-zinc-200 bg-zinc-50 text-zinc-600';

        if (total === 0) {
            // Keep the default message and classes.
        } else if (payment > total) {
            message = 'Deposit cannot be more than the total price.';
            classes = 'border-red-200 bg-red-50 text-red-800';
        } else if (payment < minimum) {
            message = `Minimum deposit: ${money.format(minimum)}.`;
            classes = 'border-amber-200 bg-amber-50 text-amber-900';
        } else {
            message = 'Deposit meets the minimum amount.';
            classes = 'border-emerald-200 bg-emerald-50 text-emerald-800';
        }

        depositMessage.textContent = message;
        depositMessage.classList.add(...classes.split(' '));
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
