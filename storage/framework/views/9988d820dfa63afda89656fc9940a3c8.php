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

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('sistema.protejo-mi-mente.dashboard', []);

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1839116246-0', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>

    <div class="medallero-container">
        
        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:40px; gap:20px; flex-wrap:wrap;">
            <div>
                <?php if (isset($component)) { $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::heading','data' => ['size' => 'xl','style' => 'color:#002c53; font-weight:900; font-size: 2.5rem;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'xl','style' => 'color:#002c53; font-weight:900; font-size: 2.5rem;']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Ajedrez en Boca del Monte <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $attributes = $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $component = $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal43e8c568bbb8b06b9124aad3ccf4ec97 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43e8c568bbb8b06b9124aad3ccf4ec97 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::subheading','data' => ['style' => 'font-size: 1.1rem;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::subheading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => 'font-size: 1.1rem;']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Cronología y excelencia deportiva <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43e8c568bbb8b06b9124aad3ccf4ec97)): ?>
<?php $attributes = $__attributesOriginal43e8c568bbb8b06b9124aad3ccf4ec97; ?>
<?php unset($__attributesOriginal43e8c568bbb8b06b9124aad3ccf4ec97); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43e8c568bbb8b06b9124aad3ccf4ec97)): ?>
<?php $component = $__componentOriginal43e8c568bbb8b06b9124aad3ccf4ec97; ?>
<?php unset($__componentOriginal43e8c568bbb8b06b9124aad3ccf4ec97); ?>
<?php endif; ?>
            </div>
            <div style="position:relative;">
                <input type="text" placeholder="Buscar torneo..." wire:model.live="search"
                    style="padding:14px 20px 14px 45px; border-radius:15px; border:2px solid #e5e7eb; width:300px; outline:none; transition:0.3s;"
                    onfocus="this.style.borderColor='#facc15'">
                <span style="position:absolute; left:15px; top:15px; opacity:0.4;">🔍</span>
            </div>
        </div>

        
        <div class="year-selector">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['2022','2023','2024','2025','2026']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <button wire:click="setYear('<?php echo e($y); ?>')" class="year-btn <?php echo e($year == $y ? 'active' : ''); ?>">
                    <?php echo e($y); ?>

                </button>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        
        
          
