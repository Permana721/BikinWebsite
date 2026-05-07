<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor - {{ $project->name }}</title>
    
    <!-- GrapesJS Core -->
    <link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet">
    <script src="https://unpkg.com/grapesjs"></script>

    <!-- GrapesJS Webpage Preset -->
    <script src="https://unpkg.com/grapesjs-preset-webpage@1.0.2"></script>
    <script src="https://unpkg.com/grapesjs-blocks-basic@1.0.1"></script>

    <!-- Tailwind for our custom topbar -->
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            overflow: hidden;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
        }
        #gjs {
            height: calc(100vh - 60px);
            overflow: hidden;
        }
        .gjs-cv-canvas {
            top: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body class="bg-slate-900">
    
    <!-- Topbar -->
    <div class="h-[60px] bg-slate-900 border-b border-slate-800 flex items-center justify-between px-6 text-white shrink-0">
        <div class="flex items-center gap-4">
            <a href="{{ route('user.dashboard') }}" class="p-2 bg-slate-800 hover:bg-slate-700 rounded-lg transition-colors" title="Kembali ke Dashboard">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="font-semibold truncate max-w-xs">{{ $project->name }}</h1>
            <span id="save-status" class="text-xs font-medium text-slate-400 bg-slate-800 px-2 py-1 rounded-md hidden">Menyimpan...</span>
        </div>
        
        <div class="flex items-center gap-3">
            <form id="form-reset" method="POST" action="{{ route('user.project.reset', $project->id) }}" style="display:none;">
                @csrf
            </form>
            <button id="btn-reset" onclick="if(confirm('Reset project ke template asal? Semua perubahan akan hilang!')) document.getElementById('form-reset').submit();"
                class="bg-slate-700 hover:bg-red-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2" title="Reset ke Template Asal">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                Reset
            </button>
            <button id="btn-save" class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg text-sm font-semibold transition-colors flex items-center gap-2 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                Simpan Manual
            </button>
        </div>
    </div>

    <div id="gjs"></div>

    <script>
        const saveUrl   = `{{ route('user.editor.save', $project->id) }}`;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const baseUrl   = '{{ rtrim($baseUrl, "/") }}/';

        // External JS URLs (jQuery, plugins…) extracted from the template in document order.
        const canvasScripts = @json($scripts ?? []);

        // Inline <script> blocks from the template body, turned into Blob URLs
        // so GrapesJS can inject them into the canvas after external libs load.
        const inlineBodyScripts = @json($inlineBodyScripts ?? []);
        const inlineScriptUrls  = inlineBodyScripts.map(code => {
            const blob = new Blob([code], { type: 'application/javascript' });
            return URL.createObjectURL(blob);
        });

        const allScripts = [...canvasScripts, ...inlineScriptUrls];

        const editor = grapesjs.init({
            container: '#gjs',
            components: {!! json_encode($bodyContent) !!},
            style: {!! json_encode($gjsCss) !!},
            height: '100%',
            width: 'auto',
            fromElement: false,
            storageManager: {
                type: 'remote',
                stepsBeforeSave: 3,
                options: {
                    remote: {
                        urlStore: saveUrl,
                        fetchOptions: opts => (opts.method === 'POST'
                            ? { headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' } }
                            : {}),
                        onStore: () => ({
                            'gjs-html': editor.getHtml(),
                            'gjs-css' : editor.getCss(),
                        }),
                    }
                }
            },
            plugins: ['gjs-preset-webpage', 'gjs-blocks-basic'],
            pluginsOpts: { 'gjs-preset-webpage': {} },
            canvas: {
                styles : @json($styles ?? []),
                scripts: allScripts,
            },

            // -----------------------------------------------------------------------
            // protectedCss — injected into the canvas iframe, NOT saved to the file.
            // Purpose:
            //   1. Kill preloaders that would cover the whole canvas.
            //   2. Force every animation/waypoint-hidden element to be VISIBLE so the
            //      user can see and edit all sections (JS scroll-animations won't run
            //      inside the GrapesJS iframe).
            //   3. Normalise slider/carousel markup so all slides are visible flat.
            // -----------------------------------------------------------------------
            protectedCss: `
                /* Hide preloaders */
                #preloader, #fh5co-loader, #loader,
                .preloader, .loader-wrap,
                [id*="preloader"], [class*="preloader"] {
                    display: none !important;
                }

                /* Force body visible */
                body { visibility: visible !important; opacity: 1 !important; }

                /* ============================================================
                   UNIVERSAL: Waypoint / scroll-animated elements
                   .wp1–.wp6 (Jhon Doe) — start invisible, animated on scroll
                   ============================================================ */
                .wp1,.wp2,.wp3,.wp4,.wp5,.wp6,
                [class*="wow"],[data-wow-delay],[data-animation],
                .fadeIn,.fadeInUp,.fadeInDown,.fadeInLeft,.fadeInRight,
                .animated {
                    visibility : visible !important;
                    opacity    : 1 !important;
                    animation  : none !important;
                    -webkit-animation : none !important;
                    transform  : none !important;
                    -webkit-transform : none !important;
                }

                /* ============================================================
                   FOODEE TEMPLATE SPECIFIC FIXES
                   Foodee uses Modernizr which adds class="js" to <html>.
                   The rule ".js .to-animate" sets opacity:0 on ALL animated
                   elements — they only appear when Waypoints fires in browser.
                   In GrapesJS, Waypoints scroll never fires, so we force them
                   visible here in protectedCss.
                   ============================================================ */
                .to-animate,
                .to-animate-2,
                .js .to-animate,
                .js .to-animate-2,
                html.js .to-animate,
                html.js .to-animate-2 {
                    opacity    : 1 !important;
                    visibility : visible !important;
                    animation  : none !important;
                    -webkit-animation : none !important;
                    transform  : none !important;
                    -webkit-transform : none !important;
                }

                /* Foodee: hero section needs a fallback height (js-fullheight
                   is set via JS to window.height — won't run in editor) */
                .js-fullheight {
                    min-height: 500px !important;
                    height: auto !important;
                }

                /* Foodee: hero home background loader spinner — hide it */
                #fh5co-home {
                    background-image: none !important;
                }

                /* ============================================================
                   FLEXSLIDER — show all slides stacked in editor
                   ============================================================ */
                .flexslider { overflow: visible !important; }
                .flexslider .slides {
                    display   : block !important;
                    list-style: none !important;
                    padding   : 0 !important;
                    margin    : 0 !important;
                }
                .flexslider .slides > li {
                    display : block !important;
                    opacity : 1 !important;
                    float   : none !important;
                    width   : 100% !important;
                    margin-bottom: 16px;
                }
                /* Foodee hero slides need height since js-fullheight is JS-driven */
                #fh5co-home .flexslider .slides > li {
                    min-height: 400px !important;
                    height: auto !important;
                }

                /* Owl Carousel */
                .owl-carousel .owl-stage-outer { overflow: visible !important; }
                .owl-carousel .owl-item { display: inline-block !important; opacity: 1 !important; }

                /* Slick Slider */
                .slick-list  { overflow: visible !important; }
                .slick-slide { display: block !important; opacity: 1 !important; }

                /* Text rotator */
                .rotate { display: inline !important; }
            `,
        });

        // -----------------------------------------------------------------------
        // After GrapesJS finishes loading components into the canvas:
        // -----------------------------------------------------------------------
        editor.on('load', () => {
            const canvasBody = editor.Canvas.getBody();
            if (!canvasBody) return;

            const canvasDoc = canvasBody.ownerDocument;

            // 1. Prepend <base href> — makes all relative asset URLs work.
            const head = canvasDoc.head;
            let base = head.querySelector('base');
            if (!base) {
                base = canvasDoc.createElement('base');
                head.prepend(base);
            }
            base.setAttribute('href', baseUrl);

            // 2. Restore original <body> attributes (id="top", class="…", etc.)
            const bodyWrapper = editor.getWrapper();
            const bodyAttrs   = @json($bodyAttrsArray ?? []);
            if (bodyWrapper && Object.keys(bodyAttrs).length > 0) {
                bodyWrapper.setAttributes(bodyAttrs);
            }

            // 3. Re-init template JavaScript plugins.
            //    canvas.scripts are injected as <script src="…"> tags; they load
            //    asynchronously, so we poll for jQuery then initialise everything.
            const initPlugins = (attempt = 1) => {
                try {
                    const win = canvasDoc.defaultView || canvasDoc.parentWindow;
                    if (!win || !win.$) {
                        if (attempt < 30) setTimeout(() => initPlugins(attempt + 1), 200);
                        return;
                    }

                    const $ = win.$;

                    // Monkey-patch $.fn.load so plugins using $(window).load(fn)
                    // execute immediately (window.load already fired in the iframe).
                    const _origLoad = $.fn.load;
                    $.fn.load = function(fn) {
                        if (typeof fn === 'function') {
                            try { fn.call(this[0]); } catch(_) {}
                            return this;
                        }
                        return _origLoad ? _origLoad.apply(this, arguments) : this;
                    };

                    // Fire any $(document).ready() handlers that weren't called yet.
                    try { $(canvasDoc).triggerHandler('ready'); } catch(_) {}

                    // --- FlexSlider ---
                    if ($.fn.flexslider) {
                        const fx = { animation:'slide', directionNav:false, controlNav:true, touch:true, pauseOnHover:true };
                        // Jhon Doe template sliders
                        ['#blogSlider','#clientSlider','#servicesSlider','#teamSlider'].forEach(id => {
                            try { $(id, canvasDoc).flexslider(fx); } catch(_) {}
                        });
                        // Foodee template: hero (fade) + sayings (slide) sliders
                        try { $('#fh5co-home .flexslider', canvasDoc).flexslider({ animation:'fade', slideshowSpeed:5000 }); } catch(_) {}
                        try { $('#fh5co-sayings .flexslider', canvasDoc).flexslider({ animation:'slide', slideshowSpeed:5000, directionNav:false, controlNav:true, smoothHeight:true, reverse:true }); } catch(_) {}
                    }

                    // --- Foodee: force .to-animate / .to-animate-2 visible at runtime too ---
                    // (protectedCss handles CSS side; this handles any runtime opacity resets)
                    try {
                        $(canvasDoc).find('.to-animate, .to-animate-2').css({ opacity: 1 }).addClass('fadeInUp animated');
                    } catch(_) {}

                    // --- Foodee: set js-fullheight to a sensible fixed height ---
                    try {
                        const h = (win.innerHeight || 600);
                        $('.js-fullheight', canvasDoc).css('height', Math.min(h, 700) + 'px');
                    } catch(_) {}

                    // --- Foodee: datetimepicker for reservation form ---
                    if ($.fn.datetimepicker) {
                        try { $('#date', canvasDoc).datetimepicker(); } catch(_) {}
                    }

                    // --- Simple Text Rotator ---
                    if ($.fn.textrotator) {
                        try { $('.rotate', canvasDoc).textrotator({ animation:'fade', separator:',', speed:2000 }); } catch(_) {}
                    }

                    // --- Waypoints: manually add animation classes so elements appear ---
                    const wpAnims = ['fadeInLeft','fadeInUp','fadeInDown','fadeInDown','fadeInUp','fadeInDown'];
                    wpAnims.forEach((anim, i) => {
                        try { $(`.wp${i+1}`, canvasDoc).addClass('animated ' + anim); } catch(_) {}
                    });
                    try { if ($.waypoints) $.waypoints('refresh'); } catch(_) {}

                    // --- Lightbox.js ---
                    if ($.fn.lightbox) {
                        try { $('[data-lightbox]', canvasDoc).lightbox(); } catch(_) {}
                    }

                    // --- Generic plugins (other templates) ---
                    if ($.fn.owlCarousel)   { try { $('.owl-carousel', canvasDoc).owlCarousel(); } catch(_) {} }
                    if ($.fn.slick)         { try { $('.slick-slider', canvasDoc).slick(); } catch(_) {} }
                    if (win.AOS)            { try { win.AOS.init(); } catch(_) {} }
                    if (win.WOW)            { try { new win.WOW().init(); } catch(_) {} }

                } catch (err) {
                    console.warn('[GrapesJS] initPlugins attempt', attempt, err);
                    if (attempt < 6) setTimeout(() => initPlugins(attempt + 1), 600);
                }
            };

            // Wait 1.5 s for canvas <script> tags to download and execute.
            setTimeout(() => initPlugins(), 1500);
        });

        // Save-status badge
        const statusEl = document.getElementById('save-status');

        editor.on('storage:start', () => {
            statusEl.classList.remove('hidden', 'text-red-400', 'text-green-400');
            statusEl.classList.add('text-slate-400');
            statusEl.textContent = 'Menyimpan…';
        });
        editor.on('storage:end', () => {
            statusEl.textContent = 'Tersimpan ✓';
            statusEl.classList.replace('text-slate-400', 'text-green-400');
            setTimeout(() => statusEl.classList.add('hidden'), 3000);
        });
        editor.on('storage:error', err => {
            statusEl.textContent = 'Gagal menyimpan!';
            statusEl.classList.replace('text-slate-400', 'text-red-400');
            console.error('Storage error:', err);
        });

        document.getElementById('btn-save').addEventListener('click', () => editor.store());
    </script>
</body>
</html>
