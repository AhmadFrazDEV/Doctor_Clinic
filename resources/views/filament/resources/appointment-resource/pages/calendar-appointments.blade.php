<x-filament-panels::page>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Appointment Calendar</h1>
            <a href="{{ url('/admin/resources/appointments/list') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                View List
            </a>
        </div>

        <div id="calendar" class="w-full"></div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($events),
                eventClick: function(info) {
                    alert('Appointment: ' + info.event.title + '\nClinic: ' + info.event.extendedProps.clinic + '\nDoctor: ' + info.event.extendedProps.doctor + '\nStatus: ' + info.event.extendedProps.status + '\nNotes: ' + info.event.extendedProps.notes);
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                height: 'auto'
            });
            calendar.render();
        });
    </script>
    @endpush

    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.css" rel="stylesheet">
    @endpush
</x-filament-panels::page>
