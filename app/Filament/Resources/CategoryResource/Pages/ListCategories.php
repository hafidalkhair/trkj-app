<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    public function getTitle(): string
    {
        return 'Daftar Kategori';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('view_gallery')
                ->label('Lihat Galeri Web')
                ->icon('heroicon-o-globe-alt')
                ->url(route('gallery'))
                ->openUrlInNewTab()
                ->color('gray'),

            Actions\CreateAction::make()
                ->label('Buat Kategori Baru')
                ->icon('heroicon-o-plus'),
        ];
    }
}
