<?php

namespace App\Filament\Widgets;

use App\Models\Submission;
use App\Models\Member;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SubmissionStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Submissions', Submission::count()),
            Stat::make('Total Members', Member::count()),
            Stat::make('Approved Submissions', Submission::where('status', 'approved')->count()),
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }
}
