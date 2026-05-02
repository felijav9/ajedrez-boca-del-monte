<section class="w-full">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <flux:heading size="xl">Categorías</flux:heading>

        <flux:button icon="plus" variant="primary" wire:click="openCreateModal">
            Agregar
        </flux:button>
    </div>

    {{-- TABLE --}}
    <x-data-table :headers="$this->headers" :rows="$this->rows">

        @interact('nombre', $row)
            <span class="font-semibold">
                {{ $row->nombre }}
            </span>
        @endinteract

        @interact('actions', $row)
            <flux:dropdown>
                <flux:button icon="ellipsis-vertical" size="sm" variant="ghost" />

                <flux:menu>
                    <flux:menu.item icon="pencil" wire:click="edit({{ $row->id }})">
                        Editar
                    </flux:menu.item>

                    <flux:menu.item icon="trash" variant="danger" wire:click="confirmDelete({{ $row->id }})">
                        Eliminar
                    </flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        @endinteract

    </x-data-table>

    {{-- FORM --}}
    <flux:modal name="form" class="min-w-[28rem]">

        <div class="space-y-4">

            <flux:heading size="lg">
                {{ $categoria_id ? 'Editar categoría' : 'Nueva categoría' }}
            </flux:heading>

            <flux:input
                wire:model.defer="nombre"
                label="Nombre"
                placeholder="Ej: Sub-12"
            />

            @error('nombre')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <div class="flex justify-end gap-2">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>

                <flux:button variant="primary" wire:click="{{ $categoria_id ? 'update' : 'save' }}">
                    Guardar
                </flux:button>
            </div>

        </div>

    </flux:modal>

    {{-- DELETE --}}
    <flux:modal name="delete">
        <div class="space-y-4">

            <flux:heading size="lg">Eliminar categoría</flux:heading>

            <p>¿Seguro que deseas eliminar esta categoría?</p>

            <div class="flex justify-end gap-2">

                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>

                <flux:button variant="danger" wire:click="destroy">
                    Eliminar
                </flux:button>

            </div>

        </div>
    </flux:modal>

</section>