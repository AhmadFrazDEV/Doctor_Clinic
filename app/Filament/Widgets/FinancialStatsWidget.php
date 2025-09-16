<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use App\Models\Invoice;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FinancialStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $revenue = Invoice::whereNotNull('payment_method')->sum('total_amount');
        $expenses = Expense::sum('amount');
        $outstanding = Invoice::whereNull('payment_method')->sum('total_amount');

        return [
            Stat::make('Revenue', '₦' . number_format($revenue, 2))
                ->description('Total revenue from paid invoices')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),

            Stat::make('Expenses', '₦' . number_format($expenses, 2))
                ->description('Total expenses incurred')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),

            Stat::make('Outstanding', '₦' . number_format($outstanding, 2))
                ->description('Unpaid invoice amounts')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }
}