<div class="tournament-container-relative" x-data="{ 
    scrollNext() { $refs.container.scrollBy({ left: 400, behavior: 'smooth' }) },
    scrollPrev() { $refs.container.scrollBy({ left: -400, behavior: 'smooth' }) }
}">
    
    
    <button class="nav-arrow arrow-left"
    @click="scrollPrev(); checkScroll()"
    x-show="canScrollLeft">

        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
    </button>

    
            <div class="tournament-grid" x-ref="container"
             @scroll="checkScroll">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->torneos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <?php $portada = $t->imagenes->firstWhere('tipo','portada'); ?>
                    
                    <div class="tournament-card">
                        <div class="card-img-wrapper">
                            
                            <div class="type-tag <?php echo e($t->tipo === 'interno' ? 'tag-interno' : 'tag-externo'); ?>">
                                <?php echo e($t->tipo); ?>

                            </div>

                            <div class="status-tag status-<?php echo e($t->estado); ?>">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php switch($t->estado):
                                    case ('por_realizarse'): ?> Próximamente <?php break; ?>
                                    <?php case ('en_curso'): ?> En Vivo <?php break; ?>
                                    <?php case ('finalizado'): ?> Finalizado <?php break; ?>
                                <?php endswitch; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <img src="<?php echo e($portada ? asset($portada->ruta) : asset('img/protejo-mi-mente.png')); ?>">
                        </div>
                        
                        <div class="card-header-custom">
                            <?php if (isset($component)) { $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::heading','data' => ['size' => 'lg','style' => 'color:#facc15; font-weight:800; margin:0;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'lg','style' => 'color:#facc15; font-weight:800; margin:0;']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                                <?php echo e($t->nombre); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $attributes = $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $component = $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>
                        </div>
                        
                        <div style="padding:20px;">
                            
                            <div style="display:flex; align-items:center; gap:10px; color:#64748b; font-size:14px; margin-bottom:8px;">
                                <span>📅</span>
                                <strong><?php echo e(\Carbon\Carbon::parse($t->fecha_inicio)->translatedFormat('d M')); ?> - <?php echo e(\Carbon\Carbon::parse($t->fecha_fin)->translatedFormat('d M Y')); ?></strong>
                            </div>
                            
                            <div style="display:flex; align-items:center; gap:10px; color:#64748b; font-size:14px;">
                                <span>📍</span>
                                <span><?php echo e($t->lugar); ?></span>
                            </div>
                        </div>

                        
                        <div class="btn-detalle-container">
                            <button class="btn-detalle" wire:click="openTorneo(<?php echo e($t->id); ?>)">
                                <span>Ver información</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            
            <button class="nav-arrow arrow-right"
    @click="scrollNext(); checkScroll()"
    x-show="canScrollRight">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </button>
        </div>


        <div style="margin-top:40px;"><?php echo e($this->torneos->links()); ?></div>
    </div>

    
   <?php if (isset($component)) { $__componentOriginal8cc9d3143946b992b324617832699c5f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cc9d3143946b992b324617832699c5f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::modal.index','data' => ['name' => 'torneo-detalle','style' => 'max-width:1000px; width:95%; padding:0 !important; border-radius:30px; overflow:hidden;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'torneo-detalle','style' => 'max-width:1000px; width:95%; padding:0 !important; border-radius:30px; overflow:hidden;']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($torneoSeleccionado && $torneoSeleccionado->estado === 'finalizado'): ?>
        <?php
            $imagenes = collect($torneoSeleccionado->imagenes);
            $oro = $imagenes->firstWhere('tipo','gold');
            $plata = $imagenes->firstWhere('tipo','silver');
            $bronce = $imagenes->firstWhere('tipo','bronze');
            $ganadores = $imagenes->firstWhere('tipo','ganadores');
            $top = $torneoSeleccionado->participaciones->groupBy('categoria_id');
            $posiciones = $torneoSeleccionado->resultados->whereIn('posicion', [1,2,3])->groupBy('jugador_id');
        ?>

        <div style="background:#002c53; padding:40px 30px; color:white;">
            <?php if (isset($component)) { $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::heading','data' => ['size' => 'xl','style' => 'color:white !important; font-weight:900; margin:0;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'xl','style' => 'color:white !important; font-weight:900; margin:0;']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
<?php echo e($torneoSeleccionado->nombre); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $attributes = $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $component = $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>
            <div style="color:#facc15; font-weight:bold; margin-top:5px;">Resultados y Galería Oficial</div>
        </div>

        <div style="padding:30px; background:#fcfcfc; height:80vh; overflow-y:auto; -webkit-overflow-scrolling: touch; overscroll-behavior: contain;">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($oro && $plata && $bronce): ?>
                <?php
                    $podioImgs = [
                        asset($plata->ruta),
                        asset($oro->ruta),
                        asset($bronce->ruta)
                    ];
                ?>

                <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:15px; margin-bottom:40px;">
                    
                    <div style="text-align:center;">
                        <img 
                            src="<?php echo e(asset($plata->ruta)); ?>" 
                            @click="openGallery(<?php echo \Illuminate\Support\Js::from($podioImgs)->toHtml() ?>, 0)"
                            style="width:100%; aspect-ratio:1; object-fit:cover; border-radius:20px; border:3px solid #cbd5e1; cursor:pointer;"
                        >
                    </div>

                    
                    <div style="text-align:center; transform: translateY(-15px);">
                        <img 
                            src="<?php echo e(asset($oro->ruta)); ?>" 
                            @click="openGallery(<?php echo \Illuminate\Support\Js::from($podioImgs)->toHtml() ?>, 1)"
                            style="width:100%; aspect-ratio:1; object-fit:cover; border-radius:20px; border:4px solid #facc15; cursor:pointer; box-shadow:0 15px 30px rgba(250,204,21,0.3);"
                        >
                    </div>

                    
                    <div style="text-align:center;">
                        <img 
                            src="<?php echo e(asset($bronce->ruta)); ?>" 
                            @click="openGallery(<?php echo \Illuminate\Support\Js::from($podioImgs)->toHtml() ?>, 2)"
                            style="width:100%; aspect-ratio:1; object-fit:cover; border-radius:20px; border:3px solid #fb923c; cursor:pointer;"
                        >
                    </div>
                </div>

            <?php elseif($ganadores): ?>
                <div style="position:relative; margin-bottom:35px; border-radius:24px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.15); background: transparent;">
                    <?php
                        $ganadoresArr = [asset($ganadores->ruta)];
                    ?>
                    <img src="<?php echo e(asset($ganadores->ruta)); ?>" @click="openGallery(<?php echo \Illuminate\Support\Js::from($ganadoresArr)->toHtml() ?>, 0)" style="width:100%; object-fit:cover;">
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $top; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoriaId => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div style="background:white; border-radius:24px; padding:25px; margin-bottom:25px; border:1px solid #f1f5f9; box-shadow:0 10px 15px -3px rgba(0,0,0,0.05);">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                        <h3 style="margin:0; font-weight:900; color:#002c53; font-size:1.3rem;">🏷️ <?php echo e(optional($items->first()->categoria)->nombre); ?></h3>
                        <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['variant' => 'ghost','wire:click' => 'openResultados('.e($categoriaId).')','style' => 'color:#002c53; font-weight:800;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','wire:click' => 'openResultados('.e($categoriaId).')','style' => 'color:#002c53; font-weight:800;']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Ver Tabla Completa <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $attributes = $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $component = $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
                    </div>
                    <div class="podium-container">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [2, 1, 3]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <?php
                                $participantes = $items->filter(function($p) use ($posiciones, $rank) {
                                    return $posiciones->has($p->jugador_id) && 
                                           $posiciones->get($p->jugador_id)->first()->posicion == $rank;
                                });
                                $equipos = $participantes->groupBy('equipo_id');
                            ?>

                            <div class="podium-step step-<?php echo e($rank); ?>">
                                <div style="font-size:28px; margin-bottom:5px;">
                                    <?php echo e(match($rank){1=>'🥇', 2=>'🥈', 3=>'🥉'}); ?>

                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($equipos->count()): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipoId => $jugadores): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <div style="margin-bottom:6px;">
                                            <div style="font-size:11px; font-weight:800; color:#64748b;">
                                                <?php echo e(optional($jugadores->first()->equipo)->nombre ?? 'Individual'); ?>

                                            </div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $jugadores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jugador): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                                <div style="font-size:13px; font-weight:900; color:#002c53;">
                                                    <?php echo e($jugador->jugador->nombre); ?> <?php echo e($jugador->jugador->apellido); ?>

                                                </div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <?php else: ?>
                                    <div style="font-size:10px; opacity:0.3; font-weight:bold;">—</div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

            <div style="white-space:pre-line; color:#475569; line-height:1.7; padding:25px; background:#fff; border-radius:20px; border:1px solid #f1f5f9; margin-bottom:30px;">
                <?php echo e($torneoSeleccionado->descripcion); ?>

            </div>

            <div style="display:flex; flex-direction:column; gap:30px;">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['imagen_talleres' => '🎓 Proceso de formación', 'imagen_torneos' => '🏆 Desarrollo del torneo']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo => $titulo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imagenes->where('tipo', $tipo)->count()): ?>
                        <div>
                            <h4 style="color:#002c53; font-weight:800; margin-bottom:15px; font-size:15px;"><?php echo e($titulo); ?></h4>
                            <div style="display:flex; flex-wrap:wrap; gap:12px; justify-content:center;">
                                <?php
                                    $imgsArray = $imagenes->where('tipo', $tipo)->pluck('ruta')->map(fn($r) => asset($r))->values();
                                ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $imgsArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <div style="width:120px; height:110px; border-radius:16px; overflow:hidden; cursor:pointer;" @click="openGallery(<?php echo \Illuminate\Support\Js::from($imgsArray)->toHtml() ?>, <?php echo e($i); ?>)">
                                        <img src="<?php echo e($img); ?>" style="width:100%; height:100%; object-fit:cover;">
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>

        <div style="padding:20px; text-align:right; background:#f1f5f9; border-top:1px solid #e2e8f0;">
            <?php if (isset($component)) { $__componentOriginalda55eef372798476d918d03158796935 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalda55eef372798476d918d03158796935 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::modal.close','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::modal.close'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['variant' => 'filled','style' => 'background:#002c53; color:white; padding:10px 30px; border-radius:12px;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'filled','style' => 'background:#002c53; color:white; padding:10px 30px; border-radius:12px;']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Cerrar Detalle <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $attributes = $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $component = $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalda55eef372798476d918d03158796935)): ?>
<?php $attributes = $__attributesOriginalda55eef372798476d918d03158796935; ?>
<?php unset($__attributesOriginalda55eef372798476d918d03158796935); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalda55eef372798476d918d03158796935)): ?>
<?php $component = $__componentOriginalda55eef372798476d918d03158796935; ?>
<?php unset($__componentOriginalda55eef372798476d918d03158796935); ?>
<?php endif; ?>
        </div>

    
    
