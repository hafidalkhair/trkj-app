<?php

namespace App\Filament\Resources\StoryChapterResource\Pages;

use App\Filament\Resources\StoryChapterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStoryChapter extends EditRecord
{
    protected static string $resource = StoryChapterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Kembali')
                ->url($this->getResource()::getUrl('index'))
                ->color('gray')
                ->icon('heroicon-o-arrow-left'),

            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
