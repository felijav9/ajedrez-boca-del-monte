<div class="medallero-wrapper" 
x-data="{
    imgModalSrc: '',
    currentIndex: 0,
    currentImages: [],

    canScrollLeft: false,
    canScrollRight: false,

    init() {
        this.checkScroll();
    },

    checkScroll() {
        const el = this.$refs.container;

        if (!el) return;

        this.canScrollLeft = el.scrollLeft > 0;
        this.canScrollRight = el.scrollLeft + el.clientWidth < el.scrollWidth;
    },

    scrollNext() {
        this.$refs.container.scrollBy({ left: 400, behavior: 'smooth' });
        setTimeout(() => this.checkScroll(), 300);
    },

    scrollPrev() {
        this.$refs.container.scrollBy({ left: -400, behavior: 'smooth' });
        setTimeout(() => this.checkScroll(), 300);
    },

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
}"

>
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

/* Estados del Torneo */
/* Base para todos los tags de estado */
/* Estados del Torneo - Estilo Vibrante */
.status-tag {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 6px 12px;
    border-radius: 10px; /* Bordes ligeramente redondeados según tu estilo */
    font-size: 10px;
    font-weight: 800;
    text-transform: uppercase;
    z-index: 30;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    color: white; /* Todos los textos en blanco para resaltar sobre el fondo sólido */
    display: flex;
    align-items: center;
}

/* Estado: por_realizarse (Gris Azulado) */
.status-por_realizarse {
    background: #64748b; 
}

/* Estado: en_curso (Azul Intenso con Animación) */
.status-en_curso {
    background: #ef4444; /* Rojo vibrante */
    animation: pulse-live 1.5s infinite;
    box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); /* Efecto de brillo inicial */
}

/* Estado: finalizado (Verde Esmeralda) */
.status-finalizado {
    background: #10b981;
}

/* Animación de pulso sutil */
@keyframes pulse-simple {
    0% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.85; transform: scale(1.02); }
    100% { opacity: 1; transform: scale(1); }
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


        /* --- NUEVA CONFIGURACIÓN CARRUSEL GLOBAL --- */
.tournament-container-relative {
    position: relative;
    display: flex;
    align-items: center;
    group;
}

.tournament-grid {
    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    scroll-behavior: smooth; /* Para que al darle click a la flecha deslice suave */
    gap: 25px;
    padding: 20px 5px;
    scrollbar-width: none; /* Firefox */
}

.tournament-grid::-webkit-scrollbar {
    display: none; /* Chrome/Safari */
}

.tournament-card {
    flex: 0 0 320px; /* Ancho fijo en escritorio */
    scroll-snap-align: start;
}

/* Flechas de Navegación (Solo visibles en Desktop) */
.nav-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 40;
    transition: all 0.3s ease;
    border: 1px solid #f1f5f9;
}

.nav-arrow:hover {
    background: #facc15;
    color: #002c53;
}

.arrow-left { left: -25px; }
.arrow-right { right: -25px; }

@media (max-width: 767px) {
    .nav-arrow { display: none; } /* Ocultar flechas en móvil */
    .tournament-card {
        flex: 0 0 85%; /* En móvil se mantiene el tamaño relativo */
    }
}
        
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
          {{-- GRID TORNEOS CON NAVEGACIÓN --}}
