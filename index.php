<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InkSite Studio | Smart POS</title>
    <!-- Library to create real Excel files with column widths -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <style>
        :root {
            --inksite-blue: rgb(0, 161, 255);
            --inksite-pink: rgb(255, 51, 133);
            --inksite-yellow: rgb(255, 215, 64);
            --bg-dark: #0f172a;
            --border-color: #f1f5f9;
        }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: #fdfdfe; 
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 20px;
        }

        .dashboard-wrapper {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            max-width: 1100px;
            width: 100%;
        }

        .pos-container {
            background: white;
            flex: 1.4;
            max-width: 550px;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.04);
            border: 1px solid #f0f0f0;
        }

        .activity-container {
            background: white;
            flex: 1;
            max-width: 400px;
            height: 720px;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.04);
            border: 1px solid #f0f0f0;
            display: flex;
            flex-direction: column;
        }

        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; color: var(--bg-dark); font-size: 1.2rem; font-weight: 800; letter-spacing: -0.5px; }
        .header p { color: var(--inksite-blue); margin: 2px 0 0; font-weight: 700; text-transform: uppercase; font-size: 0.55rem; letter-spacing: 1.5px; }

        .input-group { margin-bottom: 12px; }
        label { display: block; font-size: 0.55rem; color: #94a3b8; margin-bottom: 4px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.8rem;
            box-sizing: border-box;
            color: var(--bg-dark);
            background: #fcfdfe;
        }

        .order-row {
            display: grid;
            grid-template-columns: 1.5fr 1fr 80px 50px 40px;
            gap: 8px;
            align-items: end;
            margin-bottom: 15px;
        }

        .add-item-btn {
            background: var(--bg-dark);
            color: var(--inksite-yellow);
            border: none;
            width: 40px;
            height: 38px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 900;
            font-size: 1.4rem;
        }

        .current-items-preview {
            max-height: 180px;
            overflow-y: auto;
            margin-bottom: 15px;
            padding: 12px;
            border: 2px dashed #f1f5f9;
            border-radius: 12px;
            background: #fafbfc;
        }

        .preview-line {
            font-size: 0.7rem;
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .total-section {
            background: var(--bg-dark);
            padding: 15px;
            border-radius: 12px;
            text-align: right;
            margin-bottom: 20px;
        }

        .total-price-input {
            background: transparent;
            border: none;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--inksite-yellow);
            text-align: right;
            width: 100%;
        }

        .save-btn {
            width: 100%;
            padding: 14px;
            background: var(--inksite-pink);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 800;
            text-transform: uppercase;
            cursor: pointer;
        }

        .order-list { flex-grow: 1; overflow-y: auto; }
        .order-item { padding: 12px; border-bottom: 1px solid #f1f5f9; }

        .csv-btn {
            width: 100%;
            padding: 12px;
            background: #f1f5f9;
            color: var(--bg-dark);
            border: none;
            border-radius: 8px;
            font-weight: 800;
            font-size: 0.65rem;
            text-transform: uppercase;
            cursor: pointer;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="dashboard-wrapper">
    <!-- POS INPUT SIDE -->
    <div class="pos-container">
        <div class="header">
            <h2>InkSite Studio</h2>
            <p>Order Management Pro</p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
            <div class="input-group">
                <label>Customer Name</label>
                <input type="text" id="cust-name" placeholder="DAVE">
            </div>
            <div class="input-group">
                <label>Customer Number</label>
                <input type="text" id="cust-contact" placeholder="9312311231">
            </div>
        </div>

        <div id="current-items-preview" class="current-items-preview">
            <div style="color:#cbd5e1; font-size: 0.65rem; text-align:center; padding: 20px;">Cart is empty.</div>
        </div>

        <div class="order-row">
            <div><label>Items</label><input type="text" id="item-name" placeholder="PRINT"></div>
            <div><label>Size</label><input type="text" id="item-size" placeholder="4 X 7 or LONG"></div>
            <div><label>Base Price</label><input type="number" id="unit-price" placeholder="15"></div>
            <div><label>Quantity</label><input type="number" id="qty" value="1"></div>
            <button class="add-item-btn" onclick="addToCart()">+</button>
        </div>

        <div class="total-section">
            <label style="color: #64748b; font-size: 0.55rem;">Current Total (PHP)</label>
            <input type="number" id="total-price" class="total-price-input" value="0.00" readonly>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 15px;">
            <div class="input-group"><label>Cashier</label><input type="text" id="cashier" placeholder="RYAN"></div>
            <div class="input-group"><label>Date</label><input type="date" id="date-picker"></div>
        </div>

        <button class="save-btn" onclick="saveTransaction()">Save Transaction</button>
    </div>

    <!-- ACTIVITY LOG SIDE -->
    <div class="activity-container">
        <div class="header" style="text-align: left;">
            <h2>Daily Activity</h2>
            <p>Sales History</p>
        </div>
        <div id="activity-list" class="order-list"></div>
        <button class="csv-btn" onclick="exportToExcel()">Download Excel Report (.XLSX)</button>
    </div>
</div>

<script>
    let currentCart = [];
    let allTransactions = [];
    let runningTotal = 0;

    // Default Date to Today
    document.getElementById('date-picker').valueAsDate = new Date();

    function addToCart() {
        const item = document.getElementById('item-name').value.toUpperCase();
        const sizeStr = document.getElementById('item-size').value.toUpperCase().trim();
        const basePrice = parseFloat(document.getElementById('unit-price').value);
        const qty = parseInt(document.getElementById('qty').value);

        if (!item || isNaN(basePrice)) { alert("Please enter item name and price!"); return; }

        // Calculation Logic
        let subtotal = 0;
        const dimMatch = sizeStr.match(/(\d+(?:\.\d+)?)\s*X\s*(\d+(?:\.\d+)?)/);

        if (dimMatch) {
            const w = parseFloat(dimMatch[1]);
            const h = parseFloat(dimMatch[2]);
            subtotal = w * h * basePrice * qty; // Dimension Math
        } else {
            subtotal = basePrice * qty; // Standard Math
        }

        runningTotal += subtotal;
        currentCart.push({ 
            items: item, 
            size: sizeStr || "N/A", 
            quantity: qty, 
            price: subtotal 
        });
        
        updateCartUI();
        
        // Reset Item fields
        document.getElementById('item-name').value = '';
        document.getElementById('item-size').value = '';
        document.getElementById('unit-price').value = '';
        document.getElementById('qty').value = '1';
        document.getElementById('item-name').focus();
    }

    function updateCartUI() {
        const preview = document.getElementById('current-items-preview');
        document.getElementById('total-price').value = runningTotal.toFixed(2);
        if (currentCart.length === 0) {
            preview.innerHTML = `<div style="color:#cbd5e1; font-size: 0.65rem; text-align:center; padding: 20px;">Cart is empty.</div>`;
            return;
        }
        preview.innerHTML = currentCart.map(i => `
            <div class="preview-line">
                <span><strong>${i.items}</strong> (${i.size}) x${i.quantity}</span>
                <span>₱${i.price.toFixed(2)}</span>
            </div>
        `).join('');
    }

    function saveTransaction() {
        if (currentCart.length === 0) return;

        const transaction = {
            customerName: document.getElementById('cust-name').value.toUpperCase() || "GUEST",
            customerNumber: document.getElementById('cust-contact').value || "N/A",
            cashier: document.getElementById('cashier').value.toUpperCase() || "STAFF",
            date: document.getElementById('date-picker').value,
            items: [...currentCart]
        };

        allTransactions.push(transaction);
        updateHistoryUI();

        // Clear for next customer
        currentCart = [];
        runningTotal = 0;
        document.getElementById('cust-name').value = '';
        document.getElementById('cust-contact').value = '';
        updateCartUI();
        alert("Transaction Saved!");
    }

    function updateHistoryUI() {
        const list = document.getElementById('activity-list');
        list.innerHTML = allTransactions.slice().reverse().map(t => `
            <div class="order-item">
                <div style="display:flex; justify-content:space-between; font-size:0.75rem;">
                    <strong>${t.customerName}</strong>
                    <span style="color:var(--inksite-blue); font-weight:800;">${t.items.length} Items</span>
                </div>
                <div style="font-size:0.6rem; color:#64748b; margin-top:2px;">Date: ${t.date}</div>
            </div>
        `).join('');
    }

    function exportToExcel() {
        if (allTransactions.length === 0) { alert("No data to export!"); return; }

        // 1. Prepare Data Rows based on your screenshot
        const excelData = [];
        const headers = ["CUSTOMER NAME", "CUSTOMER NUMBER", "CASHIER", "DATE", "ITEMS", "SIZE", "QUANTITY", "PRICE"];
        excelData.push(headers);

        allTransactions.forEach(t => {
            t.items.forEach(i => {
                excelData.push([
                    t.customerName,
                    t.customerNumber,
                    t.cashier,
                    t.date,
                    i.items,
                    i.size,
                    i.quantity,
                    i.price.toFixed(2)
                ]);
            });
        });

        // 2. Create Sheet
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet(excelData);

        // 3. SET COLUMN WIDTHS (This makes it look exactly like your screenshot)
        // 25 = Wide, 15 = Medium, 10 = Standard
        const wscols = [
            { wch: 25 }, // Customer Name
            { wch: 20 }, // Customer Number
            { wch: 15 }, // Cashier
            { wch: 15 }, // Date
            { wch: 20 }, // Items
            { wch: 15 }, // Size
            { wch: 12 }, // Quantity
            { wch: 15 }  // Price
        ];
        ws['!cols'] = wscols;

        // 4. Download File
        XLSX.utils.book_append_sheet(wb, ws, "Sales Report");
        XLSX.writeFile(wb, `InkSite_Report_${new Date().toLocaleDateString()}.xlsx`);
    }
</script>

</body>
</html>