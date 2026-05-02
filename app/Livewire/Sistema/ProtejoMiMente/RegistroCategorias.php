<?php

namespace App\Livewire\Sistema\ProtejoMiMente;

use App\Models\ProtejoMiMente\Categoria;
use App\Traits\DataTable;
use App\Traits\Interact;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Component;

class RegistroCategorias extends Component
{
    use DataTable, Interact;

    public array $headers = [
        ['index' => 'id', 'label' => '#', 'align' => 'center'],
        ['index' => 'nombre', 'label' => 'Nombre'],
        ['index' => 'actions', 'label' => ''],
    ];

    public $nombre;
    public $categoria_id;
    public $deleteTarget;

    // ======================
    // TABLE
    // ======================
    #[Computed]
    public function rows()
    {
        return Categoria::query()
            ->when($this->search, function ($q) {
                $q->where('nombre', 'like', "%{$this->search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate($this->per_page);
    }

    public function render()
    {
        return view('livewire.sistema.protejo-mi-mente.registro-categorias');
    }

    // ======================
    // CREATE
    // ======================
    public function openCreateModal()
    {
        $this->resetForm();
        Flux::modal('form')->show();
    }

    public function save()
    {
        $this->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
        ], [
            'nombre.unique' => 'Esta categoría ya existe',
        ]);

        Categoria::create([
            'nombre' => trim($this->nombre),
        ]);

        $this->toastSuccess('Categoría creada');
        Flux::modals()->close();
        $this->resetForm();
    }

    // ======================
    // EDIT
    // ======================
    public function edit($id)
    {
        $c = Categoria::findOrFail($id);

        $this->categoria_id = $c->id;
        $this->nombre = $c->nombre;

        Flux::modal('form')->show();
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $this->categoria_id,
        ], [
            'nombre.unique' => 'Esta categoría ya existe',
        ]);

        $c = Categoria::findOrFail($this->categoria_id);

        $c->update([
            'nombre' => trim($this->nombre),
        ]);

        $this->toastSuccess('Categoría actualizada');
        Flux::modals()->close();
        $this->resetForm();
    }

    // ======================
    // DELETE
    // ======================
    public function confirmDelete($id)
    {
        $this->deleteTarget = Categoria::findOrFail($id);
        Flux::modal('delete')->show();
    }

    public function destroy()
    {
        $this->deleteTarget->delete();

        $this->toastWarning('Categoría eliminada');
        Flux::modals()->close();
    }

    // ======================
    // RESET
    // ======================
    public function resetForm()
    {
        $this->reset([
            'nombre',
            'categoria_id'
        ]);
    }
}