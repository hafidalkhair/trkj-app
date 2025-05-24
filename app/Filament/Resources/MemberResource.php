<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('full_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nim')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('position')
                    ->options([
                        'komisaris' => 'Komisaris',
                        'bendahara' => 'Bendahara',
                        'sekretaris' => 'Sekretaris',
                        'anggota' => 'Anggota',
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('profile_image')
                    ->image()
                    ->directory('profile-images')
                    ->maxSize(5120) // 5MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->disk('public')
                    ->visibility('public')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth('512')
                    ->imageResizeTargetHeight('512')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('study_program')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('hobbies')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('status')
                    ->maxLength(255),
                Forms\Components\KeyValue::make('social_media_links')
                    ->keyLabel('Platform')
                    ->valueLabel('URL')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('favorite_quote')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('display_order')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_image')
                    ->circular(),
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nim')
                    ->searchable(),
                Tables\Columns\SelectColumn::make('position')
                    ->options([
                        'komisaris' => 'Komisaris',
                        'bendahara' => 'Bendahara',
                        'sekretaris' => 'Sekretaris',
                        'anggota' => 'Anggota',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('study_program')
                    ->searchable(),
                Tables\Columns\TextColumn::make('display_order')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('position')
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
            ->defaultSort('display_order');
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
