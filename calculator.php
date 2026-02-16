<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INKSITE · PERSISTENT RECENT ORDERS · DISCOUNTS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ----------------------------------------------
            FULL SYSTEM – SCROLLABLE RECEIPT MODAL
            MATERIAL + SPEED = BASE RATE, INFLATION PER MATERIAL
            CUSTOM = BASE RATE + ₱10
            NEW BUTTON RESETS FORM BUT KEEPS RECENT ORDERS
            ADDED: SENIOR/PWD (20%) & WHOLESALE DISCOUNTS
        ------------------------------------------------ */
        :root {
            --primary: #0062ff;
            --primary-light: #e6f0ff;
            --bg: #f8fafc;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --card-bg: #ffffff;
            --radius: 20px;
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            --discount-badge: #e11d48;
            --discount-bg: #fff1f2;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-font-smoothing: antialiased; }

        body {
            background-color: var(--bg);
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60%;
            height: 60%;
            background: url('INKSITE.png') no-repeat center;
            background-size: contain;
            opacity: 0.03;
            z-index: -1;
            pointer-events: none;
        }

        .top-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .logo-area { display: flex; align-items: center; gap: 12px; }
        .logo-img { height: 40px; }
        .logo-text { font-weight: 900; font-size: 1.4rem; letter-spacing: -1px; color: var(--text-dark); }

        .main-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 2rem;
        }

        @media (max-width: 1024px) {
            .main-container { grid-template-columns: 1fr; }
        }

        .config-pane { display: flex; flex-direction: column; gap: 1.5rem; }

        .step-card {
            background: var(--card-bg);
            padding: 2rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(0,0,0,0.03);
        }

        .step-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.5rem;
        }

        .step-num {
            background: var(--primary);
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 800;
        }

        .step-title { font-weight: 800; font-size: 1.1rem; }

        /* --- CUSTOMER FIELDS --- */
        .customer-fields {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 0.5rem;
        }
        .customer-input {
            background: #f8fafc;
            border: 2px solid #f1f5f9;
            border-radius: 14px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            transition: 0.2s;
        }
        .customer-input:focus-within { border-color: var(--primary); background: white; }
        .customer-input i {
            color: var(--text-muted);
            margin-right: 10px;
            font-size: 1rem;
            width: 20px;
            text-align: center;
        }
        .customer-input input {
            background: transparent; border: none; width: 100%;
            font-weight: 600; outline: none; color: var(--text-dark);
            font-size: 0.95rem;
        }

        .tile-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .tile-grid-3 { grid-template-columns: repeat(3, 1fr); }

        .tile {
            position: relative;
            border: 2px solid #f1f5f9;
            padding: 1.5rem;
            border-radius: 16px;
            cursor: pointer;
            transition: 0.3s;
            text-align: center;
        }
        .tile input { position: absolute; opacity: 0; }
        .tile i { font-size: 1.8rem; color: var(--text-muted); display: block; margin-bottom: 10px; }
        .tile span { display: block; font-weight: 700; font-size: 0.9rem; }
        .tile:hover { border-color: #cbd5e1; background: #fafafa; }
        .tile:has(input:checked) {
            border-color: var(--primary);
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 98, 255, 0.1);
        }
        .tile:has(input:checked) i { color: var(--primary); }

        .chip-group { display: flex; gap: 10px; flex-wrap: wrap; }
        .chip {
            background: #f1f5f9;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            transition: 0.2s;
            border: 2px solid transparent;
        }
        .chip:hover { background: #e2e8f0; }
        .chip.active { background: white; border-color: var(--primary); color: var(--primary); }

        .input-group {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .input-field {
            background: #f8fafc;
            border: 2px solid #f1f5f9;
            border-radius: 14px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            transition: 0.2s;
        }
        .input-field:focus-within { border-color: var(--primary); background: white; }
        .input-field input {
            background: transparent; border: none; width: 100%; font-size: 1.2rem;
            font-weight: 800; outline: none; color: var(--text-dark);
        }
        .input-field label { font-weight: 700; font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; }

        /* --- MATERIAL & SPEED DROPDOWNS --- */
        .material-speed-row {
            display: flex;
            gap: 16px;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }
        .material-selector, .speed-selector {
            background: #f8fafc;
            border: 2px solid #f1f5f9;
            border-radius: 14px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1 1 200px;
        }
        .material-selector i, .speed-selector i {
            color: var(--primary);
            font-size: 1.2rem;
        }
        .material-selector select, .speed-selector select {
            background: transparent;
            border: none;
            padding: 10px 0;
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--text-dark);
            outline: none;
            width: 100%;
            cursor: pointer;
        }

        /* --- INFLATION CARDS – one per material --- */
        .inflation-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 20px;
        }
        .inflation-item {
            background: #f1f5f9;
            border-radius: 16px;
            padding: 16px;
            border: 2px solid transparent;
            transition: 0.2s;
        }
        .inflation-item.active-material {
            border-color: var(--primary);
            background: var(--primary-light);
        }
        .inflation-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        .inflation-header span {
            font-weight: 800;
            font-size: 0.8rem;
            color: var(--text-dark);
        }
        .speed-prices {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 12px;
        }
        .speed-price-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .speed-label {
            color: var(--text-muted);
        }
        .speed-value {
            font-weight: 800;
            color: var(--primary);
        }
        .inflation-control {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
        .inflation-control label {
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--text-muted);
        }
        .inflation-control input {
            width: 70px;
            padding: 6px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-weight: 700;
            text-align: center;
            background: white;
        }

        /* --- QUANTITY --- */
        .quantity-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
            border: 2px solid #f1f5f9;
            border-radius: 14px;
            padding: 8px 16px;
            margin-top: 1rem;
        }
        .quantity-label {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .quantity-btn {
            background: white;
            border: 1px solid #cbd5e1;
            width: 32px;
            height: 32px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.2rem;
            color: var(--text-dark);
            cursor: pointer;
            transition: 0.2s;
        }
        .quantity-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        #quantityInput {
            width: 50px;
            text-align: center;
            font-weight: 800;
            font-size: 1.2rem;
            border: none;
            background: transparent;
            outline: none;
        }

        .upload-area {
            border: 2px dashed #e2e8f0;
            background: #fbfcfe;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 1rem;
            position: relative;
        }
        .upload-area:hover { border-color: var(--primary); background: var(--primary-light); }
        .upload-area i { font-size: 2rem; color: var(--primary); margin-bottom: 10px; }
        .upload-area p { font-weight: 700; font-size: 0.9rem; }
        .file-input {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            opacity: 0; cursor: pointer;
        }

        textarea {
            width: 100%; border: 2px solid #f1f5f9; border-radius: 14px;
            padding: 1rem; font-family: inherit; font-size: 0.95rem;
            resize: none; outline: none;
        }

        /* --- DISCOUNT SECTION (NEW) --- */
        .discount-section {
            margin-top: 1.5rem;
            background: #f8fafc;
            border-radius: 16px;
            padding: 1.25rem;
            border: 2px solid #f1f5f9;
        }
        .discount-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
            font-weight: 700;
            color: var(--text-dark);
        }
        .discount-title i {
            color: var(--discount-badge);
        }
        .discount-options {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }
        .discount-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .discount-check label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-dark);
            cursor: pointer;
        }
        .discount-check input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
            cursor: pointer;
        }
        .senior-pwd-docs {
            margin-left: 28px;
            margin-bottom: 1rem;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }
        .senior-pwd-docs .input-field {
            padding: 8px 12px;
            flex: 1 1 200px;
        }
        .senior-pwd-docs .input-field input {
            font-size: 0.9rem;
            font-weight: 500;
        }
        .wholesale-info {
            background: #e6f0ff;
            border-radius: 12px;
            padding: 12px 16px;
            margin-top: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .price-breakdown {
            margin-top: 1rem;
            border-top: 1px dashed #cbd5e1;
            padding-top: 1rem;
        }
        .breakdown-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            margin-bottom: 6px;
        }
        .breakdown-row.discount {
            color: var(--discount-badge);
            font-weight: 700;
        }
        .breakdown-row.final {
            font-size: 1rem;
            font-weight: 800;
            color: var(--primary);
            margin-top: 8px;
            padding-top: 8px;
            border-top: 2px solid #e2e8f0;
        }

        /* --- PREVIEW --- */
        .summary-pane { position: sticky; top: 6rem; }

        .banner-visual-box {
            background: #1e293b;
            border-radius: var(--radius);
            height: 420px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            padding: 0 1rem;
        }

        .preview-header {
            text-align: center;
            margin-bottom: 12px;
            z-index: 20;
            width: 100%;
        }
        .preview-header strong {
            display: block;
            font-size: 1.8rem;
            font-weight: 900;
            color: white;
            text-shadow: 0 2px 10px rgba(0,0,0,0.5);
            letter-spacing: -0.5px;
            line-height: 1.2;
        }
        .preview-header span {
            font-size: 0.85rem;
            font-weight: 800;
            color: #bfdbfe;
            text-transform: uppercase;
            letter-spacing: 4px;
            background: rgba(0,98,255,0.2);
            padding: 4px 16px;
            border-radius: 40px;
            backdrop-filter: blur(4px);
            display: inline-block;
            margin-top: 4px;
        }

        #bannerVisual {
            background: #fff;
            background-image: linear-gradient(rgba(0,0,0,0.01) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,0.01) 1px, transparent 1px);
            background-size: 2px 2px;
            position: relative;
            transition: all 0.6s;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 30px 60px rgba(0,0,0,0.5);
            overflow: hidden;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .banner-preview-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: white;
            z-index: 2;
            pointer-events: none;
        }

        .eyelet {
            position: absolute; width: 20px; height: 20px; border-radius: 50%;
            background: radial-gradient(circle at 35% 35%, #fff1a8 0%, #d4af37 45%, #8a6d19 100%);
            box-shadow: 0 4px 8px rgba(0,0,0,0.3); z-index: 15;
            display: flex; align-items: center; justify-content: center;
        }
        .eyelet::after {
            content: ''; width: 10px; height: 10px; background: #000; border-radius: 50%;
        }

        .price-card {
            background: white; border-radius: var(--radius);
            padding: 1.8rem 2rem; 
            margin-top: 1.5rem; 
            box-shadow: var(--shadow);
        }
        .price-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 0.5rem;
        }
        .price-header h3 {
            font-weight: 700; 
            color: var(--text-muted); 
            font-size: 0.8rem; 
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .price-original {
            font-size: 1rem;
            color: var(--text-muted);
            text-decoration: line-through;
            margin-right: 8px;
        }
        .price-val { 
            font-size: 3.5rem; 
            font-weight: 900; 
            letter-spacing: -3px; 
            color: var(--primary);
            line-height: 1;
        }

        .recent-orders {
            margin-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
            padding-top: 1.2rem;
        }
        .recent-title {
            font-weight: 700;
            font-size: 0.8rem;
            color: var(--text-muted);
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1rem;
        }
        .order-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-height: 200px;
            overflow-y: auto;
            padding-right: 4px;
        }
        .order-item {
            background: #f8fafc;
            border-radius: 12px;
            padding: 12px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 4px solid var(--primary);
        }
        .order-customer {
            font-weight: 800;
            font-size: 0.85rem;
            color: var(--text-dark);
        }
        .order-details {
            font-size: 0.7rem;
            color: var(--text-muted);
            display: flex;
            gap: 8px;
            margin-top: 2px;
        }
        .order-amount {
            font-weight: 800;
            color: var(--primary);
            font-size: 1rem;
        }
        .empty-orders {
            font-size: 0.8rem;
            color: #94a3b8;
            text-align: center;
            padding: 1rem 0;
            font-style: italic;
        }

        .checkout-btn {
            background: var(--primary); color: white; width: 100%;
            padding: 20px; border-radius: 16px; border: none;
            font-weight: 800; font-size: 1.1rem; cursor: pointer;
            transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 10px;
        }
        .checkout-btn:hover { background: #0056e0; transform: translateY(-3px); }

        .hidden { display: none; }

        /* ---------- MODALS ---------- */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(8px);
            z-index: 1000; display: none; align-items: center; justify-content: center; padding: 20px;
        }
        .modal-content {
            background: white; width: 100%; max-width: 450px;
            border-radius: 24px; padding: 2rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: modalIn 0.3s ease-out;
        }
        @keyframes modalIn { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .modal-header { margin-bottom: 1.5rem; text-align: center; }
        .modal-header h2 { font-weight: 800; font-size: 1.5rem; margin-bottom: 5px; }
        .modal-header p { color: var(--text-muted); font-size: 0.9rem; }
        .payment-summary-box {
            background: #f8fafc; border-radius: 16px; padding: 1.2rem; margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
        }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 8px; font-weight: 500; }
        .summary-row.total { font-weight: 800; font-size: 1.2rem; color: var(--primary); margin-top: 10px; padding-top: 10px; border-top: 2px dashed #cbd5e1; }
        .modal-footer { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 1.5rem; }
        .btn-cancel { background: #f1f5f9; color: var(--text-dark); padding: 12px; border-radius: 12px; border: none; font-weight: 700; cursor: pointer; }
        .btn-proceed { background: var(--primary); color: white; padding: 12px; border-radius: 12px; border: none; font-weight: 700; cursor: pointer; }

        .online-tabs { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 1.5rem; }
        .online-tab { background: #f1f5f9; border: 2px solid transparent; padding: 10px; border-radius: 12px; cursor: pointer; text-align: center; font-size: 0.8rem; font-weight: 700; }
        .online-tab.active { border-color: var(--primary); background: var(--primary-light); color: var(--primary); }
        .qr-display { background: white; border: 2px solid #f1f5f9; border-radius: 16px; padding: 20px; text-align: center; margin-bottom: 1rem; }
        .qr-placeholder { width: 180px; height: 180px; margin: 0 auto; background: #eee; display: flex; align-items: center; justify-content: center; border-radius: 10px; border: 1px solid #ddd; }
        .qr-placeholder i { font-size: 4rem; color: #ccc; }
        .card-form input { width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #e2e8f0; margin-bottom: 10px; }
        .card-row { display: grid; grid-template-columns: 2fr 1fr; gap: 10px; }

        /* ---------- SCROLLABLE RECEIPT MODAL ---------- */
        .receipt-modal-content {
            background: white;
            width: 100%;
            max-width: 450px;
            max-height: 85vh;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: modalIn 0.3s ease-out;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .receipt-scroll-area {
            padding: 2rem 2rem 1.5rem;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--primary) #e2e8f0;
        }
        .receipt-scroll-area::-webkit-scrollbar {
            width: 6px;
        }
        .receipt-scroll-area::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }
        .receipt-scroll-area::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }

        .receipt-paper {
            background: white; 
            color: #1e293b; 
            font-family: 'Inter', 'Courier New', monospace;
            width: 100%;
            margin: 0 auto;
        }
        .receipt-header { 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            text-align: center; 
            border-bottom: 2px solid #f1f5f9; 
            padding-bottom: 1.5rem; 
            margin-bottom: 1.25rem; 
        }
        .receipt-logo { 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            gap: 12px; 
            margin-bottom: 8px; 
        }
        .receipt-logo-img { 
            height: 48px; 
            width: auto; 
        }
        .receipt-company-name { 
            font-size: 1.6rem; 
            font-weight: 900; 
            letter-spacing: -1px; 
            color: #0f172a; 
        }
        .receipt-company-sub { 
            font-size: 0.7rem; 
            font-weight: 700; 
            color: var(--primary); 
            text-transform: uppercase; 
            letter-spacing: 2px; 
        }
        .receipt-address, .receipt-site, .receipt-contact { 
            font-size: 0.8rem; 
            color: #475569; 
            font-weight: 500; 
            line-height: 1.5; 
        }
        .receipt-site { 
            font-weight: 700; 
            color: var(--primary); 
        }
        .receipt-body { 
            font-size: 0.85rem; 
            line-height: 1.7; 
        }
        .receipt-divider { 
            border-top: 1px dashed #cbd5e1; 
            margin: 0.9rem 0; 
        }
        .receipt-line { 
            display: flex; 
            justify-content: space-between; 
            margin-bottom: 6px; 
            font-weight: 500; 
        }
        .receipt-total { 
            font-size: 1.2rem; 
            font-weight: 900; 
            color: var(--primary); 
            border-top: 2px solid #e2e8f0; 
            margin-top: 10px; 
            padding-top: 12px; 
        }
        .receipt-footer { 
            text-align: center; 
            margin-top: 1.5rem; 
            padding-top: 1.25rem; 
            border-top: 2px solid #f1f5f9; 
            font-size: 0.8rem; 
            font-weight: 600; 
        }
        .btn-print { 
            background: white; 
            color: var(--primary); 
            border: 2px solid var(--primary); 
            padding: 10px 20px; 
            border-radius: 40px; 
            font-weight: 800; 
            font-size: 0.85rem; 
            cursor: pointer; 
            display: inline-flex; 
            align-items: center; 
            gap: 8px; 
            margin-top: 12px; 
            transition: 0.2s;
        }
        .btn-print:hover { 
            background: var(--primary); 
            color: white; 
        }
        @media print { 
            body * { visibility: hidden; } 
            .receipt-paper, .receipt-paper * { visibility: visible; } 
            .receipt-paper { position: absolute; left: 0; top: 0; width: 100%; } 
            .btn-print { display: none; } 
        }
    </style>
</head>
<body>

    <nav class="top-nav">
        <div class="logo-area">
            <img src="INKSITE.png" alt="INKSITE Logo" class="logo-img" onerror="this.src='https://via.placeholder.com/40x40/0062ff/ffffff?text=I'">
            <span class="logo-text">INKSITE STUDIO</span>
        </div>
        <div style="font-weight: 600; font-size: 0.9rem; color: var(--text-muted);">
            <i class="fas fa-headset" style="margin-right: 5px;"></i> Support Available
        </div>
    </nav>

    <div class="main-container">
        <div class="config-pane">
            
            <!-- STEP 1 - CUSTOMER DETAILS -->
            <div class="step-card">
                <div class="step-header">
                    <div class="step-num">1</div>
                    <div class="step-title">Customer Information</div>
                </div>
                <div class="customer-fields">
                    <div class="customer-input">
                        <i class="fas fa-user"></i>
                        <input type="text" id="customerName" placeholder="Full name" value="Maria Santos">
                    </div>
                    <div class="customer-input">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="customerEmail" placeholder="Email address" value="maria.santos@email.com">
                    </div>
                    <div class="customer-input">
                        <i class="fas fa-phone-alt"></i>
                        <input type="tel" id="customerContact" placeholder="Contact number (optional)" value="0918 765 4321">
                    </div>
                </div>
            </div>

            <!-- STEP 2 - Orientation -->
            <div class="step-card">
                <div class="step-header">
                    <div class="step-num">2</div>
                    <div class="step-title">Select Orientation</div>
                </div>
                <div class="tile-grid">
                    <label class="tile">
                        <input type="radio" name="orient" value="horiz" checked id="toggleHoriz">
                        <i class="fas fa-arrows-alt-h"></i>
                        <span>Horizontal</span>
                    </label>
                    <label class="tile">
                        <input type="radio" name="orient" value="vert" id="toggleVert">
                        <i class="fas fa-arrows-alt-v"></i>
                        <span>Vertical</span>
                    </label>
                </div>
            </div>

            <!-- STEP 3 - DIMENSIONS + MATERIAL + SPEED + INFLATION -->
            <div class="step-card">
                <div class="step-header">
                    <div class="step-num">3</div>
                    <div class="step-title">Banner Size & Service</div>
                </div>
                <div class="chip-group" id="presetGrid">
                    <div class="chip active" data-w="1" data-h="3">1 × 3</div>
                    <div class="chip" data-w="2" data-h="3">2 × 3</div>
                    <div class="chip" data-w="2" data-h="4">2 × 4</div>
                    <div class="chip" data-w="2" data-h="5">2 × 5</div>
                    <div class="chip" data-w="3" data-h="5">3 × 5</div>
                    <div class="chip" data-w="3" data-h="8">3 × 8</div>
                </div>
                <div class="input-group">
                    <div class="input-field">
                        <input type="number" id="widthFt" value="1">
                        <label>Width(ft)</label>
                    </div>
                    <div style="color: #cbd5e1; font-weight: 300;">&times;</div>
                    <div class="input-field">
                        <input type="number" id="heightFt" value="3">
                        <label>Height(ft)</label>
                    </div>
                </div>

                <!-- MATERIAL + SPEED DROPDOWNS -->
                <div class="material-speed-row">
                    <div class="material-selector">
                        <i class="fas fa-tarp"></i>
                        <select id="materialSelect" onchange="updateRateFromSelections()">
                            <option value="thin">10oz (THIN)</option>
                            <option value="standard" selected>13oz (STANDARD)</option>
                            <option value="heavy">18oz (HEAVY DUTY)</option>
                            <option value="blockout">19-22oz (BLOCKOUT)</option>
                        </select>
                    </div>
                    <div class="speed-selector">
                        <i class="fas fa-clock"></i>
                        <select id="speedSelect" onchange="updateRateFromSelections()">
                            <option value="base">1-2 Days (Base)</option>
                            <option value="next">Next-Day</option>
                            <option value="same">Same-Day</option>
                            <option value="rush">Rush/Priority</option>
                        </select>
                    </div>
                </div>

                <!-- INFLATION CARDS -->
                <div class="inflation-cards">
                    <!-- THIN -->
                    <div id="card-thin" class="inflation-item">
                        <div class="inflation-header"><span>10oz THIN</span></div>
                        <div class="speed-prices">
                            <div class="speed-price-row"><span class="speed-label">1-2 Days:</span><span class="speed-value" id="price-thin-base">₱15</span></div>
                            <div class="speed-price-row"><span class="speed-label">Next-Day:</span><span class="speed-value" id="price-thin-next">₱18</span></div>
                            <div class="speed-price-row"><span class="speed-label">Same-Day:</span><span class="speed-value" id="price-thin-same">₱20</span></div>
                            <div class="speed-price-row"><span class="speed-label">Rush:</span><span class="speed-value" id="price-thin-rush">₱25</span></div>
                        </div>
                        <div class="inflation-control">
                            <label>Add ₱</label>
                            <input type="number" id="inflate-thin" value="0" min="0" step="1" onchange="updateAllMaterialRates()">
                        </div>
                    </div>
                    <!-- STANDARD -->
                    <div id="card-standard" class="inflation-item active-material">
                        <div class="inflation-header"><span>13oz STANDARD</span></div>
                        <div class="speed-prices">
                            <div class="speed-price-row"><span class="speed-label">1-2 Days:</span><span class="speed-value" id="price-standard-base">₱20</span></div>
                            <div class="speed-price-row"><span class="speed-label">Next-Day:</span><span class="speed-value" id="price-standard-next">₱25</span></div>
                            <div class="speed-price-row"><span class="speed-label">Same-Day:</span><span class="speed-value" id="price-standard-same">₱30</span></div>
                            <div class="speed-price-row"><span class="speed-label">Rush:</span><span class="speed-value" id="price-standard-rush">₱40</span></div>
                        </div>
                        <div class="inflation-control">
                            <label>Add ₱</label>
                            <input type="number" id="inflate-standard" value="0" min="0" step="1" onchange="updateAllMaterialRates()">
                        </div>
                    </div>
                    <!-- HEAVY DUTY -->
                    <div id="card-heavy" class="inflation-item">
                        <div class="inflation-header"><span>18oz HEAVY</span></div>
                        <div class="speed-prices">
                            <div class="speed-price-row"><span class="speed-label">1-2 Days:</span><span class="speed-value" id="price-heavy-base">₱30</span></div>
                            <div class="speed-price-row"><span class="speed-label">Next-Day:</span><span class="speed-value" id="price-heavy-next">₱35</span></div>
                            <div class="speed-price-row"><span class="speed-label">Same-Day:</span><span class="speed-value" id="price-heavy-same">₱40</span></div>
                            <div class="speed-price-row"><span class="speed-label">Rush:</span><span class="speed-value" id="price-heavy-rush">₱50</span></div>
                        </div>
                        <div class="inflation-control">
                            <label>Add ₱</label>
                            <input type="number" id="inflate-heavy" value="0" min="0" step="1" onchange="updateAllMaterialRates()">
                        </div>
                    </div>
                    <!-- BLOCKOUT -->
                    <div id="card-blockout" class="inflation-item">
                        <div class="inflation-header"><span>19-22oz BLOCK</span></div>
                        <div class="speed-prices">
                            <div class="speed-price-row"><span class="speed-label">1-2 Days:</span><span class="speed-value" id="price-blockout-base">₱50</span></div>
                            <div class="speed-price-row"><span class="speed-label">Next-Day:</span><span class="speed-value" id="price-blockout-next">₱60</span></div>
                            <div class="speed-price-row"><span class="speed-label">Same-Day:</span><span class="speed-value" id="price-blockout-same">₱75</span></div>
                            <div class="speed-price-row"><span class="speed-label">Rush:</span><span class="speed-value" id="price-blockout-rush">₱100</span></div>
                        </div>
                        <div class="inflation-control">
                            <label>Add ₱</label>
                            <input type="number" id="inflate-blockout" value="0" min="0" step="1" onchange="updateAllMaterialRates()">
                        </div>
                    </div>
                </div>

                <!-- QUANTITY -->
                <div class="quantity-wrapper">
                    <span class="quantity-label">
                        <i class="fas fa-cubes"></i> Quantity
                    </span>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="decrementQuantity()">−</button>
                        <input type="number" id="quantityInput" value="1" min="1" step="1" onchange="update()">
                        <button class="quantity-btn" onclick="incrementQuantity()">+</button>
                    </div>
                </div>

                <!-- ========== DISCOUNT SECTION (NEW) ========== -->
                <div class="discount-section">
                    <div class="discount-title">
                        <i class="fas fa-tags"></i> Apply Discount
                    </div>
                    <div class="discount-options">
                        <div class="discount-check">
                            <input type="checkbox" id="seniorDiscount" onchange="toggleSeniorPWDInputs()">
                            <label for="seniorDiscount">Senior Citizen (20% off)</label>
                        </div>
                        <div class="discount-check">
                            <input type="checkbox" id="pwdDiscount" onchange="toggleSeniorPWDInputs()">
                            <label for="pwdDiscount">PWD (20% off)</label>
                        </div>
                        <div class="discount-check">
                            <input type="checkbox" id="wholesaleDiscount" onchange="toggleWholesaleDiscount()">
                            <label for="wholesaleDiscount">Wholesale (15% off on bulk)</label>
                        </div>
                    </div>
                    
                    <!-- Senior/PWD ID input (shown only when checked) -->
                    <div id="seniorPwdDocs" class="senior-pwd-docs hidden">
                        <div class="input-field">
                            <i class="fas fa-id-card"></i>
                            <input type="text" id="idNumber" placeholder="ID number (optional)">
                        </div>
                    </div>
                    
                    <!-- Wholesale info: appears when qty >= 5 -->
                    <div id="wholesaleInfo" class="wholesale-info hidden">
                        <i class="fas fa-percent"></i> 
                        15% wholesale discount applied for bulk order (5+ units)
                    </div>
                    
                    <!-- Price breakdown after discounts -->
                    <div id="priceBreakdown" class="price-breakdown hidden">
                        <div class="breakdown-row" id="rowSubtotal">
                            <span>Subtotal:</span>
                            <span id="subtotalAmount">₱0.00</span>
                        </div>
                        <div id="rowSeniorPwdDiscount" class="breakdown-row discount hidden">
                            <span>Senior/PWD Discount (20%):</span>
                            <span id="seniorPwdDiscountAmount">-₱0.00</span>
                        </div>
                        <div id="rowWholesaleDiscount" class="breakdown-row discount hidden">
                            <span>Wholesale Discount (15%):</span>
                            <span id="wholesaleDiscountAmount">-₱0.00</span>
                        </div>
                        <div class="breakdown-row final">
                            <span>Total after discounts:</span>
                            <span id="totalAfterDiscounts">₱0.00</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STEP 4 - Design layout -->
            <div class="step-card">
                <div class="step-header">
                    <div class="step-num">4</div>
                    <div class="step-title">Design Layout</div>
                </div>
                <div class="tile-grid">
                    <label class="tile">
                        <input type="radio" name="layout" value="own" checked id="layoutOwn">
                        <i class="fas fa-cloud-arrow-up"></i>
                        <span id="ownRateLabel">Own Design (₱20/sqft)</span>
                    </label>
                    <label class="tile">
                        <input type="radio" name="layout" value="inksite" id="layoutInksite">
                        <i class="fas fa-wand-sparkles"></i>
                        <span id="customRateLabel">Custom Service (₱30/sqft)</span>
                    </label>
                </div>
                <div id="ownDesignForm">
                    <div class="upload-area" id="uploadOwnArea">
                        <i class="fas fa-image"></i>
                        <p>Click or drag to upload your design</p>
                        <input type="file" id="ownFileInput" accept="image/*" class="file-input">
                    </div>
                    <div style="margin-top: 10px; font-size: 0.8rem; color: var(--text-muted);">
                        <i class="fas fa-info-circle"></i> Your uploaded image will appear in the preview.
                    </div>
                </div>
                <div id="inksiteDesignForm" class="hidden" style="margin-top: 1.5rem;">
                    <textarea id="desc" rows="3" placeholder="Describe colors, text, and theme..."></textarea>
                    <div class="upload-area">
                        <i class="fas fa-camera"></i>
                        <p>Upload reference (Optional)</p>
                        <input type="file" id="refFileInput" accept="image/*" class="file-input">
                    </div>
                </div>
            </div>

            <!-- STEP 5 - Finishing -->
            <div class="step-card">
                <div class="step-header">
                    <div class="step-num">5</div>
                    <div class="step-title">Finishing</div>
                </div>
                <div class="chip-group">
                    <div class="chip" data-eye="0">No Grommets</div>
                    <div class="chip" data-eye="2">Top Corners</div>
                    <div class="chip active" data-eye="4">All 4 Corners</div>
                </div>
            </div>

            <!-- STEP 6 - Payment Method -->
            <div class="step-card">
                <div class="step-header">
                    <div class="step-num">6</div>
                    <div class="step-title">Payment Method</div>
                </div>
                <div class="tile-grid tile-grid-3">
                    <label class="tile">
                        <input type="radio" name="paymethod" value="cash" checked>
                        <i class="fas fa-money-bill-wave"></i>
                        <span>Cash</span>
                    </label>
                    <label class="tile">
                        <input type="radio" name="paymethod" value="online">
                        <i class="fas fa-qrcode"></i>
                        <span>Online</span>
                    </label>
                    <label class="tile">
                        <input type="radio" name="paymethod" value="card">
                        <i class="fas fa-credit-card"></i>
                        <span>Card</span>
                    </label>
                </div>
                <button class="checkout-btn" style="margin-top: 1.5rem;" onclick="handlePaymentInitiation()">
                    Proceed to Payment <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- PREVIEW + RECENT ORDERS -->
        <div class="summary-pane">
            <div class="banner-visual-box">
                <div class="preview-header">
                    <strong id="sizeLabelAbove">1 × 3 ft</strong>
                    <span>INKSITE PREMIUM TARP</span>
                </div>
                <div id="bannerVisual">
                    <img id="tarpPreviewImage" class="banner-preview-image" src="" alt="preview" style="display: none;">
                    <div id="eyeletLayer"></div>
                </div>
            </div>
            
            <div class="price-card">
                <div class="price-header">
                    <h3>Total Quote</h3>
                    <div style="display: flex; align-items: baseline;">
                        <span id="originalPriceDisplay" class="price-original"></span>
                        <span class="price-val" id="totalPrice">₱60.00</span>
                    </div>
                </div>
                
                <!-- Discount badges (shown when active) -->
                <div id="discountBadges" style="display: flex; gap: 8px; margin-bottom: 1rem;"></div>
                
                <div class="recent-orders">
                    <div class="recent-title">
                        <i class="fas fa-clock-rotate-left"></i> Recent Orders
                    </div>
                    <div id="orderListContainer" class="order-list">
                        <div class="empty-orders">No completed transactions yet.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CASH MODAL -->
    <div class="modal-overlay" id="cashModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Cash Payment</h2>
                <p>Please enter the amount received</p>
            </div>
            <div class="payment-summary-box">
                <div class="summary-row"><span>Total Amount:</span><span id="cashModalTotal">₱0.00</span></div>
                <div class="input-field" style="margin-top: 10px;">
                    <input type="number" id="cashReceived" placeholder="0.00" oninput="calcChange()">
                    <label>Amount Received</label>
                </div>
                <div class="summary-row total"><span>Change:</span><span id="cashChange">₱0.00</span></div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal('cashModal')">Cancel</button>
                <button class="btn-proceed" onclick="completeCashPayment()">Proceed</button>
            </div>
        </div>
    </div>

    <!-- ONLINE MODAL -->
    <div class="modal-overlay" id="onlineModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Online Payment</h2>
                <p>Scan QR code to pay <strong><span class="onlineModalTotal">₱0.00</span></strong></p>
            </div>
            <div class="online-tabs">
                <div class="online-tab active" onclick="switchOnlineTab(this, 'GCash')">GCash</div>
                <div class="online-tab" onclick="switchOnlineTab(this, 'Maya')">Maya</div>
                <div class="online-tab" onclick="switchOnlineTab(this, 'PayPal')">PayPal</div>
            </div>
            <div class="qr-display">
                <div class="qr-placeholder" id="qrContainer">
                    <i class="fas fa-qrcode"></i>
                </div>
                <p style="margin-top: 10px; font-size: 0.8rem; font-weight: 700;" id="qrLabel">GCash Payment</p>
            </div>
            <div class="modal-footer" style="grid-template-columns: 1fr;">
                <button class="btn-proceed" onclick="completeOnlinePayment()">I have Scanned & Paid</button>
                <button class="btn-cancel" onclick="closeModal('onlineModal')" style="margin-top: 5px;">Cancel</button>
            </div>
        </div>
    </div>

    <!-- CARD MODAL -->
    <div class="modal-overlay" id="cardModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Card Payment</h2>
                <p>Enter your card details</p>
            </div>
            <div class="payment-summary-box">
                <div class="summary-row total"><span>Total to Pay:</span><span class="onlineModalTotal">₱0.00</span></div>
            </div>
            <div class="card-form">
                <input type="text" placeholder="Card Number (0000 0000 0000 0000)">
                <div class="card-row">
                    <input type="text" placeholder="MM / YY">
                    <input type="text" placeholder="CVC">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal('cardModal')">Cancel</button>
                <button class="btn-proceed" onclick="completeCardPayment()">Pay Now</button>
            </div>
        </div>
    </div>

    <!-- ========== SCROLLABLE RECEIPT MODAL ========== -->
    <div class="modal-overlay" id="receiptModal">
        <div class="receipt-modal-content">
            <div class="receipt-scroll-area">
                <div class="receipt-paper" id="printableReceipt">
                    <div class="receipt-header">
                        <div class="receipt-logo">
                            <img src="INKSITE.png" class="receipt-logo-img" onerror="this.src='https://via.placeholder.com/48x48/0062ff/ffffff?text=I'">
                            <span class="receipt-company-name">INKSITE</span>
                        </div>
                        <div class="receipt-company-sub">ADVERTISING & LARGE FORMAT</div>
                        <div class="receipt-address">Poblacion, Metro Manila, 1200, Philippines</div>
                        <div class="receipt-site">www.inksite.ph</div>
                        <div class="receipt-contact">+63 912 345 6789 · support@inksite.ph</div>
                    </div>
                    <div class="receipt-body">
                        <div class="receipt-line"><span>Date & Time:</span><span id="rcpDate">--</span></div>
                        <div class="receipt-line"><span>Order ID:</span><span id="rcpID" style="font-weight:800;">#88219</span></div>
                        <div class="receipt-line"><span>Customer:</span><span id="rcpCustomer">--</span></div>
                        <div class="receipt-line"><span>Email / Contact:</span><span id="rcpEmailContact">--</span></div>
                        <div class="receipt-divider"></div>
                        <div class="receipt-line"><span>Material:</span><span id="rcpMaterial">13oz STANDARD</span></div>
                        <div class="receipt-line"><span>Speed:</span><span id="rcpSpeed">1-2 Days</span></div>
                        <div class="receipt-line"><span>Banner size:</span><span id="rcpSize">--</span></div>
                        <div class="receipt-line"><span>Quantity:</span><span id="rcpQuantity">1</span></div>
                        <div class="receipt-line"><span>Design type:</span><span id="rcpLayout">--</span></div>
                        <div class="receipt-line"><span>Grommets:</span><span id="rcpEyelet">4 corners</span></div>
                        <div id="rcpDiscountsLine" class="receipt-line hidden"><span>Discounts:</span><span id="rcpDiscounts">--</span></div>
                        <div class="receipt-divider"></div>
                        <div class="receipt-line"><span>Payment method:</span><span id="rcpMethod">--</span></div>
                        <div id="rcpCashDetails" style="display: none;">
                            <div class="receipt-line"><span>Cash received:</span><span id="rcpRec">--</span></div>
                            <div class="receipt-line"><span>Change:</span><span id="rcpChange">--</span></div>
                        </div>
                        <div class="receipt-line receipt-total"><span>TOTAL AMOUNT:</span><span id="rcpTotal">₱0.00</span></div>
                    </div>
                    <div class="receipt-footer">
                        <p>✓ Thank you for choosing INKSITE ADVERTISING</p>
                        <p>Your banner is in production. Present this receipt upon pickup.</p>
                        <div style="display: flex; gap: 10px; justify-content: center; margin-top: 15px;">
                            <button class="btn-print" onclick="window.print()"><i class="fas fa-print"></i> PRINT RECEIPT</button>
                            <!-- NEW BUTTON: Resets form but KEEPS recent orders -->
                            <button class="btn-proceed" style="background: #0f172a; padding: 10px 20px; border-radius: 40px;" onclick="resetFormAndClose()">NEW</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ------------------------------------------------------------
        //  MASTER PRICE MATRIX – BASE RATES PER MATERIAL PER SPEED
        // ------------------------------------------------------------
        const BASE_PRICES = {
            thin:   { base: 15, next: 18, same: 20, rush: 25 },
            standard: { base: 20, next: 25, same: 30, rush: 40 },
            heavy:  { base: 30, next: 35, same: 40, rush: 50 },
            blockout: { base: 50, next: 60, same: 75, rush: 100 }
        };

        const CUSTOM_ADDON = 10;
        const SENIOR_PWD_DISCOUNT = 0.20; // 20%
        const WHOLESALE_DISCOUNT = 0.15;   // 15%
        const WHOLESALE_MIN_QTY = 5;        // Minimum quantity for wholesale
        
        // ---------- PERSISTENT RECENT ORDERS STORAGE ----------
        let recentOrders = [];

        // Current selections
        let currentMaterial = 'standard';
        let currentSpeed = 'base';
        let currentBaseRate = 20;
        let currentAddOn = 0;
        let selectedOnlineProvider = 'GCash';
        let currentEyelets = 4;
        
        // Discount flags
        let isSeniorOrPWDActive = false;
        let isWholesaleActive = false;
        let finalDiscountedPrice = 60;

        // ----- DOM REFERENCES -----
        const widthInput = document.getElementById('widthFt');
        const heightInput = document.getElementById('heightFt');
        const totalPrice = document.getElementById('totalPrice');
        const originalPriceDisplay = document.getElementById('originalPriceDisplay');
        const bannerVisual = document.getElementById('bannerVisual');
        const eyeletLayer = document.getElementById('eyeletLayer');
        const toggleHoriz = document.getElementById('toggleHoriz');
        const toggleVert = document.getElementById('toggleVert');
        const layoutOwn = document.getElementById('layoutOwn');
        const layoutInksite = document.getElementById('layoutInksite');
        const customerName = document.getElementById('customerName');
        const customerEmail = document.getElementById('customerEmail');
        const customerContact = document.getElementById('customerContact');
        const quantityInput = document.getElementById('quantityInput');
        const materialSelect = document.getElementById('materialSelect');
        const speedSelect = document.getElementById('speedSelect');
        const tarpPreviewImg = document.getElementById('tarpPreviewImage');
        const ownFileInput = document.getElementById('ownFileInput');
        const ownDesignForm = document.getElementById('ownDesignForm');
        const inksiteDesignForm = document.getElementById('inksiteDesignForm');
        const sizeLabelAbove = document.getElementById('sizeLabelAbove');
        const ownRateLabel = document.getElementById('ownRateLabel');
        const customRateLabel = document.getElementById('customRateLabel');
        const discountBadges = document.getElementById('discountBadges');

        // Discount elements
        const seniorDiscountCheck = document.getElementById('seniorDiscount');
        const pwdDiscountCheck = document.getElementById('pwdDiscount');
        const wholesaleDiscountCheck = document.getElementById('wholesaleDiscount');
        const seniorPwdDocs = document.getElementById('seniorPwdDocs');
        const wholesaleInfo = document.getElementById('wholesaleInfo');
        const priceBreakdown = document.getElementById('priceBreakdown');
        const subtotalAmount = document.getElementById('subtotalAmount');
        const seniorPwdDiscountAmount = document.getElementById('seniorPwdDiscountAmount');
        const wholesaleDiscountAmount = document.getElementById('wholesaleDiscountAmount');
        const totalAfterDiscounts = document.getElementById('totalAfterDiscounts');
        const rowSeniorPwdDiscount = document.getElementById('rowSeniorPwdDiscount');
        const rowWholesaleDiscount = document.getElementById('rowWholesaleDiscount');
        const rcpDiscountsLine = document.getElementById('rcpDiscountsLine');
        const rcpDiscounts = document.getElementById('rcpDiscounts');

        // Price display spans
        const priceSpans = {
            thin: { base: document.getElementById('price-thin-base'), next: document.getElementById('price-thin-next'), same: document.getElementById('price-thin-same'), rush: document.getElementById('price-thin-rush') },
            standard: { base: document.getElementById('price-standard-base'), next: document.getElementById('price-standard-next'), same: document.getElementById('price-standard-same'), rush: document.getElementById('price-standard-rush') },
            heavy: { base: document.getElementById('price-heavy-base'), next: document.getElementById('price-heavy-next'), same: document.getElementById('price-heavy-same'), rush: document.getElementById('price-heavy-rush') },
            blockout: { base: document.getElementById('price-blockout-base'), next: document.getElementById('price-blockout-next'), same: document.getElementById('price-blockout-same'), rush: document.getElementById('price-blockout-rush') }
        };

        const inflateInputs = {
            thin: document.getElementById('inflate-thin'),
            standard: document.getElementById('inflate-standard'),
            heavy: document.getElementById('inflate-heavy'),
            blockout: document.getElementById('inflate-blockout')
        };

        const materialCards = {
            thin: document.getElementById('card-thin'),
            standard: document.getElementById('card-standard'),
            heavy: document.getElementById('card-heavy'),
            blockout: document.getElementById('card-blockout')
        };

        const presetChips = document.querySelectorAll('#presetGrid .chip');

        // ----- DISCOUNT FUNCTIONS -----
        function toggleSeniorPWDInputs() {
            // Senior and PWD are mutually exclusive
            if (seniorDiscountCheck.checked && pwdDiscountCheck.checked) {
                // Uncheck the second one if both are checked
                if (event && event.target.id === 'seniorDiscount') {
                    pwdDiscountCheck.checked = false;
                } else if (event && event.target.id === 'pwdDiscount') {
                    seniorDiscountCheck.checked = false;
                }
            }
            
            isSeniorOrPWDActive = seniorDiscountCheck.checked || pwdDiscountCheck.checked;
            
            if (isSeniorOrPWDActive) {
                seniorPwdDocs.classList.remove('hidden');
                wholesaleDiscountCheck.checked = false; // Auto-uncheck wholesale (no double discount)
                isWholesaleActive = false;
                wholesaleDiscountCheck.disabled = true; // Disable wholesale if senior/PWD active
            } else {
                seniorPwdDocs.classList.add('hidden');
                wholesaleDiscountCheck.disabled = false;
            }
            
            update();
        }

        function toggleWholesaleDiscount() {
            isWholesaleActive = wholesaleDiscountCheck.checked;
            
            if (isWholesaleActive) {
                // Uncheck senior/PWD if wholesale is checked
                seniorDiscountCheck.checked = false;
                pwdDiscountCheck.checked = false;
                isSeniorOrPWDActive = false;
                seniorPwdDocs.classList.add('hidden');
                seniorDiscountCheck.disabled = true;
                pwdDiscountCheck.disabled = true;
            } else {
                seniorDiscountCheck.disabled = false;
                pwdDiscountCheck.disabled = false;
            }
            
            update();
        }

        function calculateDiscountedPrice(subtotal) {
            let discountAmount = 0;
            let discountType = '';
            let discountPercent = 0;
            
            // Apply only one discount type (highest priority: Senior/PWD > Wholesale)
            if (isSeniorOrPWDActive) {
                discountAmount = subtotal * SENIOR_PWD_DISCOUNT;
                discountPercent = SENIOR_PWD_DISCOUNT * 100;
                discountType = seniorDiscountCheck.checked ? 'Senior' : 'PWD';
            } else if (isWholesaleActive && parseInt(quantityInput.value) >= WHOLESALE_MIN_QTY) {
                discountAmount = subtotal * WHOLESALE_DISCOUNT;
                discountPercent = WHOLESALE_DISCOUNT * 100;
                discountType = 'Wholesale';
            }
            
            return {
                subtotal: subtotal,
                discountAmount: discountAmount,
                discountPercent: discountPercent,
                discountType: discountType,
                final: subtotal - discountAmount
            };
        }

        // ----- UPDATE ALL MATERIAL PRICES (inflation applied to all speeds) -----
        function updateAllMaterialRates() {
            for (let mat in BASE_PRICES) {
                let add = parseFloat(inflateInputs[mat].value) || 0;
                for (let speed in BASE_PRICES[mat]) {
                    let newPrice = BASE_PRICES[mat][speed] + add;
                    if (priceSpans[mat][speed]) {
                        priceSpans[mat][speed].textContent = `₱${newPrice}`;
                    }
                }
            }
            updateRateFromSelections();
        }

        // ----- UPDATE CURRENT RATE based on selected material, speed, and inflation -----
        function updateRateFromSelections() {
            currentMaterial = materialSelect.value;
            currentSpeed = speedSelect.value;

            for (let mat in materialCards) {
                if (mat === currentMaterial) {
                    materialCards[mat].classList.add('active-material');
                } else {
                    materialCards[mat].classList.remove('active-material');
                }
            }

            let add = parseFloat(inflateInputs[currentMaterial].value) || 0;
            currentAddOn = add;
            let baseSpeedPrice = BASE_PRICES[currentMaterial][currentSpeed];
            currentBaseRate = baseSpeedPrice + add;

            ownRateLabel.textContent = `Own Design (₱${currentBaseRate}/sqft)`;
            customRateLabel.textContent = `Custom Service (₱${currentBaseRate + CUSTOM_ADDON}/sqft)`;

            update();
        }

        // ----- QUANTITY -----
        function incrementQuantity() {
            quantityInput.value = parseInt(quantityInput.value || 1) + 1;
            checkWholesaleEligibility();
            update();
        }
        function decrementQuantity() {
            let val = parseInt(quantityInput.value || 1);
            if (val > 1) quantityInput.value = val - 1;
            checkWholesaleEligibility();
            update();
        }
        
        function checkWholesaleEligibility() {
            const qty = parseInt(quantityInput.value) || 1;
            if (qty >= WHOLESALE_MIN_QTY) {
                wholesaleInfo.classList.remove('hidden');
                // Auto-check wholesale if eligible and no senior/PWD
                if (!isSeniorOrPWDActive && !wholesaleDiscountCheck.checked) {
                    wholesaleDiscountCheck.checked = true;
                    isWholesaleActive = true;
                    seniorDiscountCheck.disabled = true;
                    pwdDiscountCheck.disabled = true;
                }
            } else {
                wholesaleInfo.classList.add('hidden');
                if (wholesaleDiscountCheck.checked) {
                    wholesaleDiscountCheck.checked = false;
                    isWholesaleActive = false;
                }
                seniorDiscountCheck.disabled = false;
                pwdDiscountCheck.disabled = false;
            }
        }

        // ----- DIMENSION HIGHLIGHT -----
        function clearPresetActive() {
            presetChips.forEach(chip => chip.classList.remove('active'));
        }
        function syncPresetHighlight() {
            const w = parseFloat(widthInput.value) || 0;
            const h = parseFloat(heightInput.value) || 0;
            presetChips.forEach(chip => {
                const cw = parseFloat(chip.dataset.w);
                const ch = parseFloat(chip.dataset.h);
                if (cw === w && ch === h) chip.classList.add('active');
                else chip.classList.remove('active');
            });
        }

        // ----- MAIN UPDATE -----
        function update() {
            let w = parseFloat(widthInput.value) || 0;
            let h = parseFloat(heightInput.value) || 0;

            if (toggleHoriz.checked && h > w) {
                [w, h] = [h, w];
                widthInput.value = w;
                heightInput.value = h;
            } else if (toggleVert.checked && w > h) {
                [w, h] = [h, w];
                widthInput.value = w;
                heightInput.value = h;
            }

            const rate = layoutOwn.checked ? currentBaseRate : (currentBaseRate + CUSTOM_ADDON);
            const qty = parseInt(quantityInput.value) || 1;
            const subtotal = w * h * rate * qty;
            
            // Calculate discounts
            const discountResult = calculateDiscountedPrice(subtotal);
            finalDiscountedPrice = discountResult.final;
            
            // Update price displays
            if (discountResult.discountAmount > 0) {
                originalPriceDisplay.textContent = `₱${subtotal.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
                originalPriceDisplay.style.display = 'inline';
                totalPrice.textContent = `₱${finalDiscountedPrice.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
                
                // Show price breakdown
                priceBreakdown.classList.remove('hidden');
                subtotalAmount.textContent = `₱${subtotal.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
                
                if (isSeniorOrPWDActive) {
                    rowSeniorPwdDiscount.classList.remove('hidden');
                    seniorPwdDiscountAmount.textContent = `-₱${discountResult.discountAmount.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
                    rowWholesaleDiscount.classList.add('hidden');
                } else if (isWholesaleActive) {
                    rowWholesaleDiscount.classList.remove('hidden');
                    wholesaleDiscountAmount.textContent = `-₱${discountResult.discountAmount.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
                    rowSeniorPwdDiscount.classList.add('hidden');
                }
                
                totalAfterDiscounts.textContent = `₱${finalDiscountedPrice.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
                
                // Show discount badges
                let badgeHtml = '';
                if (isSeniorOrPWDActive) {
                    badgeHtml += `<span style="background: var(--discount-bg); color: var(--discount-badge); padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 800;">${discountResult.discountType} 20% OFF</span>`;
                }
                if (isWholesaleActive) {
                    badgeHtml += `<span style="background: var(--discount-bg); color: var(--discount-badge); padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 800;">WHOLESALE 15% OFF</span>`;
                }
                discountBadges.innerHTML = badgeHtml;
            } else {
                originalPriceDisplay.style.display = 'none';
                totalPrice.textContent = `₱${subtotal.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
                finalDiscountedPrice = subtotal;
                priceBreakdown.classList.add('hidden');
                discountBadges.innerHTML = '';
            }

            ownDesignForm.classList.toggle('hidden', !layoutOwn.checked);
            inksiteDesignForm.classList.toggle('hidden', !layoutInksite.checked);

            sizeLabelAbove.innerHTML = `${w} × ${h} ft`;

            const max = 340;
            const scale = Math.min(max / (w || 1), max / (h || 1));
            bannerVisual.style.width = (w * scale) + 'px';
            bannerVisual.style.height = (h * scale) + 'px';

            renderEyelets();
            syncPresetHighlight();

            if (layoutOwn.checked && tarpPreviewImg.src && tarpPreviewImg.src !== '') {
                tarpPreviewImg.style.display = 'block';
            } else {
                tarpPreviewImg.style.display = 'none';
            }
            
            // Check wholesale eligibility
            checkWholesaleEligibility();
        }

        function renderEyelets() {
            eyeletLayer.innerHTML = '';
            if (currentEyelets === 0) return;
            const inset = "16px";
            const spots = currentEyelets === 2 ? [['top', 'left'], ['top', 'right']] : [['top', 'left'], ['top', 'right'], ['bottom', 'left'], ['bottom', 'right']];
            spots.forEach(pos => {
                const e = document.createElement('div');
                e.className = 'eyelet';
                e.style[pos[0]] = inset;
                e.style[pos[1]] = inset;
                eyeletLayer.appendChild(e);
            });
        }

        // ----- UPLOAD -----
        ownFileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    tarpPreviewImg.src = e.target.result;
                    tarpPreviewImg.style.display = 'block';
                    layoutOwn.checked = true;
                    update();
                };
                reader.readAsDataURL(file);
            }
        });

        layoutInksite.addEventListener('change', function() {
            tarpPreviewImg.style.display = 'none';
            update();
        });

        layoutOwn.addEventListener('change', function() {
            if (tarpPreviewImg.src && tarpPreviewImg.src !== '') {
                tarpPreviewImg.style.display = 'block';
            } else {
                tarpPreviewImg.style.display = 'none';
            }
            update();
        });

        // ----- PRESET CHIPS -----
        presetChips.forEach(chip => {
            chip.addEventListener('click', function(e) {
                clearPresetActive();
                this.classList.add('active');
                widthInput.value = this.dataset.w;
                heightInput.value = this.dataset.h;
                update();
            });
        });

        widthInput.addEventListener('input', function() { clearPresetActive(); update(); });
        heightInput.addEventListener('input', function() { clearPresetActive(); update(); });
        toggleHoriz.addEventListener('change', update);
        toggleVert.addEventListener('change', update);

        // Eyelet chips
        document.querySelectorAll('[data-eye]').forEach(chip => {
            chip.addEventListener('click', function() {
                currentEyelets = parseInt(this.dataset.eye);
                this.parentElement.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                renderEyelets();
            });
        });

        // ========== PAYMENT MODAL FUNCTIONS ==========
        function openModal(id) { document.getElementById(id).style.display = 'flex'; }
        function closeModal(id) { document.getElementById(id).style.display = 'none'; }

        function handlePaymentInitiation() {
            if (!customerName.value.trim() || !customerEmail.value.trim()) {
                alert('Please enter customer name and email address.');
                return;
            }
            const method = document.querySelector('input[name="paymethod"]:checked').value;
            const formatted = `₱${finalDiscountedPrice.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
            
            if (method === 'cash') {
                document.getElementById('cashModalTotal').textContent = formatted;
                document.getElementById('cashReceived').value = '';
                document.getElementById('cashChange').textContent = '₱0.00';
                openModal('cashModal');
            } else if (method === 'online') {
                document.querySelectorAll('.onlineModalTotal').forEach(el => el.textContent = formatted);
                openModal('onlineModal');
            } else {
                document.querySelectorAll('.onlineModalTotal').forEach(el => el.textContent = formatted);
                openModal('cardModal');
            }
        }

        function calcChange() {
            const rec = parseFloat(document.getElementById('cashReceived').value) || 0;
            const change = rec - finalDiscountedPrice;
            document.getElementById('cashChange').textContent = `₱${(change > 0 ? change : 0).toLocaleString(undefined, {minimumFractionDigits: 2})}`;
        }

        function switchOnlineTab(el, provider) {
            document.querySelectorAll('.online-tab').forEach(t => t.classList.remove('active'));
            el.classList.add('active');
            selectedOnlineProvider = provider;
            document.getElementById('qrLabel').textContent = provider + ' Payment';
            const colors = { GCash: '#007bff', Maya: '#28a745', PayPal: '#ffc107' };
            const qrIcon = document.querySelector('.qr-placeholder i');
            if (qrIcon) qrIcon.style.color = colors[provider];
        }

        function generateFinalReceipt(method, extraData = {}) {
            closeModal('cashModal'); closeModal('onlineModal'); closeModal('cardModal');
            
            const custName = customerName.value.trim() || 'Anonymous';
            const custEmail = customerEmail.value.trim() || '—';
            const custContact = customerContact.value.trim() || '—';
            const size = widthInput.value + 'ft × ' + heightInput.value + 'ft';
            const qty = parseInt(quantityInput.value) || 1;
            
            const materialNames = { thin: '10oz THIN', standard: '13oz STANDARD', heavy: '18oz HEAVY', blockout: '19-22oz BLOCKOUT' };
            const speedNames = { base: '1-2 Days', next: 'Next-Day', same: 'Same-Day', rush: 'Rush/Priority' };
            
            const materialDisplay = materialNames[currentMaterial] || '13oz STANDARD';
            const speedDisplay = speedNames[currentSpeed] || '1-2 Days';
            const designLabel = layoutOwn.checked ? `Own (₱${currentBaseRate})` : `Custom (₱${currentBaseRate + CUSTOM_ADDON})`;
            const eyeText = currentEyelets === 0 ? 'None' : (currentEyelets === 2 ? 'Top corners' : 'All 4 corners');
            
            // Discount info
            let discountText = '';
            if (isSeniorOrPWDActive) {
                discountText = (seniorDiscountCheck.checked ? 'Senior' : 'PWD') + ' 20% OFF';
                if (document.getElementById('idNumber').value) {
                    discountText += ' (ID: ' + document.getElementById('idNumber').value + ')';
                }
            } else if (isWholesaleActive) {
                discountText = 'Wholesale 15% OFF (Bulk Order)';
            }
            
            // ---------- ADD TO RECENT ORDERS (PERSISTENT) ----------
            const order = {
                customer: custName,
                material: materialDisplay,
                size: size,
                quantity: qty,
                designType: designLabel,
                amount: finalDiscountedPrice,
                discount: discountText || 'None'
            };
            recentOrders.push(order);
            renderRecentOrders();
            
            // Populate receipt
            document.getElementById('rcpDate').textContent = new Date().toLocaleDateString('en-PH', { year: 'numeric', month: 'short', day: 'numeric' }) + ' ' + new Date().toLocaleTimeString('en-PH', { hour: '2-digit', minute: '2-digit' });
            document.getElementById('rcpID').textContent = 'INK#' + Math.floor(Math.random()*90000 + 10000);
            document.getElementById('rcpCustomer').textContent = custName;
            document.getElementById('rcpEmailContact').textContent = custEmail + (custContact ? ' / ' + custContact : '');
            document.getElementById('rcpMaterial').textContent = materialDisplay;
            document.getElementById('rcpSpeed').textContent = speedDisplay;
            document.getElementById('rcpSize').textContent = size;
            document.getElementById('rcpQuantity').textContent = qty;
            document.getElementById('rcpLayout').textContent = designLabel;
            document.getElementById('rcpEyelet').textContent = eyeText;
            document.getElementById('rcpMethod').textContent = method;
            document.getElementById('rcpTotal').textContent = `₱${finalDiscountedPrice.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
            
            // Discount line on receipt
            if (discountText) {
                rcpDiscountsLine.classList.remove('hidden');
                rcpDiscounts.textContent = discountText;
            } else {
                rcpDiscountsLine.classList.add('hidden');
            }
            
            const cashDetails = document.getElementById('rcpCashDetails');
            if (extraData.cashRec) {
                cashDetails.style.display = 'block';
                document.getElementById('rcpRec').textContent = `₱${extraData.cashRec.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
                document.getElementById('rcpChange').textContent = `₱${extraData.change.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
            } else { cashDetails.style.display = 'none'; }
            
            openModal('receiptModal');
        }

        function completeCashPayment() {
            const rec = parseFloat(document.getElementById('cashReceived').value) || 0;
            if (rec < finalDiscountedPrice) { alert('Insufficient cash received'); return; }
            generateFinalReceipt('CASH', { cashRec: rec, change: rec - finalDiscountedPrice });
        }
        function completeOnlinePayment() { generateFinalReceipt('ONLINE · ' + selectedOnlineProvider); }
        function completeCardPayment() { generateFinalReceipt('CREDIT/DEBIT CARD'); }

        // ---------- RENDER RECENT ORDERS (from persistent array) ----------
        function renderRecentOrders() {
            const container = document.getElementById('orderListContainer');
            if (!container) return;
            if (recentOrders.length === 0) {
                container.innerHTML = '<div class="empty-orders">No completed transactions yet.</div>';
                return;
            }
            const latest = [...recentOrders].reverse().slice(0, 5);
            let html = '';
            latest.forEach(order => {
                html += `
                    <div class="order-item">
                        <div class="order-info">
                            <span class="order-customer">${order.customer || 'Guest'}</span>
                            <span class="order-details">
                                <span>${order.material}</span> • ${order.size} • Qty: ${order.quantity}
                                ${order.discount && order.discount !== 'None' ? `<span style="color: #e11d48; font-weight: 700;"> (${order.discount})</span>` : ''}
                            </span>
                        </div>
                        <div class="order-amount">₱${order.amount.toLocaleString()}</div>
                    </div>
                `;
            });
            container.innerHTML = html;
        }

        // ---------- RESET FORM BUT KEEP RECENT ORDERS (NEW BUTTON) ----------
        function resetFormAndClose() {
            // Close receipt modal
            closeModal('receiptModal');
            
            // Reset form fields to defaults
            customerName.value = 'Maria Santos';
            customerEmail.value = 'maria.santos@email.com';
            customerContact.value = '0918 765 4321';
            
            widthInput.value = 1;
            heightInput.value = 3;
            quantityInput.value = 1;
            
            // Reset material and speed to default (standard, base)
            materialSelect.value = 'standard';
            speedSelect.value = 'base';
            
            // Reset inflation add-ons to 0
            document.getElementById('inflate-thin').value = 0;
            document.getElementById('inflate-standard').value = 0;
            document.getElementById('inflate-heavy').value = 0;
            document.getElementById('inflate-blockout').value = 0;
            
            // Reset layout to Own Design
            layoutOwn.checked = true;
            
            // Reset eyelets to 4 corners
            currentEyelets = 4;
            document.querySelectorAll('[data-eye]').forEach(chip => {
                chip.classList.remove('active');
                if (chip.dataset.eye == 4) chip.classList.add('active');
            });
            
            // Clear uploaded image preview
            tarpPreviewImg.src = '';
            tarpPreviewImg.style.display = 'none';
            
            // Clear file input
            ownFileInput.value = '';
            
            // Reset discounts
            seniorDiscountCheck.checked = false;
            pwdDiscountCheck.checked = false;
            wholesaleDiscountCheck.checked = false;
            seniorDiscountCheck.disabled = false;
            pwdDiscountCheck.disabled = false;
            wholesaleDiscountCheck.disabled = false;
            isSeniorOrPWDActive = false;
            isWholesaleActive = false;
            seniorPwdDocs.classList.add('hidden');
            document.getElementById('idNumber').value = '';
            
            // Update all rates and UI
            updateAllMaterialRates();
            
            // RECENT ORDERS ARE NOT CLEARED – they remain visible
        }

        // Expose globals
        window.updateAllMaterialRates = updateAllMaterialRates;
        window.updateRateFromSelections = updateRateFromSelections;
        window.incrementQuantity = incrementQuantity;
        window.decrementQuantity = decrementQuantity;
        window.update = update;
        window.handlePaymentInitiation = handlePaymentInitiation;
        window.calcChange = calcChange;
        window.switchOnlineTab = switchOnlineTab;
        window.completeCashPayment = completeCashPayment;
        window.completeOnlinePayment = completeOnlinePayment;
        window.completeCardPayment = completeCardPayment;
        window.closeModal = closeModal;
        window.resetFormAndClose = resetFormAndClose;
        window.toggleSeniorPWDInputs = toggleSeniorPWDInputs;
        window.toggleWholesaleDiscount = toggleWholesaleDiscount;
        window.checkWholesaleEligibility = checkWholesaleEligibility;

        // Initialize
        updateAllMaterialRates();
        renderRecentOrders();
    </script>
</body>
</html>
