<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="logo.png">
    <title>InkSite Advertising</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Added SheetJS Library for Excel Export -->
    <script src="https://cdn.sheetjs.com/xlsx-0.20.1/package/dist/xlsx.full.min.js"></script>
    <style>
        :root {
            --inks-cyan: #00AEEF;
            --inks-magenta: #EC008C;
            --inks-black: #231F20;
            --inks-bg: #f4f7f6;
            --border: #e2e8f0;
            --text-muted: #64748b;
            --success: #10b981;
            --danger: #ef4444;
        }

        body { font-family: 'Inter', sans-serif; background-color: var(--inks-bg); margin: 0; color: var(--inks-black); }

        header {
            background: white; padding: 1rem 2rem;
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid var(--border);
        }
        .logo {
            display: flex;
            align-items: center; 
            gap: 12px;          
        }

        .logo img {
            height: 50px;        
            width: auto;
        }

        .logo-text {
            display: flex;
            flex-direction: column; 
            justify-content: center;
        }

        .logo h3 {
            margin: 0;           
            font-size: 1.5rem;
            font-weight: 800;
            line-height: 1.1;    
        }

        .logo h3 span {
            color: black;
            letter-spacing: 3px;
        }

        .logo h4 {
            margin: 0;           
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 1px; 
            text-transform: uppercase;
            color: black;         
        }

        .container { max-width: 1200px; margin: 20px auto; padding: 0 20px; }

        .tabs { display: flex; gap: 30px; border-bottom: 2px solid var(--border); margin-bottom: 25px; }
        .tab {
            display: flex; align-items: center; gap: 8px; padding: 12px 5px;
            cursor: pointer; font-weight: 600; color: var(--text-muted);
            position: relative; transition: 0.3s; font-size: 0.9rem;
        }
        .tab.active { color: var(--inks-black); }
        .tab.active::after {
            content: ''; position: absolute; bottom: -2px; left: 0; width: 100%; height: 3px;
            background-color: var(--inks-cyan);
        }

        .card { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 20px; overflow-x: auto; }
        .flex-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
        
        table { width: 100%; border-collapse: collapse; background: white; min-width: 800px; }
        th { text-align: left; padding: 12px; color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; }
        td { padding: 15px 12px; border-bottom: 1px solid #f1f5f9; font-size: 0.9rem; }

        .btn { padding: 10px 18px; border-radius: 8px; border: none; font-weight: 700; cursor: pointer; transition: 0.2s; display: inline-flex; align-items: center; gap: 8px; font-size: 0.8rem; }
        .btn-cyan { background: var(--inks-cyan); color: white; }
        .btn-magenta { background: var(--inks-magenta); color: white; }
        .btn-green { background: var(--success); color: white; }
        .btn-dark { background: var(--inks-black); color: white; }
        .btn:hover { opacity: 0.9; transform: translateY(-1px); }

        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.6); display: none; justify-content: center; align-items: center; z-index: 1000;
            backdrop-filter: blur(4px);
        }
        .modal { background: white; width: 95%; max-width: 480px; padding: 25px; border-radius: 15px; animation: pop 0.2s ease-out; max-height: 90vh; overflow-y: auto; }
        
        .form-group { margin-bottom: 15px; }
        label { display: block; font-size: 0.7rem; font-weight: 800; color: var(--text-muted); margin-bottom: 5px; text-transform: uppercase; }
        input, select { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; font-size: 1rem; }
        .row { display: flex; gap: 10px; }

        .section { display: none; }
        .section.active { display: block; }

        .calc-box { 
            padding: 12px; background: #f0faff; border-radius: 8px; border: 1px solid #ccefff; 
            margin-top: 10px; display: flex; justify-content: space-between; align-items: center; 
        }
        .total-text { font-weight: 800; color: var(--inks-cyan); font-size: 1.1rem; }
        .service-badge { font-size: 0.7rem; background: #eee; padding: 2px 6px; border-radius: 4px; text-transform: uppercase; font-weight: 700; color: #666; }
        .size-badge { background: #e0f2fe; color: #0369a1; padding: 2px 6px; border-radius: 4px; font-weight: 700; font-size: 0.75rem; }
        
        .text-add { color: var(--success); font-weight: bold; }
        .text-sub { color: var(--danger); font-weight: bold; }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="logo.png" alt="Logo">
        <div class="logo-text">
            <h3><span>InkSite</span></h3>
            <h4>ADVERTISING</h4>
        </div>
    </div>
    <div>
        <button class="btn btn-dark" onclick="exportMasterExcel()"><i class="fas fa-file-excel"></i> Export Master Excel</button>
    </div>
</header>

<div class="container">
    <div class="tabs">
        <div class="tab active" onclick="switchTab('tab-product', this)"><i class="fas fa-boxes"></i> PRODUCT</div>
        <div class="tab" onclick="switchTab('tab-sale', this)"><i class="fas fa-shopping-cart"></i> SALE LOG</div>
        <div class="tab" onclick="switchTab('tab-income', this)"><i class="fas fa-chart-line"></i> INCOME</div>
        <div class="tab" onclick="switchTab('tab-rep', this)"><i class="fas fa-sync"></i> REPLENISH</div>
    </div>

    <!-- PRODUCT SECTION -->
    <div id="tab-product" class="section active">
        <div class="flex-header">
            <h2 style="margin:0">Inventory Overview</h2>
            <button class="btn btn-cyan" onclick="openModal('modalAdd')"><i class="fas fa-plus"></i> Register Material</button>
        </div>
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Product Name</th>
                        <th>Unit Size</th>
                        <th>Reg. Qty</th>
                        <th>Buy Price (₱)</th>
                        <th>Stock Left</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="inventoryList"></tbody>
            </table>
        </div>
    </div>

    <!-- SALE LOG SECTION -->
    <div id="tab-sale" class="section">
        <div class="flex-header">
            <h2 style="margin:0">Transaction Log</h2>
            <button class="btn btn-magenta" onclick="openModal('modalSale')"><i class="fas fa-cart-plus"></i> Record Sale</button>
        </div>
        <div class="card">
            <table>
                <thead>
                    <tr><th>Date</th><th>Item & Service</th><th>Unit Price (₱)</th><th>Qty Sold</th><th>Income (Revenue)</th></tr>
                </thead>
                <tbody id="salesTable"></tbody>
            </table>
        </div>
    </div>

    <!-- INCOME SECTION -->
    <div id="tab-income" class="section">
        <h2 style="margin-bottom:15px">Income by Product</h2>
        <div class="card">
            <table>
                <thead>
                    <tr><th>Date</th><th>Product Name</th><th>Total Revenue</th><th>Net Profit</th></tr>
                </thead>
                <tbody id="incomeTable"></tbody>
            </table>
        </div>
    </div>

    <!-- REPLENISH SECTION -->
    <div id="tab-rep" class="section">
        <div class="flex-header">
            <h2 style="margin:0">Replenish Log</h2>
            <button class="btn btn-cyan" onclick="openModal('modalRep')"><i class="fas fa-plus-circle"></i> Add Stock</button>
        </div>
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Size/Label</th>
                        <th>Qty Added</th>
                        <th>Cost (₱)</th>
                        <th>Total Stock</th>
                    </tr>
                </thead>
                <tbody id="repTable"></tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODALS REMAIN THE SAME -->
<div class="modal-overlay" id="modalAdd">
    <div class="modal" style="border-top: 8px solid var(--inks-cyan);">
        <h3>Register Material</h3>
        <div class="form-group"><label>Product Name</label><input type="text" id="pName" placeholder="e.g. Tarpaulin"></div>
        <div class="form-group">
            <label>Type</label>
            <select id="pType" onchange="toggleFormLogic()">
                <option value="roll">Roll-based (W x L)</option>
                <option value="sheet">Sheet-based (Qty)</option>
            </select>
        </div>
        <div class="row">
            <div class="form-group"><label>Buy Price</label><input type="number" id="pPrice"></div>
            <div class="form-group"><label>Date</label><input type="date" id="pDate"></div>
        </div>
        <div id="rollLogic">
            <label>Dimensions (ft)</label>
            <div class="row">
                <input type="number" id="pW" placeholder="Width" oninput="handleRollCalc()">
                <input type="number" id="pL" placeholder="Length" oninput="handleRollCalc()">
            </div>
            <div class="calc-box">Total: <span id="pCalcDisplay" class="total-text">0.0 sqft</span></div>
        </div>
        <div id="sheetLogic" style="display:none">
            <div class="form-group"><label>Size Label</label><input type="text" id="pSizeLabelSheet" placeholder="e.g. A4"></div>
            <div class="form-group"><label>Quantity (Pcs)</label><input type="number" id="pQtySheet"></div>
        </div>
        <button class="btn btn-cyan" style="width:100%; margin-top:15px" onclick="saveProduct()">Save Product</button>
        <button onclick="closeModal('modalAdd')" style="width:100%; border:none; background:none; margin-top:10px; cursor:pointer; color:#999">Cancel</button>
    </div>
</div>

<div class="modal-overlay" id="modalSale">
    <div class="modal" style="border-top: 8px solid var(--inks-magenta);">
        <h3>Record Sale</h3>
        <div class="form-group"><label>Select Item</label><select id="saleSelect" onchange="toggleSaleFields()"></select></div>
        <div class="form-group">
            <label>Service Type</label>
            <select id="sService">
                <option value="Print">Print</option>
                <option value="Photocopy">Photocopy</option>
                <option value="Design">Design + Print</option>
                <option value="General">General Sale</option>
            </select>
        </div>
        <div class="row">
            <div class="form-group"><label>Selling Price (₱)</label><input type="number" id="sPrice"></div>
            <div class="form-group"><label>Date</label><input type="date" id="sDate"></div>
        </div>
        <div id="saleRollInput">
            <label>Dimensions Sold (ft)</label>
            <div class="row">
                <input type="number" id="sW" placeholder="Width" oninput="handleSaleCalc()">
                <input type="number" id="sL" placeholder="Length" oninput="handleSaleCalc()">
            </div>
        </div>
        <div id="saleSheetInput" style="display:none">
            <div class="form-group"><label>Qty (Pcs)</label><input type="number" id="sQtySheet" oninput="handleSaleCalc()"></div>
        </div>
        <div class="calc-box">Deduction: <span id="sCalcDisplay" class="total-text">0.0</span></div>
        <button class="btn btn-magenta" style="width:100%; margin-top:15px" onclick="saveSale()">Complete Sale</button>
        <button onclick="closeModal('modalSale')" style="width:100%; border:none; background:none; margin-top:10px; cursor:pointer; color:#999">Cancel</button>
    </div>
</div>

<div class="modal-overlay" id="modalRep">
    <div class="modal" style="border-top: 8px solid var(--inks-cyan);">
        <h3>Add Stock</h3>
        <div class="form-group"><label>Product</label><select id="repSelect" onchange="toggleRepFields()"></select></div>
        <div id="repRollInput">
            <label>Dimensions Added (ft)</label>
            <div class="row">
                <input type="number" id="repW" placeholder="Width" oninput="handleRepCalc()">
                <input type="number" id="repL" placeholder="Length" oninput="handleRepCalc()">
            </div>
        </div>
        <div id="repSheetInput" style="display:none">
            <div class="form-group"><label>Qty Added (Pcs)</label><input type="number" id="repQtySheet" oninput="handleRepCalc()"></div>
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="form-group"><label>Cost (₱)</label><input type="number" id="repPrice"></div>
            <div class="form-group"><label>Date</label><input type="date" id="repDate"></div>
        </div>
        <div class="calc-box">Adding: <span id="repCalcDisplay" class="total-text">0.0</span></div>
        <button class="btn btn-cyan" style="width:100%; margin-top:15px" onclick="saveRestock()">Update Stock</button>
        <button onclick="closeModal('modalRep')" style="width:100%; border:none; background:none; margin-top:10px; cursor:pointer; color:#999">Cancel</button>
    </div>
</div>

<div class="modal-overlay" id="modalHistory">
    <div class="modal" style="max-width: 600px; border-top: 8px solid var(--inks-black);">
        <h3 id="histTitle">Stock Details</h3>
        <div class="card" style="box-shadow: none; border: 1px solid #eee; padding: 0;">
            <table style="min-width: 100%;">
                <thead>
                    <tr><th>Date</th><th>Activity</th><th>Change</th></tr>
                </thead>
                <tbody id="historyTableBody"></tbody>
            </table>
        </div>
        <button onclick="closeModal('modalHistory')" style="width:100%; border:none; background:#eee; margin-top:15px; padding:10px; border-radius:8px; cursor:pointer; font-weight: bold;">Close Window</button>
    </div>
</div>

<script>
    let inventory = JSON.parse(localStorage.getItem('inks_v20_inv')) || [];
    let sales = JSON.parse(localStorage.getItem('inks_v20_sale')) || [];
    let replenishLog = JSON.parse(localStorage.getItem('inks_v20_rep')) || [];

    function switchTab(id, el) {
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
        el.classList.add('active');
        document.getElementById(id).classList.add('active');
        refreshUI();
    }

    function openModal(id) { 
        document.getElementById(id).style.display = 'flex'; 
        const today = new Date().toISOString().split('T')[0];
        if(id === 'modalSale') { toggleSaleFields(); document.getElementById('sDate').value = today; }
        if(id === 'modalAdd') document.getElementById('pDate').value = today;
        if(id === 'modalRep') { toggleRepFields(); document.getElementById('repDate').value = today; }
    }
    
    function closeModal(id) { document.getElementById(id).style.display = 'none'; }

    function toggleFormLogic() {
        const type = document.getElementById('pType').value;
        document.getElementById('rollLogic').style.display = type === 'roll' ? 'block' : 'none';
        document.getElementById('sheetLogic').style.display = type === 'sheet' ? 'block' : 'none';
    }

    function handleRollCalc() {
        const w = parseFloat(document.getElementById('pW').value) || 0;
        const l = parseFloat(document.getElementById('pL').value) || 0;
        document.getElementById('pCalcDisplay').innerText = (w * l).toFixed(1) + " sqft";
    }

    function toggleSaleFields() {
        const item = inventory.find(i => i.id == document.getElementById('saleSelect').value);
        if(!item) return;
        document.getElementById('saleRollInput').style.display = item.type === 'roll' ? 'block' : 'none';
        document.getElementById('saleSheetInput').style.display = item.type === 'sheet' ? 'block' : 'none';
        handleSaleCalc();
    }

    function handleSaleCalc() {
        const item = inventory.find(i => i.id == document.getElementById('saleSelect').value);
        if(!item) return;
        if(item.type === 'roll') {
            const w = parseFloat(document.getElementById('sW').value) || 0;
            const l = parseFloat(document.getElementById('sL').value) || 0;
            document.getElementById('sCalcDisplay').innerText = (w * l).toFixed(1) + " sqft";
        } else {
            const qty = parseFloat(document.getElementById('sQtySheet').value) || 0;
            document.getElementById('sCalcDisplay').innerText = qty + " pcs";
        }
    }

    function toggleRepFields() {
        const item = inventory.find(i => i.id == document.getElementById('repSelect').value);
        if(!item) return;
        document.getElementById('repRollInput').style.display = item.type === 'roll' ? 'block' : 'none';
        document.getElementById('repSheetInput').style.display = item.type === 'sheet' ? 'block' : 'none';
        handleRepCalc();
    }

    function handleRepCalc() {
        const item = inventory.find(i => i.id == document.getElementById('repSelect').value);
        if(!item) return;
        if(item.type === 'roll') {
            const w = parseFloat(document.getElementById('repW').value) || 0;
            const l = parseFloat(document.getElementById('repL').value) || 0;
            document.getElementById('repCalcDisplay').innerText = (w * l).toFixed(1) + " sqft";
        } else {
            const qty = parseFloat(document.getElementById('repQtySheet').value) || 0;
            document.getElementById('repCalcDisplay').innerText = qty + " pcs";
        }
    }

    function saveProduct() {
        const name = document.getElementById('pName').value;
        const buyPrice = parseFloat(document.getElementById('pPrice').value);
        const date = document.getElementById('pDate').value;
        const type = document.getElementById('pType').value;
        let unitSize, qtyValue;

        if(type === 'roll') {
            const w = parseFloat(document.getElementById('pW').value);
            const l = parseFloat(document.getElementById('pL').value);
            unitSize = `${w}ft x ${l}ft`;
            qtyValue = parseFloat((w * l).toFixed(1));
        } else {
            unitSize = document.getElementById('pSizeLabelSheet').value;
            qtyValue = parseFloat(document.getElementById('pQtySheet').value);
        }

        if(!name || isNaN(buyPrice) || isNaN(qtyValue) || !date) return alert("Fill all fields");

        inventory.push({ 
            id: Date.now(), date, name, unitSize, registeredQty: qtyValue, 
            buyPrice, unitCost: (buyPrice / qtyValue), type, stock: qtyValue 
        });
        sync();
        closeModal('modalAdd');
    }

    function saveSale() {
        const item = inventory.find(i => i.id == document.getElementById('saleSelect').value);
        const sellPrice = parseFloat(document.getElementById('sPrice').value);
        const sDate = document.getElementById('sDate').value;
        const service = document.getElementById('sService').value;

        if(!item || isNaN(sellPrice) || !sDate) return alert("Fill all fields");

        let sQty = 0;
        if(item.type === 'roll') {
            const w = parseFloat(document.getElementById('sW').value) || 0;
            const l = parseFloat(document.getElementById('sL').value) || 0;
            sQty = parseFloat((w * l).toFixed(1));
        } else {
            sQty = parseFloat(document.getElementById('sQtySheet').value);
        }

        if(sQty <= 0 || sQty > item.stock) return alert("Invalid Qty or Insufficient Stock");

        const revenue = sellPrice * sQty;
        const costOfSale = item.unitCost * sQty;
        const profit = revenue - costOfSale;

        item.stock = parseFloat((item.stock - sQty).toFixed(1));
        
        sales.unshift({ 
            pid: item.id, date: sDate, name: item.name, service: service, sellPrice, qty: sQty, 
            unit: item.type==='roll'?'sqft':'pcs', revenue, profit 
        });

        sync();
        closeModal('modalSale');
    }

    function saveRestock() {
        const item = inventory.find(i => i.id == document.getElementById('repSelect').value);
        const pricePaid = parseFloat(document.getElementById('repPrice').value);
        const date = document.getElementById('repDate').value;

        let qtyAdded = 0;
        if(item.type === 'roll') {
            const w = parseFloat(document.getElementById('repW').value) || 0;
            const l = parseFloat(document.getElementById('repL').value) || 0;
            qtyAdded = parseFloat((w * l).toFixed(1));
        } else {
            qtyAdded = parseFloat(document.getElementById('repQtySheet').value);
        }

        if(!item || isNaN(qtyAdded) || isNaN(pricePaid) || !date || qtyAdded <= 0) return alert("Fill all fields correctly");

        const oldStock = item.stock;
        item.registeredQty = parseFloat((item.registeredQty + qtyAdded).toFixed(1));
        item.stock = parseFloat((oldStock + qtyAdded).toFixed(1));
        item.unitCost = ((oldStock * item.unitCost) + pricePaid) / item.stock;

        replenishLog.unshift({ 
            pid: item.id, date, name: item.name, unitSize: item.unitSize, 
            added: qtyAdded, price: pricePaid, total: item.stock, 
            unit: item.type==='roll'?'sqft':'pcs' 
        });

        sync();
        closeModal('modalRep');
    }

    function showHistory(id) {
        const item = inventory.find(i => i.id == id);
        if(!item) return;

        document.getElementById('histTitle').innerText = `${item.name} Ledger`;
        const tbody = document.getElementById('historyTableBody');
        tbody.innerHTML = "";

        let history = [];
        history.push({
            date: item.date,
            activity: "Initial Registration",
            change: `+${item.registeredQty - (replenishLog.filter(r => r.pid == id).reduce((a,b)=>a+b.added,0)).toFixed(1)}`,
            type: 'add'
        });

        sales.filter(s => s.pid == id).forEach(s => {
            history.push({ date: s.date, activity: `Sale (${s.service})`, change: `-${s.qty} ${s.unit}`, type: 'sub' });
        });

        replenishLog.filter(r => r.pid == id).forEach(r => {
            history.push({ date: r.date, activity: `Restocked Material`, change: `+${r.added} ${r.unit}`, type: 'add' });
        });

        history.sort((a,b) => new Date(b.date) - new Date(a.date));
        tbody.innerHTML = history.map(h => `<tr><td>${h.date}</td><td>${h.activity}</td><td class="${h.type === 'add' ? 'text-add' : 'text-sub'}">${h.change}</td></tr>`).join('');
        openModal('modalHistory');
    }

    function sync() {
        localStorage.setItem('inks_v20_inv', JSON.stringify(inventory));
        localStorage.setItem('inks_v20_sale', JSON.stringify(sales));
        localStorage.setItem('inks_v20_rep', JSON.stringify(replenishLog));
        refreshUI();
    }

    function refreshUI() {
        document.getElementById('inventoryList').innerHTML = inventory.map(i => `
            <tr>
                <td>${i.date}</td><td><strong>${i.name}</strong></td>
                <td><span class="size-badge">${i.unitSize}</span></td>
                <td>${i.registeredQty.toFixed(1)} ${i.type==='roll'?'sqft':'pcs'}</td>
                <td>₱${i.buyPrice.toLocaleString()}</td>
                <td><b style="color:var(--inks-cyan)">${i.stock.toFixed(1)}</b> <small>${i.type==='roll'?'sqft':'pcs'}</small></td>
                <td>
                    <i class="fas fa-eye" onclick="showHistory(${i.id})" style="cursor:pointer;color:var(--inks-cyan);margin-right:12px"></i>
                    <i class="fas fa-trash" onclick="del(${i.id})" style="cursor:pointer;color:#ccc"></i>
                </td>
            </tr>`).join('');

        document.getElementById('salesTable').innerHTML = sales.map(s => `
            <tr><td>${s.date}</td><td><span class="service-badge">${s.service}</span> <strong>${s.name}</strong></td>
            <td>₱${s.sellPrice.toLocaleString()}</td><td>${s.qty.toFixed(1)} ${s.unit}</td>
            <td style="font-weight:800; color:var(--inks-magenta)">₱${s.revenue.toLocaleString(undefined,{minimumFractionDigits:2})}</td></tr>`).join('');

        const productStats = {};
        sales.forEach(s => {
            const key = `${s.date}_${s.name}`;
            if(!productStats[key]) productStats[key] = { date: s.date, name: s.name, rev: 0, prof: 0 };
            productStats[key].rev += s.revenue; productStats[key].prof += s.profit;
        });
        document.getElementById('incomeTable').innerHTML = Object.values(productStats).sort((a,b) => new Date(b.date) - new Date(a.date)).map(stat => `
            <tr><td><b>${stat.date}</b></td><td><strong>${stat.name}</strong></td><td>₱${stat.rev.toLocaleString(undefined,{minimumFractionDigits:2})}</td>
            <td style="color:var(--success); font-weight:800">₱${stat.prof.toLocaleString(undefined,{minimumFractionDigits:2})}</td></tr>`).join('');

        document.getElementById('repTable').innerHTML = replenishLog.map(r => `
            <tr><td>${r.date}</td><td><strong>${r.name}</strong></td><td><span class="size-badge">${r.unitSize}</span></td>
            <td style="color:var(--inks-cyan)">+${r.added.toFixed(1)} ${r.unit}</td><td>₱${r.price.toLocaleString()}</td>
            <td><b>${r.total.toFixed(1)} ${r.unit}</b></td></tr>`).join('');

        const opts = inventory.map(i => `<option value="${i.id}">${i.name} [${i.unitSize}] (${i.stock.toFixed(1)} left)</option>`).join('');
        document.getElementById('saleSelect').innerHTML = opts;
        document.getElementById('repSelect').innerHTML = opts;
    }

    function del(id) { if(confirm("Delete this material?")) { inventory = inventory.filter(i => i.id !== id); sync(); } }

    /**
     * UPDATED MASTER EXPORT: 
     * Generates a Multi-Sheet Excel file with defined column widths.
     */
    function exportMasterExcel() {
        const wb = XLSX.utils.book_new();
        const colWidth = { wch: 20 }; // Length and Width = 20

        // 1. PRODUCT SHEET
        const prodData = inventory.map(i => ({
            "DATE": i.date,
            "PRODUCT NAME": i.name,
            "UNIT SIZE": i.unitSize,
            "REG. QTY": i.registeredQty,
            "STOCK LEFT": i.stock,
            "BUY PRICE": i.buyPrice
        }));
        const wsProd = XLSX.utils.json_to_sheet(prodData);
        wsProd['!cols'] = Array(6).fill(colWidth); // Apply width to 6 columns
        XLSX.utils.book_append_sheet(wb, wsProd, "Product");

        // 2. SALE LOG SHEET
        const saleData = sales.map(s => ({
            "DATE": s.date,
            "SERVICE": s.service,
            "ITEM NAME": s.name,
            "UNIT PRICE": s.sellPrice,
            "QTY SOLD": s.qty,
            "REVENUE": s.revenue
        }));
        const wsSale = XLSX.utils.json_to_sheet(saleData);
        wsSale['!cols'] = Array(6).fill(colWidth);
        XLSX.utils.book_append_sheet(wb, wsSale, "Sale Log");

        // 3. INCOME SHEET
        const productStats = {};
        sales.forEach(s => {
            const key = `${s.date}_${s.name}`;
            if(!productStats[key]) productStats[key] = { date: s.date, name: s.name, rev: 0, prof: 0 };
            productStats[key].rev += s.revenue; productStats[key].prof += s.profit;
        });
        const incomeData = Object.values(productStats).map(st => ({
            "DATE": st.date,
            "PRODUCT NAME": st.name,
            "TOTAL REVENUE": st.rev,
            "NET PROFIT": st.prof
        }));
        const wsIncome = XLSX.utils.json_to_sheet(incomeData);
        wsIncome['!cols'] = Array(4).fill(colWidth);
        XLSX.utils.book_append_sheet(wb, wsIncome, "Income");

        // 4. REPLENISH SHEET
        const repData = replenishLog.map(r => ({
            "DATE": r.date,
            "PRODUCT": r.name,
            "SIZE LABEL": r.unitSize,
            "QTY ADDED": r.added,
            "COST": r.price,
            "TOTAL STOCK": r.total
        }));
        const wsRep = XLSX.utils.json_to_sheet(repData);
        wsRep['!cols'] = Array(6).fill(colWidth);
        XLSX.utils.book_append_sheet(wb, wsRep, "Replenish");

        // Download File
        const today = new Date().toISOString().split('T')[0];
        XLSX.writeFile(wb, `InkSite_Master_Report_${today}.xlsx`);
    }

    refreshUI();
</script>
</body>
</html>