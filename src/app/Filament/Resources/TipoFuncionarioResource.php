<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipoFuncionarioResource\Pages;
use App\Filament\Resources\TipoFuncionarioResource\RelationManagers;
use App\Models\TipoFuncionario;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipoFuncionarioResource extends Resource
{
    protected static ?string $model = TipoFuncionario::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    public static function getNavigationLabel(): string
    {
        return 'Tipo de Funcionário';
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationBadgeTooltip = 'Número de tipo de funcionário';
    protected static ?string $navigationGroup = 'Administração';
    protected static ?string $slug = 'tipo_funcionario';
    protected static ?string $modelLabel = 'Tipo de Funcionario';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make([
                Forms\Components\TextInput::make('Descrição')
                    ->required()
                    ->maxLength(150)
                    ->autofocus(),
                Toggle::make('is_active')->label('Status'),


            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ds_tipo')
                    ->sortable()
                    ->searchable()
                    ->label('Descrição'),
                Tables\Columns\ToggleColumn::make('is_active')->label('Editar Status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:m')
                    ->sortable()
                    ->label('Data de criação'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTipoFuncionarios::route('/'),
        ];
    }
}
