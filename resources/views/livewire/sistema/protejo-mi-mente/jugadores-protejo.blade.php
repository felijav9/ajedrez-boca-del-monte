<div class="jugadores-wrapper">
    <style>
        /* Paleta: Azul #002c53, Amarillo #facc15, Negro #000 */
        .jugadores-container {
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

        /* Estilos del Buscador */
        .search-input {
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
            outline: none;
            color: #002c53;
        }

        .search-input:focus {
            border-color: #facc15;
            box-shadow: 0 0 0 4px rgba(250, 204, 21, 0.1);
        }

        .table-header-custom {
            background: #002c53;
            color: white !important;
        }

        .table-header-custom th {
            color: #facc15 !important;
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 0.05em;
            padding-left: 20px !important;
        }

        .player-id-badge {
            font-size: 10px;
            background: #f1f5f9;
            color: #64748b;
            padding: 2px 6px;
            border-radius: 6px;
            font-weight: bold;
        }

        .elo-badge {
            padding: 4px 8px;
            border-radius: 8px;
            font-weight: 800;
            font-size: 12px;
            border: 1px solid transparent;
        }
        .elo-clasico { background: #eff6ff; color: #1e40af; border-color: #bfdbfe; }
        .elo-rapido { background: #f0fdf4; color: #166534; border-color: #bbf7d0; }
        .elo-blitz { background: #faf5ff; color: #6b21a8; border-color: #e9d5ff; }

        .result-row:hover { background: #f1f5f9 !important; transform: scale(1.01); }

        @media (max-width: 768px) {
            .desktop-table { display: none; }
            .mobile-cards { display: block; }
            .header-flex { flex-direction: column; align-items: stretch !important; }
            .search-wrapper { width: 100% !important; }
            .search-input { width: 100% !important; }
        }

        @media (min-width: 769px) {
            .mobile-cards { display: none; }
        }
    </style>

    <livewire:sistema.protejo-mi-mente.dashboard />

    <div class="jugadores-container">
        {{-- ENCABEZADO CON BUSCADOR --}}
        <div class="header-flex" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:28px; gap:20px; flex-wrap:wrap;">
            <div>
                <flux:heading size="xl" style="color: #002c53; font-weight: 900;">
                    Directorio Interno
                </flux:heading>
                <flux:subheading>
                    Espacio de comunidad: sigue el crecimiento y la trayectoria de cada compañero dentro del club.
                </flux:subheading>
            </div>

            {{-- BUSCADOR INTEGRADO --}}
            <div class="search-wrapper" style="position: relative;">
                <input 
                    type="text"
                    placeholder="Buscar por nombre o ID..."
                    wire:model.live="search"
                    class="search-input"
                    style="padding:12px 16px 12px 42px; border-radius:14px; width:320px; font-weight: 600; font-size: 14px;"
                />
                <span style="position:absolute; left:16px; top:14px; font-size: 18px; opacity:0.6;">🔍</span>
            </div>
        </div>

        {{-- TABLA DESKTOP --}}
        <div class="desktop-table custom-card">
            <flux:table>
                <flux:table.columns class="table-header-custom">
                    <flux:table.column>Jugador</flux:table.column>
                    <flux:table.column align="center">Género</flux:table.column>
                    <flux:table.column align="center">Edad</flux:table.column>
                    <flux:table.column align="center">Ratings ELO</flux:table.column>
                    <flux:table.column align="right"></flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @foreach ($this->rows as $row)
                        <flux:table.row :key="$row->id">
                            <flux:table.cell>
                                <div style="display:flex; align-items:center; gap:12px;">
                                    <div style="width:35px; height:35px; border-radius:10px; background:#002c53; color:#facc15; display:flex; align-items:center; justify-content:center; font-weight:bold;">
                                        {{ substr($row->nombre, 0, 1) }}
                                    </div>
                                    <div style="display:flex; flex-direction:column;">
                                        <span style="font-weight:700; color:#002c53;">{{ $row->nombre }} {{ $row->apellido }}</span>
                                    </div>
                                </div>
                            </flux:table.cell>

                            <flux:table.cell align="center">
                                <flux:badge size="sm" :color="$row->genero === 'masculino' ? 'blue' : 'pink'" inset="top bottom">
                                    <span style="text-transform: capitalize;">{{ $row->genero }}</span>
                                </flux:badge>
                            </flux:table.cell>

                            <flux:table.cell align="center">
                                <span style="font-weight:600; color:#475569;">{{ $row->edad }} </span>
                            </flux:table.cell>

                            <flux:table.cell align="center">
                                <div style="display:flex; gap:6px; justify-content:center;">
                                    <span class="elo-badge elo-clasico" title="Clásico">{{ $row->elo_clasico ?? '-' }}</span>
                                    <span class="elo-badge elo-rapido" title="Rápido">{{ $row->elo_rapido ?? '-' }}</span>
                                    <span class="elo-badge elo-blitz" title="Blitz">{{ $row->elo_blitz ?? '-' }}</span>
                                </div>
                            </flux:table.cell>

                            <flux:table.cell align="right">
                                <flux:button size="sm" variant="ghost" icon="eye" wire:click="openResults({{ $row->id }})" />
                            </flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>

            {{-- PAGINACIÓN DESKTOP --}}
            <div style="padding: 15px; border-top: 1px solid #e5e7eb;">
                {{ $this->rows->links() }}
            </div>
        </div>

        {{-- VISTA MÓVIL --}}
        <div class="mobile-cards">
            @foreach ($this->rows as $row)
                <div style="background:white; border:2px solid #002c53; border-radius:16px; padding:16px; margin-bottom:12px;">
                    <div style="display:flex; justify-content:space-between; align-items:start; margin-bottom:12px;">
                        <div style="font-weight:900; color:#002c53; font-size:16px;">
                            {{ $row->nombre }} {{ $row->apellido }}
                        </div>
                    </div>
                    
                    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px; margin-bottom:12px;">
                        <div style="background:#f8fafc; padding:8px; border-radius:10px; text-align:center;">
                            <small style="display:block; opacity:0.6; font-size:10px;">EDAD</small>
                            <strong>{{ $row->edad }} años</strong>
                        </div>
                        <div style="background:#f8fafc; padding:8px; border-radius:10px; text-align:center;">
                            <small style="display:block; opacity:0.6; font-size:10px;">GÉNERO</small>
                            <strong style="text-transform:capitalize;">{{ $row->genero }}</strong>
                        </div>
                    </div>

                    <div style="display:flex; justify-content:space-around; background:#002c53; padding:10px; border-radius:12px; margin-bottom:15px;">
                        <div style="text-align:center; color:white;"><small style="display:block; color:#facc15; font-size:9px;">CLA</small><strong>{{ $row->elo_clasico ?? '-' }}</strong></div>
                        <div style="text-align:center; color:white;"><small style="display:block; color:#facc15; font-size:9px;">RAP</small><strong>{{ $row->elo_rapido ?? '-' }}</strong></div>
                        <div style="text-align:center; color:white;"><small style="display:block; color:#facc15; font-size:9px;">BLZ</small><strong>{{ $row->elo_blitz ?? '-' }}</strong></div>
                    </div>

                    <flux:button size="sm" wire:click="openResults({{ $row->id }})" style="width:100%; background:#002c53; color:white;">
                        Ver Historial Completo
                    </flux:button>
                </div>
            @endforeach

            {{-- PAGINACIÓN MÓVIL --}}
            <div style="margin-top: 20px;">
                {{ $this->rows->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL PERFIL Y MEDALLERO UNIFICADO --}}
    <flux:modal name="results-modal" style="max-width:650px; width:95%; border-radius: 24px; padding: 0 !important; overflow: hidden;">
        <div style="background: #002c53; padding: 30px; color: white; position: relative;">
            <flux:heading size="lg" style="color: #facc15 !important; font-weight: 900;">
                Perfil de {{ $selectedJugador?->nombre }} {{ $selectedJugador?->apellido }}
            </flux:heading>
            <p style="opacity: 0.8; font-size: 14px; margin-top: 4px;">Historial de participación</p>
            
            <div style="position: absolute; right: 30px; top: 30px; font-size: 40px; opacity: 0.2;">🏆</div>
        </div>

        <div style="padding: 24px; max-height: 70vh; overflow-y: auto; background: #fff;">
            
            @php
                $topMedals = collect($resultados)->filter(fn($r) => in_array($r['posicion'], [1,2,3]));
            @endphp

            @if ($topMedals->count())
                <div style="background: #fefce8; border: 1px solid #fef08a; border-radius: 16px; padding: 20px; margin-bottom: 25px; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);">
                    <h3 style="font-size: 11px; font-weight: 900; color: #854d0e; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                         Medallero Personal
                    </h3>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        @foreach ($topMedals as $r)
                            <div style="background: white; padding: 10px; border-radius: 12px; border: 1px solid #fef08a; text-align: center; min-width: 70px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                                <span style="font-size: 28px; display: block; margin-bottom: 4px;">
                                    {{ match($r['posicion']) { 1 => '🥇', 2 => '🥈', 3 => '🥉', default => '' } }}
                                </span>
                                <div style="font-size: 10px; font-weight: 800; color: #a16207; text-transform: uppercase;">
                                    {{ match($r['posicion']) { 1 => 'Oro', 2 => 'Plata', 3 => 'Bronce', default => '' } }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <h3 style="font-weight: 800; color: #002c53; margin-bottom: 15px; font-size: 16px; display: flex; align-items: center; gap: 8px;">
                <flux:icon name="chart-bar" style="width: 18px; color: #facc15;" variant="mini" /> 
                Historial de torneos
            </h3>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                @forelse ($resultados as $r)
                    <div class="result-row {{ match((int)$r['posicion']){ 1=>'res-oro', 2=>'res-plata', 3=>'res-bronce', default=>'' } }}" 
                         style="display: flex; justify-content: space-between; align-items: center; padding: 16px; border-radius: 16px; background: #f8fafc; border: 1px solid #e2e8f0; transition: all 0.2s;">
                        
                        <div>
                            <div style="font-weight: 800; color: #002c53; font-size: 15px; margin-bottom: 2px;">
                                {{ $r['torneo']['nombre'] ?? 'Torneo' }}
                            </div>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <span style="font-size: 9px; background: #002c53; color: white; padding: 2px 8px; border-radius: 4px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;">
                                    {{ $r['torneo']['tipo'] ?? 'Externo' }}
                                </span>
                                <span style="font-size: 12px; color: #64748b;">
                                    Finalizado
                                </span>
                            </div>
                        </div>

                        <div style="text-align: right;">
                            <div style="font-size: 10px; color: #94a3b8; font-weight: bold; margin-bottom: 2px; text-transform: uppercase;">Posición</div>
                            <div style="
                                font-size: 16px; 
                                font-weight: 900;
                                color: {{ match((int)$r['posicion']){ 1=>'#854d0e', 2=>'#475569', 3=>'#9a3412', default=>'#64748b' } }};
                            ">
                                {{ match((int)$r['posicion']){ 
                                    1 => '🥇 1er Lugar', 
                                    2 => '🥈 2do Lugar', 
                                    3 => '🥉 3er Lugar', 
                                    default => 'Puesto #' . $r['posicion'] 
                                } }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 40px; color: #64748b; background: #f8fafc; border-radius: 16px; border: 2px dashed #e2e8f0;">
                        <flux:icon name="information-circle" style="width: 24px; margin: 0 auto 10px; opacity: 0.5;" />
                        <p>Aún no se han registrado participaciones en torneos.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div style="padding: 20px; background: #f8fafc; border-top: 1px solid #e2e8f0; text-align: right;">
            <flux:modal.close>
                <flux:button variant="filled" style="background: #002c53; color: white; padding-left: 30px; padding-right: 30px; border-radius: 12px; font-weight: bold;">
                    Cerrar Perfil
                </flux:button>
            </flux:modal.close>
        </div>
    </flux:modal>

        <livewire:sistema.protejo-mi-mente.footer />

</div>