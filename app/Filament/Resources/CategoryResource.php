<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    // Mengganti icon agar lebih sesuai
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Kategori';
    protected static ?string $navigationGroup = 'Manajemen Galeri';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Membungkus input dalam Section agar ada background putih (Card)
                Section::make('Informasi Kategori')
                    ->description('Masukkan detail kategori foto di bawah ini.')
                    ->schema([
                        Grid::make(2)->schema([ // Membagi layout menjadi 2 kolom
                            Forms\Components\TextInput::make('name')
                                ->label('Nama Kategori')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Contoh: Kegiatan ')
                                ->columnSpan(1),

                            Forms\Components\Textarea::make('description')
                                ->label('Deskripsi Singkat')
                                ->placeholder('Jelaskan isi kategori ini...')
                                ->rows(3)
                                ->maxLength(65535)
                                ->columnSpan(1),
                        ]),

                        Forms\Components\FileUpload::make('cover_image')
                            ->label('Sampul Kategori')
                            ->image()
                            ->directory('category-covers')
                            ->imageEditor() // Fitur crop/resize gambar
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
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
                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('Sampul')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholder.png')), // Gambar default jika kosong

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'), // Menebalkan teks

                Tables\Columns\TextColumn::make('photos_count')
                    ->counts('photos')
                    ->label('Jumlah Foto')
                    ->badge() // Membuat tampilan seperti lencana
                    ->color(fn (string $state): string => match (true) {
                        $state > 10 => 'success', // Hijau jika > 10
                        $state > 0 => 'info',    // Biru jika ada foto
                        default => 'gray',       // Abu-abu jika 0
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y, H:i') // Format tanggal lebih rapi
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Anda bisa menambahkan filter di sini nanti
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
            ->emptyStateHeading('Belum ada kategori')
            ->emptyStateDescription('Buat kategori baru untuk mulai mengunggah foto.');
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
