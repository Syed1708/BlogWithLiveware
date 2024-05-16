<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CategoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoryResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                ->unique(ignoreRecord:true)
                ,
                TextInput::make('text_color')->nullable(),
                TextInput::make('bg_color')->nullable(),
                TextInput::make('hover_color')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('slug')->searchable()->sortable(),
                // TextColumn::make('text_color')->searchable()->sortable(),
                // TextColumn::make('bg_color')->searchable()->sortable(),
                // TextColumn::make('hover_color')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
