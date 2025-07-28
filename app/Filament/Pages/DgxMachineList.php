<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Http;

class DgxMachineList extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dgx-machine-list';

    protected static ?string $navigationGroup = 'Facilities';

    public static function getNavigationLabel(): string
    {
        return 'Machine List';
    }

    public array $mesins = [];

    public function mount(): void
    {
        $response = Http::withoutVerifying()->get('https://api-dummy.hpc-hs.my.id/dgx/mesin');

        if ($response->ok() && isset($response['data'])) {
            $this->mesins = $response->json('data');
        }
    }
}
