<div class="grid grid-cols-3 gap-4">
    <div class="p-4 bg-white rounded shadow">
        <h3 class="text-lg font-semibold">Revenue</h3>
        <p class="text-2xl">${{ number_format($revenue, 2) }}</p>
    </div>
    <div class="p-4 bg-white rounded shadow">
        <h3 class="text-lg font-semibold">Expenses</h3>
        <p class="text-2xl">${{ number_format($expenses, 2) }}</p>
    </div>
    <div class="p-4 bg-white rounded shadow">
        <h3 class="text-lg font-semibold">Outstanding</h3>
        <p class="text-2xl">${{ number_format($outstanding, 2) }}</p>
    </div>
</div>