<div class="tournament-container-relative" x-data="{ 
    scrollNext() { $refs.container.scrollBy({ left: 400, behavior: 'smooth' }) },
    scrollPrev() { $refs.container.scrollBy({ left: -400, behavior: 'smooth' }) }
}">
    
    {{-- Flecha Izquierda --}}
    <button class="nav-arrow arrow-left"
    @click="scrollPrev(); checkScroll()"
    x-show="canScrollLeft">

        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
    </button>

    {{-- Contenedor del Carrusel --}}
            <div class="tournament-grid" x-ref="container"
             @scroll="checkScroll">
                @foreach ($this->torneos as $t)
                    @php $portada = $t->imagenes->firstWhere('tipo','portada'); @endphp
                    
                    <div class="tournament-card">
                        <div class="card-img-wrapper">
                            {{-- Etiquetas de Tipo y Estado --}}
                            <div class="type-tag {{ $t->tipo === 'interno' ? 'tag-interno' : 'tag-externo' }}">
                                {{ $t->tipo }}
                            </div>

                            <div class="status-tag status-{{ $t->estado }}">
                                @switch($t->estado)
                                    @case('por_realizarse') Próximamente @break
                                    @case('en_curso') En Vivo @break
                                    @case('finalizado') Finalizado @break
                                @endswitch
                            </div>

                            <img src="{{ $portada ? asset($portada->ruta) : asset('img/protejo-mi-mente.png') }}">
                        </div>
                        
                        <div class="card-header-custom">
                            <flux:heading size="lg" style="color:#facc15; font-weight:800; margin:0;">
                                {{ $t->nombre }}
                            </flux:heading>
                        </div>
                        
                        <div style="padding:20px;">
                            {{-- Fecha --}}
                            <div style="display:flex; align-items:center; gap:10px; color:#64748b; font-size:14px; margin-bottom:8px;">
                                <span>📅</span>
                                <strong>{{ \Carbon\Carbon::parse($t->fecha_inicio)->translatedFormat('d M') }} - {{ \Carbon\Carbon::parse($t->fecha_fin)->translatedFormat('d M Y') }}</strong>
                            </div>
                            {{-- Lugar --}}
                            <div style="display:flex; align-items:center; gap:10px; color:#64748b; font-size:14px;">
                                <span>📍</span>
                                <span>{{ $t->lugar }}</span>
                            </div>
                        </div>

                        {{-- Botón de Acción --}}
                        <div class="btn-detalle-container">
                            <button class="btn-detalle" wire:click="openTorneo({{ $t->id }})">
                                <span>Ver información</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Flecha Derecha --}}
            <button class="nav-arrow arrow-right"
    @click="scrollNext(); checkScroll()"
    x-show="canScrollRight">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </button>
        </div>


        <div style="margin-top:40px;">{{ $this->torneos->links() }}</div>
    </div>

    {{-- MODAL DETALLE --}}
   <flux:modal name="torneo-detalle" style="max-width:1000px; width:95%; padding:0 !important; border-radius:30px; overflow:hidden;">
    @if($torneoSeleccionado && $torneoSeleccionado->estado === 'finalizado')
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

        <div style="padding:30px; background:#fcfcfc; height:80vh; overflow-y:auto; -webkit-overflow-scrolling: touch; overscroll-behavior: contain;">
            
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
                <div style="position:relative; margin-bottom:35px; border-radius:24px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.15); background: transparent;">
                    @php
                        $ganadoresArr = [asset($ganadores->ruta)];
                    @endphp
                    <img src="{{ asset($ganadores->ruta) }}" @click="openGallery(@js($ganadoresArr), 0)" style="width:100%; object-fit:cover;">
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
                                            <div style="font-size:11px; font-weight:800; color:#64748b;">
                                                {{ optional($jugadores->first()->equipo)->nombre ?? 'Individual' }}
                                            </div>
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
                @foreach (['imagen_talleres' => '🎓 Proceso de formación', 'imagen_torneos' => '🏆 Desarrollo del torneo'] as $tipo => $titulo)
                    @if ($imagenes->where('tipo', $tipo)->count())
                        <div>
                            <h4 style="color:#002c53; font-weight:800; margin-bottom:15px; font-size:15px;">{{ $titulo }}</h4>
                            <div style="display:flex; flex-wrap:wrap; gap:12px; justify-content:center;">
                                @php
                                    $imgsArray = $imagenes->where('tipo', $tipo)->pluck('ruta')->map(fn($r) => asset($r))->values();
                                @endphp
                                @foreach ($imgsArray as $i => $img)
                                    <div style="width:120px; height:110px; border-radius:16px; overflow:hidden; cursor:pointer;" @click="openGallery(@js($imgsArray), {{ $i }})">
                                        <img src="{{ $img }}" style="width:100%; height:100%; object-fit:cover;">
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

    {{-- NUEVA SECCIÓN: POR REALIZARSE --}}
    {{-- NUEVA SECCIÓN: POR REALIZARSE --}}
