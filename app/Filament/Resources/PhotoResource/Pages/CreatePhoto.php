<?php

namespace App\Filament\Resources\PhotoResource\Pages;

use App\Filament\Resources\PhotoResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Alignment; // 1. Wajib import ini

class CreatePhoto extends CreateRecord
{
    protected static string $resource = PhotoResource::class;

    // 2. Memindahkan tombol Create ke Kanan
    public function getFormActionsAlignment(): Alignment
    {
        return Alignment::Right;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
