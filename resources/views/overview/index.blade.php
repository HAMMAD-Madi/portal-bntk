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
            width: 300px;
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
            /*font-weight: 500;*/
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
            /*font-weight: 500;*/
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
        }

        .orders-table td:nth-child(5) {
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
            /*font-weight: 500;*/
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
            /*font-weight: 500;*/
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
            /*font-weight: 500;*/
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

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }


        /*.logo {*/
        /*    padding: 0 20px 20px 20px;*/
        /*    font-weight: bold;*/
        /*    font-size: 18px;*/
        /*    color: #333;*/
        /*}*/

        .expand-icon {
            margin-left: auto;
            transition: transform 0.2s;
        }

        .expanded .expand-icon {
            transform: rotate(90deg);
        }

        .main-content {
            flex: 1;
            background-color: #4CAF50;
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

        .breadcrumb {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 5px;
        }

        .logout-btn {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            text-decoration: underline;
            font-size: 14px;
        }

        .content {
            background-color: white;
            margin: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .stat-card.blue {
            background: linear-gradient(135deg, #2196F3, #42A5F5);
            box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3);
        }

        .stat-card.orange {
            background: linear-gradient(135deg, #FF9800, #FFB74D);
            box-shadow: 0 4px 12px rgba(255, 152, 0, 0.3);
        }

        .stat-card.red {
            background: linear-gradient(135deg, #F44336, #EF5350);
            box-shadow: 0 4px 12px rgba(244, 67, 54, 0.3);
        }

        .stat-card.purple {
            background: linear-gradient(135deg, #9C27B0, #BA68C8);
            box-shadow: 0 4px 12px rgba(156, 39, 176, 0.3);
        }

        .stat-icon {
            font-size: 24px;
            margin-bottom: 10px;
            display: block;
        }

        .stat-value {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            opacity: 0.9;
        }

        .toolbar {
            display: flex;
            gap: 15px;
            align-items: center;
            margin-bottom: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            min-width: 150px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .filter-btn {
            background: white;
            border: 1px solid #ddd;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            min-width: 120px;
        }

        .filter-btn:hover {
            background: #f8f9fa;
        }

        .action-btn {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            /*font-weight: 500;*/
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s;
        }

        .action-btn:hover {
            background: #45a049;
        }

        .action-btn.secondary {
            background: #6c757d;
        }

        .action-btn.secondary:hover {
            background: #5a6268;
        }

        .view-toggle {
            display: flex;
            border: 1px solid #ddd;
            border-radius: 6px;
            overflow: hidden;
        }

        .view-btn {
            background: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
        }

        .view-btn.active {
            background: #4CAF50;
            color: white;
        }

        .inventory-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .inventory-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s;
            position: relative;
        }

        .inventory-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-checkbox {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 2;
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            position: relative;
        }

        .stock-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #4CAF50;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .stock-badge.low {
            background: #FF9800;
        }

        .stock-badge.out {
            background: #F44336;
        }

        .profit-badge {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: rgba(76, 175, 80, 0.9);
            color: white;
            padding: 4px 8px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
        }

        .profit-badge.high {
            background: rgba(76, 175, 80, 0.9);
        }

        .profit-badge.medium {
            background: rgba(255, 152, 0, 0.9);
        }

        .profit-badge.low {
            background: rgba(244, 67, 54, 0.9);
        }

        .card-content {
            padding: 16px;
        }

        .item-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }

        .item-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 12px;
            font-size: 13px;
            color: #666;
        }

        .item-price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .current-price {
            font-size: 18px;
            font-weight: bold;
            color: #4CAF50;
        }

        .avg-price {
            font-size: 12px;
            color: #666;
        }

        .card-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 8px;
        }

        .card-actions-bottom {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .icon-btn {
            background: none;
            border: 1px solid #ddd;
            padding: 8px;
            border-radius: 6px;
            cursor: pointer;
            color: #666;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            font-size: 12px;
        }

        .icon-btn:hover {
            background: #f8f9fa;
            border-color: #4CAF50;
            color: #4CAF50;
        }

        .icon-btn.info {
            border-color: #2196F3;
            color: #2196F3;
        }

        .icon-btn.info:hover {
            background: #E3F2FD;
            border-color: #1976D2;
            color: #1976D2;
        }

        .icon-btn.trends {
            border-color: #9C27B0;
            color: #9C27B0;
        }

        .icon-btn.trends:hover {
            background: #F3E5F5;
            border-color: #7B1FA2;
            color: #7B1FA2;
        }

        .bulk-actions {
            background: #f8f9fa;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .bulk-btn {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .bulk-btn:hover {
            background: #45a049;
        }

        .bulk-btn.secondary {
            background: #6c757d;
        }

        .bulk-btn.secondary:hover {
            background: #5a6268;
        }

        .bulk-btn.danger {
            background: #dc3545;
        }

        .bulk-btn.danger:hover {
            background: #c82333;
        }

        .select-all {
            margin-right: 15px;
        }

        .table-view {
            display: none;
        }

        .table-view.active {
            display: block;
        }

        .inventory-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .inventory-table th {
            background: #f8f9fa;
            padding: 12px 15px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #666;
            border-bottom: 1px solid #e0e0e0;
        }

        .inventory-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
        }

        .inventory-table tr:hover {
            background-color: #f8f9fa;
        }

        .table-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .condition-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .condition-new {
            background: #E8F5E8;
            color: #4CAF50;
        }

        .condition-used {
            background: #FFF3E0;
            color: #FF9800;
        }

        .category-tag {
            background: #E3F2FD;
            color: #2196F3;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 600;
        }


        .quick-add-fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.4);
            transition: all 0.3s;
            z-index: 1000;
        }

        .quick-add-fab:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.6);
        }

        /* Modal styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 10000;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .modal-overlay.show {
            display: flex !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .modal {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 700px;
            max-height: 90vh;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            background: #4CAF50;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 20px;
            font-weight: 600;
        }

        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background-color 0.2s;
        }

        .close-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .modal-body {
            padding: 30px;
            max-height: 60vh;
            overflow-y: auto;
        }

        .modal-tabs {
            display: flex;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 20px;
        }

        .tab-btn {
            background: none;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            font-size: 14px;
            color: #666;
            border-bottom: 2px solid transparent;
            transition: all 0.2s;
        }

        .tab-btn.active {
            color: #4CAF50;
            border-bottom-color: #4CAF50;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .product-info h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 16px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 10px 20px;
            margin-bottom: 20px;
        }

        .info-label {
            font-weight: 600;
            color: #666;
        }

        .info-value {
            color: #333;
        }

        .marketplace-list {
            display: grid;
            gap: 15px;
        }

        .marketplace-item {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            transition: all 0.2s;
        }

        .marketplace-item:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .marketplace-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .marketplace-icon {
            width: 24px;
            height: 24px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }

        .marketplace-icon.bricklink {
            background: #ff6600;
        }

        .marketplace-icon.brickowl {
            background: #4a90e2;
        }

        .marketplace-icon.ebay {
            background: #e53238;
        }

        .marketplace-icon.bol {
            background: #0166d5;
        }

        .marketplace-icon.catawiki {
            background: #f5821f;
        }

        .marketplace-name {
            font-weight: 600;
            color: #333;
        }

        .marketplace-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
            font-size: 13px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            color: #666;
            font-size: 11px;
            margin-bottom: 2px;
        }

        .detail-value {
            color: #333;
            /*font-weight: 500;*/
        }

        .status-badge {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background: #e8f5e8;
            color: #4caf50;
        }

        .status-paused {
            background: #fff3e0;
            color: #ff9800;
        }

        .status-inactive {
            background: #ffebee;
            color: #f44336;
        }

        /* Price Trends Chart */
        .chart-container {
            width: 100%;
            height: 300px;
            margin-bottom: 20px;
            position: relative;
            background: #f8f9fa;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
        }

        .trend-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        .trend-stat {
            text-align: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .trend-value {
            font-size: 24px;
            font-weight: bold;
            color: #4CAF50;
        }

        .trend-label {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        .trend-change {
            font-size: 12px;
            margin-top: 3px;
        }

        .trend-up {
            color: #4CAF50;
        }

        .trend-down {
            color: #F44336;
        }

        /* Edit Form Styles */
        .modal-large {
            max-width: 900px;
            width: 95%;
        }

        .edit-form {
            padding: 0;
        }

        .edit-tabs {
            display: flex;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 30px;
            overflow-x: auto;
        }

        .edit-tab-btn {
            background: none;
            border: none;
            padding: 15px 20px;
            cursor: pointer;
            font-size: 14px;
            color: #666;
            border-bottom: 2px solid transparent;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .edit-tab-btn.active {
            color: #4CAF50;
            border-bottom-color: #4CAF50;
            font-weight: 600;
        }

        .edit-tab-btn:hover {
            color: #4CAF50;
        }

        .edit-tab-content {
            display: none;
        }

        .edit-tab-content.active {
            display: block;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
            font-size: 14px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.2s;
            background: white;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.1);
        }

        .form-group input[readonly] {
            background: #f8f9fa;
            color: #666;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
            font-family: inherit;
        }

        .char-counter {
            font-size: 12px;
            color: #666;
            margin-top: 4px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            margin-top: 30px;
        }

        .btn-primary,
        .btn-secondary {
            padding: 12px 24px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .btn-primary {
            background: #4CAF50;
            color: white;
        }

        .btn-primary:hover {
            background: #45a049;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #666;
            border: 1px solid #ddd;
        }

        .btn-secondary:hover {
            background: #e9ecef;
        }

        /* Image Tab Styles */
        .images-header {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #4CAF50;
        }

        .images-header h3 {
            color: #4CAF50;
            font-size: 20px;
            margin-bottom: 5px;
        }

        .images-header p {
            color: #666;
            font-size: 14px;
        }

        .single-url-section,
        .primary-image-section,
        .gallery-images-section,
        .gallery-url-section,
        .image-requirements {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .single-url-section h4,
        .primary-image-section h4,
        .gallery-images-section h4,
        .gallery-url-section h4,
        .image-requirements h4 {
            color: #333;
            font-size: 16px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .single-url-input {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .url-test-btn {
            background: #2196F3;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .url-test-btn:hover {
            background: #1976D2;
        }

        .url-preview {
            margin-top: 15px;
            display: none;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: #f8f9fa;
        }

        .url-preview img {
            max-width: 150px;
            max-height: 150px;
            border-radius: 4px;
        }

        .preview-info {
            margin-left: 15px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .preview-info span {
            font-size: 12px;
        }

        .upload-area {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 40px 20px;
            text-align: center;
            background: #fafafa;
            transition: all 0.3s;
            cursor: pointer;
        }

        .upload-area:hover,
        .upload-area.dragover {
            border-color: #4CAF50;
            background: #f0f8f0;
        }

        .upload-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .upload-content p {
            margin: 8px 0;
            color: #666;
        }

        .upload-btn {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .upload-btn:hover {
            background: #45a049;
        }

        .primary-image-preview {
            width: 100%;
            min-height: 200px;
            border-radius: 8px;
            overflow: hidden;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .primary-image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .primary-image-preview.has-image {
            border: 2px solid #4CAF50;
        }

        .upload-placeholder {
            text-align: center;
            color: #666;
        }

        .primary-image-actions {
            margin-top: 15px;
            display: none;
            gap: 10px;
        }

        .action-btn.danger {
            background: #f44336;
        }

        .action-btn.danger:hover {
            background: #d32f2f;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .gallery-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .gallery-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        .gallery-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            opacity: 0;
            transition: opacity 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-delete-btn {
            background: #f44336;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        .gallery-url-group {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-bottom: 15px;
        }

        .gallery-url-group input {
            flex: 1;
        }

        .url-add-btn {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            white-space: nowrap;
        }

        .url-add-btn:hover {
            background: #45a049;
        }

        .add-url-field-btn {
            background: #f8f9fa;
            color: #666;
            border: 1px solid #ddd;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 15px;
        }

        .add-url-field-btn:hover {
            background: #e9ecef;
        }

        .requirements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .requirement-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #4CAF50;
        }

        .requirement-icon {
            font-size: 24px;
            flex-shrink: 0;
        }

        .requirement-text {
            font-size: 14px;
            line-height: 1.4;
        }

        .requirement-text strong {
            color: #333;
        }

        /* Stock Modal Styles */
        .stock-info {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 30px;
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .current-stock {
            text-align: center;
        }

        .current-stock h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .stock-display {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .stock-number {
            font-size: 48px;
            font-weight: bold;
            color: #4CAF50;
            line-height: 1;
        }

        .stock-label {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }

        .product-summary h4 {
            color: #333;
            font-size: 18px;
            margin-bottom: 8px;
        }

        .product-summary p {
            color: #666;
            font-size: 14px;
        }

        .stock-form {
            display: grid;
            gap: 25px;
        }

        .stock-adjustment h3 {
            color: #333;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .adjustment-type {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .radio-option:hover {
            background: #f8f9fa;
        }

        .radio-option input[type="radio"]:checked+span {
            color: #4CAF50;
            font-weight: 600;
        }

        .radio-option input[type="radio"] {
            margin: 0;
        }

        .adjustment-input {
            display: grid;
            gap: 8px;
        }

        .adjustment-input input {
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            text-align: center;
        }

        .adjustment-input input:focus {
            border-color: #4CAF50;
        }

        .adjustment-reason,
        .adjustment-note {
            display: grid;
            gap: 8px;
        }

        .adjustment-reason select,
        .adjustment-note textarea {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .new-stock-preview {
            text-align: center;
            padding: 20px;
            background: #E8F5E8;
            border-radius: 8px;
        }

        .new-stock-preview h4 {
            color: #4CAF50;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .stock-preview {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .preview-number {
            font-size: 36px;
            font-weight: bold;
            color: #4CAF50;
            line-height: 1;
        }

        /* Notifications */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #4CAF50;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 10001;
            transform: translateX(400px);
            transition: transform 0.3s;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.error {
            background: #F44336;
        }

        .notification.warning {
            background: #FF9800;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .main-content {
                order: 1;
            }

            .content {
                margin: 10px;
                padding: 20px;
            }

            .toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .inventory-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 15px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .modal {
                width: 95%;
            }

            .modal-large {
                width: 98%;
                max-width: none;
                margin: 10px;
            }

            .modal-body {
                padding: 15px;
                max-height: 80vh;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .card-actions,
            .card-actions-bottom {
                grid-template-columns: 1fr;
                gap: 6px;
            }

            .edit-tabs {
                flex-wrap: nowrap;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .edit-tab-btn {
                flex-shrink: 0;
                padding: 12px 16px;
                font-size: 13px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-primary,
            .btn-secondary {
                width: 100%;
                margin-bottom: 8px;
            }

            .stock-info {
                grid-template-columns: 1fr;
                gap: 20px;
                text-align: center;
            }

            .adjustment-type {
                grid-template-columns: 1fr;
            }

            .single-url-input {
                flex-direction: column;
            }

            .single-url-input .url-test-btn {
                align-self: flex-start;
            }

            .gallery-url-group {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {

            .stats-grid,
            .inventory-grid {
                grid-template-columns: 1fr;
            }

            .modal-header {
                padding: 15px;
            }

            .modal-header h2 {
                font-size: 18px;
            }

            .edit-tab-btn {
                padding: 10px 12px;
                font-size: 12px;
            }
        }
    </style>
    <style>
        .sidebar-wrapper {
            position: relative;
            /* for ::before positioning */
            padding: 20px;
            /* space around sidebar */
            box-sizing: border-box;
            height: 100vh;
            /* keep sidebar full height */
        }

        /* Green background of only 300px height */
        .sidebar-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 300px;
            /* only this height is green */
            background-color: #4CAF50;
            z-index: -1;
            /* behind sidebar */
        }

        /* Sidebar stays full height and unchanged */
        .sidebar {
            width: 250px;
            height: 100%;
            /* full height */
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow:
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            padding: 0;
            position: relative;
            /* above ::before */
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
                                <div class="sub-item active" id="voorraad-overzicht-item">
                                    <a href="https://portal.bntk.eu/overview" class="nav-link" id="voorraad-overzicht-link">
                                        <span class="nav-icon">📊</span>
                                        <span class="nav-text">Overzicht</span>
                                    </a>
                                </div>

                                <!-- Put this CSS in your head or your stylesheet -->
                                <style>
                                    /* Base look */
                                    .sub-item .nav-link {
                                        color: #374151;
                                        /* dark gray */
                                        background-color: transparent;
                                        transition: all 0.2s ease-in-out;
                                    }

                                    /* Active styles */
                                    .sub-item.active .nav-link,
                                    .nav-link[aria-current="page"] {
                                        color: #fff;
                                        background-color: #60B864 !important;
                                        /* green */
                                        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.12);
                                    }

                                    /* Hover styles */
                                    .sub-item .nav-link:hover {
                                        color: black;
                                        background-color: #4da653;
                                        /* slightly darker green */
                                    }
                                </style>
                                <div class="sub-item">
                                    <a href="/scan-feature" class="nav-link">
                                        <span class="nav-icon">📸</span>
                                        <span class="nav-text">Scan Feature</span>
                                    </a>
                                </div>
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
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="header">
                <div>
                    <div class="breadcrumb">Pages / Voorraad / Overzicht</div>
                    <h1>Inventory Overzicht</h1>
                </div>
                <button class="logout-btn">Log out</button>
            </div>

            <div class="content">
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="stats-grid">
                    <div class="stat-card"><span class="stat-icon">📦</span>
                        <div class="stat-value"><?= $products_in_stock; ?></div>
                        <div class="stat-label">TOTAAL ITEMS</div>
                    </div>
                    <div class="stat-card blue"><span class="stat-icon">💰</span>
                        <div class="stat-value">€<?= number_format($product_total_value, 2); ?></div>
                        <div class="stat-label">TOTALE WAARDE</div>
                    </div>
                    <div class="stat-card orange"><span class="stat-icon">⚠️</span>
                        <div class="stat-value"><?= $product_with_low_stock; ?></div>
                        <div class="stat-label">LAGE VOORRAAD</div>
                    </div>
                    <div class="stat-card red"><span class="stat-icon">❌</span>
                        <div class="stat-value"><?= $product_out_of_stock; ?></div>
                        <div class="stat-label">UIT VOORRAAD</div>
                    </div>
                    <div class="stat-card purple"><span class="stat-icon">📈</span>
                        <div class="stat-value"><?= number_format($average_margin, 2); ?>%</div>
                        <div class="stat-label">WINST MARGE</div>
                    </div>
                </div>

                <div class="toolbar">
                    <div class="search-box">
                        <form method="GET" action="">
                            <input type="hidden" name="general_search" value="{{ request('general_search') }}">
                            <input type="hidden" name="desc_products" value="{{ request('desc_products') }}">
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            <input type="hidden" name="color" value="{{ request('color') }}">
                            <input type="hidden" name="condition" value="{{ request('condition') }}">
                            <input type="hidden" name="stock" value="{{ request('stock') }}">
                            <input type="text" placeholder="Zoek op item nummer, naam, categorie..." id="searchInput" name="general_search" value="<?= $_GET['general_search'] ?? NULL ?>"
                                onkeyup="searchItems()">
                        </form>
                        <span class="search-icon">🔍</span>
                    </div>


                    {{-- Category filter --}}
                    <form method="GET" action="">
                        <input type="hidden" name="general_search" value="{{ request('general_search') }}">
                        <input type="hidden" name="desc_products" value="{{ request('desc_products') }}">
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        <input type="hidden" name="color" value="{{ request('color') }}">
                        <input type="hidden" name="condition" value="{{ request('condition') }}">
                        <input type="hidden" name="stock" value="{{ request('stock') }}">

                        <style>
                            /* Make Select2 look like Bootstrap form-control */
                            .select2-container .select2-selection--single {
                                height: calc(2.25rem + 2px) !important;
                                /* same as form-control height */
                                border: 1px solid #ced4da !important;
                                border-radius: 0.375rem !important;
                                /* matches Bootstrap 5 radius */
                                padding: 0.375rem 0.75rem !important;
                                display: flex !important;
                                align-items: center !important;
                                width: 225px;
                            }

                            .select2-selection__arrow {
                                height: 100% !important;
                                right: 0.75rem !important;
                            }

                            .select2-selection__rendered {
                                color: #212529 !important;
                                line-height: 1.5 !important;
                            }

                            .select2-container--default .select2-selection--single:focus,
                            .select2-container--default.select2-container--focus .select2-selection--single {
                                border-color: #86b7fe !important;
                                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, .25) !important;
                                /* focus ring like Bootstrap */
                            }

                            .select2-dropdown {
                                border: 1px solid #ced4da !important;
                                border-radius: 0.375rem !important;
                            }
                        </style>

                        <!-- Select2 CSS -->
                        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

                        <!-- jQuery + Select2 JS -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

                        <select id="categorySelect" class="filter-btn form-control" name="category" style="width:50px;">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->title }}" {{ request('category') == $category->title ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                            @endforeach
                        </select>
                    </form>

                    {{-- Colors filter --}}
                    <form method="GET" action="">
                        <input type="hidden" name="general_search" value="{{ request('general_search') }}">
                        <input type="hidden" name="desc_products" value="{{ request('desc_products') }}">
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        <input type="hidden" name="item_type" value="{{ request('item_type') }}">
                        <input type="hidden" name="location" value="{{ request('location') }}">
                        <input type="hidden" name="color" value="{{ request('color') }}">
                        <input type="hidden" name="condition" value="{{ request('condition') }}">
                        <input type="hidden" name="stock" value="{{ request('stock') }}">
                        <select id="colorSelection" class="filter-btn" name="color" onchange="this.form.submit()">
                            <option value="">All Colors</option>
                            @foreach ($colors as $color)
                            <option value="{{ $color->bricklink_name }}" {{ request('color') == $color->bricklink_name ? 'selected' : '' }}>
                                {{ $color->bricklink_name }}
                            </option>
                            @endforeach
                        </select>
                        <script>
                            $(document).ready(function() {
                                $('#categorySelect').select2({
                                    placeholder: 'Select a Category',
                                    allowClear: true,
                                    width: '100%'
                                });

                                // Submit form when category changes
                                $('#categorySelect').on('change', function() {
                                    this.form.submit();
                                });
                            });
                            $(document).ready(function() {
                                $('#colorSelection').select2({
                                    placeholder: 'Select a Color',
                                    allowClear: true,
                                    width: '100%'
                                });

                                // Submit form when category changes
                                $('#categorySelect').on('change', function() {
                                    this.form.submit();
                                });
                            });
                        </script>
                    </form>

                    {{-- Condition filter --}}
                    <form method="GET" action="">
                        <input type="hidden" name="general_search" value="{{ request('general_search') }}">
                        <input type="hidden" name="desc_products" value="{{ request('desc_products') }}">
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        <input type="hidden" name="item_type" value="{{ request('item_type') }}">
                        <input type="hidden" name="location" value="{{ request('location') }}">
                        <input type="hidden" name="color" value="{{ request('color') }}">
                        <input type="hidden" name="condition" value="{{ request('condition') }}">
                        <input type="hidden" name="stock" value="{{ request('stock') }}">
                        <select class="filter-btn" name="condition" onchange="this.form.submit()">
                            <option value="">All Conditions</option>
                            <option value="New" {{ request('condition')=='New' ? 'selected' : '' }}>New</option>
                            <option value="Used" {{ request('condition')=='Used' ? 'selected' : '' }}>Used</option>
                        </select>
                    </form>

                    {{-- Item type filter --}}
                    <form method="GET" action="">
                        <input type="hidden" name="category" value="{{ request('general_search') }}">
                        <input type="hidden" name="desc_products" value="{{ request('desc_products') }}">
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        <input type="hidden" name="item_type" value="{{ request('item_type') }}">
                        <input type="hidden" name="location" value="{{ request('location') }}">
                        <input type="hidden" name="color" value="{{ request('color') }}">
                        <input type="hidden" name="condition" value="{{ request('condition') }}">
                        <input type="hidden" name="stock" value="{{ request('stock') }}">
                        <select class="filter-btn" name="item_type" onchange="this.form.submit()">
                            <option value="">Select Item Type</option>
                            <option value="MINIFIG" {{ request('item_type')=='MINIFIG' ? 'selected' : '' }}>MINIFIG</option>
                            <option value="PART" {{ request('item_type')=='PART' ? 'selected' : '' }}>PART</option>
                            <option value="SET" {{ request('item_type')=='SET' ? 'selected' : '' }}>SET</option>
                            <option value="BOOK" {{ request('item_type')=='BOOK' ? 'selected' : '' }}>BOOK</option>
                            <option value="GEAR" {{ request('item_type')=='GEAR' ? 'selected' : '' }}>GEAR</option>
                            <option value="CATALOG" {{ request('item_type')=='CATALOG' ? 'selected' : '' }}>CATALOG</option>
                            <option value="INSTRUCTION" {{ request('item_type')=='INSTRUCTION' ? 'selected' : '' }}>INSTRUCTION</option>
                            <option value="UNSORTED_LOT" {{ request('item_type')=='UNSORTED_LOT' ? 'selected' : '' }}>UNSORTED_LOT</option>
                            <option value="ORIGINAL_BOX" {{ request('item_type')=='ORIGINAL_BOX' ? 'selected' : '' }}>ORIGINAL_BOX</option>
                        </select>
                    </form>

                    {{-- Location --}}
                    <div class="search-box">
                        <form method="GET" action="">
                            <input type="hidden" name="category" value="{{ request('general_search') }}">
                            <input type="hidden" name="desc_products" value="{{ request('desc_products') }}">
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            <input type="hidden" name="item_type" value="{{ request('item_type') }}">
                            <input type="hidden" name="location" value="{{ request('location') }}">
                            <input type="hidden" name="color" value="{{ request('color') }}">
                            <input type="hidden" name="condition" value="{{ request('condition') }}">
                            <input type="hidden" name="stock" value="{{ request('stock') }}">
                            <input type="text" placeholder="Location" id="location" name="location" value="<?= $_GET['location'] ?? NULL ?>" onkeyup="searchItems()">
                        </form>
                    </div>

                    {{-- Stock filter --}}
                    <form method="GET" action="">
                        <input type="hidden" name="category" value="{{ request('general_search') }}">
                        <input type="hidden" name="desc_products" value="{{ request('desc_products') }}">
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        <input type="hidden" name="item_type" value="{{ request('item_type') }}">
                        <input type="hidden" name="location" value="{{ request('location') }}">
                        <input type="hidden" name="color" value="{{ request('color') }}">
                        <input type="hidden" name="condition" value="{{ request('condition') }}">
                        <input type="hidden" name="stock" value="{{ request('stock') }}">
                        <select class="filter-btn" name="stock" onchange="this.form.submit()">
                            <option value="">All Stock</option>
                            <option value="in" {{ request('stock')=='in' ? 'selected' : '' }}>In Stock</option>
                            <option value="low" {{ request('stock')=='low' ? 'selected' : '' }}>Low Stock</option>
                            <option value="out" {{ request('stock')=='out' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                    </form>

                    <!--<button class="action-btn" onclick="exportInventory()">📊 Export</button>-->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        function exportInventory() {
                            let rows = [];

                            // Add header row
                            rows.push(["Item No", "Name", "Category", "Condition", "Color", "Stock", "Price"]);

                            // Loop only through selected checkboxes
                            document.querySelectorAll(".inventory-card").forEach(card => {
                                let checkbox = card.querySelector(".card-checkbox");
                                if (checkbox && checkbox.checked) {
                                    let itemNo = card.dataset.item || "";
                                    let name = card.querySelector(".item-title")?.innerText.trim() || "";
                                    let category = card.dataset.category || "";
                                    let condition = card.dataset.condition || "";
                                    let color = card.querySelector(".item-details div:nth-child(3)")?.innerText.replace("Kleur:", "").trim() || "";
                                    let stock = card.dataset.stock || "";
                                    let price = card.querySelector(".current-price")?.innerText.replace("€", "").trim() || "";
                                    rows.push([itemNo, name, category, condition, color, stock, price]);
                                }
                            });

                            if (rows.length === 1) { // means only header row
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'No products selected',
                                    text: 'Please select at least one product to export.',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#4CAF51' // Bootstrap green, or any hex code
                                });
                                return;
                            }

                            // Convert array to CSV string
                            let csvContent = "data:text/csv;charset=utf-8," +
                                rows.map(e => e.map(v => `"${v}"`).join(",")).join("\n");

                            // Trigger download
                            let link = document.createElement("a");
                            link.setAttribute("href", encodeURI(csvContent));
                            link.setAttribute("download", "selected_products.csv");
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                        }
                    </script>


                    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
                    <style>
                        /* Rotation animation */
                        .spin {
                            animation: spin 1s linear infinite;
                        }

                        @keyframes spin {
                            0% {
                                transform: rotate(0deg);
                            }

                            100% {
                                transform: rotate(360deg);
                            }
                        }
                    </style>

                    <div style="position: relative; display: inline-block;" id="actionsDropdown">

                        <!-- Dropdown Toggle -->
                        <button
                            style="
                                background:#3b82f6;
                                color:white;
                                padding:10px 16px;
                                border:none;
                                border-radius:6px;
                                cursor:pointer;
                                font-size:14px;
                            "
                            onclick="toggleActionsDropdown()">
                            ⚙️ Actions
                        </button>

                        <!-- Dropdown Menu -->
                        <div
                            id="actionsMenu"
                            style="
                                display:none;
                                position:absolute;
                                background:white;
                                min-width:180px;
                                border-radius:6px;
                                box-shadow:0px 4px 8px rgba(0,0,0,0.15);
                                overflow:hidden;
                                z-index:999;
                            ">
                            <button
                                onclick="exportInventory()"
                                style="
                                    width:100%;
                                    padding:10px 14px;
                                    border:none;
                                    background:white;
                                    text-align:left;
                                    cursor:pointer;
                                    font-size:14px;
                                "
                                onmouseover="this.style.background='#f1f5f9'"
                                onmouseout="this.style.background='white'">
                                Export
                            </button>

                            <button
                                onclick="syncAllMarketplaces(this)"
                                style="
                                    width:100%;
                                    padding:10px 14px;
                                    border:none;
                                    background:white;
                                    text-align:left;
                                    cursor:pointer;
                                    font-size:14px;
                                "
                                onmouseover="this.style.background='#f1f5f9'"
                                onmouseout="this.style.background='white'">
                                Sync All
                            </button>

                            <button
                                onclick="bulkUpdateLocation()"
                                style="
                                    width:100%;
                                    padding:10px 14px;
                                    border:none;
                                    background:white;
                                    text-align:left;
                                    cursor:pointer;
                                    font-size:14px;
                                "
                                onmouseover="this.style.background='#f1f5f9'"
                                onmouseout="this.style.background='white'">
                                Bulk Location
                            </button>

                            <button
                                onclick="bulkUpdateRetired()"
                                style="
                                    width:100%;
                                    padding:10px 14px;
                                    border:none;
                                    background:white;
                                    text-align:left;
                                    cursor:pointer;
                                    font-size:14px;
                                "
                                onmouseover="this.style.background='#f1f5f9'"
                                onmouseout="this.style.background='white'">
                                Bulk Retired
                            </button>

                            <button
                                onclick="bulkUpdateLockPrice()"
                                style="
                                    width:100%;
                                    padding:10px 14px;
                                    border:none;
                                    background:white;
                                    text-align:left;
                                    cursor:pointer;
                                    font-size:14px;
                                "
                                onmouseover="this.style.background='#f1f5f9'"
                                onmouseout="this.style.background='white'">
                                Bulk Lock Price
                            </button>
                        </div>
                    </div>

                    @php
                    $isDesc = request('desc_products') == 1;
                    @endphp

                    <form method="GET" action="">
                        <!-- Preserve filters -->
                        <input type="hidden" name="general_search" value="{{ request('general_search') }}">
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        <input type="hidden" name="item_type" value="{{ request('item_type') }}">
                        <input type="hidden" name="location" value="{{ request('location') }}">
                        <input type="hidden" name="color" value="{{ request('color') }}">
                        <input type="hidden" name="condition" value="{{ request('condition') }}">
                        <input type="hidden" name="stock" value="{{ request('stock') }}">

                        @if($isDesc)
                        <!-- Clear descending -->
                        <button
                            type="submit"
                            name="desc_products"
                            value="0"
                            style="
                                background:#ef4444;
                                color:white;
                                padding:10px 16px;
                                border:none;
                                border-radius:6px;
                                cursor:pointer;
                                font-size:14px;
                            ">
                            ✕ Clear Descending
                        </button>
                        @else
                        <!-- Apply descending -->
                        <button
                            type="submit"
                            name="desc_products"
                            value="1"
                            style="
                                background:#3b82f6;
                                color:white;
                                padding:10px 16px;
                                border:none;
                                border-radius:6px;
                                cursor:pointer;
                                font-size:14px;
                            ">
                            ↓ Descending Products
                        </button>
                        @endif
                    </form>


                    <script>
                        function syncAllMarketplaces(btn) {
                            let icon = btn.querySelector("i");
                            setTimeout(() => {
                                location.reload();
                            }, 800);
                        }
                    </script>

                    <script>
                        function toggleActionsDropdown() {
                            let menu = document.getElementById("actionsMenu");
                            menu.style.display = menu.style.display === "block" ? "none" : "block";
                        }

                        document.addEventListener("click", function(e) {
                            const dropdown = document.getElementById("actionsDropdown");
                            const menu = document.getElementById("actionsMenu");

                            // If clicked outside dropdown, close it
                            if (!dropdown.contains(e.target)) {
                                menu.style.display = "none";
                            }
                        });
                    </script>
                </div>

                <!-- Inventory Grid -->
                <div class="inventory-grid" id="gridView">

                    <?php foreach ($products as $product) { ?>
                        <div class="inventory-card"
                            data-id="<?= $product->id; ?>"
                            data-category="<?= $product->category; ?>"
                            data-condition="<?= $product->condition; ?>"
                            data-stock="<?= $product->stock; ?>"
                            data-item="<?= $product->item_no; ?>"
                            data-location="<?= $product->location ?? '' ?>">

                            <input type="checkbox" class="card-checkbox">

                            <div class="card-image" style="position: relative; width: auto; height: 240px; overflow: hidden; border: 1px solid #ddd; border-radius: 6px; background: #fff; display:flex; align-items:center; justify-content:center;">
                                <img src="<?= !empty($product->imageurl) ? asset($product->imageurl) : asset($product->main_image) ?>"
                                    alt="Product Image"
                                    style="max-width: 100%; max-height: 100%; object-fit: contain;">

                                <div class="stock-badge"><?= $product->stock; ?></div>
                            </div>

                            <div class="card-content">
                                <div class="item-title"><?= $product->title; ?></div>
                                <div class="item-details">
                                    <div><strong>Item # </strong> <?= $product->item_no; ?></div>
                                    <div><strong>Categorie:</strong> <?= $product->category; ?></div>
                                    <div><strong>Kleur:</strong> <?= $product->color_name; ?></div>
                                    <div><strong>Conditie:</strong>
                                        <span class="condition-badge condition-new"><?= $product->condition; ?></span>
                                    </div>
                                    <span class="location-text"><?= $product->location ?? '' ?></span>
                                </div>
                                <div class="item-price">
                                    <span class="current-price">€<?= $product->price; ?></span>
                                </div>
                                <div class="card-actions">
                                    <button class="icon-btn" onclick="editItem('<?= $product->id; ?>')">✏️ Edit</button>
                                    <button class="icon-btn" onclick="adjustStock('<?= $product->id; ?>')">📊 Stock</button>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>

                <!-- =================== MODAL WITH INLINE CSS ONLY =================== -->
                <!-- Bulk Location Update Modal -->
                <div id="locationModal" class="hidden"
                    style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                        background: rgba(0,0,0,0.6); display: none; align-items: center; justify-content: center;
                        z-index: 999999;">

                    <div style="background: #fff; width: 420px; border-radius: 10px; overflow:hidden;
                        box-shadow: 0 4px 15px rgba(0,0,0,0.3);">

                        <!-- Header -->
                        <div style="display:flex; justify-content:space-between; align-items:center;
                            padding:15px 20px; border-bottom:1px solid #eee;">
                            <h2 style="margin:0; font-size:20px;">Update Bulk Location</h2>
                            <button onclick="closeModal()"
                                style="font-size:26px; background:none; border:none; cursor:pointer; line-height:1;">
                                &times;
                            </button>
                        </div>

                        <!-- Body -->
                        <div style="padding:20px;">

                            <div style="margin-bottom:20px;">
                                <label style="font-weight:600; display:block; margin-bottom:6px;">
                                    New Location
                                </label>
                                <input type="text" id="newLocation" placeholder="Enter new location"
                                    style="width:100%; padding:10px; border:1px solid #ccc; 
                                        border-radius:6px; font-size:15px;">
                            </div>

                            <!-- Actions -->
                            <div style="display:flex; justify-content:flex-end; gap:10px;">

                                <button onclick="closeModal()"
                                    style="padding:10px 16px; background:#6c757d; color:#fff;
                                        border:none; border-radius:6px; cursor:pointer; font-weight:600;">
                                    Cancel
                                </button>

                                <button onclick="saveLocation()"
                                    style="padding:10px 16px; background:#007bff; color:#fff;
                                        border:none; border-radius:6px; cursor:pointer; font-weight:600;">
                                    Save
                                </button>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bulk Retied Update Modal -->
                <div id="retiredModal" class="hidden"
                    style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                        background: rgba(0,0,0,0.6); display: none; align-items: center; justify-content: center;
                        z-index: 999999;">

                    <div style="background: #fff; width: 420px; border-radius: 10px; overflow:hidden;
                        box-shadow: 0 4px 15px rgba(0,0,0,0.3);">

                        <!-- Header -->
                        <div style="display:flex; justify-content:space-between; align-items:center;
                            padding:15px 20px; border-bottom:1px solid #eee;">
                            <h2 style="margin:0; font-size:20px;">Update Bulk Retired</h2>
                            <button onclick="closeModal()"
                                style="font-size:26px; background:none; border:none; cursor:pointer; line-height:1;">
                                &times;
                            </button>
                        </div>

                        <!-- Body -->
                        <div style="padding:20px;">

                            <div style="margin-bottom:20px;">
                                <label style="font-weight:600; display:block; margin-bottom:6px;">
                                    Retired
                                </label>
                                <select id="newRetired"
                                    style="width:100%; padding:10px; border:1px solid #ccc;
                                        border-radius:6px; font-size:15px; background:#fff;">
                                    <option value="">Select Retired</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <!-- Actions -->
                            <div style="display:flex; justify-content:flex-end; gap:10px;">

                                <button onclick="closeModal()"
                                    style="padding:10px 16px; background:#6c757d; color:#fff;
                                        border:none; border-radius:6px; cursor:pointer; font-weight:600;">
                                    Cancel
                                </button>

                                <button onclick="saveRetired()"
                                    style="padding:10px 16px; background:#007bff; color:#fff;
                                        border:none; border-radius:6px; cursor:pointer; font-weight:600;">
                                    Save
                                </button>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bulk Lock Price Update Modal -->
                <div id="lockPriceModal" class="hidden"
                    style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                        background: rgba(0,0,0,0.6); display: none; align-items: center; justify-content: center;
                        z-index: 999999;">

                    <div style="background: #fff; width: 420px; border-radius: 10px; overflow:hidden;
                        box-shadow: 0 4px 15px rgba(0,0,0,0.3);">

                        <!-- Header -->
                        <div style="display:flex; justify-content:space-between; align-items:center;
                            padding:15px 20px; border-bottom:1px solid #eee;">
                            <h2 style="margin:0; font-size:20px;">Update Bulk Lock Price</h2>
                            <button onclick="closeModal()"
                                style="font-size:26px; background:none; border:none; cursor:pointer; line-height:1;">
                                &times;
                            </button>
                        </div>

                        <!-- Body -->
                        <div style="padding:20px;">

                            <div style="margin-bottom:20px;">
                                <label style="font-weight:600; display:block; margin-bottom:6px;">
                                    Lock Price
                                </label>
                                <select id="newLockPrice"
                                    style="width:100%; padding:10px; border:1px solid #ccc;
                                        border-radius:6px; font-size:15px; background:#fff;">
                                    <option value="">Select Lock Price</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <!-- Actions -->
                            <div style="display:flex; justify-content:flex-end; gap:10px;">

                                <button onclick="closeModal()"
                                    style="padding:10px 16px; background:#6c757d; color:#fff;
                                        border:none; border-radius:6px; cursor:pointer; font-weight:600;">
                                    Cancel
                                </button>

                                <button onclick="saveLockPrice()"
                                    style="padding:10px 16px; background:#007bff; color:#fff;
                                        border:none; border-radius:6px; cursor:pointer; font-weight:600;">
                                    Save
                                </button>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- =================== JS (NO CHANGES NEEDED) =================== -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {

                        let currentIds = [];
                        const modal = document.getElementById('locationModal');
                        const input = document.getElementById('newLocation');

                        const retiredModal = document.getElementById('retiredModal');
                        const retiredInput = document.getElementById('newRetired');

                        const lockPriceModal = document.getElementById('lockPriceModal');
                        const lockPriceInput = document.getElementById('newLockPrice');

                        // OPEN MODAL
                        window.bulkUpdateLocation = function() {
                            currentIds = Array.from(document.querySelectorAll('.card-checkbox:checked'))
                                .map(cb => cb.closest('.inventory-card').dataset.id);

                            if (!currentIds.length) return alert('Select at least one item.');

                            input.value = "";
                            modal.style.display = "flex"; // <-- INLINE SHOW
                        };

                        window.bulkUpdateRetired = function() {
                            currentIds = Array.from(document.querySelectorAll('.card-checkbox:checked'))
                                .map(cb => cb.closest('.inventory-card').dataset.id);

                            if (!currentIds.length) return alert('Select at least one item.');

                            retiredInput.value = "";
                            retiredModal.style.display = "flex"; // <-- INLINE SHOW
                        };

                        window.bulkUpdateLockPrice = function() {
                            currentIds = Array.from(document.querySelectorAll('.card-checkbox:checked'))
                                .map(cb => cb.closest('.inventory-card').dataset.id);

                            if (!currentIds.length) return alert('Select at least one item.');

                            lockPriceInput.value = "";
                            lockPriceModal.style.display = "flex"; // <-- INLINE SHOW
                        };

                        // SAVE BULK LOCATION
                        window.saveLocation = function() {
                            const value = input.value.trim();
                            if (!value) return alert('Please enter a location.');

                            fetch('./update-location', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '<?= csrf_token(); ?>'
                                    },
                                    body: JSON.stringify({
                                        ids: currentIds,
                                        location: value
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        currentIds.forEach(id => {
                                            const card = document.querySelector(`.inventory-card[data-id='${id}']`);
                                            if (card) {
                                                card.dataset.location = value;
                                                const locText = card.querySelector('.location-text');
                                                if (locText) locText.textContent = value;
                                            }
                                        });
                                        closeModal();
                                        window.location.reload();
                                    } else {
                                        alert('Failed to update location.');
                                    }
                                })
                                .catch(() => alert('Error updating location.'));
                        };

                        window.saveRetired = function() {
                            const value = retiredInput.value.trim();
                            if (!value) return alert('Please define Retired..');

                            fetch('./update-retired', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '<?= csrf_token(); ?>'
                                    },
                                    body: JSON.stringify({
                                        ids: currentIds,
                                        retired: value
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        currentIds.forEach(id => {
                                            const card = document.querySelector(`.inventory-card[data-id='${id}']`);
                                            if (card) {
                                                card.dataset.location = value;
                                                const locText = card.querySelector('.location-text');
                                                if (locText) locText.textContent = value;
                                            }
                                        });
                                        closeModal();
                                        window.location.reload();
                                    } else {
                                        alert('Failed to update location.');
                                    }
                                })
                                .catch(() => alert('Error updating location.'));
                        };

                        window.saveLockPrice = function() {
                            const value = lockPriceInput.value.trim();
                            if (!value) return alert('Please define Lock Price..');

                            fetch('./update-lock-price', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '<?= csrf_token(); ?>'
                                    },
                                    body: JSON.stringify({
                                        ids: currentIds,
                                        lockPrice: value
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        currentIds.forEach(id => {
                                            const card = document.querySelector(`.inventory-card[data-id='${id}']`);
                                            if (card) {
                                                card.dataset.location = value;
                                                const locText = card.querySelector('.location-text');
                                                if (locText) locText.textContent = value;
                                            }
                                        });
                                        closeModal();
                                        window.location.reload();
                                    } else {
                                        alert('Failed to update location.');
                                    }
                                })
                                .catch(() => alert('Error updating location.'));
                        };

                        // CLOSE MODAL
                        window.closeModal = function() {
                            modal.style.display = "none"; // <-- INLINE HIDE
                            currentIds = [];
                        };
                    });
                </script>

                <div class="table-view" id="tableView">
                    <table class="inventory-table">
                        <thead>
                            <tr>
                                <th width="30"><input type="checkbox" id="selectAllTable" onclick="selectAllItems()">
                                </th>
                                <th width="60">Afbeelding</th>
                                <th>Item Nummer</th>
                                <th>Naam</th>
                                <th>Categorie</th>
                                <th>Conditie</th>
                                <th>Voorraad</th>
                                <th>Prijs</th>
                                <th>Gem. Prijs</th>
                                <th>Winst %</th>
                                <th>Totale Waarde</th>
                                <th width="180">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-category="Gift" data-condition="new" data-stock="11" data-item="6388185">
                                <td><input type="checkbox" class="table-checkbox" onchange="updateBulkActions()"></td>
                                <td>
                                    <div class="table-image">🦄</div>
                                </td>
                                <td>6388185</td>
                                <td>LEGO Masters gift</td>
                                <td><span class="category-tag">Gift</span></td>
                                <td><span class="condition-badge condition-new">Nieuw</span></td>
                                <td><span class="stock-badge">11</span></td>
                                <td>€34,99</td>
                                <td>€32,15</td>
                                <td><span class="trend-up">+24%</span></td>
                                <td>€384,89</td>
                                <td>
                                    <button class="icon-btn" onclick="editItem('6388185')" title="Edit">✏️</button>
                                    <button class="icon-btn" onclick="adjustStock('6388185')" title="Stock">📊</button>
                                    <button class="icon-btn info" onclick="showProductInfo('6388185')"
                                        title="Info">ℹ️</button>
                                    <button class="icon-btn trends" onclick="showPriceTrends('6388185')"
                                        title="Trends">📈</button>
                                </td>
                            </tr>
                            <tr data-category="Friends" data-condition="new" data-stock="3" data-item="41445">
                                <td><input type="checkbox" class="table-checkbox" onchange="updateBulkActions()"></td>
                                <td>
                                    <div class="table-image">🏥</div>
                                </td>
                                <td>41445</td>
                                <td>Pet Clinic Ambulance</td>
                                <td><span class="category-tag">Friends</span></td>
                                <td><span class="condition-badge condition-new">Nieuw</span></td>
                                <td><span class="stock-badge low">3</span></td>
                                <td>€9,99</td>
                                <td>€9,25</td>
                                <td><span class="trend-up">+8%</span></td>
                                <td>€29,97</td>
                                <td>
                                    <button class="icon-btn" onclick="editItem('41445')" title="Edit">✏️</button>
                                    <button class="icon-btn" onclick="adjustStock('41445')" title="Stock">📊</button>
                                    <button class="icon-btn info" onclick="showProductInfo('41445')"
                                        title="Info">ℹ️</button>
                                    <button class="icon-btn trends" onclick="showPriceTrends('41445')"
                                        title="Trends">📈</button>
                                </td>
                            </tr>
                            <tr data-category="Disney" data-condition="used" data-stock="0" data-item="10775">
                                <td><input type="checkbox" class="table-checkbox" onchange="updateBulkActions()"></td>
                                <td>
                                    <div class="table-image">🦄</div>
                                </td>
                                <td>10775</td>
                                <td>Unicorn Speelset</td>
                                <td><span class="category-tag">Disney</span></td>
                                <td><span class="condition-badge condition-used">Gebruikt</span></td>
                                <td><span class="stock-badge out">0</span></td>
                                <td>€12,99</td>
                                <td>€13,25</td>
                                <td><span class="trend-down">-2%</span></td>
                                <td>€0,00</td>
                                <td>
                                    <button class="icon-btn" onclick="editItem('10775')" title="Edit">✏️</button>
                                    <button class="icon-btn" onclick="adjustStock('10775')" title="Stock">📊</button>
                                    <button class="icon-btn info" onclick="showProductInfo('10775')"
                                        title="Info">ℹ️</button>
                                    <button class="icon-btn trends" onclick="showPriceTrends('10775')"
                                        title="Trends">📈</button>
                                </td>
                            </tr>
                            <tr data-category="Creator" data-condition="new" data-stock="15" data-item="31120">
                                <td><input type="checkbox" class="table-checkbox" onchange="updateBulkActions()"></td>
                                <td>
                                    <div class="table-image">🏰</div>
                                </td>
                                <td>31120</td>
                                <td>Castle Adventures</td>
                                <td><span class="category-tag">Creator</span></td>
                                <td><span class="condition-badge condition-new">Nieuw</span></td>
                                <td><span class="stock-badge">15</span></td>
                                <td>€89,99</td>
                                <td>€76,25</td>
                                <td><span class="trend-up">+18%</span></td>
                                <td>€1.349,85</td>
                                <td>
                                    <button class="icon-btn" onclick="editItem('31120')" title="Edit">✏️</button>
                                    <button class="icon-btn" onclick="adjustStock('31120')" title="Stock">📊</button>
                                    <button class="icon-btn info" onclick="showProductInfo('31120')"
                                        title="Info">ℹ️</button>
                                    <button class="icon-btn trends" onclick="showPriceTrends('31120')"
                                        title="Trends">📈</button>
                                </td>
                            </tr>
                            <tr data-category="Speed Champions" data-condition="new" data-stock="7" data-item="76909">
                                <td><input type="checkbox" class="table-checkbox" onchange="updateBulkActions()"></td>
                                <td>
                                    <div class="table-image">🚗</div>
                                </td>
                                <td>76909</td>
                                <td>Speed Champions McLaren</td>
                                <td><span class="category-tag">Speed Champions</span></td>
                                <td><span class="condition-badge condition-new">Nieuw</span></td>
                                <td><span class="stock-badge">7</span></td>
                                <td>€19,99</td>
                                <td>€17,85</td>
                                <td><span class="trend-up">+12%</span></td>
                                <td>€139,93</td>
                                <td>
                                    <button class="icon-btn" onclick="editItem('76909')" title="Edit">✏️</button>
                                    <button class="icon-btn" onclick="adjustStock('76909')" title="Stock">📊</button>
                                    <button class="icon-btn info" onclick="showProductInfo('76909')"
                                        title="Info">ℹ️</button>
                                    <button class="icon-btn trends" onclick="showPriceTrends('76909')"
                                        title="Trends">📈</button>
                                </td>
                            </tr>
                            <tr data-category="Harry Potter" data-condition="new" data-stock="25" data-item="76405">
                                <td><input type="checkbox" class="table-checkbox" onchange="updateBulkActions()"></td>
                                <td>
                                    <div class="table-image">🌟</div>
                                </td>
                                <td>76405</td>
                                <td>Hogwarts Express</td>
                                <td><span class="category-tag">Harry Potter</span></td>
                                <td><span class="condition-badge condition-new">Nieuw</span></td>
                                <td><span class="stock-badge">25</span></td>
                                <td>€449,99</td>
                                <td>€341,25</td>
                                <td><span class="trend-up">+32%</span></td>
                                <td>€11.249,75</td>
                                <td>
                                    <button class="icon-btn" onclick="editItem('76405')" title="Edit">✏️</button>
                                    <button class="icon-btn" onclick="adjustStock('76405')" title="Stock">📊</button>
                                    <button class="icon-btn info" onclick="showProductInfo('76405')"
                                        title="Info">ℹ️</button>
                                    <button class="icon-btn trends" onclick="showPriceTrends('76405')"
                                        title="Trends">📈</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <style>
                    /* Pagination Wrapper */
                    .pagination {
                        display: flex;
                        justify-content: center;
                        margin: 1rem 0;
                        font-family: 'Inter', sans-serif;
                    }

                    /* Pagination buttons */
                    .pagination a,
                    .pagination span {
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        min-width: 2.5rem;
                        height: 2rem;
                        margin: 0 0.25rem;
                        padding: 0 0.75rem;
                        font-size: 0.875rem;
                        /*font-weight: 500;*/
                        color: #374151;
                        background-color: #fff;
                        border: 1px solid #d1d5db;
                        border-radius: 0.375rem;
                        text-decoration: none;
                        transition: all 0.2s ease-in-out;
                    }

                    /* Hover effect */
                    .pagination a:hover {
                        background-color: #f3f4f6;
                        color: #111827;
                        border-color: #2563eb;
                    }

                    /* Disabled buttons */
                    .pagination span[aria-disabled="true"] {
                        color: #9ca3af;
                        cursor: not-allowed;
                        background-color: #f9fafb;
                        border-color: #d1d5db;
                    }

                    /* Hide Laravel default results text */
                    .pagination p.text-sm.text-gray-700,
                    .pagination p.text-sm.text-gray-700.dark\:text-gray-400 {
                        display: none !important;
                    }

                    /* Hide "Previous" and "Next" text links */
                    .pagination a[rel="prev"],
                    .pagination a[rel="next"],
                    .pagination span[aria-label*="Previous"],
                    .pagination span[aria-label*="Next"] {
                        display: none !important;
                    }

                    /* Hide Laravel's "Showing X to Y of Z results" wrapper */

                    .relative.inline-flex.items-center.px-4.py-2.text-sm.font-medium.text-gray-500.bg-white.border.border-gray-300.cursor-default.leading-5.rounded-md.dark\:text-gray-600.dark\:bg-gray-800.dark\:border-gray-600 {
                        display: none !important;
                    }

                    /* Hide all extra Laravel pagination wrappers and info */
                </style>
                <div class="pagination">
                    {{ $products->links() }}
                </div>
            </div>
        </div>

        <!-- Product Info Modal -->
        <div class="modal-overlay" id="productModal">
            <div class="modal">
                <div class="modal-header">
                    <h2 id="modalTitle">Product Informatie</h2>
                    <button class="close-btn" onclick="closeModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="modal-tabs">
                        <button class="tab-btn active" onclick="switchTab('info')">📋 Info</button>
                        <button class="tab-btn" onclick="switchTab('marketplace')">🏪 Marketplaces</button>
                        <button class="tab-btn" onclick="switchTab('trends')">📈 Prijstrends</button>
                    </div>

                    <div class="tab-content active" id="infoTab">
                        <div class="product-info" id="productInfo">
                            <!-- Product info will be populated by JavaScript -->
                        </div>
                    </div>

                    <div class="tab-content" id="marketplaceTab">
                        <div class="marketplace-list" id="marketplaceList">
                            <!-- Marketplace info will be populated by JavaScript -->
                        </div>
                    </div>

                    <div class="tab-content" id="trendsTab">
                        <div class="chart-container" id="priceChart">
                            📊 Prijstrend grafiek komt hier (mockup)
                        </div>
                        <div class="trend-stats" id="trendStats">
                            <!-- Trend statistics will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Product Modal -->
        <div class="modal-overlay" id="editModal">
            <div class="modal modal-large">
                <div class="modal-header">
                    <h2>Edit Product</h2>
                    <button class="close-btn" onclick="closeEditModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editForm" class="edit-form" method="POST" action="{{ route('update-product', 419503090) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="edit-tabs">
                            <button type="button" class="edit-tab-btn active" onclick="switchEditTab('basic')">Basic Info</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('images')">Images</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('details')">Details</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('pricing')">Prices</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('vinted')">Vinted</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('shopifyIntegration')">Shopify</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('amazonIntegration')">Amazon Integration</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('ebayIntegration')">eBay Integration</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('bolComIntegration')">Bol.com Integration</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('supplierAndLocation')">Supplier & Location</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('specialPropertiesAndOther')">Special Properties & Others</button>
                        </div>

                        <!-- Basic Info -->
                        <div class="edit-tab-content active" id="basicTab">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="edit_name">Product Name *</label>
                                    <input type="text" id="edit_name" name="title">
                                </div>
                                <div class="form-group">
                                    <label for="edit_item_no">Item Number</label>
                                    <input type="text" id="edit_item_no" name="item_no">
                                </div>
                                <div class="form-group">
                                    <label for="edit_item_type">Item Type *</label>
                                    <select id="edit_item_type" name="item_type">
                                        <option value="">Select Item Type...</option>
                                        <option value="MINIFIG">MINIFIG</option>
                                        <option value="PART">PART</option>
                                        <option value="SET">SET</option>
                                        <option value="BOOK">BOOK</option>
                                        <option value="GEAR">GEAR</option>
                                        <option value="CATALOG">CATALOG</option>
                                        <option value="INSTRUCTION">INSTRUCTION</option>
                                        <option value="UNSORTED_LOT">UNSORTED_LOT</option>
                                        <option value="ORIGINAL_BOX">ORIGINAL_BOX</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit_color_id">Color *</label>
                                    <select id="edit_color_id" name="color_id">
                                        <option value="">Select Color...</option>
                                        @foreach ($colors as $color)
                                        <option value="{{ $color->bricklink_id }}">{{ $color->bricklink_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit_stock">Stock</label>
                                    <input type="text" id="edit_stock" name="stock">
                                </div>
                                <div class="form-group">
                                    <label for="edit_sku">SKU</label>
                                    <input type="text" id="edit_sku" name="sku">
                                </div>
                                <div class="form-group">
                                    <label for="edit_ean">EAN/GTIN</label>
                                    <input type="text" id="edit_ean" name="ean" maxlength="13">
                                </div>
                                <div class="form-group">
                                    <label for="edit_category">Category *</label>
                                    <select id="edit_category" name="category">
                                        <option value="">Select category...</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->title }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit_condition">Condition *</label>
                                    <select id="edit_condition" name="condition">
                                        <option value="New">New</option>
                                        <option value="Used">Used</option>
                                    </select>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="edit_rebrickable_id">Rebrickable ID</label>
                                    <input type="text" id="edit_rebrickable_id" name="rebrickable_id">
                                </div> -->

                                <div class="form-group">
                                    <label for="edit_completeness">Completeness</label>
                                    <select id="edit_completeness" name="completeness">
                                        <option value="">- Select -</option>
                                        <option value="complete">Complete</option>
                                        <option value="incomplete">Incomplete</option>
                                        <option value="sealed">Sealed</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Images Tab -->
                        <div class="edit-tab-content" id="imagesTab">
                            <div class="images-header">
                                <h3>Product Afbeeldingen</h3>
                                <p>Beheer hoofdafbeelding, galerij en image URL voor dit product.</p>
                            </div>

                            <!-- Single Image URL -->
                            <div class="single-url-section">
                                <h4>Product Image URL</h4>
                                <div class="form-group">
                                    <div class="single-url-input">
                                        <input type="url" id="product_image_url" name="image_url" placeholder="https://example.com/main-product-image.jpg" style="width: 50%;">
                                        <button type="button" class="url-test-btn" onclick="testSingleImageUrl()">Test URL</button>
                                    </div>
                                    <div class="url-preview" id="singleUrlPreview" style="display: none;">
                                        <img id="singleUrlImage" alt="URL Preview">
                                        <div class="preview-info">
                                            <span id="singleUrlStatus"></span>
                                            <span id="singleUrlDimensions"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden inputs for form submission -->
                            <input type="hidden" id="main_image_input" name="main_image">
                            <input type="hidden" id="gallery_images_input" name="gallery_images">

                            <!-- Main Image -->
                            <div class="primary-image-section">
                                <h4>Main Image</h4>
                                <div class="primary-image-container">
                                    <div class="primary-image-preview" id="primaryImagePreview">
                                        <div class="upload-placeholder">
                                            <div class="upload-icon">🖼️</div>
                                            <p><strong>Drag main image here</strong></p>
                                            <p>or <button type="button" class="upload-btn" onclick="document.getElementById('primaryImageFile').click()">choose file</button></p>
                                            <small>JPG, PNG, WEBP (max 5MB)</small>
                                        </div>
                                    </div>
                                    <input type="file" id="primaryImageFile" name="main_image" accept="image/*" style="display:none;">
                                    <div class="primary-image-actions" id="primaryImageActions" style="display:none; margin-top:5px;">
                                        <button type="button"
                                            class="action-btn btn-block"
                                            style="width: 100%; display: flex; justify-content: center; align-items: center;" onclick="replacePrimaryImage()">
                                            Choose File
                                        </button>
                                        <!--<button type="button" class="action-btn danger" onclick="removePrimaryImage()">Remove</button>-->
                                    </div>
                                </div>
                            </div>

                            <!-- Gallery -->
                            <div class="gallery-images-section">
                                <h4>Gallery Images</h4>
                                <div class="upload-area" id="galleryUploadArea">
                                    <div class="upload-placeholder">
                                        <div class="upload-icon">📷</div>
                                        <p><strong>Drag gallery images here</strong></p>
                                        <p>or <button type="button" class="upload-btn" onclick="document.getElementById('galleryImageFiles').click()">choose files</button></p>
                                        <small>Multiple allowed (JPG, PNG, WEBP, max 5MB each)</small>
                                    </div>
                                    <input type="file" id="galleryImageFiles" multiple accept="image/*" style="display:none;">
                                </div>
                                <div class="gallery-grid" id="galleryGrid"></div>
                            </div>
                        </div>

                        <!-- Details Tab -->
                        <div class="edit-tab-content" id="detailsTab">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="edit_weight">Weight (gram)</label>
                                    <input type="text" id="edit_weight" name="weight" step="1" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="edit_length">Dim x</label>
                                    <input type="text" id="edit_dim_x" name="dim_x" step="0.1" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="edit_width">Dim Y</label>
                                    <input type="text" id="edit_dim_y" name="dim_y" step="0.1" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="edit_height">Dim Z</label>
                                    <input type="text" id="edit_dim_z" name="dim_z" step="0.1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="edit_height">Pieces</label>
                                    <input type="number" id="edit_pieces" name="pieces" step="0.1" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="edit_height">Year</label>
                                    <input type="number" id="edit_year" name="year" step="0.1" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="edit_height">Min age</label>
                                    <input type="number" id="edit_min_age" name="min_age" step="0.1" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="edit_height">Description</label>
                                    <input type="text" id="edit_description" name="description" step="0.1" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="edit_extended_description">Extended Description</label>
                                    <input type="text" id="edit_extended_description" name="extended_description" step="0.1" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="edit_remarks">Remarks</label>
                                    <input type="text" id="edit_remarks" name="remarks" step="0.1" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="edit_set_minifigures">Minifigs</label>
                                    <input type="text" id="edit_set_minifigures" name="set_minifigures" step="0.1" min="0">
                                </div>

                            </div>
                        </div>

                        <!-- Pricing Tab -->
                        <div class="edit-tab-content" id="pricingTab">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="edit_price">price</label>
                                    <input type="number" id="edit_price" name="price" step="0.01" min="0">
                                    <style>
                                        .swal2-container {
                                            z-index: 20000 !important;
                                            /* Higher than Bootstrap modal (1050–1060) */
                                        }
                                    </style>

                                    <meta name="csrf-token" content="{{ csrf_token() }}">

                                    <button type="button" class="btn-primary" style="
                                        text-align: center;
                                        height: 25px;
                                        width: 100%;
                                        background: #4CAF51;
                                        color: #fff;
                                        border-radius: 5px;
                                        padding: 10px 18px;
                                        cursor: pointer;
                                        transition: all 0.3s ease;
                                        display: inline-flex;
                                        align-items: center;
                                        justify-content: center; /* ✅ Center horizontally */
                                        gap: 8px;
                                        box-shadow: 0 3px 8px rgba(0,0,0,0.2);
                                    " id="fetchPriceBtn_edit">Fetch Price</button>

                                    <script>
                                        document.getElementById("fetchPriceBtn_edit").addEventListener("click", function() {
                                            const btn = this;
                                            btn.disabled = true;
                                            btn.textContent = "Fetching...";

                                            const payload = {
                                                item_no: document.getElementById("edit_item_no")?.value || "ABC123",
                                                item_type: document.getElementById("edit_item_type")?.value || "ABC123",
                                                item_color_id: document.getElementById("edit_color_id")?.value || "ABC123",
                                                item_condition: document.getElementById("edit_condition")?.value || "ABC123"
                                            };

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
                                                        const priceField = document.getElementById("edit_price");
                                                        priceField.value = data.avg_price;
                                                        priceField.removeAttribute("disabled");
                                                    } else {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Invalid Item No',
                                                            text: 'Please provide the valid Item No, Item Type, Color ID & Condition to fetch the price!'
                                                        });
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error("Error fetching price:", error);
                                                    alert("Failed to fetch price.");
                                                })
                                                .finally(() => {
                                                    btn.disabled = false;
                                                    btn.textContent = "Fetch Price";
                                                });
                                        });
                                    </script>

                                </div>
                                <div class="form-group">
                                    <label for="edit_sell_price">Sell Price</label>
                                    <input type="number" id="edit_sell_price" name="sell_price" step="0.01" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="edit_purchase_price">Purchase Price</label>
                                    <input type="number" id="edit_purchase_price" name="purchase_price" step="0.01" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="edit_sale_rate">Sale Rate (%)</label>
                                    <input type="number" id="edit_sale_rate" name="sale_rate" step="0.01" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="edit_tier_quantity1">Tier Quantity 1</label>
                                    <input type="number" id="edit_tier_quantity1" name="tier_quantity1" step="1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="edit_tier_price1">Tier Price 1</label>
                                    <input type="number" id="edit_tier_price1" name="tier_price1" step="0.01" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="edit_tier_quantity2">Tier Quantity 2</label>
                                    <input type="number" id="edit_tier_quantity2" name="tier_quantity2" step="1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="edit_tier_price2">Tier Price 2</label>
                                    <input type="number" id="edit_tier_price2" name="tier_price2" step="0.01" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="edit_tier_quantity3">Tier Quantity 3</label>
                                    <input type="number" id="edit_tier_quantity3" name="tier_quantity3" step="1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="edit_tier_price3">Tier Price 3</label>
                                    <input type="number" id="edit_tier_price3" name="tier_price3" step="0.01" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="edit_currency">Currency</label>
                                    <input type="text" id="edit_currency" name="currency" maxlength="3" placeholder="e.g. EUR">
                                </div>
                                <div class="form-group" style="margin:8px 0;">
                                    <label style="display:flex; align-items:center; gap:25px; font-weight:600; cursor:pointer; margin-top: 23px;">
                                        Lock Price
                                        <input type="checkbox" id="edit_lock_price" name="lock_price" style="width:18px; height:18px; cursor:pointer;">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- shopifyIntegrationTab Tab -->
                        <div class="edit-tab-content" id="shopifyIntegrationTab">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="edit_shopify_variant_id">Shopify Varient ID</label>
                                    <input type="text" id="edit_shopify_variant_id" name="shopify_variant_id">
                                </div>

                                <div class="form-group">
                                    <label for="edit_shopify_product_id">Shopify Product ID</label>
                                    <input type="text" id="edit_shopify_product_id" name="shopify_product_id">
                                </div>
                            </div>
                        </div>

                        <!-- amazonIntegrationTab Tab -->
                        <div class="edit-tab-content" id="amazonIntegrationTab">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="edit_amazon_sku">Amazon SKU</label>
                                    <input type="text" id="edit_amazon_sku" name="amazon_sku">
                                </div>

                                <div class="form-group">
                                    <label for="edit_amazon_price">Amazon Price</label>
                                    <input type="text" id="edit_amazon_price" name="amazon_price">
                                </div>

                                <div class="form-group">
                                    <label for="edit_amazon_condition_type">Amazon Condition Type</label>
                                    <input type="text" id="edit_amazon_condition_type" name="amazon_condition_type">
                                </div>

                                <div class="form-group">
                                    <label for="edit_amazon_fulfillment_channel">Amazon Fulfillment Channel</label>
                                    <input type="text" id="edit_amazon_fulfillment_channel" name="amazon_fulfillment_channel">
                                </div>

                                <div class="form-group">
                                    <label for="edit_amazon_target_age_min">Amazon Target Age Min</label>
                                    <input type="text" id="edit_amazon_target_age_min" name="amazon_target_age_min">
                                </div>

                                <div class="form-group">
                                    <label for="edit_amazon_listing_id">Amazon Listing ID</label>
                                    <input type="text" id="edit_amazon_listing_id" name="amazon_listing_id">
                                </div>

                                <div class="form-group">
                                    <label for="edit_amazon_status">Amazon Status</label>
                                    <input type="text" id="edit_amazon_status" name="amazon_status">
                                </div>

                                <div class="form-group">
                                    <label for="edit_amazon_last_sync">Amazon Last Sync</label>
                                    <input type="text" id="edit_amazon_last_sync" name="amazon_last_sync">
                                </div>
                            </div>
                        </div>

                        <!-- ebayIntegrationTab Tab -->
                        <div class="edit-tab-content" id="ebayIntegrationTab">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="edit_ebay_item_id">Ebay Item ID</label>
                                    <input type="text" id="edit_ebay_item_id" name="ebay_item_id">
                                </div>

                                <div class="form-group">
                                    <label for="edit_ebay_price">Ebay Price</label>
                                    <input type="text" id="edit_ebay_price" name="ebay_price">
                                </div>

                                <div class="form-group">
                                    <label for="edit_ebay_condition_id">Ebay Condition ID</label>
                                    <input type="text" id="edit_ebay_condition_id" name="ebay_condition_id">
                                </div>

                                <div class="form-group">
                                    <label for="edit_ebay_category_id">Ebay Category ID</label>
                                    <input type="text" id="edit_ebay_category_id" name="ebay_category_id">
                                </div>

                                <div class="form-group">
                                    <label for="edit_ebay_listing_type">Ebay Listing Type</label>
                                    <input type="text" id="edit_ebay_listing_type" name="ebay_listing_type">
                                </div>

                                <div class="form-group">
                                    <label for="edit_ebay_listing_duration">Ebay Listing Duration</label>
                                    <input type="text" id="edit_ebay_listing_duration" name="ebay_listing_duration">
                                </div>

                                <div class="form-group">
                                    <label for="edit_ebay_primary_image">Ebay Primary Image</label>
                                    <input type="text" id="edit_ebay_primary_image" name="ebay_primary_image">
                                </div>

                                <div class="form-group">
                                    <label for="edit_ebay_item_specifics">Ebay Item Specifics</label>
                                    <input type="text" id="edit_ebay_item_specifics" name="ebay_item_specifics">
                                </div>

                                <div class="form-group">
                                    <label for="edit_ebay_handling_time">Ebay Handling Time</label>
                                    <input type="text" id="edit_ebay_handling_time" name="ebay_handling_time">
                                </div>

                                <div class="form-group">
                                    <label for="edit_ebay_sku">Ebay SKU</label>
                                    <input type="text" id="edit_ebay_sku" name="ebay_sku">
                                </div>

                                <div class="form-group">
                                    <label for="edit_ebay_status">Ebay Status</label>
                                    <input type="text" id="edit_ebay_status" name="ebay_status">
                                </div>

                                <div class="form-group">
                                    <label for="edit_ebay_last_sync">Ebay Last Sync</label>
                                    <input type="text" id="edit_ebay_last_sync" name="ebay_last_sync">
                                </div>
                            </div>
                        </div>

                        <!-- bolComIntegrationTab Tab -->
                        <div class="edit-tab-content" id="bolComIntegrationTab">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="edit_bol_active">Bol Active</label>
                                    <input type="text" id="edit_bol_active" name="bol_active">
                                </div>

                                <div class="form-group">
                                    <label for="edit_bol_offerId">Bol Offer ID</label>
                                    <input type="text" id="edit_bol_offerId" name="bol_offerId">
                                </div>

                                <div class="form-group">
                                    <label for="edit_bol_price">Bol Price</label>
                                    <input type="text" id="edit_bol_price" name="bol_price">
                                </div>

                                <div class="form-group">
                                    <label for="edit_bol_fulfilment_method">Bol Fulfilment Method</label>
                                    <input type="text" id="edit_bol_fulfilment_method" name="bol_fulfilment_method">
                                </div>

                                <div class="form-group">
                                    <label for="edit_bol_delivery_code">Bol Delivery Code</label>
                                    <input type="text" id="edit_bol_delivery_code" name="bol_delivery_code">
                                </div>
                            </div>
                        </div>

                        <!-- Supplier & Location Tab -->
                        <div class="edit-tab-content" id="supplierAndLocationTab">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="edit_supplier">Supplier</label>
                                    <input type="text" id="edit_supplier" name="supplier">
                                </div>

                                <div class="form-group">
                                    <label for="edit_stockSupplier">Stock Supplier</label>
                                    <input type="text" id="edit_stockSupplier" name="stockSupplier">
                                </div>

                                <div class="form-group">
                                    <label for="edit_location_id">Location ID</label>
                                    <input type="text" id="edit_location_id" name="location_id">
                                </div>

                                <div class="form-group">
                                    <label for="edit_lot_id">Lot ID</label>
                                    <input type="text" id="edit_lot_id" name="lot_id">
                                </div>

                                <div class="form-group">
                                    <label for="edit_super_lot_id">Super Lot ID</label>
                                    <input type="text" id="edit_super_lot_id" name="super_lot_id">
                                </div>

                                <div class="form-group">
                                    <label for="edit_super_lot_qty">Super Lot Quantity</label>
                                    <input type="text" id="edit_super_lot_qty" name="super_lot_qty">
                                </div>
                            </div>
                        </div>

                        <!-- specialPropertiesAndOtherTab Tab -->
                        <div class="edit-tab-content" id="specialPropertiesAndOtherTab">
                            <div class="form-grid">
                                <div class="form-group" style="margin:8px 0;">
                                    <label style="display:flex; align-items:center; gap:25px; font-weight:600; cursor:pointer;">
                                        Retired
                                        <input type="checkbox" id="edit_retired" name="retired" style="width:18px; height:18px; cursor:pointer;">
                                    </label>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="edit_rebrickable_id">Rebrickable ID</label>
                                    <input type="text" id="edit_rebrickable_id" name="rebrickable_id">
                                </div>

                                <div class="form-group">
                                    <label for="edit_woocommerce_parent_id">WooCommerce Parent ID</label>
                                    <input type="text" id="edit_woocommerce_parent_id" name="woocommerce_parent_id">
                                </div>

                                <div class="form-group">
                                    <label for="edit_woocommerce_id">WooCommerce ID</label>
                                    <input type="text" id="edit_woocommerce_id" name="woocommerce_id">
                                </div>

                                <div class="form-group">
                                    <label for="edit_bricklink_inventory_id">BrickLink Inventory ID</label>
                                    <input type="text" id="edit_bricklink_inventory_id" name="bricklink_inventory_id">
                                </div>

                                <div class="form-group">
                                    <label for="edit_brickowl_id">BrickOwl ID</label>
                                    <input type="text" id="edit_brickowl_id" name="brickowl_id">
                                </div>

                                <div class="form-group">
                                    <label for="edit_element_id">Element ID</label>
                                    <input type="text" id="edit_element_id" name="element_id">
                                </div>

                                <div class="form-group">
                                    <label for="edit_notifyvalues">Notify Values</label>
                                    <input type="text" id="edit_notifyvalues" name="notifyvalues">
                                </div>

                                <div class="form-group">
                                    <label for="edit_notifyselected">Notify Selected</label>
                                    <input type="text" id="edit_notifyselected" name="notifyselected">
                                </div>

                                <div class="form-group">
                                    <label for="edit_notifystatus">Notify Status</label>
                                    <input type="text" id="edit_notifystatus" name="notifystatus">
                                </div>

                                <div class="form-group">
                                    <label for="edit_bind_id">Bind ID</label>
                                    <input type="text" id="edit_bind_id" name="bind_id">
                                </div>

                                <div class="form-group">
                                    <label for="edit_reserved_for">Reserved For</label>
                                    <input type="text" id="edit_reserved_for" name="reserved_for">
                                </div>

                                <div class="form-group">
                                    <label for="edit_date">Date</label>
                                    <input type="text" id="edit_date" name="date">
                                </div>

                                <div class="form-group">
                                    <label for="edit_new_or_used">New or Used</label>
                                    <input type="text" id="edit_new_or_used" name="new_or_used">
                                </div>

                                <div class="form-group">
                                    <label for="edit_upgrades">Upgrades</label>
                                    <input type="text" id="edit_upgrades" name="upgrades">
                                </div>

                            </div>
                        </div>

                        <!-- Vinted Tab -->
                        <div class="edit-tab-content" id="vintedTab">
                            <div class="form-grid">
                                <div class="form-group" style="margin:8px 0;">
                                    <label style="display:flex; align-items:center; gap:25px; font-weight:600; cursor:pointer;">
                                        Active
                                        <input type="checkbox" id="edit_vinted_active" name="vinted_active" style="width:18px; height:18px; cursor:pointer;">
                                    </label>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="edit_vinted_item_id">Vinted Item ID</label>
                                    <input type="text" id="edit_vinted_item_id" name="vinted_item_id">
                                </div>

                                <div class="form-group">
                                    <label for="edit_vinted_item_id">Vinted Bulk Amount</label>
                                    <input type="text" id="edit_vinted_bulk_amount" name="vinted_bulk_amount">
                                </div>

                                <div class="form-group">
                                    <label for="edit_vinted_status">Vinted Status</label>
                                    <input type="text" id="edit_vinted_status" name="vinted_status">
                                </div>
                                <div class="form-group">

                                </div>

                                <!-- Hidden inputs for form submission -->
                                <input type="hidden" id="vinted_main_image_input" name="vinted_main_image">
                                <input type="hidden" id="vinted_gallery_images_input" name="vinted_gallery_images">

                                <!-- Main Image -->
                                <div class="primary-image-section">
                                    <h4>Main Image</h4>
                                    <div class="primary-image-container">
                                        <div class="primary-image-preview" id="vinted_primaryImagePreview">
                                            <div class="upload-placeholder">
                                                <div class="upload-icon">🖼️</div>
                                                <p><strong>Drag main image here</strong></p>
                                                <p>or <button type="button" class="upload-btn" onclick="document.getElementById('vinted_primaryImageFile').click()">choose file</button></p>
                                                <small>JPG, PNG, WEBP (max 5MB)</small>
                                            </div>
                                        </div>
                                        <input type="file" id="vinted_primaryImageFile" name="vinted_main_image" accept="image/*" style="display:none;">
                                        <div class="primary-image-actions" id="vinted_primaryImageActions" style="display:none; margin-top:5px;">
                                            <button type="button"
                                                class="action-btn btn-block"
                                                style="width: 100%; display: flex; justify-content: center; align-items: center;" onclick="vinted_replacePrimaryImage()">
                                                Choose File
                                            </button>
                                            <!--<button type="button" class="action-btn danger" onclick="removePrimaryImage()">Remove</button>-->
                                        </div>
                                    </div>
                                </div>

                                <!-- Gallery -->
                                <div class="gallery-images-section">
                                    <h4>Gallery Images</h4>
                                    <div class="upload-area" id="vinted_galleryUploadArea">
                                        <div class="upload-placeholder">
                                            <div class="upload-icon">📷</div>
                                            <p><strong>Drag gallery images here</strong></p>
                                            <p>or <button type="button" class="upload-btn" onclick="document.getElementById('vinted_galleryImageFiles').click()">choose files</button></p>
                                            <small>Multiple allowed (JPG, PNG, WEBP, max 5MB each)</small>
                                        </div>
                                        <input type="file" id="vinted_galleryImageFiles" multiple accept="image/*" style="display:none;">
                                    </div>
                                    <div class="gallery-grid" id="vinted_galleryGrid"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-secondary" onclick="closeEditModal()">Cancel</button>
                            <button type="submit" class="btn-primary">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Product Modal -->
        <div class="modal-overlay" id="addModal">
            <div class="modal modal-large">
                <div class="modal-header">
                    <h2>Add Product</h2>
                    <button class="close-btn" onclick="closeAddModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="addForm" class="edit-form" method="POST" action="{{ route('add-product') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="edit-tabs">
                            <button type="button" class="edit-tab-btn active" onclick="switchEditTab('add-basic')">Basic Info</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('add-images')">Images</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('add-details')">Details</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('add-pricing')">Prices</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('add-vinted')">Vinted</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('add-shopifyIntegration')">Shopify</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('add-amazonIntegration')">Amazon Integration</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('add-ebayIntegration')">eBay Integration</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('add-bolComIntegration')">Bol.com Integration</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('add-supplierAndLocation')">Supplier & Location</button>
                            <button type="button" class="edit-tab-btn" onclick="switchEditTab('add-specialPropertiesAndOther')">Special Properties & Others</button>
                        </div>

                        <!-- Basic Info -->
                        <div class="edit-tab-content active" id="add-basicTab">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="add_name">Product Name *</label>
                                    <input type="text" id="add_name" name="title" required>
                                </div>
                                <div class="form-group">
                                    <label for="add_item_no">Item Number</label>
                                    <input type="text" id="add_item_no" name="item_no">
                                </div>
                                <div class="form-group">
                                    <label for="add_item_type">Item Type *</label>
                                    <select id="add_item_type" name="item_type" required>
                                        <option value="">Select Item Type...</option>
                                        <option value="MINIFIG">MINIFIG</option>
                                        <option value="PART">PART</option>
                                        <option value="SET">SET</option>
                                        <option value="BOOK">BOOK</option>
                                        <option value="GEAR">GEAR</option>
                                        <option value="CATALOG">CATALOG</option>
                                        <option value="INSTRUCTION">INSTRUCTION</option>
                                        <option value="UNSORTED_LOT">UNSORTED_LOT</option>
                                        <option value="ORIGINAL_BOX">ORIGINAL_BOX</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="add_color_id">Color *</label>
                                    <select id="add_color_id" name="color_id" required>
                                        <option value="">Select Color...</option>
                                        @foreach ($colors as $color)
                                        <option value="{{ $color->bricklink_id }}">{{ $color->bricklink_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="add_stock">Stock</label>
                                    <input type="text" id="add_stock" name="stock">
                                </div>
                                <div class="form-group">
                                    <label for="add_sku">SKU</label>
                                    <input type="text" id="add_sku" name="sku">
                                </div>
                                <div class="form-group">
                                    <label for="add_ean">EAN/GTIN</label>
                                    <input type="text" id="add_ean" name="ean" maxlength="13">
                                </div>

                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
                                <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

                                <div class="form-group">
                                    <label for="add_category">Category *</label>
                                    <select id="add_category" name="category" required>
                                        <option value="">Select category...</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->title }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        new Choices('#add_category', {
                                            searchEnabled: true,
                                            itemSelectText: '',
                                            placeholderValue: 'Search category...',
                                            allowHTML: true
                                        });
                                    });
                                </script>

                                <script></script>
                                <div class="form-group">
                                    <label for="add_condition">Condition *</label>
                                    <select id="add_condition" name="condition" required>
                                        <option value="New">New</option>
                                        <option value="Used">Used</option>
                                    </select>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="add_rebrickable_id">Rebrickable ID</label>
                                    <input type="text" id="add_rebrickable_id" name="rebrickable_id">
                                </div> -->

                                <div class="form-group">
                                    <label for="add_completeness">Completeness</label>
                                    <select id="add_completeness" name="completeness">
                                        <option value="">- Select -</option>
                                        <option value="complete">Complete</option>
                                        <option value="incomplete">Incomplete</option>
                                        <option value="sealed">Sealed</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Images Tab -->
                        <div class="edit-tab-content" id="add-imagesTab">
                            <div class="images-header">
                                <h3>Product Afbeeldingen</h3>
                                <p>Beheer hoofdafbeelding, galerij en image URL voor dit product.</p>
                            </div>

                            <!-- Single Image URL -->
                            <div class="single-url-section">
                                <h4>Product Image URL</h4>
                                <div class="form-group">
                                    <div class="single-url-input">
                                        <input type="url" id="product_image_url" name="image_url" placeholder="https://example.com/main-product-image.jpg" style="width: 50%;">
                                        <button type="button" class="url-test-btn" onclick="testSingleImageUrl()">Test URL</button>
                                    </div>
                                    <div class="url-preview" id="singleUrlPreview" style="display: none;">
                                        <img id="singleUrlImage" alt="URL Preview">
                                        <div class="preview-info">
                                            <span id="singleUrlStatus"></span>
                                            <span id="singleUrlDimensions"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden inputs for form submission -->
                            <input type="hidden" id="main_image_input" name="main_image">
                            <input type="hidden" id="gallery_images_input" name="gallery_images">

                            <!-- Main Image -->
                            <div class="primary-image-section">
                                <h4>Main Image</h4>
                                <div class="primary-image-container">
                                    <div class="primary-image-preview" id="addPrimaryImagePreview">
                                        <div class="upload-placeholder">
                                            <div class="upload-icon">🖼️</div>
                                            <p><strong>Drag main image here</strong></p>
                                            <p>or <button type="button" class="upload-btn" onclick="document.getElementById('addPrimaryImageFile').click()">choose file</button></p>
                                            <small>JPG, PNG, WEBP (max 5MB)</small>
                                        </div>
                                    </div>
                                    <input type="file" id="addPrimaryImageFile" name="main_image" accept="image/*" style="display:none;">
                                    <div class="primary-image-actions" id="addPrimaryImageActions" style="display:none; margin-top:5px;">
                                        <button type="button"
                                            class="action-btn btn-block"
                                            style="width: 100%; display: flex; justify-content: center; align-items: center;" onclick="replaceAddPrimaryImage()">
                                            Choose File
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Gallery -->
                            <div class="gallery-images-section">
                                <h4>Gallery Images</h4>
                                <div class="upload-area" id="addGalleryUploadArea">
                                    <div class="upload-placeholder">
                                        <div class="upload-icon">📷</div>
                                        <p><strong>Drag gallery images here</strong></p>
                                        <p>or <button type="button" class="upload-btn" onclick="document.getElementById('addGalleryImageFiles').click()">choose files</button></p>
                                        <small>Multiple allowed (JPG, PNG, WEBP, max 5MB each)</small>
                                    </div>
                                    <input type="file" id="addGalleryImageFiles" name="gallery_images[]" multiple accept="image/*" style="display:none;">
                                </div>
                                <div class="gallery-grid" id="addGalleryGrid"></div>
                            </div>
                        </div>

                        <!-- Details Tab -->
                        <div class="edit-tab-content" id="add-detailsTab">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="add_weight">Weight (gram)</label>
                                    <input type="text" id="add_weight" name="weight" step="1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_dim_x">Dim x</label>
                                    <input type="text" id="add_dim_x" name="dim_x" step="0.1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_dim_y">Dim Y</label>
                                    <input type="text" id="add_dim_y" name="dim_y" step="0.1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_dim_z">Dim Z</label>
                                    <input type="text" id="add_dim_z" name="dim_z" step="0.1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_pieces">Pieces</label>
                                    <input type="number" id="add_pieces" name="pieces" step="0.1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_year">Year</label>
                                    <input type="number" id="add_year" name="year" step="0.1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_min_age">Min age</label>
                                    <input type="number" id="add_min_age" name="min_age" step="0.1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_description">Description</label>
                                    <input type="text" id="add_description" name="description" step="0.1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_extended_description">Extended Description</label>
                                    <input type="text" id="add_extended_description" name="extended_description" step="0.1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_remarks">Remarks</label>
                                    <input type="text" id="add_remarks" name="remarks" step="0.1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_set_minifigures">Minifigs</label>
                                    <input type="text" id="add_set_minifigures" name="set_minifigures" step="0.1" min="0">
                                </div>
                            </div>
                        </div>

                        <!-- Pricing Tab -->
                        <div class="edit-tab-content" id="add-pricingTab">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="add_price">Price</label>
                                    <style>
                                        .swal2-container {
                                            z-index: 20000 !important;
                                            /* Higher than Bootstrap modal (1050–1060) */
                                        }
                                    </style>

                                    <meta name="csrf-token" content="{{ csrf_token() }}">

                                    <input type="number" id="add_price" name="price" step="0.01" min="0" placeholder="Price will be auto-fetch against Item No!">
                                    <button type="button" class="btn-primary" style="
                                        text-align: center;
                                        height: 25px;
                                        width: 100%;
                                        background: #4CAF51;
                                        color: #fff;
                                        border-radius: 5px;
                                        padding: 10px 18px;
                                        cursor: pointer;
                                        transition: all 0.3s ease;
                                        display: inline-flex;
                                        align-items: center;
                                        justify-content: center; /* ✅ Center horizontally */
                                        gap: 8px;
                                        box-shadow: 0 3px 8px rgba(0,0,0,0.2);" id="fetchPriceBtn">Fetch Price</button>

                                    <script>
                                        document.getElementById("fetchPriceBtn").addEventListener("click", function() {
                                            const btn = this;
                                            btn.disabled = true;
                                            btn.textContent = "Fetching...";

                                            const payload = {
                                                item_no: document.getElementById("add_item_no")?.value || "ABC123",
                                                item_type: document.getElementById("add_item_type")?.value || "ABC123",
                                                item_color_id: document.getElementById("add_color_id")?.value || "ABC123",
                                                item_condition: document.getElementById("add_condition")?.value || "ABC123"
                                            };

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
                                                        const priceField = document.getElementById("add_price");
                                                        priceField.value = data.avg_price;
                                                        priceField.removeAttribute("disabled");
                                                    } else {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Invalid Item No',
                                                            text: 'Please provide the valid Item No, Item Type, Color ID & Condition to fetch the price!'
                                                        });
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error("Error fetching price:", error);
                                                    alert("Failed to fetch price.");
                                                })
                                                .finally(() => {
                                                    btn.disabled = false;
                                                    btn.textContent = "Fetch Price";
                                                });
                                        });
                                    </script>
                                </div>

                                <div class="form-group">
                                    <label for="add_sell_price">Sell Price</label>
                                    <input type="number" id="add_sell_price" name="sell_price" step="0.01" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_purchase_price">Purchase Price</label>
                                    <input type="number" id="add_purchase_price" name="purchase_price" step="0.01" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_sale_rate">Sale Rate (%)</label>
                                    <input type="number" id="add_sale_rate" name="sale_rate" step="0.01" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_tier_quantity1">Tier Quantity 1</label>
                                    <input type="number" id="add_tier_quantity1" name="tier_quantity1" step="1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_tier_price1">Tier Price 1</label>
                                    <input type="number" id="add_tier_price1" name="tier_price1" step="0.01" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_tier_quantity2">Tier Quantity 2</label>
                                    <input type="number" id="add_tier_quantity2" name="tier_quantity2" step="1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_tier_price2">Tier Price 2</label>
                                    <input type="number" id="add_tier_price2" name="tier_price2" step="0.01" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_tier_quantity3">Tier Quantity 3</label>
                                    <input type="number" id="add_tier_quantity3" name="tier_quantity3" step="1" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_tier_price3">Tier Price 3</label>
                                    <input type="number" id="add_tier_price3" name="tier_price3" step="0.01" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="add_currency">Currency</label>
                                    <input type="text" id="add_currency" name="currency" maxlength="3" placeholder="e.g. EUR">
                                </div>
                                <div class="form-group" style="margin:8px 0;">
                                    <label style="display:flex; align-items:center; gap:25px; font-weight:600; cursor:pointer; margin-top: 23px;">
                                        Lock Price
                                        <input type="checkbox" id="add_lock_price" name="lock_price" style="width:18px; height:18px; cursor:pointer;">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- shopifyIntegrationTab Tab -->
                        <div class="edit-tab-content" id="add-shopifyIntegrationTab">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="add_shopify_variant_id">Shopify Varient ID</label>
                                    <input type="text" id="add_shopify_variant_id" name="shopify_variant_id">
                                </div>

                                <div class="form-group">
                                    <label for="add_shopify_product_id">Shopify Product ID</label>
                                    <input type="text" id="add_shopify_product_id" name="shopify_product_id">
                                </div>
                            </div>
                        </div>

                        <!-- amazonIntegrationTab Tab -->
                        <div class="edit-tab-content" id="add-amazonIntegrationTab">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="add_amazon_sku">Amazon SKU</label>
                                    <input type="text" id="add_amazon_sku" name="amazon_sku">
                                </div>

                                <div class="form-group">
                                    <label for="add_amazon_price">Amazon Price</label>
                                    <input type="text" id="add_amazon_price" name="amazon_price">
                                </div>

                                <div class="form-group">
                                    <label for="add_amazon_condition_type">Amazon Condition Type</label>
                                    <input type="text" id="add_amazon_condition_type" name="amazon_condition_type">
                                </div>

                                <div class="form-group">
                                    <label for="add_amazon_fulfillment_channel">Amazon Fulfillment Channel</label>
                                    <input type="text" id="add_amazon_fulfillment_channel" name="amazon_fulfillment_channel">
                                </div>

                                <div class="form-group">
                                    <label for="add_amazon_target_age_min">Amazon Target Age Min</label>
                                    <input type="text" id="add_amazon_target_age_min" name="amazon_target_age_min">
                                </div>

                                <div class="form-group">
                                    <label for="add_amazon_listing_id">Amazon Listing ID</label>
                                    <input type="text" id="add_amazon_listing_id" name="amazon_listing_id">
                                </div>

                                <div class="form-group">
                                    <label for="add_amazon_status">Amazon Status</label>
                                    <input type="text" id="add_amazon_status" name="amazon_status">
                                </div>

                                <div class="form-group">
                                    <label for="add_amazon_last_sync">Amazon Last Sync</label>
                                    <input type="text" id="add_amazon_last_sync" name="amazon_last_sync">
                                </div>
                            </div>
                        </div>

                        <!-- ebayIntegrationTab Tab -->
                        <div class="edit-tab-content" id="add-ebayIntegrationTab">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="add_ebay_item_id">Ebay Item ID</label>
                                    <input type="text" id="add_ebay_item_id" name="ebay_item_id">
                                </div>

                                <div class="form-group">
                                    <label for="add_ebay_price">Ebay Price</label>
                                    <input type="text" id="add_ebay_price" name="ebay_price">
                                </div>

                                <div class="form-group">
                                    <label for="add_ebay_condition_id">Ebay Condition ID</label>
                                    <input type="text" id="add_ebay_condition_id" name="ebay_condition_id">
                                </div>

                                <div class="form-group">
                                    <label for="add_ebay_category_id">Ebay Category ID</label>
                                    <input type="text" id="add_ebay_category_id" name="ebay_category_id">
                                </div>

                                <div class="form-group">
                                    <label for="add_ebay_listing_type">Ebay Listing Type</label>
                                    <input type="text" id="add_ebay_listing_type" name="ebay_listing_type">
                                </div>

                                <div class="form-group">
                                    <label for="add_ebay_listing_duration">Ebay Listing Duration</label>
                                    <input type="text" id="add_ebay_listing_duration" name="ebay_listing_duration">
                                </div>

                                <div class="form-group">
                                    <label for="add_ebay_primary_image">Ebay Primary Image</label>
                                    <input type="text" id="add_ebay_primary_image" name="ebay_primary_image">
                                </div>

                                <div class="form-group">
                                    <label for="add_ebay_item_specifics">Ebay Item Specifics</label>
                                    <input type="text" id="add_ebay_item_specifics" name="ebay_item_specifics">
                                </div>

                                <div class="form-group">
                                    <label for="add_ebay_handling_time">Ebay Handling Time</label>
                                    <input type="text" id="add_ebay_handling_time" name="ebay_handling_time">
                                </div>

                                <div class="form-group">
                                    <label for="add_ebay_sku">Ebay SKU</label>
                                    <input type="text" id="add_ebay_sku" name="ebay_sku">
                                </div>

                                <div class="form-group">
                                    <label for="add_ebay_status">Ebay Status</label>
                                    <input type="text" id="add_ebay_status" name="ebay_status">
                                </div>

                                <div class="form-group">
                                    <label for="add_ebay_last_sync">Ebay Last Sync</label>
                                    <input type="text" id="add_ebay_last_sync" name="ebay_last_sync">
                                </div>
                            </div>
                        </div>

                        <!-- bolComIntegrationTab Tab -->
                        <div class="edit-tab-content" id="add-bolComIntegrationTab">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="add_bol_active">Bol Active</label>
                                    <input type="text" id="add_bol_active" name="bol_active">
                                </div>

                                <div class="form-group">
                                    <label for="add_bol_offerId">Bol Offer ID</label>
                                    <input type="text" id="add_bol_offerId" name="bol_offerId">
                                </div>

                                <div class="form-group">
                                    <label for="add_bol_price">Bol Price</label>
                                    <input type="text" id="add_bol_price" name="bol_price">
                                </div>

                                <div class="form-group">
                                    <label for="add_bol_fulfilment_method">Bol Fulfilment Method</label>
                                    <input type="text" id="add_bol_fulfilment_method" name="bol_fulfilment_method">
                                </div>

                                <div class="form-group">
                                    <label for="add_bol_delivery_code">Bol Delivery Code</label>
                                    <input type="text" id="add_bol_delivery_code" name="bol_delivery_code">
                                </div>
                            </div>
                        </div>

                        <!-- Supplier & Location Tab -->
                        <div class="edit-tab-content" id="add-supplierAndLocationTab">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="add_supplier">Supplier</label>
                                    <input type="text" id="add_supplier" name="supplier">
                                </div>

                                <div class="form-group">
                                    <label for="add_stockSupplier">Stock Supplier</label>
                                    <input type="text" id="add_stockSupplier" name="stockSupplier">
                                </div>

                                <div class="form-group">
                                    <label for="add_location_id">Location ID</label>
                                    <input type="text" id="add_location_id" name="location_id">
                                </div>

                                <div class="form-group">
                                    <label for="add_lot_id">Lot ID</label>
                                    <input type="text" id="add_lot_id" name="lot_id">
                                </div>

                                <div class="form-group">
                                    <label for="add_super_lot_id">Super Lot ID</label>
                                    <input type="text" id="add_super_lot_id" name="super_lot_id">
                                </div>

                                <div class="form-group">
                                    <label for="add_super_lot_qty">Super Lot Quantity</label>
                                    <input type="text" id="add_super_lot_qty" name="super_lot_qty">
                                </div>
                            </div>
                        </div>

                        <!-- specialPropertiesAndOtherTab Tab -->
                        <div class="edit-tab-content" id="add-specialPropertiesAndOtherTab">
                            <div class="form-grid">
                                <div class="form-group" style="margin:8px 0;">
                                    <label style="display:flex; align-items:center; gap:25px; font-weight:600; cursor:pointer;">
                                        Retired
                                        <input type="checkbox" id="add_retired" name="retired" style="width:18px; height:18px; cursor:pointer;">
                                    </label>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="add_rebrickable_id">Rebrickable ID</label>
                                    <input type="text" id="add_rebrickable_id" name="rebrickable_id">
                                </div>

                                <div class="form-group">
                                    <label for="add_woocommerce_parent_id">WooCommerce Parent ID</label>
                                    <input type="text" id="add_woocommerce_parent_id" name="woocommerce_parent_id">
                                </div>

                                <div class="form-group">
                                    <label for="add_woocommerce_id">WooCommerce ID</label>
                                    <input type="text" id="add_woocommerce_id" name="woocommerce_id">
                                </div>

                                <div class="form-group">
                                    <label for="add_bricklink_inventory_id">BrickLink Inventory ID</label>
                                    <input type="text" id="add_bricklink_inventory_id" name="bricklink_inventory_id">
                                </div>

                                <div class="form-group">
                                    <label for="add_brickowl_id">BrickOwl ID</label>
                                    <input type="text" id="add_brickowl_id" name="brickowl_id">
                                </div>

                                <div class="form-group">
                                    <label for="add_element_id">Element ID</label>
                                    <input type="text" id="add_element_id" name="element_id">
                                </div>

                                <div class="form-group">
                                    <label for="add_notifyvalues">Notify Values</label>
                                    <input type="text" id="add_notifyvalues" name="notifyvalues">
                                </div>

                                <div class="form-group">
                                    <label for="add_notifyselected">Notify Selected</label>
                                    <input type="text" id="add_notifyselected" name="notifyselected">
                                </div>

                                <div class="form-group">
                                    <label for="add_notifystatus">Notify Status</label>
                                    <input type="text" id="add_notifystatus" name="notifystatus">
                                </div>

                                <div class="form-group">
                                    <label for="add_bind_id">Bind ID</label>
                                    <input type="text" id="add_bind_id" name="bind_id">
                                </div>

                                <div class="form-group">
                                    <label for="add_reserved_for">Reserved For</label>
                                    <input type="text" id="add_reserved_for" name="reserved_for">
                                </div>

                                <div class="form-group">
                                    <label for="add_date">Date</label>
                                    <input type="text" id="add_date" name="date">
                                </div>

                                <div class="form-group">
                                    <label for="add_new_or_used">New or Used</label>
                                    <input type="text" id="add_new_or_used" name="new_or_used">
                                </div>

                                <div class="form-group">
                                    <label for="add_upgrades">Upgrades</label>
                                    <input type="text" id="add_upgrades" name="upgrades">
                                </div>
                            </div>
                        </div>

                        <!-- Vinted Tab -->
                        <div class="edit-tab-content" id="add-vintedTab">
                            <div class="form-grid">
                                <div class="form-group" style="margin:8px 0;">
                                    <label style="display:flex; align-items:center; gap:25px; font-weight:600; cursor:pointer;">
                                        Active
                                        <input type="checkbox" id="add_vinted_active" name="vinted_active" style="width:18px; height:18px; cursor:pointer;">
                                    </label>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="add_vinted_item_id">Vinted Item ID</label>
                                    <input type="text" id="add_vinted_item_id" name="vinted_item_id">
                                </div>

                                <div class="form-group">
                                    <label for="add_vinted_item_id">Vinted Bulk Amount</label>
                                    <input type="text" id="add_vinted_bulk_amount" name="vinted_bulk_amount">
                                </div>

                                <div class="form-group">
                                    <label for="add_vinted_status">Vinted Status</label>
                                    <input type="text" id="add_vinted_status" name="vinted_status">
                                </div>
                                <div class="form-group">

                                </div>

                                <!-- Main Image -->
                                <div class="primary-image-section">
                                    <h4>Main Image</h4>
                                    <div class="primary-image-container">
                                        <div class="primary-image-preview" id="vinted_addPrimaryImagePreview">
                                            <div class="upload-placeholder">
                                                <div class="upload-icon">🖼️</div>
                                                <p><strong>Drag main image here</strong></p>
                                                <p>or <button type="button" class="upload-btn" onclick="document.getElementById('vinted_addPrimaryImageFile').click()">choose file</button></p>
                                                <small>JPG, PNG, WEBP (max 5MB)</small>
                                            </div>
                                        </div>
                                        <input type="file" id="vinted_addPrimaryImageFile" name="vinted_main_image" accept="image/*" style="display:none;">
                                        <div class="primary-image-actions" id="vinted_addPrimaryImageActions" style="display:none; margin-top:5px;">
                                            <button type="button"
                                                class="action-btn btn-block"
                                                style="width: 100%; display: flex; justify-content: center; align-items: center;" onclick="vinted_replaceAddPrimaryImage()">
                                                Choose File
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Gallery -->
                                <div class="gallery-images-section">
                                    <h4>Gallery Images</h4>
                                    <div class="upload-area" id="vinted_addGalleryUploadArea">
                                        <div class="upload-placeholder">
                                            <div class="upload-icon">📷</div>
                                            <p><strong>Drag gallery images here</strong></p>
                                            <p>or <button type="button" class="upload-btn" onclick="document.getElementById('vinted_addGalleryImageFiles').click()">choose files</button></p>
                                            <small>Multiple allowed (JPG, PNG, WEBP, max 5MB each)</small>
                                        </div>
                                        <input type="file" id="vinted_addGalleryImageFiles" name="vinted_gallery_images[]" multiple accept="image/*" style="display:none;">
                                    </div>
                                    <div class="gallery-grid" id="vinted_addGalleryGrid"></div>
                                </div>

                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-secondary" onclick="closeAddModal()">Cancel</button>
                            <button type="submit" class="btn-primary">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Stock Adjustment Modal -->
        <div class="modal-overlay" id="stockModal">
            <div class="modal">
                <div class="modal-header">
                    <h2>Adjust Stock</h2>
                    <button class="close-btn" onclick="closeStockModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="stock-info">
                        <div class="current-stock">
                            <h3>Current Stock</h3>
                            <div class="stock-display">
                                <span class="stock-number" id="currentStock">0</span>
                                <span class="stock-label">pcs</span>
                            </div>
                        </div>
                        <div class="product-summary">
                            <h4 id="stockProductName">Product Name</h4>
                            <p id="stockProductDetails">SKU: --- | Condition: ---</p>
                        </div>
                    </div>

                    <form id="stockForm" class="stock-form" method="POST">
                        @csrf
                        <div class="stock-adjustment">
                            <h3>Stock Adjustment</h3>
                            <div class="adjustment-type">
                                <label class="radio-option">
                                    <input type="radio" name="adjustmentType" value="set" checked>
                                    <span>Set New Value</span>
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="adjustmentType" value="add">
                                    <span>Add (+)</span>
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="adjustmentType" value="subtract">
                                    <span>Subtract (-)</span>
                                </label>
                            </div>
                            <div class="adjustment-input">
                                <label for="stockAmount">Amount</label>
                                <input type="number" id="stockAmount" name="amount" min="0" required>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="btn-secondary" onclick="closeStockModal()">Cancel</button>
                            <button type="submit" class="btn-primary">Update Stock</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification container -->
    <div class="notification" id="notification"></div>

    <button class="quick-add-fab" onclick="addNewItem()">+</button>

    <style>
        .gallery-item button {
            transition: background 0.2s ease;
        }

        .gallery-item button:hover {
            background: red !important;
        }
    </style>
    <script>
        // Switch between tabs
        function switchEditTab(tabName) {
            document.querySelectorAll('.edit-tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.edit-tab-content').forEach(tab => tab.classList.remove('active'));

            const activeBtn = document.querySelector(`.edit-tab-btn[onclick="switchEditTab('${tabName}')"]`);
            if (activeBtn) activeBtn.classList.add('active');

            document.getElementById(tabName + 'Tab').classList.add('active');
        }
        const productData = @json($products); // $products should be keyed by productId
    </script>

    <script>
        function addNewItem() {
            const modal = document.getElementById('addModal');
            modal.classList.add('show');
            modal.style.display = 'block';
        }
        window.closeAddModal = function() {
            const modal = document.getElementById('addModal');
            modal.classList.remove('show');
            modal.style.display = 'none';
        };

        // Handle Add Modal Primary Image
        function replaceAddPrimaryImage() {
            document.getElementById("addPrimaryImageFile").click();
        }

        document.getElementById("addPrimaryImageFile").addEventListener("change", function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById("addPrimaryImagePreview").innerHTML =
                    `<img src="${event.target.result}" alt="Primary Image" style="width:130px;">`;
                document.getElementById("addPrimaryImageActions").style.display = "block";
            };
            reader.readAsDataURL(file);
        });

        // Handle Add Modal Gallery
        document.getElementById("addGalleryImageFiles").addEventListener("change", function(e) {
            const files = e.target.files;
            const galleryGrid = document.getElementById("addGalleryGrid");
            galleryGrid.innerHTML = "";

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const img = document.createElement("img");
                    img.src = event.target.result;
                    img.style.maxWidth = "100px";
                    img.style.margin = "5px";
                    galleryGrid.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });

        // Vinted
        function vinted_replaceAddPrimaryImage() {
            document.getElementById("vinted_addPrimaryImageFile").click();
        }

        document.getElementById("vinted_addPrimaryImageFile").addEventListener("change", function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById("vinted_addPrimaryImagePreview").innerHTML =
                    `<img src="${event.target.result}" alt="Primary Image" style="width:130px;">`;
                document.getElementById("vinted_addPrimaryImageActions").style.display = "block";
            };
            reader.readAsDataURL(file);
        });

        // Handle Add Modal Gallery
        document.getElementById("vinted_addGalleryImageFiles").addEventListener("change", function(e) {
            const files = e.target.files;
            const galleryGrid = document.getElementById("vinted_addGalleryGrid");
            galleryGrid.innerHTML = "";

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const img = document.createElement("img");
                    img.src = event.target.result;
                    img.style.maxWidth = "100px";
                    img.style.margin = "5px";
                    galleryGrid.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
    <script>
        let primaryImage = null;
        let galleryImages = [];
        let singleImageUrl = '';

        // ------------------ Edit Item ------------------
        window.editItem = function(productId) {

            console.log('editItem called with:', productId);

            // get form by ID
            const form = document.getElementById('editForm');

            // set dynamic action (must match your update route)
            form.action = `./update-product/${productId}`;

            const product = productData.data.find(p => p.id == productId);
            console.log("product detailzZz:", product);
            if (!product) {
                Swal.fire({
                    icon: 'error',
                    title: 'Product not found',
                    text: 'Could not load product data.'
                });
                return;
            }

            try {
                // Reset everything
                primaryImage = null;
                galleryImages = [];
                vinted_galleryImages = [];
                singleImageUrl = '';
                document.getElementById('galleryGrid').innerHTML = '';
                document.getElementById('primaryImagePreview').innerHTML = '<div class="upload-placeholder"><div class="upload-icon">🖼️</div><p><strong>Drag main image here</strong></p><p>or <button type="button" class="upload-btn" onclick="document.getElementById(\'primaryImageFile\').click()">choose file</button></p><small>JPG, PNG, WEBP (max 5MB)</small></div>';
                document.getElementById('main_image_input').value = '';
                document.getElementById('gallery_images_input').value = '';
                document.getElementById('primaryImageActions').style.display = 'none';


                document.getElementById('vinted_galleryGrid').innerHTML = '';
                document.getElementById('vinted_primaryImagePreview').innerHTML = '<div class="upload-placeholder"><div class="upload-icon">🖼️</div><p><strong>Drag main image here</strong></p><p>or <button type="button" class="upload-btn" onclick="document.getElementById(\'vinted_primaryImageFile\').click()">choose file</button></p><small>JPG, PNG, WEBP (max 5MB)</small></div>';
                document.getElementById('vinted_main_image_input').value = '';
                document.getElementById('vinted_gallery_images_input').value = '';
                document.getElementById('vinted_primaryImageActions').style.display = 'none';

                const setField = (id, val) => {
                    const el = document.getElementById(id);
                    if (el) el.value = val ?? '';
                };

                // ------------------ Basic Info ------------------
                document.getElementById('edit_vinted_active').checked = (product.vinted_active == 1);
                // setField('vinted_active', product.vinted_active);
                setField('edit_vinted_item_id', product.vinted_item_id);
                setField('edit_vinted_bulk_amount', product.vinted_bulk_amount);
                setField('edit_vinted_status', product.vinted_status);
                setField('edit_name', product.title);
                setField('edit_item_no', product.item_no);
                setField('edit_item_type', product.item_type);
                setField('edit_color_id', product.color_id);
                setField('edit_stock', product.stock);
                setField('edit_sku', product.sku);
                setField('edit_ean', product.gtin);
                setField('edit_category', product.category);
                setField('edit_condition', product.condition);
                setField('edit_price', product.price);
                setField('edit_bricklink_inventory_id', product.bricklink_inventory_id);
                setField('edit_rebrickable_id', product.rebrickable_id);
                setField('edit_completeness', product.completeness);
                setField('edit_weight', product.weight);
                setField('edit_dim_x', product.dim_x);
                setField('edit_dim_y', product.dim_y);
                setField('edit_dim_z', product.dim_z);
                setField('edit_pieces', product.pieces);
                setField('edit_year', product.year);
                setField('edit_min_age', product.min_age);
                setField('edit_description', product.description);
                setField('edit_extended_description', product.extended_description);
                setField('edit_set_minifigures', product.set_minifigures);
                setField('edit_remarks', product.remarks);
                setField('edit_price', product.price);
                setField('edit_sell_price', product.sell_price);
                setField('edit_purchase_price', product.purchase_price);
                setField('edit_sale_rate', product.sale_rate);
                setField('edit_tier_quantity1', product.tier_quantity1);
                setField('edit_tier_price1', product.tier_price1);
                setField('edit_tier_quantity2', product.tier_quantity2);
                setField('edit_tier_price2', product.tier_price2);
                setField('edit_tier_quantity3', product.tier_quantity3);
                setField('edit_tier_price3', product.tier_price3);
                setField('edit_currency', product.currency);
                setField('edit_shopify_variant_id', product.shopify_variant_id);
                setField('edit_shopify_product_id', product.shopify_product_id);
                setField('edit_amazon_sku', product.amazon_sku);
                setField('edit_amazon_price', product.amazon_price);
                setField('edit_amazon_condition_type', product.amazon_condition_type);
                setField('edit_amazon_fulfillment_channel', product.amazon_fulfillment_channel);
                setField('edit_amazon_target_age_min', product.amazon_target_age_min);
                setField('edit_amazon_listing_id', product.amazon_listing_id);
                setField('edit_amazon_status', product.amazon_status);
                setField('edit_amazon_last_sync', product.amazon_last_sync);
                setField('edit_ebay_item_id', product.ebay_item_id);
                setField('edit_ebay_price', product.ebay_price);
                setField('edit_ebay_condition_id', product.ebay_condition_id);
                setField('edit_ebay_category_id', product.ebay_category_id);
                setField('edit_ebay_listing_type', product.ebay_listing_type);
                setField('edit_ebay_listing_duration', product.ebay_listing_duration);
                setField('edit_ebay_primary_image', product.ebay_primary_image);
                setField('edit_ebay_item_specifics', product.ebay_item_specifics);
                setField('edit_ebay_handling_time', product.ebay_handling_time);
                setField('edit_ebay_sku', product.ebay_sku);
                setField('edit_ebay_status', product.ebay_status);
                setField('edit_ebay_last_sync', product.ebay_last_sync);
                setField('edit_bol_active', product.bol_active);
                setField('edit_bol_offerId', product.bol_offerId);
                setField('edit_bol_price', product.bol_price);
                setField('edit_bol_fulfilment_method', product.bol_fulfilment_method);
                setField('edit_bol_delivery_code', product.bol_delivery_code);
                setField('edit_woocommerce_parent_id', product.woocommerce_parent_id);
                setField('edit_woocommerce_id', product.woocommerce_id);
                setField('edit_bricklink_inventory_id', product.bricklink_inventory_id);
                setField('edit_brickowl_id', product.brickowl_id);
                setField('edit_element_id', product.element_id);
                setField('edit_notifyvalues', product.notifyvalues);
                setField('edit_notifyselected', product.notifyselected);
                setField('edit_notifystatus', product.notifystatus);
                setField('edit_bind_id', product.bind_id);
                setField('edit_reserved_for', product.reserved_for);
                setField('edit_date', product.date);
                setField('edit_new_or_used', product.new_or_used);
                setField('edit_upgrades', product.upgrades);
                document.getElementById('edit_retired').checked = (product.retired == 1);
                document.getElementById('edit_lock_price').checked = (product.lock_price == 1);

                setField('edit_supplier', product.supplier);
                setField('edit_stockSupplier', product.stockSupplier);
                setField('edit_location_id', product.location_id);
                setField('edit_lot_id', product.lot_id);
                setField('edit_super_lot_id', product.super_lot_id);
                setField('edit_super_lot_qty', product.super_lot_qty);

                // ------------------ Main Image Preview ------------------
                if (product.main_image) {
                    showMainImage(product.main_image);
                }
                setField('product_image_url', product.imageurl);

                // ------------------ Gallery Images Preview ------------------
                if (product.gallery_images) {
                    let galleryArr = [];
                    try {
                        if (typeof product.gallery_images === "string") {
                            if (product.gallery_images.trim().startsWith("[")) {
                                galleryArr = JSON.parse(product.gallery_images);
                            } else if (product.gallery_images.includes(",")) {
                                galleryArr = product.gallery_images.split(",");
                            } else {
                                galleryArr = [product.gallery_images];
                            }
                        } else if (Array.isArray(product.gallery_images)) {
                            galleryArr = product.gallery_images;
                        }
                    } catch (e) {
                        galleryArr = [String(product.gallery_images)];
                    }

                    const galleryGrid = document.getElementById("galleryGrid");

                    galleryArr.forEach(url => {
                        if (!url) return;
                        const imgUrl = url; // keep exact URL (don’t modify with /public)

                        const wrapper = document.createElement('div');
                        wrapper.classList.add('gallery-item');
                        wrapper.style.position = "relative";
                        wrapper.style.display = "inline-block";
                        wrapper.style.margin = "5px";

                        const img = document.createElement('img');
                        img.src = ".." + imgUrl.replace(/^\/public/, '');
                        img.classList.add('img-thumbnail');
                        img.style.maxWidth = "100%";
                        img.style.borderRadius = "6px";

                        const delBtn = document.createElement('button');
                        delBtn.innerHTML = "×";
                        delBtn.style.position = "absolute";
                        delBtn.style.top = "2px";
                        delBtn.style.right = "2px";
                        delBtn.style.background = "rgba(0,0,0,0.6)";
                        delBtn.style.color = "white";
                        delBtn.style.border = "none";
                        delBtn.style.borderRadius = "50%";
                        delBtn.style.width = "20px";
                        delBtn.style.height = "20px";
                        delBtn.style.cursor = "pointer";
                        delBtn.style.fontSize = "14px";
                        delBtn.style.lineHeight = "18px";

                        // delete handler
                        delBtn.addEventListener("click", function() {
                            wrapper.remove();
                            galleryImages = galleryImages.filter(u => u !== imgUrl);
                            document.getElementById('gallery_images_input').value = JSON.stringify(galleryImages);
                        });

                        wrapper.appendChild(img);
                        wrapper.appendChild(delBtn);
                        galleryGrid.appendChild(wrapper);

                        galleryImages.push(imgUrl); // push real URL
                    });

                    // update hidden input
                    document.getElementById('gallery_images_input').value = JSON.stringify(galleryImages);
                }

                // Vinted
                // ------------------ Main Image Preview ------------------
                if (product.vinted_main_image) {
                    vinted_showMainImage(product.vinted_main_image);
                }

                // ------------------ Gallery Images Preview ------------------
                if (product.vinted_gallery_images) {
                    let galleryArr = [];
                    try {
                        if (typeof product.vinted_gallery_images === "string") {
                            if (product.vinted_gallery_images.trim().startsWith("[")) {
                                galleryArr = JSON.parse(product.vinted_gallery_images);
                            } else if (product.vinted_gallery_images.includes(",")) {
                                galleryArr = product.vinted_gallery_images.split(",");
                            } else {
                                galleryArr = [product.vinted_gallery_images];
                            }
                        } else if (Array.isArray(product.vinted_gallery_images)) {
                            galleryArr = product.vinted_gallery_images;
                        }
                    } catch (e) {
                        galleryArr = [String(product.vinted_gallery_images)];
                    }

                    const galleryGrid = document.getElementById("vinted_galleryGrid");

                    galleryArr.forEach(url => {
                        if (!url) return;
                        const imgUrl = url; // keep exact URL (don’t modify with /public)

                        const wrapper = document.createElement('div');
                        wrapper.classList.add('gallery-item');
                        wrapper.style.position = "relative";
                        wrapper.style.display = "inline-block";
                        wrapper.style.margin = "5px";

                        const img = document.createElement('img');
                        img.src = ".." + imgUrl.replace(/^\/public/, '');
                        img.classList.add('img-thumbnail');
                        img.style.maxWidth = "100%";
                        img.style.borderRadius = "6px";

                        const delBtn = document.createElement('button');
                        delBtn.innerHTML = "×";
                        delBtn.style.position = "absolute";
                        delBtn.style.top = "2px";
                        delBtn.style.right = "2px";
                        delBtn.style.background = "rgba(0,0,0,0.6)";
                        delBtn.style.color = "white";
                        delBtn.style.border = "none";
                        delBtn.style.borderRadius = "50%";
                        delBtn.style.width = "20px";
                        delBtn.style.height = "20px";
                        delBtn.style.cursor = "pointer";
                        delBtn.style.fontSize = "14px";
                        delBtn.style.lineHeight = "18px";

                        // delete handler
                        delBtn.addEventListener("click", function() {
                            wrapper.remove();
                            vinted_galleryImages = vinted_galleryImages.filter(u => u !== imgUrl);
                            document.getElementById('vinted_gallery_images_input').value = JSON.stringify(vinted_galleryImages);
                        });

                        wrapper.appendChild(img);
                        wrapper.appendChild(delBtn);
                        galleryGrid.appendChild(wrapper);

                        vinted_galleryImages.push(imgUrl); // push real URL
                    });

                    // update hidden input
                    document.getElementById('vinted_gallery_images_input').value = JSON.stringify(vinted_galleryImages);
                }

                // ------------------ Show Modal ------------------
                const modal = document.getElementById('editModal');
                modal.classList.add('show');
                modal.style.display = 'block';

                console.log('Edit modal opened:', productId);

            } catch (err) {
                console.error('Error filling form:', err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Could not load product data.'
                });
            }
        };

        window.closeEditModal = function() {
            const modal = document.getElementById('editModal');
            modal.classList.remove('show');
            modal.style.display = 'none';
        };

        function showMainImage(imgUrl) {
            const preview = document.getElementById('primaryImagePreview');
            preview.innerHTML = '';
            const img = document.createElement('img');
            img.src = ".." + imgUrl.replace(/^\/public/, '');
            img.classList.add('img-thumbnail');
            img.style.maxWidth = "150px";
            img.style.margin = "5px";
            preview.appendChild(img);

            primaryImage = imgUrl;
            document.getElementById('main_image_input').value = primaryImage;
            document.getElementById('primaryImageActions').style.display = 'block';
        }

        document.getElementById('primaryImageFile').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const mainImagePreview = document.getElementById('primaryImagePreview');
            mainImagePreview.innerHTML = '';

            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.alt = "Main Image";
            img.classList.add("img-thumbnail");
            img.style.maxWidth = "150px";
            img.style.margin = "5px";
            mainImagePreview.appendChild(img);
        });

        function replacePrimaryImage() {
            document.getElementById('primaryImageFile').click();
        }


        function removePrimaryImage() {
            primaryImage = null;
            document.getElementById('main_image_input').value = '';
            document.getElementById('primaryImagePreview').innerHTML = '<div class="upload-placeholder"><div class="upload-icon">🖼️</div><p><strong>Drag main image here</strong></p><p>or <button type="button" class="upload-btn" onclick="document.getElementById(\'primaryImageFile\').click()">choose file</button></p><small>JPG, PNG, WEBP (max 5MB)</small></div>';
            document.getElementById('primaryImageActions').style.display = 'none';
        }

        // ------------------ Gallery Images Upload ------------------
        document.getElementById('galleryImageFiles').addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            const galleryGrid = document.getElementById('galleryGrid');

            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const imgUrl = event.target.result;

                    const wrapper = document.createElement('div');
                    wrapper.classList.add('gallery-item');
                    wrapper.style.position = "relative";
                    wrapper.style.display = "inline-block";
                    wrapper.style.margin = "5px";

                    const img = document.createElement('img');
                    img.src = imgUrl;
                    img.classList.add('img-thumbnail');
                    img.style.maxWidth = "100%";
                    img.style.borderRadius = "6px";

                    const delBtn = document.createElement('button');
                    delBtn.innerHTML = "×";
                    delBtn.style.position = "absolute";
                    delBtn.style.top = "2px";
                    delBtn.style.right = "2px";
                    delBtn.style.background = "rgba(0,0,0,0.6)";
                    delBtn.style.color = "white";
                    delBtn.style.border = "none";
                    delBtn.style.borderRadius = "50%";
                    delBtn.style.width = "20px";
                    delBtn.style.height = "20px";
                    delBtn.style.cursor = "pointer";
                    delBtn.style.fontSize = "14px";
                    delBtn.style.lineHeight = "18px";

                    delBtn.addEventListener("click", function() {
                        wrapper.remove();
                        galleryImages = galleryImages.filter(u => u !== imgUrl);
                        document.getElementById('gallery_images_input').value = JSON.stringify(galleryImages);
                    });

                    wrapper.appendChild(img);
                    wrapper.appendChild(delBtn);
                    galleryGrid.appendChild(wrapper);

                    galleryImages.push(imgUrl);
                    document.getElementById('gallery_images_input').value = JSON.stringify(galleryImages);
                };
                reader.readAsDataURL(file);
            });
        });

        // ------------------ Always sync before submit ------------------
        document.getElementById('editForm').addEventListener('submit', function() {
            document.getElementById('gallery_images_input').value = JSON.stringify(galleryImages);
        });

        // Vinted
        function vinted_showMainImage(imgUrl) {
            const preview = document.getElementById('vinted_primaryImagePreview');
            preview.innerHTML = '';
            const img = document.createElement('img');
            img.src = ".." + imgUrl.replace(/^\/public/, '');
            img.classList.add('img-thumbnail');
            img.style.maxWidth = "150px";
            img.style.margin = "5px";
            preview.appendChild(img);

            primaryImage = imgUrl;
            document.getElementById('vinted_main_image_input').value = primaryImage;
            document.getElementById('vinted_primaryImageActions').style.display = 'block';
        }

        document.getElementById('vinted_primaryImageFile').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const mainImagePreview = document.getElementById('vinted_primaryImagePreview');
            mainImagePreview.innerHTML = '';

            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.alt = "Main Image";
            img.classList.add("img-thumbnail");
            img.style.maxWidth = "150px";
            img.style.margin = "5px";
            mainImagePreview.appendChild(img);
        });

        function vinted_replacePrimaryImage() {
            document.getElementById('vinted_primaryImageFile').click();
        }

        function vinted_removePrimaryImage() {
            primaryImage = null;
            document.getElementById('vinted_main_image_input').value = '';
            document.getElementById('vinted_primaryImagePreview').innerHTML = '<div class="upload-placeholder"><div class="upload-icon">🖼️</div><p><strong>Drag main image here</strong></p><p>or <button type="button" class="upload-btn" onclick="document.getElementById(\'vinted_primaryImageFile\').click()">choose file</button></p><small>JPG, PNG, WEBP (max 5MB)</small></div>';
            document.getElementById('vinted_primaryImageActions').style.display = 'none';
        }

        // ------------------ Gallery Images Upload ------------------
        document.getElementById('vinted_galleryImageFiles').addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            const galleryGrid = document.getElementById('vinted_galleryGrid');

            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const imgUrl = event.target.result;

                    const wrapper = document.createElement('div');
                    wrapper.classList.add('gallery-item');
                    wrapper.style.position = "relative";
                    wrapper.style.display = "inline-block";
                    wrapper.style.margin = "5px";

                    const img = document.createElement('img');
                    img.src = imgUrl;
                    img.classList.add('img-thumbnail');
                    img.style.maxWidth = "100%";
                    img.style.borderRadius = "6px";

                    const delBtn = document.createElement('button');
                    delBtn.innerHTML = "×";
                    delBtn.style.position = "absolute";
                    delBtn.style.top = "2px";
                    delBtn.style.right = "2px";
                    delBtn.style.background = "rgba(0,0,0,0.6)";
                    delBtn.style.color = "white";
                    delBtn.style.border = "none";
                    delBtn.style.borderRadius = "50%";
                    delBtn.style.width = "20px";
                    delBtn.style.height = "20px";
                    delBtn.style.cursor = "pointer";
                    delBtn.style.fontSize = "14px";
                    delBtn.style.lineHeight = "18px";

                    delBtn.addEventListener("click", function() {
                        wrapper.remove();
                        vinted_galleryImages = vinted_galleryImages.filter(u => u !== imgUrl);
                        document.getElementById('vinted_gallery_images_input').value = JSON.stringify(vinted_galleryImages);
                    });

                    wrapper.appendChild(img);
                    wrapper.appendChild(delBtn);
                    galleryGrid.appendChild(wrapper);

                    vinted_galleryImages.push(imgUrl);
                    document.getElementById('vinted_gallery_images_input').value = JSON.stringify(vinted_galleryImages);
                };
                reader.readAsDataURL(file);
            });
        });

        // ------------------ Always sync before submit ------------------
        document.getElementById('editForm').addEventListener('submit', function() {
            document.getElementById('vinted_gallery_images_input').value = JSON.stringify(vinted_galleryImages);
        });
        // vinted end

        function adjustStock(productId) {

            // get form by ID
            const form = document.getElementById('stockForm');
            // set dynamic action (must match your update route)
            form.action = `/update-stock/${productId}`;

            console.log('adjustStock called with:', productId);
            const product = productData.data.find(p => p.id == productId);
            if (!product) {
                showNotification('Product niet gevonden', 'error');
                return;
            }

            // Populate stock modal
            const currentStockEl = document.getElementById('currentStock');
            const stockProductNameEl = document.getElementById('stockProductName');
            const stockProductDetailsEl = document.getElementById('stockProductDetails');
            const stockAmountEl = document.getElementById('stockAmount');
            const previewStockEl = document.getElementById('previewStock');

            if (currentStockEl) currentStockEl.textContent = product.stock;
            if (stockProductNameEl) stockProductNameEl.textContent = product.name;
            if (stockProductDetailsEl) stockProductDetailsEl.textContent = `SKU: ${product.sku} | Conditie: ${product.condition}`;
            if (stockAmountEl) stockAmountEl.value = '';
            if (previewStockEl) previewStockEl.textContent = product.stock;

            // Reset form
            const setRadioEl = document.querySelector('input[name="adjustmentType"][value="set"]');
            if (setRadioEl) setRadioEl.checked = true;

            const stockReasonEl = document.getElementById('stockReason');
            const stockNoteEl = document.getElementById('stockNote');
            if (stockReasonEl) stockReasonEl.value = '';
            if (stockNoteEl) stockNoteEl.value = '';

            const stockModal = document.getElementById('stockModal');
            if (stockModal) {
                stockModal.classList.add('show');
                stockModal.setAttribute('data-product-id', productId);
                console.log('Stock modal opened for:', productId);
            }
        }

        window.closeStockModal = function() {
            const modal = document.getElementById('stockModal');
            modal.classList.remove('show');
            modal.style.display = 'none';
        };

        function setupSingleUrlTest() {
            const urlInput = document.getElementById('product_image_url');
            if (urlInput) {
                urlInput.addEventListener('input', function() {
                    const preview = document.getElementById('singleUrlPreview');
                    if (this.value.trim() === '') {
                        preview.style.display = 'none';
                    }
                });
            }
        }

        function testSingleImageUrl() {
            const urlInput = document.getElementById('product_image_url');
            const preview = document.getElementById('singleUrlPreview');
            const previewImg = document.getElementById('singleUrlImage');
            const statusSpan = document.getElementById('singleUrlStatus');
            const dimensionsSpan = document.getElementById('singleUrlDimensions');
            const url = urlInput.value.trim();

            if (!url) {
                showNotification('Voer een URL in om te testen', 'warning');
                return;
            }

            try {
                new URL(url);
            } catch {
                showNotification('Ongeldige URL format', 'error');
                return;
            }

            statusSpan.textContent = 'Testen...';
            statusSpan.style.color = '#666';
            preview.style.display = 'flex';

            const img = new Image();
            img.onload = function() {
                previewImg.src = url;
                statusSpan.textContent = 'URL geldig';
                statusSpan.style.color = '#4CAF50';
                dimensionsSpan.textContent = `${this.naturalWidth}x${this.naturalHeight}`;
                singleImageUrl = url;
                showNotification('Image URL succesvol getest', 'success');
            };

            img.onerror = function() {
                statusSpan.textContent = 'URL ongeldig';
                statusSpan.style.color = '#f44336';
                dimensionsSpan.textContent = 'Kan niet laden';
                showNotification('Afbeelding kon niet worden geladen', 'error');
            };

            img.src = url;
        }
    </script>

</body>

</html>