<?php elseif($torneoSeleccionado && $torneoSeleccionado->estado === 'por_realizarse'): ?>
    <?php
        $registrados = $torneoSeleccionado->participaciones->map(function($p) {
            return [
                'nombre' => $p->jugador->nombre . ' ' . $p->jugador->apellido,
                'equipo' => optional($p->equipo)->nombre ?? 'Individual',
                'categoria' => optional($p->categoria)->nombre ?? 'General',
                'genero' => $p->jugador->genero, // Lectura directa del campo
                'edad' => $p->jugador->edad . ' años',
                'search' => strtolower($p->jugador->nombre . ' ' . $p->jugador->apellido . ' ' . (optional($p->equipo)->nombre ?? '') . ' ' . (optional($p->categoria)->nombre ?? ''))
            ];
        })->sortBy('nombre')->values();
    ?>

    <div style="background: linear-gradient(135deg, #002c53 0%, #1e40af 100%); padding:40px 30px; color:white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <?php if (isset($component)) { $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::heading','data' => ['size' => 'xl','style' => 'color:white !important; font-weight:900; margin:0;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'xl','style' => 'color:white !important; font-weight:900; margin:0;']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
<?php echo e($torneoSeleccionado->nombre); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $attributes = $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $component = $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>
                <div style="background: #facc15; color: #002c53; display: inline-block; padding: 4px 12px; border-radius: 8px; font-size: 12px; font-weight: 800; margin-top: 10px; text-transform: uppercase;">
                    Próximo Evento ⏳
                </div>
            </div>
            <div style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); padding: 15px 25px; border-radius: 20px; text-align: center; border: 1px solid rgba(255,255,255,0.2);">
                <div style="font-size: 11px; text-transform: uppercase; font-weight: 700; opacity: 0.9;">Total Inscritos</div>
                <div style="font-size: 28px; font-weight: 900;"><?php echo e($registrados->count()); ?></div>
            </div>
        </div>
    </div>

    <div style="padding:30px; background:#fcfcfc; max-height:75vh; overflow-y:auto;" 
         x-data="{ 
            search: '', 
            jugadores: <?php echo \Illuminate\Support\Js::from($registrados)->toHtml() ?>,
            get filteredJugadores() {
                return this.jugadores.filter(j => j.search.includes(this.search.toLowerCase()))
            }
         }">
        
        <div style="margin-bottom: 35px;">
            <h4 style="color:#002c53; font-weight:800; margin-bottom:12px; font-size: 1.1rem; display: flex; align-items: center; gap: 8px;">
                <span>📝</span> Detalles del Torneo
            </h4>
            <div style="white-space:pre-line; color:#475569; line-height:1.6; padding:20px; background:white; border-radius:15px; border:1px solid #e2e8f0;">
                <?php echo e($torneoSeleccionado->descripcion); ?>

            </div>
        </div>

        <div style="background: white; border-radius: 20px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
            <div style="padding: 20px; border-bottom: 1px solid #f1f5f9; background: #fafafa; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 15px;">
                <h4 style="margin:0; color:#002c53; font-weight:800;">👥 Jugadores Confirmados</h4>
                <div style="position: relative; width: 100%; max-width: 300px;">
                    <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8;">🔍</span>
                    <input x-model="search" type="text" placeholder="Buscar por nombre o apellido" 
                           style="width: 100%; padding: 10px 15px 10px 35px; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 13px; outline: none;">
                </div>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($registrados->count() > 0): ?>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                        <thead style="background: #f8fafc; color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px;">
                            <tr>
                                <th style="padding: 15px 20px;">Jugador / Equipo</th>
                                <th style="padding: 15px 20px;">Género</th>
                                <th style="padding: 15px 20px;">Edad</th>
                                <th style="padding: 15px 20px;">Categoría</th>
                            </tr>
                        </thead>
                        <tbody style="color: #334155;">
                            <template x-for="j in filteredJugadores" :key="j.nombre">
                                <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                    <td style="padding: 15px 20px;">
                                        <div style="font-weight: 800; color: #002c53;" x-text="j.nombre"></div>
                                        <div style="font-size: 11px; color: #94a3b8;" x-text="j.equipo"></div>
                                    </td>
                                    <td style="padding: 15px 20px;">
                                        <span style="padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: 600;" 
                                              :style="j.genero === 'masculino' ? 'background:#e0f2fe; color:#0369a1;' : (j.genero === 'femenino' ? 'background:#fce7f3; color:#be185d;' : '')"
                                              x-text="j.genero"></span>
                                    </td>
                                    <td style="padding: 15px 20px; font-weight: 600;" x-text="j.edad"></td>
                                    <td style="padding: 15px 20px;">
                                        <div style="background: #f1f5f9; padding: 4px 10px; border-radius: 8px; display: inline-block; font-size: 12px; font-weight: 700; color: #475569;" x-text="j.categoria"></div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <div x-show="filteredJugadores.length === 0" style="padding: 40px; text-align: center; color: #94a3b8;">
                    <p style="font-weight: 600;">No se encontraron resultados para su búsqueda.</p>
                </div>
            <?php else: ?>
                <div style="padding: 60px 20px; text-align: center; color: #64748b;">
                    <div style="font-size: 40px; margin-bottom: 15px;">♟️</div>
                    <h5 style="margin:0; font-weight: 800; color: #002c53;">¡Pronto se anunciarán los participantes!</h5>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <div style="padding:20px; text-align:right; background:#f1f5f9; border-top:1px solid #e2e8f0;">
        <?php if (isset($component)) { $__componentOriginalda55eef372798476d918d03158796935 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalda55eef372798476d918d03158796935 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::modal.close','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::modal.close'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['variant' => 'filled','style' => 'background:#002c53; color:white; padding:10px 30px; border-radius:12px;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'filled','style' => 'background:#002c53; color:white; padding:10px 30px; border-radius:12px;']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Cerrar <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $attributes = $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $component = $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalda55eef372798476d918d03158796935)): ?>
<?php $attributes = $__attributesOriginalda55eef372798476d918d03158796935; ?>
<?php unset($__attributesOriginalda55eef372798476d918d03158796935); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalda55eef372798476d918d03158796935)): ?>
<?php $component = $__componentOriginalda55eef372798476d918d03158796935; ?>
<?php unset($__componentOriginalda55eef372798476d918d03158796935); ?>
<?php endif; ?>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cc9d3143946b992b324617832699c5f)): ?>
<?php $attributes = $__attributesOriginal8cc9d3143946b992b324617832699c5f; ?>
<?php unset($__attributesOriginal8cc9d3143946b992b324617832699c5f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cc9d3143946b992b324617832699c5f)): ?>
<?php $component = $__componentOriginal8cc9d3143946b992b324617832699c5f; ?>
<?php unset($__componentOriginal8cc9d3143946b992b324617832699c5f); ?>
<?php endif; ?>


    
    <?php if (isset($component)) { $__componentOriginal8cc9d3143946b992b324617832699c5f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cc9d3143946b992b324617832699c5f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::modal.index','data' => ['name' => 'resultados-categoria','style' => 'max-width:800px; width:95%; border-radius:28px; overflow:hidden;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'resultados-categoria','style' => 'max-width:800px; width:95%; border-radius:28px; overflow:hidden;']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($torneoSeleccionado && $categoriaSeleccionada): ?>

        <?php
            $categoriaNom = $torneoSeleccionado->participaciones
                ->where('categoria_id', $categoriaSeleccionada)
                ->first()?->categoria?->nombre;

            $participaciones = $torneoSeleccionado->participaciones
                ->where('categoria_id', $categoriaSeleccionada);

            $resultados = $torneoSeleccionado->resultados
                ->sortBy('posicion')
                ->groupBy('jugador_id');
        ?>

        
        <div style="background:#002c53; padding:25px; color:white;">
            <?php if (isset($component)) { $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::heading','data' => ['size' => 'lg','style' => 'color:white !important; font-weight:900;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'lg','style' => 'color:white !important; font-weight:900;']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                <?php echo e($categoriaNom); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $attributes = $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $component = $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>
            <div style="font-size:14px; opacity:0.8;">
                Tabla completa de posiciones
            </div>
        </div>

        
        <div style="padding:25px; max-height:70vh; overflow-y:auto;">
            <table style="width:100%; border-collapse:separate; border-spacing:0 8px;">

                
                <thead>
                    <tr style="color:#64748b; font-size:12px; text-transform:uppercase; letter-spacing:1px;">
                        <th style="padding:10px; text-align:left;">Jugador</th>
                        <th style="padding:10px; text-align:left;">Equipo</th>
                        <th style="padding:10px; text-align:center;">Posición</th>
                    </tr>
                </thead>

                
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $participaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>

                        <?php
                            $r = $resultados->get($p->jugador_id)?->first();
                        ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($r): ?>
                            <tr style="background:#f8fafc; transition:0.2s;">

                                
                                <td style="padding:15px; border-radius:12px 0 0 12px; font-weight:700; color:#002c53;">
                                    <?php echo e($p->jugador->nombre); ?> <?php echo e($p->jugador->apellido); ?>

                                </td>

                                
                                <td style="padding:15px; color:#64748b;">
                                    <?php echo e(optional($p->equipo)->nombre ?? 'Individual'); ?>

                                </td>

                                
                                <td style="padding:15px; border-radius:0 12px 12px 0; text-align:center;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($r->posicion == 1): ?>
                                        <span style="background:#fefce8; color:#a16207; padding:5px 12px; border-radius:10px; font-weight:900;">
                                            🥇 1ro
                                        </span>
                                    <?php elseif($r->posicion == 2): ?>
                                        <span style="background:#f1f5f9; color:#475569; padding:5px 12px; border-radius:10px; font-weight:900;">
                                            🥈 2do
                                        </span>
                                    <?php elseif($r->posicion == 3): ?>
                                        <span style="background:#fff7ed; color:#9a3412; padding:5px 12px; border-radius:10px; font-weight:900;">
                                            🥉 3ro
                                        </span>
                                    <?php else: ?>
                                        <span style="color:#94a3b8; font-weight:bold;">
                                            #<?php echo e($r->posicion); ?>

                                        </span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>

                            </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </tbody>

            </table>
        </div>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cc9d3143946b992b324617832699c5f)): ?>
