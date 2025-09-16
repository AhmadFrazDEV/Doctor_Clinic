<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Invoice;
use App\Models\Expense;

class FinancialAnalyticalWidget extends BaseWidget
{
    protected static ?int $sort = 1; // Optional: position on dashboard

    protected function getStats(): array
    {
        $revenue = Invoice::whereNotNull('payment_method')->sum('total_amount');
        $expenses = Expense::sum('amount');
        $outstanding = Invoice::whereNull('payment_method')->sum('total_amount');

        return [
            Stat::make('Revenue', '₦' . number_format($revenue, 2))
                ->description('Total from paid invoices')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Expenses', '₦' . number_format($expenses, 2))
                ->description('Total business expenses')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),

            Stat::make('Outstanding', '₦' . number_format($outstanding, 2))
                ->description('Unpaid invoice amounts')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }
}