@elseif($torneoSeleccionado && $torneoSeleccionado->estado === 'por_realizarse')
    @php
        $registrados = $torneoSeleccionado->participaciones->map(function($p) {
            return [
                'nombre' => $p->jugador->nombre . ' ' . $p->jugador->apellido,
                'equipo' => optional($p->equipo)->nombre ?? 'Individual',
                'categoria' => optional($p->categoria)->nombre ?? 'General',
                'genero' => $p->jugador->genero,
                'edad' => $p->jugador->edad . ' años',
                'search' => strtolower($p->jugador->nombre . ' ' . $p->jugador->apellido . ' ' . (optional($p->equipo)->nombre ?? '') . ' ' . (optional($p->categoria)->nombre ?? ''))
            ];
        })->sortBy('nombre')->values();
    @endphp

    <div style="background: linear-gradient(135deg, #002c53 0%, #1e40af 100%); padding:40px 30px; color:white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <flux:heading size="xl" style="color:white !important; font-weight:900; margin:0;">{{ $torneoSeleccionado->nombre }}</flux:heading>
                <div style="background: #facc15; color: #002c53; display: inline-block; padding: 4px 12px; border-radius: 8px; font-size: 12px; font-weight: 800; margin-top: 10px; text-transform: uppercase;">
                    Próximo Evento ⏳
                </div>
            </div>
        </div>
    </div>

    <div style="padding:30px; background:#fcfcfc; max-height:75vh; overflow-y:auto;" 
         x-data="{ 
            search: '', 
            jugadores: @js($registrados),
            get filteredJugadores() {
                return this.jugadores.filter(j => j.search.includes(this.search.toLowerCase()))
            }
         }">

        
         {{-- JUGADORES CONFIRMADOS --}}
<div style="
    background: white; 
    border-radius: 24px; 
    border: 1px solid #f1f5f9; 
    overflow: hidden; 
    box-shadow: 0 10px 25px -5px rgba(0, 44, 83, 0.08);
    transition: transform 0.3s ease;
    margin-bottom: 35px;
