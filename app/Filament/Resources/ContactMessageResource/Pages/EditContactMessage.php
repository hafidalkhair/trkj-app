<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Alignment;

class EditContactMessage extends EditRecord
{
    protected static string $resource = ContactMessageResource::class;

    // --- INI KUNCINYA ---
    // Fungsi ini jalan otomatis saat halaman baru dibuka
    protected function beforeFill(): void
    {
        // Cek data yang sedang dibuka (getRecord)
        // Jika is_read masih false (0), ubah jadi true (1)
        if (! $this->getRecord()->is_read) {
            $this->getRecord()->update(['is_read' => true]);

            // Opsional: Kirim notifikasi kecil di pojok kanan atas
            // Notification::make()->title('Pesan ditandai sudah dibaca')->success()->send();
        }
    }
    // ---------------------

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

    public function getFormActionsAlignment(): Alignment
    {
        return Alignment::Right;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
