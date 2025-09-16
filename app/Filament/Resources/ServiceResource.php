<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-wrench-screwdriver';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('clinic_id')
                ->relationship('clinic', 'name')
                ->required()
                ->label('Clinic'),

            TextInput::make('name')
                ->required()
                ->maxLength(255),

            Textarea::make('description')
                ->maxLength(65535),

            TextInput::make('price')
                ->numeric()
                ->prefix('$')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('clinic.name')
                    ->sortable()
                    ->searchable()
                    ->label('Clinic'),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('description')
                    ->limit(50),

                TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Add filters if needed
            ])
            ->actions([
                // EditAction::make(),
            ])
            ->bulkActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
