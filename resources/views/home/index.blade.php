<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrocoBricks Dashboard - Home</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f5f7;
            color: #1d1d1f;
        }
        
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        .logo {
            /*padding: 0 20px 20px 20px;*/
            font-weight: bold;
            font-size: 22px;
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

        .header h1 {
            font-size: 24px;
            font-weight: normal;
        }

        .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .header-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .header-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .header-btn.primary {
            background: #2196F3;
            border-color: #2196F3;
        }
        
        .date-time {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 12px;
            color: #86868b;
        }
        
        .search-bar {
            margin-bottom: 30px;
        }
        
        .search-bar input {
            width: 100%;
            max-width: 600px;
            padding: 12px 20px 12px 45px;
            border: 1px solid #d2d2d7;
            border-radius: 10px;
            font-size: 16px;
            background: white url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="%2386868b" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>') no-repeat 15px center;
        }
        
        .search-bar input:focus {
            outline: none;
            border-color: #4ade80;
        }
        
        .alert-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        
        .alert-box h3 {
            color: #856404;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .alert-item {
            color: #856404;
            margin-bottom: 8px;
            padding-left: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .alert-action {
            background: #ffc107;
            color: #856404;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
        }
        
        .alert-action:hover {
            background: #e0a800;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .stat-label {
            color: #86868b;
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .stat-value {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 12px;
        }
        
        .stat-change {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 14px;
        }
        
        .stat-change.positive {
            color: #4ade80;
        }
        
        .stat-change.negative {
            color: #ef4444;
        }
        
        .stat-progress {
            width: 100%;
            height: 8px;
            background: #f5f5f7;
            border-radius: 4px;
            margin-top: 12px;
            overflow: hidden;
        }
        
        .stat-progress-bar {
            height: 100%;
            background: #4ade80;
            border-radius: 4px;
            transition: width 0.3s;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .widget {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .widget-full {
            grid-column: span 12;
        }
        
        .widget-half {
            grid-column: span 6;
        }
        
        .widget-third {
            grid-column: span 4;
        }
        
        .widget h2 {
            font-size: 18px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .widget-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .widget-action {
            background: #4ade80;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
        }
        
        .widget-action:hover {
            background: #22c55e;
        }
        
        .widget-action.secondary {
            background: #f5f5f7;
            color: #1d1d1f;
        }
        
        .widget-action.secondary:hover {
            background: #e5e5ea;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th {
            text-align: left;
            padding: 12px;
            border-bottom: 2px solid #f5f5f7;
            color: #86868b;
            font-size: 13px;
            font-weight: 600;
        }
        
        .table td {
            padding: 12px;
            border-bottom: 1px solid #f5f5f7;
            font-size: 14px;
        }
        
        .table tr:hover {
            background: #fafafa;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .badge.success {
            background: #d1fae5;
            color: #065f46;
        }
        
        .badge.warning {
            background: #fef3c7;
            color: #92400e;
        }
        
        .badge.danger {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .badge.info {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .activity-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 12px 0;
            border-bottom: 1px solid #f5f5f7;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #4ade80;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-title {
            font-weight: 500;
            margin-bottom: 4px;
        }
        
        .activity-time {
            color: #86868b;
            font-size: 13px;
        }
        
        .message-item {
            display: flex;
            gap: 12px;
            padding: 16px;
            border: 1px solid #f5f5f7;
            border-radius: 8px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .message-item:hover {
            background: #fafafa;
            border-color: #4ade80;
        }
        
        .message-item.unread {
            background: #f0fdf4;
            border-color: #4ade80;
        }
        
        .message-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #4ade80;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            flex-shrink: 0;
        }
        
        .message-content {
            flex: 1;
        }
        
        .message-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }
        
        .message-name {
            font-weight: 600;
            font-size: 14px;
        }
        
        .message-time {
            color: #86868b;
            font-size: 12px;
        }
        
        .message-preview {
            color: #6e6e73;
            font-size: 13px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .product-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f5f5f7;
        }
        
        .product-item:last-child {
            border-bottom: none;
        }
        
        .product-info {
            display: flex;
            gap: 12px;
            align-items: center;
        }
        
        .product-image {
            width: 50px;
            height: 50px;
            background: #f5f5f7;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        .product-details h4 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px;
        }
        
        .product-meta {
            font-size: 12px;
            color: #86868b;
        }
        
        .product-stats {
            text-align: right;
        }
        
        .product-sales {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }
        
        .product-revenue {
            font-size: 12px;
            color: #86868b;
        }
        
        .integration-status {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            background: #f5f5f7;
            border-radius: 8px;
            margin-bottom: 12px;
        }
        
        .integration-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .integration-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }
        
        .status-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }
        
        .status-indicator.online {
            background: #4ade80;
        }
        
        .status-indicator.offline {
            background: #ef4444;
        }
        
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
        }
        
        .action-btn {
            padding: 16px;
            background: #f5f5f7;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }
        
        .action-btn:hover {
            background: #4ade80;
            color: white;
            transform: translateY(-2px);
        }
        
        .action-btn-icon {
            font-size: 24px;
        }
        
        @media (max-width: 1200px) {
            .widget-half, .widget-third {
                grid-column: span 12;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
            }
            
            .sidebar .nav-item span:last-child {
                display: none;
            }
            
            .main-content {
                margin-left: 80px;
                padding: 20px;
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
            /*font-weight: 500;*/
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
            /*font-weight: 500;*/
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
            /*font-weight: 500;*/
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
                        <div class="nav-item active">
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
                        <div class="nav-item">
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
                <h1>Welcome back CrocoBricks! 👋</h1>
                <p class="subtitle">Here's an overview of your business today</p>
                <div class="date-time">
                    <span>📅</span>
                    <span style="color: white;"><?= date("D, M d, Y", strtotime("+1 hour")); ?> - <?= date("H:i", strtotime("+1 hour")); ?></span>

                </div>
            </div>
    
            <!--<div class="search-bar">-->
            <!--    <input type="text" placeholder="Search orders, products, customers...">-->
            <!--</div>-->
    
            <div class="alert-box" style="margin-top: 30px;">
                <h3>⚠️ Important Notifications</h3>
                <div class="alert-item">
                    <span>• <?= count($products_in_low_stock) ?> items have insufficient stock</span>
                    <!--<button class="alert-action">View Items</button>-->
                </div>
                <div class="alert-item">
                    @php
use Carbon\Carbon;

$pendingOrders = DB::table('marketplaces_orders')
    ->where('payment_status', 'unpaid')
    ->get();

$count = 0;

foreach ($pendingOrders as $order) {
    $daysPending = Carbon::parse($order->created_at)->diffInDays(Carbon::now());
    if ($daysPending > 5) {
        $count++;
    }
}
@endphp

<span>• {{ $count }} orders have been awaiting payment for 5+ days</span>

                    <!--<button class="alert-action">Send Reminders</button>-->
                </div>
                <!--<div class="alert-item">-->
                <!--    <span>• 2 new messages from customers</span>-->
                    <!--<button class="alert-action">View Messages</button>-->
                <!--</div>-->
            </div>
    
            <div class="stats-grid">
 @php
    // Example: get today's total revenue
    $revenue_today = DB::table('marketplaces_orders')
        ->whereDate('created_at', \Carbon\Carbon::today())
        ->sum('total_amount');

    // Set your daily target
    $target = 75;

    // Calculate percentage (avoid division by zero)
    $percentage = $target > 0 ? ($revenue_today / $target) * 100 : 0;

    // Cap percentage at 100%
    $percentage = min($percentage, 100);

    // Choose direction (positive or negative)
    $isPositive = $revenue_today >= $target;
@endphp

<div class="stat-card">
    <div class="stat-label">Today's Revenue vs Target</div>
    <div class="stat-value">€{{ number_format($revenue_today, 2) }}</div>
    <div class="stat-change {{ $isPositive ? 'positive' : 'negative' }}">
        <span>{{ $isPositive ? '↗️' : '↘️' }}</span>
        <span>Target: €{{ number_format($target, 2) }} ({{ number_format($percentage, 0) }}%)</span>
    </div>
    <div class="stat-progress">
        <div class="stat-progress-bar" style="width: {{ $percentage }}%"></div>
    </div>
</div>

                
                <div class="stat-card">
                    <div class="stat-label">Active Orders</div>
                    <div class="stat-value"><?= $all_orders ?></div>
                    <!--<div class="stat-change positive">-->
                    <!--    <span>↗️</span>-->
                    <!--    <span>+12% vs last week</span>-->
                    <!--</div>-->
                </div>
                
                <div class="stat-card">
                    <div class="stat-label">Ready to Ship</div>
                    <div class="stat-value"><?= $ready_to_ship_orders ?></div>
                    <!--<div class="stat-change negative">-->
                    <!--    <span>⚠️</span>-->
                    <!--    <span>8 overdue</span>-->
                    <!--</div>-->
                </div>
                
                <div class="stat-card">
                    <div class="stat-label">Revenue This Week</div>
                    <div class="stat-value">€<?= number_format($revenue_this_week, 2) ?></div>
                    <!--<div class="stat-change positive">-->
                    <!--    <span>↗️</span>-->
                    <!--    <span>+8% vs last week</span>-->
                    <!--</div>-->
                </div>
                
                <div class="stat-card">
                    <div class="stat-label">Total Inventory Stock</div>
                    <div class="stat-value"><?= $total_inventory_Stock ?></div>
                    <!--<div class="stat-change negative">-->
                    <!--    <span>↘️</span>-->
                    <!--    <span>-3% vs last month</span>-->
                    <!--</div>-->
                </div>
                
                <div class="stat-card">
                    <div class="stat-label">Items in Stock</div>
                    <div class="stat-value"><?= $products_in_stock ?></div>
                    <!--<div class="stat-change negative">-->
                    <!--    <span>↘️</span>-->
                    <!--    <span>-3% vs last month</span>-->
                    <!--</div>-->
                </div>
                
                <div class="stat-card">
                    <div class="stat-label">Order Fulfillment</div>
                    <div class="stat-value"><?= number_format($completed_percentage, 2) ?>%</div>
                    <!--<div class="stat-change positive">-->
                    <!--    <span>↗️</span>-->
                    <!--    <span>+2% vs last month</span>-->
                    <!--</div>-->
                </div>
    
                <!--<div class="stat-card">-->
                <!--    <div class="stat-label">Avg. Profit Margin</div>-->
                <!--    <div class="stat-value">42%</div>-->
                <!--    <div class="stat-change positive">-->
                <!--        <span>↗️</span>-->
                <!--        <span>+1.5% vs last month</span>-->
                <!--    </div>-->
                <!--</div>-->
    
                <!--<div class="stat-card">-->
                <!--    <div class="stat-label">Return Rate</div>-->
                <!--    <div class="stat-value">1.2%</div>-->
                <!--    <div class="stat-change positive">-->
                <!--        <span>↘️</span>-->
                <!--        <span>-0.3% vs last month</span>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
    
            <div class="dashboard-grid">
                <!-- Pending Payment Orders -->
                <div class="widget widget-half">
                    <div class="widget-header">
                        <h2>💳 Pending Payment Orders</h2>
                        <!--<button class="widget-action secondary">View All</button>-->
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Days Waiting</th>
                                <!--<th>Status</th>-->
                                <!--<th>Action</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pending_payment_orders as $order){ ?>
                                <tr>
                                    <td><?= htmlspecialchars($order->marketplace_order_id) ?></td>
                                    <td><?= htmlspecialchars($order->customer_name) ?></td>
                                    <td>€<?= number_format($order->total_amount, 2) ?></td>
                                    <td>
                                        <span class="badge danger">
                                            <?= intval(\Carbon\Carbon::parse($order->created_at)->diffInDays(\Carbon\Carbon::now())) ?> days
                                        </span>
                                    </td>
                                    <!--<td><?= $order->status ?></td>-->
                                    <!-- <td><button class="widget-action">Remind</button></td> -->
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
    
                <!-- Low Stock Alerts -->
                <div class="widget widget-half">
                    <div class="widget-header">
                        <h2>📉 Low Stock Alerts</h2>
                        <!--<button class="widget-action secondary">View All</button>-->
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Part/Set</th>
                                <th>Current Stock</th>
                                <!--<th>Reorder Point</th>-->
                                <!--<th>Action</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products_in_low_stock as $product){ ?>
                                <tr>
                                    <tr>
                                        <td><?= $product->title ?></td>
                                        <td><span class="badge danger"><?= $product->stock ?></span></td>
                                        <!--<td>20</td>-->
                                        <!--<td><button class="widget-action">Order Now</button></td>-->
                                    </tr>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
    
                <!-- Customer Messages -->
                <!--<div class="widget widget-half">-->
                <!--    <div class="widget-header">-->
                <!--        <h2>💬 Customer Messages</h2>-->
                <!--        <button class="widget-action secondary">View All</button>-->
                <!--    </div>-->
                <!--    <div class="message-item unread">-->
                <!--        <div class="message-avatar">SM</div>-->
                <!--        <div class="message-content">-->
                <!--            <div class="message-header">-->
                <!--                <span class="message-name">Sophie Mulder</span>-->
                <!--                <span class="message-time">12 min ago</span>-->
                <!--            </div>-->
                <!--            <div class="message-preview">Hi, I received my order but part 3001 is in the wrong color. Can you help me with a replacement?</div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="message-item unread">-->
                <!--        <div class="message-avatar">LV</div>-->
                <!--        <div class="message-content">-->
                <!--            <div class="message-header">-->
                <!--                <span class="message-name">Lucas Vermeer</span>-->
                <!--                <span class="message-time">1 hour ago</span>-->
                <!--            </div>-->
                <!--            <div class="message-preview">When will my order #A0007PLLF be shipped? I need it before Friday.</div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="message-item">-->
                <!--        <div class="message-avatar">MJ</div>-->
                <!--        <div class="message-content">-->
                <!--            <div class="message-header">-->
                <!--                <span class="message-name">Maria Jansen</span>-->
                <!--                <span class="message-time">2 hours ago</span>-->
                <!--            </div>-->
                <!--            <div class="message-preview">Thank you so much! The LEGO parts arrived in perfect condition. Great service!</div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
    
                <!-- Top Selling Products -->
                <!--<div class="widget widget-half">-->
                <!--    <div class="widget-header">-->
                <!--        <h2>🏆 Top Selling Products (7 days)</h2>-->
                <!--        <button class="widget-action secondary">View Report</button>-->
                <!--    </div>-->
                <!--    <div class="product-item">-->
                <!--        <div class="product-info">-->
                <!--            <div class="product-image">🧱</div>-->
                <!--            <div class="product-details">-->
                <!--                <h4>Plate 2x4 (3020) - Black</h4>-->
                <!--                <p class="product-meta">Part #3020 • In stock: 487</p>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="product-stats">-->
                <!--            <div class="product-sales">142 sold</div>-->
                <!--            <div class="product-revenue">€852.00</div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="product-item">-->
                <!--        <div class="product-info">-->
                <!--            <div class="product-image">🧱</div>-->
                <!--            <div class="product-details">-->
                <!--                <h4>Brick 2x4 (3001) - Red</h4>-->
                <!--                <p class="product-meta">Part #3001 • In stock: 324</p>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="product-stats">-->
                <!--            <div class="product-sales">98 sold</div>-->
                <!--            <div class="product-revenue">€637.00</div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="product-item">-->
                <!--        <div class="product-info">-->
                <!--            <div class="product-image">⭐</div>-->
                <!--            <div class="product-details">-->
                <!--                <h4>Millennium Falcon (75192)</h4>-->
                <!--                <p class="product-meta">Set #75192-1 • In stock: 5</p>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="product-stats">-->
                <!--            <div class="product-sales">3 sold</div>-->
                <!--            <div class="product-revenue">€2,397.00</div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
    
                <!-- Marketplace Performance -->
<div class="widget widget-third">
    <h2>🏪 Marketplace Performance</h2>
    @foreach($performance as $data)
        <div class="product-item">
            <div class="product-info">
                <div class="product-image">{{ $data['icon'] }}</div>
                <div class="product-details">
                    <h4>{{ $data['marketplace'] }}</h4>
                    <p class="product-meta">{{ $data['orders'] }} orders this week</p>
                </div>
            </div>
            <div class="product-stats">
                <div class="product-sales">€{{ number_format($data['revenue'], 2) }}</div>
                <div class="product-revenue"
                     style="color: {{ $data['growth'] >= 0 ? 'green' : 'red' }}">
                     {{ $data['growth'] >= 0 ? '↗️ +' : '↘️ ' }}{{ abs($data['growth']) }}%
                </div>
            </div>
        </div>
    @endforeach
</div>

    
                <!-- Integration Status -->
                
    
                <!-- Today's Tasks -->
                
    
                <!-- Recent Activity -->
                <div class="widget widget-half">
                    <h2>🔔 Recent Activity</h2>
                    
                    @foreach($recent_orders as $data)
                        <div class="activity-item">
                            <div class="activity-icon">📦</div>
                            <div class="activity-content">
                                <div class="activity-title"><b><?= $data->marketplace_type ?></b> - New order <?= $data->order_number ?> </div>
                                <div class="activity-time">{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</div>
                            </div>
                        </div>
                    @endforeach
    
                </div>
    
                <!-- Quick Actions -->
<style>
.quick-actions a {
    text-decoration: none;
    color: inherit; /* keep text color same as button text */
}
</style>

<div class="widget widget-half">
    <h2>⚡ Quick Actions</h2>
    <div class="quick-actions">
        <a href="{{ url('/overview') }}" class="action-btn">
            <span class="action-btn-icon">🗂️</span>
            <span>Inventory</span>
        </a>
        <a href="{{ url('/all-orders') }}" class="action-btn">
            <span class="action-btn-icon">📦</span>
            <span>All Orders</span>
        </a>
        <a href="{{ url('/all-shippings') }}" class="action-btn">
            <span class="action-btn-icon">📦</span>
            <span>Shippings</span>
        </a>
    </div>
</div>

                
            </div>
        </div>
    </div>
</body>
</html>