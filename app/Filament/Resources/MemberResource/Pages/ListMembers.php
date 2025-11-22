<?php

namespace App\Filament\Resources\MemberResource\Pages;

use App\Filament\Resources\MemberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMembers extends ListRecords
{
    protected static string $resource = MemberResource::class;

    public function getTitle(): string
    {
        return 'Daftar Anggota';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('view_structure')
                ->label('Lihat Struktur Web')
                ->icon('heroicon-o-globe-alt')
                ->url(route('structure')) // Pastikan route 'structure' ada
                ->openUrlInNewTab()
                ->color('gray'),

            Actions\CreateAction::make()
                ->label('Tambah Anggota')
                ->icon('heroicon-o-user-plus'),
        ];
    }
}
