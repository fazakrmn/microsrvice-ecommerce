<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Microservices Dashboard</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Premium Styles -->
    <style>
        :root {
            --bg-color: #0b0f19;
            --sidebar-bg: rgba(17, 24, 39, 0.7);
            --card-bg: rgba(30, 41, 59, 0.45);
            --card-border: rgba(255, 255, 255, 0.08);
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            
            --accent-blue: #3b82f6;
            --accent-cyan: #06b6d4;
            --accent-purple: #a855f7;
            --accent-green: #10b981;
            --accent-red: #ef4444;
            
            --shadow-neon: 0 0 15px rgba(59, 130, 246, 0.3);
            --transition-speed: 0.3s;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-primary);
            overflow-x: hidden;
            background-image: 
                radial-gradient(at 10% 10%, rgba(59, 130, 246, 0.15) 0px, transparent 50%),
                radial-gradient(at 90% 80%, rgba(168, 85, 247, 0.15) 0px, transparent 50%);
            min-height: 100vh;
        }

        /* Layout Structure */
        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-right: 1px solid var(--card-border);
            padding: 2.5rem 1.5rem;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 10;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 3rem;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-cyan));
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-neon);
        }

        .brand-logo svg {
            width: 22px;
            height: 22px;
            fill: #fff;
        }

        .brand-title {
            font-size: 1.25rem;
            font-weight: 800;
            background: linear-gradient(to right, #ffffff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .nav-item a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-secondary);
            text-decoration: none;
            padding: 0.85rem 1rem;
            border-radius: 10px;
            font-weight: 500;
            transition: all var(--transition-speed);
        }

        .nav-item.active a, .nav-item a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
            border-left: 3px solid var(--accent-blue);
        }

        .system-status {
            margin-top: auto;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--card-border);
            border-radius: 14px;
            padding: 1rem;
        }

        .status-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-secondary);
            margin-bottom: 0.75rem;
            font-weight: 700;
        }

        .status-indicator {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: var(--accent-green);
            box-shadow: 0 0 10px var(--accent-green);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 280px;
            flex-grow: 1;
            padding: 2.5rem 3rem;
            max-width: 1600px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
        }

        .header-title h1 {
            font-size: 2rem;
            font-weight: 850;
            letter-spacing: -0.025em;
            margin-bottom: 0.25rem;
        }

        .header-title p {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            padding: 0.6rem 1.2rem;
            border-radius: 100px;
            backdrop-filter: blur(10px);
        }

        .avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .user-info {
            text-align: left;
        }

        .user-name {
            font-size: 0.85rem;
            font-weight: 600;
            display: block;
        }

        .user-role {
            font-size: 0.7rem;
            color: var(--text-secondary);
            display: block;
        }

        /* Notification Alert */
        .alert {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #d1fae5;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(10px);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fee2e2;
        }

        /* Grid Layouts */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 1.75rem;
            position: relative;
            overflow: hidden;
            transition: transform var(--transition-speed), border-color var(--transition-speed);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 255, 255, 0.15);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-blue), var(--accent-cyan));
            opacity: 0.6;
        }

        .stat-card.purple::before {
            background: linear-gradient(90deg, var(--accent-purple), #d946ef);
        }
        .stat-card.green::before {
            background: linear-gradient(90deg, var(--accent-green), #34d399);
        }
        .stat-card.red::before {
            background: linear-gradient(90deg, var(--accent-red), #fb7185);
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            margin-top: 0.5rem;
            letter-spacing: -0.03em;
        }

        .stat-sub {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stat-sub span {
            color: var(--accent-green);
            font-weight: 600;
        }

        /* Two Column Layout */
        .content-row {
            display: grid;
            grid-template-columns: 2fr 1.2fr;
            gap: 2rem;
            margin-bottom: 2.5rem;
        }

        .panel {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 2rem;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.75rem;
        }

        .panel-title {
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: -0.015em;
        }

        /* Product Cards & Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.25rem;
        }

        .product-card {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 1.25rem;
            transition: all var(--transition-speed);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .product-card:hover {
            border-color: rgba(59, 130, 246, 0.4);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        .product-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: rgba(59, 130, 246, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-blue);
            margin-bottom: 1rem;
        }

        .product-name {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--accent-cyan);
            margin-bottom: 1.25rem;
        }

        /* Table Styling */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .data-table th {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--card-border);
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
        }

        .data-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            font-size: 0.9rem;
            vertical-align: middle;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        /* Form Controls & Inputs */
        .btn {
            background: var(--accent-blue);
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            font-family: inherit;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 10px;
            cursor: pointer;
            transition: all var(--transition-speed);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
        }

        .btn:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
            box-shadow: var(--shadow-neon);
        }

        .btn-sm {
            padding: 0.45rem 0.85rem;
            font-size: 0.8rem;
            border-radius: 8px;
        }

        .btn-danger {
            background: var(--accent-red);
        }

        .btn-danger:hover {
            box-shadow: 0 0 15px rgba(239, 68, 68, 0.3);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--card-border);
            color: var(--text-primary);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.05);
            box-shadow: none;
        }

        .btn-gradient {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.8rem;
            color: var(--text-secondary);
            font-weight: 600;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        .form-control {
            width: 100%;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid var(--card-border);
            color: #fff;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.9rem;
            transition: border-color var(--transition-speed);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-blue);
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.6rem;
            font-size: 0.75rem;
            font-weight: 700;
            border-radius: 100px;
            text-transform: uppercase;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.15);
            color: #a7f3d0;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.15);
            color: #fde68a;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        /* Microservice Diagram Visualizer */
        .topology-panel {
            margin-top: 3rem;
            background: rgba(15, 23, 42, 0.4);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
        }

        .topology-title {
            margin-bottom: 2.5rem;
        }

        .topology-title h3 {
            font-size: 1.5rem;
            font-weight: 800;
        }

        .topology-title p {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }

        .topology-map {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .topology-row {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            width: 100%;
            flex-wrap: wrap;
        }

        .topo-node {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid var(--card-border);
            padding: 1rem 1.5rem;
            border-radius: 16px;
            min-width: 160px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
            transition: all var(--transition-speed);
        }

        .topo-node:hover {
            border-color: var(--accent-blue);
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.2);
        }

        .topo-node.client {
            border-color: var(--accent-purple);
            background: rgba(168, 85, 247, 0.1);
        }

        .topo-node.gateway {
            border-color: var(--accent-cyan);
            background: rgba(6, 182, 212, 0.1);
            font-weight: 700;
            padding: 1.25rem 2rem;
        }

        .topo-node.service {
            border-color: var(--accent-blue);
        }

        .node-name {
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .node-port {
            font-family: 'Fira Code', monospace;
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        /* Custom Visual Connectors */
        .topo-arrow-vertical {
            width: 2px;
            height: 30px;
            background: linear-gradient(180deg, var(--accent-purple), var(--accent-cyan));
            position: relative;
        }

        .topo-arrow-vertical::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: -4px;
            width: 10px;
            height: 10px;
            border-bottom: 2px solid var(--accent-cyan);
            border-right: 2px solid var(--accent-cyan);
            transform: rotate(45deg);
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--text-secondary);
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="brand">
                <div class="brand-logo">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <div>
                    <h2 class="brand-title">LaraEcom</h2>
                    <span style="font-size: 0.65rem; color: var(--accent-cyan); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Microservice Client</span>
                </div>
            </div>

            <nav>
                <ul class="nav-menu">
                    <li class="nav-item active">
                        <a href="#dashboard">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/></svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#katalog">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            Katalog Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#keranjang">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Keranjang Belanja
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#pesanan">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                            Pesanan & Pembayaran
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="system-status">
                <span class="status-title">Status Gateway</span>
                <div class="status-indicator">
                    <span class="status-dot"></span>
                    <span>Terhubung ke Docker</span>
                </div>
            </div>
        </aside>

        <!-- Main Body -->
        <main class="main-content">
            <header>
                <div class="header-title">
                    <h1>E-Commerce Microservices</h1>
                    <p>Integrasi Laravel Client dengan Node.js Microservices melalui Docker</p>
                </div>
                
                <!-- Account Profile from akun-service -->
                @if($account)
                <div class="user-profile">
                    <div class="avatar">{{ substr($account['name'], 0, 1) }}</div>
                    <div class="user-info">
                        <span class="user-name">{{ $account['name'] }}</span>
                        <span class="user-role">{{ $account['email'] }}</span>
                    </div>
                </div>
                @else
                <div class="user-profile">
                    <div class="avatar">G</div>
                    <div class="user-info">
                        <span class="user-name">Guest Account</span>
                        <span class="user-role">akun-service offline</span>
                    </div>
                </div>
                @endif
            </header>

            <!-- Alerts -->
            @if(session('success'))
            <div class="alert">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" style="background:none; border:none; color:#fff; cursor:pointer; font-weight:bold;">&times;</button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-error">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" style="background:none; border:none; color:#fff; cursor:pointer; font-weight:bold;">&times;</button>
            </div>
            @endif

            <!-- Quick Metrics Grid -->
            <section class="dashboard-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Produk</div>
                    <div class="stat-value">{{ count($products) }}</div>
                    <div class="stat-sub">Aktif di <span>produk-service</span></div>
                </div>
                <div class="stat-card purple">
                    <div class="stat-label">Keranjang Belanja</div>
                    <div class="stat-value">{{ count($cart) }}</div>
                    <div class="stat-sub">Item di <span>keranjang-service</span></div>
                </div>
                <div class="stat-card green">
                    <div class="stat-label">Total Pesanan</div>
                    <div class="stat-value">{{ count($orders) }}</div>
                    <div class="stat-sub">Tercatat di <span>pesanan-service</span></div>
                </div>
                <div class="stat-card red">
                    <div class="stat-label">Total Transaksi</div>
                    <div class="stat-value">{{ count($payments) }}</div>
                    <div class="stat-sub">Lunas di <span>payment-service</span></div>
                </div>
            </section>

            <!-- Main Sections Row -->
            <div class="content-row">
                
                <!-- Left Column: Products List -->
                <section class="panel" id="katalog">
                    <div class="panel-header">
                        <h3 class="panel-title">Katalog Produk</h3>
                        <span style="font-size: 0.8rem; color: var(--accent-cyan); font-family: 'Fira Code', monospace;">produk-service (3001)</span>
                    </div>
                    
                    @if(empty($products))
                    <div class="empty-state">Tidak ada produk tersedia. Silakan tambahkan beberapa melalui form di samping.</div>
                    @else
                    <div class="products-grid">
                        @foreach($products as $product)
                        <div class="product-card">
                            <div>
                                <div class="product-icon">
                                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                                </div>
                                <h4 class="product-name">{{ $product['name'] }}</h4>
                            </div>
                            <div>
                                <div class="product-price">Rp {{ number_format($product['price'], 0, ',', '.') }}</div>
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ $product['name'] }}">
                                    <input type="hidden" name="price" value="{{ $product['price'] }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-sm btn-outline" style="width: 100%;">+ Keranjang</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </section>

                <!-- Right Column: Add Product Form -->
                <section class="panel">
                    <div class="panel-header">
                        <h3 class="panel-title">Tambah Produk Baru</h3>
                    </div>
                    <form action="{{ route('products.add') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="prod_name">Nama Produk</label>
                            <input type="text" id="prod_name" name="name" class="form-control" placeholder="Contoh: Keyboard Mechanical" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="prod_price">Harga (Rupiah)</label>
                            <input type="number" id="prod_price" name="price" class="form-control" placeholder="Contoh: 1200000" required>
                        </div>
                        <button type="submit" class="btn btn-gradient" style="width: 100%;">Simpan ke Database</button>
                    </form>
                </section>
            </div>

            <!-- Cart Section -->
            <section class="panel" id="keranjang" style="margin-bottom: 2.5rem;">
                <div class="panel-header">
                    <h3 class="panel-title">Keranjang Belanja Anda</h3>
                    <span style="font-size: 0.8rem; color: var(--accent-purple); font-family: 'Fira Code', monospace;">keranjang-service (3004)</span>
                </div>
                
                @if(empty($cart))
                <div class="empty-state">Keranjang Anda kosong. Tambahkan beberapa produk di atas!</div>
                @else
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nama Item</th>
                            <th>Harga Unit</th>
                            <th>Kuantitas</th>
                            <th>Subtotal</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                        <tr>
                            <td style="font-weight: 600;">{{ $item['name'] }}</td>
                            <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td>{{ $item['quantity'] }}x</td>
                            <td style="font-weight: 700; color: var(--accent-cyan);">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                            <td style="text-align: right;">
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr style="background: rgba(255,255,255,0.01); border-top: 2px solid var(--card-border);">
                            <td colspan="3" style="font-weight: 800; font-size: 1.1rem; text-align: right; padding: 1.5rem;">Total Belanja:</td>
                            <td style="font-weight: 850; font-size: 1.25rem; color: var(--accent-cyan); padding: 1.5rem;">Rp {{ number_format($cartTotal, 0, ',', '.') }}</td>
                            <td style="text-align: right; padding: 1.5rem;">
                                <form action="{{ route('cart.checkout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-gradient">Lakukan Checkout & Bayar</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @endif
            </section>

            <!-- Orders and Payments Column Grid -->
            <div class="content-row" id="pesanan">
                
                <!-- Orders Panel -->
                <section class="panel">
                    <div class="panel-header">
                        <h3 class="panel-title">Daftar Pesanan</h3>
                        <span style="font-size: 0.8rem; color: var(--accent-green); font-family: 'Fira Code', monospace;">pesanan-service (3002)</span>
                    </div>

                    @if(empty($orders))
                    <div class="empty-state">Belum ada pesanan yang dibuat.</div>
                    @else
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Product ID</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td style="font-family: 'Fira Code', monospace; font-weight: 600;">#ORD-{{ $order['id'] }}</td>
                                <td>PROD-{{ $order['productId'] }}</td>
                                <td>{{ $order['quantity'] }}</td>
                                <td style="font-weight: 700;">Rp {{ number_format($order['total'], 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge badge-success">{{ $order['status'] ?? 'pending' }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </section>

                <!-- Payments Panel -->
                <section class="panel">
                    <div class="panel-header">
                        <h3 class="panel-title">Log Pembayaran</h3>
                        <span style="font-size: 0.8rem; color: var(--accent-red); font-family: 'Fira Code', monospace;">payment-service (3005)</span>
                    </div>

                    @if(empty($payments))
                    <div class="empty-state">Belum ada transaksi pembayaran.</div>
                    @else
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>Order ID</th>
                                <th>Jumlah Bayar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td style="font-family: 'Fira Code', monospace; font-weight: 600;">#PAY-{{ $payment['id'] }}</td>
                                <td>#ORD-{{ $payment['orderId'] }}</td>
                                <td style="font-weight: 700; color: var(--accent-green);">Rp {{ number_format($payment['amount'], 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge badge-success">{{ $payment['status'] }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </section>
            </div>

            <!-- Topology Visualization Map -->
            <section class="topology-panel">
                <div class="topology-title">
                    <h3>Peta Arsitektur Microservices</h3>
                    <p>Struktur hubungan antar service yang berjalan di dalam kontainer Docker</p>
                </div>
                
                <div class="topology-map">
                    <!-- Row 1: Laravel Client -->
                    <div class="topology-row">
                        <div class="topo-node client">
                            <div class="node-name">Laravel Client (Web Client)</div>
                            <div class="node-port">localhost:8000</div>
                        </div>
                    </div>
                    
                    <!-- Vertical line down to Gateway -->
                    <div class="topo-arrow-vertical"></div>
                    
                    <!-- Row 2: API Gateway -->
                    <div class="topology-row">
                        <div class="topo-node gateway">
                            <div class="node-name">API Gateway (Proxy)</div>
                            <div class="node-port">Port 3000</div>
                        </div>
                    </div>
                    
                    <!-- Vertical line down to Microservices -->
                    <div class="topo-arrow-vertical" style="background: linear-gradient(180deg, var(--accent-cyan), var(--accent-blue));"></div>
                    
                    <!-- Row 3: Node.js Backend Microservices -->
                    <div class="topology-row">
                        <div class="topo-node service">
                            <div class="node-name">produk-service</div>
                            <div class="node-port">Port 3001</div>
                        </div>
                        <div class="topo-node service">
                            <div class="node-name">pesanan-service</div>
                            <div class="node-port">Port 3002</div>
                        </div>
                        <div class="topo-node service">
                            <div class="node-name">akun-service</div>
                            <div class="node-port">Port 3003</div>
                        </div>
                        <div class="topo-node service">
                            <div class="node-name">keranjang-service</div>
                            <div class="node-port">Port 3004</div>
                        </div>
                        <div class="topo-node service">
                            <div class="node-name">payment-service</div>
                            <div class="node-port">Port 3005</div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
