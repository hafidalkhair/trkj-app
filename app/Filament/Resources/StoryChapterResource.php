<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoryChapterResource\Pages;
use App\Models\StoryChapter;
use App\Support\ImageOptimizer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class StoryChapterResource extends Resource
{
    protected static ?string $model = StoryChapter::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Cerita Beranda';
    protected static ?string $navigationGroup = 'Manajemen Galeri';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Babak Cerita')
                    ->description('Ditampilkan berurutan di halaman utama sebagai cerita bersambung saat pengunjung scroll ke bawah.')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Semester 1'),

                        Forms\Components\Textarea::make('text')
                            ->label('Teks Cerita')
                            ->required()
                            ->rows(4)
                            ->placeholder('Ceritakan momen di babak ini secara singkat...'),

                        Forms\Components\FileUpload::make('image')
                            ->label('Foto Latar')
                            ->image()
                            ->required()
                            ->directory('story-chapters')
                            ->imageEditor()
                            ->columnSpanFull()
                            ->downloadable()
                            ->openable()
                            // Konversi otomatis ke WebP agar halaman lebih ringan.
                            ->saveUploadedFileUsing(
                                fn (TemporaryUploadedFile $file): string => ImageOptimizer::storeAsWebp($file, 'story-chapters')
                            ),

                        Forms\Components\TextInput::make('display_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka lebih kecil tampil duluan. Bisa juga diurutkan lewat drag & drop di tabel.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->square()
                    ->size(60),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('text')
                    ->label('Teks')
                    ->limit(50)
                    ->tooltip(fn (StoryChapter $record): string => $record->text),

                Tables\Columns\TextColumn::make('display_order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->reorderable('display_order')
            ->defaultSort('display_order', 'asc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada babak cerita')
            ->emptyStateDescription('Tambahkan babak cerita untuk menampilkan section cerita di halaman utama.');
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
            'index' => Pages\ListStoryChapters::route('/'),
            'create' => Pages\CreateStoryChapter::route('/create'),
            'edit' => Pages\EditStoryChapter::route('/{record}/edit'),
        ];
    }
}
