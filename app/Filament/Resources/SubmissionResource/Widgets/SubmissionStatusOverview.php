<?php

namespace App\Filament\Resources\SubmissionResource\Widgets;

use App\Models\Submission;
use App\Models\Member;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;

class SubmissionStatusOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pending', Submission::where('status', 'pending')->count())
                    ->description('Menunggu review')
                    ->color('primary')
                    ->descriptionIcon('heroicon-m-clock', IconPosition::Before),

            Stat::make('Approved', Submission::where('status', 'approved')->count())
                    ->description('Disetujui')
                    ->color('success')
                    ->descriptionIcon('heroicon-m-check-circle', IconPosition::Before),

            Stat::make('Rejected', Submission::where('status', 'rejected')->count())
                    ->description('Ditolak')
                    ->color('danger')
                    ->descriptionIcon('heroicon-m-x-circle', IconPosition::Before),

            Stat::make('Members', Member::count())
                    ->description('Total member')
                    ->color('secondary')
                    ->descriptionIcon('heroicon-m-user-group', IconPosition::Before),
        ];
    }
    protected function getColumns(): int
    {
        return 4;
    }
}
