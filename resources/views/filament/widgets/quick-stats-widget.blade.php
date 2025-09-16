<div class="grid grid-cols-4 gap-4">
    <div class="p-4 bg-white rounded shadow">
        <h3 class="text-lg font-semibold">Total Patients</h3>
        <p class="text-2xl">{{ $totalPatients }}</p>
    </div>
    <div class="p-4 bg-white rounded shadow">
        <h3 class="text-lg font-semibold">Total Appointments</h3>
        <p class="text-2xl">{{ $totalAppointments }}</p>
    </div>
    <div class="p-4 bg-white rounded shadow">
        <h3 class="text-lg font-semibold">Stock Alert</h3>
        <p class="text-2xl">{{ $stockAlert }}</p>
    </div>
    <div class="p-4 bg-white rounded shadow">
        <h3 class="text-lg font-semibold">Pending Consents</h3>
        <p class="text-2xl">{{ $pendingConsents }}</p>
    </div>
</div>
