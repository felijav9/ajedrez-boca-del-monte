<section class="w-full">

    <div class="flex items-center justify-between mb-6">

        <flux:heading size="xl">
            Registro Rondas
        </flux:heading>

        <flux:button
            variant="primary"
            icon="plus"
            wire:click="openCreateModal"
        >
            Agregar
        </flux:button>

    </div>

    <x-data-table :headers="$headers" :rows="$this->rows">

        @interact('torneo', $row)
            <div class="font-medium">
                {{ $row->torneoEvento?->torneo?->nombre }}
            </div>
        @endinteract

        @interact('evento', $row)
            <flux:badge size="sm">
                {{ $row->torneoEvento?->nombre }}
            </flux:badge>
        @endinteract

        @interact('numero', $row)
            <div class="font-semibold">
                Ronda {{ $row->numero }}
            </div>
        @endinteract

        @interact('estado', $row)
            @if ($row->finalizada)
                <flux:badge color="green" size="sm">
                    Finalizada
                </flux:badge>
            @else
                <flux:badge color="yellow" size="sm">
                    Pendiente
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

    {{-- =========================
        FORM
    ==========================--}}
    <flux:modal name="ronda-form" class="min-w-[32rem]">

        <div class="space-y-6">

            <flux:heading size="lg">
                {{ $ronda_id ? 'Editar ronda' : 'Nueva ronda' }}
            </flux:heading>

            {{-- TORNEO --}}
            <flux:select
                label="Torneo"
                wire:model.live="torneo_id"
                :disabled="$ronda_id !== null"
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

            {{-- EVENTO --}}
            <flux:select
                label="Evento"
                wire:model.live="torneo_evento_id"
                :disabled="$ronda_id !== null || !$torneo_id || $this->eventos->isEmpty()"
            >
                <flux:select.option value="">
                    Seleccionar evento
                </flux:select.option>

                @foreach ($this->eventos as $evento)
                    <flux:select.option value="{{ $evento->id }}">
                        {{ $evento->nombre }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            {{-- RONDA --}}
            <flux:select
                label="Número de ronda"
                wire:model="numero"
                :disabled="!$torneo_evento_id || empty($this->numerosDisponibles)"
            >
                <flux:select.option value="">
                    Seleccionar ronda
                </flux:select.option>

                @foreach ($this->numerosDisponibles as $num)
                    <flux:select.option value="{{ $num }}">
                        Ronda {{ $num }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            {{-- FINALIZADA --}}
            <flux:switch
                wire:model="finalizada"
                label="Ronda finalizada"
            />

            <div class="flex justify-end gap-2">

                <flux:modal.close>
                    <flux:button variant="ghost">
                        Cancelar
                    </flux:button>
                </flux:modal.close>

                <flux:button
                    variant="primary"
                    wire:click="{{ $ronda_id ? 'update' : 'save' }}"
                >
                    {{ $ronda_id ? 'Actualizar' : 'Guardar' }}
                </flux:button>

            </div>

        </div>

    </flux:modal>

    {{-- =========================
        VIEW
    ==========================--}}
    <flux:modal name="view-ronda">

        <div class="space-y-4">

            <flux:heading size="lg">
                Ronda {{ $selectedRonda?->numero }}
            </flux:heading>

            <p>
                <strong>Torneo:</strong>
                {{ $selectedRonda?->torneoEvento?->torneo?->nombre }}
            </p>

            <p>
                <strong>Evento:</strong>
                {{ $selectedRonda?->torneoEvento?->nombre }}
            </p>

            <p>
                <strong>Estado:</strong>
                {{ $selectedRonda?->finalizada ? 'Finalizada' : 'Pendiente' }}
            </p>

        </div>

    </flux:modal>

    {{-- =========================
        DELETE
    ==========================--}}
    <flux:modal name="confirm-delete">

        <div class="space-y-4">

            <flux:heading size="lg">
                Confirmar eliminación
            </flux:heading>

            <p>
                ¿Eliminar ronda
                <strong>{{ $rondaToDelete?->numero }}</strong>?
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