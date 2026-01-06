<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - BNTK Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Roboto, sans-serif;
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

        .logout-btn {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            text-decoration: underline;
        }

        .content {
            background-color: white;
            margin: 24px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .content-header {
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .content-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .content-title h2 {
            font-size: 24px;
            color: #333;
        }

        .last-refresh {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .filters {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-label {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #666;
        }

        .search-input {
            width: 200px;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            margin-right: 10px;
        }

        .search-input:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
        }

        .filter-select {
            padding: 6px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
            font-size: 14px;
            cursor: pointer;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #e0e0e0;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .stat-label {
            color: #666;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .stat-chart {
            height: 40px;
            background: linear-gradient(90deg, #2196F3, #42A5F5);
            border-radius: 4px;
            position: relative;
            overflow: hidden;
        }

        .stat-chart::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: repeating-linear-gradient(90deg,
                    transparent,
                    transparent 8px,
                    rgba(255, 255, 255, 0.3) 8px,
                    rgba(255, 255, 255, 0.3) 12px);
        }

        .warning-banner {
            margin: 20px;
            padding: 15px 20px;
            background: #FFF3CD;
            border: 1px solid #FFEAA7;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .warning-content {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .warning-icon {
            color: #856404;
            font-size: 20px;
        }

        .warning-text {
            color: #856404;
        }

        .warning-text strong {
            display: block;
            margin-bottom: 4px;
        }

        .warning-btn {
            color: #0066CC;
            text-decoration: none;
            font-weight: 500;
        }

        .order-section {
            margin-bottom: 0;
        }

        .section-header {
            background: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #e0e0e0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            user-select: none;
        }

        .section-header:hover {
            background: #e9ecef;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-count {
            background: #6c757d;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .section-actions {
            display: flex;
            gap: 10px;
        }

        .section-btn {
            padding: 6px 12px;
            border: 1px solid #2196F3;
            background: #E3F2FD;
            color: #1976D2;
            border-radius: 4px;
            font-size: 12px;
            text-decoration: none;
            cursor: pointer;
        }

        .section-btn:hover {
            background: #BBDEFB;
        }

        .expand-icon {
            transition: transform 0.2s;
        }

        .section-header.collapsed .expand-icon {
            transform: rotate(-90deg);
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .orders-table th {
            background-color: #f8f9fa;
            padding: 12px 8px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
            font-weight: 600;
            color: #555;
            font-size: 12px;
        }

        /*.orders-table th:first-child {*/
        /*    width: 30px;*/
        /*    text-align: center;*/
        /*}*/

        /*.orders-table th:nth-child(2) {*/
        /*    width: 40px;*/
        /*    text-align: center;*/
        /*}*/

        /*.orders-table th:nth-child(3) {*/
        /*    width: 80px;*/
        /*}*/

        /*.orders-table th:nth-child(4) {*/
        /*    width: 100px;*/
        /*}*/

        /*.orders-table th:nth-child(5) {*/
        /*    width: 200px;*/
        /*}*/

        /*.orders-table th:nth-child(6) {*/
        /*    width: 40px;*/
        /*    text-align: center;*/
        /*}*/

        /*.orders-table th:nth-child(7) {*/
        /*    width: 40px;*/
        /*    text-align: center;*/
        /*}*/

        /*.orders-table th:nth-child(8) {*/
        /*    width: 80px;*/
        /*    text-align: right;*/
        /*}*/

        /*.orders-table th:nth-child(9) {*/
        /*    width: 80px;*/
        /*    text-align: right;*/
        /*}*/

        .orders-table td {
            padding: 12px 8px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        .orders-table td:first-child {
            text-align: center;
        }

        .orders-table td:nth-child(2) {
            text-align: center;
        }

        .orders-table td:nth-child(6) {
            text-align: center;
            color: #666;
            font-size: 11px;
        }

        .orders-table td:nth-child(7) {
            text-align: center;
        }

        .orders-table td:nth-child(8) {
            text-align: right;
        }

        .orders-table td:nth-child(9) {
            text-align: right;
        }

        .orders-table tr:hover {
            background-color: #f8f9fa;
        }

        .checkbox-cell {
            width: 40px;
        }

        .platform-cell {
            width: 40px;
            text-align: center;
        }

        .platform-icon {
            width: 24px;
            height: 24px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 10px;
            text-align: center;
        }

        .platform-icon.bricklink {
            background-color: #00A651;
        }

        .platform-icon.brickowl {
            background-color: #8B4513;
        }

        .platform-icon.brickscout {
            background-color: #FF6B35;
        }

        .platform-icon.crocobricks {
            background-color: #228B22;
        }

        .platform-icon.bol {
            background-color: #0033CC;
        }

        .platform-icon.amazon {
            background-color: #FF9900;
        }

        .platform-icon.ebay {
            background-color: #E53238;
        }

        .platform-icon.shopify {
            background-color: #96BF48;
        }

        .platform-icon.vinted {
            background-color: #00C896;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-pending {
            background-color: #FFF3CD;
            color: #856404;
        }

        .status-processing {
            background-color: #D1ECF1;
            color: #0C5460;
        }

        .status-ready {
            background-color: #D4EDDA;
            color: #155724;
        }

        .status-paid {
            background-color: #CCE5FF;
            color: #004085;
        }

        .status-pickup {
            background-color: #E2E3E5;
            color: #383D41;
        }

        .status-incomplete {
            background-color: #F8D7DA;
            color: #721C24;
        }

        .order-number {
            font-family: monospace;
            font-weight: 500;
            color: #0066CC;
            text-decoration: none;
        }

        .order-number:hover {
            text-decoration: underline;
        }

        .order-details {
            font-size: 11px;
            color: #0066CC;
            text-decoration: none;
        }

        .order-details:hover {
            text-decoration: underline;
        }

        .action-cell {
            text-align: center;
            width: 40px;
        }

        .action-link {
            color: #0066CC;
            text-decoration: none;
            font-size: 12px;
        }

        .action-link:hover {
            text-decoration: underline;
        }

        .price {
            font-weight: 500;
            text-align: right;
        }

        .date {
            color: #666;
            font-size: 12px;
        }

        .country-code {
            color: #666;
            font-size: 11px;
            text-align: center;
        }

        .section-content {
            display: block;
        }

        .section-content.collapsed {
            display: none;
        }

        /* Mobile & Tablet Optimalisatie */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 10px 0;
                order: 2;
            }

            .nav-item {
                padding: 8px 15px;
                font-size: 14px;
            }

            .main-content {
                order: 1;
            }

            .header {
                padding: 15px;
                flex-direction: column;
                gap: 10px;
            }

            .header-actions {
                flex-wrap: wrap;
                gap: 8px;
            }

            .header-btn {
                padding: 6px 12px;
                font-size: 12px;
            }

            .content {
                margin: 10px;
            }

            .content-header {
                padding: 15px;
            }

            .filters {
                flex-direction: column;
                gap: 10px;
                align-items: stretch;
            }

            .search-input {
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                padding: 15px;
                gap: 15px;
            }

            .stat-value {
                font-size: 24px;
            }

            .warning-banner {
                margin: 10px;
                padding: 12px 15px;
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .section-header {
                padding: 12px 15px;
                flex-wrap: wrap;
                gap: 10px;
            }

            .section-actions {
                flex-direction: column;
                gap: 5px;
            }

            /* Collapsible columns voor kleine schermen */
            .orders-table {
                font-size: 12px;
            }

            .orders-table th:nth-child(3),
            /* Created */
            .orders-table td:nth-child(3) {
                display: none;
            }

            .orders-table th:nth-child(6),
            /* Email icon */
            .orders-table td:nth-child(6) {
                display: none;
            }

            .orders-table th:nth-child(7),
            /* Print icon */
            .orders-table td:nth-child(7) {
                display: none;
            }

            .orders-table th:nth-child(8),
            /* Subtotal */
            .orders-table td:nth-child(8) {
                display: none;
            }

            .platform-icon {
                width: 20px;
                height: 20px;
                font-size: 9px;
            }

            .status-badge {
                font-size: 10px;
                padding: 3px 6px;
            }

            .order-details {
                font-size: 10px;
            }
        }

        @media (max-width: 480px) {

            .orders-table th:nth-child(4),
            /* Status */
            .orders-table td:nth-child(4) {
                display: none;
            }

            .orders-table td:nth-child(5) {
                font-size: 11px;
            }

            .platform-icon {
                width: 18px;
                height: 18px;
                font-size: 8px;
            }

            .section-count {
                font-size: 10px;
                padding: 1px 6px;
            }
        }

        /* Show/hide columns toggle */
        .column-toggle {
            display: none;
            background: #f8f9fa;
            padding: 10px 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .column-toggle label {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-right: 15px;
            font-size: 12px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .column-toggle {
                display: block;
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
        
        <!--<div class="sidebar-wrapper">-->
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
                <h1>Orders</h1>
                <div class="header-actions">
                    <!--<button class="header-btn">Tools ⌄</button>-->
                    <button onclick="location.reload()" class="header-btn">🔄 Refresh</button>
                    <!--<button class="header-btn primary">Bulk-process orders</button>-->
                    <a href="logout"><button class="logout-btn">Log out</button></a>
                </div>
            </div>

            <div class="content">
                <div class="content-header">
                    <div class="content-title">
                        <h2>Orders</h2>
                    </div>
                    <div class="last-refresh">Last refresh: <?= date('H:i') ?></div>

                    <div class="filters">
                        <div class="filter-label">
                            🔍 Filters:
                        </div>
                        <input type="text" id="searchInput" class="search-input"
                            placeholder="Zoek op ordernummer of klantnaam...">
                            
                        <select id="marketplaceInput" class="filter-select">
                            <option> -- Select Marketplace -- </option>
                                <option value="amazon">Amazon</option>
                                <option value="bricklink">Bricklink</option>
                                <option value="brickowl">Brickowl</option>
                                <option value="brickscout">Brickscout</option>
                                <option value="ebay">ebay</option>
                                <option value="shopify">Shopify</option>
                                <option value="vinted">Vinted</option>
                                <option value="woocommerce">Woocommerce</option>
                                <option value="bolcom">Bolcom</option>
                        </select>
                        
                        <select id="marketplaceOrderIdInput" class="filter-select">
                            <option> -- Select Order -- </option>
                            @foreach ($all_orders as $order)
                                <option value="{{ $order->marketplace_order_id }}">{{ $order->marketplace_order_id }}</option>
                            @endforeach
                        </select>
                        <select id="customerNameInput" class="filter-select" style="width: 200px;">
                            <option> -- Select Customer -- </option>
                            @foreach ($all_orders as $order)
                                <option value="{{ $order->customer_name }}">{{ $order->customer_name }}</option>
                            @endforeach
                        </select>
                        <input type="text" id="orderAmountInput" class="search-input"
                            placeholder="Input Order Amount...">
                        <!--<select class="filter-select">-->
                        <!--    <option>Order amount</option>-->
                        <!--</select>-->
                        <!--<select class="filter-select">-->
                        <!--    <option>Picker</option>-->
                        <!--</select>-->
                        <button onclick="location.reload()" class="btn btn-sm btn-success" style="padding:5px; background-color:#2296F3; border-color:#2296F3; border-radius:5px; color:white; cursor: pointer;">
                            Reset
                        </button>

                    </div>
                </div>

                <!--<div class="warning-banner">-->
                <!--    <div class="warning-content">-->
                <!--        <span class="warning-icon">⚠️</span>-->
                <!--        <div class="warning-text">-->
                <!--            <strong>You do not have all the ordered items in stock.</strong>-->
                <!--            3 items have been ordered of which you do not have enough stock.-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <a href="#" class="warning-btn">Show missing items ></a>-->
                <!--</div>-->

                <!--<div class="warning-banner" style="background: #FFE6E6; border-color: #FFB3B3;">-->
                <!--    <div class="warning-content">-->
                <!--        <span class="warning-icon" style="color: #D32F2F;">🔔</span>-->
                <!--        <div class="warning-text" style="color: #D32F2F;">-->
                <!--            <strong>Low stock alert!</strong>-->
                <!--            5 items are running low on stock (< 10 pieces remaining).-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <a href="#" class="warning-btn">View low stock items ></a>-->
                <!--</div>-->

                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-label">Orders this month</div>
                            <div class="stat-value">{{ $order_this_month }}</div>
                            <div class="stat-chart"></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">Items sold this month</div>
                            <div class="stat-value">{{ $items_sold_this_month }}</div>
                            <div class="stat-chart"></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">AVG daily revenue</div>
                            <div class="stat-value">€{{ round($averageDailyRevenue, 2) }}</div>
                            <div class="stat-chart"></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">Revenue this month</div>
                            <div class="stat-value">€{{ $revenue_this_month }}</div>
                            <div class="stat-chart"></div>
                        </div>
                    </div>

                    @php
$sections = [
    ['orders' => $waiting_invoice_orders, 'id' => 'waiting-invoice', 'title' => 'Waiting for an invoice', 'status' => 'to_be_picked', 'checkboxClass' => 'order-checkbox-waiting', 'button' => 'Mark as Invoice'],
    ['orders' => $to_be_picked_orders, 'id' => 'to-be-picked', 'title' => 'To be picked', 'status' => 'ready_to_pack', 'checkboxClass' => 'order-checkbox', 'button' => 'Mark as Picked'],
    ['orders' => $ready_to_packed_orders, 'id' => 'ready-to-be-packed', 'title' => 'Ready to be packed', 'status' => 'shipped', 'checkboxClass' => 'order-checkbox-ready', 'button' => 'Mark as Packed'],
    ['orders' => $waiting_for_payment_orders, 'id' => 'waiting-payment', 'title' => 'Waiting for a payment', 'status' => 'waiting_invoice', 'checkboxClass' => 'order-checkbox-payment', 'button' => 'Mark as Paid'],
];
@endphp

@foreach ($sections as $section)
<form action="{{ route('orders.changeStatus', $section['status']) }}" method="POST" onsubmit="return validateOrders('{{ $section['id'] }}', '{{ $section['checkboxClass'] }}')">
    @csrf
    <div class="order-section">
        <div class="section-header {{ (count($section['orders']) > 0) ? '' : 'collapsed' }}" onclick="toggleSection('{{ $section['id'] }}')">
            <div class="section-title">
                <span class="expand-icon">▼</span>
                <span>{{ $section['title'] }}</span>
                <span class="section-count">{{ count($section['orders']) }}</span>
            </div>
            <button type="submit" class="header-btn primary" onclick="event.stopPropagation()">{{ $section['button'] }}</button>
        </div>

        <div class="section-content {{ (count($section['orders']) > 0) ? '' : 'collapsed' }}" id="{{ $section['id'] }}">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="select-all" data-checkbox-class="{{ $section['checkboxClass'] }}" style="cursor:pointer;"></th>
                        <th></th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Customer Name</th>
                        <th>✉</th>
                        <th>📄</th>
                        <th>Subtotal</th>
                        <th>Grandtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($section['orders'] as $order)
                        @php
                            $class = match($order->status) {
                                'completed' => 'status-paid',
                                'cancelled' => 'status-incomplete',
                                default => 'status-pending',
                            };
                        @endphp
                        <tr>
                            <td><input type="checkbox" name="orders[]" value="{{ $order->id }}" class="{{ $section['checkboxClass'] }}"></td>
                            <td class="platform-cell">
                                <div class="platform-icon">{{ substr($order->marketplace_type, 0, 2) }}</div>
                            </td>
                            <td class="date">{{ date('d M Y', strtotime($order->created_at)) }}</td>
                            <td><span class="{{ $class }} status-badge">{{ $order->status }}</span></td>
                            <td>
                                <a href="http://a400wsckk88ogos84woksgog.185.222.240.190.sslip.io/order-detail/{{ $order->marketplace_order_id }}" class="order-number">#{{ $order->order_number }}</a><br>
                                <a href="http://a400wsckk88ogos84woksgog.185.222.240.190.sslip.io/order-detail/{{ $order->marketplace_order_id }}" class="order-details">{{ $order->marketplace_type }} #{{ $order->marketplace_order_id }}</a>
                            </td>
                            <td>{{ $order->customer_name }}</td>
                            <td style="text-align:left;">NL</td>
                            <td style="text-align:left;">✉</td>
                            <td style="text-align:left;" class="price">€{{ $order->subtotal }}</td>
                            <td style="text-align:left;" class="price order-total-amount">€{{ $order->total_amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</form>
@endforeach

<script>
    // Global Select All
    document.querySelectorAll('.select-all').forEach(selectAll => {
        selectAll.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.' + this.dataset.checkboxClass);
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    });

    // Global validation
    function validateOrders(sectionId, checkboxClass) {
        const checkboxes = document.querySelectorAll('#' + sectionId + ' .' + checkboxClass + ':checked');
        if (checkboxes.length === 0) {
            alert('Please select at least one order.');
            return false;
        }
        return true;
    }
</script>


                </div>
            </div>
        </div>

        <script>
            // Updated order data with all marketplaces
            const allOrders = [
                { orderNumber: '#7447', customerName: 'Jan Janssen', platform: 'bricklink', details: 'BrickLink #12920880' },
                { orderNumber: '#7504', customerName: 'Marie de Vries', platform: 'crocobricks', details: 'CrocoBricks #7504' },
                { orderNumber: '#7503', customerName: 'Peter Bakker', platform: 'crocobricks', details: 'CrocoBricks #7503' },
                { orderNumber: '#7268', customerName: 'Lisa van der Berg', platform: 'brickowl', details: 'BrickOwl #2679613' },
                { orderNumber: '#7265', customerName: 'Tom Smits', platform: 'brickscout', details: 'BrickScout #4685ee18' },
                { orderNumber: '#7223', customerName: 'Anna Klaassen', platform: 'brickowl', details: 'BrickOwl #6002405' },
                { orderNumber: '#7134', customerName: 'Rob van Dijk', platform: 'brickscout', details: 'BrickScout #b8f0a5ce' },
                { orderNumber: '#7121', customerName: 'Sophie Martens', platform: 'shopify', details: 'Shopify #5542018' },
                { orderNumber: '#7118', customerName: 'Claire Dubois', platform: 'vinted', details: 'Vinted #V98745632' },
                { orderNumber: '#7458', customerName: 'Hans Mueller', platform: 'amazon', details: 'Amazon #171-4756384' },
                { orderNumber: '#7456', customerName: 'Kees de Jong', platform: 'bol', details: 'Bol.com #3287495611' },
                { orderNumber: '#7454', customerName: 'Emma Vermeulen', platform: 'vinted', details: 'Vinted #V88745621' },
                { orderNumber: '#7480', customerName: 'Mark van Leeuwen', platform: 'ebay', details: 'eBay #9204832' },
                { orderNumber: '#7432', customerName: 'Julie Rousseau', platform: 'shopify', details: 'Shopify #5012847' },
                { orderNumber: '#7428', customerName: 'Wolfgang Schmidt', platform: 'amazon', details: 'Amazon #171-9856321' },
                { orderNumber: '#7420', customerName: 'Sarah Janssens', platform: 'vinted', details: 'Vinted #V78965412' }
            ];

            function toggleSection(sectionId) {
                const content = document.getElementById(sectionId);
                const header = content.previousElementSibling;

                if (content.classList.contains('collapsed')) {
                    content.classList.remove('collapsed');
                    header.classList.remove('collapsed');
                } else {
                    content.classList.add('collapsed');
                    header.classList.add('collapsed');
                }
            }

            function toggleColumn(columnIndex) {
                const tables = document.querySelectorAll('.orders-table');
                tables.forEach(table => {
                    const headerCell = table.querySelector(`th:nth-child(${columnIndex})`);
                    const dataCells = table.querySelectorAll(`td:nth-child(${columnIndex})`);

                    if (headerCell) {
                        headerCell.style.display = headerCell.style.display === 'none' ? '' : 'none';
                    }
                    dataCells.forEach(cell => {
                        cell.style.display = cell.style.display === 'none' ? '' : 'none';
                    });
                });
            }

            // Search functionaliteit
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('searchInput');
                const marketplaceInput = document.getElementById('marketplaceInput');
                const marketplaceOrderIdInput = document.getElementById('marketplaceOrderIdInput');
                const customerNameInput = document.getElementById('customerNameInput');
                const orderAmountInput = document.getElementById('orderAmountInput');
                const allRows = document.querySelectorAll('.orders-table tbody tr');

                searchInput.addEventListener('input', function (e) {
                    const searchTerm = e.target.value.toLowerCase();

                    allRows.forEach(row => {
                        const orderNumber = row.querySelector('.order-number')?.textContent.toLowerCase() || '';
                        const orderDetails = row.querySelector('.order-details')?.textContent.toLowerCase() || '';
                        const rowText = row.textContent.toLowerCase();

                        const isMatch = orderNumber.includes(searchTerm) ||
                            orderDetails.includes(searchTerm) ||
                            rowText.includes(searchTerm);

                        row.style.display = isMatch ? '' : 'none';
                    });

                    // Update section counts
                    updateSectionCounts();
                });
                marketplaceOrderIdInput.addEventListener('input', function (e) {
                    const searchTerm = e.target.value.toLowerCase();

                    allRows.forEach(row => {
                        const orderNumber = row.querySelector('.order-number')?.textContent.toLowerCase() || '';
                        const orderDetails = row.querySelector('.order-details')?.textContent.toLowerCase() || '';
                        const rowText = row.textContent.toLowerCase();

                        const isMatch = orderNumber.includes(searchTerm) ||
                            orderDetails.includes(searchTerm) ||
                            rowText.includes(searchTerm);

                        row.style.display = isMatch ? '' : 'none';
                    });

                    // Update section counts
                    updateSectionCounts();
                });
                
                marketplaceInput.addEventListener('input', function (e) {
                    const searchTerm = e.target.value.toLowerCase();

                    allRows.forEach(row => {
                        const orderNumber = row.querySelector('.order-number')?.textContent.toLowerCase() || '';
                        const orderDetails = row.querySelector('.order-details')?.textContent.toLowerCase() || '';
                        const rowText = row.textContent.toLowerCase();

                        const isMatch = orderNumber.includes(searchTerm) ||
                            orderDetails.includes(searchTerm) ||
                            rowText.includes(searchTerm);

                        row.style.display = isMatch ? '' : 'none';
                    });

                    // Update section counts
                    updateSectionCounts();
                });
                
                
                customerNameInput.addEventListener('input', function (e) {
                    const searchTerm = e.target.value.toLowerCase();

                    allRows.forEach(row => {
                        const orderNumber = row.querySelector('.order-number')?.textContent.toLowerCase() || '';
                        const orderDetails = row.querySelector('.order-details')?.textContent.toLowerCase() || '';
                        const rowText = row.textContent.toLowerCase();

                        const isMatch = orderNumber.includes(searchTerm) ||
                            orderDetails.includes(searchTerm) ||
                            rowText.includes(searchTerm);

                        row.style.display = isMatch ? '' : 'none';
                    });

                    // Update section counts
                    updateSectionCounts();
                });
                orderAmountInput.addEventListener('input', function (e) {
                    const searchTerm = e.target.value.toLowerCase();

                    allRows.forEach(row => {
                        const orderTotalAmount = row.querySelector('.order-total-amount')?.textContent.toLowerCase() || '';
                        const isMatch = orderTotalAmount.includes(searchTerm);

                        row.style.display = isMatch ? '' : 'none';
                    });

                    // Update section counts
                    updateSectionCounts();
                });
                
            });

            function updateSectionCounts() {
                const sections = document.querySelectorAll('.order-section');
                sections.forEach(section => {
                    const visibleRows = section.querySelectorAll('.orders-table tbody tr:not([style*="display: none"])');
                    const countBadge = section.querySelector('.section-count');
                    if (countBadge) {
                        countBadge.textContent = visibleRows.length;
                    }
                });
            }

            // Highlight search results
            function highlightSearchTerm(text, term) {
                if (!term) return text;
                const regex = new RegExp(`(${term})`, 'gi');
                return text.replace(regex, '<mark>$1</mark>');
            }
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