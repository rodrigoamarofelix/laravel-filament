<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Collection;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Filters\SelectFilter;

use function Livewire\after;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    public static function getNavigationLabel(): string
    {
        return 'Usuários';
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationBadgeTooltip = 'Número de usuários';
    protected static ?string $navigationGroup = 'Administração';
    protected static ?string $slug = 'usuario';
    protected static ?string $modelLabel = 'usuário';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->autofocus(),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Toggle::make('is_active')->label('Status'),
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Select::make('roles')
                        ->multiple()
                        ->relationship('roles', 'name')
                        ->preload()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Nome'),
                Tables\Columns\TextColumn::make('email')
                    ->sortable()
                    ->searchable()
                    ->label('E-mail'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Status'),
                Tables\Columns\ToggleColumn::make('is_active')->label('Editar Status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:m')
                    ->sortable()
                    ->label('Data de criação'),
            ])
            ->filters([
               /*  SelectFilter::make('is_active')->options([
                    true => "Ativo",
                    false => "Inativo"
                ])
                    ->label('Status')
                    ->default(true) */
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    BulkAction::make('Desabilitar usuário')
                        ->requiresConfirmation()
                        ->color('warning')
                        ->icon('heroicon-o-x-circle')
                        ->action(fn (Collection $records) => $records->each->update(['is_active' => false]))
                        ->deselectRecordsAfterCompletion()
                        ->after(fn () => Notification::make()->title('Usuário(s) desabilitaado(s) com sucesso')->success()->send()),

                ]),

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
