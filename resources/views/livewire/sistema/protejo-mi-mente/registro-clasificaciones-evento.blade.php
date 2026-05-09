<section class="w-full bg-white rounded-xl shadow p-4">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-4">

        <h1 class="text-2xl font-bold">
            Clasificación del Evento
        </h1>

        <flux:button
            variant="primary"
            wire:click="publicar"
        >
            Publicar clasificación
        </flux:button>

    </div>

    {{-- FILTROS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

        <flux:select wire:model.live="torneo_id" label="Torneo">
            <flux:select.option value="">Seleccionar torneo</flux:select.option>

            @foreach ($this->torneos() as $t)
                <flux:select.option value="{{ $t->id }}">
                    {{ $t->nombre }}
                </flux:select.option>
            @endforeach
        </flux:select>

        <flux:select wire:model.live="torneo_evento_id" label="Evento" :disabled="!$torneo_id">
            <flux:select.option value="">Seleccionar evento</flux:select.option>

            @foreach ($this->eventos() as $e)
                <flux:select.option value="{{ $e->id }}">
                    {{ $e->nombre }}
                </flux:select.option>
            @endforeach
        </flux:select>

    </div>

    {{-- TABLA --}}
    <div class="overflow-x-auto border rounded-lg">

        <table class="w-full text-sm">

            <thead class="bg-gray-100 text-xs uppercase">
                <tr>
                    <th class="p-3 text-left">Jugador</th>
                    <th class="p-3 text-center">Pts</th>
                    <th class="p-3 text-center">Acción</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($this->clasificaciones as $c)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-3 font-medium">
                            {{ $c['jugador']->apellido }}, {{ $c['jugador']->nombre }}
                        </td>

                        <td class="p-3 text-center font-bold text-lg">
                            {{ $c['pts'] }}
                        </td>

                        <td class="p-3 text-center">

                            <flux:button
                                size="sm"
                                variant="ghost"
                                wire:click="verPartidas({{ $c['jugador']->id }})"
                            >
                                Ver partidas
                            </flux:button>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    {{-- =========================
        MODAL PARTIDAS
    ==========================--}}
    <flux:modal wire:model="verPartidasModal" class="min-w-[40rem]">

        <div class="space-y-4">

            <flux:heading size="lg">
                Partidas del jugador
            </flux:heading>

            <div class="space-y-2">

                @foreach ($this->partidasJugador as $p)

                    <div class="p-3 border rounded-lg flex justify-between">

                        <div>
                            <div class="font-semibold">
                                Ronda {{ $p->ronda?->numero }}
                            </div>

                            <div class="text-xs text-gray-500">
                                {{ $p->blancas?->nombre }} vs {{ $p->negras?->nombre }}
                            </div>
                        </div>

                        <div class="font-bold">
                            {{ $p->resultado ?? 'Pendiente' }}
                        </div>

                    </div>

                @endforeach

            </div>

            <div class="flex justify-end">
                <flux:button wire:click="$set('verPartidasModal', false)">
                    Cerrar
                </flux:button>
            </div>

        </div>

    </flux:modal>

</section>