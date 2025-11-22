<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Pesan Masuk';
    protected static ?string $navigationGroup = 'Manajemen Pesan';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)->schema([
                    // Bagian Kiri: Isi Pesan
                    Section::make('Isi Pesan')
                        ->schema([
                            Forms\Components\TextInput::make('subject')
                                ->label('Subjek')
                                ->disabled() // <--- Kunci input ini
                                ->dehydrated(false) // Agar data tidak dikirim ulang ke DB saat save
                                ->maxLength(255),

                            Forms\Components\Textarea::make('message')
                                ->label('Pesan')
                                ->disabled() // <--- Kunci input ini
                                ->dehydrated(false)
                                ->rows(10)
                                ->maxLength(65535),
                        ])->columnSpan(2),

                    // Bagian Kanan: Info Pengirim & Status
                    Forms\Components\Group::make()
                        ->schema([
                            Section::make('Detail Pengirim')
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->label('Nama Pengirim')
                                        ->disabled() // <--- Kunci input ini
                                        ->dehydrated(false),

                                    Forms\Components\TextInput::make('email')
                                        ->label('Alamat Email')
                                        ->email()
                                        ->disabled() // <--- Kunci input ini
                                        ->dehydrated(false)
                                        ->suffixIcon('heroicon-m-envelope'),
                                ]),

                            Section::make('Status & Moderasi')
                                ->description('Hanya bagian ini yang bisa diubah admin.')
                                ->schema([
                                    Forms\Components\Toggle::make('is_read')
                                        ->label('Sudah Dibaca')
                                        ->onColor('success')
                                        ->offColor('danger'),

                                    Forms\Components\Toggle::make('is_featured')
                                        ->label('Jadikan Testimoni')
                                        ->helperText('Jika aktif, pesan ini akan tampil di halaman depan web.')
                                        ->onColor('warning')
                                        ->offColor('gray'),
                                ]),
                        ])->columnSpan(1),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        // ... (Bagian Table sama persis seperti sebelumnya) ...
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Pengirim')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('subject')->label('Subjek')->limit(30),
                Tables\Columns\IconColumn::make('is_read')->boolean()->sortable(),
                Tables\Columns\ToggleColumn::make('is_featured')->label('Testimoni')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read'),
                Tables\Filters\TernaryFilter::make('is_featured'),
            ])
            ->actions([
                // Ubah label tombol dari 'Edit' menjadi 'Lihat' karena isinya read-only
                Tables\Actions\EditAction::make()->label('Lihat'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            // Kita hapus route 'create' agar admin tidak bisa buat pesan palsu
            // 'create' => Pages\CreateContactMessage::route('/create'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}
