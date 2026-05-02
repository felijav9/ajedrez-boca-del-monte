<div>
    {{-- 🏆 FOTO GRUPAL GANADORES --}}
    @foreach ($torneo->imagenes->where('tipo','ganadores') as $img)
        <div style="position:relative; margin-bottom:30px; border-radius:24px; overflow:hidden; box-shadow:0 20px 40px rgba(0,0,0,0.1);">
            <img src="{{ asset($img->ruta) }}" @click="openImg('{{ asset($img->ruta) }}')"
                style="width:100%; max-height:450px; object-fit:contain; cursor:pointer; display:block;">
            <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(transparent, rgba(0,44,83,0.8)); padding:30px 20px; color:white;">
                <div style="font-weight:900; font-size:18px;">CUADRO DE HONOR</div>
                <div style="font-size:14px; opacity:0.9;">Felicidades a todos los participantes</div>
            </div>
        </div>
    @endforeach

    {{-- GALERÍAS EN GRID --}}
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:25px;">
        @foreach (['imagen_talleres' => '🎓 Talleres Preparatorios', 'imagen_torneos' => '🏆 Momentos del Torneo'] as $tipo => $titulo)
            @if ($torneo->imagenes->where('tipo', $tipo)->count())
                <div>
                    <h4 style="color:#002c53; font-weight:800; margin-bottom:15px;">{{ $titulo }}</h4>
                    <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(110px,1fr)); gap:12px;">
                        @foreach ($torneo->imagenes->where('tipo', $tipo) as $img)
                            <div style="overflow:hidden; border-radius:15px; background:#eee;">
                                <img src="{{ asset($img->ruta) }}" @click="openImg('{{ asset($img->ruta) }}')"
                                    style="width:100%; aspect-ratio:1; object-fit:cover; cursor:pointer; transition:0.4s;"
                                    onmouseover="this.style.transform='scale(1.15)'">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>