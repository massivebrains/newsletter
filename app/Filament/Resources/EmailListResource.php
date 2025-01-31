<?php

namespace App\Filament\Resources;

use App\Enums\EmailListStatusEnum;
use App\Enums\TemplateEnum;
use App\Filament\Resources\EmailListResource\Pages;
use App\Models\EmailList;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EmailListResource extends Resource
{
    protected static ?string $model = EmailList::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('description')
                    ->maxLength(255),

                Select::make('template')
                    ->label('Template')
                    ->required()
                    ->options(TemplateEnum::getAsOptions()),

                Select::make('status')
                    ->label('Status')
                    ->required()
                    ->options(EmailListStatusEnum::getAsOptions()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('template')
                    ->searchable()
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->badge(),
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
            'index' => Pages\ListEmailLists::route('/'),
            'create' => Pages\CreateEmailList::route('/create'),
            'view' => Pages\ViewEmailList::route('/{record}'),
            'edit' => Pages\EditEmailList::route('/{record}/edit'),
        ];
    }
}
