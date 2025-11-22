<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Resources\Pages\ListRecords;

class ListContactMessages extends ListRecords
{
    protected static string $resource = ContactMessageResource::class;

    public function getTitle(): string
    {
        return 'Kotak Masuk';
    }

    protected function getHeaderActions(): array
    {
        return [
            // Kosongkan array ini.
            // Actions\CreateAction::make(), <--- Hapus baris ini
        ];
    }
}
