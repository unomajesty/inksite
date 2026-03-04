<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>InkSite Advertising · custom shirts PH</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Dancing+Script:wght@700&family=Lobster&family=Oswald:wght@600&family=Outfit:wght@300;400;500;600;700&family=Pacifico&family=Permanent+Marker&family=Playfair+Display:wght@700&family=Press+Start+2P&family=Righteous&family=Rock+Salt&family=Russo+One&family=Syne:wght@600;700;800&family=UnifrakturMaguntia&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

:root {
  --bg: #e8edf3;
  --card: #ffffff;
  --panel: #f0f4f9;
  --panel2: #e4eaf2;
  --accent: #1a3a52;
  --accent2: #2a5f8a;
  --blue: #4f8ef7;
  --border: #d0dae6;
  --text: #0f1e2b;
  --muted: #5a7080;
}

body {
  font-family: 'Outfit', system-ui, sans-serif;
  background: var(--bg);
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  padding: 2rem 1rem 3rem;
}

.app {
  width: 100%;
  max-width: 1360px;
  background: var(--card);
  border-radius: 3rem;
  box-shadow: 0 30px 70px -20px rgba(10,25,45,0.3);
  padding: 2.5rem 2.5rem 2rem;
}

header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 2rem;
  flex-wrap: wrap;
}

