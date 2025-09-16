<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('clinic_id')
                ->relationship('clinic', 'name')
                ->required(),

            Select::make('patient_id')
                ->relationship('patient', 'first_name')
                ->required(),

            Select::make('doctor_id')
                ->relationship('doctor', 'name')
                ->required(),

            Select::make('service_id')
                ->relationship('service', 'name'),
                // ->required(),

            DateTimePicker::make('appointment_date')
                ->required(),

            Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'confirmed' => 'Confirmed',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ])
                ->default('pending')
                ->required(),

            Textarea::make('notes')
                ->rows(3)
                ->maxLength(65535),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('clinic.name')->label('Clinic')->sortable()->searchable(),
                TextColumn::make('patient.first_name')->label('Patient')->sortable()->searchable(),
                TextColumn::make('doctor.name')->label('Doctor')->sortable()->searchable(),
                TextColumn::make('service.name')->label('Service')->sortable()->searchable(),
                TextColumn::make('appointment_date')->dateTime()->sortable(),
                TextColumn::make('status')->sortable(),
                TextColumn::make('notes')->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\CalendarAppointments::route('/'),
            'list' => Pages\ListAppointments::route('/list'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
