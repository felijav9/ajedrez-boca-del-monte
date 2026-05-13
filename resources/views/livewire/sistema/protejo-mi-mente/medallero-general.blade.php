<div class="medallero-wrapper">
    <style>
        /* Paleta: Azul #002c53, Amarillo #facc15, Negro #000 */
        .medallero-container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 16px;
        }

        .custom-card {
            background: white;
            border-radius: 20px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 10px 15px -3px rgba(0, 44, 83, 0.05);
            overflow: hidden;
        }

        .table-header-custom {
            background: #002c53;
            color: white;
        }

        .table-header-custom th {
            color: #facc15 !important;
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 0.05em;
            /* Ajuste solicitado: Un poco más a la derecha */
            padding-left: 25px !important;
        }

        .rank-badge {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #002c53;
            color: #facc15;
            font-weight: 900;
            font-size: 13px;
        }

        /* Estilo para las celdas de nombres */
        .cell-player {
            padding-left: 25px !important;
        }

        .search-input {
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
        }

        .search-input:focus {
            border-color: #facc15;
            box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.2);
            outline: none;
        }

        /* Estilos específicos para las filas de resultados en el modal */
        .result-row {
            border-radius: 12px;
            margin-bottom: 10px;
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid transparent;
        }
        .res-oro { background: #fefce8; border-color: #fef08a; }
        .res-plata { background: #f8fafc; border-color: #e2e8f0; }
        .res-bronce { background: #fff7ed; border-color: #fed7aa; }

        /* 📱 MOBILE OPTIMIZATION */
        @media (max-width: 768px) {
            .desktop-table { display: none; }
            .mobile-card-container { display: block; }
            .table-header-custom th, .cell-player { padding-left: 12px !important; }
        }

        @media (min-width: 769px) {
            .mobile-card-container { display: none; }
        }
    </style>

    <livewire:sistema.protejo-mi-mente.dashboard />

    <div class="medallero-container">
        
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:28px; gap:20px; flex-wrap:wrap;">
            <div>
                <flux:heading size="xl" style="color: #002c53; font-weight: 900;">
                    Medallero General
                </flux:heading>
                <flux:subheading>Ranking actualizado de competidores</flux:subheading>
            </div>

            <div style="position: relative;">
                <input 
                    type="text"
                    placeholder="Buscar jugador..."
                    wire:model.live="search"
                    class="search-input"
                    style="padding:10px 16px 10px 40px; border-radius:12px; width:280px; font-weight: 500;"
                />
                <span style="position:absolute; left:14px; top:12px; opacity:0.5;">🔍</span>
            </div>
        </div>

        <div class="desktop-table custom-card">
            <flux:table>
                <flux:table.columns class="table-header-custom">
                    <flux:table.column>Jugador</flux:table.column>
                    <flux:table.column align="center">🥇 Oro</flux:table.column>
                    <flux:table.column align="center">🥈 Plata</flux:table.column>
                    <flux:table.column align="center">🥉 Bronce</flux:table.column>
                    <flux:table.column align="center">Total</flux:table.column>
                    <flux:table.column align="right"></flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @foreach ($medallero as $j)
                        <flux:table.row :key="$j->id">
                            <flux:table.cell class="cell-player">
                                <div style="display:flex; align-items:center; gap:12px;">
                                    <div class="rank-badge">#{{ $j->rank }}</div>
                                    <span style="font-weight:700; color: #002c53;">{{ $j->nombre_completo }}</span>
                                </div>
                            </flux:table.cell>

                            <flux:table.cell align="center">
                                <span style="font-size: 1.1rem; font-weight: 600;">{{ $j->oros }}</span>
                            </flux:table.cell>
                            
                            <flux:table.cell align="center">
                                <span style="font-size: 1.1rem; font-weight: 600;">{{ $j->platas }}</span>
                            </flux:table.cell>

                            <flux:table.cell align="center">
                                <span style="font-size: 1.1rem; font-weight: 600;">{{ $j->bronces }}</span>
                            </flux:table.cell>

                            <flux:table.cell align="center">
                                <div style="background: #facc15; color: black; padding: 4px 12px; border-radius: 8px; display: inline-block; font-weight: 900;">
                                    {{ $j->total }}
                                </div>
                            </flux:table.cell>

                            <flux:table.cell align="right">
                                <flux:button size="sm" variant="ghost" wire:click="openDetalle({{ $j->id }})" icon="eye" />
                            </flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>
            
            <div style="padding: 16px; border-top: 1px solid #eee;">
                {{ $medallero->links() }}
            </div>
        </div>

        <div class="mobile-card-container">
            @foreach ($medallero as $j)
                <div style="border: 2px solid #002c53; border-radius:16px; padding:16px; margin-bottom:12px; background:white; position: relative;">
                    <div style="position: absolute; top: 0; right: 0; background: #facc15; padding: 4px 12px; border-bottom-left-radius: 12px; font-weight: 900; font-size: 12px;">
                        RANK #{{ $j->rank }}
                    </div>
                    <div style="font-weight:900; color: #002c53; font-size: 16px; margin-bottom:12px;">
                        {{ $j->nombre_completo }}
                    </div>
                    <div style="display:grid; grid-template-columns: repeat(4, 1fr); gap: 8px; background: #f8fafc; padding: 10px; border-radius: 12px;">
                        <div style="text-align:center;"><small style="display:block; opacity: 0.6;">🥇</small><strong>{{ $j->oros }}</strong></div>
                        <div style="text-align:center;"><small style="display:block; opacity: 0.6;">🥈</small><strong>{{ $j->platas }}</strong></div>
                        <div style="text-align:center;"><small style="display:block; opacity: 0.6;">🥉</small><strong>{{ $j->bronces }}</strong></div>
                        <div style="text-align:center;"><small style="display:block; opacity: 0.6;">TOT</small><strong>{{ $j->total }}</strong></div>
                    </div>
                    <div style="margin-top: 14px;">
                        <flux:button size="sm" wire:click="openDetalle({{ $j->id }})" variant="filled" style="width: 100%; background: #002c53; color: white;">
                            Ver Historial
                        </flux:button>
                    </div>
                </div>
            @endforeach
            <div style="margin-top: 20px;">
                {{ $medallero->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL DETALLE ACTUALIZADO --}}
    <flux:modal name="detalle-medallero" style="max-width:650px; width:95%; border-radius: 24px; padding: 0 !important; overflow: hidden;">
        <div style="background: #002c53; padding: 30px; color: white; position: relative;">
           <flux:heading size="lg" style="color: #facc15 !important; font-weight: 900;">
                Logros de {{ $selectedJugador?->nombre }} {{ $selectedJugador?->apellido }}
            </flux:heading>
            <p style="opacity: 0.8; font-size: 14px; margin-top: 4px;">Torneos con podio obtenidos</p>
            
            <div style="position: absolute; right: 30px; top: 30px; font-size: 40px; opacity: 0.2;">🏆</div>
        </div>

        <div style="padding: 24px; max-height: 65vh; overflow-y: auto; background: #fff;">
            
            <div style="display: flex; flex-direction: column; gap: 4px;">
                @forelse ($resultados as $r)
                    <div class="result-row {{ match($r['posicion']){ 1=>'res-oro', 2=>'res-plata', 3=>'res-bronce', default=>'' } }}">
                        <div>
                            <div style="font-weight: 800; color: #002c53; font-size: 15px; margin-bottom: 2px;">
                                {{ $r['torneo']['nombre'] ?? 'Torneo Sin Nombre' }}
                            </div>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <span style="font-size: 10px; background: #002c53; color: white; padding: 2px 8px; border-radius: 4px; font-weight: bold; text-transform: uppercase;">
                                    {{ $r['torneo']['tipo'] ?? 'Externo' }}
                                </span>
                                <span style="font-size: 12px; color: #64748b;">
                                    Competencia finalizada
                                </span>
                            </div>
                        </div>

                        <div style="text-align: right;">
                            <div style="font-size: 11px; color: #64748b; font-weight: bold; margin-bottom: 4px;">RESULTADO</div>
                            <div style="
                                font-size: 18px; 
                                font-weight: 900;
                                color: {{ match($r['posicion']){ 1=>'#854d0e', 2=>'#475569', 3=>'#9a3412', default=>'#64748b' } }};
                            ">
                                {{ match($r['posicion']){ 1=>'🥇 1er Lugar', 2=>'🥈 2do Lugar', 3=>'🥉 3er Lugar', default=>'#' . $r['posicion'] } }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 40px; color: #64748b;">
                        No hay medallas registradas aún.
                    </div>
                @endforelse
            </div>
        </div>

        <div style="padding: 20px; background: #f8fafc; border-top: 1px solid #e2e8f0; text-align: right;">
            <flux:modal.close>
                <flux:button variant="filled" style="background: #002c53; color: white;">Cerrar</flux:button>
            </flux:modal.close>
        </div>
    </flux:modal>

        <livewire:sistema.protejo-mi-mente.footer />

</div>