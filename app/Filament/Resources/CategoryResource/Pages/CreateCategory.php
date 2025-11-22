<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Alignment;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    // 1. Agar tombol ada di kanan
    public function getFormActionsAlignment(): Alignment
    {
        return Alignment::Right;
    }

    // 2. Agar setelah 'Create' langsung pindah ke Halaman List
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
