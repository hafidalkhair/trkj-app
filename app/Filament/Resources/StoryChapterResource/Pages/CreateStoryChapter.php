<?php

namespace App\Filament\Resources\StoryChapterResource\Pages;

use App\Filament\Resources\StoryChapterResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Alignment;

class CreateStoryChapter extends CreateRecord
{
    protected static string $resource = StoryChapterResource::class;

    public function getFormActionsAlignment(): Alignment
    {
        return Alignment::Right;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
