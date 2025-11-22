<?php

namespace App\Filament\Resources\MemberResource\Pages;

use App\Filament\Resources\MemberResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Alignment;

class CreateMember extends CreateRecord
{
    protected static string $resource = MemberResource::class;

    public function getFormActionsAlignment(): Alignment
    {
        return Alignment::Right;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
