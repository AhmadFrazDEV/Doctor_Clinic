<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use Filament\Resources\Pages\Page;
use App\Models\Appointment;
use Illuminate\Support\Collection;

class CalendarAppointments extends Page
{
    protected static string $resource = AppointmentResource::class;

    protected string $view = 'filament.resources.appointment-resource.pages.calendar-appointments';

    public array $events = [];

    public function mount(): void
    {
        $appointments = Appointment::with(['clinic', 'patient', 'doctor', 'service'])
            ->orderBy('appointment_date')
            ->get();

        $this->events = $appointments->map(function ($appointment) {
            return [
                'id' => $appointment->id,
                'title' => $appointment->patient->first_name . ' - ' . $appointment->service->name,
                'start' => $appointment->appointment_date->toDateTimeString(),
                'extendedProps' => [
                    'clinic' => $appointment->clinic->name,
                    'doctor' => $appointment->doctor->name,
                    'status' => $appointment->status,
                    'notes' => $appointment->notes,
                ],
            ];
        })->toArray();
    }
}
