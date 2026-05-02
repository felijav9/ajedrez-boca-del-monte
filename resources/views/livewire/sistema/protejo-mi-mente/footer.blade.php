<div> {{-- ÚNICA RAÍZ --}}
    <style>
        .main-footer {
            width: 100%;
            padding: 30px 16px; /* Bajé el padding para que sea más compacto */
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            margin-top: -20px; /* Margen negativo para subirlo un poco respecto al contenido superior */
            font-family: ui-sans-serif, system-ui, sans-serif;
            position: relative;
            z-index: 10;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .footer-left {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #64748b;
            font-size: 14px;
        }

        .footer-left strong {
            color: #002c53;
            font-weight: 800;
        }

        .divider { color: #cbd5e1; }

        .footer-right {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .contact-group {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .contact-link {
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            color: #002c53;
            font-weight: 700;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .contact-link:hover { color: #10b981; transform: translateY(-1px); }

        .badge {
            background: #002c53;
            color: #facc15;
            padding: 5px 12px;
            border-radius: 99px;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 6px rgba(0, 44, 83, 0.1);
        }

        @media (max-width: 900px) {
            .footer-content { flex-direction: column; text-align: center; }
            .contact-group { flex-direction: column; gap: 8px; }
            .footer-left { flex-direction: column; gap: 5px; }
            .footer-left .divider { display: none; }
        }

        @media (prefers-color-scheme: dark) {
            .main-footer { background: #05192d; border-color: #002c53; }
            .footer-left { color: #94a3b8; }
            .footer-left strong { color: #facc15; }
            .contact-link { color: #ffffff; }
        }
    </style>

    <footer class="main-footer">
        <div class="footer-content">
            {{-- IZQUIERDA: Info Legal --}}
            <div class="footer-left">
                <span class="copyright">© 2026 Todos los derechos reservados</span>
                <span class="divider">|</span>
                <span class="author">Desarrollado por <strong>Axel Javier Alvarez</strong></span>
            </div>
            
            {{-- DERECHA: Contactos y Skill --}}
            <div class="footer-right">
                <div class="contact-group">
                    <a href="tel:32246555" class="contact-link">
                        <span class="icon">📞</span>
                        <span class="text">32246555</span>
                    </a>
                    <a href="mailto:axel5javier536@gmail.com" class="contact-link">
                        <span class="icon">✉</span>
                        <span class="text">axel5javier536@gmail.com</span>
                    </a>
                </div>
                <div class="badge">Programador & Diseñador Web</div>
            </div>
        </div>
    </footer>
</div> {{-- FIN ÚNICA RAÍZ --}}