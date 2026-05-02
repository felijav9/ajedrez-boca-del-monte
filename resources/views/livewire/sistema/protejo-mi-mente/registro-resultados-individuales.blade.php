<div class="space-y-6">

    <flux:heading size="lg">
        Registro de Resultados Individuales
    </flux:heading>

    {{-- TORNEO --}}
    <flux:select wire:model.live="torneo_id" label="Seleccionar torneo">
        <option value="">Seleccione</option>
        @foreach ($torneos as $torneo)
            <option value="{{ $torneo->id }}">
                {{ $torneo->nombre }}
            </option>
        @endforeach
    </flux:select>

    {{-- TABLA --}}
    @if ($jugadores)

        @php
            $showEquipo = collect($jugadores)->contains(fn($j) => !empty($j['equipo']));
        @endphp

        <div class="border rounded-lg overflow-hidden">

            <table class="w-full text-sm">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">Jugador</th>

                        @if ($showEquipo)
                            <th class="p-2 text-left">Equipo</th>
                        @endif

                        <th class="p-2 text-center">Posición</th>
                        <th class="p-2 text-center">Medalla</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($jugadores as $index => $jugador)
                        <tr class="border-t">

                            {{-- JUGADOR --}}
                            <td class="p-2">
                                {{ $jugador['nombre'] }}
                            </td>

                            {{-- EQUIPO (dinámico) --}}
                            @if ($showEquipo)
                                <td class="p-2">
                                    {{ $jugador['equipo'] ?? '-' }}
                                </td>
                            @endif

                            {{-- POSICIÓN --}}
                            <td class="p-2 text-center">
                                <flux:input
                                    type="number"
                                    min="1"
                                    wire:model.live="jugadores.{{ $index }}.posicion"
                                    class="w-20 mx-auto text-center"
                                />
                            </td>

                            {{-- MEDALLA --}}
                            <td class="p-2 text-center">

                                @if ($jugador['medalla'] === 'gold')
                                    <span style="color:#f5c542; font-weight:bold;">
                                        🥇 Oro
                                    </span>

                                @elseif ($jugador['medalla'] === 'silver')
                                    <span style="color:#b0b0b0; font-weight:bold;">
                                        🥈 Plata
                                    </span>

                                @elseif ($jugador['medalla'] === 'bronze')
                                    <span style="color:#cd7f32; font-weight:bold;">
                                        🥉 Bronce
                                    </span>

                                @else
                                    <span class="text-gray-300">-</span>
                                @endif

                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

        {{-- BOTÓN --}}
        <div class="flex justify-end mt-4">
            <flux:button wire:click="confirmarGuardar" variant="primary">
                Guardar resultados
            </flux:button>
        </div>

    @endif


    {{-- MODAL --}}
    <flux:modal name="confirm-save">

        <div class="space-y-4">

            <flux:heading size="lg">
                Confirmar acción
            </flux:heading>

            <p>
                ¿Estás seguro que deseas guardar los resultados?
                <br>
                Se ordenarán automáticamente por posición.
            </p>

            <div class="flex justify-end gap-2">

                <flux:modal.close>
                    <flux:button variant="ghost">
                        Cancelar
                    </flux:button>
                </flux:modal.close>

                <flux:button variant="primary" wire:click="guardar">
                    Sí, guardar
                </flux:button>

            </div>

        </div>

    </flux:modal>

</div>