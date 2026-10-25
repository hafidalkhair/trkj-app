<?php

namespace App\Filament\Resources\StoryChapterResource\Pages;

use App\Filament\Resources\StoryChapterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStoryChapters extends ListRecords
{
    protected static string $resource = StoryChapterResource::class;

    public function getTitle(): string
    {
        return 'Cerita Beranda';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('view_home')
                ->label('Lihat Beranda')
                ->icon('heroicon-o-globe-alt')
                ->url(route('home'))
                ->openUrlInNewTab()
                ->color('gray'),

            Actions\CreateAction::make()
                ->label('Tambah Babak'),
        ];
    }
}
