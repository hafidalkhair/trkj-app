<?php

namespace App\Filament\Resources\PhotoResource\Pages;

use App\Filament\Resources\PhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPhotos extends ListRecords
{
    protected static string $resource = PhotoResource::class;

    // 1. Mengubah Judul Halaman
    public function getTitle(): string
    {
        return 'Daftar Foto';
    }

    protected function getHeaderActions(): array
    {
        return [
            // 2. Tombol Pintasan ke Galeri Web
            Actions\Action::make('view_gallery')
                ->label('Lihat Galeri Web')
                ->icon('heroicon-o-globe-alt')
                ->url(route('gallery'))
                ->openUrlInNewTab()
                ->color('gray'),

            // 3. Mempercantik Tombol Tambah
            Actions\CreateAction::make()
                ->label('Tambah Foto Baru')
                ->icon('heroicon-o-camera'), // Menggunakan ikon kamera
        ];
    }
}
