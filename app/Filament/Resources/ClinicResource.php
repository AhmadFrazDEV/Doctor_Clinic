<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClinicResource\Pages;
use App\Models\Clinic;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;

class ClinicResource extends Resource
{
    protected static ?string $model = Clinic::class;

    // keep the union type to match Filament's Resource property
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office';

    // Schema-based form signature (Filament v4+)
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->required()
                ->maxLength(255),

            Select::make('owner_id')
                ->relationship('owner', 'name')
                ->required(),

            TextInput::make('address')
                ->maxLength(255),

            TextInput::make('phone')
                ->tel()
                ->maxLength(20),

            TextInput::make('subscription_plan')
                ->maxLength(255),

            Textarea::make('notes'),
        ]);
    }

    // Table signature remains the same (returns a Table)
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('owner.name')->label('Owner')->sortable()->searchable(),
                TextColumn::make('address')->limit(50),
                TextColumn::make('phone'),
                TextColumn::make('subscription_plan'),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                //
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
        return [
            // RelationManagers (e.g., PatientsRelationManager::class) go here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListClinics::route('/'),
            'create' => Pages\CreateClinic::route('/create'),
            'edit'   => Pages\EditClinic::route('/{record}/edit'),
        ];
    }
}
