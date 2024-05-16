<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Main Section')->schema([

                    TextInput::make('title')
                    ->live()
                    ->required()
                    ->afterStateUpdated(function(string $operation, $state, Forms\Set $set ){
                        // dd($operation);
                        // if i am in edit page then do not change the slug
                        // so if edit page return nothing
                        if ($operation === 'edit') {
                            return;
                        }
                        // but if create page then add slug as title
                        $set('slug', Str::slug($state));
                    })
                    ,
                    TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord:true),

                    RichEditor::make('content')
                    ->required()
                    ->fileAttachmentsDirectory('posts/images')
                    ->columnSpanFull()

                ])->columns(2),

                Section::make('Other Section')->schema([
                    FileUpload::make('image')
                    ->image()
                    ->directory('posts/thumb'),
                    DateTimePicker::make('published_at')->nullable(),
                    Checkbox::make('featured'),
                    Select::make('author')
                    ->relationship('author', 'name')
                    ->required()
                    ->preload()
                    ->searchable(),
                    Select::make('categories')
                    ->relationship('categories', 'title')
                    ->multiple()
                    ->required()
                    ->preload()
                    ->searchable(),

                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('slug')->searchable()->sortable(),
                TextColumn::make('author.name')->searchable()->sortable(),
                TextColumn::make('published_at')->date('Y-m-d')->sortable(),
                CheckboxColumn::make('featured')
                
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
