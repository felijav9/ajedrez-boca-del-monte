<div class="dashboard-wrapper">
    <style>
        .dashboard-container {
            padding: 24px 16px;
            font-family: ui-sans-serif, system-ui, sans-serif;
            background-color: transparent;
        }

        /* HEADER SECTION */
        .header-section {
            text-align: center;
            margin-bottom: 32px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .brand-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #002c53;
            margin-bottom: 12px;
            box-shadow: 0 4px 10px rgba(0, 44, 83, 0.2);
        }

        .header-title-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .chess-icon {
            font-size: 28px;
            color: #002c53;
            opacity: 0.9;
        }

        .main-title {
            font-size: 32px;
            font-weight: 900;
            letter-spacing: -0.05em;
            color: #002c53;
            text-transform: uppercase;
            margin: 0;
        }

        .yellow-divider {
            width: 120px;
            height: 5px;
            background: #facc15;
            margin: 12px auto 0;
            border-radius: 99px;
            box-shadow: 0 2px 10px rgba(250, 204, 21, 0.4);
        }

        /* NAVIGATION */
        .nav-container {
            max-width: 650px;
            margin: 0 auto;
        }

        .nav-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            padding: 10px;
            background: #002c53; /* Azul Profundo */
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 44, 83, 0.15);
        }

        .nav-btn {
            flex: 1;
            min-width: 110px;
            padding: 12px 18px;
            border-radius: 14px;
            border: 1px solid transparent;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            text-transform: uppercase;
            background: transparent;
            color: #ffffff; /* Letras blancas por defecto */
        }

        /* REGLA 1: INICIO SIEMPRE AMARILLO (ESTILO JUGADORES) */
        .btn-inicio-always {
            background: #facc15 !important;
            color: #000000 !important;
            box-shadow: 0 4px 12px rgba(250, 204, 21, 0.3);
        }

        /* REGLA 2: ESTILO DE SELECCIÓN (ESTILO MEDALLERO) */
        .nav-btn-selected {
            background: #000000 !important;
            color: #facc15 !important;
            border: 1px solid #facc15 !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .nav-btn:hover:not(.btn-inicio-always):not(.nav-btn-selected) {
            background: rgba(255, 255, 255, 0.1);
        }

        @media (prefers-color-scheme: dark) {
            .main-title { color: #facc15; }
            .nav-grid { background: #05192d; border: 1px solid #002c53; }
        }
    </style>

    <div class="dashboard-container">
        <div class="header-section">
            <img src="<?php echo e(asset('img/protejo-mi-mente.png')); ?>" alt="Protejo Mi Mente" class="brand-image">
            <div class="header-title-container">
                <span class="chess-icon">♞</span>
                <h1 class="main-title">Protejo Mi Mente</h1>
                <span class="chess-icon">♚</span>
            </div>
            <div class="yellow-divider"></div>
        </div>

        <div class="nav-container">
            <nav class="nav-grid">
                
                <button 
                    onclick="window.location.href='<?php echo e(url('/')); ?>'" 
                    class="nav-btn btn-inicio-always">
                    Inicio
                </button>

                
                <button 
                   wire:click="goToTorneos" 
                    class="nav-btn <?php echo e(request()->routeIs('protejo-mi-mente.torneos-protejo') ? 'nav-btn-selected' : ''); ?>">
                    Torneos
                </button>

                
                <button 
                    wire:click="goToJugadores" 
                    class="nav-btn <?php echo e(request()->routeIs('protejo-mi-mente.jugadores-protejo') ? 'nav-btn-selected' : ''); ?>">
                    Jugadores
                </button>

                
                <button 
                    wire:click="goToMedallero" 
                    class="nav-btn <?php echo e(request()->routeIs('protejo-mi-mente.medallero') ? 'nav-btn-selected' : ''); ?>">
                    Medallero
                </button>
            </nav>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\Sistema\resources\views/livewire/sistema/protejo-mi-mente/dashboard.blade.php ENDPATH**/ ?>