"
onmouseover="this.style.transform='translateY(-2px)'"
onmouseout="this.style.transform='translateY(0)'">

    {{-- HEADER --}}
    <div style="
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        padding: 20px 24px;
        background: linear-gradient(to right, #ffffff, #f8fafc);
        flex-wrap: wrap;
        gap: 15px;
    ">

        {{-- TITULO --}}
        <div style="display: flex; align-items: center; gap: 14px; min-width: 220px;">

            <div style="
                background: #002c53; 
                width: 45px; 
                height: 45px; 
                border-radius: 14px; 
                display: flex; 
                align-items: center; 
                justify-content: center;
                box-shadow: 0 4px 10px rgba(0, 44, 83, 0.15);
                flex-shrink: 0;
            ">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="15" cy="7" r="3"/>
                    <path d="M11 21v-3a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3v3"/>
                    <circle cx="7" cy="7" r="3"/>
                    <path d="M3 21v-2a4 4 0 0 1 4-4h2"/>
                </svg>
            </div>

            <div>
                <h4 style="
                    margin: 0; 
                    color: #002c53; 
                    font-weight: 800; 
                    font-size: 17px;
                    line-height: 1.2;
                ">
                    Jugadores Confirmados
                </h4>
            </div>

        </div>

        {{-- BOTONES --}}
        <div style="
            display: flex; 
            gap: 10px; 
            flex-wrap: wrap;
            justify-content: flex-end;
        ">

            {{-- LISTA --}}
            <button 
                x-on:click="$flux.modal('jugadores-confirmados').show()"
                style="
                    background: #002c53; 
                    color: #facc15; 
                    padding: 10px 16px; 
                    border-radius: 12px; 
                    font-size: 13px; 
                    font-weight: 700; 
                    border: none;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    transition: all 0.2s ease;
                    white-space: nowrap;
                "
            >
                Ver lista
            </button>

            {{-- LIVE --}}
            <button
                x-on:click="$wire.openLiveResults({{ $t->id }})"
                style="
                    background: #10b981; 
                    color: white; 
                    padding: 10px 16px; 
                    border-radius: 12px; 
                    font-size: 13px; 
                    font-weight: 700; 
                    border: none; 
                    cursor: pointer; 
                    display: flex; 
                    align-items: center; 
                    gap: 8px;
                    white-space: nowrap;
                "
            >
                ⚡ Live
            </button>

            {{-- EMPAREJAMIENTOS --}}
            <button
                x-on:click="$wire.openEmparejamientos({{ $t->id }})"
                style="
                    background: #f59e0b; 
                    color: white; 
                    padding: 10px 16px; 
                    border-radius: 12px; 
                    font-size: 13px; 
                    font-weight: 700; 
                    border: none; 
                    cursor: pointer; 
                    display: flex; 
                    align-items: center; 
                    gap: 8px;
                    white-space: nowrap;
                "
            >
                ♟️ Emparejamientos
            </button>

        </div>

    </div>
</div>


        {{-- DETALLES DEL TORNEO --}}
        <div style="margin-bottom: 35px;">
            <h4 style="color:#002c53; font-weight:800; margin-bottom:12px; font-size: 1.1rem; display: flex; align-items: center; gap: 8px;">
                <span>📝</span> Detalles del Torneo
            </h4>

            <div style="white-space:pre-line; color:#475569; line-height:1.6; padding:20px; background:white; border-radius:15px; border:1px solid #e2e8f0;">
                {{ $torneoSeleccionado->descripcion }}
            </div>
        </div>
    </div>

    <div style="padding:20px; text-align:right; background:#f1f5f9; border-top:1px solid #e2e8f0;">
        <flux:modal.close>
            <flux:button variant="filled" style="background:#002c53; color:white; padding:10px 30px; border-radius:12px;">
                Cerrar
            </flux:button>
        </flux:modal.close>
    </div>
@endif
</flux:modal>

    {{-- MODAL JUGADORES --}}
 {{-- MODAL JUGADORES CONFIRMADOS --}}
<flux:modal name="jugadores-confirmados" style="max-width:600px; width:95%; border-radius:32px; overflow:hidden; border:none; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);">

@if($torneoSeleccionado && $torneoSeleccionado->estado === 'por_realizarse')

@php
    $registrados = $torneoSeleccionado->participaciones->map(function($p) {
        return [
            'nombre' => $p->jugador->nombre . ' ' . $p->jugador->apellido,
            'equipo' => optional($p->equipo)->nombre ?? 'Competidor Individual',
            'categoria' => optional($p->categoria)->nombre ?? 'General',
            'genero' => $p->jugador->genero,
            'edad' => $p->jugador->edad . ' años',
            'search' => strtolower(
                $p->jugador->nombre . ' ' .
                $p->jugador->apellido . ' ' .
                (optional($p->equipo)->nombre ?? '') . ' ' .
                (optional($p->categoria)->nombre ?? '')
            )
        ];
    })->sortBy('nombre')->values();
@endphp

{{-- HEADER --}}
<div style="
    background: linear-gradient(135deg, #002c53 0%, #004d8a 100%); 
    padding: 30px 25px; 
    position: relative; 
    border-bottom: 4px solid #facc15;
">
    <div style="display:flex; align-items:center; gap:20px;">

        <div style="
            background: #002c53; 
            width: 45px; 
            height: 45px; 
            border-radius: 14px; 
            display: flex; 
            align-items: center; 
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 44, 83, 0.15);
        ">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="15" cy="7" r="3"/>
                <path d="M11 21v-3a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3v3"/>
                <circle cx="7" cy="7" r="3"/>
                <path d="M3 21v-2a4 4 0 0 1 4-4h2"/>
            </svg>
        </div>

        <div>
            <h2 style="margin:0; color:white; font-weight:900; font-size:24px;">
                Jugadores Confirmados
            </h2>

            <div style="display:flex; align-items:center; gap:8px; margin-top:6px;">
                <span style="background:#facc15; color:#002c53; padding:3px 12px; border-radius:20px; font-weight:900; font-size:11px;">
                    {{ $registrados->count() }} Participantes
                </span>
            </div>
        </div>
    </div>
</div>

{{-- BODY --}}
<div style="padding:25px 25px 80px 25px; background:#f8fafc; max-height:60vh; overflow-y:auto;"
     x-data="{
        search: '',
        jugadores: @js($registrados),
        get filteredJugadores() {
            return this.jugadores.filter(j => j.search.includes(this.search.toLowerCase()))
        }
     }">

    {{-- BUSCADOR --}}
    <div style="position:relative; margin-bottom:25px;">
        <span style="position:absolute; left:18px; top:50%; transform:translateY(-50%);">🔍</span>
        <input x-model="search" type="text" placeholder="Buscar jugador..."
            style="width:100%; padding:16px 16px 16px 50px; border-radius:18px; border:2px solid #e2e8f0;">
    </div>

    {{-- LISTADO O MENSAJE --}}
    @if($registrados->count() > 0)

        <div style="display:grid; gap:15px;">
            <template x-for="j in filteredJugadores" :key="j.nombre">
                <div style="background:white; padding:18px; border-radius:22px; border:1px solid #edf2f7;">

                    <div style="font-weight:900; color:#002c53;" x-text="j.nombre"></div>
                    <div style="color:#64748b; font-size:13px;" x-text="j.equipo"></div>

                    <div style="display:flex; gap:8px; margin-top:12px; flex-wrap:wrap;">

                        <template x-if="j.genero === 'masculino'">
                            <span style="background:#eff6ff; color:#2563eb; padding:4px 10px; border-radius:8px; font-size:11px; font-weight:800;">
                                ♂️ Masculino
                            </span>
                        </template>

                        <template x-if="j.genero === 'femenino'">
                            <span style="background:#fdf2f8; color:#db2777; padding:4px 10px; border-radius:8px; font-size:11px; font-weight:800;">
                                ♀️ Femenino
                            </span>
                        </template>

                        <span style="background:#f1f5f9; padding:4px 10px; border-radius:8px; font-size:11px; font-weight:800;" x-text="j.edad"></span>

                        <span style="background:#fffbeb; color:#92400e; padding:4px 10px; border-radius:8px; font-size:11px; font-weight:800;" x-text="j.categoria"></span>

                    </div>
                </div>
            </template>
        </div>

    @else

        {{-- 🔥 MENSAJE CUANDO NO HAY JUGADORES --}}
        <div style="text-align:center; padding:60px 20px; color:#64748b;">
            
            <div style="font-size:40px; margin-bottom:10px;">♟️</div>

            <div style="font-weight:800; font-size:16px; color:#002c53;">
                Pronto se ingresarán los jugadores
            </div>

        </div>

    @endif

