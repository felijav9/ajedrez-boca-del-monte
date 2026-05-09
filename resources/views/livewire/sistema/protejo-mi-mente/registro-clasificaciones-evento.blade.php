<section class="w-full">

    <div class="flex items-center justify-between mb-6">

        <flux:heading size="xl">
            Clasificación del Evento
        </flux:heading>

        {{-- BOTÓN PUBLICAR --}}
        <flux:button
            variant="primary"
            wire:click="publicar"
        >
            Publicar
        </flux:button>

    </div>

    {{-- FILTRO --}}
    <div class="mb-6">

        <flux:select wire:model.live="torneo_evento_id" label="Evento">

            <flux:select.option value="">
                Seleccionar evento
            </flux:select.option>

            @foreach ($this->eventos as $evento)
                <flux:select.option value="{{ $evento->id }}">
                    {{ $evento->nombre }}
                </flux:select.option>
            @endforeach

        </flux:select>

    </div>

    {{-- TABLA --}}
    <div class="overflow-x-auto">

        <table class="w-full text-sm border">

            <thead class="bg-gray-100">
                <tr>
                    <th>#</th>
                    <th>Apellidos, Nombre</th>
                    <th>Rating</th>
                    <th>Pts</th>
                    <th>BHC1</th>
                    <th>BH</th>
                    <th>SB</th>
                    <th>PS</th>
                    <th>DE</th>
                    <th>WIN</th>
                    <th>BWG</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($this->clasificaciones as $c)

                    <tr class="border-b">

                        <td>{{ $c['posicion'] }}</td>

                        <td>{{ $c['jugador']->apellido }}, {{ $c['jugador']->nombre }}</td>

                        <td>{{ $c['rating'] }}</td>
                        <td class="font-bold">{{ $c['pts'] }}</td>

                        <td>{{ $c['bhc1'] }}</td>
                        <td>{{ $c['bh'] }}</td>
                        <td>{{ $c['sb'] }}</td>
                        <td>{{ $c['ps'] }}</td>
                        <td>{{ $c['de'] }}</td>

                        <td class="text-green-600">{{ $c['win'] }}</td>
                        <td>{{ $c['bwg'] }}</td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="11" class="text-center p-6 text-gray-500">
                            Selecciona un evento
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</section>