<?php $attributes = $__attributesOriginal8cc9d3143946b992b324617832699c5f; ?>
<?php unset($__attributesOriginal8cc9d3143946b992b324617832699c5f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cc9d3143946b992b324617832699c5f)): ?>
<?php $component = $__componentOriginal8cc9d3143946b992b324617832699c5f; ?>
<?php unset($__componentOriginal8cc9d3143946b992b324617832699c5f); ?>
<?php endif; ?>


<?php if (isset($component)) { $__componentOriginal8cc9d3143946b992b324617832699c5f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cc9d3143946b992b324617832699c5f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::modal.index','data' => ['name' => 'image-viewer','variant' => 'flyout','style' => 'background: rgba(0,0,0,0.95); max-width: 100vw; padding: 0;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'image-viewer','variant' => 'flyout','style' => 'background: rgba(0,0,0,0.95); max-width: 100vw; padding: 0;']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    
    <div style="height:100vh; width:100vw; display:flex; align-items:center; justify-content:center; position:relative;">

        
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

        
        <img :src="imgModalSrc"
            style="max-width:95%; max-height:90vh; object-fit:contain; border-radius:10px;">

        
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

        
        

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cc9d3143946b992b324617832699c5f)): ?>
<?php $attributes = $__attributesOriginal8cc9d3143946b992b324617832699c5f; ?>
<?php unset($__attributesOriginal8cc9d3143946b992b324617832699c5f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cc9d3143946b992b324617832699c5f)): ?>
<?php $component = $__componentOriginal8cc9d3143946b992b324617832699c5f; ?>
<?php unset($__componentOriginal8cc9d3143946b992b324617832699c5f); ?>
<?php endif; ?>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('sistema.protejo-mi-mente.footer', []);

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1839116246-1', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>

</div><?php /**PATH C:\laragon\www\Sistema\resources\views/livewire/sistema/protejo-mi-mente/torneos-protejo.blade.php ENDPATH**/ ?>