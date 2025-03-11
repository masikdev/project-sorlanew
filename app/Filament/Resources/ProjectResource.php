<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Project;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Helpers\TranslationHelper;
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
                Forms\Components\Section::make('Project Names')
                    ->schema([
                        TextInput::make('project_name_en')
                            ->label('Project Name')
                            ->placeholder('Project Name')
                            ->required()
                            ->autofocus()
                            ->live(debounce: 1000)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('project_name_it', TranslationHelper::translateText($state, 'it'));
                                $set('project_name_id', TranslationHelper::translateText($state, 'id'));
                            }),

                        TextInput::make('project_name_it')
                            ->label('Nome del progetto')
                            ->placeholder('Nome del progetto'),

                        TextInput::make('project_name_id')
                            ->label('Nama Proyek')
                            ->placeholder('Nama Proyek'),
                    ])->columns(3),

                Forms\Components\Section::make('Project Descriptions')
                    ->schema([
                        Textarea::make('description_en')
                            ->label('Project Description')
                            ->placeholder('Project Description')
                            ->required()
                            ->live(debounce: 1000)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('description_it', TranslationHelper::translateText($state, 'it'));
                                $set('description_id', TranslationHelper::translateText($state, 'id'));
                            }),
                        Textarea::make('description_it')
                            ->label('Descrizione del progetto')
                            ->placeholder('Descrizione del progetto'),
                        Textarea::make('description_id')
                            ->label('Deskripsi Proyek')
                            ->placeholder('Deskripsi Proyek'),
                    ]),

                Forms\Components\Section::make('Project Locations')
                    ->schema([
                        TextInput::make('location_en')
                            ->label('Location')
                            ->placeholder('Location')
                            ->required()
                            ->live(debounce: 1000)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('location_it', TranslationHelper::translateText($state, 'it'));
                                $set('location_id', TranslationHelper::translateText($state, 'id'));
                            }),
                        TextInput::make('location_it')
                            ->label('Posizione')
                            ->placeholder('Posizione'),
                        TextInput::make('location_id')
                            ->label('Lokasi')
                            ->placeholder('Lokasi'),
                    ])->columns(3),

                Forms\Components\Section::make('Project Categories')
                    ->schema([
                        Select::make('category_en')
                            ->label('Category')
                            ->placeholder('Category')
                            ->options([
                                // 'architecture' => 'Architecture',
                                // 'interior' => 'Interior',
                                // 'foundation projects' => 'Foundation Projects',
                                // 'building performance' => 'Building Performance',
                                'hospitality' => 'Hospitality',
                                'residential' => 'Residential',
                                'interior design' => 'Interior Design',
                                'cultural' => 'Cultural',
                                'commercial' => 'Commercial',
                                'recreational' => 'Recreational',
                            ])
                            ->required()
                            ->live(debounce: 1000)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('category_it', TranslationHelper::translateText($state, 'it'));
                                $set('category_id', TranslationHelper::translateText($state, 'id'));
                            }),
                        TextInput::make('category_it')
                            ->label('Categoria')
                            ->placeholder('Categoria'),
                        TextInput::make('category_id')
                            ->label('Kategori')
                            ->placeholder('Kategori'),
                    ])->columns(3),

                Forms\Components\Section::make('Project Information')
                    ->schema([
                        DatePicker::make('year')
                            ->label('Year')
                            ->native(false),
                        TextInput::make('size_en')
                            ->label('Size')
                            ->placeholder('Size')
                            ->required()
                            ->prefix('m2')
                            ->live(debounce: 1000)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('size_it', TranslationHelper::translateText($state, 'it'));
                                $set('size_id', TranslationHelper::translateText($state, 'id'));
                            }),
                        TextInput::make('status_en')
                            ->label('Status')
                            ->placeholder('Status')
                            ->required()
                            ->live(debounce: 1000)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('status_it', TranslationHelper::translateText($state, 'it'));
                                $set('status_id', TranslationHelper::translateText($state, 'id'));
                            }),
                    ])->columns(3),

                // Forms\Components\Section::make('Project Status')
                //     ->schema([

                //         Hidden::make('status_it')
                //             ->label('Stato'),
                //         Hidden::make('status_id')
                //             ->label('Status'),
                //     ])->columns(3),

                Forms\Components\Section::make('Project Year')
                    ->schema([

                        TextInput::make('collaborattor')
                            ->label('Collaborattor')
                            ->placeholder('Collaborattor'),
                        TextInput::make('client')
                            ->label('Client')
                            ->placeholder('Client')
                            ->required(),
                    ])->columns(3),

                Forms\Components\Section::make('Project Image')
                    ->schema([
                        FileUpload::make('gambar')
                            ->label('Image')
                            ->visibility('public')
                            ->image()
                            ->required(),
                    ]),
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
