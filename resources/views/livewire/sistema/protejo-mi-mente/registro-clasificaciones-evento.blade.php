<section class="w-full bg-white rounded-xl shadow p-4">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-4">

        <h1 class="text-2xl font-bold">
            Clasificación del Evento
        </h1>

        <div class="flex gap-2">

            <flux:button
                variant="ghost"
                wire:click="$toggle('editMode')"
            >
                {{ $editMode ? 'Bloquear' : 'Editar' }}
            </flux:button>

            <flux:button
                variant="primary"
                wire:click="guardarOrden"
            >
                Guardar orden
            </flux:button>

            @if($ordenGuardado)
                <flux:button
                    variant="danger"
                    wire:click="publicar"
                >
                    Publicar
                </flux:button>
            @endif

        </div>
    </div>

    {{-- EVENTO --}}
    <div class="mb-4">
        <flux:select wire:model.live="torneo_evento_id" label="Evento">
            <flux:select.option value="">Seleccionar</flux:select.option>

            @foreach ($this->eventos() as $evento)
                <flux:select.option value="{{ $evento->id }}">
                    {{ $evento->nombre }}
                </flux:select.option>
            @endforeach
        </flux:select>
    </div>

    {{-- TABLA --}}
    <div class="overflow-x-auto">

        <table class="w-full text-sm border rounded-lg overflow-hidden">

            <thead class="bg-gray-100 text-xs uppercase">
                <tr>
                    <th class="p-2">#</th>
                    <th class="p-2 text-left">Jugador</th>
                    <th class="p-2">Rating</th>
                    <th class="p-2">Pts</th>

                    <th class="p-2">BHC1</th>
                    <th class="p-2">BH</th>
                    <th class="p-2">SB</th>
                    <th class="p-2">PS</th>
                    <th class="p-2">DE</th>
                    <th class="p-2">WIN</th>
                    <th class="p-2">BWG</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($this->clasificaciones as $c)

                    @php $id = $c['jugador']->id; @endphp

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-2 font-bold text-center">
                            {{ $c['posicion'] }}
                        </td>

                        <td class="p-2">
                            {{ $c['jugador']->apellido }}, {{ $c['jugador']->nombre }}
                        </td>

                        <td class="p-2 text-center">{{ $c['rating'] }}</td>

                        <td class="p-2 font-bold text-center">{{ $c['pts'] }}</td>

                        @foreach (['bhc1','bh','sb','ps','de','win','bwg'] as $field)

                            <td class="p-1 text-center">

                                @if($editMode)
                                    <input
                                        type="number"
                                        step="0.1"
                                        class="w-16 border rounded text-center"
                                        wire:model.defer="clasificacionesEdit.{{ $id }}.{{ $field }}"
                                    />
                                @else
                                    {{ $this->clasificacionesEdit[$id][$field] ?? 0 }}
                                @endif

                            </td>

                        @endforeach

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</section>