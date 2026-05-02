<section class="w-full">

    {{-- ENCABEZADO --}}
    <div class="flex justify-between items-center mb-6">
        <flux:heading size="xl">Registro de Torneos</flux:heading>

        <flux:button variant="primary" wire:click="openCreateModal" icon="plus">
            Agregar
        </flux:button>
    </div>

    {{-- TABLA --}}
    <x-data-table :headers="$this->headers" :rows="$this->rows">

        @interact('nombre', $row)
            <div class="flex items-center gap-2">
                <flux:icon name="trophy" class="size-4 text-yellow-500" />
                <span class="font-semibold">{{ $row->nombre }}</span>
            </div>
        @endinteract

        @interact('fechas', $row)
            <div class="text-xs text-gray-500">
                {{ \Carbon\Carbon::parse($row->fecha_inicio)->format('d M Y') }}
                -
                {{ \Carbon\Carbon::parse($row->fecha_fin)->format('d M Y') }}
            </div>
        @endinteract

        @interact('lugar', $row)
            <span class="text-sm">{{ $row->lugar }}</span>
        @endinteract

        {{-- ✅ TIPO --}}
        @interact('tipo', $row)
            @if ($row->tipo === 'interno')
                <flux:badge color="green" size="sm">🏠 Interno</flux:badge>
            @else
                <flux:badge color="blue" size="sm">🌎 Externo</flux:badge>
            @endif
        @endinteract

        @interact('actions', $row)
            <flux:dropdown>
                <flux:button size="sm" icon="ellipsis-vertical" variant="ghost" />
                <flux:menu>
                    <flux:menu.item icon="eye" wire:click="view({{ $row->id }})">
                        Ver
                    </flux:menu.item>

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
    <flux:modal name="torneo-form" class="min-w-[30rem]">
        <div class="space-y-6">

            <flux:heading size="lg">
                {{ $torneo_id ? 'Editar Torneo' : 'Nuevo Torneo' }}
            </flux:heading>

            <flux:input label="Nombre" wire:model="nombre" />
            <flux:textarea label="Descripción" wire:model="descripcion" />

            <div class="grid grid-cols-2 gap-4">
                <flux:input type="date" label="Fecha inicio" wire:model="fecha_inicio" />
                <flux:input type="date" label="Fecha fin" wire:model="fecha_fin" />
            </div>

            <flux:input label="Lugar" wire:model="lugar" />

            {{-- ✅ SELECT TIPO --}}
            <flux:select label="Tipo de torneo" wire:model="tipo">
                <flux:select.option value="interno">🏠 Interno</flux:select.option>
                <flux:select.option value="externo">🌎 Externo</flux:select.option>
            </flux:select>

            <div class="flex justify-end gap-2">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>

                <flux:button wire:click="{{ $torneo_id ? 'update' : 'save' }}" variant="primary">
                    {{ $torneo_id ? 'Actualizar' : 'Guardar' }}
                </flux:button>
            </div>

        </div>
    </flux:modal>

    {{-- MODAL VER --}}
    <flux:modal name="view-torneo">
        <div class="space-y-4">

            <flux:heading size="lg">{{ $selectedTorneo?->nombre }}</flux:heading>

            <p>{{ $selectedTorneo?->descripcion }}</p>

            <p class="text-sm text-gray-500">
                {{ $selectedTorneo?->lugar }}
            </p>

            {{-- ✅ TIPO --}}
            <p class="text-sm">
                <strong>Tipo:</strong>
                @if ($selectedTorneo?->tipo === 'interno')
                    🏠 Interno
                @else
                    🌎 Externo
                @endif
            </p>

        </div>
    </flux:modal>

    {{-- MODAL DELETE --}}
    <flux:modal name="confirm-delete">
        <div class="space-y-4">

            <flux:heading size="lg">Confirmar eliminación</flux:heading>

            <p>
                ¿Eliminar torneo
                <strong>{{ $torneoToDelete?->nombre }}</strong>?
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