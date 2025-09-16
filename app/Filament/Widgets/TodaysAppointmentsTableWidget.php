<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TodaysAppointmentsTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Today\'s Appointments';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Appointment::query()
                    ->whereDate('appointment_date', today())
                    ->with(['patient', 'service', 'clinic', 'doctor'])
            )
            ->columns([
                Tables\Columns\TextColumn::make('appointment_date')
                    ->time()
                    ->label('Time'),
                Tables\Columns\TextColumn::make('patient.first_name')
                    ->label('Patient'),
                Tables\Columns\TextColumn::make('service.name')
                    ->label('Service'),
                Tables\Columns\TextColumn::make('clinic.name')
                    ->label('Clinic'),
                Tables\Columns\TextColumn::make('doctor.name')
                    ->label('Doctor'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'primary' => 'completed',
                        'danger' => 'cancelled',
                    ]),
            ])
            ->defaultSort('appointment_date', 'asc');
    }
}
