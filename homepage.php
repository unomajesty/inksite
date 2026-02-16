<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Product Page | Specs & Templates</title>
    <style>
        /* --- 1. GENERAL STYLES & RESET --- */
        :root {
            --primary-blue: #00aeef;
            --btn-blue: #7dd3f7;
            --light-bg: #f8f9fa;
            --border-color: #ddd;
            --sale-green: #008160;
            --text-main: #333;
            --text-muted: #666;
            --bleed-color: #f5b7b1; 
            --trim-color: #aed6f1;
        }

        * { box-sizing: border-box; }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 40px;
            color: var(--text-main);
            background-color: #fff;
        }

        /* --- 2. PRODUCT PAGE LAYOUT --- */
        .product-container {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            gap: 50px;
        }

        .image-section { flex: 1.2; }
        .main-image-placeholder {
            width: 100%;
            aspect-ratio: 4/3;
            background: #eee;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            overflow: hidden; /* Clips the image to the border radius */
        }
        
        /* Added style for the image within the placeholder */
        #mainImg {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .thumbnail-row { display: flex; gap: 10px; margin-top: 15px; }
        .thumb { 
            width: 70px; 
            height: 70px; 
            border: 1px solid var(--border-color); 
            border-radius: 4px; 
            cursor: pointer; 
            object-fit: cover; /* Ensures thumbnails don't stretch */
        }
        .thumb.active { border: 2.5px solid #000; }

        .details-section { flex: 1; }
        .delivery-info { font-size: 13px; margin-bottom: 25px; line-height: 1.6; }
        .free-ship { color: var(--sale-green); font-weight: 500; }

        label { display: block; font-weight: bold; font-size: 14px; margin-bottom: 8px; }
        select {
            width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;
            margin-bottom: 25px; font-size: 14px; appearance: none;
            background: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") no-repeat right 10px center;
        }

        .qty-table { border: 1px solid var(--border-color); border-radius: 4px; overflow: hidden; margin-bottom: 10px; background: #fff; }
        .qty-row {
            display: flex; align-items: center; padding: 12px 15px; border-bottom: 1px solid var(--border-color);
            cursor: pointer; font-size: 14px; transition: all 0.2s;
            user-select: none;
        }
        .qty-row:last-child { border-bottom: none; }
        .qty-row:hover { background: #fcfcfc; }
        
        .qty-row.selected { 
            background: #eaf8fe; 
            border: 1.5px solid var(--primary-blue); 
            position: relative; 
            z-index: 1; 
            margin: -1px;
        }

        .qty-row.hidden { display: none; }

        .qty-val { width: 30px; font-weight: bold; }
        .badge { background: #e1f5fe; color: #0277bd; font-size: 11px; padding: 2px 8px; border-radius: 12px; font-weight: bold; margin-left: 5px; }
        
        .price-col { margin-left: auto; text-align: right; display: flex; align-items: center; gap: 15px; }
        .old-p { text-decoration: line-through; color: #999; }
        .new-p { color: var(--sale-green); font-weight: bold; }
        .unit-p { color: #888; font-size: 12px; width: 85px; }
        .sale-tag { color: var(--sale-green); font-size: 12px; width: 100px; text-transform: lowercase; }

        .see-more { display: block; text-align: center; color: var(--text-muted); font-size: 13px; text-decoration: underline; margin: 15px 0; cursor: pointer; font-weight: 500; }

        .paypal-block {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 15px 0;
            margin-top: 5px;
            font-size: 13px;
            color: #333;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        .paypal-logo-img {
            height: 18px;
            vertical-align: middle;
        }

        .paypal-text {
            line-height: 1.4;
        }

        .paypal-learn {
            color: #0070ba;
            text-decoration: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .paypal-learn:hover {
            text-decoration: underline;
        }

        .btn {
            width: 100%; padding: 15px; border-radius: 4px; border: none; font-weight: bold; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 10px; font-size: 15px; margin-bottom: 12px;
            transition: opacity 0.2s;
        }
        .btn:disabled { opacity: 0.5; cursor: not-allowed; }
        .btn-primary { background-color: var(--btn-blue); color: #222; }
        .btn-secondary { background-color: #f5f5f5; border: 1px solid #ccc; color: #333; }
        
        .footer-links { margin-top: 20px; font-size: 14px; display: flex; flex-direction: column; gap: 10px; }
        .link-item { display: flex; align-items: center; gap: 8px; cursor: pointer; text-decoration: underline; }

        /* --- 3. MODAL STRUCTURE --- */
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4); z-index: 1000; }
        .modal-container { position: absolute; right: 0; top: 0; width: 90%; height: 100%; background: white; display: flex; animation: slideIn 0.3s ease-out; overflow: hidden; }
        @keyframes slideIn { from { transform: translateX(100%); } to { transform: translateX(0); } }

        .modal-left { flex: 1; background: #fff; padding: 40px; overflow-y: auto; display: flex; flex-direction: column; align-items: center; }
        .modal-sidebar { width: 350px; padding: 40px 30px; border-left: 1px solid #eee; position: relative; background: #fafafa; }
        .close-btn { position: absolute; top: 20px; right: 20px; background: #1b2631; color: white; border: none; padding: 5px 12px; border-radius: 4px; cursor: pointer; font-size: 11px; z-index: 10; }

        /* --- 4. DYNAMIC DIAGRAM --- */
        #initial-message { border: 1px solid #eee; padding: 20px 40px; border-radius: 12px; margin-top: 150px; color: #888; text-align: center; }
        #specs-content { display: none; width: 100%; max-width: 600px; flex-direction: column; align-items: center; }

        .diagram-wrapper { height: 400px; display: flex; align-items: center; justify-content: center; width: 100%; margin-bottom: 20px; }
        .diagram-container { position: relative; transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); background: #fff; box-shadow: 0 0 15px rgba(0,0,0,0.05); }
        .bleed-box { position: absolute; inset: 0; border: 1px solid var(--bleed-color); background: rgba(245, 183, 177, 0.05); }
        .trim-box { position: absolute; inset: 10px; border: 1px solid var(--trim-color); background: white; }
        .safe-box { position: absolute; inset: 20px; border: 1px dashed #bbb; display: flex; align-items: center; justify-content: center; color: #bbb; font-size: 14px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }

        .specs-table { width: 100%; border-collapse: collapse; margin-top: 30px; font-size: 13px; }
        .specs-table th { text-align: left; padding: 10px 0; border-bottom: 2px solid #eee; }
        .specs-table td { padding: 15px 0; border-bottom: 1px solid #eee; }
        .dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 10px; }
        .dashed-line { width: 15px; border-top: 2px dashed #999; display: inline-block; margin-right: 10px; vertical-align: middle; }
        .sub-text { display: block; color: #999; font-size: 11px; margin-top: 4px; }

        /* --- 5. SIDEBAR CONTROLS --- */
        .custom-select-wrapper { position: relative; width: 100%; margin-top: 10px; }
        .select-trigger { border: 1px solid #ccc; padding: 12px 15px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; background: white; }
        .options-menu { display: none; position: absolute; top: 52px; left: 0; right: 0; background: white; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); z-index: 100; overflow: hidden; }
        .option-item { padding: 12px 15px; cursor: pointer; }
        .option-item:hover { background: #f0faff; }
        .custom-select-wrapper.open .options-menu { display: block; }

        .sidebar-loader { display: none; padding: 15px 0; font-size: 12px; color: #00aeef; align-items: center; gap: 10px; font-weight: bold; }
        .spinner { width: 16px; height: 16px; border: 2px solid #f3f3f3; border-top: 2px solid #00aeef; border-radius: 50%; animation: spin 1s linear infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

        .dl-item { display: flex; align-items: center; gap: 10px; margin-bottom: 15px; font-size: 14px; opacity: 0.4; pointer-events: none; transition: opacity 0.3s; }
        .dl-item.enabled { opacity: 1; pointer-events: auto; }
        .dl-spinner { display: none; width: 12px; height: 12px; border: 2px solid #eee; border-top: 2px solid #666; border-radius: 50%; animation: spin 1s linear infinite; margin-right: 5px;}
        .dl-item.loading .dl-spinner { display: block; }
        .dl-icon { width: 24px; height: 20px; border-radius: 3px; color: white; font-weight: bold; font-size: 9px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    </style>
</head>
<body>

    <div class="product-container">
        <div class="image-section">
            <div class="main-image-placeholder">
                <!-- Added Main Image tag -->
                <img id="mainImg" src="images/onepiece.png" alt="Product Image">
            </div>
            <div class="thumbnail-row">
                <!-- Updated thumbnails with your image names and click events -->
                <img src="images/onepiece.png" class="thumb active" onclick="updateMainImage(this)">
                <img src="images/zoro.png" class="thumb" onclick="updateMainImage(this)">
                <img src="images/luffy.png" class="thumb" onclick="updateMainImage(this)">
                <img src="images/naruto.png" class="thumb" onclick="updateMainImage(this)">
            </div>
        </div>

        <div class="details-section">
            <div class="delivery-info">
                <div>🚚 <strong>Monday, Feb 23rd</strong> $9.99 Fastest delivery</div>
                <div>📅 <strong>Friday, Feb 27th</strong> $5.99 <span class="free-ship">Free on orders over $100.00</span></div>
            </div>

            <label>Size</label>
            <select id="mainSizeSelect">
                <option value="">Select...</option>
                <option value="5.5x8.5">5.5" x 8.5"</option>
                <option value="8.5x11">8.5" x 11"</option>
            </select>

            <label>Quantity</label>
            <div class="qty-table" id="quantityTable">
                <!-- Visible Rows -->
                <div class="qty-row" data-qty="1">
                    <span class="qty-val">1</span>
                    <span class="badge">Recommended</span>
                    <div class="price-col">
                        <span class="old-p">$24.99</span>
                        <span class="new-p">$22.49</span>
                        <span class="unit-p">$22.49 / unit</span>
                        <span class="sale-tag">sale</span>
                    </div>
                </div>
                <div class="qty-row selected" data-qty="2">
                    <span class="qty-val">2</span>
                    <div class="price-col">
                        <span class="old-p">$44.00</span>
                        <span class="new-p">$39.60</span>
                        <span class="unit-p">$19.80 / unit</span>
                        <span class="sale-tag">11% savings + sale</span>
                    </div>
                </div>
                <div class="qty-row" data-qty="3">
                    <span class="qty-val">3</span>
                    <div class="price-col">
                        <span class="old-p">$66.00</span>
                        <span class="new-p">$59.40</span>
                        <span class="unit-p">$19.80 / unit</span>
                        <span class="sale-tag">11% savings + sale</span>
                    </div>
                </div>
                <div class="qty-row" data-qty="4">
                    <span class="qty-val">4</span>
                    <div class="price-col">
                        <span class="old-p">$88.00</span>
                        <span class="new-p">$79.40</span>
                        <span class="unit-p">$19.80 / unit</span>
                        <span class="sale-tag">11% savings + sale</span>
                    </div>
                </div>
                <div class="qty-row" data-qty="5">
                    <span class="qty-val">5</span>
                    <div class="price-col">
                        <span class="old-p">$110.00</span>
                        <span class="new-p">$99.40</span>
                        <span class="unit-p">$19.80 / unit</span>
                        <span class="sale-tag">11% savings + sale</span>
                    </div>
                </div>

                <!-- Hidden Rows (Revealed by "See more") -->
                <div class="qty-row hidden" data-qty="6">
                    <span class="qty-val">6</span>
                    <div class="price-col">
                        <span class="old-p">$220.00</span>
                        <span class="new-p">$176.00</span>
                        <span class="unit-p">$17.60 / unit</span>
                        <span class="sale-tag">20% savings + sale</span>
                    </div>
                </div>
                <div class="qty-row hidden" data-qty="7">
                    <span class="qty-val">7</span>
                    <div class="price-col">
                        <span class="old-p">$550.00</span>
                        <span class="new-p">$412.50</span>
                        <span class="unit-p">$16.50 / unit</span>
                        <span class="sale-tag">25% savings + sale</span>
                    </div>
                </div>
                <div class="qty-row hidden" data-qty="8">
                    <span class="qty-val">8</span>
                    <div class="price-col">
                        <span class="old-p">$1,100.00</span>
                        <span class="new-p">$770.00</span>
                        <span class="unit-p">$15.40 / unit</span>
                        <span class="sale-tag">30% savings + sale</span>
                    </div>
                </div>
            </div>
            <div class="see-more" id="seeMoreBtn">See more quantities</div>

            <div class="paypal-block">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" class="paypal-logo-img">
                <span class="paypal-text">
                    Pay in 4 interest-free payments on purchases of $30-$1,500. 
                    <a href="#" class="paypal-learn">Learn more</a>
                </span>
            </div>

            <button class="btn btn-primary" id="btnTemplates">Browse our templates 🖼️</button>
            <button class="btn btn-secondary" id="btnUpload">Upload your design ☁️</button>

            <div class="footer-links">
                <div class="link-item" onclick="openModal()">
                    <span>📋</span> <strong>Specs & Templates</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- SPECS MODAL -->
    <div id="specsModal" class="modal-overlay">
        <div class="modal-container">
            <button class="close-btn" onclick="closeModal()">Close</button>
            <div class="modal-left">
                <div id="initial-message">ⓘ Please select a size from the sidebar to generate specifications.</div>
                <div id="specs-content">
                    <div class="diagram-wrapper">
                        <div id="dynamic-diagram" class="diagram-container">
                            <div class="bleed-box"></div>
                            <div class="trim-box"></div>
                            <div class="safe-box">Safe Area</div>
                        </div>
                    </div>
                    <h3>Design Specs</h3>
                    <table class="specs-table">
                        <thead>
                            <tr><th>Line Type</th><th>Width</th><th>Height</th></tr>
                        </thead>
                        <tbody id="specs-table-body"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-sidebar">
                <h2>Specs & Templates</h2>
                <label>Size*</label>
                <div class="custom-select-wrapper" id="sizeSelect">
                    <div class="select-trigger" onclick="toggleDropdown()">
                        <span id="selected-text">Select...</span>
                        <span>▼</span>
                    </div>
                    <div class="options-menu">
                        <div class="option-item" onclick="handleSizeSelection('5.5&quot; x 8.5&quot;')">5.5" x 8.5"</div>
                        <div class="option-item" onclick="handleSizeSelection('8.5&quot; x 11&quot;')">8.5" x 11"</div>
                    </div>
                </div>
                <div id="dropdown-loader" class="sidebar-loader">
                    <div class="spinner"></div> Generating template (2s)...
                </div>
                <div style="margin-top: 40px;">
                    <p style="font-size: 14px; font-weight: bold; margin-bottom: 15px;">Download Templates</p>
                    <div class="dl-list">
                        <div class="dl-item" id="dl-pdf" onclick="downloadTemplate('pdf')"><div class="dl-spinner"></div><div class="dl-icon" style="background:#ee3124">PDF</div><span style="text-decoration: underline; cursor: pointer;">PDF Template ↓</span></div>
                        <div class="dl-item" id="dl-svg" onclick="downloadTemplate('svg')"><div class="dl-spinner"></div><div class="dl-icon" style="background:#fbb03b">SVG</div><span style="text-decoration: underline; cursor: pointer;">SVG Template ↓</span></div>
                        <div class="dl-item" id="dl-ai" onclick="downloadTemplate('ai')"><div class="dl-spinner"></div><div class="dl-icon" style="background:#331401">Ai</div><span style="text-decoration: underline; cursor: pointer;">Illustrator Template ↓</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // --- 1. IMAGE GALLERY FUNCTIONALITY ---
        function updateMainImage(clickedThumbnail) {
            // Update the source of the main image
            document.getElementById('mainImg').src = clickedThumbnail.src;
            
            // Manage the "active" border class
            const allThumbs = document.querySelectorAll('.thumb');
            allThumbs.forEach(thumb => thumb.classList.remove('active'));
            clickedThumbnail.classList.add('active');
        }

        // --- 2. QUANTITY & SEE MORE FUNCTIONALITY ---
        const qtyTable = document.getElementById('quantityTable');
        const seeMoreBtn = document.getElementById('seeMoreBtn');
        const templateBtn = document.getElementById('btnTemplates');
        const uploadBtn = document.getElementById('btnUpload');

        seeMoreBtn.addEventListener('click', () => {
            const hiddenRows = qtyTable.querySelectorAll('.qty-row.hidden');
            const isExpanding = seeMoreBtn.innerText.includes('more');

            if (isExpanding) {
                hiddenRows.forEach(row => {
                    row.classList.remove('hidden');
                    row.classList.add('was-hidden');
                });
                seeMoreBtn.innerText = 'See fewer quantities';
            } else {
                const rowsToHide = qtyTable.querySelectorAll('.was-hidden');
                rowsToHide.forEach(row => {
                    row.classList.add('hidden');
                    row.classList.remove('was-hidden');
                    row.classList.remove('selected');
                });
                seeMoreBtn.innerText = 'See more quantities';
                
                if (!qtyTable.querySelector('.qty-row.selected:not(.hidden)')) {
                    templateBtn.disabled = true;
                    uploadBtn.disabled = true;
                }
            }
        });

        qtyTable.addEventListener('click', (event) => {
            const row = event.target.closest('.qty-row');
            if (!row) return;
            event.stopPropagation();
            const allRows = qtyTable.querySelectorAll('.qty-row');
            allRows.forEach(r => r.classList.remove('selected'));
            row.classList.add('selected');
            templateBtn.disabled = false;
            uploadBtn.disabled = false;
        });

        window.addEventListener('click', (event) => {
            if (!qtyTable.contains(event.target) && event.target !== seeMoreBtn) {
                const allRows = qtyTable.querySelectorAll('.qty-row');
                allRows.forEach(r => r.classList.remove('selected'));
                templateBtn.disabled = true;
                uploadBtn.disabled = true;
            }
        });

        // --- 3. EXISTING MODAL & DOWNLOAD LOGIC ---
        const sizeConfigs = {
            "5.5\" x 8.5\"": {
                widthPx: 180, heightPx: 278,
                bleed: { in: "5.75\"", mm: "146.05 mm", val: 5.75 }, trim: { in: "5.5\"", mm: "139.70 mm", val: 5.5 }, safe: { in: "5.25\"", mm: "133.35 mm", val: 5.25 },
                hBleed: { in: "8.75\"", mm: "222.25 mm", val: 8.75 }, hTrim: { in: "8.5\"", mm: "215.90 mm", val: 8.5 }, hSafe: { in: "8.25\"", mm: "209.55 mm", val: 8.25 }
            },
            "8.5\" x 11\"": {
                widthPx: 280, heightPx: 362,
                bleed: { in: "8.75\"", mm: "222.25 mm", val: 8.75 }, trim: { in: "8.5\"", mm: "139.70 mm", val: 8.5 }, safe: { in: "8.25\"", mm: "133.35 mm", val: 8.25 },
                hBleed: { in: "11.25\"", mm: "285.75 mm", val: 11.25 }, hTrim: { in: "11\"", mm: "279.40 mm", val: 11 }, hSafe: { in: "10.75\"", mm: "273.05 mm", val: 10.75 }
            }
        };

        let currentSelectedSize = null;
        const modal = document.getElementById('specsModal');
        const sizeSelect = document.getElementById('sizeSelect');
        const selectedText = document.getElementById('selected-text');
        const loader = document.getElementById('dropdown-loader');
        const initialMsg = document.getElementById('initial-message');
        const specsContent = document.getElementById('specs-content');
        const diagram = document.getElementById('dynamic-diagram');
        const tableBody = document.getElementById('specs-table-body');
        const dlItems = document.querySelectorAll('.dl-item');

        function openModal() { modal.style.display = 'block'; }
        function closeModal() { modal.style.display = 'none'; resetModal(); }
        function toggleDropdown() { sizeSelect.classList.toggle('open'); }

        function handleSizeSelection(sizeStr) {
            currentSelectedSize = sizeStr;
            selectedText.innerText = sizeStr;
            sizeSelect.classList.remove('open');
            specsContent.style.display = 'none';
            initialMsg.style.display = 'none';
            loader.style.display = 'flex';
            dlItems.forEach(item => { item.classList.remove('enabled'); item.classList.add('loading'); });
            setTimeout(() => { renderSpecs(sizeStr); }, 2000);
        }

        function renderSpecs(sizeStr) {
            const config = sizeConfigs[sizeStr];
            loader.style.display = 'none';
            diagram.style.width = config.widthPx + "px";
            diagram.style.height = config.heightPx + "px";
            tableBody.innerHTML = `
                <tr><td><span class="dot" style="background:var(--bleed-color)"></span><strong>Bleed</strong></td><td>${config.bleed.in}<span class="sub-text">${config.bleed.mm}</span></td><td>${config.hBleed.in}<span class="sub-text">${config.hBleed.mm}</span></td></tr>
                <tr><td><span class="dot" style="background:var(--trim-color)"></span><strong>Trim</strong></td><td>${config.trim.in}<span class="sub-text">${config.trim.mm}</span></td><td>${config.hTrim.in}<span class="sub-text">${config.hTrim.mm}</span></td></tr>
                <tr><td><span class="dashed-line"></span><strong>Safety</strong></td><td>${config.safe.in}<span class="sub-text">${config.safe.mm}</span></td><td>${config.hSafe.in}<span class="sub-text">${config.hSafe.mm}</span></td></tr>`;
            specsContent.style.display = 'flex';
            dlItems.forEach(item => { item.classList.remove('loading'); item.classList.add('enabled'); });
        }

        function downloadTemplate(extension) {
            if (!currentSelectedSize) return;
            const config = sizeConfigs[currentSelectedSize];
            const fileName = `Template_${currentSelectedSize.replace(/["\s]/g, '')}.${extension}`;
            const scale = 72;
            const w = config.bleed.val * scale;
            const h = config.hBleed.val * scale;
            const trimOffset = (config.bleed.val - config.trim.val) * scale;
            const safeOffset = (config.bleed.val - config.safe.val) * scale;

            const svgData = `<svg width="${w}" height="${h}" viewBox="0 0 ${w} ${h}" xmlns="http://www.w3.org/2000/svg"><rect x="0" y="0" width="${w}" height="${h}" fill="none" stroke="#f5b7b1" stroke-width="2" /><rect x="${trimOffset}" y="${trimOffset}" width="${w - (trimOffset*2)}" height="${h - (trimOffset*2)}" fill="none" stroke="#aed6f1" stroke-width="2" /><rect x="${safeOffset}" y="${safeOffset}" width="${w - (safeOffset*2)}" height="${h - (safeOffset*2)}" fill="none" stroke="#666" stroke-width="1" stroke-dasharray="5,5" /></svg>`;
            let blob = new Blob([svgData], { type: extension === 'svg' ? 'image/svg+xml' : extension === 'pdf' ? 'application/pdf' : 'application/postscript' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = fileName;
            link.click();
        }

        function resetModal() {
            currentSelectedSize = null;
            selectedText.innerText = "Select...";
            initialMsg.style.display = 'block';
            specsContent.style.display = 'none';
            loader.style.display = 'none';
            dlItems.forEach(item => { item.classList.remove('enabled'); item.classList.remove('loading'); });
        }
    </script>
</body>
</html>