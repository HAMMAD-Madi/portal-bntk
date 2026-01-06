<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #2679613 - BNTK Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .logo {
            /*padding: 0 20px 20px 20px;*/
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }

        .main-content {
            flex: 1;
            background-color: #4CAF50;
            height: 300px;
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .back-btn {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .back-btn:hover {
            background: rgba(255,255,255,0.3);
        }

        .order-title {
            font-size: 24px;
            font-weight: normal;
        }

        .order-subtitle {
            font-size: 14px;
            opacity: 0.9;
            margin-top: 4px;
        }

        .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .header-btn {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            border: none;
        }

        .header-btn:hover {
            background: rgba(255,255,255,0.3);
        }

        .header-btn.primary {
            background: #2196F3;
            border-color: #2196F3;
        }

        .content {
            background-color: white;
            margin: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .payment-alert {
            background: #FFEBEE;
            border-left: 4px solid #F44336;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 0;
        }

        .alert-icon {
            color: #F44336;
            font-size: 18px;
        }

        .alert-text {
            color: #C62828;
            font-weight: 500;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .info-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 16px;
        }

        .info-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .info-title {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .info-actions {
            display: flex;
            gap: 8px;
        }

        .info-action {
            color: #666;
            cursor: pointer;
            font-size: 14px;
            padding: 2px;
        }

        .info-action:hover {
            color: #4CAF50;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .info-label {
            color: #666;
        }

        .info-value {
            color: #333;
            font-weight: 500;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-processing {
            background-color: #D1ECF1;
            color: #0C5460;
        }

        .status-pending {
            background-color: #FFF3CD;
            color: #856404;
        }

        .parts-section {
            padding: 20px;
        }

        .parts-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .parts-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .parts-actions {
            display: flex;
            gap: 8px;
        }

        .parts-action, .timer-btn, .export-pdf-btn, .toggle-all-btn {
            background: #f8f9fa;
            border: 1px solid #ddd;
            color: #333;
            cursor: pointer;
            font-size: 12px;
            padding: 8px 12px;
            border-radius: 4px;
        }

        .parts-action:hover, .timer-btn:hover, .export-pdf-btn:hover, .toggle-all-btn:hover {
            background: #e9ecef;
        }

        .timer-btn.active {
            background: #4CAF50;
            color: white;
            border-color: #4CAF50;
        }

        .export-pdf-btn:disabled {
            background: #ccc;
            color: #999;
            cursor: not-allowed;
        }

        .efficiency-panel {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .efficiency-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 15px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #4CAF50;
        }

        .parts-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .parts-table th {
            background-color: #f8f9fa;
            padding: 12px 8px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
            font-weight: 600;
            color: #555;
            font-size: 12px;
            cursor: pointer;
        }

        .parts-table th.sortable-header:hover {
            background-color: #e9ecef;
        }

        .parts-table th.sorted {
            background-color: #4CAF50;
            color: white;
        }

        .parts-table td {
            padding: 12px 8px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        .parts-table tr:hover {
            background-color: #f8f9fa;
        }

        .parts-table tr.row-checked {
            background-color: #e8f5e8;
            opacity: 0.7;
        }

        .parts-table tr.route-highlight {
            background-color: #fff3cd;
            border-left: 3px solid #ffc107;
        }

        .parts-table tr.location-grouped {
            border-left: 3px solid #4CAF50;
        }

        .checkbox-cell {
            width: 40px;
            text-align: center;
        }

        .item-checkbox {
            transform: scale(1.2);
        }

        .part-image {
            width: 32px;
            height: 32px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: white;
            font-weight: bold;
        }

        .part-blue {
            background-color: #2196F3;
        }

        .part-yellow {
            background-color: #FFC107;
            color: #333;
        }

        .part-green {
            background-color: #4CAF50;
        }

        .part-black {
            background-color: #333;
        }

        .part-gray {
            background-color: #666;
        }

        .part-orange {
            background-color: #FF9800;
        }

        .part-red {
            background-color: #F44336;
        }

        .part-number {
            font-family: monospace;
            color: #666;
            font-size: 12px;
        }

        .item-timer {
            color: #4CAF50;
            font-size: 10px;
            font-weight: normal;
        }

        .condition-badge {
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .condition-used {
            background-color: red;
            color: white;
        }

        .condition-new {
            background-color: blue;
            color: white;
        }

        .location-cell {
            font-family: monospace;
            font-weight: bold;
            color: #4CAF50;
        }

        .price-cell {
            text-align: right;
            font-weight: 500;
        }

        .qty-cell {
            text-align: center;
            font-weight: 500;
        }

        .platform-icon {
            width: 20px;
            height: 20px;
            border-radius: 3px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 8px;
            margin-right: 8px;
        }

        .platform-icon.brickowl {
            background-color: #8B4513;
        }

        .progress-section {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e0e0e0;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .progress-fill {
            height: 100%;
            background: #4CAF50;
            width: 0;
            transition: width 0.3s ease;
        }

        .progress-text {
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                order: 2;
            }

            .main-content {
                order: 1;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 15px;
                padding: 15px;
            }

            .header {
                padding: 15px;
                flex-direction: column;
                gap: 10px;
            }

            .header-left {
                width: 100%;
            }

            .content {
                margin: 10px;
            }

            .parts-table {
                font-size: 12px;
            }

            .part-image {
                width: 24px;
                height: 24px;
                font-size: 8px;
            }

            .efficiency-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .parts-actions {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
    <style>
        .sidebar-wrapper {
          position: relative;       /* for ::before positioning */
          padding: 20px;            /* space around sidebar */
          box-sizing: border-box;
          height: 100vh;            /* keep sidebar full height */
        }
        
        /* Green background of only 300px height */
        .sidebar-wrapper::before {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          height: 300px;            /* only this height is green */
          background-color: #4CAF50;
          z-index: -1;              /* behind sidebar */
        }
        
        /* Sidebar stays full height and unchanged */
        .sidebar {
          width: 250px;
          height: 100%;             /* full height */
          background: rgba(255, 255, 255, 0.95);
          backdrop-filter: blur(20px);
          border-radius: 24px;
          box-shadow:
            0 20px 25px -5px rgba(0, 0, 0, 0.1),
            0 10px 10px -5px rgba(0, 0, 0, 0.04),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
          padding: 0;
          position: relative;       /* above ::before */
          z-index: 1;
          margin-left: 4px;
          margin-top: -3px;
        }

        .sidebar:hover {
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.3);
        }

        .logo-section {
            padding: 32px 24px 24px 24px;
            background: linear-gradient(135deg, #4CAF50 0%, #66BB6A 100%);
            border-radius: 15px 15px 0 0;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .logo-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {

            0%,
            100% {
                transform: translateX(-100%) translateY(-100%) rotate(0deg);
            }

            50% {
                transform: translateX(0%) translateY(0%) rotate(180deg);
            }
        }

        .logo {
            margin-top: -12px;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
            position: relative;
            z-index: 2;
        }

        .logo-subtitle {
            font-size: 13px;
            opacity: 0.9;
            font-weight: 500;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 2;
        }

        .nav-container {
            padding: 16px 0;
            max-height: calc(100vh - 200px);
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .nav-container::-webkit-scrollbar {
            display: none;
        }

        .nav-section {
            margin-bottom: 8px;
        }

        .nav-item {
            position: relative;
            margin: 0 12px;
            border-radius: 12px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            text-decoration: none;
            color: #374151;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border-radius: 12px;
        }

        .nav-item:hover .nav-link {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            color: #1e293b;
            transform: translateX(4px);
        }

        .nav-item.active .nav-link {
            background: linear-gradient(135deg, #4CAF50 0%, #66BB6A 100%);
            color: white;
            box-shadow:
                0 4px 12px rgba(76, 175, 80, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .nav-item.active .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 0 2px 2px 0;
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            margin-right: 12px;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-item:hover .nav-icon {
            transform: scale(1.1);
        }

        .nav-text {
            flex: 1;
            font-weight: 500;
        }

        .expand-icon {
            width: 16px;
            height: 16px;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0.6;
            font-size: 12px;
        }

        .nav-item.expanded .expand-icon {
            transform: rotate(90deg);
        }

        .sub-items {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-left: 12px;
            border-left: 2px solid #e5e7eb;
            margin-top: 4px;
        }

        .nav-item.expanded .sub-items {
            max-height: 400px;
        }

        .sub-item {
            position: relative;
            margin: 2px 0;
        }

        .sub-item .nav-link {
            padding: 10px 16px 17px 32px;
            font-size: 13px;
            color: #6b7280;
        }

        .sub-item:hover .nav-link {
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            color: #374151;
        }

        .sub-item .nav-icon {
            width: 16px;
            height: 16px;
            font-size: 14px;
            margin-right: 10px;
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, #e5e7eb 50%, transparent 100%);
            margin: 16px 24px;
        }

        /* Badge for counts */
        .nav-badge {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 10px;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: auto;
        }

        /* Hover animations */
        .nav-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.1) 0%, rgba(102, 187, 106, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 12px;
            pointer-events: none;
        }

        .nav-item:hover::before {
            opacity: 1;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .sidebar {
                width: 100%;
                max-width: 320px;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        
        <div class="sidebar-wrapper">
            <div class="sidebar">
                <div class="logo-section">
                    <div class="logo">CrocoBricks</div>
                    <div class="logo-subtitle">Business Portal</div>
                </div>
    
                <div class="nav-container">
                    <div class="nav-section">
                        <div class="nav-item">
                            <a href="/" class="nav-link">
                                <span class="nav-icon">🏠</span>
                                <span class="nav-text">Home</span>
                            </a>
                        </div>
                    </div>
    
                    <div class="nav-section">
                        <div class="nav-item expanded" onclick="toggleSection(this)">
                            <a href="#" class="nav-link">
                                <span class="nav-icon">📦</span>
                                <span class="nav-text">Voorraad</span>
                                <span class="expand-icon">▶</span>
                            </a>
                            <div class="sub-items">
                                <!-- HTML -->
                                <div class="sub-item" id="voorraad-overzicht-item">
                                    <a href="http://a400wsckk88ogos84woksgog.185.222.240.190.sslip.io/overview" class="nav-link" id="voorraad-overzicht-link">
                                        <span class="nav-icon">📊</span>
                                        <span class="nav-text">Overzicht</span>
                                    </a>
                                </div>
    
                                <!-- Put this CSS in your head or your stylesheet -->
                                <style>
                                    /* Base look */
                                    .sub-item .nav-link {
                                        color: #374151; /* dark gray */
                                        background-color: transparent;
                                        transition: all 0.2s ease-in-out;
                                    }
                                    
                                    /* Active styles */
                                    .sub-item.active .nav-link,
                                    .nav-link[aria-current="page"] {
                                        color: #fff;
                                        background-color: #60B864 !important; /* green */
                                        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.12);
                                    }
                                    
                                    /* Hover styles */
                                    .sub-item .nav-link:hover {
                                        color: black;
                                        background-color: #4da653; /* slightly darker green */
                                    }
                                </style>
    
                                <!--<div class="sub-item">-->
                                <!--    <a href="/voorraad/nieuw-product" class="nav-link">-->
                                <!--        <span class="nav-icon">➕</span>-->
                                <!--        <span class="nav-text">Nieuw product</span>-->
                                <!--    </a>-->
                                <!--</div>-->
                                <div class="sub-item">
                                    <a href="/scan-feature" class="nav-link">
                                        <span class="nav-icon">📸</span>
                                        <span class="nav-text">Scan Feature</span>
                                    </a>
                                </div>
                                <!--<div class="sub-item">-->
                                <!--    <a href="/voorraad/categorieen" class="nav-link">-->
                                <!--        <span class="nav-icon">🏷️</span>-->
                                <!--        <span class="nav-text">Categorieën</span>-->
                                <!--    </a>-->
                                <!--</div>-->
                                <!--<div class="sub-item">-->
                                <!--    <a href="/voorraad/nieuwe-categorie" class="nav-link">-->
                                <!--        <span class="nav-icon">➕</span>-->
                                <!--        <span class="nav-text">Nieuwe categorie</span>-->
                                <!--    </a>-->
                                <!--</div>-->
                                <!--<div class="sub-item">-->
                                <!--    <a href="/voorraad/investeringsvoorraad" class="nav-link">-->
                                <!--        <span class="nav-icon">💰</span>-->
                                <!--        <span class="nav-text">Investeringsvoorraad</span>-->
                                <!--    </a>-->
                                <!--</div>-->
                                <!--<div class="sub-item">-->
                                <!--    <a href="/voorraad/locaties" class="nav-link">-->
                                <!--        <span class="nav-icon">📍</span>-->
                                <!--        <span class="nav-text">Voorraad locaties</span>-->
                                <!--    </a>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
    
                    <div class="nav-section">
                        <div class="nav-item">
                            <a href="/all-shippings" class="nav-link">
                                <span class="nav-icon">🚚</span>
                                <span class="nav-text">Shipping</span>
                                <!--<span class="nav-badge">3</span>-->
                            </a>
                        </div>
                    </div>
    
                    <div class="nav-section">
                        <div class="nav-item active">
                            <a href="/all-orders" class="nav-link">
                                <span class="nav-icon">📋</span>
                                <span class="nav-text">Orders</span>
                                <!--<span class="nav-badge">12</span>-->
                            </a>
                        </div>
                    </div>
    
                    <div class="divider"></div>
    
                    <!--<div class="nav-section">-->
                    <!--    <div class="nav-item expanded" onclick="toggleSection(this)">-->
                    <!--        <a href="#" class="nav-link">-->
                    <!--            <span class="nav-icon">🧾</span>-->
                    <!--            <span class="nav-text">Facturen</span>-->
                    <!--            <span class="expand-icon">▶</span>-->
                    <!--        </a>-->
                    <!--        <div class="sub-items">-->
                    <!--            <div class="sub-item">-->
                    <!--                <a href="/facturen/overzicht" class="nav-link">-->
                    <!--                    <span class="nav-icon">📊</span>-->
                    <!--                    <span class="nav-text">Overzicht</span>-->
                    <!--                </a>-->
                    <!--            </div>-->
                    <!--            <div class="sub-item">-->
                    <!--                <a href="/facturen/factuuraanvragen" class="nav-link">-->
                    <!--                    <span class="nav-icon">📥</span>-->
                    <!--                    <span class="nav-text">Factuuraanvragen</span>-->
                    <!--                </a>-->
                    <!--            </div>-->
                    <!--            <div class="sub-item">-->
                    <!--                <a href="/facturen/nieuw" class="nav-link">-->
                    <!--                    <span class="nav-icon">➕</span>-->
                    <!--                    <span class="nav-text">Nieuw factuur</span>-->
                    <!--                </a>-->
                    <!--            </div>-->
                    <!--            <div class="sub-item">-->
                    <!--                <a href="/facturen/klanten" class="nav-link">-->
                    <!--                    <span class="nav-icon">👥</span>-->
                    <!--                    <span class="nav-text">Klanten</span>-->
                    <!--                </a>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
        
        <div class="main-content">
            <div class="header">
                <div class="header-left">
                    <a href="http://a400wsckk88ogos84woksgog.185.222.240.190.sslip.io/all-orders" class="back-btn">← Orders</a>
                    <div>
                        <div class="order-title">
                            <span class="platform-icon brickowl">BO</span>
                            {{ $order[0]->marketplace_type }} #{{ $order[0]->marketplace_order_id }}
                        </div>
                        <div class="order-subtitle">
                            <span class="status-badge status-processing">Status - {{ $order[0]->status }}</span>
                            <span class="status-badge status-processing">Payment Status - {{ $order[0]->payment_status }}</span>
                            Last changed {{ date('d-M-Y H:i', strtotime($order[0]->updated_at)) }}
                        </div>
                    </div>
                </div>
                <div class="header-actions">
                    <!--<button class="header-btn">← Details</button>-->
                    <!--<button class="header-btn">✉ Messages</button>-->
                    <form action="{{ route('orders.markAsNextStatus', $order[0]->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <input name="order_group" type="hidden" value="{{ $order[0]->order_group }}">
                        <?php if($order[0]->order_group == "waiting_payment"){ ?>
                                <button type="submit" class="header-btn primary">Mark as paid</button>
                        <?php }else if($order[0]->order_group == "waiting_invoice"){ ?>
                                <button type="submit" class="header-btn primary">Mark as Invoice</button>
                        <?php }else if($order[0]->order_group == "to_be_picked"){ ?>
                                <button type="submit" class="header-btn primary">Mark as Picked</button>
                        <?php }else if($order[0]->order_group == "ready_to_pack"){ ?>
                                <button type="submit" class="header-btn primary">Mark as Packed</button>
                        <?php }else { ?>
                                <button disabled="" style="background-color:gray;" class="header-btn primary">Order has been Shipped!</button>
                        <?php } ?>
                    </form>
                    <form action="{{ route('orders.markAsNextStatus', $order[0]->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <input name="order_group" type="hidden" value="waiting_payment">
                            <button type="submit" class="header-btn primary">Mark as paid</button>
                    </form>
                </div>
            </div>
            
            <div class="content">
                <!--<div class="payment-alert">-->
                <!--    <span class="alert-icon">⚠️</span>-->
                <!--    <span class="alert-text">Payment: This order has been waiting 15 days for a payment.</span>-->
                <!--</div>-->
                <div>
                    <style>
                        .alert-success{
                            padding: 15px;
                            background-color: #4CAF51;
                            color: white;
                        }
                    </style>
                    @if(session('success'))
                        <div class="alert alert-success"><strong>{{ session('success') }}</strong></div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger"><strong>{{ session('error') }}</strong></div>
                    @endif  
                </div>
                <div class="info-grid">
                    <div class="info-section">
                        <div class="info-header">
                            <span class="info-title">Customer details</span>
                            <div class="info-actions">
                                <!--<span class="info-action">✏️</span>-->
                                <span class="info-action">👤</span>
                                <!--<span class="info-action">🔍</span>-->
                            </div>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Name:</span>
                            <span class="info-value">{{ $order[0]->customer_name ?? "{not set}" }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Address:</span>
                            <span class="info-value">{{ $order[0]->shipping_address_1 ?? "{not set}" }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"></span>
                            <span class="info-value">{{ $order[0]->shipping_city }} {{ $order[0]->shipping_state }} {{ $order[0]->shipping_postcode }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"></span>
                            <span class="info-value">{{ $order[0]->shipping_country ?? "{not set}" }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">📧</span>
                            <span class="info-value">{{ $order[0]->customer_email ?? "{not set}" }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">📞</span>
                            <span class="info-value">{{ $order[0]->customer_phone ?? "{not set}" }}</span>
                        </div>
                        <!--<div class="info-row">-->
                        <!--    <span class="info-label">🕐</span>-->
                        <!--    <span class="info-value">1 previous orders (show)</span>-->
                        <!--</div>-->
                    </div>

                    <div class="info-section">
                        <div class="info-header">
                            <span class="info-title">Shipping</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Method:</span>
                            <span class="info-value">{{ $order[0]->shipping_method ?? "{not set}" }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Handling:</span>
                            <span class="info-value">{{ $order[0]->shipping_handling_fee ?? "{not set}" }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Insurance:</span>
                            <span class="info-value">{{ $order[0]->shipping_handling_fee ?? "{not set}" }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Weight:</span>
                            <span class="info-value">{{ $order[0]->package_weight_grams ?? "{not set}" }} g</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Shipping costs:</span>
                            <span class="info-value">€{{ $order[0]->shipping_cost ?? "{not set}" }}</span>
                        </div>
                    </div>

                    <div class="info-section">
                        <div class="info-header">
                            <span class="info-title">Administration</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Invoice:</span>
                            <span class="info-value">invoice #2679613-7268-1</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status:</span>
                            <span class="info-value">
                                <span class="status-badge status-pending">{{ $order[0]->status }}</span>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Subtotal:</span>
                            <span class="info-value">€{{ $order[0]->subtotal }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Shipping Cost:</span>
                            <span class="info-value">€{{ $order[0]->shipping_cost }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Tax Amount:</span>
                            <span class="info-value">€{{ $order[0]->tax_amount }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Total:</span>
                            <span class="info-value"><strong>€{{ $order[0]->total_amount }}</strong></span>
                        </div>
                    </div>
                </div>

                <div class="parts-section">
                    <div class="parts-header">
                        <span class="parts-title">Order Items</span>
                        <div class="parts-actions">
                            <button class="timer-btn" id="timerBtn" onclick="toggleTimer()">⏱️ Start Picking</button>
                            <button class="export-pdf-btn" onclick="exportOrderToPDF()" disabled>📄 Export as PDF</button>
                            <button class="toggle-all-btn" onclick="toggleAllItems()">☑️ Toggle All</button>
                        </div>
                    </div>

                    <div class="efficiency-panel">
                        <div class="efficiency-stats">
                            <div class="stat-item">
                                <div class="stat-label">Picking Time</div>
                                <div class="stat-value" id="totalTime">00:00:00</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Items/Min</div>
                                <div class="stat-value" id="itemsPerMin">0.0</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Avg Time/Item</div>
                                <div class="stat-value" id="avgTimePerItem">--:--</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Progress</div>
                                <div class="stat-value" id="progressPercentage">0%</div>
                            </div>
                        </div>
                    </div>

                    <table class="parts-table">
                        <thead>
                            <tr>
                                <th>✓</th>
                                <th>Part</th>
                                <th>Image URL</th>
                                <th>Item No</th>
                                <th>Item Type</th>
                                <th>Location</th>
                                <!--<th class="sortable-header" onclick="sortByLocation()">Location 🔄</th>-->
                                <th>Color</th>
                                <th>Category</th>
                                <th>Condition</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody id="partsTableBody">
                            @foreach ($orderItems as $orderItem)
                                <tr data-location="A1-B2" data-route-order="1" data-original-index="0">
                                    <td class="checkbox-cell">
                                        <input type="checkbox" class="item-checkbox" onchange="updateProgress()" data-part="4081b">
                                    </td>
                                    <td style="max-width:215px;">
                                        <!--<div style="display: flex; align-items: center; gap: 8px;">-->
                                            <!--<div class="part-image part-blue">🔷</div>-->
                                            <!--<div class="part-image part-blue"><img src="{{ $orderItem->part_image_url }}"></div>-->
                                            <!--<div>-->
                                                <!--<div>Part 4081b <span class="item-timer" id="timer-4081b"></span></div>-->
                                                <!--<div class="part-number">4081b</div>-->
                                                <div>{{ $orderItem->title }}</div>
                                            <!--</div>-->
                                        <!--</div>-->
                                    </td>
                                    <td style="max-width:215px;">
                                        <a href="{{ $orderItem->image_url }}" target="_blank">
                                            <img style="width:75px; cursor:pointer;" src="{{ $orderItem->image_url }}">
                                        </a>
                                    </td>

                                    <td>{{ $orderItem->item_no ?? "{not set}" }}</td>
                                    <td>{{ $orderItem->item_type ?? "{not set}" }}</td>
                                    <td>{{ $orderItem->location ?? "{not set}" }}</td>
                                    <!--<td class="location-cell">{{ $orderItem->warehouse_location }}</td>-->
                                    <td>{{ $orderItem->color_name ?? "{not set}" }}</td>
                                    <?php
                                        $categoryDetail = DB::table('categories')->where('id', $orderItem->category_id)->get();
                                    ?>
                                    <td>{{ ($categoryDetail[0]->title) ?? $orderItem->category_name }}</td>
                                    <td>
                                        <span class="condition-badge {{$orderItem->condition_type == 'new' ? 'condition-new' : 'condition-used'}} ">{{ $orderItem->condition_type }}</span>
                                        </td>
                                    <td style="text-align:left;" class="qty-cell">{{ $orderItem->quantity }}</td>
                                    <td style="text-align:left;" class="price-cell">€{{ $orderItem->total_price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="progress-section">
                        <div class="progress-bar">
                            <div class="progress-fill" id="progressFill"></div>
                        </div>
                        <div class="progress-text" id="progressText">0 van 6 items gepickt</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Timer and efficiency tracking
        let pickingTimer = {
            startTime: null,
            totalTime: 0,
            isRunning: false,
            interval: null,
            itemTimes: {},
            itemStartTimes: {}
        };

        let routeMode = false;
        let isRouteSorted = false;

        function sortByLocation() {
            const tbody = document.getElementById('partsTableBody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const header = document.querySelector('.sortable-header');
            
            if (!isRouteSorted) {
                // Sort by optimized route
                const routeOrder = {
                    'A1-B2': 1,
                    'B1-C4': 2, 
                    'C3-D1': 3,
                    'F2-A3': 4
                };
                
                rows.sort((a, b) => {
                    const locationA = a.dataset.location;
                    const locationB = b.dataset.location;
                    const orderA = routeOrder[locationA] || 999;
                    const orderB = routeOrder[locationB] || 999;
                    
                    if (orderA !== orderB) {
                        return orderA - orderB;
                    }
                    
                    // Within same location, maintain original order
                    return parseInt(a.dataset.routeOrder) - parseInt(b.dataset.routeOrder);
                });
                
                header.textContent = 'Location ✅ (Route Optimized)';
                header.classList.add('sorted');
                isRouteSorted = true;
                
                // Add visual grouping
                rows.forEach(row => {
                    row.classList.add('location-grouped');
                });
                
            } else {
                // Return to original order
                rows.sort((a, b) => {
                    return parseInt(a.dataset.originalIndex) - parseInt(b.dataset.originalIndex);
                });
                
                header.textContent = 'Location 🔄';
                header.classList.remove('sorted');
                isRouteSorted = false;
                
                // Remove visual grouping
                rows.forEach(row => {
                    row.classList.remove('location-grouped');
                });
            }
            
            // Re-append sorted rows
            rows.forEach(row => tbody.appendChild(row));
            
            // Show notification
            showNotification(isRouteSorted ? 
                '🗺️ Items sorted by optimized pick route!' : 
                '📋 Items returned to original order'
            );
        }

        function showNotification(message) {
            // Create notification element
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #4CAF50;
                color: white;
                padding: 12px 20px;
                border-radius: 6px;
                font-size: 14px;
                font-weight: 500;
                z-index: 1000;
                box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        function toggleTimer() {
            const btn = document.getElementById('timerBtn');
            
            if (!pickingTimer.isRunning) {
                // Start timer
                pickingTimer.startTime = Date.now();
                pickingTimer.isRunning = true;
                pickingTimer.interval = setInterval(updateTimerDisplay, 1000);
                
                btn.textContent = '⏹️ Stop Picking';
                btn.classList.add('active');
            } else {
                // Stop timer
                pickingTimer.isRunning = false;
                clearInterval(pickingTimer.interval);
                
                btn.textContent = '⏱️ Start Picking';
                btn.classList.remove('active');
            }
        }

        function updateTimerDisplay() {
            if (!pickingTimer.isRunning) return;
            
            const elapsed = Date.now() - pickingTimer.startTime + pickingTimer.totalTime;
            const hours = Math.floor(elapsed / 3600000);
            const minutes = Math.floor((elapsed % 3600000) / 60000);
            const seconds = Math.floor((elapsed % 60000) / 1000);
            
            const timeString = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            document.getElementById('totalTime').textContent = timeString;
            
            updateEfficiencyStats();
        }

        function updateEfficiencyStats() {
            const checkedBoxes = document.querySelectorAll('.item-checkbox:checked');
            const totalBoxes = document.querySelectorAll('.item-checkbox');
            const elapsed = (Date.now() - pickingTimer.startTime + pickingTimer.totalTime) / 1000; // in seconds
            
            // Items per minute
            const itemsPerMin = elapsed > 0 ? (checkedBoxes.length / elapsed * 60).toFixed(1) : '0.0';
            document.getElementById('itemsPerMin').textContent = itemsPerMin;
            
            // Average time per item
            if (checkedBoxes.length > 0) {
                const avgSeconds = elapsed / checkedBoxes.length;
                const avgMinutes = Math.floor(avgSeconds / 60);
                const avgRemainingSeconds = Math.floor(avgSeconds % 60);
                document.getElementById('avgTimePerItem').textContent = 
                    `${avgMinutes.toString().padStart(2, '0')}:${avgRemainingSeconds.toString().padStart(2, '0')}`;
            }
            
            // Progress percentage
            const progress = Math.round((checkedBoxes.length / totalBoxes.length) * 100);
            document.getElementById('progressPercentage').textContent = `${progress}%`;
        }

        // Track picking progress
        function updateProgress() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const checkedBoxes = document.querySelectorAll('.item-checkbox:checked');
            
            const progress = (checkedBoxes.length / checkboxes.length) * 100;
            document.getElementById('progressFill').style.width = progress + '%';
            document.getElementById('progressText').textContent = 
                `${checkedBoxes.length} van ${checkboxes.length} items gepickt`;
            
            // Update row styling and item timers
            checkboxes.forEach((checkbox, index) => {
                const row = checkbox.closest('tr');
                const partNumber = checkbox.dataset.part;
                
                if (checkbox.checked) {
                    row.classList.add('row-checked');
                    
                    // Record picking time for this item
                    if (pickingTimer.isRunning && !pickingTimer.itemTimes[partNumber]) {
                        const itemTime = Date.now() - pickingTimer.startTime;
                        pickingTimer.itemTimes[partNumber] = itemTime;
                        
                        // Display item time
                        const timerSpan = document.getElementById(`timer-${partNumber}`);
                        if (timerSpan) {
                            const seconds = Math.floor(itemTime / 1000);
                            timerSpan.textContent = `(${seconds}s)`;
                            timerSpan.style.color = '#4CAF50';
                        }
                    }
                } else {
                    row.classList.remove('row-checked');
                    // Clear item time if unchecked
                    delete pickingTimer.itemTimes[partNumber];
                    const timerSpan = document.getElementById(`timer-${partNumber}`);
                    if (timerSpan) {
                        timerSpan.textContent = '';
                    }
                }
            });

            // Enable/disable PDF button
            const pdfButton = document.querySelector('.export-pdf-btn');
            if (checkedBoxes.length === checkboxes.length) {
                pdfButton.disabled = false;
                pdfButton.textContent = '📄 Export Completed Order';
                pdfButton.style.background = '#2196F3';
                pdfButton.style.color = 'white';
            } else {
                pdfButton.disabled = true;
                pdfButton.textContent = '📄 Export as PDF';
                pdfButton.style.background = '#ccc';
                pdfButton.style.color = '#999';
            }

            updateEfficiencyStats();
        }

        // Toggle all items
        function toggleAllItems() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = !allChecked;
            });
            
            updateProgress();
        }

        // Export order to PDF
        function exportOrderToPDF() {
    const checkedBoxes = document.querySelectorAll('.item-checkbox:checked');
    const totalBoxes = document.querySelectorAll('.item-checkbox');

    if (checkedBoxes.length !== totalBoxes.length) {
        alert('Alle items moeten eerst gepickt worden voordat je de order kunt exporteren!');
        return;
    }

    const orderData = {
        orderNumber: '<?= $order[0]->marketplace_type ?> #<?= $order[0]->marketplace_order_id ?>',
        customer: "<?= $order[0]->customer_name ?>",
        date: new Date().toLocaleDateString('nl-NL'),
        time: new Date().toLocaleTimeString('nl-NL'),
        items: [],
        total: '€<?= $order[0]->total_amount ?>'
    };

    const rows = document.querySelectorAll('#partsTableBody tr');

    rows.forEach(row => {

        const partName = row.querySelector('td:nth-child(2) div')?.textContent.trim() || '';
        const partNumber = row.querySelector('td:nth-child(4)')?.textContent.trim() || '';
        const itemType   = row.querySelector('td:nth-child(5)')?.textContent.trim() || '';
        const location   = row.querySelector('td:nth-child(6)')?.textContent.trim() || '';
        const color      = row.querySelector('td:nth-child(7)')?.textContent.trim() || '';
        const category   = row.querySelector('td:nth-child(8)')?.textContent.trim() || '';
        const condition  = row.querySelector('.condition-badge')?.textContent.trim() || '';
        const qty        = row.querySelector('.qty-cell')?.textContent.trim() || '';
        const price      = row.querySelector('.price-cell')?.textContent.trim() || '';

        orderData.items.push({
            partName,
            partNumber,
            itemType,
            location,
            color,
            category,
            condition,
            qty,
            price
        });
    });

    createPDF(orderData);
}


        function createPDF(orderData) {
            // Create a new window for PDF generation
            const printWindow = window.open('', '_blank');
            
            const pdfContent = `
            <!DOCTYPE html>
            <html>
            <head>
                <title>Order ${orderData.orderNumber} - Picked Items</title>
                <style>
                    body { 
                        font-family: Arial, sans-serif; 
                        margin: 20px; 
                        color: #333; 
                    }
                    .header { 
                        border-bottom: 2px solid #4CAF50; 
                        padding-bottom: 20px; 
                        margin-bottom: 20px; 
                    }
                    .order-title { 
                        font-size: 24px; 
                        color: #4CAF50; 
                        margin-bottom: 10px; 
                    }
                    .order-info { 
                        display: flex; 
                        justify-content: space-between; 
                        margin-bottom: 10px; 
                    }
                    .picked-stamp {
                        background: #4CAF50;
                        color: white;
                        padding: 10px 20px;
                        border-radius: 5px;
                        font-weight: bold;
                        display: inline-block;
                        margin: 20px 0;
                    }
                    table { 
                        width: 100%; 
                        border-collapse: collapse; 
                        margin: 20px 0; 
                    }
                    th, td { 
                        border: 1px solid #ddd; 
                        padding: 8px; 
                        text-align: left; 
                    }
                    th { 
                        background-color: #f8f9fa; 
                        font-weight: bold; 
                    }
                    .location { 
                        font-family: monospace; 
                        font-weight: bold; 
                        color: #4CAF50; 
                    }
                    .footer { 
                        margin-top: 40px; 
                        text-align: center; 
                        color: #666; 
                        border-top: 1px solid #ddd; 
                        padding-top: 20px; 
                    }
                    .total { 
                        font-size: 18px; 
                        font-weight: bold; 
                        text-align: right; 
                        margin-top: 20px; 
                    }
                </style>
            </head>
            <body>
                <div class="header">
                    <div class="order-title">BNTK - Order Picking List</div>
                    <div class="order-info">
                        <div><strong>Order:</strong> ${orderData.orderNumber}</div>
                        <div><strong>Customer:</strong> ${orderData.customer}</div>
                    </div>
                    <div class="order-info">
                        <div></div>
                        <div><strong>Total:</strong> ${orderData.total}</div>
                    </div>
                </div>
                
                <div class="picked-stamp">✅ ORDER VOLLEDIG GEPICKT</div>
                
                <table>
                    <thead>
                        <tr>
                            
                            <th>Part Name</th>
                            <th>Location</th>
                            <th>Condition</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${orderData.items.map(item => `
                            <tr>
                                
                                <td>${item.partName}</td>
                                <td class="location">${item.location}</td>
                                <td>${item.condition}</td>
                                <td>${item.qty}</td>
                                <td>${item.price}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
                
                <div class="total">Total: ${orderData.total}</div>
                
                <div class="footer">
                    <p>BNTK Order Management System</p>
                    <p>Generated on <?= date('d M Y') ?> at <?= date('H:i') ?></p>
                </div>
            </body>
            </html>
            `;
            
            printWindow.document.write(pdfContent);
            printWindow.document.close();
            
            // Wait for content to load, then print
            printWindow.onload = function() {
                printWindow.print();
            };
        }

        // Add interactive functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize progress
            updateProgress();

            // Make info actions clickable
            document.querySelectorAll('.info-action').forEach(action => {
                action.addEventListener('click', function() {
                    console.log('Info action clicked:', this.textContent);
                });
            });

            // Make table rows clickable (except checkbox)
            document.querySelectorAll('.parts-table tbody tr').forEach(row => {
                row.style.cursor = 'pointer';
                row.addEventListener('click', function(e) {
                    // Don't trigger if clicking on checkbox
                    if (e.target.type !== 'checkbox') {
                        const checkbox = this.querySelector('.item-checkbox');
                        checkbox.checked = !checkbox.checked;
                        updateProgress();
                    }
                });
            });
        });
    </script>
    <script>
      // Select all parent nav items that have sub-items
      document.querySelectorAll('.nav-item').forEach(item => {
        const subItems = item.querySelector('.sub-items');
        if (subItems) {
          const link = item.querySelector('.nav-link');
    
          // Handle click
          link.addEventListener('click', function(e) {
            e.preventDefault();             // Prevent following #
            item.classList.toggle('expanded'); // Toggle expansion
          });
        }
      });
    </script>
</body>
</html>