<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsLetterResource\Pages;
use App\Jobs\PublishNewsLetterJob;
use App\Models\NewsLetter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

final class NewsLetterResource extends Resource
{
    protected static ?string $model = NewsLetter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('email_list_id')
                    ->relationship('emailList', 'name')
                    ->required(),
                Forms\Components\TextInput::make('subject')
                    ->required(),
                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('emailList.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subscribers')
                    ->label('Subscribers')
                    ->getStateUsing(fn ($record) => $record->subscriptions->count()),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
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
                Tables\Actions\Action::make('publish')
                    ->label('Publish')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(function (NewsLetter $record) {
                        dispatch(new PublishNewsLetterJob($record));
                        $record->update(['published_at' => now()]);
                    })
                    ->requiresConfirmation()
                    ->visible(fn (NewsLetter $record) => $record->published_at === null),
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
            'index' => Pages\ListNewsLetters::route('/'),
            'create' => Pages\CreateNewsLetter::route('/create'),
            'view' => Pages\ViewNewsLetter::route('/{record}'),
            'edit' => Pages\EditNewsLetter::route('/{record}/edit'),
        ];
    }
}
