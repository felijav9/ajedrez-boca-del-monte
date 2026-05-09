<section class="w-full bg-white rounded-xl shadow p-4">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-4">

        <h1 class="text-2xl font-bold">
            Clasificación del Evento
        </h1>

        <div class="flex gap-2">

            <flux:button
                variant="outline"
                wire:click="$toggle('modoGlobal')"
            >
                {{ $modoGlobal ? 'Ver Evento' : 'Ver Global Torneo' }}
            </flux:button>

            <flux:button
                variant="primary"
                wire:click="publicar"
            >
                Publicar clasificación
            </flux:button>

        </div>

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

        @if(!$modoGlobal)
            <flux:select wire:model.live="torneo_evento_id" label="Evento">
                <flux:select.option value="">Seleccionar evento</flux:select.option>

                @foreach ($this->eventos() as $e)
                    <flux:select.option value="{{ $e->id }}">
                        {{ $e->nombre }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        @endif

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

                @foreach(($modoGlobal ? $this->clasificacionesGlobal : $this->clasificaciones) as $c)

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

    {{-- MODAL PARTIDAS AGRUPADAS --}}
    <flux:modal wire:model="verPartidasModal" class="min-w-[50rem]">

        <flux:heading size="lg">
            Partidas del jugador
        </flux:heading>

        <div class="space-y-6 mt-4">

            @foreach ($this->partidasAgrupadas as $evento => $partidas)

                <div class="border rounded-lg p-3">

                    <div class="font-bold text-lg mb-2">
                        {{ $evento }}
                    </div>

                    <div class="space-y-2">

                        @foreach ($partidas as $p)

                            <div class="flex justify-between p-2 border rounded">

                                <div>
                                    <div class="text-sm font-semibold">
                                        Ronda {{ $p->ronda?->numero }}
                                    </div>

                                    <div class="text-xs text-gray-500">
                                        {{ $p->blancas?->nombre }} vs {{ $p->negras?->nombre }}
                                    </div>
                                </div>

                                <div class="font-bold">
                                    {{ $p->resultado }}
                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endforeach

        </div>

        <div class="flex justify-end mt-4">
            <flux:button wire:click="$set('verPartidasModal', false)">
                Cerrar
            </flux:button>
        </div>

    </flux:modal>

</section>