</div>

{{-- FOOTER --}}
<div style="padding:20px 25px; background:white; border-top:1px solid #f1f5f9; display:flex; justify-content:center;">
    <flux:modal.close>
        <button style="background:#002c53; color:white; padding:14px 60px; border-radius:18px; font-weight:800; border:none;">
            Cerrar Lista
        </button>
    </flux:modal.close>
</div>

@endif

</flux:modal>


    {{-- MODAL TABLA DE RESULTADOS --}}
    <flux:modal name="resultados-categoria" style="max-width:800px; width:95%; border-radius:28px; overflow:hidden;">

    @if($torneoSeleccionado && !is_null($categoriaSeleccionada))

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

<flux:modal name="live-results" style="max-width:800px; width:95%;">

    <div style="background:#002c53; padding:20px; color:white;">
        <h2 style="margin:0;">⚡ Live Results</h2>
        <div style="font-size:13px; opacity:.8;">
            {{ $torneoSeleccionado?->nombre }}
        </div>
    </div>

    <div style="padding:20px; max-height:70vh; overflow-y:auto;">

        @forelse($liveClasificaciones as $c)
    <div style="display:flex; justify-content:space-between; padding:12px; border-bottom:1px solid #eee;">

        <div>

            <strong>
                {{ $c['jugador']->nombre }} {{ $c['jugador']->apellido }}
            </strong>

        </div>

        <div style="display:flex; gap:10px; align-items:center;">
            
            <div style="font-weight:800;">
                {{ $c['pts'] }} pts
            </div>

            <button
                wire:click="verPartidas({{ $c['jugador']->id }})"
                style="background:#002c53; color:white; padding:5px 10px; border-radius:6px; font-size:12px;"
            >
                Ver partidas
            </button>

        </div>

    </div>
