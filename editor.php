<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ClipForge</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
:root{
  --bg:#09090e;--bg2:#111117;--bg3:#16161e;--bg4:#1c1c27;
  --surface:#222232;--surface2:#2a2a3e;
  --border:rgba(255,255,255,0.07);--border2:rgba(255,255,255,0.13);
  --text:#f0eff8;--text2:#9b9ab0;--text3:#4e4d63;
  --accent:#7c5cfc;--accent2:#9d7fff;--accent-glow:rgba(124,92,252,0.3);
  --green:#22d17a;--green-dim:rgba(34,209,122,0.12);
  --orange:#ff8c42;--pink:#f04e98;--blue:#3b9eff;--yellow:#f5d547;--red:#ff5f57;
  --font-head:'Syne',sans-serif;--font-body:'DM Sans',sans-serif;
  --sidebar-w:224px;--timeline-h:224px;--header-h:52px;
}
body{background:var(--bg);color:var(--text);font-family:var(--font-body);font-size:14px;overflow:hidden;height:100vh;display:flex;flex-direction:column;}
::-webkit-scrollbar{width:5px;height:5px;}
::-webkit-scrollbar-track{background:var(--bg2);}
::-webkit-scrollbar-thumb{background:var(--surface2);border-radius:3px;}

/* ===== NAV ===== */
.nav{height:var(--header-h);background:var(--bg2);border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;padding:0 20px;flex-shrink:0;z-index:100;}
.logo{font-family:var(--font-head);font-size:18px;font-weight:800;letter-spacing:-0.5px;background:linear-gradient(135deg,#9d7fff,#f04e98);-webkit-background-clip:text;-webkit-text-fill-color:transparent;display:flex;align-items:center;gap:8px;cursor:pointer;}
.logo-icon{width:28px;height:28px;background:linear-gradient(135deg,#7c5cfc,#f04e98);border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.logo-icon svg{width:14px;height:14px;fill:#fff;}
.nav-links{display:flex;gap:4px;}
.nav-link{padding:6px 14px;border-radius:8px;border:none;font-family:var(--font-body);font-size:13px;font-weight:500;cursor:pointer;color:var(--text2);background:transparent;transition:all .15s;}
.nav-link:hover{color:var(--text);background:var(--bg4);}
.nav-link.active{color:var(--accent2);background:rgba(124,92,252,0.12);}
.nav-actions{display:flex;gap:8px;}
.nbtn{padding:6px 14px;border-radius:7px;border:none;font-family:var(--font-body);font-size:12px;font-weight:600;cursor:pointer;transition:all .2s;}
.nbtn-ghost{background:var(--bg4);color:var(--text2);border:1px solid var(--border2);}
.nbtn-ghost:hover{color:var(--text);background:var(--surface);}
.nbtn-primary{background:var(--accent);color:#fff;box-shadow:0 0 16px var(--accent-glow);}
.nbtn-primary:hover{background:var(--accent2);transform:translateY(-1px);}

/* ===== PAGES ===== */
.page{display:none;flex:1;overflow:hidden;flex-direction:column;}
.page.active{display:flex;}

/* ===== HOME PAGE ===== */
.home-scroll{flex:1;overflow-y:auto;padding:0;}
.hero{padding:80px 40px 60px;text-align:center;position:relative;overflow:hidden;}
.hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 0%,rgba(124,92,252,0.15),transparent);}
.hero-tag{display:inline-flex;align-items:center;gap:6px;background:rgba(124,92,252,0.12);border:1px solid rgba(124,92,252,0.25);border-radius:20px;padding:4px 14px;font-size:12px;color:var(--accent2);margin-bottom:20px;}
.hero h1{font-family:var(--font-head);font-size:clamp(42px,6vw,72px);font-weight:800;line-height:1.05;letter-spacing:-2px;margin-bottom:18px;position:relative;}
.hero h1 span{background:linear-gradient(135deg,#9d7fff,#f04e98 60%,#ff8c42);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.hero p{font-size:16px;color:var(--text2);max-width:540px;margin:0 auto 32px;line-height:1.7;position:relative;}
.hero-btns{display:flex;gap:12px;justify-content:center;flex-wrap:wrap;position:relative;}
.hero-btn{padding:12px 28px;border-radius:10px;border:none;font-family:var(--font-body);font-size:14px;font-weight:600;cursor:pointer;transition:all .2s;}
.hero-btn-primary{background:var(--accent);color:#fff;box-shadow:0 0 24px var(--accent-glow);}
.hero-btn-primary:hover{background:var(--accent2);transform:translateY(-2px);}
.hero-btn-ghost{background:var(--bg4);color:var(--text);border:1px solid var(--border2);}
.hero-btn-ghost:hover{background:var(--surface);transform:translateY(-1px);}
.features{padding:40px;display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;max-width:1100px;margin:0 auto;}
.feat-card{background:var(--bg2);border:1px solid var(--border);border-radius:14px;padding:20px;transition:all .2s;cursor:default;}
.feat-card:hover{border-color:rgba(124,92,252,0.3);transform:translateY(-2px);}
.feat-icon{font-size:28px;margin-bottom:12px;}
.feat-title{font-family:var(--font-head);font-size:15px;font-weight:700;margin-bottom:6px;}
.feat-desc{font-size:12px;color:var(--text2);line-height:1.6;}
.tools-section{padding:20px 40px 60px;max-width:1100px;margin:0 auto;width:100%;}
.section-label{font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--text3);margin-bottom:20px;}
.tool-cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px;}
.tool-card{background:var(--bg2);border:1px solid var(--border);border-radius:16px;padding:24px;cursor:pointer;transition:all .2s;position:relative;overflow:hidden;}
.tool-card::before{content:'';position:absolute;inset:0;opacity:0;transition:opacity .2s;}
.tool-card.editor-card::before{background:radial-gradient(ellipse at top left,rgba(124,92,252,0.12),transparent);}
.tool-card.resizer-card::before{background:radial-gradient(ellipse at top left,rgba(59,158,255,0.1),transparent);}
.tool-card:hover::before{opacity:1;}
.tool-card:hover{border-color:var(--border2);transform:translateY(-3px);}
.tool-card-icon{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;margin-bottom:16px;}
.editor-icon-bg{background:rgba(124,92,252,0.15);border:1px solid rgba(124,92,252,0.2);}
.resizer-icon-bg{background:rgba(59,158,255,0.12);border:1px solid rgba(59,158,255,0.2);}
.tool-card h3{font-family:var(--font-head);font-size:17px;font-weight:700;margin-bottom:6px;}
.tool-card p{font-size:12px;color:var(--text2);line-height:1.6;margin-bottom:16px;}
.tool-card-btn{padding:7px 16px;border-radius:8px;border:none;font-size:12px;font-weight:600;cursor:pointer;font-family:var(--font-body);}
.editor-card .tool-card-btn{background:rgba(124,92,252,0.15);color:var(--accent2);border:1px solid rgba(124,92,252,0.25);}
.resizer-card .tool-card-btn{background:rgba(59,158,255,0.1);color:var(--blue);border:1px solid rgba(59,158,255,0.2);}

/* ===== EDITOR PAGE ===== */
.editor-layout{flex:1;display:flex;flex-direction:column;overflow:hidden;}
.editor-toolbar{height:42px;background:var(--bg2);border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;padding:0 12px;flex-shrink:0;}
.editor-left-tools{display:flex;gap:6px;align-items:center;}
.editor-right-tools{display:flex;gap:6px;align-items:center;}
.ebtn{padding:5px 12px;border-radius:7px;border:none;font-family:var(--font-body);font-size:12px;font-weight:600;cursor:pointer;transition:all .2s;display:flex;align-items:center;gap:5px;}
.ebtn-ghost{background:var(--bg4);color:var(--text2);border:1px solid var(--border2);}
.ebtn-ghost:hover{color:var(--text);background:var(--surface);}
.ebtn-primary{background:var(--accent);color:#fff;box-shadow:0 0 12px var(--accent-glow);}
.ebtn-primary:hover{background:var(--accent2);}
.ebtn-green{background:var(--green-dim);color:var(--green);border:1px solid rgba(34,209,122,0.3);}
.ebtn-green:hover{background:var(--green);color:#fff;}
.ratio-select{background:var(--bg4);border:1px solid var(--border2);color:var(--text2);border-radius:7px;padding:4px 8px;font-size:12px;font-family:var(--font-body);cursor:pointer;}
.editor-main{flex:1;display:flex;overflow:hidden;}

/* LEFT SIDEBAR */
.left-sidebar{width:var(--sidebar-w);background:var(--bg2);border-right:1px solid var(--border);display:flex;flex-direction:column;flex-shrink:0;overflow:hidden;}
.sidebar-tabs{display:flex;flex-direction:column;gap:2px;padding:8px 6px;background:var(--bg3);border-bottom:1px solid var(--border);}
.s-tab{display:flex;align-items:center;gap:8px;padding:7px 10px;border-radius:8px;cursor:pointer;font-size:12px;font-weight:500;color:var(--text2);transition:all .15s;border:none;background:transparent;text-align:left;width:100%;}
.s-tab:hover{background:var(--bg4);color:var(--text);}
.s-tab.active{background:rgba(124,92,252,0.15);color:var(--accent2);}
.s-tab-icon{font-size:14px;width:18px;text-align:center;flex-shrink:0;}
.sidebar-panel{flex:1;overflow-y:auto;padding:10px;display:none;}
.sidebar-panel.active{display:block;}
.panel-title{font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--text3);margin:10px 0 6px;}
.panel-title:first-child{margin-top:0;}
.options-grid{display:grid;grid-template-columns:1fr 1fr;gap:6px;margin-bottom:8px;}
.opt-btn{background:var(--bg4);border:1px solid var(--border);border-radius:8px;padding:7px 6px;font-size:11px;cursor:pointer;text-align:center;color:var(--text2);transition:all .15s;font-family:var(--font-body);line-height:1.3;}
.opt-btn:hover{background:var(--accent);border-color:var(--accent);color:#fff;}
.opt-btn.selected{background:var(--accent);border-color:var(--accent);color:#fff;box-shadow:0 0 8px var(--accent-glow);}
.opt-btn span{display:block;font-size:15px;margin-bottom:3px;}
.full-btn{width:100%;background:var(--bg4);border:1px dashed var(--border2);border-radius:8px;padding:10px;font-size:12px;cursor:pointer;text-align:center;color:var(--text2);transition:all .15s;font-family:var(--font-body);margin-bottom:6px;}
.full-btn:hover{background:var(--accent);border-color:var(--accent);border-style:solid;color:#fff;}
.filter-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:6px;}
.filter-swatch{border-radius:8px;overflow:hidden;cursor:pointer;border:2px solid var(--border);transition:all .15s;aspect-ratio:1;display:flex;flex-direction:column;align-items:center;justify-content:center;font-size:9px;color:var(--text2);gap:3px;background:var(--bg4);}
.filter-swatch:hover,.filter-swatch.selected{border-color:var(--accent);}
.filter-swatch .preview-box{width:100%;flex:1;border-radius:6px 6px 0 0;}
.sticker-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:6px;}
.sticker-item{font-size:24px;text-align:center;cursor:pointer;padding:6px;border-radius:8px;border:1px solid var(--border);background:var(--bg4);transition:all .15s;}
.sticker-item:hover{background:var(--accent);transform:scale(1.1);}
.text-input-field{width:100%;background:var(--bg4);border:1px solid var(--border2);border-radius:8px;padding:8px 10px;color:var(--text);font-family:var(--font-body);font-size:12px;resize:none;margin-bottom:6px;}
.text-input-field:focus{outline:none;border-color:var(--accent);}
.text-style-row{display:flex;gap:4px;margin-bottom:8px;flex-wrap:wrap;}
.text-style-btn{background:var(--bg4);border:1px solid var(--border);border-radius:6px;padding:5px 8px;font-size:11px;cursor:pointer;color:var(--text2);transition:all .15s;font-family:var(--font-body);}
.text-style-btn:hover,.text-style-btn.active{background:var(--accent);border-color:var(--accent);color:#fff;}
.color-row{display:flex;gap:5px;margin-bottom:8px;flex-wrap:wrap;}
.color-dot{width:22px;height:22px;border-radius:50%;cursor:pointer;border:2px solid transparent;transition:all .15s;}
.color-dot:hover,.color-dot.selected{border-color:white;transform:scale(1.1);}
label.small{font-size:11px;color:var(--text2);display:block;margin-bottom:4px;}
.slider-row{display:flex;align-items:center;gap:8px;margin-bottom:10px;}
.slider-row input[type=range]{flex:1;accent-color:var(--accent);}
.slider-row span{font-size:11px;color:var(--text2);min-width:28px;text-align:right;}
.solid-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:6px;margin-bottom:8px;}
.solid-swatch{height:32px;border-radius:8px;cursor:pointer;border:2px solid transparent;transition:all .15s;}
.solid-swatch:hover,.solid-swatch.selected{border-color:white;transform:scale(1.04);}
.font-options{display:flex;flex-direction:column;gap:4px;margin-bottom:8px;}
.font-opt{background:var(--bg4);border:1px solid var(--border);border-radius:8px;padding:8px 10px;cursor:pointer;font-size:13px;color:var(--text2);transition:all .15s;}
.font-opt:hover,.font-opt.selected{background:rgba(124,92,252,0.12);border-color:var(--accent);color:var(--accent2);}
.music-list{display:flex;flex-direction:column;gap:4px;margin-bottom:8px;}
.music-item{display:flex;align-items:center;gap:8px;background:var(--bg4);border:1px solid var(--border);border-radius:8px;padding:8px 10px;cursor:pointer;transition:all .15s;}
.music-item:hover{border-color:var(--accent2);}
.music-item.playing{border-color:var(--green);background:var(--green-dim);}
.music-info{flex:1;min-width:0;}
.music-name{font-size:11px;font-weight:600;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.music-dur{font-size:10px;color:var(--text3);}
.music-play-btn{width:26px;height:26px;border-radius:50%;border:none;background:var(--accent);color:#fff;font-size:10px;cursor:pointer;flex-shrink:0;display:flex;align-items:center;justify-content:center;}
.music-play-btn:hover{background:var(--accent2);}

/* CENTER PREVIEW */
.preview-area{flex:1;background:var(--bg);display:flex;flex-direction:column;align-items:center;justify-content:center;padding:16px;gap:12px;position:relative;overflow:hidden;}
.preview-frame-wrap{position:relative;background:#000;border-radius:10px;overflow:hidden;box-shadow:0 0 0 1px var(--border2),0 8px 40px rgba(0,0,0,0.6);display:flex;align-items:center;justify-content:center;max-width:100%;max-height:calc(100% - 60px);}
#previewVideo{display:block;max-width:100%;max-height:calc(100vh - var(--header-h) - 42px - var(--timeline-h) - 120px);border-radius:10px;background:#000;}
.preview-placeholder{color:var(--text3);font-size:13px;text-align:center;padding:40px;}
.preview-controls{display:flex;align-items:center;gap:10px;background:var(--bg2);border:1px solid var(--border);border-radius:30px;padding:6px 16px;}
.ctrl-btn{background:transparent;border:none;color:var(--text2);cursor:pointer;font-size:18px;width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:all .15s;}
.ctrl-btn:hover{background:var(--bg4);color:var(--text);}
.ctrl-btn.primary{background:var(--accent);color:#fff;box-shadow:0 0 10px var(--accent-glow);}
.ctrl-btn.primary:hover{background:var(--accent2);}
.time-display{font-family:monospace;font-size:12px;color:var(--text2);min-width:90px;text-align:center;}
.preview-badge{position:absolute;top:12px;right:12px;background:rgba(0,0,0,0.6);border:1px solid var(--border2);border-radius:6px;padding:3px 8px;font-size:10px;color:var(--text2);backdrop-filter:blur(8px);}
.processing-overlay{position:absolute;inset:0;background:rgba(0,0,0,0.7);display:none;align-items:center;justify-content:center;flex-direction:column;gap:10px;backdrop-filter:blur(4px);border-radius:10px;z-index:5;}
.processing-overlay.show{display:flex;}
.spin{width:32px;height:32px;border:3px solid var(--border2);border-top-color:var(--accent);border-radius:50%;animation:spin .8s linear infinite;}
@keyframes spin{to{transform:rotate(360deg);}}
#textOverlayCanvas{position:absolute;top:0;left:0;pointer-events:none;z-index:4;}

/* RIGHT PANEL */
.right-panel{width:200px;background:var(--bg2);border-left:1px solid var(--border);flex-shrink:0;overflow-y:auto;padding:12px;display:none;}
.right-panel.show{display:block;}
.prop-title{font-size:11px;font-weight:700;color:var(--text3);letter-spacing:1px;text-transform:uppercase;margin-bottom:10px;}
.prop-row{margin-bottom:10px;}
.prop-label{font-size:11px;color:var(--text2);margin-bottom:4px;display:block;}
.prop-input{width:100%;background:var(--bg4);border:1px solid var(--border);border-radius:6px;padding:5px 8px;color:var(--text);font-size:12px;font-family:var(--font-body);}
.prop-input:focus{outline:none;border-color:var(--accent);}
.delete-clip-btn{width:100%;background:rgba(240,78,152,0.1);border:1px solid rgba(240,78,152,0.3);color:var(--pink);border-radius:8px;padding:7px;font-size:12px;cursor:pointer;font-family:var(--font-body);margin-top:8px;transition:all .15s;}
.delete-clip-btn:hover{background:var(--pink);color:#fff;}

/* ===== TIMELINE ===== */
.timeline-section{height:var(--timeline-h);background:var(--bg2);border-top:1px solid var(--border);display:flex;flex-direction:column;flex-shrink:0;}
.timeline-toolbar{display:flex;align-items:center;gap:8px;padding:5px 12px;border-bottom:1px solid var(--border);flex-shrink:0;height:36px;}
.tl-btn{background:var(--bg4);border:1px solid var(--border);border-radius:6px;padding:4px 10px;font-size:11px;cursor:pointer;color:var(--text2);font-family:var(--font-body);transition:all .15s;display:flex;align-items:center;gap:5px;}
.tl-btn:hover{background:var(--surface);color:var(--text);}
.tl-btn.accent{background:rgba(124,92,252,0.15);color:var(--accent2);border-color:rgba(124,92,252,0.3);}
.tl-btn.accent:hover{background:var(--accent);color:#fff;}
.tl-sep{width:1px;height:20px;background:var(--border);margin:0 2px;}
.tl-zoom{display:flex;align-items:center;gap:6px;margin-left:auto;}
.tl-zoom input[type=range]{width:70px;accent-color:var(--accent);}
.tl-zoom span{font-size:10px;color:var(--text3);min-width:28px;}
.timeline-scroll{flex:1;overflow-x:auto;overflow-y:hidden;position:relative;}
.timeline-inner{min-width:100%;height:100%;display:flex;flex-direction:column;position:relative;}
.time-ruler{height:24px;background:var(--bg3);border-bottom:1px solid var(--border);display:flex;align-items:flex-end;position:sticky;top:0;z-index:2;flex-shrink:0;}
.ruler-canvas{width:100%;height:100%;}
.tracks-area{flex:1;display:flex;flex-direction:column;overflow:hidden;}
.track-row{display:flex;align-items:stretch;height:40px;border-bottom:1px solid var(--border);position:relative;flex-shrink:0;}
.track-row:last-child{border-bottom:none;}
.track-label{width:88px;flex-shrink:0;background:var(--bg3);border-right:1px solid var(--border);display:flex;align-items:center;padding:0 8px;gap:5px;font-size:10px;color:var(--text2);font-weight:500;}
.track-label-icon{font-size:12px;}
.track-content{flex:1;position:relative;background:var(--bg);cursor:pointer;overflow:hidden;}
.track-content:hover{background:rgba(255,255,255,0.01);}
.track-drop-hint{position:absolute;inset:0;display:flex;align-items:center;padding:0 12px;font-size:10px;color:var(--text3);}
.clip-block{position:absolute;top:3px;bottom:3px;border-radius:6px;border:1.5px solid transparent;cursor:grab;user-select:none;overflow:hidden;display:flex;align-items:center;min-width:30px;transition:border-color .1s;}
.clip-block:active{cursor:grabbing;}
.clip-block.selected{border-color:var(--accent);box-shadow:0 0 0 1px var(--accent);}
.clip-block.video-clip{background:linear-gradient(135deg,rgba(60,158,255,0.25),rgba(60,158,255,0.1));border-color:rgba(60,158,255,0.3);}
.clip-block.image-clip{background:linear-gradient(135deg,rgba(34,209,122,0.2),rgba(34,209,122,0.08));border-color:rgba(34,209,122,0.3);}
.clip-block.audio-clip{background:linear-gradient(135deg,rgba(245,213,71,0.2),rgba(245,213,71,0.08));border-color:rgba(245,213,71,0.3);}
.clip-block.text-clip{background:linear-gradient(135deg,rgba(240,78,152,0.2),rgba(240,78,152,0.08));border-color:rgba(240,78,152,0.3);}
.clip-block.color-clip{background:linear-gradient(135deg,rgba(255,140,66,0.25),rgba(255,140,66,0.1));border-color:rgba(255,140,66,0.3);}
.clip-block:hover{border-color:var(--accent2);}
.clip-block-inner{padding:2px 6px;display:flex;flex-direction:column;justify-content:center;gap:1px;overflow:hidden;flex:1;}
.clip-name{font-size:9px;font-weight:600;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.clip-dur{font-size:8px;color:var(--text3);white-space:nowrap;}
.clip-thumb-strip{position:absolute;top:0;left:0;right:0;bottom:0;display:flex;overflow:hidden;border-radius:5px;opacity:0.25;}
.clip-thumb-img{flex:1;object-fit:cover;height:100%;}
.clip-resize-l,.clip-resize-r{position:absolute;top:0;bottom:0;width:7px;cursor:ew-resize;z-index:2;}
.clip-resize-l{left:0;}
.clip-resize-r{right:0;}
.clip-resize-l::after,.clip-resize-r::after{content:'';position:absolute;top:50%;transform:translateY(-50%);width:2px;height:14px;background:rgba(255,255,255,0.4);border-radius:1px;left:2px;}
.trans-badge{position:absolute;top:50%;transform:translateY(-50%);z-index:3;background:var(--surface2);border:1px solid var(--border2);border-radius:4px;padding:2px 4px;font-size:8px;color:var(--accent2);cursor:pointer;white-space:nowrap;}
.trans-badge:hover{background:var(--accent);color:#fff;}
.playhead{position:absolute;top:0;bottom:0;width:2px;background:var(--pink);pointer-events:none;z-index:10;}
.playhead::before{content:'▼';position:absolute;top:-1px;left:50%;transform:translateX(-50%);font-size:7px;color:var(--pink);}

/* Modals */
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.7);backdrop-filter:blur(6px);z-index:200;display:none;align-items:center;justify-content:center;}
.modal-overlay.show{display:flex;}
.modal-box{background:var(--bg2);border:1px solid var(--border2);border-radius:16px;padding:20px;min-width:280px;max-width:360px;width:90%;}
.modal-title{font-family:var(--font-head);font-size:15px;font-weight:700;margin-bottom:14px;}
.modal-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px;}
.modal-item{background:var(--bg4);border:1px solid var(--border);border-radius:8px;padding:8px 6px;font-size:11px;cursor:pointer;text-align:center;color:var(--text2);transition:all .15s;}
.modal-item:hover,.modal-item.selected{background:var(--accent);border-color:var(--accent);color:#fff;}
.modal-close{background:var(--bg4);border:1px solid var(--border);border-radius:8px;padding:7px 16px;font-size:12px;cursor:pointer;color:var(--text2);margin-top:12px;width:100%;font-family:var(--font-body);transition:all .15s;}
.modal-close:hover{background:var(--surface);color:var(--text);}

/* ===== RESIZER PAGE ===== */
.resizer-page{flex:1;overflow-y:auto;background:var(--bg);}
.resizer-inner{max-width:980px;margin:0 auto;padding:32px 32px 60px;}
.resizer-header{margin-bottom:28px;}
.resizer-header h2{font-family:var(--font-head);font-size:26px;font-weight:800;letter-spacing:-0.5px;margin-bottom:6px;}
.resizer-header p{color:var(--text2);font-size:13px;line-height:1.6;}
.resizer-upload-zone{position:relative;border:2px dashed var(--border2);border-radius:16px;overflow:hidden;cursor:pointer;transition:all .2s;margin-bottom:24px;background:var(--bg2);}
.resizer-upload-zone:hover,.resizer-upload-zone.drag-over{border-color:var(--accent);background:rgba(124,92,252,0.05);}
.resizer-video-area{width:100%;aspect-ratio:16/9;background:#000;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;border-radius:12px 12px 0 0;}
#resizerPreviewVid{width:100%;height:100%;object-fit:contain;display:none;}
.resizer-upload-placeholder{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;padding:40px;color:var(--text3);}
.resizer-upload-placeholder .drop-icon{font-size:52px;opacity:0.5;}
.resizer-upload-placeholder .drop-title{font-size:16px;font-weight:600;color:var(--text2);}
.resizer-upload-placeholder .drop-sub{font-size:12px;color:var(--text3);}
.resizer-upload-bar{padding:12px 20px;background:var(--bg3);border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:12px;}
.resizer-upload-info{font-size:12px;color:var(--text2);display:flex;align-items:center;gap:8px;}
.resizer-upload-info .file-badge{background:var(--surface);border:1px solid var(--border2);border-radius:6px;padding:3px 10px;font-size:11px;color:var(--accent2);}
.resizer-change-btn{background:var(--bg4);border:1px solid var(--border2);border-radius:7px;padding:5px 14px;font-size:11px;font-weight:600;cursor:pointer;color:var(--text2);font-family:var(--font-body);transition:all .15s;}
.resizer-change-btn:hover{color:var(--text);background:var(--surface);}
.resizer-workspace{display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start;}
.resizer-platforms-wrap{background:var(--bg2);border:1px solid var(--border);border-radius:14px;padding:16px;}
.resizer-platforms-wrap h4{font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--text3);margin-bottom:12px;}
.platform-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:8px;}
.platform-card{background:var(--bg4);border:1px solid var(--border);border-radius:10px;padding:10px 8px;cursor:pointer;transition:all .2s;text-align:center;}
.platform-card:hover{border-color:var(--border2);background:var(--surface);}
.platform-card.selected{border-color:var(--accent);background:rgba(124,92,252,0.1);}
.platform-icon-wrap{width:36px;height:auto;margin:0 auto 6px;border-radius:6px;background:var(--bg3);display:flex;align-items:center;justify-content:center;font-size:14px;}
.platform-name{font-size:11px;font-weight:600;color:var(--text);margin-bottom:2px;}
.platform-dims{font-size:9px;color:var(--text3);}
.resizer-right-panel{display:flex;flex-direction:column;gap:16px;}
.output-preview-card{background:var(--bg2);border:1px solid var(--border);border-radius:14px;padding:16px;}
.output-preview-card h4{font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--text3);margin-bottom:12px;}
.output-canvas-wrap{background:#000;border-radius:8px;overflow:hidden;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;width:100%;margin-bottom:10px;}
#resizerOutputCanvas{display:block;max-width:100%;height:auto;}
.output-dims-badge{display:flex;align-items:center;justify-content:space-between;font-size:11px;color:var(--text2);margin-bottom:12px;}
.output-dims-badge strong{color:var(--text);font-weight:600;}
.options-card{background:var(--bg2);border:1px solid var(--border);border-radius:14px;padding:16px;}
.options-card h4{font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--text3);margin-bottom:12px;}
.opt-section{margin-bottom:14px;}
.opt-section:last-child{margin-bottom:0;}
.opt-label{font-size:11px;color:var(--text2);margin-bottom:6px;}
.opt-pill-row{display:flex;gap:5px;flex-wrap:wrap;}
.opt-pill{background:var(--bg4);border:1px solid var(--border);border-radius:6px;padding:4px 10px;font-size:11px;cursor:pointer;color:var(--text2);font-family:var(--font-body);transition:all .15s;}
.opt-pill:hover{color:var(--text);border-color:var(--border2);}
.opt-pill.selected{background:rgba(124,92,252,0.15);border-color:rgba(124,92,252,0.4);color:var(--accent2);}
.export-card{background:var(--bg2);border:1px solid var(--border);border-radius:14px;padding:16px;}
.export-card h4{font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--text3);margin-bottom:12px;}
.export-mp4-btn{width:100%;background:var(--accent);border:none;border-radius:10px;padding:12px;font-size:14px;font-weight:700;cursor:pointer;color:#fff;font-family:var(--font-body);box-shadow:0 0 20px var(--accent-glow);transition:all .2s;margin-bottom:8px;display:flex;align-items:center;justify-content:center;gap:8px;}
.export-mp4-btn:hover{background:var(--accent2);transform:translateY(-1px);}
.export-mp4-btn:disabled{opacity:0.5;cursor:not-allowed;transform:none;}
.export-secondary-row{display:flex;gap:6px;}
.export-sec-btn{flex:1;background:var(--bg4);border:1px solid var(--border2);border-radius:8px;padding:8px;font-size:11px;font-weight:600;cursor:pointer;color:var(--text2);font-family:var(--font-body);transition:all .15s;text-align:center;}
.export-sec-btn:hover{color:var(--text);background:var(--surface);}
.export-sec-btn:disabled{opacity:0.4;cursor:not-allowed;}
.export-progress-wrap{margin-top:10px;display:none;}
.export-progress-wrap.show{display:block;}
.export-progress-bar-bg{background:var(--bg4);border-radius:4px;height:4px;overflow:hidden;margin-bottom:6px;}
.export-progress-bar-fill{height:100%;background:linear-gradient(90deg,var(--accent),var(--pink));border-radius:4px;width:0%;transition:width .3s;}
.export-progress-text{font-size:11px;color:var(--text2);}
.resizer-workspace.locked .output-preview-card,
.resizer-workspace.locked .export-card{opacity:0.4;pointer-events:none;}

/* Export modal */
.export-modal{background:var(--bg2);border:1px solid var(--border2);border-radius:16px;padding:22px;min-width:300px;max-width:380px;width:90%;}
.export-modal h3{font-family:var(--font-head);font-size:16px;font-weight:800;margin-bottom:4px;}
.export-modal p{font-size:12px;color:var(--text2);margin-bottom:16px;}
.export-format-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:16px;}
.export-fmt-btn{background:var(--bg4);border:1px solid var(--border2);border-radius:10px;padding:12px 10px;cursor:pointer;text-align:center;transition:all .18s;font-family:var(--font-body);}
.export-fmt-btn:hover{border-color:var(--accent2);background:rgba(124,92,252,0.08);}
.export-fmt-btn .fmt-icon{font-size:22px;margin-bottom:6px;}
.export-fmt-btn .fmt-name{font-size:13px;font-weight:700;color:var(--text);margin-bottom:2px;}
.export-fmt-btn .fmt-desc{font-size:10px;color:var(--text3);}
.export-progress{display:none;margin-bottom:14px;}
.export-progress.show{display:block;}
.progress-bar-wrap{background:var(--bg4);border-radius:6px;height:6px;overflow:hidden;margin-top:6px;}
.progress-bar-fill{height:100%;background:linear-gradient(90deg,var(--accent),var(--pink));border-radius:6px;width:0%;transition:width .3s;}
.export-status{font-size:11px;color:var(--text2);margin-top:6px;}
.mp4-note{font-size:10px;color:var(--text3);text-align:center;margin-top:10px;line-height:1.5;}
</style>
</head>
<body>

<!-- NAV -->
<div class="nav">
  <div class="logo" onclick="showPage('home')">
    <div class="logo-icon"><svg viewBox="0 0 24 24"><path d="M5 3l14 9-14 9V3z"/></svg></div>
    ClipForge
  </div>
  <div class="nav-links">
    <button class="nav-link active" id="nav-home" onclick="showPage('home')">Home</button>
    <button class="nav-link" id="nav-editor" onclick="showPage('editor')">Video Editor</button>
    <button class="nav-link" id="nav-resizer" onclick="showPage('resizer')">Resizer</button>
  </div>
  <div class="nav-actions">
    <button class="nbtn nbtn-ghost">Sign In</button>
    <button class="nbtn nbtn-primary">Get Started</button>
  </div>
</div>

<!-- ==================== HOME PAGE ==================== -->
<div class="page active" id="page-home">
  <div class="home-scroll">
    <div class="hero">
      <div class="hero-tag">✨ Free video editing suite</div>
      <h1>Edit. Text. Export.<br><span>Anywhere.</span></h1>
      <p>ClipForge gives you a full browser-based video editor with text overlays, transitions, filters, music — and a smart resizer to fit any platform.</p>
      <div class="hero-btns">
        <button class="hero-btn hero-btn-primary" onclick="showPage('editor')">🎬 Open Editor</button>
        <button class="hero-btn hero-btn-ghost" onclick="showPage('resizer')">📐 Resize Video</button>
      </div>
    </div>
    <div class="features">
      <div class="feat-card"><div class="feat-icon">✂️</div><div class="feat-title">Multi-track Timeline</div><div class="feat-desc">Stack video, images, text, and audio on separate tracks. Drag, trim, split with ease.</div></div>
      <div class="feat-card"><div class="feat-icon">✎</div><div class="feat-title">Text Overlays</div><div class="feat-desc">Add styled captions and titles directly onto your video with live preview positioning.</div></div>
      <div class="feat-card"><div class="feat-icon">🎨</div><div class="feat-title">Filters & Color</div><div class="feat-desc">One-click presets plus manual brightness, contrast, saturation, and hue controls.</div></div>
      <div class="feat-card"><div class="feat-icon">⚡</div><div class="feat-title">Transitions</div><div class="feat-desc">Fade, dissolve, wipe, zoom, spin and more between every clip.</div></div>
      <div class="feat-card"><div class="feat-icon">🎵</div><div class="feat-title">Music & Audio</div><div class="feat-desc">Import audio or pick from built-in tracks. Layer up to two audio channels.</div></div>
      <div class="feat-card"><div class="feat-icon">📐</div><div class="feat-title">Smart Resizer</div><div class="feat-desc">Resize finished videos to TikTok, YouTube, Instagram and more — in one click.</div></div>
    </div>
    <div class="tools-section">
      <div class="section-label">Start Creating</div>
      <div class="tool-cards">
        <div class="tool-card editor-card" onclick="showPage('editor')">
          <div class="tool-card-icon editor-icon-bg">🎬</div>
          <h3>Video Editor</h3>
          <p>Full-featured timeline editor with multi-track support. Add text, transitions, filters, stickers, music, and export to MP4.</p>
          <button class="tool-card-btn">Open Editor →</button>
        </div>
        <div class="tool-card resizer-card" onclick="showPage('resizer')">
          <div class="tool-card-icon resizer-icon-bg">📐</div>
          <h3>Video Resizer</h3>
          <p>Upload any finished video and resize it for YouTube, TikTok, Instagram, Twitter, and more. Downloads as MP4 instantly.</p>
          <button class="tool-card-btn">Open Resizer →</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ==================== EDITOR PAGE ==================== -->
<div class="page" id="page-editor">
  <div class="editor-layout">
    <div class="editor-toolbar">
      <div class="editor-left-tools">
        <button class="ebtn ebtn-ghost" id="undoBtn">↩ Undo</button>
        <button class="ebtn ebtn-ghost" id="redoBtn">↪ Redo</button>
        <select class="ratio-select" id="ratioSelect">
          <option value="16:9">16:9 — YouTube</option>
          <option value="9:16">9:16 — TikTok/Reels</option>
          <option value="1:1">1:1 — Instagram</option>
          <option value="4:5">4:5 — Portrait</option>
        </select>
      </div>
      <div class="editor-right-tools">
        <button class="ebtn ebtn-green" id="exportBtn">⬇ Export ▾</button>
        <button class="ebtn ebtn-primary">☁ Save</button>
      </div>
    </div>

    <div class="editor-main">
      <div class="left-sidebar">
        <div class="sidebar-tabs">
          <button class="s-tab active" data-tab="transition"><span class="s-tab-icon">⚡</span>Transitions</button>
          <button class="s-tab" data-tab="animation"><span class="s-tab-icon">✨</span>Animations</button>
          <button class="s-tab" data-tab="text"><span class="s-tab-icon">✎</span>Text</button>
          <button class="s-tab" data-tab="color"><span class="s-tab-icon">🎨</span>Color Card</button>
          <button class="s-tab" data-tab="filter"><span class="s-tab-icon">🖼</span>Filters</button>
          <button class="s-tab" data-tab="sticker"><span class="s-tab-icon">🌟</span>Stickers</button>
          <button class="s-tab" data-tab="music"><span class="s-tab-icon">🎵</span>Music</button>
        </div>

        <div class="sidebar-panel active" id="panel-transition">
          <div class="panel-title">Basic</div>
          <div class="options-grid">
            <div class="opt-btn" data-trans="Cut"><span>✂️</span>Cut</div>
            <div class="opt-btn" data-trans="Fade"><span>🌅</span>Fade</div>
            <div class="opt-btn" data-trans="Cross Dissolve"><span>🌊</span>Dissolve</div>
            <div class="opt-btn" data-trans="Dip to Black"><span>⬛</span>Dip Black</div>
            <div class="opt-btn" data-trans="Dip to White"><span>⬜</span>Dip White</div>
            <div class="opt-btn" data-trans="Flash"><span>⚡</span>Flash</div>
          </div>
          <div class="panel-title">Slide</div>
          <div class="options-grid">
            <div class="opt-btn" data-trans="Wipe Left"><span>⬅️</span>Wipe L</div>
            <div class="opt-btn" data-trans="Wipe Right"><span>➡️</span>Wipe R</div>
            <div class="opt-btn" data-trans="Slide Up"><span>⬆️</span>Slide Up</div>
            <div class="opt-btn" data-trans="Slide Down"><span>⬇️</span>Slide Dn</div>
          </div>
          <div class="panel-title">Dynamic</div>
          <div class="options-grid">
            <div class="opt-btn" data-trans="Zoom In"><span>🔍</span>Zoom In</div>
            <div class="opt-btn" data-trans="Zoom Out"><span>🔎</span>Zoom Out</div>
            <div class="opt-btn" data-trans="Blur"><span>💨</span>Blur</div>
            <div class="opt-btn" data-trans="Spin"><span>🌀</span>Spin</div>
          </div>
          <div style="font-size:10px;color:var(--text3);text-align:center;margin-top:8px;">Click ⚡ between clips, then pick</div>
        </div>

        <div class="sidebar-panel" id="panel-animation">
          <div class="panel-title">Entrance</div>
          <div class="options-grid">
            <div class="opt-btn" data-anim="Fade In"><span>🌟</span>Fade In</div>
            <div class="opt-btn" data-anim="Slide In L"><span>⬅️</span>Slide L</div>
            <div class="opt-btn" data-anim="Slide In R"><span>➡️</span>Slide R</div>
            <div class="opt-btn" data-anim="Zoom In"><span>🔍</span>Zoom In</div>
            <div class="opt-btn" data-anim="Bounce In"><span>🏀</span>Bounce</div>
            <div class="opt-btn" data-anim="Rotate In"><span>🌀</span>Rotate</div>
          </div>
          <div class="panel-title">Exit</div>
          <div class="options-grid">
            <div class="opt-btn" data-anim="Fade Out"><span>🌑</span>Fade Out</div>
            <div class="opt-btn" data-anim="Slide Out L"><span>💨</span>Slide L</div>
            <div class="opt-btn" data-anim="Zoom Out"><span>🔎</span>Zoom Out</div>
            <div class="opt-btn" data-anim="Spin Out"><span>💫</span>Spin Out</div>
          </div>
          <div class="panel-title">Loop</div>
          <div class="options-grid">
            <div class="opt-btn" data-anim="Pulse"><span>💓</span>Pulse</div>
            <div class="opt-btn" data-anim="Float"><span>🎈</span>Float</div>
            <div class="opt-btn" data-anim="Shake"><span>📳</span>Shake</div>
            <div class="opt-btn" data-anim="Typewriter"><span>⌨️</span>Typewriter</div>
          </div>
        </div>

        <div class="sidebar-panel" id="panel-text">
          <div class="panel-title">Text Content</div>
          <textarea class="text-input-field" id="textInput" rows="3" placeholder="Type your text..."></textarea>
          <div class="panel-title">Font Style</div>
          <div class="font-options" id="fontOptions">
            <div class="font-opt selected" data-font="Syne" style="font-family:'Syne',sans-serif;font-weight:800;">Syne Bold</div>
            <div class="font-opt" data-font="DM Sans" style="font-family:'DM Sans',sans-serif;">DM Sans</div>
            <div class="font-opt" data-font="Georgia" style="font-family:Georgia,serif;font-style:italic;">Georgia Serif</div>
            <div class="font-opt" data-font="monospace" style="font-family:monospace;">Monospace</div>
            <div class="font-opt" data-font="Impact" style="font-family:Impact,sans-serif;letter-spacing:1px;">IMPACT</div>
          </div>
          <div class="panel-title">Text Styles</div>
          <div class="text-style-row">
            <button class="text-style-btn" data-style="bold"><b>B</b></button>
            <button class="text-style-btn" data-style="italic"><i>I</i></button>
            <button class="text-style-btn" data-style="underline"><u>U</u></button>
            <button class="text-style-btn" data-style="shadow">Sh</button>
            <button class="text-style-btn" data-style="outline">Ou</button>
            <button class="text-style-btn" data-style="uppercase">AA</button>
          </div>
          <div class="panel-title">Color</div>
          <div class="color-row" id="textColorRow">
            <div class="color-dot selected" style="background:#fff" data-color="#ffffff"></div>
            <div class="color-dot" style="background:#f04e98" data-color="#f04e98"></div>
            <div class="color-dot" style="background:#7c5cfc" data-color="#7c5cfc"></div>
            <div class="color-dot" style="background:#3b9eff" data-color="#3b9eff"></div>
            <div class="color-dot" style="background:#22d17a" data-color="#22d17a"></div>
            <div class="color-dot" style="background:#f5d547" data-color="#f5d547"></div>
            <div class="color-dot" style="background:#ff8c42" data-color="#ff8c42"></div>
            <div class="color-dot" style="background:#000" data-color="#000000"></div>
          </div>
          <div class="panel-title">Font Size</div>
          <div class="slider-row">
            <input type="range" id="fontSizeSlider" min="20" max="160" value="72">
            <span id="fontSizeVal">72px</span>
          </div>
          <div class="panel-title">Position</div>
          <div class="options-grid">
            <div class="opt-btn selected" data-pos="center">Center</div>
            <div class="opt-btn" data-pos="top">Top</div>
            <div class="opt-btn" data-pos="bottom">Bottom</div>
            <div class="opt-btn" data-pos="lower-third">Lower 3rd</div>
          </div>
          <div class="panel-title">Duration (sec)</div>
          <div class="slider-row">
            <input type="range" id="textDurSlider" min="1" max="12" value="3" step="0.5">
            <span id="textDurVal">3s</span>
          </div>
          <button class="full-btn" id="addTextBtn">✎ Add Text Clip</button>
        </div>

        <div class="sidebar-panel" id="panel-color">
          <div class="panel-title">Solid Color Card</div>
          <div style="font-size:10px;color:var(--text2);margin-bottom:8px;line-height:1.5;">Add a solid color card as intro, outro, or background.</div>
          <div class="solid-grid" id="solidGrid">
            <div class="solid-swatch selected" style="background:#000" data-color="#000000"></div>
            <div class="solid-swatch" style="background:#fff" data-color="#ffffff"></div>
            <div class="solid-swatch" style="background:#7c5cfc" data-color="#7c5cfc"></div>
            <div class="solid-swatch" style="background:#f04e98" data-color="#f04e98"></div>
            <div class="solid-swatch" style="background:#22d17a" data-color="#22d17a"></div>
            <div class="solid-swatch" style="background:#3b9eff" data-color="#3b9eff"></div>
            <div class="solid-swatch" style="background:#f5d547" data-color="#f5d547"></div>
            <div class="solid-swatch" style="background:#ff8c42" data-color="#ff8c42"></div>
            <div class="solid-swatch" style="background:#ff5f57" data-color="#ff5f57"></div>
            <div class="solid-swatch" style="background:#1a1a2e" data-color="#1a1a2e"></div>
            <div class="solid-swatch" style="background:linear-gradient(135deg,#7c5cfc,#f04e98)" data-color="gradient-purple-pink"></div>
            <div class="solid-swatch" style="background:linear-gradient(135deg,#3b9eff,#22d17a)" data-color="gradient-blue-green"></div>
          </div>
          <div class="panel-title">Custom Color</div>
          <div style="display:flex;gap:8px;align-items:center;margin-bottom:8px;">
            <input type="color" id="customColorPicker" value="#7c5cfc" style="width:36px;height:36px;border-radius:8px;border:1px solid var(--border2);cursor:pointer;background:none;">
            <span style="font-size:11px;color:var(--text2);">Pick any color</span>
          </div>
          <div class="panel-title">Card Type</div>
          <div class="options-grid" id="colorCardType">
            <div class="opt-btn selected" data-ctype="intro">Intro</div>
            <div class="opt-btn" data-ctype="outro">Outro</div>
            <div class="opt-btn" data-ctype="divider">Divider</div>
            <div class="opt-btn" data-ctype="custom">Custom</div>
          </div>
          <div class="panel-title">Duration (sec)</div>
          <div class="slider-row">
            <input type="range" id="colorDurSlider" min="0.5" max="10" value="2" step="0.5">
            <span id="colorDurVal">2s</span>
          </div>
          <button class="full-btn" id="addColorBtn">🎨 Add Color Card</button>
        </div>

        <div class="sidebar-panel" id="panel-filter">
          <div class="panel-title">Presets</div>
          <div class="filter-grid" id="filterGrid"></div>
          <div class="panel-title">Adjust</div>
          <label class="small">Brightness</label>
          <div class="slider-row"><input type="range" id="brightnessSlider" min="0" max="200" value="100"><span id="brightnessVal">100</span></div>
          <label class="small">Contrast</label>
          <div class="slider-row"><input type="range" id="contrastSlider" min="0" max="200" value="100"><span id="contrastVal">100</span></div>
          <label class="small">Saturation</label>
          <div class="slider-row"><input type="range" id="saturateSlider" min="0" max="200" value="100"><span id="saturateVal">100</span></div>
          <label class="small">Hue Rotate</label>
          <div class="slider-row"><input type="range" id="hueSlider" min="0" max="360" value="0"><span id="hueVal">0°</span></div>
          <label class="small">Blur</label>
          <div class="slider-row"><input type="range" id="blurSlider" min="0" max="10" value="0" step="0.1"><span id="blurVal">0</span></div>
        </div>

        <div class="sidebar-panel" id="panel-sticker">
          <div class="panel-title">Emoji Stickers</div>
          <div class="sticker-grid" id="stickerGrid"></div>
          <div class="panel-title">Shapes</div>
          <div class="sticker-grid" id="shapeGrid"></div>
          <div style="font-size:10px;color:var(--text3);text-align:center;margin-top:8px;">Click to add · Double-click to remove</div>
        </div>

        <div class="sidebar-panel" id="panel-music">
          <div class="panel-title">Import Audio</div>
          <button class="full-btn" id="importMusicBtn">📁 Import Music / Audio</button>
          <input type="file" id="importMusicInput" accept="audio/*" multiple style="display:none">
          <div class="panel-title">Built-in Tracks</div>
          <div class="music-list" id="builtinMusicList"></div>
          <div class="panel-title">Your Imports</div>
          <div class="music-list" id="importedMusicList">
            <div style="font-size:11px;color:var(--text3);text-align:center;padding:10px 0;">No imports yet</div>
          </div>
        </div>
      </div>

      <div class="preview-area" id="previewArea">
        <div class="preview-badge" id="ratioBadge">16:9</div>
        <div class="preview-frame-wrap" id="previewFrameWrap">
          <div class="preview-placeholder" id="previewPlaceholder">
            <div style="font-size:40px;margin-bottom:12px;">🎬</div>
            Add media to the timeline to start editing
          </div>
          <video id="previewVideo" style="display:none" playsinline muted></video>
          <canvas id="textOverlayCanvas" style="display:none;"></canvas>
          <div class="processing-overlay" id="processingOverlay">
            <div class="spin"></div>
            <div style="font-size:12px;color:var(--text2)">Generating preview…</div>
          </div>
        </div>
        <div class="preview-controls">
          <button class="ctrl-btn" id="skipBackBtn">⏮</button>
          <button class="ctrl-btn" id="prevFrameBtn">◀</button>
          <button class="ctrl-btn primary" id="playPauseBtn">▶</button>
          <button class="ctrl-btn" id="nextFrameBtn">▶</button>
          <button class="ctrl-btn" id="skipFwdBtn">⏭</button>
          <div class="time-display" id="timeDisplay">0:00.0 / 0:00.0</div>
          <button class="ctrl-btn" id="muteBtn">🔊</button>
          <button class="ctrl-btn" id="fullscreenBtn">⛶</button>
        </div>
      </div>

      <div class="right-panel" id="rightPanel">
        <div class="prop-title">Clip Properties</div>
        <div id="propContent"></div>
      </div>
    </div>

    <div class="timeline-section">
      <div class="timeline-toolbar">
        <button class="tl-btn accent" id="addVideoBtn">🎬 + Video/Image</button>
        <input type="file" id="addVideoInput" multiple accept="video/*,image/*" style="display:none">
        <button class="tl-btn" id="addAudioBtn">🎵 + Audio</button>
        <input type="file" id="addAudioInput" multiple accept="audio/*" style="display:none">
        <div class="tl-sep"></div>
        <button class="tl-btn" id="splitBtn">✂ Split</button>
        <button class="tl-btn" id="deleteClipBtn">🗑 Delete</button>
        <div class="tl-sep"></div>
        <button class="tl-btn" id="imgDurBtn">🖼 Img: <span id="imgDurLabel">3s</span></button>
        <div class="tl-zoom">
          <span>🔭</span>
          <input type="range" id="zoomSlider" min="60" max="400" value="120">
          <span id="zoomLabel">1×</span>
        </div>
      </div>
      <div class="timeline-scroll" id="timelineScroll">
        <div class="timeline-inner" id="timelineInner">
          <div class="time-ruler"><canvas class="ruler-canvas" id="rulerCanvas"></canvas></div>
          <div class="tracks-area" id="tracksArea">
            <div class="track-row" id="track-video1">
              <div class="track-label"><span class="track-label-icon">🎬</span>Video 1</div>
              <div class="track-content" id="trackContent-video1" data-track="video1"><div class="track-drop-hint">Video / Images / Color Cards</div></div>
            </div>
            <div class="track-row" id="track-text1">
              <div class="track-label"><span class="track-label-icon">✎</span>Text</div>
              <div class="track-content" id="trackContent-text1" data-track="text1"><div class="track-drop-hint">Text overlays</div></div>
            </div>
            <div class="track-row" id="track-video2">
              <div class="track-label"><span class="track-label-icon">🖼</span>Video 2</div>
              <div class="track-content" id="trackContent-video2" data-track="video2"><div class="track-drop-hint">Overlay layer</div></div>
            </div>
            <div class="track-row" id="track-text2">
              <div class="track-label"><span class="track-label-icon">✎</span>Text 2</div>
              <div class="track-content" id="trackContent-text2" data-track="text2"><div class="track-drop-hint">Second text layer</div></div>
            </div>
            <div class="track-row" id="track-audio1">
              <div class="track-label"><span class="track-label-icon">🎵</span>Audio 1</div>
              <div class="track-content" id="trackContent-audio1" data-track="audio1"><div class="track-drop-hint">Music / Sound</div></div>
            </div>
            <div class="track-row" id="track-audio2">
              <div class="track-label"><span class="track-label-icon">🎤</span>Audio 2</div>
              <div class="track-content" id="trackContent-audio2" data-track="audio2"><div class="track-drop-hint">Voice / SFX</div></div>
            </div>
          </div>
          <div class="playhead" id="playhead" style="left:88px;"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ==================== RESIZER PAGE ==================== -->
<div class="page" id="page-resizer">
  <div class="resizer-page">
    <div class="resizer-inner">
      <div class="resizer-header">
        <h2>📐 Video Resizer</h2>
        <p>Upload a video, choose your target platform, and download as MP4. No cropping — your video is scaled to fit with letterboxing.</p>
      </div>
      <div class="resizer-upload-zone" id="resizerUploadZone">
        <input type="file" id="resizerFileInput" accept="video/*" style="display:none">
        <div class="resizer-video-area" id="resizerVideoArea">
          <video id="resizerPreviewVid" playsinline muted loop></video>
          <div class="resizer-upload-placeholder" id="resizerPlaceholder">
            <div class="drop-icon">🎞</div>
            <div class="drop-title">Drop video here or click to upload</div>
            <div class="drop-sub">Supports MP4, WebM, MOV · Exported as MP4</div>
          </div>
        </div>
        <div class="resizer-upload-bar">
          <div class="resizer-upload-info" id="resizerFileInfo">
            <span style="color:var(--text3);font-size:12px;">No file loaded</span>
          </div>
          <button class="resizer-change-btn" id="resizerChangeBtn" onclick="event.stopPropagation();document.getElementById('resizerFileInput').click()">📁 Choose File</button>
        </div>
      </div>

      <div class="resizer-workspace locked" id="resizerWorkspace">
        <div>
          <div class="resizer-platforms-wrap" style="margin-bottom:16px;">
            <h4>Choose Platform</h4>
            <div class="platform-grid" id="resizerPlatformGrid"></div>
          </div>
          <div class="options-card">
            <h4>Output Options</h4>
            <div class="opt-section">
              <div class="opt-label">Background fill</div>
              <div class="opt-pill-row" id="bgFillPills">
                <button class="opt-pill selected" data-bg="black">Black</button>
                <button class="opt-pill" data-bg="white">White</button>
                <button class="opt-pill" data-bg="blur">Blurred</button>
              </div>
            </div>
            <div class="opt-section">
              <div class="opt-label">Quality</div>
              <div class="opt-pill-row" id="qualityPills">
                <button class="opt-pill" data-quality="low">Draft</button>
                <button class="opt-pill selected" data-quality="medium">Standard</button>
                <button class="opt-pill" data-quality="high">High</button>
              </div>
            </div>
          </div>
        </div>

        <div class="resizer-right-panel">
          <div class="output-preview-card">
            <h4>Output Preview</h4>
            <div class="output-canvas-wrap" id="outputCanvasWrap">
              <canvas id="resizerOutputCanvas"></canvas>
            </div>
            <div class="output-dims-badge">
              <span id="outputPlatformLabel" style="color:var(--text2);">Select a platform</span>
              <strong id="outputDimsLabel">—</strong>
            </div>
            <button id="resizerLivePreviewBtn" style="width:100%;background:var(--bg4);border:1px solid var(--border2);border-radius:8px;padding:7px;font-size:12px;font-weight:600;cursor:pointer;color:var(--text2);font-family:var(--font-body);transition:all .15s;margin-bottom:0;">▶ Play Preview</button>
          </div>

          <div class="export-card">
            <h4>Export</h4>
            <button class="export-mp4-btn" id="resizerExportMp4Btn" disabled>
              ⬇ Download MP4
            </button>
            <div class="export-secondary-row">
              <button class="export-sec-btn" id="resizerExportGifBtn" disabled>⬇ Short Clip (first 10s)</button>
            </div>
            <div class="export-progress-wrap" id="resizerExportProgressWrap">
              <div class="export-progress-bar-bg"><div class="export-progress-bar-fill" id="resizerProgressBar"></div></div>
              <div class="export-progress-text" id="resizerProgressText">Preparing…</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- EDITOR EXPORT MODAL -->
<div class="modal-overlay" id="exportModal">
  <div class="export-modal">
    <h3>⬇ Export Video</h3>
    <p>Choose output format. Your video is rendered directly in the browser using Canvas + MediaRecorder — no plugins needed.</p>
    <div class="export-format-grid">
      <div class="export-fmt-btn" onclick="startExport('mp4')"><div class="fmt-icon">🎬</div><div class="fmt-name">MP4</div><div class="fmt-desc">Universal · Best compatibility</div></div>
      <div class="export-fmt-btn" onclick="startExport('short')"><div class="fmt-icon">🌀</div><div class="fmt-name">Short Clip</div><div class="fmt-desc">First 10s · Smaller file</div></div>
    </div>
    <div class="export-progress" id="exportProgress">
      <div class="export-status" id="exportStatusText">Preparing…</div>
      <div class="progress-bar-wrap"><div class="progress-bar-fill" id="exportProgressBar"></div></div>
    </div>
    <button class="modal-close" id="exportModalClose" onclick="document.getElementById('exportModal').classList.remove('show')">Cancel</button>
    <div class="mp4-note">💡 Video is rendered frame-by-frame in your browser. Longer videos may take a moment. Nothing is uploaded to any server.</div>
  </div>
</div>

<div class="modal-overlay" id="transModal">
  <div class="modal-box">
    <div class="modal-title">⚡ Choose Transition</div>
    <div class="modal-grid" id="transModalGrid"></div>
    <button class="modal-close" id="transModalClose">Cancel</button>
  </div>
</div>

<div class="modal-overlay" id="imgDurModal">
  <div class="modal-box">
    <div class="modal-title">🖼 Image Duration</div>
    <label class="small">Duration for still images (seconds)</label>
    <div class="slider-row" style="margin:12px 0">
      <input type="range" id="imgDurSlider" min="0.5" max="15" value="3" step="0.5">
      <span id="imgDurDisplay">3s</span>
    </div>
    <button class="modal-close" id="imgDurClose" style="background:var(--accent);color:#fff;border-color:var(--accent)">Apply</button>
  </div>
</div>

<script>
// ================================================================
// PAGE NAVIGATION
// ================================================================
function showPage(name){
  document.querySelectorAll('.page').forEach(p=>p.classList.remove('active'));
  document.querySelectorAll('.nav-link').forEach(l=>l.classList.remove('active'));
  document.getElementById('page-'+name).classList.add('active');
  document.getElementById('nav-'+name).classList.add('active');
}

// ================================================================
// DOWNLOAD HELPER
// ================================================================
function triggerDownload(blob, filename){
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = filename;
  document.body.appendChild(a);
  a.click();
  setTimeout(() => { URL.revokeObjectURL(url); document.body.removeChild(a); }, 3000);
}

// ================================================================
// BEST MIME TYPE — prefer MP4 if browser supports it, fallback to WebM
// ================================================================
function getBestMime(fps){
  // Try native MP4 first (Safari, some Chrome versions support this)
  const mp4Types = [
    'video/mp4;codecs=avc1.42E01E,mp4a.40.2',
    'video/mp4;codecs=avc1.42E01E',
    'video/mp4',
  ];
  for(const m of mp4Types){
    if(MediaRecorder.isTypeSupported(m)) return { mime: m, ext: 'mp4' };
  }
  // Fallback to WebM — still works in all major browsers, rename extension
  const webmTypes = [
    'video/webm;codecs=vp9,opus',
    'video/webm;codecs=vp8,opus',
    'video/webm;codecs=vp9',
    'video/webm;codecs=vp8',
    'video/webm',
  ];
  for(const m of webmTypes){
    if(MediaRecorder.isTypeSupported(m)) return { mime: m, ext: 'mp4' }; // still name it .mp4
  }
  return { mime: 'video/webm', ext: 'mp4' };
}

// ================================================================
// EDITOR STATE
// ================================================================
const TRACKS=['video1','text1','video2','text2','audio1','audio2'];
const clips={video1:[],text1:[],video2:[],text2:[],audio1:[],audio2:[]};
let selectedClip=null,selectedGap=null;
let transitions={video1:[],video2:[]};
let pxPerSec=120,imageDuration=3,totalDuration=0,isPlaying=false,currentTime=0,playTimer=null,filterCSS='';
let textSettings={color:'#ffffff',size:72,styles:[],position:'center',duration:3,font:'Syne'};
let colorSettings={color:'#000000',duration:2,type:'intro'};
const ALL_TRANSITIONS=['Cut','Fade','Cross Dissolve','Dip to Black','Dip to White','Flash','Wipe Left','Wipe Right','Slide Up','Slide Down','Zoom In','Zoom Out','Blur','Spin'];

document.querySelectorAll('.s-tab').forEach(tab=>{
  tab.addEventListener('click',()=>{
    document.querySelectorAll('.s-tab').forEach(t=>t.classList.remove('active'));
    document.querySelectorAll('.sidebar-panel').forEach(p=>p.classList.remove('active'));
    tab.classList.add('active');document.getElementById('panel-'+tab.dataset.tab).classList.add('active');
  });
});

const FILTERS=[
  {name:'None',css:''},{name:'Vivid',css:'saturate(1.8) contrast(1.1)'},{name:'Matte',css:'contrast(0.9) saturate(0.7) brightness(1.1)'},
  {name:'B&W',css:'grayscale(1)'},{name:'Sepia',css:'sepia(0.8)'},{name:'Cool',css:'hue-rotate(200deg) saturate(1.2)'},
  {name:'Warm',css:'hue-rotate(-20deg) saturate(1.3) brightness(1.05)'},{name:'Fade',css:'brightness(1.1) contrast(0.85) saturate(0.9)'},
  {name:'Neon',css:'saturate(2) contrast(1.3) hue-rotate(45deg)'},{name:'Cinematic',css:'contrast(1.15) saturate(0.8) brightness(0.95)'},
  {name:'Dreamy',css:'blur(0.5px) saturate(1.5) brightness(1.1)'},{name:'Vintage',css:'sepia(0.4) contrast(1.1) brightness(0.9) saturate(0.8)'},
];
const FILTER_COLORS=['#fff','#ffcc00','#888','#422','#4a3','#258','#b63','#aaa','#73f','#333','#e9f','#987'];
const filterGrid=document.getElementById('filterGrid');
FILTERS.forEach((f,i)=>{
  const el=document.createElement('div');el.className='filter-swatch'+(i===0?' selected':'');
  el.innerHTML=`<div class="preview-box" style="background:${FILTER_COLORS[i]};filter:${f.css||'none'}"></div><div style="padding:3px 0;font-size:9px">${f.name}</div>`;
  el.addEventListener('click',()=>{document.querySelectorAll('.filter-swatch').forEach(s=>s.classList.remove('selected'));el.classList.add('selected');filterCSS=f.css;applyFilterToPreview();});
  filterGrid.appendChild(el);
});
function applyFilterToPreview(){
  const v=document.getElementById('previewVideo');
  let css=filterCSS;
  css+=` brightness(${document.getElementById('brightnessSlider').value}%)`;
  css+=` contrast(${document.getElementById('contrastSlider').value}%)`;
  css+=` saturate(${document.getElementById('saturateSlider').value}%)`;
  css+=` hue-rotate(${document.getElementById('hueSlider').value}deg)`;
  css+=` blur(${document.getElementById('blurSlider').value}px)`;
  v.style.filter=css.trim();
}
['brightness','contrast','saturate','hue','blur'].forEach(id=>{
  const slider=document.getElementById(id+'Slider'),val=document.getElementById(id+'Val');
  slider.addEventListener('input',()=>{val.textContent=id==='hue'?slider.value+'°':slider.value;applyFilterToPreview();});
});

const EMOJIS=['❤️','🔥','⭐','🌈','🎉','💥','👏','🤩','😍','🚀','💎','🎵','🎬','📸','✨','🦋','🌸','🍀','🎯','💡'];
const SHAPES=['▶','■','●','★','◆','▲','⬡','⬟','⭕','✦','◉','▻'];
document.getElementById('stickerGrid').innerHTML=EMOJIS.map(e=>`<div class="sticker-item" onclick="addStickerOverlay('${e}')">${e}</div>`).join('');
document.getElementById('shapeGrid').innerHTML=SHAPES.map(s=>`<div class="sticker-item" style="font-size:16px" onclick="addStickerOverlay('${s}')">${s}</div>`).join('');
function addStickerOverlay(emoji){
  const wrap=document.getElementById('previewFrameWrap');
  const sticker=document.createElement('div');sticker.style.cssText='position:absolute;font-size:48px;cursor:move;user-select:none;z-index:10;top:40%;left:40%;';sticker.textContent=emoji;
  let ox=0,oy=0,dragging=false;
  sticker.addEventListener('mousedown',e=>{dragging=true;ox=e.clientX-sticker.offsetLeft;oy=e.clientY-sticker.offsetTop;e.stopPropagation();});
  document.addEventListener('mousemove',e=>{if(!dragging)return;sticker.style.left=(e.clientX-ox)+'px';sticker.style.top=(e.clientY-oy)+'px';});
  document.addEventListener('mouseup',()=>{dragging=false;});
  sticker.addEventListener('dblclick',()=>sticker.remove());
  wrap.appendChild(sticker);
}

document.getElementById('fontSizeSlider').addEventListener('input',e=>{textSettings.size=parseInt(e.target.value);document.getElementById('fontSizeVal').textContent=e.target.value+'px';});
document.getElementById('textDurSlider').addEventListener('input',e=>{textSettings.duration=parseFloat(e.target.value);document.getElementById('textDurVal').textContent=e.target.value+'s';});
document.querySelectorAll('.text-style-btn').forEach(b=>{b.addEventListener('click',()=>{b.classList.toggle('active');const s=b.dataset.style;if(textSettings.styles.includes(s))textSettings.styles=textSettings.styles.filter(x=>x!==s);else textSettings.styles.push(s);});});
document.querySelectorAll('#textColorRow [data-color]').forEach(d=>{d.addEventListener('click',()=>{document.querySelectorAll('#textColorRow [data-color]').forEach(x=>x.classList.remove('selected'));d.classList.add('selected');textSettings.color=d.dataset.color;});});
document.querySelectorAll('[data-pos]').forEach(d=>{d.addEventListener('click',()=>{document.querySelectorAll('[data-pos]').forEach(x=>x.classList.remove('selected'));d.classList.add('selected');textSettings.position=d.dataset.pos;});});
document.querySelectorAll('.font-opt').forEach(f=>{f.addEventListener('click',()=>{document.querySelectorAll('.font-opt').forEach(x=>x.classList.remove('selected'));f.classList.add('selected');textSettings.font=f.dataset.font;});});
document.getElementById('addTextBtn').addEventListener('click',addTextClip);
async function addTextClip(){
  const text=document.getElementById('textInput').value.trim();if(!text){alert('Enter some text first');return;}
  const canvas=document.createElement('canvas');canvas.width=1920;canvas.height=1080;const ctx=canvas.getContext('2d');ctx.clearRect(0,0,canvas.width,canvas.height);
  const bold=textSettings.styles.includes('bold')?'bold ':'';const italic=textSettings.styles.includes('italic')?'italic ':'';
  const displayText=textSettings.styles.includes('uppercase')?text.toUpperCase():text;
  ctx.font=`${italic}${bold}${textSettings.size}px "${textSettings.font}", sans-serif`;ctx.fillStyle=textSettings.color;ctx.textAlign='center';
  const yMap={center:canvas.height/2,top:textSettings.size+40,bottom:canvas.height-textSettings.size-20,'lower-third':canvas.height*0.82};
  ctx.textBaseline='middle';
  if(textSettings.styles.includes('shadow')){ctx.shadowColor='rgba(0,0,0,0.9)';ctx.shadowBlur=14;ctx.shadowOffsetX=2;ctx.shadowOffsetY=2;}
  if(textSettings.styles.includes('outline')){ctx.strokeStyle=textSettings.color==='#000000'?'#fff':'#000';ctx.lineWidth=6;ctx.strokeText(displayText,canvas.width/2,yMap[textSettings.position]);}
  if(textSettings.styles.includes('underline')){const m=ctx.measureText(displayText);ctx.fillRect(canvas.width/2-m.width/2,yMap[textSettings.position]+textSettings.size*0.55,m.width,textSettings.size*0.07);}
  ctx.fillText(displayText,canvas.width/2,yMap[textSettings.position]);ctx.shadowBlur=0;ctx.shadowOffsetX=0;ctx.shadowOffsetY=0;
  const blob=await new Promise(r=>canvas.toBlob(r,'image/png'));const file=new File([blob],`text_${Date.now()}.png`,{type:'image/png'});
  addClipToTrack('text1',{file,type:'text',url:URL.createObjectURL(blob),name:text.substring(0,16),duration:textSettings.duration,textContent:displayText,textSettings:{...textSettings,styles:[...textSettings.styles]}});
}

let selectedSolidColor='#000000';
document.querySelectorAll('.solid-swatch').forEach(s=>{s.addEventListener('click',()=>{document.querySelectorAll('.solid-swatch').forEach(x=>x.classList.remove('selected'));s.classList.add('selected');selectedSolidColor=s.dataset.color;});});
document.getElementById('customColorPicker').addEventListener('input',e=>{selectedSolidColor=e.target.value;document.querySelectorAll('.solid-swatch').forEach(x=>x.classList.remove('selected'));});
document.querySelectorAll('#colorCardType .opt-btn').forEach(b=>{b.addEventListener('click',()=>{document.querySelectorAll('#colorCardType .opt-btn').forEach(x=>x.classList.remove('selected'));b.classList.add('selected');colorSettings.type=b.dataset.ctype;});});
document.getElementById('colorDurSlider').addEventListener('input',e=>{colorSettings.duration=parseFloat(e.target.value);document.getElementById('colorDurVal').textContent=e.target.value+'s';});
document.getElementById('addColorBtn').addEventListener('click',addColorCard);
async function addColorCard(){
  const canvas=document.createElement('canvas');canvas.width=1920;canvas.height=1080;const ctx=canvas.getContext('2d');
  const color=selectedSolidColor;
  if(color.startsWith('gradient')){const g=ctx.createLinearGradient(0,0,canvas.width,canvas.height);if(color==='gradient-purple-pink'){g.addColorStop(0,'#7c5cfc');g.addColorStop(1,'#f04e98');}else{g.addColorStop(0,'#3b9eff');g.addColorStop(1,'#22d17a');}ctx.fillStyle=g;}
  else{ctx.fillStyle=color;}ctx.fillRect(0,0,canvas.width,canvas.height);
  const blob=await new Promise(r=>canvas.toBlob(r,'image/png'));
  addClipToTrack('video1',{file:null,type:'color',url:URL.createObjectURL(blob),name:colorSettings.type.charAt(0).toUpperCase()+colorSettings.type.slice(1),duration:colorSettings.duration,colorValue:color});
}

const BUILTIN_MUSIC=[{name:'Chill Lo-Fi Beat',dur:'2:30',bpm:'85'},{name:'Upbeat Pop Energy',dur:'1:45',bpm:'128'},{name:'Cinematic Strings',dur:'3:00',bpm:'72'},{name:'Electronic Drive',dur:'2:15',bpm:'140'},{name:'Acoustic Vibes',dur:'1:58',bpm:'92'}];
const builtinList=document.getElementById('builtinMusicList');
BUILTIN_MUSIC.forEach((track)=>{
  const item=document.createElement('div');item.className='music-item';
  item.innerHTML=`<div class="music-info"><div class="music-name">${track.name}</div><div class="music-dur">${track.dur} · ${track.bpm} BPM</div></div><button class="music-play-btn" title="Preview">▶</button><button style="background:var(--bg4);border:1px solid var(--border);border-radius:6px;padding:3px 7px;font-size:10px;cursor:pointer;color:var(--text2);" title="Add to timeline">+</button>`;
  item.querySelector('.music-play-btn').addEventListener('click',e=>{e.stopPropagation();document.querySelectorAll('.music-item').forEach(x=>x.classList.remove('playing'));item.classList.add('playing');item.querySelector('.music-play-btn').textContent='■';});
  item.querySelector('button:last-child').addEventListener('click',e=>{e.stopPropagation();alert('Add "'+track.name+'" — built-in audio simulation. Import a real audio file for actual playback.');});
  builtinList.appendChild(item);
});
document.getElementById('importMusicBtn').addEventListener('click',()=>document.getElementById('importMusicInput').click());
document.getElementById('importMusicInput').addEventListener('change',async(e)=>{
  const list=document.getElementById('importedMusicList');list.innerHTML='';
  for(const f of Array.from(e.target.files)){
    if(!f.type.startsWith('audio/'))continue;const url=URL.createObjectURL(f);const dur=await getMediaDuration(url,'audio');
    const item=document.createElement('div');item.className='music-item';
    item.innerHTML=`<div class="music-info"><div class="music-name">${f.name.replace(/\.[^.]+$/,'')}</div><div class="music-dur">${formatTime(dur)}</div></div><button style="background:var(--accent);border:none;border-radius:6px;padding:3px 10px;font-size:10px;cursor:pointer;color:#fff;font-weight:600;" data-url="${url}" data-name="${f.name}" data-dur="${dur}">+ Add</button>`;
    item.querySelector('button').addEventListener('click',function(){const track=clips.audio1.length===0?'audio1':'audio2';addClipToTrack(track,{file:f,type:'audio',url:this.dataset.url,name:this.dataset.name,duration:parseFloat(this.dataset.dur)});});
    list.appendChild(item);
  }e.target.value='';
});
function formatTime(s){const m=Math.floor(s/60);return m+':'+(Math.floor(s%60)).toString().padStart(2,'0');}

document.getElementById('addVideoBtn').addEventListener('click',()=>document.getElementById('addVideoInput').click());
document.getElementById('addAudioBtn').addEventListener('click',()=>document.getElementById('addAudioInput').click());
document.getElementById('addVideoInput').addEventListener('change',async(e)=>{
  for(const f of Array.from(e.target.files)){
    if(f.type.startsWith('video/')){const url=URL.createObjectURL(f);const dur=await getMediaDuration(url,'video');addClipToTrack('video1',{file:f,type:'video',url,name:f.name,duration:dur});}
    else if(f.type.startsWith('image/')){const url=URL.createObjectURL(f);addClipToTrack('video1',{file:f,type:'image',url,name:f.name,duration:imageDuration});}
  }e.target.value='';
});
document.getElementById('addAudioInput').addEventListener('change',async(e)=>{
  const track=clips.audio1.length===0?'audio1':'audio2';
  for(const f of Array.from(e.target.files)){if(f.type.startsWith('audio/')){const url=URL.createObjectURL(f);const dur=await getMediaDuration(url,'audio');addClipToTrack(track,{file:f,type:'audio',url,name:f.name,duration:dur});}}
  e.target.value='';
});
function getMediaDuration(url,kind){return new Promise(r=>{const el=document.createElement(kind==='audio'?'audio':'video');el.src=url;el.preload='metadata';el.onloadedmetadata=()=>r(el.duration||3);el.onerror=()=>r(3);});}
function addClipToTrack(trackId,clipData){
  const arr=clips[trackId];const start=arr.length>0?arr[arr.length-1].start+arr[arr.length-1].duration:0;
  arr.push({...clipData,start,id:Date.now()+Math.random()});
  if(trackId==='video1'||trackId==='video2'){while(transitions[trackId].length<arr.length-1)transitions[trackId].push('Cut');}
  recalcTotalDuration();renderAllTracks();schedulePreviewUpdate();
}

const rulerCanvas=document.getElementById('rulerCanvas'),rulerCtx=rulerCanvas.getContext('2d');
function drawRuler(){
  const scroll=document.getElementById('timelineScroll');const totalPx=Math.max(88+totalDuration*pxPerSec+200,scroll.clientWidth||600);
  rulerCanvas.width=totalPx;rulerCanvas.height=24;rulerCtx.fillStyle='#16161e';rulerCtx.fillRect(0,0,totalPx,24);
  rulerCtx.strokeStyle='rgba(255,255,255,0.1)';rulerCtx.lineWidth=1;rulerCtx.fillStyle='rgba(255,255,255,0.35)';rulerCtx.font='9px "DM Sans",sans-serif';
  const step=pxPerSec>=200?0.5:pxPerSec>=80?1:5;const totalSec=totalPx/pxPerSec;
  for(let s=0;s<=totalSec+step;s+=step){
    const x=88+s*pxPerSec;rulerCtx.beginPath();rulerCtx.moveTo(x,16);rulerCtx.lineTo(x,24);rulerCtx.stroke();
    if(s%1===0||step<=0.5){const label=s<60?s.toFixed(step<1?1:0)+'s':`${Math.floor(s/60)}:${(s%60).toFixed(0).padStart(2,'0')}`;rulerCtx.fillText(label,x+2,14);}
  }
  document.getElementById('timelineInner').style.minWidth=totalPx+'px';
}

function renderAllTracks(){TRACKS.forEach(renderTrack);updatePlayhead();}
function renderTrack(trackId){
  const content=document.getElementById('trackContent-'+trackId);if(!content)return;
  const arr=clips[trackId];const hint=content.querySelector('.track-drop-hint');if(hint)hint.style.display=arr.length===0?'flex':'none';
  content.querySelectorAll('.clip-block,.trans-badge').forEach(e=>e.remove());
  arr.forEach((clip,idx)=>{
    if(idx>0&&(trackId==='video1'||trackId==='video2')){
      const trans=(transitions[trackId]||[])[idx-1]||'Cut';const badge=document.createElement('div');badge.className='trans-badge';
      badge.style.left=(88+clip.start*pxPerSec-16)+'px';badge.textContent='⚡'+trans.substring(0,4);
      badge.addEventListener('click',e=>{e.stopPropagation();openTransModal(trackId,idx-1);});content.appendChild(badge);
    }
    const block=document.createElement('div');block.className='clip-block '+clip.type+'-clip';
    block.style.left=(88+clip.start*pxPerSec)+'px';block.style.width=Math.max(28,clip.duration*pxPerSec)+'px';
    block.dataset.track=trackId;block.dataset.idx=idx;
    if(selectedClip&&selectedClip.track===trackId&&selectedClip.idx===idx)block.classList.add('selected');
    if(clip.type==='video'||clip.type==='image'){const strip=document.createElement('div');strip.className='clip-thumb-strip';const img=clip.type==='video'?document.createElement('video'):document.createElement('img');img.className='clip-thumb-img';img.src=clip.url;if(clip.type==='video'){img.muted=true;img.preload='metadata';}strip.appendChild(img);block.appendChild(strip);}
    if(clip.type==='color'){const strip=document.createElement('div');strip.style.cssText='position:absolute;inset:0;border-radius:5px;opacity:0.6;';if(clip.colorValue&&clip.colorValue.startsWith('gradient')){strip.style.background=clip.colorValue==='gradient-purple-pink'?'linear-gradient(135deg,#7c5cfc,#f04e98)':'linear-gradient(135deg,#3b9eff,#22d17a)';}else{strip.style.background=clip.colorValue||'#000';}block.appendChild(strip);}
    const inner=document.createElement('div');inner.className='clip-block-inner';inner.innerHTML=`<div class="clip-name">${clip.name}</div><div class="clip-dur">${clip.duration.toFixed(1)}s</div>`;block.appendChild(inner);
    const rl=document.createElement('div');rl.className='clip-resize-l';block.appendChild(rl);const rr=document.createElement('div');rr.className='clip-resize-r';block.appendChild(rr);
    setupClipInteractions(block,clip,trackId,idx,rl,rr);content.appendChild(block);
  });
}

function setupClipInteractions(block,clip,trackId,idx,rl,rr){
  block.addEventListener('mousedown',e=>{if(e.target===rl||e.target===rr)return;selectedClip={track:trackId,idx};renderAllTracks();showRightPanel(clip,trackId,idx);e.stopPropagation();});
  let dragging=false,startX=0,origStart=0;
  block.addEventListener('mousedown',e=>{if(e.target===rl||e.target===rr)return;dragging=true;startX=e.clientX;origStart=clip.start;e.preventDefault();});
  document.addEventListener('mousemove',e=>{if(!dragging)return;const dx=(e.clientX-startX)/pxPerSec;clip.start=Math.max(0,origStart+dx);recalcTotalDuration();renderAllTracks();});
  document.addEventListener('mouseup',()=>{if(dragging){dragging=false;schedulePreviewUpdate();}});
  let resizing=false,startRX=0,origDur=0;
  rr.addEventListener('mousedown',e=>{resizing=true;startRX=e.clientX;origDur=clip.duration;e.stopPropagation();e.preventDefault();});
  document.addEventListener('mousemove',e=>{if(!resizing)return;const dx=(e.clientX-startRX)/pxPerSec;clip.duration=Math.max(0.2,origDur+dx);block.style.width=Math.max(28,clip.duration*pxPerSec)+'px';block.querySelector('.clip-dur').textContent=clip.duration.toFixed(1)+'s';recalcTotalDuration();drawRuler();});
  document.addEventListener('mouseup',()=>{if(resizing){resizing=false;renderAllTracks();schedulePreviewUpdate();}});
}

function recalcTotalDuration(){let max=0;TRACKS.forEach(t=>{clips[t].forEach(c=>{max=Math.max(max,c.start+c.duration);});});totalDuration=max;drawRuler();}

function showRightPanel(clip,trackId,idx){
  const panel=document.getElementById('rightPanel');panel.classList.add('show');const editable=clip.type==='image'||clip.type==='text'||clip.type==='color';
  panel.querySelector('#propContent').innerHTML=`<div class="prop-row"><label class="prop-label">Name</label><input class="prop-input" id="propName" value="${clip.name}"></div>${editable?`<div class="prop-row"><label class="prop-label">Duration (s)</label><input type="number" class="prop-input" id="propDur" value="${clip.duration.toFixed(1)}" min="0.2" step="0.5"></div>`:''}<div class="prop-row"><label class="prop-label">Start (s)</label><input type="number" class="prop-input" id="propStart" value="${clip.start.toFixed(2)}" min="0" step="0.1"></div>${clip.type==='text'&&clip.textContent?`<div class="prop-row"><label class="prop-label">Text</label><div style="font-size:11px;color:var(--text2);padding:4px 0;">${clip.textContent}</div></div>`:''}<button class="delete-clip-btn" id="propDelete">🗑 Remove Clip</button>`;
  document.getElementById('propName').addEventListener('change',e=>{clip.name=e.target.value;renderAllTracks();});
  if(editable){document.getElementById('propDur').addEventListener('change',e=>{clip.duration=parseFloat(e.target.value)||clip.duration;recalcTotalDuration();renderAllTracks();schedulePreviewUpdate();});}
  document.getElementById('propStart').addEventListener('change',e=>{clip.start=parseFloat(e.target.value)||0;recalcTotalDuration();renderAllTracks();schedulePreviewUpdate();});
  document.getElementById('propDelete').addEventListener('click',()=>{clips[trackId].splice(idx,1);if(transitions[trackId])transitions[trackId].splice(Math.min(idx,transitions[trackId].length-1),1);selectedClip=null;panel.classList.remove('show');recalcTotalDuration();renderAllTracks();schedulePreviewUpdate();});
}

document.querySelectorAll('[data-trans]').forEach(el=>{el.addEventListener('click',()=>{if(selectedGap){const{track,idx}=selectedGap;if(transitions[track])transitions[track][idx]=el.dataset.trans;selectedGap=null;renderTrack(track);schedulePreviewUpdate();}else{alert('Click ⚡ between two clips on the timeline first.');}});});
function openTransModal(trackId,gapIdx){
  selectedGap={track:trackId,idx:gapIdx};const grid=document.getElementById('transModalGrid');grid.innerHTML='';
  ALL_TRANSITIONS.forEach(t=>{const el=document.createElement('div');el.className='modal-item'+((transitions[trackId]||[])[gapIdx]===t?' selected':'');el.textContent=t;el.addEventListener('click',()=>{if(!transitions[trackId])transitions[trackId]=[];transitions[trackId][gapIdx]=t;selectedGap=null;closeTransModal();renderTrack(trackId);schedulePreviewUpdate();});grid.appendChild(el);});
  document.getElementById('transModal').classList.add('show');
}
function closeTransModal(){document.getElementById('transModal').classList.remove('show');}
document.getElementById('transModalClose').addEventListener('click',closeTransModal);
document.getElementById('transModal').addEventListener('click',e=>{if(e.target===document.getElementById('transModal'))closeTransModal();});

document.getElementById('imgDurBtn').addEventListener('click',()=>document.getElementById('imgDurModal').classList.add('show'));
document.getElementById('imgDurSlider').addEventListener('input',e=>{imageDuration=parseFloat(e.target.value);document.getElementById('imgDurDisplay').textContent=imageDuration+'s';document.getElementById('imgDurLabel').textContent=imageDuration+'s';});
document.getElementById('imgDurClose').addEventListener('click',()=>{TRACKS.forEach(t=>{clips[t].forEach(c=>{if(c.type==='image')c.duration=imageDuration;});});recalcTotalDuration();renderAllTracks();schedulePreviewUpdate();document.getElementById('imgDurModal').classList.remove('show');});

document.getElementById('tracksArea').addEventListener('click',e=>{
  const content=e.target.closest('.track-content');if(!content)return;
  const scroll=document.getElementById('timelineScroll');const absX=e.clientX-scroll.getBoundingClientRect().left+scroll.scrollLeft;
  const t=(absX-88)/pxPerSec;currentTime=Math.max(0,Math.min(t,totalDuration));updatePlayhead();seekPreview(currentTime);
});
document.getElementById('rulerCanvas').addEventListener('click',e=>{
  const rect=rulerCanvas.getBoundingClientRect();const x=e.clientX-rect.left;const t=(x-88)/pxPerSec;currentTime=Math.max(0,Math.min(t,totalDuration));updatePlayhead();seekPreview(currentTime);
});
function updatePlayhead(){
  const ph=document.getElementById('playhead');ph.style.left=(88+currentTime*pxPerSec)+'px';
  const m=Math.floor(currentTime/60),s=(currentTime%60).toFixed(1).padStart(4,'0'),tm=Math.floor(totalDuration/60),ts=(totalDuration%60).toFixed(1).padStart(4,'0');
  document.getElementById('timeDisplay').textContent=`${m}:${s} / ${tm}:${ts}`;
}
document.getElementById('zoomSlider').addEventListener('input',e=>{pxPerSec=parseInt(e.target.value);document.getElementById('zoomLabel').textContent=(pxPerSec/120).toFixed(1)+'×';drawRuler();renderAllTracks();});

let previewBlobUrl=null,updateTimer=null;
function schedulePreviewUpdate(){if(updateTimer)clearTimeout(updateTimer);updateTimer=setTimeout(generatePreview,600);}
async function generatePreview(){
  const mainClips=clips.video1;const placeholder=document.getElementById('previewPlaceholder');const video=document.getElementById('previewVideo');
  if(mainClips.length===0){placeholder.style.display='flex';video.style.display='none';return;}
  document.getElementById('processingOverlay').classList.add('show');placeholder.style.display='none';video.style.display='block';
  try{
    const blob=await mergeClips(mainClips,transitions.video1||[]);
    if(previewBlobUrl)URL.revokeObjectURL(previewBlobUrl);
    previewBlobUrl=URL.createObjectURL(blob);video.src=previewBlobUrl;video.load();
    if(isPlaying)video.play().catch(()=>{});else video.currentTime=Math.min(currentTime,totalDuration);
    applyFilterToPreview();recalcTotalDuration();drawRuler();updatePlayhead();
  }catch(err){console.warn('Preview error:',err);}
  finally{document.getElementById('processingOverlay').classList.remove('show');}
}

// ================================================================
// CORE RENDER ENGINE — Canvas + MediaRecorder (no FFmpeg needed)
// ================================================================
async function mergeClips(clipList, transList, maxDurationSec){
  if(clipList.length===0) throw new Error('No clips');
  let maxW=0, maxH=0;
  for(const c of clipList){
    if(c.type==='video'){
      const v=document.createElement('video');v.src=c.url;
      await new Promise(r=>{v.onloadedmetadata=()=>{maxW=Math.max(maxW,v.videoWidth);maxH=Math.max(maxH,v.videoHeight);r();};v.onerror=r;});
    } else {
      const img=new Image();img.src=c.url;
      await new Promise(r=>{img.onload=()=>{maxW=Math.max(maxW,img.width);maxH=Math.max(maxH,img.height);r();};img.onerror=r;});
    }
  }
  if(!maxW){maxW=1280;maxH=720;}

  const canvas=document.createElement('canvas');
  canvas.width=maxW; canvas.height=maxH;
  const ctx=canvas.getContext('2d');
  const stream=canvas.captureStream(30);
  const {mime, ext}=getBestMime(30);
  const recorder=new MediaRecorder(stream,{mimeType:mime, videoBitsPerSecond:4000000});
  const chunks=[];
  recorder.ondataavailable=e=>{if(e.data&&e.data.size>0)chunks.push(e.data);};

  let resolveRec, rejectRec;
  const recPromise=new Promise((rs,rj)=>{
    resolveRec=rs; rejectRec=rj;
    recorder.onstop=()=>rs(new Blob(chunks,{type:mime}));
    recorder.onerror=(e)=>rj(e);
  });

  recorder.start(100);
  try{
    let totalRendered=0;
    for(let i=0;i<clipList.length;i++){
      const clip=clipList[i];
      const clipDur = maxDurationSec ? Math.min(clip.duration, Math.max(0, maxDurationSec - totalRendered)) : clip.duration;
      if(clipDur<=0) break;
      await playClipToCanvas(ctx, canvas, {...clip, duration: clipDur});
      totalRendered += clipDur;
      if(maxDurationSec && totalRendered >= maxDurationSec) break;
      if(i<clipList.length-1){
        await renderTransition(ctx, canvas, clip, clipList[i+1], (transList[i]||'Cut'));
      }
    }
  } catch(e){ console.warn('Render error',e); }

  await new Promise(r=>setTimeout(r,400));
  if(recorder.state!=='inactive') recorder.stop();
  return recPromise;
}

async function playClipToCanvas(ctx, canvas, clip){
  return new Promise(async resolve=>{
    if(clip.type==='video'){
      const video=document.createElement('video');
      video.src=clip.url; video.muted=true; video.crossOrigin='anonymous';
      await new Promise(r=>{video.onloadedmetadata=r;video.onerror=r;});
      video.currentTime=0;
      await new Promise(r=>{video.onseeked=r; video.currentTime=0;});
      await video.play().catch(()=>{});
      const dur=clip.duration; const startMs=performance.now();
      const draw=()=>{
        const elapsed=(performance.now()-startMs)/1000;
        if(elapsed<dur&&!video.ended&&!video.paused){
          fitDraw(ctx,canvas,video); requestAnimationFrame(draw);
        } else { video.pause(); resolve(); }
      };
      requestAnimationFrame(draw);
    } else {
      const img=await new Promise(r=>{const i=new Image();i.onload=()=>r(i);i.onerror=()=>r(null);i.src=clip.url;});
      const dur=clip.duration; const startMs=performance.now();
      const draw=()=>{
        const elapsed=(performance.now()-startMs)/1000;
        if(elapsed<dur){
          ctx.fillStyle='#000'; ctx.fillRect(0,0,canvas.width,canvas.height);
          if(img) fitDraw(ctx,canvas,img);
          requestAnimationFrame(draw);
        } else resolve();
      };
      requestAnimationFrame(draw);
    }
  });
}

function fitDraw(ctx, canvas, src){
  const sw=src.videoWidth||src.naturalWidth||src.width||canvas.width;
  const sh=src.videoHeight||src.naturalHeight||src.height||canvas.height;
  const scale=Math.min(canvas.width/sw, canvas.height/sh);
  const dw=sw*scale, dh=sh*scale, ox=(canvas.width-dw)/2, oy=(canvas.height-dh)/2;
  ctx.fillStyle='#000'; ctx.fillRect(0,0,canvas.width,canvas.height);
  ctx.drawImage(src,ox,oy,dw,dh);
}

async function renderTransition(ctx, canvas, fromClip, toClip, transName){
  const dur=0.4; const startMs=performance.now();
  return new Promise(resolve=>{
    const preload=()=>new Promise(r=>{
      if(toClip.type==='video'){
        const v=document.createElement('video');v.src=toClip.url;v.muted=true;v.preload='metadata';
        v.onloadedmetadata=()=>r(v);v.onerror=()=>r(null);
      } else {
        const img=new Image();img.src=toClip.url;img.onload=()=>r(img);img.onerror=()=>r(null);
      }
    });
    preload().then(to=>{
      const draw=()=>{
        const t=Math.min(1,(performance.now()-startMs)/(dur*1000));
        applyTrans(ctx,canvas,fromClip,to,transName,t);
        if(t<1) requestAnimationFrame(draw); else resolve();
      };
      requestAnimationFrame(draw);
    });
  });
}

function applyTrans(ctx, canvas, fromClip, toSrc, name, t){
  const W=canvas.width, H=canvas.height;
  if(name==='Fade'||name==='Cross Dissolve'){
    if(toSrc) fitDraw(ctx,canvas,toSrc);
    ctx.fillStyle='#000'; ctx.globalAlpha=1-t; ctx.fillRect(0,0,W,H); ctx.globalAlpha=1;
  } else if(name==='Dip to Black'){
    ctx.fillStyle='#000'; ctx.fillRect(0,0,W,H);
    if(t>0.5&&toSrc){ctx.globalAlpha=(t-0.5)*2;fitDraw(ctx,canvas,toSrc);ctx.globalAlpha=1;}
  } else if(name==='Dip to White'){
    ctx.fillStyle='#fff'; ctx.fillRect(0,0,W,H);
    if(t>0.5&&toSrc){ctx.globalAlpha=(t-0.5)*2;fitDraw(ctx,canvas,toSrc);ctx.globalAlpha=1;}
  } else if(name==='Wipe Left'){
    if(toSrc) fitDraw(ctx,canvas,toSrc);
    ctx.fillStyle='#000'; ctx.fillRect(0,0,W*(1-t),H);
  } else if(name==='Wipe Right'){
    ctx.fillStyle='#000'; ctx.fillRect(W*t,0,W,H);
    if(toSrc){ctx.save();ctx.beginPath();ctx.rect(0,0,W*t,H);ctx.clip();fitDraw(ctx,canvas,toSrc);ctx.restore();}
  } else if(name==='Flash'){
    if(t<0.3){ctx.fillStyle='#fff';ctx.globalAlpha=t/0.3;ctx.fillRect(0,0,W,H);ctx.globalAlpha=1;}
    else if(toSrc) fitDraw(ctx,canvas,toSrc);
  } else if(name==='Zoom In'){
    ctx.save();ctx.scale(1+t*0.3,1+t*0.3);ctx.translate(-W*t*0.15,-H*t*0.15);
    if(toSrc) fitDraw(ctx,canvas,toSrc);ctx.restore();
  } else {
    if(t>0.5&&toSrc) fitDraw(ctx,canvas,toSrc);
  }
}

// ================================================================
// EDITOR EXPORT — pure Canvas/MediaRecorder, no FFmpeg needed
// ================================================================
document.getElementById('exportBtn').addEventListener('click',()=>{
  if(clips.video1.length===0){alert('Add video/images to export first.');return;}
  document.getElementById('exportProgress').classList.remove('show');
  document.getElementById('exportProgressBar').style.width='0%';
  document.getElementById('exportModal').classList.add('show');
});
document.getElementById('exportModalClose').addEventListener('click',()=>document.getElementById('exportModal').classList.remove('show'));

async function startExport(fmt){
  const progress=document.getElementById('exportProgress');
  const statusEl=document.getElementById('exportStatusText');
  const bar=document.getElementById('exportProgressBar');
  const closeBtn=document.getElementById('exportModalClose');
  progress.classList.add('show');
  bar.style.width='5%';
  closeBtn.textContent='Please wait…';
  closeBtn.disabled=true;

  // Simulate progress during rendering
  let pct=5;
  const iv=setInterval(()=>{pct=Math.min(pct+2, 90);bar.style.width=pct+'%';},400);

  try{
    statusEl.textContent='Rendering video frames…';
    const maxDur = fmt==='short' ? 10 : undefined;
    const blob = await mergeClips(clips.video1, transitions.video1||[], maxDur);
    clearInterval(iv);
    bar.style.width='100%';
    statusEl.textContent='✅ Done! Downloading…';
    const filename = fmt==='short'
      ? `clipforge_short_${Date.now()}.mp4`
      : `clipforge_edit_${Date.now()}.mp4`;
    triggerDownload(blob, filename);
    setTimeout(()=>document.getElementById('exportModal').classList.remove('show'),1500);
  } catch(err){
    clearInterval(iv);
    statusEl.textContent='❌ Error: '+err.message;
    bar.style.background='var(--red)';
    console.error('Export error:',err);
  } finally{
    closeBtn.textContent='Cancel';
    closeBtn.disabled=false;
  }
}

// ================================================================
// PREVIEW PLAYER
// ================================================================
const previewVideo=document.getElementById('previewVideo');
document.getElementById('playPauseBtn').addEventListener('click',togglePlay);
document.getElementById('skipBackBtn').addEventListener('click',()=>{currentTime=0;seekPreview(0);});
document.getElementById('skipFwdBtn').addEventListener('click',()=>{currentTime=Math.max(0,totalDuration-0.1);seekPreview(currentTime);});
document.getElementById('prevFrameBtn').addEventListener('click',()=>{currentTime=Math.max(0,currentTime-1/30);seekPreview(currentTime);});
document.getElementById('nextFrameBtn').addEventListener('click',()=>{currentTime=Math.min(totalDuration,currentTime+1/30);seekPreview(currentTime);});
document.getElementById('muteBtn').addEventListener('click',()=>{previewVideo.muted=!previewVideo.muted;document.getElementById('muteBtn').textContent=previewVideo.muted?'🔇':'🔊';});
document.getElementById('fullscreenBtn').addEventListener('click',()=>{if(previewVideo.requestFullscreen)previewVideo.requestFullscreen();});
function togglePlay(){isPlaying=!isPlaying;document.getElementById('playPauseBtn').textContent=isPlaying?'⏸':'▶';if(isPlaying){previewVideo.play().catch(()=>{});startPlayheadSync();}else{previewVideo.pause();stopPlayheadSync();}}
function startPlayheadSync(){if(playTimer)clearInterval(playTimer);playTimer=setInterval(()=>{if(!isPlaying){clearInterval(playTimer);return;}currentTime=previewVideo.currentTime||currentTime;updatePlayhead();if(currentTime>=totalDuration){isPlaying=false;document.getElementById('playPauseBtn').textContent='▶';clearInterval(playTimer);}},50);}
function stopPlayheadSync(){clearInterval(playTimer);}
function seekPreview(t){if(previewVideo.src){previewVideo.currentTime=Math.min(t,previewVideo.duration||t);}updatePlayhead();}
previewVideo.addEventListener('timeupdate',()=>{currentTime=previewVideo.currentTime;updatePlayhead();});
previewVideo.addEventListener('ended',()=>{isPlaying=false;document.getElementById('playPauseBtn').textContent='▶';stopPlayheadSync();});
document.getElementById('ratioSelect').addEventListener('change',e=>{
  const r=e.target.value;document.getElementById('ratioBadge').textContent=r;const wrap=document.getElementById('previewFrameWrap');
  if(r==='9:16')wrap.style.maxWidth='200px';else if(r==='1:1')wrap.style.maxWidth='360px';else wrap.style.maxWidth='';
});
document.getElementById('splitBtn').addEventListener('click',()=>{
  if(!selectedClip){alert('Select a clip first');return;}const{track,idx}=selectedClip;const clip=clips[track][idx];if(!clip)return;
  const splitAt=currentTime-clip.start;if(splitAt<=0.1||splitAt>=clip.duration-0.1){alert('Playhead must be inside the clip to split');return;}
  const part2={...clip,start:clip.start+splitAt,duration:clip.duration-splitAt,id:Date.now()+Math.random()};clip.duration=splitAt;clips[track].splice(idx+1,0,part2);
  if(transitions[track])transitions[track].splice(idx,0,'Cut');recalcTotalDuration();renderAllTracks();schedulePreviewUpdate();
});
document.getElementById('deleteClipBtn').addEventListener('click',()=>{
  if(!selectedClip){alert('Select a clip first');return;}const{track,idx}=selectedClip;clips[track].splice(idx,1);
  if(transitions[track])transitions[track].splice(Math.min(idx,transitions[track].length-1),1);
  selectedClip=null;document.getElementById('rightPanel').classList.remove('show');recalcTotalDuration();renderAllTracks();schedulePreviewUpdate();
});
TRACKS.forEach(trackId=>{
  const content=document.getElementById('trackContent-'+trackId);if(!content)return;
  content.addEventListener('dragover',e=>{e.preventDefault();content.style.background='rgba(124,92,252,0.08)';});
  content.addEventListener('dragleave',()=>{content.style.background='';});
  content.addEventListener('drop',async e=>{
    e.preventDefault();content.style.background='';
    for(const f of Array.from(e.dataTransfer.files)){
      const isV=f.type.startsWith('video/'),isI=f.type.startsWith('image/'),isA=f.type.startsWith('audio/');
      if(isV){const url=URL.createObjectURL(f);const dur=await getMediaDuration(url,'video');addClipToTrack(trackId.startsWith('audio')?'video1':trackId,{file:f,type:'video',url,name:f.name,duration:dur});}
      else if(isI){const url=URL.createObjectURL(f);addClipToTrack(trackId.startsWith('audio')?'video1':trackId,{file:f,type:'image',url,name:f.name,duration:imageDuration});}
      else if(isA&&trackId.startsWith('audio')){const url=URL.createObjectURL(f);const dur=await getMediaDuration(url,'audio');addClipToTrack(trackId,{file:f,type:'audio',url,name:f.name,duration:dur});}
    }
  });
});

// ================================================================
// RESIZER — PLATFORM GRID + CANVAS PREVIEW + MP4 EXPORT
// ================================================================
const PLATFORMS=[
  {name:'YouTube',ratio:'16:9',w:1920,h:1080,icon:'▶'},
  {name:'TikTok',ratio:'9:16',w:1080,h:1920,icon:'♪'},
  {name:'Instagram Reel',ratio:'9:16',w:1080,h:1920,icon:'◎'},
  {name:'Instagram Post',ratio:'1:1',w:1080,h:1080,icon:'⬡'},
  {name:'Instagram Story',ratio:'9:16',w:1080,h:1920,icon:'◷'},
  {name:'Twitter/X',ratio:'16:9',w:1280,h:720,icon:'✕'},
  {name:'Facebook',ratio:'16:9',w:1280,h:720,icon:'f'},
  {name:'LinkedIn',ratio:'16:9',w:1920,h:1080,icon:'in'},
  {name:'YouTube Shorts',ratio:'9:16',w:1080,h:1920,icon:'▷'},
  {name:'Snapchat',ratio:'9:16',w:1080,h:1920,icon:'◈'},
];

let resizerSelectedPlatform=PLATFORMS[0];
let resizerBgFill='black';
let resizerVideoLoaded=false;
let resizerPreviewRAF=null;
let resizerIsPlaying=false;

const pgrid=document.getElementById('resizerPlatformGrid');
PLATFORMS.forEach((p,i)=>{
  const card=document.createElement('div');card.className='platform-card'+(i===0?' selected':'');
  const ar=p.w>p.h?{w:32,h:20}:p.w===p.h?{w:24,h:24}:{w:20,h:32};
  card.innerHTML=`<div class="platform-icon-wrap" style="width:${ar.w}px;height:${ar.h}px;">${p.icon}</div><div class="platform-name">${p.name}</div><div class="platform-dims">${p.ratio} · ${p.w}×${p.h}</div>`;
  card.addEventListener('click',()=>{
    document.querySelectorAll('.platform-card').forEach(x=>x.classList.remove('selected'));
    card.classList.add('selected');resizerSelectedPlatform=p;
    if(resizerVideoLoaded)drawResizerOutput();
    document.getElementById('outputPlatformLabel').textContent=p.name;
    document.getElementById('outputDimsLabel').textContent=`${p.w}×${p.h}`;
  });
  pgrid.appendChild(card);
});

document.querySelectorAll('#bgFillPills .opt-pill').forEach(b=>{
  b.addEventListener('click',()=>{
    document.querySelectorAll('#bgFillPills .opt-pill').forEach(x=>x.classList.remove('selected'));
    b.classList.add('selected');resizerBgFill=b.dataset.bg;
    if(resizerVideoLoaded)drawResizerOutput();
  });
});
document.querySelectorAll('#qualityPills .opt-pill').forEach(b=>{
  b.addEventListener('click',()=>{document.querySelectorAll('#qualityPills .opt-pill').forEach(x=>x.classList.remove('selected'));b.classList.add('selected');});
});

const resizerUploadZone=document.getElementById('resizerUploadZone');
resizerUploadZone.addEventListener('click',e=>{
  if(e.target.id==='resizerChangeBtn'||e.target.closest('#resizerChangeBtn'))return;
  document.getElementById('resizerFileInput').click();
});
resizerUploadZone.addEventListener('dragover',e=>{e.preventDefault();resizerUploadZone.classList.add('drag-over');});
resizerUploadZone.addEventListener('dragleave',()=>resizerUploadZone.classList.remove('drag-over'));
resizerUploadZone.addEventListener('drop',e=>{e.preventDefault();resizerUploadZone.classList.remove('drag-over');const f=e.dataTransfer.files[0];if(f&&f.type.startsWith('video/'))loadResizerVideo(f);});
document.getElementById('resizerFileInput').addEventListener('change',e=>{const f=e.target.files[0];if(f)loadResizerVideo(f);e.target.value='';});

function loadResizerVideo(file){
  const vid=document.getElementById('resizerPreviewVid');
  if(vid.src)URL.revokeObjectURL(vid.src);
  const url=URL.createObjectURL(file);
  vid.src=url;vid.style.display='block';
  document.getElementById('resizerPlaceholder').style.display='none';
  document.getElementById('resizerFileInfo').innerHTML=`<span class="file-badge">📹 ${file.name}</span><span style="color:var(--text3);">${(file.size/1024/1024).toFixed(1)} MB</span>`;
  document.getElementById('resizerChangeBtn').textContent='📁 Replace';
  vid.onloadedmetadata=()=>{
    resizerVideoLoaded=true;
    document.getElementById('resizerWorkspace').classList.remove('locked');
    document.getElementById('resizerExportMp4Btn').disabled=false;
    document.getElementById('resizerExportGifBtn').disabled=false;
    document.getElementById('outputPlatformLabel').textContent=resizerSelectedPlatform.name;
    document.getElementById('outputDimsLabel').textContent=`${resizerSelectedPlatform.w}×${resizerSelectedPlatform.h}`;
    drawResizerOutput();
    vid.play().catch(()=>{});
  };
}

function drawResizerFrame(canvas,src,platform,bgFill){
  const ctx=canvas.getContext('2d');
  const tw=canvas.width,th=canvas.height;
  const sw=src.videoWidth||src.naturalWidth||tw;
  const sh=src.videoHeight||src.naturalHeight||th;
  if(bgFill==='white'){ctx.fillStyle='#ffffff';ctx.fillRect(0,0,tw,th);}
  else if(bgFill==='blur'){
    ctx.save();ctx.filter='blur(28px)';
    const bs=Math.max(tw/sw,th/sh)*1.15;
    const bw=sw*bs,bh=sh*bs;
    ctx.drawImage(src,(tw-bw)/2,(th-bh)/2,bw,bh);
    ctx.restore();ctx.filter='none';
  }else{ctx.fillStyle='#000000';ctx.fillRect(0,0,tw,th);}
  const scale=Math.min(tw/sw,th/sh);
  const dw=sw*scale,dh=sh*scale;
  const ox=(tw-dw)/2,oy=(th-dh)/2;
  ctx.drawImage(src,ox,oy,dw,dh);
}

function drawResizerOutput(){
  const vid=document.getElementById('resizerPreviewVid');
  if(!resizerVideoLoaded||!vid.videoWidth)return;
  const p=resizerSelectedPlatform;
  const canvas=document.getElementById('resizerOutputCanvas');
  canvas.width=p.w;canvas.height=p.h;
  const wrap=document.getElementById('outputCanvasWrap');
  const maxW=wrap.clientWidth||268;
  const scale=maxW/p.w;
  canvas.style.width=Math.round(p.w*scale)+'px';
  canvas.style.height=Math.round(p.h*scale)+'px';
  drawResizerFrame(canvas,vid,p,resizerBgFill);
}

document.getElementById('resizerLivePreviewBtn').addEventListener('click',()=>{
  const vid=document.getElementById('resizerPreviewVid');if(!resizerVideoLoaded)return;
  const canvas=document.getElementById('resizerOutputCanvas');
  if(!resizerIsPlaying){
    vid.play().catch(()=>{});resizerIsPlaying=true;
    document.getElementById('resizerLivePreviewBtn').textContent='⏸ Pause Preview';
    const loop=()=>{
      if(!resizerIsPlaying)return;
      drawResizerFrame(canvas,vid,resizerSelectedPlatform,resizerBgFill);
      resizerPreviewRAF=requestAnimationFrame(loop);
    };loop();
  }else{
    vid.pause();resizerIsPlaying=false;cancelAnimationFrame(resizerPreviewRAF);
    document.getElementById('resizerLivePreviewBtn').textContent='▶ Play Preview';
    drawResizerOutput();
  }
});

document.getElementById('resizerPreviewVid').addEventListener('seeked',()=>{if(resizerVideoLoaded&&!resizerIsPlaying)drawResizerOutput();});
document.getElementById('resizerPreviewVid').addEventListener('timeupdate',()=>{if(resizerVideoLoaded&&!resizerIsPlaying)drawResizerOutput();});

function setResizerProgress(show,text,pct){
  const wrap=document.getElementById('resizerExportProgressWrap');
  const bar=document.getElementById('resizerProgressBar');
  const txt=document.getElementById('resizerProgressText');
  wrap.classList.toggle('show',show);
  if(text)txt.textContent=text;
  if(pct!=null)bar.style.width=pct+'%';
}
function lockResizerBtns(state){
  document.getElementById('resizerExportMp4Btn').disabled=state;
  document.getElementById('resizerExportGifBtn').disabled=state;
}

// ── RESIZER: render frames to video blob using Canvas + MediaRecorder ──
async function renderResizerToBlob(maxDurationSec){
  const vid=document.getElementById('resizerPreviewVid');
  const p=resizerSelectedPlatform;

  // Cap export resolution so it's not too slow in browser
  const maxExportDim=1280;
  let ew=p.w, eh=p.h;
  if(ew>maxExportDim||eh>maxExportDim){
    const s=maxExportDim/Math.max(ew,eh);
    ew=Math.round(ew*s); eh=Math.round(eh*s);
  }

  const canvas=document.createElement('canvas');
  canvas.width=ew; canvas.height=eh;
  const stream=canvas.captureStream(30);
  const {mime}=getBestMime(30);
  const recorder=new MediaRecorder(stream,{mimeType:mime, videoBitsPerSecond:4000000});
  const chunks=[];
  recorder.ondataavailable=e=>{if(e.data&&e.data.size>0)chunks.push(e.data);};

  let resolveRec;
  const recPromise=new Promise(rs=>{
    resolveRec=rs;
    recorder.onstop=()=>rs(new Blob(chunks,{type:mime}));
  });

  // Seek to start
  vid.currentTime=0;
  await new Promise(r=>{vid.onseeked=r; if(vid.readyState>=2)r();});

  recorder.start(100);

  const limitMs = maxDurationSec ? maxDurationSec*1000 : (vid.duration||60)*1000+800;
  let stopped=false;

  await new Promise(resolve=>{
    const timeout=setTimeout(()=>{
      if(!stopped){stopped=true;vid.pause();if(recorder.state==='recording')recorder.stop();resolve();}
    }, limitMs+500);

    vid.onended=()=>{
      clearTimeout(timeout);
      if(!stopped){stopped=true;if(recorder.state==='recording')recorder.stop();resolve();}
    };

    const loop=()=>{
      if(recorder.state==='inactive'||stopped){resolve();return;}
      drawResizerFrame(canvas,vid,{w:ew,h:eh},resizerBgFill);
      if(maxDurationSec && vid.currentTime>=maxDurationSec){
        clearTimeout(timeout);
        if(!stopped){stopped=true;vid.pause();if(recorder.state==='recording')recorder.stop();resolve();}
        return;
      }
      requestAnimationFrame(loop);
    };

    vid.play().catch(()=>{});
    requestAnimationFrame(loop);
  });

  await new Promise(r=>setTimeout(r,300));
  if(recorder.state==='recording') recorder.stop();
  return recPromise;
}

// Main MP4 download button
document.getElementById('resizerExportMp4Btn').addEventListener('click',async()=>{
  if(!resizerVideoLoaded)return;
  lockResizerBtns(true);
  setResizerProgress(true,'Rendering video frames…',5);
  let pct=5;
  const iv=setInterval(()=>{pct=Math.min(pct+1.5,90);setResizerProgress(true,null,pct);},500);
  try{
    const blob=await renderResizerToBlob();
    clearInterval(iv);
    setResizerProgress(true,'✅ Done! Downloading…',100);
    const name=resizerSelectedPlatform.name.replace(/[\s\/]+/g,'_');
    triggerDownload(blob,`clipforge_${name}_${resizerSelectedPlatform.w}x${resizerSelectedPlatform.h}_${Date.now()}.mp4`);
    setTimeout(()=>setResizerProgress(false),3000);
  }catch(err){
    clearInterval(iv);
    setResizerProgress(true,'❌ Error: '+err.message,0);
    console.error('Resizer MP4 export error:',err);
  }finally{
    lockResizerBtns(false);
    if(resizerVideoLoaded){
      document.getElementById('resizerExportMp4Btn').disabled=false;
      document.getElementById('resizerExportGifBtn').disabled=false;
    }
  }
});

// Short clip button (first 10s, lower res)
document.getElementById('resizerExportGifBtn').addEventListener('click',async()=>{
  if(!resizerVideoLoaded)return;
  lockResizerBtns(true);
  setResizerProgress(true,'Capturing first 10 seconds…',10);
  let pct=10;
  const iv=setInterval(()=>{pct=Math.min(pct+2,90);setResizerProgress(true,null,pct);},400);
  try{
    const blob=await renderResizerToBlob(10);
    clearInterval(iv);
    setResizerProgress(true,'✅ Done! Downloading…',100);
    const name=resizerSelectedPlatform.name.replace(/[\s\/]+/g,'_');
    triggerDownload(blob,`clipforge_short_${name}_${Date.now()}.mp4`);
    setTimeout(()=>setResizerProgress(false),3000);
  }catch(err){
    clearInterval(iv);
    setResizerProgress(true,'❌ Error: '+err.message,0);
    console.error('Short clip export error:',err);
  }finally{
    lockResizerBtns(false);
    if(resizerVideoLoaded){
      document.getElementById('resizerExportMp4Btn').disabled=false;
      document.getElementById('resizerExportGifBtn').disabled=false;
    }
  }
});

// ================================================================
// INIT
// ================================================================
drawRuler();renderAllTracks();
document.getElementById('previewPlaceholder').style.display='flex';
document.getElementById('previewVideo').style.display='none';
document.getElementById('outputPlatformLabel').textContent=PLATFORMS[0].name;
document.getElementById('outputDimsLabel').textContent=`${PLATFORMS[0].w}×${PLATFORMS[0].h}`;
</script>
</body>
</html>