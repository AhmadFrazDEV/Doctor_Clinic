<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Models\Patient;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('clinic_id')
                ->relationship('clinic', 'name')
                ->required(),

            TextInput::make('first_name')
                ->required()
                ->maxLength(255),

            TextInput::make('last_name')
                ->required()
                ->maxLength(255),

            Select::make('gender')
                ->options([
                    'male' => 'Male',
                    'female' => 'Female',
                    'other' => 'Other',
                ])
                ->required(),

            DatePicker::make('date_of_birth')
                ->required(),

            TextInput::make('phone')->tel()->maxLength(20),
            TextInput::make('email')->email()->maxLength(255),

            Textarea::make('address'),
            Textarea::make('notes'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('clinic.name')->label('Clinic')->sortable()->searchable(),
                TextColumn::make('first_name')->sortable()->searchable(),
                TextColumn::make('last_name')->sortable()->searchable(),
                TextColumn::make('gender')->sortable(),
                TextColumn::make('date_of_birth')->date()->sortable(),
                TextColumn::make('phone'),
                TextColumn::make('email'),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->actions([
                // EditAction::make(),
                // DeleteAction::make(),
            ])
            ->bulkActions([
                // DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
