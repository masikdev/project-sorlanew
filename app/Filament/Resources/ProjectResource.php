<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Project;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use App\Helpers\TranslationHelper;
use Filament\Forms\Components\Hidden;
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

    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $label = 'Projects';
    protected static ?string $navigationLabel = 'Project';



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
                                'Hospitality' => 'Hospitality',
                                'Residential' => 'Residential',
                                'Interior Design' => 'Interior Design',
                                'Cultural' => 'Cultural',
                                'Commercial' => 'Commercial',
                                'Recreational' => 'Recreational',
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
                            ->native(false)
                            ->format('Y')
                            ->displayFormat('Y'),
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
                        Hidden::make('size_it')
                            ->label('Dimensione'),
                        Hidden::make('size_id')
                            ->label('Ukuran'),
                        // Select::make('status_en')
                        //     ->label('Status')
                        //     ->placeholder('Status')
                        //     ->required()
                        //     ->options([
                        //         'completed' => 'Completed',
                        //         'on progress' => 'On Progress',
                        //         'planned' => 'Planned',
                        //     ])
                        //     ->live(debounce: 1000)
                        //     ->afterStateUpdated(function ($state, callable $set) {
                        //         $set('status_it', TranslationHelper::translateText($state, 'it'));
                        //         $set('status_id', TranslationHelper::translateText($state, 'id'));
                        //     }),
                        TextInput::make('status_en')
                            ->label('Status')
                            ->placeholder('Isi status (misalnya: Completed, On Progress, Planned)')
                            ->required()
                            ->datalist([
                                'Completed',
                                'On Progress',
                                'Planned',
                            ])
                            ->live(debounce: 1000)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('status_it', TranslationHelper::translateText($state, 'it'));
                                $set('status_id', TranslationHelper::translateText($state, 'id'));
                            }),
                        Hidden::make('status_it')
                            ->label('Stato'),
                        Hidden::make('status_id')
                            ->label('Status'),
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

                        TextInput::make('designer')
                            ->label('Designer')
                            ->placeholder('Designer'),
                        TextInput::make('client')
                            ->label('Client')
                            ->placeholder('Client'),
                    ])->columns(3),

                Forms\Components\Section::make('Project Image')
                    ->schema([
                        FileUpload::make('gambar')
                            ->label('Image')
                            ->disk('public')
                            ->visibility('public')
                            ->directory('projects-thumbnail')
                            ->getUploadedFileNameForStorageUsing(function ($file, $livewire) {
                                $projectName = $livewire->data['project_name_en'] ?? 'project';
                                $sluggedName = Str::slug($projectName);
                                $extension = $file->getClientOriginalExtension();
                        
                                return $sluggedName . '-' . now()->timestamp . '.' . $extension;
                            })
                            ->image(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_project')
                    ->label('ID')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('project_name_en')
                    ->label('Project Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('location_en')
                    ->label('Location')
                    ->searchable()
                    ->sortable(),
                BadgeColumn::make('category_en')
                    ->label('Category')
                    ->colors([
                        'Hospitality' => 'blue',
                        'Residential' => 'green',
                        'Interior Design' => 'yellow',
                        'Cultural' => 'purple',
                        'Commercial' => 'red',
                        'Recreational' => 'indigo',
                    ]),
                // TextColumn::make('client')
                //     ->label('Client')
                //     ->searchable()
                //     ->sortable(),
                // TextColumn::make('status_en')
                //     ->label('Status')
                //     ->searchable()
                //     ->sortable(),
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
                Tables\Actions\ViewAction::make(),
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
