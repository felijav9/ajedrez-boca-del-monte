<section class="w-full">

    <div class="flex items-center justify-between mb-6">

        <flux:heading size="xl">
            Registro de Partidas
        </flux:heading>

        <flux:button
            variant="primary"
            icon="plus"
            wire:click="openCreateModal"
        >
            Agregar
        </flux:button>

    </div>

    {{-- =========================
        TABLA
    ==========================--}}
    <x-data-table :headers="$headers" :rows="$this->rows">

        @interact('evento', $row)
            <div class="font-medium">
                {{ $row->ronda?->torneoEvento?->nombre }}
            </div>
        @endinteract

        @interact('mesa', $row)
            <flux:badge size="sm">
                Mesa {{ $row->mesa }}
            </flux:badge>
        @endinteract


        @interact('ronda', $row)
            <flux:badge size="sm">
                Ronda {{ $row->ronda?->numero }}
            </flux:badge>
        @endinteract

        @interact('blancas', $row)
            {{ $row->blancas?->nombre }} {{ $row->blancas?->apellido }}
        @endinteract

        @interact('negras', $row)
            {{ $row->negras?->nombre }} {{ $row->negras?->apellido }}
        @endinteract

        @interact('resultado', $row)
            <flux:badge size="sm">
                {{ $row->resultado ?? 'Pendiente' }}
            </flux:badge>
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
                        icon="pencil"
                        wire:click="edit({{ $row->id }})"
                    >
                        Editar
                    </flux:menu.item>

                    <flux:menu.item
                        icon="trash"
                        variant="danger"
                        wire:click="destroy({{ $row->id }})"
                    >
                        Eliminar
                    </flux:menu.item>

                </flux:menu>

            </flux:dropdown>

        @endinteract

    </x-data-table>

    {{-- =========================
        MODAL FORM
    ==========================--}}
    <flux:modal name="partida-form" class="min-w-[40rem]">

        <div class="space-y-6">

            <flux:heading size="lg">
                {{ $partida_id ? 'Editar partida' : 'Nueva partida' }}
            </flux:heading>

            {{-- EVENTO --}}
            <flux:select
                label="Evento"
                wire:model.live="torneo_evento_id"
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
                label="Ronda"
                wire:model="ronda_id"
                :disabled="!$torneo_evento_id || empty($this->rondas)"
            >
                <flux:select.option value="">
                    Seleccionar ronda
                </flux:select.option>

                @foreach ($this->rondas as $ronda)
                    <flux:select.option value="{{ $ronda->id }}">
                        Ronda {{ $ronda->numero }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            {{-- =========================
                ♟️ BLANCAS
            ==========================--}}
            <flux:select
                label="Jugador Blancas"
                wire:model="blancas_id"
                :disabled="!$torneo_evento_id || empty($this->jugadores)"
            >
                <flux:select.option value="">
                    Seleccionar jugador
                </flux:select.option>

                @foreach ($this->jugadores as $jugador)
                    <flux:select.option value="{{ $jugador->id }}">
                        {{ $jugador->nombre }} {{ $jugador->apellido }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            {{-- =========================
                ♟️ NEGRAS
            ==========================--}}
            <flux:select
                label="Jugador Negras"
                wire:model="negras_id"
                :disabled="!$torneo_evento_id || empty($this->jugadores)"
            >
                <flux:select.option value="">
                    Seleccionar jugador
                </flux:select.option>

                @foreach ($this->jugadores as $jugador)
                    <flux:select.option value="{{ $jugador->id }}">
                        {{ $jugador->nombre }} {{ $jugador->apellido }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            {{-- MESA --}}
            <flux:input
                label="Mesa"
                wire:model="mesa"
                placeholder="Ej: 1"
            />

            {{-- RESULTADO --}}
            <flux:select
                label="Resultado"
                wire:model="resultado"
            >
                <flux:select.option value="">
                    Pendiente
                </flux:select.option>

                <flux:select.option value="1-0">1 - 0</flux:select.option>
                <flux:select.option value="0-1">0 - 1</flux:select.option>
                <flux:select.option value="0.5-0.5">½ - ½</flux:select.option>
            </flux:select>

            {{-- FINALIZADA --}}
            <flux:switch
                wire:model="finalizada"
                label="Partida finalizada"
            />

            {{-- ACTIONS --}}
            <div class="flex justify-end gap-2">

                <flux:modal.close>
                    <flux:button variant="ghost">
                        Cancelar
                    </flux:button>
                </flux:modal.close>

                <flux:button
                    variant="primary"
                    wire:click="{{ $partida_id ? 'update' : 'save' }}"
                >
                    {{ $partida_id ? 'Actualizar' : 'Guardar' }}
                </flux:button>

            </div>

        </div>

    </flux:modal>

</section>