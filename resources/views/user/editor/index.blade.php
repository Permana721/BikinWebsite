<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor - {{ $project->name }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body,html{height:100%;overflow:hidden;font-family:'Inter',system-ui,sans-serif;background:#0f172a}
        .topbar{height:56px;background:#1e293b;border-bottom:1px solid #334155;display:flex;align-items:center;justify-content:space-between;padding:0 16px;color:#fff;gap:12px;flex-shrink:0}
        .topbar-left,.topbar-right{display:flex;align-items:center;gap:10px}
        .topbar h1{font-size:14px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:200px}
        .project-logo-wrap{position:relative;width:34px;height:34px;border-radius:8px;cursor:pointer;flex-shrink:0;background:#334155;display:flex;align-items:center;justify-content:center;border:1px solid #475569;transition:border-color .15s}
        .project-logo-wrap:hover{border-color:#3b82f6}
        .project-logo-wrap img{width:100%;height:100%;object-fit:cover;border-radius:7px}
        .project-logo-wrap .logo-placeholder{color:#64748b;display:flex;align-items:center;justify-content:center;width:100%;height:100%;border-radius:7px}
        .project-logo-wrap .logo-overlay{position:absolute;inset:0;background:rgba(0,0,0,.55);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .15s;border-radius:7px}
        .project-logo-wrap:hover .logo-overlay{opacity:1}
        .logo-menu{position:absolute;top:42px;left:0;background:#1e293b;border:1px solid #475569;border-radius:10px;padding:4px;min-width:160px;box-shadow:0 8px 24px rgba(0,0,0,.4);z-index:100;display:none}
        .logo-menu.show{display:block}
        .logo-menu button{display:flex;align-items:center;gap:8px;width:100%;padding:8px 12px;background:none;border:none;color:#cbd5e1;font-size:12px;font-weight:500;border-radius:6px;cursor:pointer;white-space:nowrap}
        .logo-menu button:hover{background:#334155;color:#fff}
        .logo-menu button.danger:hover{background:rgba(220,38,38,.2);color:#fca5a5}
        .title-group{display:flex;align-items:center;gap:6px;min-width:0}
        .title-group h1{cursor:pointer}
        .title-group .edit-icon{color:#64748b;cursor:pointer;transition:color .15s;flex-shrink:0}
        .title-group .edit-icon:hover{color:#fff}
        .title-input{background:#0f172a;border:1px solid #3b82f6;color:#fff;font-size:14px;font-weight:600;padding:4px 10px;border-radius:6px;outline:none;max-width:220px;font-family:inherit;display:none}
        .btn{display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:8px;font-size:13px;font-weight:600;border:none;cursor:pointer;transition:all .15s}
        .btn-icon{padding:7px;border-radius:8px;background:#334155;color:#94a3b8;border:none;cursor:pointer;transition:all .15s}
        .btn-icon:hover{background:#475569;color:#fff}
        .btn-ghost{background:#334155;color:#cbd5e1}.btn-ghost:hover{background:#475569;color:#fff}
        .btn-primary{background:#3b82f6;color:#fff}.btn-primary:hover{background:#2563eb}
        .btn-success{background:#10b981;color:#fff}.btn-success:hover{background:#059669}
        .btn-danger{background:#334155;color:#cbd5e1}.btn-danger:hover{background:#dc2626;color:#fff}
        .badge{font-size:10px;letter-spacing:.05em;text-transform:uppercase;padding:3px 8px;border-radius:99px;font-weight:700}
        .badge-edit{background:rgba(59,130,246,.15);color:#93c5fd;border:1px solid rgba(59,130,246,.3)}
        .badge-preview{background:rgba(16,185,129,.15);color:#6ee7b7;border:1px solid rgba(16,185,129,.3)}
        .iframe-wrap{flex:1;overflow:hidden;position:relative}
        .iframe-wrap iframe{width:100%;height:100%;border:none;background:#fff}
        .editor-toolbar{position:fixed;top:-200px;left:0;z-index:9999;display:flex;align-items:center;gap:2px;background:#1e293b;border:1px solid #475569;border-radius:12px;padding:4px;box-shadow:0 8px 32px rgba(0,0,0,.4);transition:opacity .15s;pointer-events:auto}
        .editor-toolbar.hidden{opacity:0;pointer-events:none}
        .editor-toolbar .sep{width:1px;height:24px;background:#475569;margin:0 4px}
        .tb{display:flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:8px;border:none;background:transparent;color:#94a3b8;cursor:pointer;font-size:14px;font-weight:700;transition:all .1s;position:relative}
        .tb:hover{background:#334155;color:#fff}
        .tb.active{background:#3b82f6;color:#fff}
        .tb input[type="color"]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}
        .tb-label{font-size:11px;color:#94a3b8;padding:0 6px;font-weight:600;white-space:nowrap}
        .color-dot{width:14px;height:14px;border-radius:50%;border:2px solid #475569;display:inline-block}
        .img-btn{display:flex;align-items:center;gap:6px;padding:6px 12px;border-radius:8px;background:#334155;color:#e2e8f0;border:none;cursor:pointer;font-size:12px;font-weight:600;transition:all .1s;white-space:nowrap}
        .img-btn:hover{background:#3b82f6;color:#fff}
        .link-popover{position:fixed;z-index:10000;background:#1e293b;border:1px solid #475569;border-radius:12px;padding:12px;box-shadow:0 8px 32px rgba(0,0,0,.5);display:none;width:320px}
        .link-popover input{width:100%;padding:8px 10px;border-radius:8px;border:1px solid #475569;background:#0f172a;color:#fff;font-size:13px;outline:none}
        .link-popover input:focus{border-color:#3b82f6}
        .link-popover .link-actions{display:flex;gap:6px;margin-top:8px}
        .link-popover .link-actions button{flex:1}
        .save-toast{position:fixed;bottom:24px;right:24px;z-index:10000;padding:10px 20px;border-radius:10px;font-size:13px;font-weight:600;transition:all .3s;opacity:0;transform:translateY(10px);pointer-events:none}
        .save-toast.show{opacity:1;transform:translateY(0)}
        .save-toast.saving{background:#1e293b;color:#93c5fd;border:1px solid rgba(59,130,246,.3)}
        .save-toast.success{background:#064e3b;color:#6ee7b7;border:1px solid rgba(16,185,129,.3)}
        .save-toast.error{background:#7f1d1d;color:#fca5a5;border:1px solid rgba(239,68,68,.3)}
        .ctx-menu{position:fixed;z-index:10001;background:#1e293b;border:1px solid #475569;border-radius:12px;padding:4px;min-width:200px;box-shadow:0 12px 40px rgba(0,0,0,.5);display:none;font-family:'Inter',system-ui,sans-serif}
        .ctx-menu.show{display:block}
        .ctx-menu button{display:flex;align-items:center;gap:10px;width:100%;padding:8px 14px;background:none;border:none;color:#cbd5e1;font-size:12px;font-weight:500;border-radius:8px;cursor:pointer;white-space:nowrap;text-align:left}
        .ctx-menu button:hover{background:#334155;color:#fff}
        .ctx-menu button.danger{color:#f87171}
        .ctx-menu button.danger:hover{background:rgba(220,38,38,.15);color:#fca5a5}
        .ctx-menu .ctx-sep{height:1px;background:#334155;margin:4px 8px}
        .ctx-menu .ctx-label{font-size:10px;color:#64748b;padding:6px 14px 2px;text-transform:uppercase;letter-spacing:.05em;font-weight:700}
        .ctx-menu kbd{margin-left:auto;font-size:10px;color:#64748b;font-family:inherit;background:#0f172a;padding:2px 6px;border-radius:4px}
    </style>
</head>
<body style="display:flex;flex-direction:column;height:100vh">

    <div class="topbar">
        <div class="topbar-left">
            <a href="{{ route('user.dashboard') }}" class="btn-icon" title="Kembali">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            {{-- Favicon / Logo --}}
            <div class="project-logo-wrap" id="logoWrap" title="Ganti Favicon">
                <img id="logoImg" src="" alt="Favicon" style="display:none">
                <div class="logo-placeholder" id="logoPlaceholder">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div class="logo-overlay">
                    <svg width="14" height="14" fill="none" stroke="#fff" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><circle cx="12" cy="13" r="3" stroke-width="2"/></svg>
                </div>
                <div class="logo-menu" id="logoMenu">
                    <button id="btnUploadLogo"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 4v12m0-12L8 8m4-4l4 4"/></svg> Upload Favicon</button>
                    <button id="btnRemoveLogo" class="danger" style="display:none"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg> Hapus Favicon</button>
                </div>
            </div>
            <input type="file" id="logoInput" accept="image/*" style="display:none">
            {{-- Title (from template HTML <title>) --}}
            <div class="title-group">
                <h1 id="titleDisplay">Memuat...</h1>
                <input type="text" id="titleInput" class="title-input" value="" maxlength="255">
                <span class="edit-icon" id="titleEditBtn" title="Edit title template">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                </span>
            </div>
            <span id="modeBadge" class="badge badge-edit">Edit</span>
        </div>
        <div class="topbar-right">
            <button id="btnPreview" class="btn btn-ghost" title="Preview dengan animasi">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                <span id="previewLabel">Preview</span>
            </button>
            <form id="formReset" method="POST" action="{{ route('user.project.reset', $project->id) }}" style="display:none">@csrf</form>
            <button class="btn btn-danger" onclick="if(confirm('Reset ke template asal? Semua perubahan hilang!'))document.getElementById('formReset').submit()">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Reset
            </button>
            <button id="btnSave" class="btn btn-primary">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan
            </button>
        </div>
    </div>

    <div class="iframe-wrap">
        <iframe id="editorFrame" src="{{ $iframeUrl }}"></iframe>
    </div>

    <div id="toolbar" class="editor-toolbar hidden">
        <span class="tb-label" id="toolbarLabel">Teks</span>
        <div class="sep"></div>
        <!-- Text tools (shown for text elements) -->
        <div id="textTools" style="display:flex;align-items:center;gap:2px">
            <button class="tb" data-cmd="bold" title="Bold"><b>B</b></button>
            <button class="tb" data-cmd="italic" title="Italic"><i>I</i></button>
            <button class="tb" data-cmd="underline" title="Underline"><u>U</u></button>
            <div class="sep"></div>
            <button class="tb" id="btnTextColor" title="Warna Teks">
                <span class="color-dot" id="textColorDot" style="background:#fff"></span>
                <input type="color" id="textColorInput" value="#000000">
            </button>
            <div class="sep"></div>
            <button class="tb" data-cmd="fontSize-" title="Kecilkan Font">A-</button>
            <button class="tb" data-cmd="fontSize+" title="Besarkan Font">A+</button>
            <div class="sep"></div>
            <button class="tb" id="btnLink" title="Tambah Link">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
            </button>
        </div>
        <!-- Image tools -->
        <div id="imageTools" style="display:none;align-items:center;gap:4px">
            <button class="img-btn" id="btnReplaceImg">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Ganti Gambar
            </button>
        </div>
        <!-- Background tools -->
        <div id="bgTools" style="display:none;align-items:center;gap:4px">
            <button class="tb" id="btnBgColor" title="Warna Background">
                <span class="color-dot" id="bgColorDot" style="background:#fff"></span>
                <input type="color" id="bgColorInput" value="#ffffff">
            </button>
            <span class="tb-label">Background</span>
            <div class="sep" id="bgImgSep" style="display:none"></div>
            <button class="img-btn" id="btnReplaceBgImg" style="display:none">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Ganti Gambar
            </button>
        </div>
    </div>

    <!-- Link Popover -->
    <div id="linkPopover" class="link-popover">
        <input type="url" id="linkInput" placeholder="https://contoh.com">
        <div class="link-actions">
            <button class="btn btn-primary" id="btnApplyLink" style="font-size:12px;padding:6px">Terapkan</button>
            <button class="btn btn-danger" id="btnRemoveLink" style="font-size:12px;padding:6px">Hapus Link</button>
        </div>
    </div>

    <!-- Hidden file input -->
    <input type="file" id="imageInput" accept="image/*" style="display:none">

    <!-- Save toast -->
    <div id="saveToast" class="save-toast"></div>

    <!-- Context Menu -->
    <div id="ctxMenu" class="ctx-menu">
        <div class="ctx-label">Elemen</div>
        <button id="ctxCopy"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>Copy<kbd>Ctrl+C</kbd></button>
        <button id="ctxCut"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"/></svg>Cut<kbd>Ctrl+X</kbd></button>
        <button id="ctxPaste"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>Paste<kbd>Ctrl+V</kbd></button>
        <button id="ctxDuplicate"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"/></svg>Duplicate</button>
        <div class="ctx-sep"></div>
        <div class="ctx-label">Pindahkan</div>
        <button id="ctxMoveUp"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>Pindah Ke Atas</button>
        <button id="ctxMoveDown"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>Pindah Ke Bawah</button>
        <div class="ctx-sep"></div>
        <button id="ctxDelete" class="danger"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>Hapus Elemen<kbd>Del</kbd></button>
    </div>

<script>
(function(){
    const iframe = document.getElementById('editorFrame');
    const toolbar = document.getElementById('toolbar');
    const toolbarLabel = document.getElementById('toolbarLabel');
    const textTools = document.getElementById('textTools');
    const imageTools = document.getElementById('imageTools');
    const bgTools = document.getElementById('bgTools');
    const linkPopover = document.getElementById('linkPopover');
    const linkInput = document.getElementById('linkInput');
    const imageInput = document.getElementById('imageInput');
    const saveToast = document.getElementById('saveToast');
    const modeBadge = document.getElementById('modeBadge');
    const btnPreview = document.getElementById('btnPreview');
    const previewLabel = document.getElementById('previewLabel');

    const SAVE_URL = `{{ route('user.editor.save', $project->id) }}`;
    const UPLOAD_URL = `{{ route('user.editor.upload-image', $project->id) }}`;
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;
    const EDIT_STYLE_ID = '__bisite_edit_css__';

    let iDoc = null;
    let selectedEl = null;
    let isPreview = false;

    const TEXT_TAGS = ['P','H1','H2','H3','H4','H5','H6','SPAN','A','LI','TD','TH','LABEL','BLOCKQUOTE','FIGCAPTION','BUTTON','SMALL','STRONG','EM','B','I','U','MARK','CITE','DT','DD'];
    const CONTAINER_TAGS = ['DIV','SECTION','HEADER','FOOTER','MAIN','ARTICLE','ASIDE','NAV','FIGURE'];

    iframe.addEventListener('load', () => {
        iDoc = iframe.contentDocument;
        if(!iDoc) return;
        injectEditStyles();
        setupListeners();
        syncTitleFromIframe();
        syncFaviconFromIframe();
    });

    function injectEditStyles(){
        if(!iDoc || iDoc.getElementById(EDIT_STYLE_ID)) return;
        const s = iDoc.createElement('style');
        s.id = EDIT_STYLE_ID;
        s.textContent = `
            *,*::before,*::after{
                animation:none!important;-webkit-animation:none!important;
                animation-delay:0s!important;animation-duration:0s!important;
                transition:none!important;-webkit-transition:none!important;
                transition-delay:0s!important;transition-duration:0s!important;
            }
            body{visibility:visible!important;opacity:1!important}
            [data-aos],[class*="wow"],.animated,.animate__animated,
            .wp1,.wp2,.wp3,.wp4,.wp5,.wp6,
            .to-animate,.to-animate-2,.js .to-animate,.js .to-animate-2,
            .fadeIn,.fadeInUp,.fadeInDown,.fadeInLeft,.fadeInRight,
            .slideInUp,.slideInDown,.slideInLeft,.slideInRight,
            .zoomIn,.bounceIn{
                opacity:1!important;visibility:visible!important;
                transform:none!important;-webkit-transform:none!important;
            }
            #preloader,#fh5co-loader,#loader,.preloader,.loader-wrap,
            [id*="preloader"],[class*="preloader"]{display:none!important}
            .js-fullheight{min-height:500px!important;height:auto!important}
            .__bisite_selected{outline:2px solid #3b82f6!important;outline-offset:2px!important;cursor:text!important}
            .__bisite_hover{outline:2px dashed rgba(59,130,246,.4)!important;outline-offset:2px!important}
        `;
        iDoc.head.appendChild(s);
    }

    function removeEditStyles(){
        if(!iDoc) return;
        const s = iDoc.getElementById(EDIT_STYLE_ID);
        if(s) s.remove();
    }

    function setupListeners(){
        iDoc.addEventListener('click', onElementClick, true);
        iDoc.addEventListener('contextmenu', onContextMenu, true);
        iDoc.addEventListener('mouseover', e => {
            if(isPreview) return;
            const t = findEditableTarget(e.target);
            if(t && t !== selectedEl) t.classList.add('__bisite_hover');
        });
        iDoc.addEventListener('mouseout', e => {
            const t = findEditableTarget(e.target);
            if(t) t.classList.remove('__bisite_hover');
        });
        iDoc.addEventListener('scroll', hideToolbar);
        iDoc.addEventListener('keydown', onKeyDown);
        setupDragReorder();
    }

    function findEditableTarget(el){
        if(!el || el === iDoc.body || el === iDoc.documentElement) return null;
        const tag = el.tagName;
        if(tag === 'IMG') return el;
        if(TEXT_TAGS.includes(tag)) return el;
        if(CONTAINER_TAGS.includes(tag)) return el;
        // Walk up to find nearest editable parent
        if(el.parentElement && el.parentElement !== iDoc.body){
            return findEditableTarget(el.parentElement);
        }
        return null;
    }

    function hasBgImage(el){
        const cs = iframe.contentWindow.getComputedStyle(el);
        const bg = cs.backgroundImage;
        return bg && bg !== 'none' && bg.indexOf('url(') !== -1;
    }

    function onElementClick(e){
        if(isPreview) return;
        e.preventDefault();
        e.stopPropagation();

        const target = findEditableTarget(e.target);
        if(!target){ deselectEl(); hideToolbar(); return; }

        deselectEl();
        selectedEl = target;
        selectedEl.classList.add('__bisite_selected');
        selectedEl.classList.remove('__bisite_hover');

        const tag = target.tagName;
        if(tag === 'IMG'){
            showToolbarFor('image', target);
        } else if(TEXT_TAGS.includes(tag)){
            target.setAttribute('contenteditable','true');
            target.focus();
            showToolbarFor('text', target);
        } else {
            showToolbarFor('bg', target);
        }
    }

    function deselectEl(){
        if(!selectedEl) return;
        selectedEl.classList.remove('__bisite_selected');
        selectedEl.removeAttribute('contenteditable');
        selectedEl = null;
    }

    function showToolbarFor(type, el){
        textTools.style.display = type==='text' ? 'flex' : 'none';
        imageTools.style.display = type==='image' ? 'flex' : 'none';
        bgTools.style.display = type==='bg' ? 'flex' : 'none';
        toolbarLabel.textContent = type==='text' ? 'Teks' : type==='image' ? 'Gambar' : 'Background';

        if(type==='text'){
            const cs = iframe.contentWindow.getComputedStyle(el);
            textColorDot.style.background = cs.color;
        }
        if(type==='bg'){
            const cs = iframe.contentWindow.getComputedStyle(el);
            bgColorDot.style.background = cs.backgroundColor || '#ffffff';
            // Show/hide background-image replace button
            const elHasBgImg = hasBgImage(el);
            document.getElementById('btnReplaceBgImg').style.display = elHasBgImg ? '' : 'none';
            document.getElementById('bgImgSep').style.display = elHasBgImg ? '' : 'none';
            if(elHasBgImg){
                toolbarLabel.textContent = 'Background Image';
            }
        }

        toolbar.classList.remove('hidden');
        positionToolbar(el);
    }

    function positionToolbar(el){
        const iRect = iframe.getBoundingClientRect();
        const eRect = el.getBoundingClientRect();
        let top = iRect.top + eRect.top - toolbar.offsetHeight - 8;
        let left = iRect.left + eRect.left + eRect.width/2 - toolbar.offsetWidth/2;
        if(top < 4) top = iRect.top + eRect.bottom + 8;
        left = Math.max(4, Math.min(left, window.innerWidth - toolbar.offsetWidth - 4));
        toolbar.style.top = top + 'px';
        toolbar.style.left = left + 'px';
    }

    function hideToolbar(){
        toolbar.classList.add('hidden');
        linkPopover.style.display = 'none';
    }

    const textColorDot = document.getElementById('textColorDot');
    const textColorInput = document.getElementById('textColorInput');
    const bgColorDot = document.getElementById('bgColorDot');
    const bgColorInput = document.getElementById('bgColorInput');

    document.querySelectorAll('.tb[data-cmd]').forEach(btn => {
        btn.addEventListener('click', () => {
            if(!selectedEl || !iDoc) return;
            const cmd = btn.dataset.cmd;
            iframe.contentWindow.focus();
            if(cmd === 'fontSize+' || cmd === 'fontSize-'){
                const cs = iframe.contentWindow.getComputedStyle(selectedEl);
                let size = parseFloat(cs.fontSize) || 16;
                size += cmd === 'fontSize+' ? 2 : -2;
                size = Math.max(8, Math.min(120, size));
                selectedEl.style.fontSize = size + 'px';
            } else {
                iDoc.execCommand(cmd, false, null);
            }
        });
    });

    textColorInput.addEventListener('input', e => {
        if(!selectedEl || !iDoc) return;
        iframe.contentWindow.focus();
        iDoc.execCommand('foreColor', false, e.target.value);
        textColorDot.style.background = e.target.value;
    });

    bgColorInput.addEventListener('input', e => {
        if(!selectedEl) return;
        selectedEl.style.backgroundColor = e.target.value;
        bgColorDot.style.background = e.target.value;
    });

    document.getElementById('btnLink').addEventListener('click', () => {
        if(!selectedEl) return;
        const sel = iframe.contentWindow.getSelection();
        const anchor = sel && sel.anchorNode ? sel.anchorNode.parentElement : null;
        linkInput.value = (anchor && anchor.tagName === 'A') ? anchor.href : '';
        linkPopover.style.display = 'block';
        const r = toolbar.getBoundingClientRect();
        linkPopover.style.top = (r.bottom + 6) + 'px';
        linkPopover.style.left = r.left + 'px';
        linkInput.focus();
    });

    document.getElementById('btnApplyLink').addEventListener('click', () => {
        if(!iDoc) return;
        const url = linkInput.value.trim();
        if(url){
            iframe.contentWindow.focus();
            iDoc.execCommand('createLink', false, url);
        }
        linkPopover.style.display = 'none';
    });

    document.getElementById('btnRemoveLink').addEventListener('click', () => {
        if(!iDoc) return;
        iframe.contentWindow.focus();
        iDoc.execCommand('unlink', false, null);
        linkPopover.style.display = 'none';
    });

    document.getElementById('btnReplaceImg').addEventListener('click', () => {
        imageInput.dataset.mode = 'img';
        imageInput.click();
    });

    // Background image replace button
    document.getElementById('btnReplaceBgImg').addEventListener('click', () => {
        imageInput.dataset.mode = 'bg';
        imageInput.click();
    });

    imageInput.addEventListener('change', async () => {
        if(!selectedEl || !imageInput.files[0]) return;
        const mode = imageInput.dataset.mode || 'img';
        // Validate: img mode requires IMG tag, bg mode requires element with bg-image
        if(mode === 'img' && selectedEl.tagName !== 'IMG'){ imageInput.value = ''; return; }

        // Capture original dimensions before replacing
        const cs = iframe.contentWindow.getComputedStyle(selectedEl);
        const origWidth = selectedEl.offsetWidth || parseFloat(cs.width);
        const origHeight = selectedEl.offsetHeight || parseFloat(cs.height);

        const fd = new FormData();
        fd.append('image', imageInput.files[0]);
        try {
            showToast('Mengunggah gambar...', 'saving');
            const res = await fetch(UPLOAD_URL, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF },
                body: fd
            });
            const data = await res.json();
            if(data.url){
                if(mode === 'bg'){
                    // Replace background-image (inline style takes priority)
                    selectedEl.style.backgroundImage = 'url(' + data.url + ')';
                    // Ensure background covers the area properly
                    selectedEl.style.backgroundSize = 'cover';
                    selectedEl.style.backgroundPosition = 'center';
                    selectedEl.style.backgroundRepeat = 'no-repeat';
                    showToast('Background image diganti ✓', 'success');
                } else {
                    selectedEl.src = data.url;
                    selectedEl.removeAttribute('srcset');
                    // Force the image to maintain the original layout dimensions
                    if(origWidth > 0 && origHeight > 0){
                        selectedEl.style.width = origWidth + 'px';
                        selectedEl.style.height = origHeight + 'px';
                        selectedEl.style.objectFit = 'cover';
                        selectedEl.style.objectPosition = 'center';
                        // Also set max-width to prevent overflow
                        selectedEl.style.maxWidth = '100%';
                    }
                    showToast('Gambar berhasil diganti ✓', 'success');
                }
            }
        } catch(err){
            showToast('Gagal mengunggah gambar!', 'error');
            console.error(err);
        }
        imageInput.value = '';
    });

    btnPreview.addEventListener('click', () => {
        isPreview = !isPreview;
        deselectEl();
        hideToolbar();
        if(isPreview){
            removeEditStyles();
            // Reload iframe to restart animations & scripts
            iframe.src = iframe.src;
            previewLabel.textContent = 'Kembali Edit';
            btnPreview.className = 'btn btn-success';
            modeBadge.textContent = 'Preview';
            modeBadge.className = 'badge badge-preview';
        } else {
            // Reload will trigger 'load' event which re-injects styles
            iframe.src = iframe.src;
            previewLabel.textContent = 'Preview';
            btnPreview.className = 'btn btn-ghost';
            modeBadge.textContent = 'Edit';
            modeBadge.className = 'badge badge-edit';
        }
    });

    document.getElementById('btnSave').addEventListener('click', async () => {
        if(isPreview){ btnPreview.click(); await new Promise(r=>setTimeout(r,500)); }

        // Clean up editing artifacts before extracting HTML
        deselectEl(); hideToolbar(); hideCtxMenu();
        if(!iDoc) return;

        // Remove our injected style
        const editStyle = iDoc.getElementById(EDIT_STYLE_ID);
        if(editStyle) editStyle.remove();

        // Remove drop indicator
        const dropInd = iDoc.getElementById('__bisite_drop_indicator__');
        if(dropInd) dropInd.remove();

        // Remove all contenteditable + our classes
        iDoc.querySelectorAll('[contenteditable]').forEach(el => el.removeAttribute('contenteditable'));
        iDoc.querySelectorAll('.__bisite_selected,.__bisite_hover').forEach(el => {
            el.classList.remove('__bisite_selected','__bisite_hover');
        });

        // Serialize doctype
        const dt = iDoc.doctype;
        const dtStr = dt ? `<!DOCTYPE ${dt.name}${dt.publicId?` PUBLIC "${dt.publicId}"`:''}${dt.systemId?` "${dt.systemId}"`:''}>`  : '<!DOCTYPE html>';
        const fullHtml = dtStr + '\n' + iDoc.documentElement.outerHTML;

        showToast('Menyimpan...', 'saving');
        try {
            const res = await fetch(SAVE_URL, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json' },
                body: JSON.stringify({ html: fullHtml })
            });
            if(res.ok){
                showToast('Tersimpan ✓', 'success');
            } else {
                showToast('Gagal menyimpan!', 'error');
            }
        } catch(err){
            showToast('Gagal menyimpan!', 'error');
            console.error(err);
        }

        // Re-inject edit styles
        injectEditStyles();
    });

    let toastTimer;
    function showToast(msg, type){
        clearTimeout(toastTimer);
        saveToast.textContent = msg;
        saveToast.className = 'save-toast ' + type + ' show';
        toastTimer = setTimeout(() => saveToast.classList.remove('show'), 3000);
    }

    const titleDisplay = document.getElementById('titleDisplay');
    const titleInput = document.getElementById('titleInput');
    const titleEditBtn = document.getElementById('titleEditBtn');
    let titleEditing = false;

    function syncTitleFromIframe(){
        if(!iDoc) return;
        const t = iDoc.querySelector('title');
        const val = t ? t.textContent.trim() : '';
        titleDisplay.textContent = val || '(Tanpa Judul)';
        titleInput.value = val;
    }

    function startTitleEdit(){
        if(titleEditing) return;
        titleEditing = true;
        titleInput.value = titleDisplay.textContent;
        titleDisplay.style.display = 'none';
        titleEditBtn.style.display = 'none';
        titleInput.style.display = 'block';
        titleInput.focus();
        titleInput.select();
    }

    function saveTitleEdit(){
        if(!titleEditing) return;
        titleEditing = false;
        const newName = titleInput.value.trim();
        titleInput.style.display = 'none';
        titleDisplay.style.display = '';
        titleEditBtn.style.display = '';
        if(!newName || newName === titleDisplay.textContent) return;
        // Update iframe <title> DOM
        if(iDoc){
            let t = iDoc.querySelector('title');
            if(!t){ t = iDoc.createElement('title'); iDoc.head.appendChild(t); }
            t.textContent = newName;
        }
        titleDisplay.textContent = newName;
        showToast('Title diubah — klik Simpan untuk menyimpan', 'success');
    }

    titleEditBtn.addEventListener('click', startTitleEdit);
    titleDisplay.addEventListener('dblclick', startTitleEdit);
    titleInput.addEventListener('blur', saveTitleEdit);
    titleInput.addEventListener('keydown', e => {
        if(e.key === 'Enter'){ e.preventDefault(); titleInput.blur(); }
        if(e.key === 'Escape'){ titleEditing = false; titleInput.style.display='none'; titleDisplay.style.display=''; titleEditBtn.style.display=''; }
    });

    const logoWrap = document.getElementById('logoWrap');
    const logoMenu = document.getElementById('logoMenu');
    const logoInputFile = document.getElementById('logoInput');
    const btnUploadLogo = document.getElementById('btnUploadLogo');
    const btnRemoveLogo = document.getElementById('btnRemoveLogo');
    const logoImg = document.getElementById('logoImg');
    const logoPlaceholder = document.getElementById('logoPlaceholder');

    function syncFaviconFromIframe(){
        if(!iDoc) return;
        const link = iDoc.querySelector('link[rel*="icon"]');
        if(link && link.href){
            logoImg.src = link.href;
            logoImg.style.display = '';
            logoPlaceholder.style.display = 'none';
            btnRemoveLogo.style.display = '';
        } else {
            logoImg.style.display = 'none';
            logoPlaceholder.style.display = '';
            btnRemoveLogo.style.display = 'none';
        }
    }

    function setFaviconInIframe(url){
        if(!iDoc) return;
        // Remove existing favicon links
        iDoc.querySelectorAll('link[rel*="icon"]').forEach(el => el.remove());
        if(url){
            const link = iDoc.createElement('link');
            link.rel = 'icon';
            link.type = 'image/png';
            link.href = url;
            iDoc.head.appendChild(link);
        }
    }

    // Close toolbar when clicking outside in parent document
    document.addEventListener('click', e => {
        if(!toolbar.contains(e.target) && !linkPopover.contains(e.target) && e.target !== imageInput){
            // Don't deselect if clicking toolbar buttons
        }
        // Close logo menu when clicking outside
        if(logoMenu && !logoWrap.contains(e.target)){
            logoMenu.classList.remove('show');
        }
    });

    logoWrap.addEventListener('click', e => {
        e.stopPropagation();
        if(e.target.closest('#logoMenu')) return;
        logoMenu.classList.toggle('show');
    });

    btnUploadLogo.addEventListener('click', e => {
        e.stopPropagation();
        logoMenu.classList.remove('show');
        logoInputFile.click();
    });

    logoInputFile.addEventListener('change', async () => {
        if(!logoInputFile.files[0]) return;
        const fd = new FormData();
        fd.append('image', logoInputFile.files[0]);
        showToast('Mengunggah favicon...', 'saving');
        try {
            const res = await fetch(UPLOAD_URL, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF },
                body: fd
            });
            const data = await res.json();
            if(data.url){
                setFaviconInIframe(data.url);
                logoImg.src = data.url;
                logoImg.style.display = '';
                logoPlaceholder.style.display = 'none';
                btnRemoveLogo.style.display = '';
                showToast('Favicon diubah — klik Simpan untuk menyimpan', 'success');
            }
        } catch(err){
            showToast('Gagal mengunggah favicon!', 'error');
        }
        logoInputFile.value = '';
    });

    btnRemoveLogo.addEventListener('click', e => {
        e.stopPropagation();
        logoMenu.classList.remove('show');
        setFaviconInIframe(null);
        logoImg.style.display = 'none';
        logoPlaceholder.style.display = '';
        btnRemoveLogo.style.display = 'none';
        showToast('Favicon dihapus — klik Simpan untuk menyimpan', 'success');
    });

    const ctxMenu = document.getElementById('ctxMenu');
    let clipboard = null; // {html, mode:'copy'|'cut', sourceEl}

    function onContextMenu(e){
        if(isPreview) return;
        e.preventDefault();
        e.stopPropagation();
        const target = findEditableTarget(e.target);
        if(!target) return;

        // Select the element
        deselectEl();
        selectedEl = target;
        selectedEl.classList.add('__bisite_selected');
        selectedEl.classList.remove('__bisite_hover');
        hideToolbar();

        // Position context menu
        const iRect = iframe.getBoundingClientRect();
        let x = iRect.left + e.clientX;
        let y = iRect.top + e.clientY;
        ctxMenu.classList.add('show');
        // Adjust if it goes off-screen
        const mw = ctxMenu.offsetWidth, mh = ctxMenu.offsetHeight;
        if(x + mw > window.innerWidth) x = window.innerWidth - mw - 8;
        if(y + mh > window.innerHeight) y = window.innerHeight - mh - 8;
        ctxMenu.style.left = x + 'px';
        ctxMenu.style.top = y + 'px';

        // Enable/disable paste
        document.getElementById('ctxPaste').style.opacity = clipboard ? '1' : '.4';
        // Enable/disable move
        document.getElementById('ctxMoveUp').style.opacity = target.previousElementSibling ? '1' : '.4';
        document.getElementById('ctxMoveDown').style.opacity = target.nextElementSibling ? '1' : '.4';
    }

    function hideCtxMenu(){ ctxMenu.classList.remove('show'); }

    // Close context menu on any click
    document.addEventListener('click', hideCtxMenu);
    document.addEventListener('contextmenu', e => {
        if(!ctxMenu.contains(e.target)) hideCtxMenu();
    });

    // Context menu actions
    function doCopy(){
        if(!selectedEl) return;
        clipboard = { html: selectedEl.outerHTML, mode: 'copy' };
        showToast('Elemen di-copy ✓', 'success');
        hideCtxMenu();
    }
    function doCut(){
        if(!selectedEl) return;
        clipboard = { html: selectedEl.outerHTML, mode: 'cut', sourceEl: selectedEl };
        selectedEl.style.opacity = '0.3';
        showToast('Elemen di-cut — pilih tempat untuk paste', 'success');
        hideCtxMenu();
    }
    function doPaste(){
        if(!selectedEl || !clipboard) return;
        // Clean up classes from pasted HTML
        let html = clipboard.html.replace(/__bisite_selected|__bisite_hover/g, '');
        const temp = iDoc.createElement('div');
        temp.innerHTML = html;
        const newEl = temp.firstElementChild;
        if(!newEl) return;
        // Remove editing artifacts
        newEl.removeAttribute('contenteditable');
        newEl.classList.remove('__bisite_selected','__bisite_hover');
        // Insert after selected element
        selectedEl.parentNode.insertBefore(newEl, selectedEl.nextSibling);
        // If cut, remove original
        if(clipboard.mode === 'cut' && clipboard.sourceEl){
            clipboard.sourceEl.remove();
            clipboard = null;
        }
        // Select the new element
        deselectEl();
        selectedEl = newEl;
        selectedEl.classList.add('__bisite_selected');
        showToast('Elemen di-paste ✓', 'success');
        hideCtxMenu();
    }
    function doDuplicate(){
        if(!selectedEl) return;
        let html = selectedEl.outerHTML.replace(/__bisite_selected|__bisite_hover/g, '');
        const temp = iDoc.createElement('div');
        temp.innerHTML = html;
        const clone = temp.firstElementChild;
        if(!clone) return;
        clone.removeAttribute('contenteditable');
        clone.classList.remove('__bisite_selected','__bisite_hover');
        selectedEl.parentNode.insertBefore(clone, selectedEl.nextSibling);
        deselectEl();
        selectedEl = clone;
        selectedEl.classList.add('__bisite_selected');
        showToast('Elemen diduplikasi ✓', 'success');
        hideCtxMenu();
    }
    function doDelete(){
        if(!selectedEl) return;
        if(!confirm('Hapus elemen ini?')) return;
        const el = selectedEl;
        deselectEl();
        hideToolbar();
        el.remove();
        showToast('Elemen dihapus ✓', 'success');
        hideCtxMenu();
    }
    function doMoveUp(){
        if(!selectedEl || !selectedEl.previousElementSibling) return;
        const prev = selectedEl.previousElementSibling;
        selectedEl.parentNode.insertBefore(selectedEl, prev);
        showToast('Dipindah ke atas ✓', 'success');
        hideCtxMenu();
        positionToolbar(selectedEl);
    }
    function doMoveDown(){
        if(!selectedEl || !selectedEl.nextElementSibling) return;
        const next = selectedEl.nextElementSibling;
        selectedEl.parentNode.insertBefore(next, selectedEl);
        showToast('Dipindah ke bawah ✓', 'success');
        hideCtxMenu();
        positionToolbar(selectedEl);
    }

    document.getElementById('ctxCopy').addEventListener('click', doCopy);
    document.getElementById('ctxCut').addEventListener('click', doCut);
    document.getElementById('ctxPaste').addEventListener('click', doPaste);
    document.getElementById('ctxDuplicate').addEventListener('click', doDuplicate);
    document.getElementById('ctxDelete').addEventListener('click', doDelete);
    document.getElementById('ctxMoveUp').addEventListener('click', doMoveUp);
    document.getElementById('ctxMoveDown').addEventListener('click', doMoveDown);

    // ─── KEYBOARD SHORTCUTS ───
    function onKeyDown(e){
        if(isPreview || !selectedEl) return;
        // Don't intercept if user is typing in contenteditable
        if(selectedEl.getAttribute('contenteditable') === 'true' && !e.ctrlKey && !e.metaKey) return;

        const key = e.key;
        const ctrl = e.ctrlKey || e.metaKey;

        if(key === 'Delete' || (key === 'Backspace' && !selectedEl.getAttribute('contenteditable'))){
            e.preventDefault(); doDelete();
        }
        if(ctrl && key === 'c'){ e.preventDefault(); doCopy(); }
        if(ctrl && key === 'x'){ e.preventDefault(); doCut(); }
        if(ctrl && key === 'v' && clipboard){ e.preventDefault(); doPaste(); }
        if(ctrl && key === 'd'){ e.preventDefault(); doDuplicate(); }
        if(key === 'ArrowUp' && ctrl){ e.preventDefault(); doMoveUp(); }
        if(key === 'ArrowDown' && ctrl){ e.preventDefault(); doMoveDown(); }
        if(key === 'Escape'){ deselectEl(); hideToolbar(); hideCtxMenu(); }
    }

    // ─── DRAG TO REORDER ───
    function setupDragReorder(){
        if(!iDoc) return;
        let dragEl = null;
        let dropIndicator = null;
        let isDragging = false;
        let startY = 0;

        // Create drop indicator
        dropIndicator = iDoc.createElement('div');
        dropIndicator.id = '__bisite_drop_indicator__';
        dropIndicator.style.cssText = 'display:none;height:3px;background:#3b82f6;border-radius:2px;margin:2px 0;pointer-events:none;box-shadow:0 0 8px rgba(59,130,246,.5);transition:none;position:relative;z-index:99999';
        iDoc.body.appendChild(dropIndicator);

        iDoc.addEventListener('mousedown', e => {
            if(isPreview || !selectedEl) return;
            // Only start drag if clicking the selected element (not during text editing)
            if(selectedEl.getAttribute('contenteditable') === 'true') return;
            const target = findEditableTarget(e.target);
            if(!target || target !== selectedEl) return;

            dragEl = selectedEl;
            startY = e.clientY;
            isDragging = false;

            const onMove = ev => {
                const dy = Math.abs(ev.clientY - startY);
                if(dy < 8) return; // threshold before starting drag

                if(!isDragging){
                    isDragging = true;
                    dragEl.style.opacity = '0.4';
                    dragEl.style.outline = '2px dashed #3b82f6';
                }

                // Find closest sibling to drop near
                const parent = dragEl.parentNode;
                if(!parent) return;
                const siblings = Array.from(parent.children).filter(c => c !== dragEl && c !== dropIndicator);
                let closest = null;
                let closestDist = Infinity;
                let insertBefore = true;

                for(const sib of siblings){
                    const rect = sib.getBoundingClientRect();
                    const midY = rect.top + rect.height / 2;
                    const dist = Math.abs(ev.clientY - midY);
                    if(dist < closestDist){
                        closestDist = dist;
                        closest = sib;
                        insertBefore = ev.clientY < midY;
                    }
                }

                if(closest){
                    dropIndicator.style.display = 'block';
                    if(insertBefore){
                        parent.insertBefore(dropIndicator, closest);
                    } else {
                        parent.insertBefore(dropIndicator, closest.nextSibling);
                    }
                }
            };

            const onUp = () => {
                iDoc.removeEventListener('mousemove', onMove);
                iDoc.removeEventListener('mouseup', onUp);

                if(isDragging && dragEl){
                    // Move element to indicator position
                    const parent = dragEl.parentNode;
                    if(parent && dropIndicator.parentNode){
                        parent.insertBefore(dragEl, dropIndicator);
                    }
                    dragEl.style.opacity = '';
                    dragEl.style.outline = '';
                    dragEl.classList.add('__bisite_selected');
                    showToast('Elemen dipindahkan ✓', 'success');
                }

                dropIndicator.style.display = 'none';
                isDragging = false;
                dragEl = null;
            };

            iDoc.addEventListener('mousemove', onMove);
            iDoc.addEventListener('mouseup', onUp);
        });
    }

})();
</script>
</body>
</html>