@empty
            <div style="text-align:center; padding:40px; color:#64748b;">
                Sin resultados aún
            </div>
        @endforelse

    </div>

    <div style="padding:15px; text-align:right;">
        <flux:modal.close>
            <button style="background:#002c53; color:white; padding:10px 20px; border-radius:10px;">
                Cerrar
            </button>
        </flux:modal.close>
    </div>

</flux:modal>


<flux:modal name="partidas-jugador" style="max-width:800px; width:95%;">

    <div style="background:#002c53; padding:20px; color:white;">
        <h2 style="margin:0;">♟️ Partidas del jugador</h2>
    </div>

    <div style="padding:20px; max-height:70vh; overflow-y:auto;">

        @forelse($this->partidasAgrupadas as $evento => $data)

    <div style="margin-bottom:20px; border:1px solid #eee; border-radius:12px; padding:12px;">

        <div style="font-weight:800;">
            {{ $evento }}
        </div>

        <div style="font-size:12px; margin-bottom:10px; color:#002c53;">
            🏆 {{ $data['pts'] }} pts en este evento
        </div>

        @foreach ($data['partidas'] as $p)
            <div>
                Ronda {{ $p->ronda?->numero }} -
                {{ $p->blancas?->nombre }} {{ $p->blancas?->apellido }} vs {{ $p->negras?->nombre }} {{ $p->negras?->apellido }}
                ({{ $p->resultado }})
            </div>
        @endforeach

    </div>

@empty
            <div style="text-align:center; padding:40px; color:#64748b;">
                No hay partidas
            </div>
        @endforelse

    </div>

    <div style="padding:15px; text-align:right;">
        <flux:modal.close>
            <button style="background:#002c53; color:white; padding:10px 20px; border-radius:10px;">
                Cerrar
            </button>
        </flux:modal.close>
    </div>

</flux:modal>


