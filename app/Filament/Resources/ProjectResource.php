<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Project;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProjectResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProjectResource\RelationManagers;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('project_name_en')
                    ->label('Project Name')
                    ->placeholder('Project Name')
                    ->required()
                    ->autofocus(),
                TextInput::make('project_name_it')
                    ->label('Nome del progetto')
                    ->placeholder('Nome del progetto')
                    ->required()
                    ->autofocus(),
                TextInput::make('project_name_id')
                    ->label('Nama Proyek')
                    ->placeholder('Nama Proyek')
                    ->required()
                    ->autofocus(),

                Textarea::make('description_en')
                    ->label('Project Description')
                    ->placeholder('Project Description')
                    ->required(),
                Textarea::make('description_it')
                    ->label('Descrizione del progetto')
                    ->placeholder('Descrizione del progetto')
                    ->required(),
                Textarea::make('description_id')
                    ->label('Deskripsi Proyek')
                    ->placeholder('Deskripsi Proyek')
                    ->required(),

                TextInput::make('location_en')
                    ->label('Location')
                    ->placeholder('Location')
                    ->required(),
                TextInput::make('location_it')
                    ->label('Posizione')
                    ->placeholder('Posizione')
                    ->required(),
                TextInput::make('location_id')
                    ->label('Lokasi')
                    ->placeholder('Lokasi')
                    ->required(),
                DatePicker::make('year')
                    ->label('Year')
                    ->required(),
                Select::make('category_en')
                    ->label('Category')
                    ->placeholder('Category')
                    ->options([
                        'architecture' => 'Architecture',
                        'interior' => 'Interior',
                        'foundation projects' => 'Foundation Projects',
                        'building performance' => 'Building Performance',
                    ])
                    ->required(),
                Select::make('category_it')
                    ->label('Categoria')
                    ->placeholder('Categoria')
                    ->options([
                        'architettura' => 'Architettura',
                        'interna' => 'Interna',
                        'progetti di fondazione' => 'Progetti Di Fondazione',
                        "prestazioni dell\'edificio" => "Prestazioni Dell\'edificio",
                    ])
                    ->required(),
                Select::make('category_id')
                    ->label('Kategori')
                    ->placeholder('Kategori')
                    ->options([
                        'arsitektur' => 'Arsitektur',
                        'interior' => 'Interior',
                        'proyek pondasi' => 'Proyek Pondasi',
                        'kinerja bangunan' => 'Kinerja Bangunan',
                    ])
                    ->required(),
                TextInput::make('size_en')
                    ->label('Size')
                    ->placeholder('Size')
                    ->required(),
                TextInput::make('size_it')
                    ->label('Misurare')
                    ->placeholder('Misurare')
                    ->required(),
                TextInput::make('size_id')
                    ->label('Ukuran')
                    ->placeholder('Ukuran')
                    ->required(),
                TextInput::make('status_en')
                    ->label('Status')
                    ->placeholder('Status')
                    ->required(),
                TextInput::make('status_it')
                    ->label('Stato')
                    ->placeholder('Stato')
                    ->required(),
                TextInput::make('status_id')
                    ->label('Status')
                    ->placeholder('Status')
                    ->required(),


                // Select::make('status')
                //     ->label('Status')
                //     ->placeholder('Status')
                //     ->options([
                //         'under construction' => 'Under Construction',
                //         'concept' => 'Concept',
                //         'done' => 'Done',
                //     ])
                //     ->required(),



                TextInput::make('client')
                    ->label('Client')
                    ->placeholder('Client')
                    ->required(),
                FileUpload::make('gambar')
                    ->label('Image')
                    ->visibility('public')
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project_name')
                    ->label('Project Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('location')
                    ->label('Location')
                    ->searchable()
                    ->sortable(),
                BadgeColumn::make('category')
                    ->label('Category')
                    ->colors([
                        'primary' => 'architecture',
                        'secondary' => 'interior',
                        'success' => 'foundation projects',
                        'danger' => 'building performance',
                    ]),
                TextColumn::make('client')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->searchable()
                    ->sortable(),






                TextColumn::make('year')
                    ->label('Year')
                    ->sortable(),
                ImageColumn::make('gambar')
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
