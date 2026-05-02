<div>
    {{-- 🥇🥈🥉 IMÁGENES PRINCIPALES --}}
    <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:15px; margin-bottom:30px;">
        @php
            $oro = $torneo->imagenes->firstWhere('tipo','gold');
            $plata = $torneo->imagenes->firstWhere('tipo','silver');
            $bronce = $torneo->imagenes->firstWhere('tipo','bronze');
        @endphp

        <div style="text-align:center;">
            <div style="font-size:12px; font-weight:900; color:#cbd5e1; margin-bottom:5px;">🥈 PLATA</div>
            <img src="{{ asset($plata->ruta) }}" @click="openImg('{{ asset($plata->ruta) }}')" 
                style="width:100%; aspect-ratio:1; object-fit:cover; border-radius:15px; border:3px solid #cbd5e1; cursor:pointer;">
        </div>
        <div style="text-align:center; transform: translateY(-10px);">
            <div style="font-size:12px; font-weight:900; color:#facc15; margin-bottom:5px;">🥇 ORO</div>
            <img src="{{ asset($oro->ruta) }}" @click="openImg('{{ asset($oro->ruta) }}')" 
                style="width:100%; aspect-ratio:1; object-fit:cover; border-radius:15px; border:4px solid #facc15; cursor:pointer; box-shadow:0 10px 20px rgba(250,204,21,0.3);">
        </div>
        <div style="text-align:center;">
            <div style="font-size:12px; font-weight:900; color:#fb923c; margin-bottom:5px;">🥉 BRONCE</div>
            <img src="{{ asset($bronce->ruta) }}" @click="openImg('{{ asset($bronce->ruta) }}')" 
                style="width:100%; aspect-ratio:1; object-fit:cover; border-radius:15px; border:3px solid #fb923c; cursor:pointer;">
        </div>
    </div>

    {{-- GALERÍAS SECUNDARIAS --}}
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
        @if ($torneo->imagenes->where('tipo','imagen_talleres')->count())
            <div style="background:white; padding:15px; border-radius:20px; border:1px solid #f1f5f9;">
                <div style="font-weight:900; color:#002c53; margin-bottom:12px; font-size:14px;">🎓 TALLERES</div>
                <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(80px,1fr)); gap:8px;">
                    @foreach ($torneo->imagenes->where('tipo','imagen_talleres') as $img)
                        <img src="{{ asset($img->ruta) }}" @click="openImg('{{ asset($img->ruta) }}')"
                            style="width:100%; aspect-ratio:1; object-fit:cover; border-radius:10px; cursor:pointer; transition:0.3s;"
                            onmouseover="this.style.opacity='0.8'">
                    @endforeach
                </div>
            </div>
        @endif

        @if ($torneo->imagenes->where('tipo','imagen_torneos')->count())
            <div style="background:white; padding:15px; border-radius:20px; border:1px solid #f1f5f9;">
                <div style="font-weight:900; color:#002c53; margin-bottom:12px; font-size:14px;">🏆 EL TORNEO</div>
                <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(80px,1fr)); gap:8px;">
                    @foreach ($torneo->imagenes->where('tipo','imagen_torneos') as $img)
                        <img src="{{ asset($img->ruta) }}" @click="openImg('{{ asset($img->ruta) }}')"
                            style="width:100%; aspect-ratio:1; object-fit:cover; border-radius:10px; cursor:pointer; transition:0.3s;"
                            onmouseover="this.style.opacity='0.8'">
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>