<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use App\Models\Consent;
use App\Models\InventoryItem;
use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class QuickStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Patients', Patient::count())
                ->description('Total registered patients')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Total Appointments', Appointment::count())
                ->description('All time appointments')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary'),

            Stat::make('Stock Alerts', InventoryItem::whereColumn('available_quantity', '<=', 'min_threshold')->count())
                ->description('Items below minimum threshold')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('warning'),

            Stat::make('Pending Consents', Consent::where('status', 'pending')->count())
                ->description('Consents awaiting signature')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('danger'),
        ];
    }
}
