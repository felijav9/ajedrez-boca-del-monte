<section class="w-full">

    {{-- ENCABEZADO --}}
    <div class="flex justify-between items-center mb-6">
        <flux:heading size="xl">Registro de Jugadores</flux:heading>

        <flux:button variant="primary" wire:click="openCreateModal" icon="plus">
            Agregar
        </flux:button>
    </div>

    {{-- TABLA PRINCIPAL --}}
    <x-data-table :headers="$this->headers" :rows="$this->rows">

        @interact('nombre_completo', $row)
            <div class="flex items-center gap-2">
                <flux:icon name="user" class="size-4 text-gray-400" />
                <span class="font-semibold">
                    {{ $row->apellido }} {{ $row->nombre }}
                </span>
            </div>
        @endinteract

        @interact('genero', $row)
            <flux:badge size="sm" :color="$row->genero === 'masculino' ? 'blue' : 'pink'">
                <span class="capitalize">{{ $row->genero }}</span>
            </flux:badge>
        @endinteract

        @interact('edad', $row)
            <span>{{ $row->edad }} </span>
        @endinteract

        @interact('fecha_nacimiento', $row)
            <div class="flex items-center gap-1 text-sm text-zinc-500">
                <flux:icon name="calendar" class="size-4" />
                {{ $row->fecha_nacimiento
                    ? \Carbon\Carbon::parse($row->fecha_nacimiento)->translatedFormat('d M, Y')
                    : 'N/A' }}
            </div>
        @endinteract

        @interact('elos', $row)
            <div class="flex items-center gap-1 text-xs">
                <span class="font-bold text-blue-600">{{ $row->elo_clasico ?? '-' }}</span>
                <span class="text-gray-400">/</span>
                <span class="font-bold text-green-600">{{ $row->elo_rapido ?? '-' }}</span>
                <span class="text-gray-400">/</span>
                <span class="font-bold text-purple-600">{{ $row->elo_blitz ?? '-' }}</span>
            </div>
        @endinteract

        @interact('actions', $row)
            <flux:dropdown>
                <flux:button size="sm" icon="ellipsis-vertical" variant="ghost" />

                <flux:menu>
                    <flux:menu.item icon="pencil" wire:click="edit({{ $row->id }})">
                        Editar
                    </flux:menu.item>

                    <flux:menu.item icon="eye" wire:click="openResults({{ $row->id }})">
                        Ver resultados
                    </flux:menu.item>

                    <flux:menu.item icon="trash" variant="danger" wire:click="confirmDelete({{ $row->id }})">
                        Eliminar
                    </flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        @endinteract

    </x-data-table>

    {{-- MODAL JUGADOR --}}
    <flux:modal name="jugador-form" class="min-w-[30rem]">
        <div class="space-y-6">

            <flux:heading size="lg">
                {{ $jugador_id ? 'Editar Jugador' : 'Nuevo Jugador' }}
            </flux:heading>

            <div class="grid grid-cols-2 gap-4">
                <flux:input label="Apellido" wire:model="apellido" />
                <flux:input label="Nombre" wire:model="nombre" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <flux:input label="Edad" type="number" wire:model="edad" />
                <flux:input label="Fecha de nacimiento" type="date" wire:model="fecha_nacimiento" />
            </div>

            <flux:select label="Género" wire:model="genero">
                <flux:select.option value="">Seleccionar</flux:select.option>
                <flux:select.option value="masculino">Masculino</flux:select.option>
                <flux:select.option value="femenino">Femenino</flux:select.option>
            </flux:select>

            <flux:separator label="Ratings ELO" />

            <div class="grid grid-cols-3 gap-4">
                <flux:input label="Clásico" type="number" wire:model="elo_clasico" />
                <flux:input label="Rápido" type="number" wire:model="elo_rapido" />
                <flux:input label="Blitz" type="number" wire:model="elo_blitz" />
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>

                <flux:button wire:click="{{ $jugador_id ? 'update' : 'save' }}" variant="primary">
                    {{ $jugador_id ? 'Actualizar' : 'Guardar' }}
                </flux:button>
            </div>

        </div>
    </flux:modal>

    {{-- MODAL DELETE --}}
    <flux:modal name="confirm-delete" class="min-w-[28rem]">

        <div class="space-y-5">

            <flux:heading size="lg">
                Confirmar eliminación
            </flux:heading>

            <p class="text-sm text-gray-600">
                ¿Eliminar a
                <span class="font-semibold">
                    {{ $jugadorToDelete?->nombre }} {{ $jugadorToDelete?->apellido }}
                </span>?
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
{{-- MODAL RESULTADOS --}}
<flux:modal name="results-modal" class="min-w-[40rem]">

    <div class="space-y-5">

        <flux:heading size="lg">
            Resultados de {{ $selectedJugador?->nombre }} {{ $selectedJugador?->apellido }}
        </flux:heading>

        {{-- 🏆 MEDALLAS --}}
        @php
            $topMedals = collect($resultados)->filter(fn($r) => in_array($r['posicion'], [1,2,3]));
        @endphp

        @if ($topMedals->count())
            <div class="rounded-xl border p-4 bg-zinc-50">

                <h3 class="font-bold mb-3">🏆 Medallas obtenidas</h3>

                <div class="flex gap-2 flex-wrap">
                    @foreach ($topMedals as $r)
                        @if ($r['posicion'] == 1)
                            <span class="text-yellow-500 text-2xl">🥇</span>
                        @elseif($r['posicion'] == 2)
                            <span class="text-gray-400 text-2xl">🥈</span>
                        @elseif($r['posicion'] == 3)
                            <span class="text-orange-600 text-2xl">🥉</span>
                        @endif
                    @endforeach
                </div>

            </div>
        @endif

        {{-- 📊 HISTORIAL --}}
        <div class="rounded-xl border p-4">

            <h3 class="font-bold mb-3">📊 Historial de torneos</h3>

            {{-- 🔥 TIPO DE TORNEO --}}
            @php
                $tipos = collect($resultados)
                    ->map(fn($r) => $r['torneo']['tipo'] ?? null)
                    ->filter()
                    ->unique();
            @endphp

            @if ($tipos->count())
                <div class="flex gap-2 mb-4 flex-wrap">

                    @foreach ($tipos as $tipo)

                        @php
                            $color = match($tipo) {
                                'interno' => 'bg-blue-100 text-blue-700',
                                'externo' => 'bg-purple-100 text-purple-700',
                                default => 'bg-gray-100 text-gray-600'
                            };

                            $label = match($tipo) {
                                'interno' => ' Torneos Internos',
                                'externo' => ' Torneos Externos',
                                default => ucfirst($tipo)
                            };
                        @endphp

                        <span class="px-3 py-1 text-xs font-bold rounded-full {{ $color }}">
                            {{ $label }}
                        </span>

                    @endforeach

                </div>
            @endif

            {{-- TABLA --}}
            <table class="w-full text-sm">

                <thead>
                    <tr class="text-left border-b">
                        <th class="py-2">Torneo</th>
                        <th class="text-center py-2 px-6">Posición</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($resultados as $r)

                        @php
                            $bg = match($r['posicion']) {
                                1 => 'bg-yellow-200',
                                2 => 'bg-gray-200',
                                3 => 'bg-orange-200',
                                default => ''
                            };
                        @endphp

                        <tr class="border-b {{ $bg }}">

                            <td class="py-3">
                                {{ $r['torneo']['nombre'] ?? '-' }}
                            </td>

                            <td class="text-center py-3 px-6 font-bold">
                                #{{ $r['posicion'] ?? '-' }}
                            </td>

                        </tr>

                    @endforeach
                </tbody>

            </table>

        </div>

        <div class="flex justify-end">
            <flux:modal.close>
                <flux:button>Cerrar</flux:button>
            </flux:modal.close>
        </div>

    </div>

</flux:modal>


</section>