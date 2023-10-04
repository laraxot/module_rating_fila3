<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Modules\Rating\Models\Rating;
use Modules\Rating\Enums\RuleEnum;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\ColorPicker;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Modules\Rating\Filament\Resources\RatingResource\Pages;

class RatingResource extends XotBaseResource
{
    protected static ?string $model = Rating::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('extra_attributes.type'),
                TextInput::make('extra_attributes.anno'),
                TextInput::make('title')->autofocus()->required(),
                ColorPicker::make('color'),
                // TextInput::make('icon')->autofocus()->required(),
                //Select::make('rule')->options(RuleEnum::class) ,
                Radio::make('rule')->options(RuleEnum::class),
                Section::make()
                ->schema([
                Toggle::make('is_disabled'),
                Toggle::make('is_readonly'),
                ])->columns(3),
                RichEditor::make('txt')->columnSpanFull(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('extra_attributes.type')->label('type'),
                TextColumn::make('extra_attributes.anno')->label('anno'),
                TextColumn::make('title'),
                TextColumn::make('rule')->badge(),
                //TextColumn::make('is_readonly'),
                //TextColumn::make('is_disabled'),
                //ToggleColumn::make('is_readonly'),
                IconColumn::make('is_disabled')->boolean(),
                IconColumn::make('is_readonly')->boolean(),
                // TextColumn::make('color'),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRatings::route('/'),
            'create' => Pages\CreateRating::route('/create'),
            'edit' => Pages\EditRating::route('/{record}/edit'),
        ];
    }
}