<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotoResource\Pages;
use App\Models\Photo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class PhotoResource extends Resource
{
    protected static ?string $model = Photo::class;

    // Mengubah ikon menjadi kamera
    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static ?string $navigationLabel = 'Foto';
    // PENTING: Samakan group ini dengan CategoryResource agar mereka menyatu di sidebar
    protected static ?string $navigationGroup = 'Manajemen Galeri';
    protected static ?int $navigationSort = 2; // Urutan ke-2 setelah Kategori

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Foto')
                    ->description('Upload foto kegiatan dan tentukan kategorinya.')
                    ->schema([
                        Grid::make(2)->schema([
                            // Kolom Kiri: Pilih Kategori
                            Forms\Components\Select::make('category_id')
                                ->label('Kategori')
                                ->relationship('category', 'name')
                                ->required()
                                ->searchable()
                                ->preload()
                                ->createOptionForm([ // Fitur keren: Buat kategori langsung dari sini
                                    Forms\Components\TextInput::make('name')
                                        ->required()
                                        ->maxLength(255),
                                ]),

                            // Kolom Kanan: Tanggal Kegiatan
                            Forms\Components\DatePicker::make('event_date')
                                ->label('Tanggal Kegiatan')
                                ->required() // Sebaiknya required agar timeline rapi
                                ->maxDate(now()) // Tidak boleh tanggal masa depan
                                ->native(false) // Menggunakan datepicker bawaan Filament (lebih bagus)
                                ->displayFormat('d/m/Y'),
                        ]),

                        Forms\Components\TextInput::make('caption')
                            ->label('Caption / Keterangan')
                            ->placeholder('Tulis keterangan singkat tentang foto ini...')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image_path')
                            ->label('File Foto')
                            ->image()
                            ->required()
                            ->directory('photos')
                            ->imageEditor() // Admin bisa crop/rotate gambar
                            ->columnSpanFull()
                            ->downloadable()
                            ->openable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Foto')
                    ->square()
                    ->size(60), // Ukuran thumbnail sedikit lebih besar

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge() // Tampil sebagai badge warna
                    ->color('info')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('caption')
                    ->label('Caption')
                    ->searchable()
                    ->limit(30)
                    ->tooltip(fn (Photo $record): string => $record->caption ?? ''), // Hover untuk lihat full caption

                Tables\Columns\TextColumn::make('event_date')
                    ->label('Tanggal')
                    ->date('d M Y') // Format: 22 Nov 2025
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Filter Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\Filter::make('event_date')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('until')->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['from'],
                                fn($query) => $query->whereDate('event_date', '>=', $data['from'])
                            )
                            ->when(
                                $data['until'],
                                fn($query) => $query->whereDate('event_date', '<=', $data['until'])
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('event_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhotos::route('/'),
            'create' => Pages\CreatePhoto::route('/create'),
            'edit' => Pages\EditPhoto::route('/{record}/edit'),
        ];
    }
}
