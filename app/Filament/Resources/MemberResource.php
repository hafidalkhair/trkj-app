<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Anggota Kelas';
    protected static ?string $navigationGroup = 'Manajemen Anggota'; // Grup baru khusus anggota
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 1. Bagian Kiri: Data Utama & Foto
                Grid::make(3)->schema([

                    // Kolom Utama (2/3 lebar)
                    Section::make('Informasi Pribadi')
                        ->description('Data utama anggota kelas.')
                        ->schema([
                            Grid::make(2)->schema([
                                Forms\Components\TextInput::make('full_name')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('nim')
                                    ->label('NIM')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),
                            ]),

                            Grid::make(2)->schema([
                                Forms\Components\Select::make('position')
                                    ->label('Jabatan')
                                    ->options([
                                        'komisaris' => 'Komisaris',
                                        'bendahara' => 'Bendahara',
                                        'sekretaris' => 'Sekretaris',
                                        'anggota' => 'Anggota',
                                    ])
                                    ->required()
                                    ->native(false), // Tampilan dropdown lebih modern

                                Forms\Components\TextInput::make('study_program')
                                    ->label('Program Studi')
                                    ->required()
                                    ->maxLength(255)
                            ]),

                            Grid::make(2)->schema([
                                Forms\Components\TextInput::make('status')
                                    ->label('Status / Motto Singkat')
                                    ->placeholder('Contoh: Open for work')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('display_order')
                                    ->label('Urutan Tampil')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Angka lebih kecil tampil duluan.'),
                            ]),

                            Forms\Components\Textarea::make('favorite_quote')
                                ->label('Quote Favorit')
                                ->rows(2)
                                ->maxLength(65535)
                                ->columnSpanFull(),
                        ])->columnSpan(2),

                    // Kolom Samping (1/3 lebar)
                    Section::make('Profil & Sosmed')
                        ->schema([
                            Forms\Components\FileUpload::make('profile_image')
                                ->label('Foto Profil')
                                ->image()
                                ->directory('profile-images')
                                ->imageEditor() // Fitur crop
                                ->imageEditorAspectRatios(['1:1']) // Paksa rasio persegi
                                ->maxSize(5120)
                                ->columnSpanFull(),

                            Forms\Components\Textarea::make('hobbies')
                                ->label('Hobi')
                                ->rows(3)
                                ->maxLength(65535),

                            Forms\Components\KeyValue::make('social_media_links')
                                ->label('Media Sosial')
                                ->keyLabel('Platform (Instagram, dll)')
                                ->valueLabel('Link / Username')
                                ->addActionLabel('Tambah Sosmed'),
                        ])->columnSpan(1),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_image')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-avatar.png')),

                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('nim')
                    ->label('NIM')
                    ->copyable() // Bisa di-copy saat diklik
                    ->searchable(),

                Tables\Columns\TextColumn::make('position')
                    ->label('Jabatan')
                    ->badge() // Tampil sebagai Badge
                    ->color(fn (string $state): string => match ($state) {
                        'komisaris' => 'danger',   // Merah
                        'bendahara' => 'warning',  // Kuning
                        'sekretaris' => 'info',    // Biru
                        'anggota' => 'success',    // Hijau
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)) // Huruf depan besar
                    ->sortable(),

                Tables\Columns\TextColumn::make('study_program')
                    ->label('Prodi')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('display_order')
                    ->label('Urutan')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('position')
                    ->label('Filter Jabatan')
                    ->options([
                        'komisaris' => 'Komisaris',
                        'bendahara' => 'Bendahara',
                        'sekretaris' => 'Sekretaris',
                        'anggota' => 'Anggota',
                    ]),
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
            ->defaultSort('display_order', 'asc');
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
