<?php

namespace App\Filament\Resources\TipoFuncionarioResource\Pages;

use App\Filament\Resources\TipoFuncionarioResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;

class ManageTipoFuncionarios extends ManageRecords
{
    protected static string $resource = TipoFuncionarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Todos os tipos'),
            'active' => Tab::make('Usuários ativos')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', true)),
            'inactive' => Tab::make('Usuários Inativos')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', false)),
        ];
    }
}
