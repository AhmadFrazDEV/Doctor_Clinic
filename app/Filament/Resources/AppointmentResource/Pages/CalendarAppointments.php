<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use Filament\Resources\Pages\Page;
use App\Models\Appointment;
use Filament\Actions;
use BackedEnum;

class CalendarAppointments extends Page
{
    protected static string $resource = AppointmentResource::class;

    protected static ?string $title = 'Appointments Calendar';

    // ✅ Fix: add BackedEnum type
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected string $view = 'filament.resources.appointment-resource.pages.calendar-appointments';

    public array $events = [];

    public function mount(): void
    {
        $appointments = Appointment::with(['clinic', 'patient', 'doctor', 'service'])
            ->orderBy('appointment_date')
            ->get();

        $this->events = $appointments->map(function ($appointment) {
            $color = match ($appointment->status) {
                'pending'   => '#f59e0b', // yellow
                'confirmed' => '#10b981', // green
                'completed' => '#3b82f6', // blue
                'cancelled' => '#ef4444', // red
                default     => '#6b7280', // gray
            };

            return [
                'id'             => $appointment->id,
                'title'          => "{$appointment->patient->first_name} - {$appointment->service->name}",
                'start'          => $appointment->appointment_date?->toDateTimeString(),
                'backgroundColor'=> $color,
                'borderColor'    => $color,
                'extendedProps'  => [
                    'clinic' => $appointment->clinic?->name ?? 'N/A',
                    'doctor' => $appointment->doctor?->name ?? 'N/A',
                    'status' => ucfirst($appointment->status),
                    'notes'  => $appointment->notes ?? '',
                ],
            ];
        })->toArray();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add Appointment')
                ->icon('heroicon-o-plus'),
        ];
    }
}
