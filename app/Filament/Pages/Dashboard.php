<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\FinancialAnalyticalWidget;
use App\Filament\Widgets\QuickStatsWidget;
use App\Filament\Widgets\TodaysAppointmentsTable;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            FinancialAnalyticalWidget::class,
            QuickStatsWidget::class,
            TodaysAppointmentsTable::class,
        ];
    }


}