<flux:modal name="emparejamientos" style="max-width:900px; width:95%;">

    {{-- HEADER --}}
    <div style="background:#f59e0b; padding:20px; color:white;">
        <h2 style="margin:0;">♟️ Emparejamientos</h2>
        <div style="font-size:13px; opacity:.9;">
            {{ $torneoSeleccionado?->nombre }}
        </div>
    </div>

    {{-- BODY --}}
    <div style="padding:20px; max-height:70vh; overflow-y:auto;">

        @forelse($this->emparejamientos as $evento => $rondas)

            {{-- EVENTO --}}
            <div style="margin-bottom:25px; border:1px solid #eee; border-radius:12px; padding:15px; background:#fff;">

                <div style="font-weight:900; font-size:16px; color:#002c53; margin-bottom:15px;">
                    🏆 {{ $evento }}
                </div>

                {{-- RONDAS --}}
                @foreach($rondas as $ronda => $partidas)

                    <div style="margin-bottom:15px; background:#f9fafb; padding:12px; border-radius:10px;">

                        <div style="font-weight:800; margin-bottom:10px; color:#111827;">
                            Ronda {{ $ronda }}
                        </div>

                        {{-- PARTIDAS --}}
                        @foreach($partidas as $p)
                            <div style="
                                display:flex;
                                flex-wrap:wrap;
                                gap:10px;
                                align-items:center;
                                justify-content:space-between;
                                padding:10px 0;
                                border-bottom:1px solid #e5e7eb;
                                font-size:13px;
                            ">

                                {{-- BLANCAS --}}
                                <div style="
                                    display:flex;
                                    align-items:center;
                                    gap:6px;
                                    flex:1;
                                    min-width:140px;
                                ">
                                    <span style="
                                        width:12px;
                                        height:12px;
                                        background:#fff;
                                        border:2px solid #111;
                                        border-radius:50%;
                                        box-shadow:0 1px 2px rgba(0,0,0,.2);
                                    "></span>

                                    <span style="
                                        font-size:10px;
                                        font-weight:900;
                                        color:#111;
                                        background:#f3f4f6;
                                        padding:2px 5px;
                                        border-radius:6px;
                                    ">
                                        BL
                                    </span>

                                    <span style="word-break:break-word;">
                                        {{ $p->blancas?->nombre }} {{ $p->blancas?->apellido }}
                                    </span>
                                </div>

                                {{-- VS --}}
                                <div style="opacity:.5; font-weight:700;">
                                    vs
                                </div>

                                {{-- NEGRAS --}}
                                <div style="
                                    display:flex;
                                    align-items:center;
                                    gap:6px;
                                    flex:1;
                                    min-width:140px;
                                ">
                                    <span style="
                                        width:12px;
                                        height:12px;
                                        background:#111;
                                        border-radius:50%;
                                        box-shadow:0 1px 2px rgba(0,0,0,.3);
                                    "></span>

                                    <span style="
                                        font-size:10px;
                                        font-weight:900;
                                        color:#fff;
                                        background:#111;
                                        padding:2px 5px;
                                        border-radius:6px;
                                    ">
                                        NE
                                    </span>

                                    <span style="word-break:break-word;">
                                        {{ $p->negras?->nombre }} {{ $p->negras?->apellido }}
                                    </span>
                                </div>

                                {{-- MESA --}}
                                <div style="
                                    color:#64748b;
                                    min-width:80px;
                                    text-align:center;
                                    flex:1;
                                ">
                                    Mesa {{ $p->mesa ?? '-' }}
                                </div>

                                {{-- RESULTADO --}}
                                <div style="
                                    font-weight:800;
                                    color:#374151;
                                    min-width:90px;
                                    text-align:right;
                                    flex:1;
                                ">
                                    {{ $p->resultado ?? 'Pendiente' }}
                                </div>

                            </div>
                        @endforeach

                    </div>

                @endforeach

            </div>

        @empty
            <div style="text-align:center; padding:40px; color:#64748b;">
                No hay emparejamientos aún
            </div>
        @endforelse

    </div>

    {{-- FOOTER --}}
    <div style="padding:15px; text-align:right;">
        <flux:modal.close>
            <button style="background:#002c53; color:white; padding:10px 20px; border-radius:10px;">
                Cerrar
            </button>
        </flux:modal.close>
    </div>

</flux:modal>


    <livewire:sistema.protejo-mi-mente.footer />

</div>