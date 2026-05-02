<section class="w-full">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <flux:heading size="xl">Jugadores en Torneos</flux:heading>

        <flux:button icon="plus" variant="primary" wire:click="openCreateModal">
            Agregar
        </flux:button>
    </div>

    {{-- TABLE --}}
    <x-data-table :headers="$this->headers" :rows="$this->rows">

        @interact('torneo', $row)
            <span class="font-semibold">
                {{ $row->torneo?->nombre }}
            </span>
        @endinteract

        @interact('jugador', $row)
            <span>
                {{ $row->jugador?->apellido }} {{ $row->jugador?->nombre }}
            </span>
        @endinteract

        @interact('equipo', $row)
            <span>
                {{ $row->equipo?->nombre ?? '-' }}
            </span>
        @endinteract

        @interact('categoria', $row)
            <span>
                {{ $row->categoria?->nombre ?? '-' }}
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
    <flux:modal name="form" class="min-w-[32rem]">

        <div class="space-y-4">

            <flux:heading size="lg">
                {{ $registro_id ? 'Editar' : 'Nuevo registro' }}
            </flux:heading>

            {{-- TORNEO --}}
            <flux:select wire:model="torneo_id" label="Torneo">
                <flux:select.option value="">Seleccionar</flux:select.option>
                @foreach ($this->torneos as $t)
                    <flux:select.option value="{{ $t->id }}">
                        {{ $t->nombre }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            {{-- JUGADOR --}}
            <flux:select wire:model="jugador_id" label="Jugador">
                <flux:select.option value="">Seleccionar</flux:select.option>
                @foreach ($this->jugadores as $j)
                    <flux:select.option value="{{ $j->id }}">
                        {{ $j->apellido }} {{ $j->nombre }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            {{-- EQUIPO (SIN "INDIVIDUAL") --}}
            <flux:select wire:model="equipo_id" label="Equipo">
                <flux:select.option value="">Seleccionar</flux:select.option>
                @foreach ($this->equipos as $e)
                    <flux:select.option value="{{ $e->id }}">
                        {{ $e->nombre }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            {{-- CATEGORIA --}}
            <flux:select wire:model="categoria_id" label="Categoría">
                <flux:select.option value="">Sin categoría</flux:select.option>
                @foreach ($this->categorias as $c)
                    <flux:select.option value="{{ $c->id }}">
                        {{ $c->nombre }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <div class="flex justify-end gap-2">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>

                <flux:button variant="primary" wire:click="{{ $registro_id ? 'update' : 'save' }}">
                    Guardar
                </flux:button>
            </div>

        </div>

    </flux:modal>

    {{-- DELETE --}}
    <flux:modal name="delete">
        <div class="space-y-4">

            <flux:heading size="lg">Eliminar registro</flux:heading>

            <p>¿Seguro que deseas eliminar este registro?</p>

            <div class="flex justify-end gap-2">

                <flux:modal.close>
                    <flux:button variant="ghost">No</flux:button>
                </flux:modal.close>

                <flux:button variant="danger" wire:click="destroy">
                    Sí
                </flux:button>

            </div>

        </div>
    </flux:modal>

</section>