header h1 {
  font-family: 'Syne', sans-serif;
  font-size: 1.75rem;
  font-weight: 800;
  letter-spacing: -0.03em;
  color: var(--text);
}
header h1 span { 
  background: linear-gradient(145deg, #1a3a52, #b22222); 
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; 
  font-size: 1.9rem; margin-left: 0.2rem; 
}

.badge {
  background: #dceaf6;
  color: var(--accent2);
  font-size: 0.78rem;
  font-weight: 500;
  padding: 0.3rem 1rem;
  border-radius: 50px;
}

.layout {
  display: grid;
  grid-template-columns: 1.15fr 0.85fr;
  gap: 2rem;
}

/* ── LEFT ── */
.left-col {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

/* Shirt preview card */
.shirt-card {
  background: var(--panel);
  border-radius: 2rem;
  padding: 2.5rem 1.5rem 1.8rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  box-shadow: inset 0 2px 6px rgba(255,255,255,0.85), 0 10px 20px -12px rgba(20,40,60,0.18);
}

/* 3D scene */
.scene {
  perspective: 950px;
  perspective-origin: 50% 38%;
  width: 100%;
  max-width: 380px;
  height: 400px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.shirt-3d {
  position: relative;
  width: 300px;
  height: 360px;
  transform-style: preserve-3d;
  transform: rotateX(7deg) rotateY(-6deg) rotateZ(1deg);
  filter: drop-shadow(0 22px 40px rgba(0,0,0,0.22)) drop-shadow(0 6px 12px rgba(0,0,0,0.12));
  cursor: grab;
  transition: filter 0.4s;
}
.shirt-3d:active { cursor: grabbing; }
.shirt-3d:hover {
  filter: drop-shadow(0 28px 50px rgba(0,0,0,0.2)) drop-shadow(0 8px 16px rgba(42,95,138,0.15));
}

.shirt-face { position: absolute; inset: 0; }
.shirt-face svg { width: 100%; height: 100%; overflow: visible; }

.shirt-canvas {
  position: absolute;
  inset: 0;
  z-index: 20;
  overflow: hidden;
  border-radius: 2px;
}

.rotate-hint {
  margin-top: 0.9rem;
  font-size: 0.72rem;
  color: var(--muted);
  text-align: center;
}

/* ── TABS ── */
.tab-bar {
  display: flex;
  gap: 4px;
  background: var(--panel2);
  border: 1px solid var(--border);
  border-radius: 1rem;
  padding: 4px;
  width: 100%;
}

.tab-btn {
  flex: 1;
  padding: 0.5rem;
  font-family: 'Outfit', sans-serif;
  font-size: 0.83rem;
  font-weight: 500;
  color: var(--muted);
  background: transparent;
  border: none;
  border-radius: 0.75rem;
  cursor: pointer;
  transition: all 0.18s;
}

.tab-btn.active {
  background: var(--accent);
  color: white;
  box-shadow: 0 3px 10px rgba(26,58,82,0.3);
}

/* ── TOOL PANELS ── */
.tools-area {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.tool-panel {
  display: none;
  flex-direction: column;
  gap: 0.9rem;
}
.tool-panel.on { display: flex; }

.flabel {
  font-size: 0.72rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: var(--muted);
  margin-bottom: 3px;
}

.t-input {
  width: 100%;
  background: white;
  border: 1.5px solid var(--border);
  border-radius: 0.75rem;
  padding: 0.6rem 1rem;
  color: var(--text);
  font-size: 0.9rem;
  font-family: 'Outfit', sans-serif;
  outline: none;
  transition: border-color 0.2s;
}
.t-input:focus { border-color: var(--accent2); }

/* Font buttons */
.font-grid { display: flex; flex-wrap: wrap; gap: 5px; }
.fp {
  background: white;
  border: 1.5px solid var(--border);
  border-radius: 0.55rem;
  padding: 0.3rem 0.75rem;
  font-size: 0.82rem;
  color: var(--text);
  cursor: pointer;
  transition: all 0.14s;
}
.fp:hover { border-color: var(--accent2); }
.fp.on { border-color: var(--accent); background: #ddeaf7; color: var(--accent); }

/* Two-col row */
.two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

/* Text color swatches */
.tc-row { display: flex; flex-wrap: wrap; gap: 5px; }
.tc {
  width: 24px; height: 24px;
  border-radius: 50%;
  border: 2.5px solid transparent;
  cursor: pointer;
  transition: transform 0.12s, border-color 0.12s;
  position: relative;
  flex-shrink: 0;
}
.tc.on { border-color: var(--accent); transform: scale(1.22); }
.tc.custom { background: conic-gradient(red,yellow,lime,cyan,blue,magenta,red); overflow: hidden; }
.tc.custom input { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }

/* Slider */
.slider-wrap { display: flex; flex-direction: column; gap: 5px; }
.sz-slider {
  -webkit-appearance: none; appearance: none;
  width: 100%; height: 4px;
  background: var(--border); border-radius: 2px; outline: none;
}
.sz-slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  width: 14px; height: 14px;
  border-radius: 50%;
  background: var(--accent2);
  cursor: pointer;
  box-shadow: 0 0 6px rgba(42,95,138,0.4);
}
.sz-val { font-size: 0.75rem; color: var(--muted); text-align: right; }

/* Add text button */
.add-btn {
  background: var(--accent);
  color: white;
  border: none;
  border-radius: 0.75rem;
  padding: 0.65rem 1.4rem;
  font-size: 0.88rem;
  font-weight: 600;
  font-family: 'Outfit', sans-serif;
  cursor: pointer;
  box-shadow: 0 4px 14px rgba(26,58,82,0.25);
  transition: opacity 0.18s, transform 0.1s;
}
.add-btn:hover { opacity: 0.88; transform: translateY(-1px); }
.add-btn:active { transform: translateY(0); }

/* ── DROP ZONE (logo tab) ── */
.drop-zone {
  border: 2.5px dashed var(--border);
  border-radius: 1.4rem;
  padding: 1.5rem 1rem;
  background: white;
  cursor: pointer;
  text-align: center;
  transition: all 0.2s;
}
.drop-zone.dragover, .drop-zone:hover {
  background: #e8f1fb;
  border-color: var(--accent2);
}
.drop-zone .dz-icon { font-size: 1.8rem; line-height: 1; margin-bottom: 6px; }
.drop-zone .dz-main { font-size: 0.9rem; font-weight: 600; color: var(--text); }
.drop-zone .dz-sub { font-size: 0.73rem; color: var(--muted); margin-top: 3px; }

.thumbs-row { display: flex; flex-wrap: wrap; gap: 8px; }
.titem { position: relative; display: flex; flex-direction: column; align-items: center; gap: 4px; }
.titem img {
  width: 58px; height: 58px;
  object-fit: cover;
  border-radius: 12px;
  border: 2px solid white;
  box-shadow: 0 3px 8px rgba(0,0,0,0.1);
}
.titem .tdel {
  position: absolute; top: -7px; right: -7px;
  width: 18px; height: 18px;
  background: #d93535; color: white;
  font-size: 0.6rem; border: 2px solid white;
  border-radius: 50%; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
}
.titem .tplace {
  font-size: 0.65rem; font-weight: 600;
  background: #ddeaf7; color: var(--accent2);
  border: none; border-radius: 7px;
  padding: 2px 7px; cursor: pointer;
}
.titem .tplace:hover { background: var(--accent2); color: white; }

/* ── STICKERS ── */
.sticker {
  position: absolute;
  cursor: grab;
  user-select: none;
  touch-action: none;
  outline: 2px dashed transparent;
  outline-offset: 2px;
  border-radius: 4px;
  transition: outline-color 0.15s;
  z-index: 10;
}
.sticker:hover { outline-color: rgba(42,95,138,0.6); }
.sticker.dragging { cursor: grabbing; outline-color: var(--accent2); z-index: 100; }
.sticker.sel { outline-color: #e8a020; }

.sticker .srm {
  position: absolute; top: -10px; right: -10px;
  width: 20px; height: 20px;
  background: #d93535; color: white;
  font-size: 0.62rem; border: 2px solid white;
  border-radius: 50%; cursor: pointer;
  display: none; align-items: center; justify-content: center; z-index: 20;
}
.sticker:hover .srm, .sticker.sel .srm { display: flex; }

.sticker .srz {
  position: absolute; bottom: -7px; right: -7px;
  width: 13px; height: 13px;
  background: var(--accent2); border: 2px solid white;
  border-radius: 3px; cursor: se-resize; display: none; z-index: 20;
}
.sticker:hover .srz, .sticker.sel .srz { display: block; }

.simg { width: 100%; height: 100%; object-fit: contain; pointer-events: none; display: block; border-radius: 4px; }
.stxt {
  width: 100%; height: 100%;
  display: flex; align-items: center; justify-content: center;
  pointer-events: none; white-space: nowrap; padding: 2px 4px; line-height: 1.1;
}

/* ── RIGHT ── */
.right-col {
  background: var(--panel);
  border-radius: 2rem;
  padding: 2rem 1.8rem;
  display: flex;
  flex-direction: column;
  gap: 1.6rem;
  box-shadow: 0 8px 20px -14px rgba(20,40,60,0.15);
}

.opt-label {
  font-size: 0.78rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: var(--accent);
  margin-bottom: 0.6rem;
}

.btn-row { display: flex; flex-wrap: wrap; gap: 7px; }

.pill {
  background: white;
  border: 1.5px solid var(--border);
  border-radius: 50px;
  padding: 0.4rem 1rem;
  font-size: 0.82rem;
  font-weight: 500;
  color: var(--text);
  cursor: pointer;
  transition: all 0.15s;
  font-family: 'Outfit', sans-serif;
}
.pill:hover { border-color: var(--accent2); }
.pill.on { background: var(--accent); border-color: var(--accent); color: white; box-shadow: 0 3px 10px rgba(26,58,82,0.25); }

.swatch-row { display: flex; flex-wrap: wrap; gap: 8px; }
.swatch {
  width: 28px; height: 28px;
  border-radius: 50%;
  border: 2.5px solid white;
  box-shadow: 0 0 0 1.5px var(--border);
  cursor: pointer;
  transition: transform 0.12s, box-shadow 0.12s;
}
.swatch.on { transform: scale(1.22); box-shadow: 0 0 0 2.5px var(--accent); }

hr.div { border: none; height: 1px; background: var(--border); }

.price-box {
  background: var(--accent);
  color: white;
  border-radius: 1.6rem;
  padding: 1.4rem 1.8rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.price-lbl { font-size: 0.85rem; opacity: 0.75; }
.price-num {
  font-family: 'Syne', sans-serif;
  font-size: 2.7rem;
  font-weight: 800;
  letter-spacing: -0.04em;
  line-height: 1;
}
.price-num sup { font-size: 1.1rem; vertical-align: super; font-weight: 400; opacity: 0.8; }
.price-note { font-size: 0.72rem; color: var(--muted); margin-top: 0.5rem; line-height: 1.6; }
</style>
</head>
<body>
<div class="app">
  <header>
    <h1>👕 <span>InkSite Advertising</span></h1>
    <span class="badge">3D rotate · add text & logos · prices in ₱</span>
  </header>

  <div class="layout">
    <!-- LEFT: preview + tools -->
    <div class="left-col">

      <!-- Shirt preview card -->
      <div class="shirt-card">
        <div class="scene" id="scene">
          <div class="shirt-3d" id="shirt3d">
            <div class="shirt-face">
              <svg id="shirtSVG" viewBox="0 0 300 360" xmlns="http://www.w3.org/2000/svg" overflow="visible"></svg>
            </div>
            <div class="shirt-canvas" id="shirtCanvas"></div>
          </div>
        </div>
        <p class="rotate-hint">🖱 drag to rotate · scroll to zoom · drag items to reposition</p>
      </div>

      <!-- Tabs + tool panels -->
      <div class="tools-area">
        <div class="tab-bar">
          <button class="tab-btn active" data-tab="text">✏️ Add text</button>
          <button class="tab-btn" data-tab="logo">🖼 Add logo / image</button>
        </div>

        <!-- TEXT PANEL -->
        <div class="tool-panel on" id="textPanel">
          <div>
            <div class="flabel">Your text</div>
            <input class="t-input" id="textInput" type="text" placeholder="e.g.  INKSITE" maxlength="40">
          </div>
          <div>
            <div class="flabel">Font family</div>
            <div class="font-grid" id="fontGrid"></div>
          </div>
          <div class="two-col">
            <div>
              <div class="flabel">Text colour</div>
              <div class="tc-row" id="tcRow"></div>
            </div>
            <div class="slider-wrap">
              <div class="flabel">Font size &nbsp;<span class="sz-val" id="szVal">28px</span></div>
              <input class="sz-slider" id="szSlider" type="range" min="10" max="68" value="28">
            </div>
          </div>
          <button class="add-btn" id="addTextBtn">＋ Place text on shirt</button>
        </div>

        <!-- LOGO PANEL -->
        <div class="tool-panel" id="logoPanel">
          <div class="drop-zone" id="dropZone">
            <div class="dz-icon">⬆️</div>
            <div class="dz-main">Drop image / logo here or click to upload</div>
            <div class="dz-sub">PNG, JPG, SVG — drag to reposition on shirt</div>
          </div>
          <div class="thumbs-row" id="thumbsRow"></div>
          <input type="file" id="fileInput" multiple accept="image/*" style="display:none">
        </div>
      </div>

    </div><!-- /left-col -->

    <!-- RIGHT: options + price in PHP -->
    <div class="right-col">

      <div>
        <div class="opt-label">👕 Shirt style</div>
        <div class="btn-row" id="styleG">
          <button class="pill" data-style="crew">Crew neck</button>
          <button class="pill" data-style="vneck">V-neck</button>
          <button class="pill" data-style="turtle">Turtleneck</button>
          <button class="pill" data-style="polo">Polo</button>
          <button class="pill" data-style="long">Long sleeve</button>
          <button class="pill" data-style="dryfit">Dry-fit</button>
          <button class="pill" data-style="jersey">Jersey</button>
        </div>
      </div>

      <div>
        <div class="opt-label">🎨 Shirt colour</div>
        <div class="swatch-row" id="colorG">
          <span class="swatch" data-c="#d8c9b8" style="background:#d8c9b8" title="Natural"></span>
          <span class="swatch" data-c="#9eb8cc" style="background:#9eb8cc" title="Sky blue"></span>
          <span class="swatch" data-c="#2b3e4e" style="background:#2b3e4e" title="Charcoal"></span>
          <span class="swatch" data-c="#cc5252" style="background:#cc5252" title="Brick red"></span>
          <span class="swatch" data-c="#3a6645" style="background:#3a6645" title="Forest"></span>
          <span class="swatch" data-c="#eed99a" style="background:#eed99a" title="Sand"></span>
          <span class="swatch" data-c="#8b7eb8" style="background:#8b7eb8" title="Lavender"></span>
          <span class="swatch" data-c="#111111" style="background:#111111" title="Black"></span>
          <span class="swatch" data-c="#f5f5ef" style="background:#f5f5ef;outline:1px solid #ccc" title="White"></span>
          <span class="swatch" data-c="#c47a3a" style="background:#c47a3a" title="Rust"></span>
          <span class="swatch" data-c="#4a7fc0" style="background:#4a7fc0" title="Royal blue"></span>
          <span class="swatch" data-c="#b44a9a" style="background:#b44a9a" title="Fuchsia"></span>
        </div>
      </div>

      <div>
        <div class="opt-label">🖨️ Print method</div>
        <div class="btn-row" id="printG">
          <button class="pill" data-print="screen">Screen print</button>
          <button class="pill" data-print="dtg">DTG</button>
          <button class="pill" data-print="embroid">Embroidery</button>
          <button class="pill" data-print="vinyl">Vinyl</button>
          <button class="pill" data-print="none">None</button>
        </div>
      </div>

      <div>
        <div class="opt-label">📏 Size</div>
        <div class="btn-row" id="sizeG">
          <button class="pill" data-sz="XS">XS</button>
          <button class="pill" data-sz="S">S</button>
          <button class="pill" data-sz="M">M</button>
          <button class="pill" data-sz="L">L</button>
          <button class="pill" data-sz="XL">XL</button>
          <button class="pill" data-sz="XXL">XXL</button>
        </div>
      </div>

      <div>
        <div class="opt-label">🔢 Quantity</div>
        <div class="btn-row" id="qtyG">
          <button class="pill" data-qty="1">1</button>
          <button class="pill" data-qty="5">5</button>
          <button class="pill" data-qty="10">10</button>
          <button class="pill" data-qty="25">25</button>
          <button class="pill" data-qty="50">50+</button>
        </div>
      </div>

      <hr class="div">

      <div class="price-box">
        <div><div class="price-lbl">Total (PHP)</div></div>
        <div class="price-num"><sup>₱</sup><span id="pval">1250</span></div>
      </div>
      <div class="price-note" id="pnote">base ₱990 · logos ₱0 · qty ×1</div>
    </div>

  </div>
</div>

<script>
(function(){
"use strict";

/* ── STATE ── */
const S = {
  style: 'crew', color: '#d8c9b8',
  print: 'screen', sz: 'M', qty: 1,
  tcolor: '#111111', font: 'Bebas Neue', fsz: 28,
  images: []
};
let stickers = [], uid = 1;

/* ── FONTS (all labels in English) ── */
const FONTS = [
  { n:'Bebas Neue',         l:'BEBAS'    },
  { n:'Russo One',          l:'Russo'    },
  { n:'Oswald',             l:'Oswald'   },
  { n:'Righteous',          l:'Righteous'},
  { n:'Permanent Marker',   l:'Marker'   },
  { n:'Pacifico',           l:'Pacifico' },
  { n:'Lobster',            l:'Lobster'  },
  { n:'Dancing Script',     l:'Dancing'  },
  { n:'Playfair Display',   l:'Playfair' },
  { n:'Press Start 2P',     l:'8-BIT'    },
  { n:'Rock Salt',          l:'Rock Salt'},
  { n:'UnifrakturMaguntia', l:'Gothic'   },
];

/* ── TEXT COLORS ── */
const TCOLORS = [
  '#111111','#ffffff','#cc3333','#2266cc',
  '#227733','#cc8800','#884499','#dd6622',
  '#00aacc','#556677',
];

/* ── DOM ── */
const shirtSVG    = document.getElementById('shirtSVG');
const shirtCanvas = document.getElementById('shirtCanvas');
const shirt3d     = document.getElementById('shirt3d');

/* ── BUILD FONT GRID ── */
const fontGrid = document.getElementById('fontGrid');
FONTS.forEach(f => {
  const b = document.createElement('button');
  b.className = 'fp' + (f.n === S.font ? ' on' : '');
  b.textContent = f.l;
  b.style.fontFamily = `'${f.n}', sans-serif`;
  b.dataset.f = f.n;
  b.addEventListener('click', () => {
    S.font = f.n;
    fontGrid.querySelectorAll('.fp').forEach(x => x.classList.toggle('on', x.dataset.f === S.font));
  });
  fontGrid.appendChild(b);
});

/* ── BUILD TEXT COLOR SWATCHES ── */
const tcRow = document.getElementById('tcRow');
TCOLORS.forEach(c => {
  const el = document.createElement('div');
  el.className = 'tc' + (c === S.tcolor ? ' on' : '');
  el.style.background = c;
  if (c === '#ffffff') el.style.border = '2.5px solid #ccc';
  el.dataset.tc = c;
  el.addEventListener('click', () => {
    S.tcolor = c;
    tcRow.querySelectorAll('.tc:not(.custom)').forEach(x => x.classList.toggle('on', x.dataset.tc === S.tcolor));
    tcRow.querySelector('.custom')?.classList.remove('on');
  });
  tcRow.appendChild(el);
});
// Custom color picker
const cw = document.createElement('div');
cw.className = 'tc custom'; cw.title = 'Custom colour';
const ci = document.createElement('input');
ci.type = 'color'; ci.value = '#ff0000';
ci.addEventListener('input', e => {
  S.tcolor = e.target.value;
  tcRow.querySelectorAll('.tc:not(.custom)').forEach(x => x.classList.remove('on'));
  cw.classList.add('on');
  cw.style.background = e.target.value;
});
cw.appendChild(ci);
tcRow.appendChild(cw);

/* ── FONT SIZE SLIDER ── */
const szSlider = document.getElementById('szSlider');
const szVal    = document.getElementById('szVal');
szSlider.addEventListener('input', () => {
  S.fsz = +szSlider.value;
  szVal.textContent = S.fsz + 'px';
});

/* ── TABS ── */
document.querySelectorAll('.tab-btn').forEach(b => b.addEventListener('click', () => {
  document.querySelectorAll('.tab-btn').forEach(x => x.classList.remove('active'));
  b.classList.add('active');
  const t = b.dataset.tab;
  document.getElementById('textPanel').classList.toggle('on', t === 'text');
  document.getElementById('logoPanel').classList.toggle('on', t === 'logo');
}));

/* ── SHIRT SVG BUILDER (unchanged, realistic shading) ── */
function adj(hex, d) {
  let r = parseInt(hex.slice(1,3),16)||0;
  let g = parseInt(hex.slice(3,5),16)||0;
  let b = parseInt(hex.slice(5,7),16)||0;
  const a = Math.round(255 * d);
  return `rgb(${Math.min(255,Math.max(0,r+a))},${Math.min(255,Math.max(0,g+a))},${Math.min(255,Math.max(0,b+a))})`;
}

function buildSVG(style, color) {
  const dk  = adj(color, -0.2);
  const dkk = adj(color, -0.38);
  const lt  = adj(color,  0.18);

  const body  = `M 74,60 L 72,328 Q 72,340 84,340 L 216,340 Q 228,340 228,328 L 226,60 Z`;
  const slS_L = `M 74,60 L 50,52 L 14,93 Q 8,101 13,109 L 18,116 Q 24,123 33,120 L 65,104 L 74,84 Z`;
  const slS_R = `M 226,60 L 250,52 L 286,93 Q 292,101 287,109 L 282,116 Q 276,123 267,120 L 235,104 L 226,84 Z`;
  const slL_L = `M 74,60 L 50,52 L 10,196 Q 6,210 13,216 L 24,220 Q 35,223 39,213 L 71,104 L 74,84 Z`;
  const slL_R = `M 226,60 L 250,52 L 290,196 Q 294,210 287,216 L 276,220 Q 265,223 261,213 L 229,104 L 226,84 Z`;

  const useL = style === 'long';
  const SL = useL ? slL_L : slS_L;
  const SR = useL ? slL_R : slS_R;

  const necks = {
    crew:   `<ellipse cx="150" cy="50" rx="36" ry="13" fill="${dk}"/>
             <ellipse cx="150" cy="49" rx="32" ry="10" fill="${dkk}"/>`,
    vneck:  `<path d="M 120,58 L 150,92 L 180,58 Q 167,46 150,45 Q 133,46 120,58 Z" fill="${dk}"/>
             <line x1="120" y1="58" x2="150" y2="92" stroke="${dkk}" stroke-width="1.8"/>
             <line x1="180" y1="58" x2="150" y2="92" stroke="${dkk}" stroke-width="1.8"/>`,
    turtle: `<path d="M 116,35 L 116,62 Q 126,74 150,74 Q 174,74 184,62 L 184,35 Q 170,23 150,22 Q 130,23 116,35 Z" fill="${dk}"/>
             <ellipse cx="150" cy="35" rx="34" ry="13" fill="${adj(color,-0.3)}"/>`,
    polo:   `<path d="M 110,46 L 110,74 Q 122,88 150,88 Q 178,88 190,74 L 190,46 Q 174,36 150,35 Q 126,36 110,46 Z" fill="${dk}"/>
             <rect x="141" y="46" width="18" height="40" rx="5" fill="${dkk}" opacity="0.42"/>
             <circle cx="150" cy="66" r="3.5" fill="${dkk}" opacity="0.55"/>
             <circle cx="150" cy="78" r="3.5" fill="${dkk}" opacity="0.55"/>`,
    default:`<ellipse cx="150" cy="50" rx="36" ry="13" fill="${dk}"/>
             <ellipse cx="150" cy="49" rx="32" ry="10" fill="${dkk}"/>`
  };

  let extra = '';
  if (style === 'dryfit') {
    extra = `<rect x="72" y="60" width="13" height="280" rx="6" fill="${adj(color,-0.18)}"/>
             <rect x="215" y="60" width="13" height="280" rx="6" fill="${adj(color,-0.18)}"/>
             <rect x="75" y="60" width="5" height="280" rx="3" fill="${lt}" opacity="0.3"/>
             <rect x="218" y="60" width="5" height="280" rx="3" fill="${lt}" opacity="0.3"/>`;
  }
  if (style === 'jersey') {
    extra = `<defs><pattern id="jm" x="0" y="0" width="14" height="14" patternUnits="userSpaceOnUse">
               <circle cx="7" cy="7" r="1.8" fill="rgba(0,0,0,0.12)"/>
             </pattern></defs>
             <path d="${body}" fill="url(#jm)" pointer-events="none"/>
             <text x="150" y="230" text-anchor="middle" font-family="'Russo One',sans-serif"
               font-size="72" font-weight="900" fill="${dkk}" opacity="0.14">7</text>`;
  }
  if (style === 'long') {
    extra = `<ellipse cx="22" cy="212" rx="14" ry="8" fill="${dk}" transform="rotate(-12 22 212)"/>
             <ellipse cx="278" cy="212" rx="14" ry="8" fill="${dk}" transform="rotate(12 278 212)"/>`;
  }

  return `
    <defs>
      <linearGradient id="bh" x1="0%" y1="0%" x2="100%" y2="0%">
        <stop offset="0%"   stop-color="rgba(0,0,0,0.16)"/>
        <stop offset="28%"  stop-color="rgba(255,255,255,0.09)"/>
        <stop offset="72%"  stop-color="rgba(255,255,255,0.07)"/>
        <stop offset="100%" stop-color="rgba(0,0,0,0.18)"/>
      </linearGradient>
      <linearGradient id="bv" x1="0%" y1="0%" x2="0%" y2="100%">
        <stop offset="0%"   stop-color="rgba(255,255,255,0.14)"/>
        <stop offset="100%" stop-color="rgba(0,0,0,0.2)"/>
      </linearGradient>
      <linearGradient id="sll" x1="100%" y1="0%" x2="0%" y2="100%">
        <stop offset="0%"   stop-color="rgba(255,255,255,0.08)"/>
        <stop offset="100%" stop-color="rgba(0,0,0,0.24)"/>
      </linearGradient>
      <linearGradient id="slr" x1="0%" y1="0%" x2="100%" y2="100%">
        <stop offset="0%"   stop-color="rgba(255,255,255,0.08)"/>
        <stop offset="100%" stop-color="rgba(0,0,0,0.24)"/>
      </linearGradient>
    </defs>
    <path d="${SL}" fill="${color}"/><path d="${SL}" fill="url(#sll)"/>
    <path d="${SR}" fill="${color}"/><path d="${SR}" fill="url(#slr)"/>
    <path d="${body}" fill="${color}"/>
    <path d="${body}" fill="url(#bh)"/>
    <path d="${body}" fill="url(#bv)"/>
    ${extra}
    <line x1="74"  y1="60"  x2="50"  y2="52"  stroke="${dkk}" stroke-width="0.8" opacity="0.4"/>
    <line x1="226" y1="60"  x2="250" y2="52"  stroke="${dkk}" stroke-width="0.8" opacity="0.4"/>
    <line x1="150" y1="64"  x2="150" y2="338" stroke="${adj(color,-0.1)}" stroke-width="0.7" opacity="0.25"/>
    <path d="M 76,335 L 224,335" stroke="${dkk}" stroke-width="1.1" stroke-dasharray="5,4" opacity="0.45"/>
    ${necks[style] || necks.default}
  `;
}

function renderShirt() { shirtSVG.innerHTML = buildSVG(S.style, S.color); }

/* ── 3D ROTATION (unchanged) ── */
let rotX = 7, rotY = -6, rotZ = 1, zoom = 1;
let draggingShirt = false, lmx = 0, lmy = 0;

shirt3d.addEventListener('mousedown', e => {
  if (e.target.closest('.sticker')) return;
  draggingShirt = true; lmx = e.clientX; lmy = e.clientY;
  e.preventDefault();
});
document.addEventListener('mousemove', e => {
  if (!draggingShirt) return;
  rotY += (e.clientX - lmx) * 0.38;
  rotX -= (e.clientY - lmy) * 0.28;
  rotX = Math.max(-32, Math.min(32, rotX));
  rotY = Math.max(-42, Math.min(42, rotY));
  applyT(); lmx = e.clientX; lmy = e.clientY;
});
document.addEventListener('mouseup', () => { draggingShirt = false; });

document.getElementById('scene').addEventListener('wheel', e => {
  e.preventDefault();
  zoom -= e.deltaY * 0.001;
  zoom = Math.max(0.55, Math.min(1.45, zoom));
  applyT();
}, { passive: false });

function applyT() {
  shirt3d.style.transform = `rotateX(${rotX}deg) rotateY(${rotY}deg) rotateZ(${rotZ}deg) scale(${zoom})`;
}

/* ── STICKER SYSTEM (unchanged) ── */
function mkSticker({ type, src, text, font, fsz, tcolor, x, y, w, h }) {
  const el = document.createElement('div');
  el.className = 'sticker';
  el.style.cssText = `left:${x}px;top:${y}px;width:${w}px;height:${h}px;`;

  if (type === 'image') {
    const img = document.createElement('img');
    img.className = 'simg'; img.src = src;
    el.appendChild(img);
  } else {
    const span = document.createElement('div');
    span.className = 'stxt';
    span.textContent = text;
    span.style.cssText = `font-family:'${font}',sans-serif;font-size:${fsz}px;color:${tcolor};`;
    el.appendChild(span);
  }

  const rm = document.createElement('button');
  rm.className = 'srm'; rm.textContent = '✕';
  rm.onclick = e => { e.stopPropagation(); el.remove(); stickers = stickers.filter(s => s.el !== el); };
  el.appendChild(rm);

  const rz = document.createElement('div');
  rz.className = 'srz'; el.appendChild(rz);

  shirtCanvas.appendChild(el);
  const st = { el, x, y, w, h };
  stickers.push(st);
  makeDrag(el, st);
  makeResize(rz, el, st);
  el.addEventListener('mousedown', () => {
    stickers.forEach(s => s.el.classList.remove('sel'));
    el.classList.add('sel');
  });
  return st;
}

function makeDrag(el, st) {
  let ox, oy, oex, oey;
  function dn(e) {
    if (e.target.classList.contains('srm') || e.target.classList.contains('srz')) return;
    e.preventDefault(); e.stopPropagation();
    draggingShirt = false;
    el.classList.add('dragging');
    const p = e.touches ? e.touches[0] : e;
    ox = p.clientX; oy = p.clientY; oex = st.x; oey = st.y;
    document.addEventListener('mousemove', mv);
    document.addEventListener('mouseup', up);
    document.addEventListener('touchmove', mv, { passive: false });
    document.addEventListener('touchend', up);
  }
  function mv(e) {
    e.preventDefault();
    const p = e.touches ? e.touches[0] : e;
    const cw = shirtCanvas.offsetWidth, ch = shirtCanvas.offsetHeight;
    st.x = Math.max(0, Math.min(cw - st.w, oex + (p.clientX - ox)));
    st.y = Math.max(0, Math.min(ch - st.h, oey + (p.clientY - oy)));
    el.style.left = st.x + 'px'; el.style.top = st.y + 'px';
  }
  function up() {
    el.classList.remove('dragging');
    document.removeEventListener('mousemove', mv); document.removeEventListener('mouseup', up);
    document.removeEventListener('touchmove', mv); document.removeEventListener('touchend', up);
  }
  el.addEventListener('mousedown', dn);
  el.addEventListener('touchstart', dn, { passive: false });
}

function makeResize(handle, el, st) {
  let ox, oy, ow, oh;
  function dn(e) {
    e.preventDefault(); e.stopPropagation();
    const p = e.touches ? e.touches[0] : e;
    ox = p.clientX; oy = p.clientY; ow = st.w; oh = st.h;
    document.addEventListener('mousemove', mv); document.addEventListener('mouseup', up);
  }
  function mv(e) {
    const p = e.touches ? e.touches[0] : e;
    st.w = Math.max(40, ow + (p.clientX - ox));
    st.h = Math.max(22, oh + (p.clientY - oy));
    el.style.width = st.w + 'px'; el.style.height = st.h + 'px';
  }
  function up() { document.removeEventListener('mousemove', mv); document.removeEventListener('mouseup', up); }
  handle.addEventListener('mousedown', dn);
}

function centerPos(w, h) {
  const cw = shirtCanvas.offsetWidth || 300, ch = shirtCanvas.offsetHeight || 360;
  return { x: Math.max(0, (cw - w) / 2 + (Math.random() - 0.5) * 20),
           y: Math.max(0, ch * 0.26 + (Math.random() - 0.5) * 14) };
}

/* ── ADD TEXT ── */
const textInput  = document.getElementById('textInput');
const addTextBtn = document.getElementById('addTextBtn');

addTextBtn.addEventListener('click', () => {
  const txt = textInput.value.trim();
  if (!txt) {
    textInput.focus();
    textInput.style.borderColor = '#cc3333';
    setTimeout(() => textInput.style.borderColor = '', 600);
    return;
  }
  const W = Math.max(70, txt.length * S.fsz * 0.58);
  const H = S.fsz * 1.7;
  const { x, y } = centerPos(W, H);
  mkSticker({ type: 'text', text: txt, font: S.font, fsz: S.fsz, tcolor: S.tcolor, x, y, w: W, h: H });
});
textInput.addEventListener('keydown', e => { if (e.key === 'Enter') addTextBtn.click(); });

/* ── FILE UPLOAD ── */
function addImages(files) {
  for (const f of files) {
    if (!f.type.startsWith('image/')) continue;
    const rd = new FileReader();
    rd.onload = e => {
      const id = uid++;
      S.images.push({ id, src: e.target.result, name: f.name });
      renderThumbs(); updatePrice();
      placeImg(id, e.target.result);
    };
    rd.readAsDataURL(f);
  }
}

function placeImg(imgId, src, force = false) {
  if (!force && stickers.some(s => s.imgId === imgId)) return;
  const W = 90, H = 90;
  const { x, y } = centerPos(W, H);
  const st = mkSticker({ type: 'image', src, x, y, w: W, h: H });
  st.imgId = imgId;
}

function renderThumbs() {
  const row = document.getElementById('thumbsRow');
  row.innerHTML = '';
  S.images.forEach(img => {
    const wrap = document.createElement('div');
    wrap.className = 'titem';
    const ie = document.createElement('img'); ie.src = img.src;
    wrap.appendChild(ie);
    const del = document.createElement('button');
    del.className = 'tdel'; del.textContent = '✕';
    del.onclick = () => {
      S.images = S.images.filter(i => i.id !== img.id);
      stickers.filter(s => s.imgId === img.id).forEach(s => s.el.remove());
      stickers = stickers.filter(s => s.imgId !== img.id);
      renderThumbs(); updatePrice();
    };
    wrap.appendChild(del);
    const pb = document.createElement('button');
    pb.className = 'tplace'; pb.textContent = '+ shirt';
    pb.onclick = () => placeImg(img.id, img.src, true);
    wrap.appendChild(pb);
    row.appendChild(wrap);
  });
}

const dz = document.getElementById('dropZone');
const fi = document.getElementById('fileInput');
dz.addEventListener('dragover', e => { e.preventDefault(); dz.classList.add('dragover'); });
dz.addEventListener('dragleave', () => dz.classList.remove('dragover'));
dz.addEventListener('drop', e => { e.preventDefault(); dz.classList.remove('dragover'); addImages(e.dataTransfer.files); });
dz.addEventListener('click', () => fi.click());
fi.addEventListener('change', e => { addImages(e.target.files); fi.value = ''; });

/* ── CONTROLS ── */
function setOn(gid, attr, val) {
  document.querySelectorAll(`#${gid} [${attr}]`).forEach(el =>
    el.classList.toggle('on', el.getAttribute(attr) === val)
  );
}

document.querySelectorAll('#styleG [data-style]').forEach(b => b.addEventListener('click', () => {
  S.style = b.dataset.style; setOn('styleG', 'data-style', S.style); renderShirt();
}));
document.querySelectorAll('#colorG [data-c]').forEach(b => b.addEventListener('click', () => {
  S.color = b.dataset.c; setOn('colorG', 'data-c', S.color); renderShirt();
}));
document.querySelectorAll('#printG [data-print]').forEach(b => b.addEventListener('click', () => {
  S.print = b.dataset.print; setOn('printG', 'data-print', S.print); updatePrice();
}));
document.querySelectorAll('#sizeG [data-sz]').forEach(b => b.addEventListener('click', () => {
  S.sz = b.dataset.sz; setOn('sizeG', 'data-sz', S.sz); updatePrice();
}));
document.querySelectorAll('#qtyG [data-qty]').forEach(b => b.addEventListener('click', () => {
  S.qty = +b.dataset.qty; setOn('qtyG', 'data-qty', b.dataset.qty); updatePrice();
}));

/* ── PRICE in PHILIPPINE PESOS (approx 1 EUR = 60 PHP) ── */
function updatePrice() {
  let base = 22;        // base in EUR
  if (['polo','turtle'].includes(S.style)) base += 5;
  else if (['long','dryfit','jersey'].includes(S.style)) base += 8;
  if (S.print === 'embroid') base += 12;
  else if (S.print === 'dtg') base += 5;
  else if (S.print === 'vinyl') base += 4;
  else if (S.print === 'screen') base += 3;
  if (S.sz === 'XL') base += 3;
  else if (S.sz === 'XXL') base += 5;
  const imgFee = S.images.length * 2.5;
  
  const totalEur = (base + imgFee) * S.qty;
  const totalPhp = totalEur * 60;
  
  document.getElementById('pval').textContent = Math.round(totalPhp);
  document.getElementById('pnote').textContent = `base ₱${Math.round(base*60)} · logos ₱${Math.round(imgFee*60)} · qty ×${S.qty}`;
}

/* ── INIT ── */
setOn('styleG', 'data-style', 'crew');
setOn('colorG', 'data-c', '#d8c9b8');
setOn('printG', 'data-print', 'screen');
setOn('sizeG', 'data-sz', 'M');
setOn('qtyG', 'data-qty', '1');
renderShirt();
updatePrice();

})();
</script>
</body>
</html>