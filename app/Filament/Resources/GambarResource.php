<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GambarResource\Pages;
use App\Filament\Resources\GambarResource\RelationManagers;
use App\Models\Gambar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GambarResource extends Resource
{
    protected static ?string $model = Gambar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('id_project')
                            ->label('Project')
                            ->placeholder('Project')
                            ->relationship('project', 'project_name')
                            ->required(),
                        Forms\Components\TextInput::make('image_name')
                            ->label('Image Name')
                            ->placeholder('Image Name')
                            ->required(),
                        Forms\Components\FileUpload::make('image_desc')
                            ->label('Image')
                            ->image()
                            ->multiple()
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.project_name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('image_name')
                    ->label('Image Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image_desc')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGambars::route('/'),
            'create' => Pages\CreateGambar::route('/create'),
            'edit' => Pages\EditGambar::route('/{record}/edit'),
        ];
    }
}
