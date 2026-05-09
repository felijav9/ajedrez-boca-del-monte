<section class="w-full">

    <div class="flex items-center justify-between mb-6">

        <flux:heading size="xl">
            Registro Eventos Torneo
        </flux:heading>

        <flux:button
            variant="primary"
            icon="plus"
            wire:click="openCreateModal"
        >
            Agregar
        </flux:button>

    </div>

    <x-data-table
        :headers="$headers"
        :rows="$this->rows"
    >

        @interact('torneo', $row)
            <div class="font-medium">
                {{ $row->torneo?->nombre }}
            </div>
        @endinteract

        @interact('nombre', $row)
            <div class="flex items-center gap-2">

                <flux:icon
                    name="bolt"
                    class="size-4 text-yellow-500"
                />

                <span>
                    {{ $row->nombre }}
                </span>

            </div>
        @endinteract

        @interact('tipo', $row)

            @if ($row->tipo === 'individual')

                <flux:badge
                    color="blue"
                    size="sm"
                >
                    Individual
                </flux:badge>

            @elseif ($row->tipo === 'equipos')

                <flux:badge
                    color="green"
                    size="sm"
                >
                    Equipos
                </flux:badge>

            @else

                <flux:badge
                    color="yellow"
                    size="sm"
                >
                    Técnico
                </flux:badge>

            @endif

        @endinteract

        @interact('rondas', $row)

            <flux:badge size="sm">
                {{ $row->total_rondas }} rondas
            </flux:badge>

        @endinteract

        @interact('estado', $row)

            @if ($row->finalizado)

                <flux:badge
                    color="green"
                    size="sm"
                >
                    Finalizado
                </flux:badge>

            @else

                <flux:badge
                    color="yellow"
                    size="sm"
                >
                    En curso
                </flux:badge>

            @endif

        @endinteract

        @interact('actions', $row)

            <flux:dropdown>

                <flux:button
                    icon="ellipsis-vertical"
                    size="sm"
                    variant="ghost"
                />

                <flux:menu>

                    <flux:menu.item
                        icon="eye"
                        wire:click="view({{ $row->id }})"
                    >
                        Ver
                    </flux:menu.item>

                    <flux:menu.item
                        icon="pencil"
                        wire:click="edit({{ $row->id }})"
                    >
                        Editar
                    </flux:menu.item>

                    <flux:menu.item
                        icon="trash"
                        variant="danger"
                        wire:click="confirmDelete({{ $row->id }})"
                    >
                        Eliminar
                    </flux:menu.item>

                </flux:menu>

            </flux:dropdown>

        @endinteract

    </x-data-table>

    {{-- MODAL FORMULARIO --}}
    <flux:modal
        name="evento-form"
        class="min-w-[32rem]"
    >

        <div class="space-y-6">

            <flux:heading size="lg">

                @if ($torneo_evento_id)
                    Editar evento
                @else
                    Nuevo evento
                @endif

            </flux:heading>

            <flux:select
                label="Torneo"
                wire:model="torneo_id"
            >

                <flux:select.option value="">
                    Seleccionar torneo
                </flux:select.option>

                @foreach ($this->torneos as $torneo)

                    <flux:select.option value="{{ $torneo->id }}">
                        {{ $torneo->nombre }}
                    </flux:select.option>

                @endforeach

            </flux:select>

            <flux:input
                label="Nombre evento"
                placeholder="Blitz"
                wire:model="nombre"
            />

            <flux:select
                label="Tipo"
                wire:model="tipo"
            >

                <flux:select.option value="individual">
                    Individual
                </flux:select.option>

                <flux:select.option value="equipos">
                    Equipos
                </flux:select.option>

                <flux:select.option value="tecnico">
                    Técnico
                </flux:select.option>

            </flux:select>

            <flux:input
                type="number"
                label="Total rondas"
                wire:model="total_rondas"
            />

            <flux:switch
                wire:model="finalizado"
                label="Evento finalizado"
            />

            <div class="flex justify-end gap-2">

                <flux:modal.close>

                    <flux:button variant="ghost">
                        Cancelar
                    </flux:button>

                </flux:modal.close>

                @if ($torneo_evento_id)

                    <flux:button
                        variant="primary"
                        wire:click="update"
                    >
                        Actualizar
                    </flux:button>

                @else

                    <flux:button
                        variant="primary"
                        wire:click="save"
                    >
                        Guardar
                    </flux:button>

                @endif

            </div>

        </div>

    </flux:modal>

    {{-- MODAL VER --}}
    <flux:modal name="view-evento">

        <div class="space-y-4">

            <flux:heading size="lg">
                {{ $selectedEvento?->nombre }}
            </flux:heading>

            <div>

                <strong>Torneo:</strong>

                {{ $selectedEvento?->torneo?->nombre }}

            </div>

            <div>

                <strong>Tipo:</strong>

                {{ ucfirst($selectedEvento?->tipo) }}

            </div>

            <div>

                <strong>Total rondas:</strong>

                {{ $selectedEvento?->total_rondas }}

            </div>

            <div>

                <strong>Estado:</strong>

                @if ($selectedEvento?->finalizado)
                    Finalizado
                @else
                    En curso
                @endif

            </div>

        </div>

    </flux:modal>

    {{-- MODAL ELIMINAR --}}
    <flux:modal name="confirm-delete">

        <div class="space-y-4">

            <flux:heading size="lg">
                Confirmar eliminación
            </flux:heading>

            <p>

                ¿Desea eliminar el evento
                <strong>
                    {{ $eventoToDelete?->nombre }}
                </strong>
                ?

            </p>

            <div class="flex justify-end gap-2">

                <flux:modal.close>

                    <flux:button variant="ghost">
                        Cancelar
                    </flux:button>

                </flux:modal.close>

                <flux:button
                    variant="danger"
                    wire:click="destroy"
                >
                    Eliminar
                </flux:button>

            </div>

        </div>

    </flux:modal>

</section>