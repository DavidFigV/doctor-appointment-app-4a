<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Patient;

class PatientTable extends DataTableComponent
{
    protected $model = Patient::class;

    //Define el modelo
    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        // Devuelve la relación con usuarios
        return Patient::query()->with('user');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "user.name")
                ->sortable(),
            Column::make('Email', 'user.email')
                ->sortable(),
            Column::make('Número de id', 'user.id_number')
                ->sortable(),
            Column::make('Teléfono', 'user.phone')
                ->sortable(),
            Column::make('Acciones')
                ->label(function($row){
                    return view('admin.Patients.actions',
                    ['patient' => $row]);
                })
        ];
    }
}
