<?php

namespace App\Filament\Widgets;

use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use App\Models\Appointment;
use Illuminate\Support\Carbon;

class TodaysAppointmentsTable extends BaseWidget
{
    protected static ?string $heading = "Today's Appointments"; // Card title
    protected int | string | array $columnSpan = 'full'; // Full width on dashboard

    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Appointment::query()
            ->whereDate('appointment_date', Carbon::today())
            ->with(['clinic', 'patient', 'doctor', 'service'])
            ->orderBy('appointment_date');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('clinic.name')
                ->label('Clinic')
                ->sortable()
                ->searchable(),

            TextColumn::make('patient.first_name')
                ->label('Patient')
                ->sortable()
                ->searchable(),

            TextColumn::make('doctor.name')
                ->label('Doctor')
                ->sortable()
                ->searchable(),

            TextColumn::make('service.name')
                ->label('Service')
                ->sortable()
                ->badge()
                ->color('info'),

            TextColumn::make('appointment_date')
                ->label('Time')
                ->dateTime('h:i A')
                ->sortable()
                ->icon('heroicon-m-clock'),

            TextColumn::make('status')
                ->badge()
                ->colors([
                    'primary' => 'scheduled',
                    'success' => 'completed',
                    'danger'  => 'cancelled',
                    'warning' => 'pending',
                ])
                ->sortable(),

            TextColumn::make('notes')
                ->label('Notes')
                ->limit(40)
                ->tooltip(fn ($record) => $record->notes), // Hover to see full text
        ];
    }
}
