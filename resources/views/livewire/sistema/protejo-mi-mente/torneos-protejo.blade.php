<div class="medallero-wrapper" 
x-data="{ 
    imgModalSrc: '',
    currentIndex: 0,
    currentImages: [],

    openGallery(images, index) {
        this.currentImages = images;
        this.currentIndex = index;
        this.imgModalSrc = images[index];
        $flux.modal('image-viewer').show();
    },

    next() {
        if (this.currentIndex < this.currentImages.length - 1) {
            this.currentIndex++;
            this.imgModalSrc = this.currentImages[this.currentIndex];
        }
    },

    prev() {
        if (this.currentIndex > 0) {
            this.currentIndex--;
            this.imgModalSrc = this.currentImages[this.currentIndex];
        }
    }
}">
 <style>
    /* Botón de Ver Detalles */
.btn-detalle-container {
    padding: 0 20px 20px;
    margin-top: -10px;
}

.btn-detalle {
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border: none;
    border-radius: 14px;
    font-weight: 800;
    font-size: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2);
}

.btn-detalle:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.4);
    filter: brightness(1.1);
}

.btn-detalle:active {
    transform: translateY(0);
}

        .medallero-container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 40px 16px; font-family: 'Inter', sans-serif; }
        
        /* Filtros de Año */
        .year-selector { display: flex; gap: 12px; margin-bottom: 35px; overflow-x: auto; padding: 5px; scrollbar-width: none; }
        .year-selector::-webkit-scrollbar { display: none; }
        .year-btn {
            padding: 12px 28px; border-radius: 16px; background: white; color: #64748b;
            font-weight: 800; cursor: pointer; transition: all 0.3s ease;
            border: 2px solid #e5e7eb; white-space: nowrap;
        }
        .year-btn:hover { border-color: #facc15; transform: translateY(-2px); }
        .year-btn.active { background: #002c53; color: #facc15; border-color: #002c53; box-shadow: 0 10px 15px -3px rgba(0, 44, 83, 0.3); }

        /* Grid de Torneos */
        .tournament-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px; }
        .tournament-card {
            background: white; border-radius: 28px; border: 1px solid #f1f5f9;
            transition: all 0.5s ease; display: flex; flex-direction: column;
            overflow: hidden; cursor: pointer; position: relative;
        }
        
        .tournament-card:hover { transform: translateY(-12px); box-shadow: 0 25px 50px -12px rgba(0, 44, 83, 0.15); }

        .card-img-wrapper { width: 100%; height: 220px; overflow: hidden; position: relative; background: #002c53; }
        .card-img-wrapper img { width: 100%; height: 100%; object-fit: cover; transition: 0.8s; }
        
        .type-tag {
            position: absolute; top: 15px; left: 15px;
            padding: 8px 16px; border-radius: 12px; font-size: 11px; font-weight: 900; 
            text-transform: uppercase; z-index: 30; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            letter-spacing: 0.5px;
        }
        .tag-interno { background: #facc15; color: #002c53; }
        .tag-externo { background: #ffffff; color: #002c53; border: 1px solid #e2e8f0; }

        .card-header-custom { background: #002c53; padding: 24px; color: white; }

        /* Podio Visual */
        .podium-container { display: flex; align-items: flex-end; justify-content: center; gap: 8px; margin: 20px 0; padding: 10px; background: #f8fafc; border-radius: 24px; }
        .podium-step { flex: 1; display: flex; flex-direction: column; align-items: center; text-align: center; border-radius: 16px; padding: 12px 5px; min-width: 0; }
        .step-1 { background: #fefce8; border: 2px solid #facc15; min-height: 160px; order: 2; transform: scale(1.05); }
        .step-2 { background: #f1f5f9; border: 2px solid #cbd5e1; min-height: 135px; order: 1; }
        .step-3 { background: #fff7ed; border: 2px solid #fb923c; min-height: 120px; order: 3; }
        
        /* Galerías */
        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(110px, 1fr)); gap: 12px; }
        .gallery-item { border-radius: 16px; overflow: hidden; cursor: zoom-in; height: 110px; background: #eee; }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: 0.4s; }
        .gallery-item:hover img { transform: scale(1.1); }
    </style>

    <livewire:sistema.protejo-mi-mente.dashboard />

    <div class="medallero-container">
        {{-- HEADER --}}
        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:40px; gap:20px; flex-wrap:wrap;">
            <div>
                <flux:heading size="xl" style="color:#002c53; font-weight:900; font-size: 2.5rem;">Ajedrez en Boca del Monte</flux:heading>
                <flux:subheading style="font-size: 1.1rem;">Cronología y excelencia deportiva</flux:subheading>
            </div>
            <div style="position:relative;">
                <input type="text" placeholder="Buscar torneo..." wire:model.live="search"
                    style="padding:14px 20px 14px 45px; border-radius:15px; border:2px solid #e5e7eb; width:300px; outline:none; transition:0.3s;"
                    onfocus="this.style.borderColor='#facc15'">
                <span style="position:absolute; left:15px; top:15px; opacity:0.4;">🔍</span>
            </div>
        </div>

        {{-- AÑOS --}}
        <div class="year-selector">
            @foreach(['2022','2023','2024','2025','2026'] as $y)
                <button wire:click="setYear('{{ $y }}')" class="year-btn {{ $year == $y ? 'active' : '' }}">
                    {{ $y }}
                </button>
            @endforeach
        </div>

        {{-- GRID TORNEOS --}}
        {{-- GRID TORNEOS --}}
            <div class="tournament-grid">
                @foreach ($this->torneos as $t)
                    @php $portada = $t->imagenes->firstWhere('tipo','portada'); @endphp
                    
                    <div class="tournament-card"> {{-- Quitamos el click de aquí --}}
                        <div class="card-img-wrapper">
                            <div class="type-tag {{ $t->tipo === 'interno' ? 'tag-interno' : 'tag-externo' }}">
                                {{ $t->tipo }}
                            </div>
                            <img src="{{ $portada ? asset($portada->ruta) : asset('img/protejo-mi-mente.png') }}">
                        </div>
                        
                        <div class="card-header-custom">
                            <flux:heading size="lg" style="color:#facc15; font-weight:800; margin:0;">
                                {{ $t->nombre }}
                            </flux:heading>
                        </div>
                        
                        <div style="padding:20px;">
                            <div style="display:flex; align-items:center; gap:10px; color:#64748b; font-size:14px; margin-bottom:8px;">
                                <span>📅</span>
                                <strong>{{ \Carbon\Carbon::parse($t->fecha_inicio)->translatedFormat('d M') }} - {{ \Carbon\Carbon::parse($t->fecha_fin)->translatedFormat('d M Y') }}</strong>
                            </div>
                            <div style="display:flex; align-items:center; gap:10px; color:#64748b; font-size:14px;">
                                <span>📍</span>
                                <span>{{ $t->lugar }}</span>
                            </div>
                        </div>

                        {{-- NUEVO BOTÓN --}}
                        <div class="btn-detalle-container">
                            <button class="btn-detalle" wire:click="openTorneo({{ $t->id }})">
                                <span>Ver información</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>


        <div style="margin-top:40px;">{{ $this->torneos->links() }}</div>
    </div>

    {{-- MODAL DETALLE --}}
    <flux:modal name="torneo-detalle" style="max-width:1000px; width:95%; padding:0 !important; border-radius:30px; overflow:hidden;">
        @if($torneoSeleccionado)
            @php
                $imagenes = collect($torneoSeleccionado->imagenes);
                $oro = $imagenes->firstWhere('tipo','gold');
                $plata = $imagenes->firstWhere('tipo','silver');
                $bronce = $imagenes->firstWhere('tipo','bronze');
                $ganadores = $imagenes->firstWhere('tipo','ganadores');
                $top = $torneoSeleccionado->participaciones->groupBy('categoria_id');
                $posiciones = $torneoSeleccionado->resultados->whereIn('posicion', [1,2,3])->groupBy('jugador_id');
            @endphp

            <div style="background:#002c53; padding:40px 30px; color:white;">
                <flux:heading size="xl" style="color:white !important; font-weight:900; margin:0;">{{ $torneoSeleccionado->nombre }}</flux:heading>
                <div style="color:#facc15; font-weight:bold; margin-top:5px;">Resultados y Galería Oficial</div>
            </div>

            <div style="padding:30px; background:#fcfcfc; max-height:75vh; overflow-y:auto;">
               @if($oro && $plata && $bronce)

                    @php
                        $podioImgs = [
                            asset($plata->ruta),
                            asset($oro->ruta),
                            asset($bronce->ruta)
                        ];
                    @endphp

                    <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:15px; margin-bottom:40px;">
                        
                        {{-- PLATA --}}
                        <div style="text-align:center;">
                            <img 
                                src="{{ asset($plata->ruta) }}" 
                                @click="openGallery(@js($podioImgs), 0)"
                                style="width:100%; aspect-ratio:1; object-fit:cover; border-radius:20px; border:3px solid #cbd5e1; cursor:pointer;"
                            >
                        </div>

                        {{-- ORO --}}
                        <div style="text-align:center; transform: translateY(-15px);">
                            <img 
                                src="{{ asset($oro->ruta) }}" 
                                @click="openGallery(@js($podioImgs), 1)"
                                style="width:100%; aspect-ratio:1; object-fit:cover; border-radius:20px; border:4px solid #facc15; cursor:pointer; box-shadow:0 15px 30px rgba(250,204,21,0.3);"
                            >
                        </div>

                        {{-- BRONCE --}}
                        <div style="text-align:center;">
                            <img 
                                src="{{ asset($bronce->ruta) }}" 
                                @click="openGallery(@js($podioImgs), 2)"
                                style="width:100%; aspect-ratio:1; object-fit:cover; border-radius:20px; border:3px solid #fb923c; cursor:pointer;"
                            >
                        </div>

                    </div>

                @elseif($ganadores)
                <div style="
                    position:relative; 
                    margin-bottom:35px; 
                    border-radius:24px; 
                    overflow:hidden; 
                    box-shadow:0 10px 30px rgba(0,0,0,0.15);
                    background: transparent; /* 👈 aquí el cambio */
                ">
                     @php
                    $ganadoresArr = [asset($ganadores->ruta)];
                    @endphp

                    <img src="{{ asset($ganadores->ruta) }}"
                    @click="openGallery(@js($ganadoresArr), 0)">

                    </div>
                @endif

                @foreach ($top as $categoriaId => $items)
                    <div style="background:white; border-radius:24px; padding:25px; margin-bottom:25px; border:1px solid #f1f5f9; box-shadow:0 10px 15px -3px rgba(0,0,0,0.05);">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                            <h3 style="margin:0; font-weight:900; color:#002c53; font-size:1.3rem;">🏷️ {{ optional($items->first()->categoria)->nombre }}</h3>
                            <flux:button variant="ghost" wire:click="openResultados({{ $categoriaId }})" style="color:#002c53; font-weight:800;">Ver Tabla Completa</flux:button>
                        </div>
                        <div class="podium-container">
                           @foreach([2, 1, 3] as $rank)
                            @php
                                $participantes = $items->filter(function($p) use ($posiciones, $rank) {
                                    return $posiciones->has($p->jugador_id) && 
                                        $posiciones->get($p->jugador_id)->first()->posicion == $rank;
                                });

                                $equipos = $participantes->groupBy('equipo_id');
                            @endphp

                            <div class="podium-step step-{{ $rank }}">
                                <div style="font-size:28px; margin-bottom:5px;">
                                    {{ match($rank){1=>'🥇', 2=>'🥈', 3=>'🥉'} }}
                                </div>

                                @if($equipos->count())

                                    @foreach($equipos as $equipoId => $jugadores)
                                        
                                        <div style="margin-bottom:6px;">

                                            {{-- Nombre del equipo --}}
                                            <div style="font-size:11px; font-weight:800; color:#64748b;">
                                                {{ optional($jugadores->first()->equipo)->nombre ?? 'Individual' }}
                                            </div>

                                            {{-- Jugadores --}}
                                            @foreach($jugadores as $jugador)
                                                <div style="font-size:13px; font-weight:900; color:#002c53;">
                                                    {{ $jugador->jugador->nombre }} {{ $jugador->jugador->apellido }}
                                                </div>
                                            @endforeach

                                        </div>

                                    @endforeach

                                @else
                                    <div style="font-size:10px; opacity:0.3; font-weight:bold;">—</div>
                                @endif
                            </div>

                        @endforeach
                        </div>
                    </div>
                @endforeach

                <div style="white-space:pre-line; color:#475569; line-height:1.7; padding:25px; background:#fff; border-radius:20px; border:1px solid #f1f5f9; margin-bottom:30px;">
                    {{ $torneoSeleccionado->descripcion }}
                </div>

               <div style="display:flex; flex-direction:column; gap:30px;">

    @foreach ([
        'imagen_talleres' => '🎓 Proceso de formación',
        'imagen_torneos' => '🏆 Desarrollo del torneo'
    ] as $tipo => $titulo)

        @if ($imagenes->where('tipo', $tipo)->count())
            <div>
                
                {{-- TÍTULO --}}
                <h4 style="color:#002c53; font-weight:800; margin-bottom:15px; font-size:15px;">
                    {{ $titulo }}
                </h4>

                {{-- GALERÍA --}}
                <div style="display:flex; flex-wrap:wrap; gap:12px; justify-content:center;">
                    
                    @php
                        $imgsArray = $imagenes->where('tipo', $tipo)
                            ->pluck('ruta')
                            ->map(fn($r) => asset($r))
                            ->values();
                        @endphp

                        @foreach ($imgsArray as $i => $img)
                            <div 
                                style="width:120px; height:110px; border-radius:16px; overflow:hidden; cursor:pointer;"
                                @click="openGallery(@js($imgsArray), {{ $i }})"
                            >
                                <img 
                                    src="{{ $img }}" 
                                    style="width:100%; height:100%; object-fit:cover;"
                                >
                            </div>
                        @endforeach

                </div>

            </div>
        @endif

    @endforeach

</div>

            </div>
            
            <div style="padding:20px; text-align:right; background:#f1f5f9; border-top:1px solid #e2e8f0;">
                <flux:modal.close>
                    <flux:button variant="filled" style="background:#002c53; color:white; padding:10px 30px; border-radius:12px;">Cerrar Detalle</flux:button>
                </flux:modal.close>
            </div>
        @endif
    </flux:modal>


    {{-- MODAL TABLA DE RESULTADOS --}}
    <flux:modal name="resultados-categoria" style="max-width:800px; width:95%; border-radius:28px; overflow:hidden;">

    @if($torneoSeleccionado && $categoriaSeleccionada)

        @php
            $categoriaNom = $torneoSeleccionado->participaciones
                ->where('categoria_id', $categoriaSeleccionada)
                ->first()?->categoria?->nombre;

            $participaciones = $torneoSeleccionado->participaciones
                ->where('categoria_id', $categoriaSeleccionada);

            $resultados = $torneoSeleccionado->resultados
                ->sortBy('posicion')
                ->groupBy('jugador_id');
        @endphp

        {{-- HEADER --}}
        <div style="background:#002c53; padding:25px; color:white;">
            <flux:heading size="lg" style="color:white !important; font-weight:900;">
                {{ $categoriaNom }}
            </flux:heading>
            <div style="font-size:14px; opacity:0.8;">
                Tabla completa de posiciones
            </div>
        </div>

        {{-- TABLA --}}
        <div style="padding:25px; max-height:70vh; overflow-y:auto;">
            <table style="width:100%; border-collapse:separate; border-spacing:0 8px;">

                {{-- HEAD --}}
                <thead>
                    <tr style="color:#64748b; font-size:12px; text-transform:uppercase; letter-spacing:1px;">
                        <th style="padding:10px; text-align:left;">Jugador</th>
                        <th style="padding:10px; text-align:left;">Equipo</th>
                        <th style="padding:10px; text-align:center;">Posición</th>
                    </tr>
                </thead>

                {{-- BODY --}}
                <tbody>
                    @foreach ($participaciones as $p)

                        @php
                            $r = $resultados->get($p->jugador_id)?->first();
                        @endphp

                        @if($r)
                            <tr style="background:#f8fafc; transition:0.2s;">

                                {{-- JUGADOR --}}
                                <td style="padding:15px; border-radius:12px 0 0 12px; font-weight:700; color:#002c53;">
                                    {{ $p->jugador->nombre }} {{ $p->jugador->apellido }}
                                </td>

                                {{-- EQUIPO --}}
                                <td style="padding:15px; color:#64748b;">
                                    {{ optional($p->equipo)->nombre ?? 'Individual' }}
                                </td>

                                {{-- POSICIÓN --}}
                                <td style="padding:15px; border-radius:0 12px 12px 0; text-align:center;">
                                    @if($r->posicion == 1)
                                        <span style="background:#fefce8; color:#a16207; padding:5px 12px; border-radius:10px; font-weight:900;">
                                            🥇 1ro
                                        </span>
                                    @elseif($r->posicion == 2)
                                        <span style="background:#f1f5f9; color:#475569; padding:5px 12px; border-radius:10px; font-weight:900;">
                                            🥈 2do
                                        </span>
                                    @elseif($r->posicion == 3)
                                        <span style="background:#fff7ed; color:#9a3412; padding:5px 12px; border-radius:10px; font-weight:900;">
                                            🥉 3ro
                                        </span>
                                    @else
                                        <span style="color:#94a3b8; font-weight:bold;">
                                            #{{ $r->posicion }}
                                        </span>
                                    @endif
                                </td>

                            </tr>
                        @endif

                    @endforeach
                </tbody>

            </table>
        </div>

    @endif

</flux:modal>

{{-- MODAL VISOR DE IMAGEN (USANDO FLUX) --}}
<flux:modal name="image-viewer" variant="flyout" style="background: rgba(0,0,0,0.95); max-width: 100vw; padding: 0;">
    
    <div style="height:100vh; width:100vw; display:flex; align-items:center; justify-content:center; position:relative;">

        {{-- Flecha izquierda (desktop) --}}
        <template x-if="currentIndex > 0">
            <button @click="prev"
                style="
                    position:absolute; 
                    left:20px; 
                    top:50%; 
                    transform:translateY(-50%);
                    background:rgba(255,255,255,0.1); 
                    color:white; 
                    border:none;
                    width:50px; 
                    height:50px; 
                    border-radius:50%; 
                    font-size:22px; 
                    cursor:pointer;
                ">
                ‹
            </button>
        </template>

        {{-- Imagen --}}
        <img :src="imgModalSrc"
            style="max-width:95%; max-height:90vh; object-fit:contain; border-radius:10px;">

        {{-- Flecha derecha (desktop) --}}
        <template x-if="currentIndex < currentImages.length - 1">
            <button @click="next"
                style="
                    position:absolute; 
                    right:20px; 
                    top:50%; 
                    transform:translateY(-50%);
                    background:rgba(255,255,255,0.1); 
                    color:white; 
                    border:none;
                    width:50px; 
                    height:50px; 
                    border-radius:50%; 
                    font-size:22px; 
                    cursor:pointer;
                ">
                ›
            </button>
        </template>

        {{-- Controles móviles --}}
        <div class="mobile-controls"
            style="
                position:absolute; 
                bottom:20px; 
                left:50%; 
                transform:translateX(-50%);
                gap:20px;
            "
        >
            <template x-if="currentIndex > 0">
                <button @click="prev"
                    style="
                        background:rgba(255,255,255,0.15); 
                        color:white; 
                        border:none;
                        padding:14px 22px; 
                        border-radius:12px; 
                        font-size:18px;
                    ">
                    ←
                </button>
            </template>

            <template x-if="currentIndex < currentImages.length - 1">
                <button @click="next"
                    style="
                        background:rgba(255,255,255,0.15); 
                        color:white; 
                        border:none;
                        padding:14px 22px; 
                        border-radius:12px; 
                        font-size:18px;
                    ">
                    →
                </button>
            </template>
        </div>

        {{-- Botón cerrar --}}
        

    </div>
</flux:modal>

    <livewire:sistema.protejo-mi-mente.footer />

</div>