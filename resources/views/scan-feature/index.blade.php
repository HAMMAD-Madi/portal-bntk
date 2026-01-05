<!DOCTYPE html>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrocoBricks Dashboard - Home</title>
      <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://portal.bntk.eu/public/assets/styles.css" />
  <script defer src="https://portal.bntk.eu/public/assets/js/yoo1.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
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
                                    <a href="https://portal.bntk.eu/overview" class="nav-link" id="voorraad-overzicht-link">
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
                                <div class="sub-item active">
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
                <div>
                    <div class="breadcrumb">Pages / Voorraad / Scan Feature</div>
                    <h1>Scan Feature</h1>
                </div>
                <button class="logout-btn">Log out</button>
            </div>
    
            <!--<div class="search-bar">-->
            <!--    <input type="text" placeholder="Search orders, products, customers...">-->
            <!--</div>-->
    
    
    
            <style>
    .modal {
      position: fixed;
      top: 0; left: 0;
      width: 100vw; height: 100vh;
      background: rgba(0, 0, 0, 0.6);
      display: flex;
      justify-content: center;
      align-items: flex-start;
      overflow-y: auto;
      z-index: 9999;
      padding: 2rem 1rem;
    }

  .modal.hidden { display: none; }

  .modal-content {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    max-width: 500px;
    width: 100%;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    position: relative;
  }

  .modal-title {
    font-size: 1.5rem;
    text-align: center;
    margin-bottom: 1.5rem;
    color: #333;
  }

  .close {
    position: absolute;
    top: 1rem; right: 1rem;
    font-size: 1.8rem;
    color: #888;
    cursor: pointer;
  }

  .form-control,
  .form-control-file {
    width: 100%;
    padding: 12px 14px;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 1rem;
    box-sizing: border-box;
  }

  .form-control:focus {
    border-color: #007bff;
    outline: none;
  }

  .checkbox-container {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
  }

  .checkbox-container input {
    width: 18px; height: 18px;
    accent-color: #007bff;
    cursor: pointer;
  }

  .btn-save {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .btn-save:hover {
    background-color: #0056b3;
  }

  .conditional.hidden {
    display: none;
  }

  @media (max-width: 480px) {
    .modal-content {
      padding: 1rem;
    }

    .form-control,
    .form-control-file {
      font-size: 0.95rem;
    }

    .modal-title {
      font-size: 1.3rem;
    }
  }
</style>

            <div class="stats-grid" style="background-color: white; margin-top:40px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.12); margin-right:22px;">

            <div id="modal" class="modal hidden">
              <div class="modal-content">
                <span id="closeModal" class="close">&times;</span>
                <h2 class="modal-title">Add Item</h2>
                <form id="modalForm" method="POST" action="{{ route('scanFeatureSave') }}" enctype="multipart/form-data">
                  @csrf
                  
                   <!--Basic Fields -->
                  <input type="text" class="form-control" name="modalTitle" id="modalName" placeholder="Title" />
                  <input type="text" class="form-control" name="modalItemNo" id="modalId" placeholder="Item No" />
            
                   <!--Item Type -->
                  <!--<select id="modalType" class="form-control">-->
                  <!--  <option value="">Select Type</option>-->
                  <!--  <option value="PART">Part</option>-->
                  <!--  <option value="SET">Set</option>-->
                  <!--  <option value="MINIFIG">Minifig</option>-->
                  <!--</select>-->
                  <input id="modalType" name="modalItemType" type="text" class="form-control">
            
                   <!--Color -->
                  <select class="form-control" name="modalColorName" id="modalColor">
                    <?php foreach ($colors as $color): ?>
                      <option value="<?= $color->bricklink_id ?>">
                        <?= htmlspecialchars($color->bricklink_name) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
            
                   <!--Stock & Price -->
                  <input type="number" name="modalStock" value="1" class="form-control" id="modalStock" placeholder="Stock" min="0" step="1" />
                  
                         <!--Condition -->
                  <select class="form-control" name="modalCondition" id="modalCondition">
                    <option value="used">Used</option>
                    <option value="new">New</option>
                  </select>
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                    <button 
                      type="button" 
                      id="fetchPriceBtn" 
                      style="
                        text-align: center;
                        height: 25px;
                        width: 100%;
                        background: linear-gradient(135deg, #007bff, #0056d2);
                        color: #fff;
                        border: none;
                        border-radius: 5px;
                        padding: 10px 18px;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center; /* ✅ Center horizontally */
                        gap: 8px;
                        box-shadow: 0 3px 8px rgba(0,0,0,0.2);
                      "
                      onmouseover="this.style.background='linear-gradient(135deg,#0056d2,#0040a8)'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.25)'"
                      onmouseout="this.style.background='linear-gradient(135deg,#007bff,#0056d2)'; this.style.transform='none'; this.style.boxShadow='0 3px 8px rgba(0,0,0,0.2)'"
                    >
                      <i class="fa-solid fa-magnifying-glass-dollar"></i> Fetch price against Item No
                    </button>
            
            
                  <input type="number" step="any" name="modalPrice" class="form-control" id="modalPrice" placeholder="Price will be auto-fetched against Item No!" min="0" step="1" required />
            
             <!--SweetAlert2 (add if not already loaded globally) -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            
             <!--Optional: ensure Swal is always above modals -->
            <style>
            .swal2-container {
              z-index: 20000 !important;
            }
            </style>
            
            <script>
            document.getElementById("fetchPriceBtn").addEventListener("click", function() {
                const btn = this;
                btn.disabled = true;
                btn.textContent = "Fetching...";
            
                const payload = {
                    item_no: document.getElementById("modalId")?.value?.trim() || "",
                    item_type: document.getElementById("modalType")?.value?.trim() || "",
                    item_color_id: document.getElementById("modalColor")?.value?.trim() || "",
                    item_condition: document.getElementById("modalCondition")?.value?.trim() || ""
                };
            
                if (!payload.item_no && !payload.item_type) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Item No Required',
                        text: 'Please enter an Item No, Item Type, Color ID & Condition before fetching the price.'
                    });
                    btn.disabled = false;
                    btn.textContent = "Fetch Price";
                    return;
                }
            
                fetch("https://portal.bntk.eu/send-to-webhook", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: JSON.stringify(payload)
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Response:", data);
            
                    if (data.avg_price !== undefined) {
                        const priceField = document.getElementById("modalPrice");
                        priceField.value = data.avg_price;
                        priceField.removeAttribute("disabled");
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Item No',
                            text: 'Please provide a valid Item No, Item Type, Color ID & Condition to fetch the price!'
                        });
                    }
                })
                .catch(error => {
                    console.error("Error fetching price:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Request Failed',
                        text: 'Something went wrong while fetching the price.'
                    });
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.textContent = "Fetch Price";
                });
            });
            </script>
            
            
                   <!--Completeness -->
                  <div id="completenessGroup" name="modalCompleteness" class="conditional hidden">
                    <select class="form-control" id="modalCompleteness">
                      <option value="">Select Completeness</option>
                      <option value="complete">Complete</option>
                      <option value="incomplete">Incomplete</option>
                      <option value="sealed">Sealed</option>
                    </select>
                  </div>
            
                   <!--Category -->
                  <!--<input type="text" name="modalCategory" id="modalCategory" class="form-control" placeholder="Category" />-->
                  <select class="form-control" name="modalCategory" id="modalCategory">
                    <?php foreach ($categories as $category): ?>
                      <option value="<?= $category->id ?>">
                        <?= htmlspecialchars($category->title) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                    
                   <!--EAN -->
                  <input type="text" name="modalGTIN" class="form-control" id="modalEan" placeholder="EAN Code" />
            
                   <!--SKU -->
                  <input type="text" name="modalSKU" class="form-control" id="modalSku" placeholder="SKU" />
            
                   <!--Retain Checkbox -->
                  <div class="checkbox-container">
                    <input name="retain" type="checkbox" id="retain" checked="true" />
                    <label for="retain">Retain</label>
                  </div>
            
                   <!--Is Stock Room Checkbox -->
                  <div class="checkbox-container">
                    <input name="isStockRoom" type="checkbox" id="isStockRoom" />
                    <label for="isStockRoom">Is Stock Room</label>
                  </div>
            
                   <!--Stock Room ID -->
                  <div id="stockRoomIdGroup" class="conditional hidden">
                    <select class="form-control" id="modalStockRoomId" name="modalStockRoomId">
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>
                    </select>
                  </div>
            
                   <!--Image & Gallery -->
                  <input type="text" name="modalUrl" class="form-control" id="modalUrl" placeholder="Image URL" />
                  <input name="modalImageFile" type="file" class="form-control-file" id="modalImageFile" />
                  <input name="modalGallery[]" type="file" class="form-control-file" id="modalGallery" multiple />
            
                  <button id="modalSaveButton" type="submit" class="btn-save">Save</button>
                </form>
              </div>
            </div>
            <script>
            
            async function autoCheckProduct() {
                const itemNo    = document.getElementById('modalId')?.value?.trim() || "";
                const color     = document.getElementById('modalColor')?.value || "";
                const condition = document.getElementById('modalCondition')?.value || "";
            
                if (!itemNo || !color || !condition) return;
            
                const url  = `/check-product?item_no=${itemNo}&color=${color}&condition=${condition}`;
                const res  = await fetch(url);
                const text = await res.text();
                const json = safeJsonParse(text);
            
                const exists = json === true;
            
                const saveBtn = document.getElementById('modalSaveButton');
            
                if (exists) {
                    saveBtn.textContent = "Update";
                    saveBtn.dataset.action = "update";
                } else {
                    saveBtn.textContent = "Save";
                    saveBtn.dataset.action = "save";
                }
            }
            
            
            document.getElementById('modalId').addEventListener('input', autoCheckProduct);
            document.getElementById('modalColor').addEventListener('change', autoCheckProduct);
            document.getElementById('modalCondition').addEventListener('change', autoCheckProduct);
            </script>
            
            <script>
            const itemTypeEl = document.getElementById('modalType');
            const isStockRoomEl = document.getElementById('isStockRoom');
            const completenessGroup = document.getElementById('completenessGroup');
            const stockRoomIdGroup = document.getElementById('stockRoomIdGroup');
            
            itemTypeEl.addEventListener('keyup', () => {
              const type = itemTypeEl.value.trim().toLowerCase();
              completenessGroup.classList.toggle('hidden', type !== 'set');
            });
            
            isStockRoomEl.addEventListener('change', () => {
              stockRoomIdGroup.classList.toggle('hidden', !isStockRoomEl.checked);
            });
            
            
            document.getElementById('closeModal').addEventListener('click', () => {
              document.getElementById('modal').classList.add('hidden');
            });
            
            </script>
            <script>
            
              new Choices('#modalColor', { searchEnabled: true });
            </script>
            
            
            
            
              <main>
                <section class="camera">
                  <video id="video" autoplay playsinline aria-label="Camera preview"></video>
                  <canvas id="canvas" width="640" height="480" hidden></canvas>
                </section>
            
                <section class="controls">
                   <!--Both fields now “inline” -->
                  <div class="field inline">
                    <label for="category">Category</label>
                    <select id="category" aria-label="Select category">
                      <option value="parts">Parts</option>
                      <option value="minifig">Minifigure</option>
                      <option value="set">Set</option>
                    </select>
                  </div>
            
                  <div class="field inline">
                    <label for="upload">Or upload an image</label>
                    <input type="file" id="upload" accept="image/*" aria-label="Upload image">
                  </div>
            
                  <button id="capture" aria-label="Capture photo">📸 Capture &amp; Check</button>
                  <button id="clear"   aria-label="Clear results">🗑️ Clear</button>
            
                  <div id="spinner"
                       class="spinner hidden"
                       role="status"
                       aria-live="polite"
                       aria-label="Loading…">
                  </div>
                </section>
            
                <section id="result" class="grid">
                  <div class="placeholder">
                    <p>Click Capture or upload an image to start.</p>
                  </div>
                </section>
              </main>
              </div>


        </div>
    </div>
</body>
</html>


