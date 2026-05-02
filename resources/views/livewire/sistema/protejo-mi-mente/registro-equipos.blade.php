<section class="w-full">

    {{-- ENCABEZADO --}}
    <div class="flex justify-between items-center mb-6">
        <flux:heading size="xl">Registro de Equipos</flux:heading>

        <flux:button variant="primary" wire:click="openCreateModal" icon="plus">
            Agregar
        </flux:button>
    </div>

    {{-- TABLA --}}
    <x-data-table :headers="$this->headers" :rows="$this->rows">

        @interact('nombre', $row)
            <div class="flex items-center gap-2">
                <flux:icon name="users" class="size-4 text-blue-500" />
                <span class="font-semibold">{{ $row->nombre }}</span>
            </div>
        @endinteract

        @interact('torneo', $row)
            <div class="text-sm text-gray-600">
                {{ $row->torneo?->nombre ?? 'N/A' }}
            </div>
        @endinteract

        @interact('actions', $row)
            <flux:dropdown>
                <flux:button size="sm" icon="ellipsis-vertical" variant="ghost" />
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

    {{-- MODAL FORM --}}
    <flux:modal name="equipo-form" class="min-w-[28rem]">
        <div class="space-y-5">

            <flux:heading size="lg">
                {{ $equipo_id ? 'Editar Equipo' : 'Nuevo Equipo' }}
            </flux:heading>

            <flux:input label="Nombre del equipo" wire:model="nombre" />

            <flux:select label="Torneo" wire:model="torneo_id">
                <flux:select.option value="">Seleccionar</flux:select.option>

                @foreach ($this->torneos as $torneo)
                    <flux:select.option value="{{ $torneo->id }}">
                        {{ $torneo->nombre }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <div class="flex justify-end gap-2">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>

                <flux:button wire:click="{{ $equipo_id ? 'update' : 'save' }}" variant="primary">
                    {{ $equipo_id ? 'Actualizar' : 'Guardar' }}
                </flux:button>
            </div>

        </div>
    </flux:modal>

    {{-- MODAL DELETE --}}
    <flux:modal name="confirm-delete">
        <div class="space-y-4">

            <flux:heading size="lg">Confirmar eliminación</flux:heading>

            <p>
                ¿Eliminar equipo <strong>{{ $equipoToDelete?->nombre }}</strong>?
            </p>

            <div class="flex justify-end gap-2">
                <flux:modal.close>
                    <flux:button variant="ghost">No</flux:button>
                </flux:modal.close>

                <flux:button variant="danger" wire:click="destroy">
                    Sí, eliminar
                </flux:button>
            </div>

        </div>
    </flux:modal>

</section>
