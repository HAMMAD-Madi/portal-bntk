<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping & Returns - CrocoBricks</title>
    <style>
      

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: normal;
            margin-bottom: 20px;
        }

        .search-filters {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .search-filters input,
        .search-filters select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            flex: 1;
            min-width: 200px;
            background: white;
        }

        .search-filters input:focus,
        .search-filters select:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
        }

        .header-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-primary {
            background: #2196F3;
            border: 1px solid #2196F3;
            color: white;
        }

        .btn-secondary {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
        }

        .btn-secondary:hover {
            background: rgba(255,255,255,0.3);
        }

        .btn-success {
            background: #4CAF50;
            color: white;
        }

        .btn-danger {
            background: #f44336;
            color: white;
        }

        .btn-warning {
            background: #ff9800;
            color: white;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        /* Stats Cards */
        .stats-container {
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
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #666;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .stat-sublabel {
            font-size: 12px;
            color: #95a5a6;
            margin-top: 5px;
        }

        .stat-chart {
            height: 40px;
            background: linear-gradient(90deg, #2196F3, #42A5F5);
            border-radius: 4px;
            position: relative;
            overflow: hidden;
            margin-top: 10px;
        }

        .stat-chart:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: repeating-linear-gradient(
                90deg,
                transparent,
                transparent 8px,
                rgba(255,255,255,0.3) 8px,
                rgba(255,255,255,0.3) 12px
            );
        }

        /* Section */
        .section {
            background: white;
            margin-bottom: 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .section-count {
            background: #6c757d;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .toggle-icon {
            transition: transform 0.2s;
            font-size: 14px;
        }

        .toggle-icon.collapsed {
            transform: rotate(-90deg);
        }

        .section-content {
            display: block;
        }

        .section-content.collapsed {
            display: none;
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

        /* Bulk Actions */
        .bulk-actions {
            display: flex;
            gap: 10px;
            padding: 15px 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #e0e0e0;
            flex-wrap: wrap;
            align-items: center;
        }

        .bulk-label {
            font-weight: 600;
            color: #333;
            margin-right: 10px;
        }

        /* Table */
        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        thead {
            background-color: #f8f9fa;
        }

        th {
            text-align: left;
            padding: 12px 8px;
            font-weight: 600;
            color: #555;
            font-size: 12px;
            border-bottom: 1px solid #e0e0e0;
        }

        td {
            padding: 12px 8px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .badge-packed {
            background-color: #D1ECF1;
            color: #0C5460;
        }

        .badge-shipped {
            background-color: #D4EDDA;
            color: #155724;
        }

        .badge-completed {
            background-color: #CCE5FF;
            color: #004085;
        }

        .badge-pending {
            background-color: #FFF3CD;
            color: #856404;
        }

        .badge-approved {
            background-color: #D4EDDA;
            color: #155724;
        }

        .badge-rejected {
            background-color: #F8D7DA;
            color: #721C24;
        }

        .badge-processed {
            background-color: #E2E3E5;
            color: #383D41;
        }

        .platform-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: 600;
            margin-right: 5px;
        }

        .platform-bl {
            background: #ffeaa7;
            color: #6c5ce7;
        }

        .platform-bol {
            background: #74b9ff;
            color: #0984e3;
        }

        .platform-ebay {
            background: #fab1a0;
            color: #e17055;
        }

        .platform-croco {
            background: #a29bfe;
            color: #6c5ce7;
        }

        .action-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: 600;
            margin-right: 5px;
        }

        .action-lvb {
            background: #d6eaf8;
            color: #1b4f72;
        }

        .action-sendcloud {
            background: #d5f4e6;
            color: #0e6251;
        }

        .action-notify {
            background: #fadbd8;
            color: #78281f;
        }

        .sync-indicator {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: 600;
        }

        .sync-synced {
            background: #d4edda;
            color: #155724;
        }

        .sync-pending {
            background: #fff3cd;
            color: #856404;
        }

        .sync-failed {
            background: #f8d7da;
            color: #721c24;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        /* Metrics Grid */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            padding: 20px;
        }

        .metric-card {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 6px;
            border-left: 4px solid #4CAF50;
        }

        .metric-value {
            font-size: 26px;
            font-weight: 700;
            color: #333;
        }

        .metric-label {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        /* Return Reason Chart */
        .reason-chart {
            margin: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 6px;
        }

        .reason-chart h4 {
            margin-bottom: 15px;
            color: #333;
        }

        .reason-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .reason-label {
            width: 200px;
            font-size: 13px;
            color: #333;
        }

        .reason-bar {
            flex: 1;
            height: 24px;
            background: white;
            border-radius: 4px;
            overflow: hidden;
            position: relative;
        }

        .reason-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #2196F3, #42A5F5);
            display: flex;
            align-items: center;
            padding: 0 10px;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        .tracking-link {
            color: #0066CC;
            text-decoration: none;
            font-weight: 600;
        }

        .tracking-link:hover {
            text-decoration: underline;
        }

        .tracking-info {
            font-size: 11px;
            color: #666;
            margin-top: 3px;
        }

        .day-indicator {
            font-weight: 600;
        }

        .day-critical {
            color: #f44336;
        }

        .day-warning {
            color: #ff9800;
        }

        .day-good {
            color: #4CAF50;
        }

        .info-box {
            margin: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 6px;
            border-left: 4px solid #2196F3;
        }

        .info-box strong {
            color: #333;
        }

        .info-box a {
            color: #0066CC;
            text-decoration: none;
            font-weight: 600;
        }

        .content {
            background-color: white;
            margin: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: 1fr;
            }

            .header-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .search-filters {
                flex-direction: column;
            }

            .search-filters input,
            .search-filters select {
                width: 100%;
            }

            .bulk-actions {
                flex-direction: column;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 8px;
            }
        }
    </style>
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
                        <div class="nav-item active">
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
            <!-- Header -->
            <div class="header">
                <h1>📦 Shipping Content</h1>
                
                <div class="search-filters">
                    <input style="min-width: 500px;" type="text" id="searchInput" placeholder="🔍 Search by order number, customer name or platform...">
                    <!--<select id="statusFilter">-->
                    <!--    <option value="">All statuses</option>-->
                    <!--    <option value="PACKED">Packed</option>-->
                    <!--    <option value="SHIPPED">Shipped</option>-->
                    <!--    <option value="COMPLETED">Completed</option>-->
                    <!--</select>-->
                    <!--<select id="platformFilter">-->
                    <!--    <option value="">All platforms</option>-->
                    <!--    <option value="BL">Bricklink</option>-->
                    <!--    <option value="BOL">Bol.com</option>-->
                    <!--    <option value="EBAY">eBay</option>-->
                    <!--    <option value="CROCO">CrocoBricks</option>-->
                    <!--</select>-->
                </div>
    
                <div class="header-actions">
                    <button class="btn btn-primary" onclick="syncAllMarketplaces()">🔄 Sync All Marketplaces</button>
                    <!--<button class="btn btn-primary" onclick="exportOrders()">📥 Export Orders</button>-->
                    <button class="btn btn-secondary" onclick="refreshData()">🔄 Refresh</button>
                    <!--<button class="btn btn-secondary" onclick="openSettings()">⚙️ Settings</button>-->
                </div>
            </div>
    
            <!-- Stats -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-label">Packed Orders</div>
                    <div class="stat-number"><?= count($packed_orders) ?></div>
                    <div class="stat-chart"></div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Shipped Orders</div>
                    <div class="stat-number"><?= count($shipped_orders) ?></div>
                    <div class="stat-chart"></div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Completed Orders</div>
                    <div class="stat-number"><?= count($completed_orders) ?></div>
                    <div class="stat-chart"></div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Pending Returns</div>
                    <div class="stat-number">8</div>
                    <div class="stat-chart"></div>
                </div>
            </div>
    
            <!-- Content Wrapper -->
            <div class="content">
                <!-- Performance Metrics -->
                <!--<div style="padding: 20px; border-bottom: 1px solid #e0e0e0;">-->
                <!--    <h3 style="margin-bottom: 15px; color: #333;">📊 Performance Metrics</h3>-->
                <!--    <div class="metrics-grid">-->
                <!--        <div class="metric-card">-->
                <!--            <div class="metric-value">2.3 days</div>-->
                <!--            <div class="metric-label">Avg. processing time</div>-->
                <!--        </div>-->
                <!--        <div class="metric-card">-->
                <!--            <div class="metric-value">4.1%</div>-->
                <!--            <div class="metric-label">Return rate this month</div>-->
                <!--        </div>-->
                <!--        <div class="metric-card">-->
                <!--            <div class="metric-value">€847.40</div>-->
                <!--            <div class="metric-label">Total refund value</div>-->
                <!--        </div>-->
                <!--        <div class="metric-card">-->
                <!--            <div class="metric-value">3</div>-->
                <!--            <div class="metric-label">Orders at risk (>3 days)</div>-->
                <!--        </div>-->
                <!--    </div>-->
                </div>
    
                <!-- Packed Orders -->
                <div class="section">
                    <div class="section-header" onclick="toggleSection('packed')">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span class="toggle-icon" id="packed-icon">▼</span>
                            <span class="section-title">
                                Packed Orders
                                <span class="section-count"><?= count($packed_orders) ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="section-content" id="packed-content">
                        <div class="bulk-actions">
                            <span class="bulk-label"><span id="packed-selected">0</span> orders selected</span>
                            <!--<button class="btn btn-primary btn-sm" onclick="bulkSendcloud('packed')">📦 Sendcloud Labels</button>-->
                            <button class="btn btn-success btn-sm" onclick="bulkMarkShipped('shipped')">✓ Mark as Shipped</button>
                            <!--<button class="btn btn-secondary btn-sm" onclick="exportSelected('packed')">📥 Export</button>-->
                        </div>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" onclick="toggleAll('packed')"></th>
                                        <th>Created</th>
                                        <th>Status</th>
                                        <th>Order</th>
                                        <th>Customer</th>
                                        <th>Platform</th>
                                        <th>Subtotal</th>
                                        <th>Total</th>
                                        <th>Days</th>
                                        <!--<th>Sync</th>-->
                                        <!--<th>Actions</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($ready_to_packed_orders as $order){ ?>
                                        <tr>
                                            <td><input type="checkbox" class="order-check" value="<?= $order->id ?>"></td>
                                            <td><?= $order->created_at ?></td>
                                            <td><span class="badge badge-packed">PACKED</span></td>
                                            <td> <a href="http://a400wsckk88ogos84woksgog.185.222.240.190.sslip.io/shipping-detail/<?= $order->marketplace_order_id ?>"># <?= $order->marketplace_order_id ?></a></a></td>
                                            <td><?= $order->customer_name ?></td>
                                            <td><span class="platform-badge platform-bol"><?= $order->marketplace_type ?></span></td>
                                            <td>€ <?= $order->subtotal ?></td>
                                            <td>€ <?= $order->total_amount ?></td>
                                            
                                            @php
                                                $days = \Carbon\Carbon::parse($order->created_at)->diffInDays(now());
                                            
                                                $class =
                                                    $days <= 2 ? 'day-normal' :
                                                    ($days <= 5 ? 'day-warning' : 'day-critical');
                                            @endphp
                                            <td>
                                                <span class="day-indicator {{ $class }}">
                                                    {{ round($days, 0) }} day(s)
                                                </span>
                                            </td>

                                            <!--<td><span class="sync-indicator sync-failed">FAILED</span></td>-->
                                            <!--<td>-->
                                            <!--    <div class="action-buttons">-->
                                            <!--        <button class="btn btn-primary btn-sm" onclick="viewOrder('A0007PLLF')">👁️</button>-->
                                            <!--        <button class="btn btn-warning btn-sm" onclick="retrySync('A0007PLLF')">🔄</button>-->
                                            <!--    </div>-->
                                            <!--</td>-->
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    
                <!-- Shipped Orders -->
                <br><br>
                <div class="section">
                    <div class="section-header" onclick="toggleSection('shipped')">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span class="toggle-icon collapsed" id="shipped-icon">▼</span>
                            <span class="section-title">
                                Shipped Orders
                                <span class="section-count"><?= count($shipped_orders) ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="section-content collapsed" id="shipped-content">
                        <div class="bulk-actions">
                            <span class="bulk-label"><span id="shipped-selected">0</span> orders selected</span>
                            <!--<button class="btn btn-primary btn-sm" onclick="bulkBricklinkNotify('shipped')">📧 Bricklink Notify</button>-->
                            <!--<button class="btn btn-primary btn-sm" onclick="bulkTrackingEmail('shipped')">📧 Tracking Email</button>-->
                            <!--<button class="btn btn-secondary btn-sm" onclick="exportSelected('shipped')">📥 Export</button>-->
                        </div>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" onclick="toggleAll('shipped')"></th>
                                        <th>Created</th>
                                        <th>Status</th>
                                        <th>Order</th>
                                        <th>Customer</th>
                                        <th>Platform</th>
                                        <th>Subtotal</th>
                                        <th>Total</th>
                                        <!--<th>Tracking</th>-->
                                        <!--<th>Notification</th>-->
                                        <!--<th>Actions</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($shipped_orders as $order){ ?>
                                        <tr>
                                            <td><input type="checkbox" class="order-check"></td>
                                            <td><?= $order->created_at ?></td>
                                            <td><span class="badge badge-shipped">SHIPPED</span></td>
                                            <td> <a href="http://a400wsckk88ogos84woksgog.185.222.240.190.sslip.io/shipping-detail/<?= $order->marketplace_order_id ?>"># <?= $order->marketplace_order_id ?></a></a></td>
                                            <td><?= $order->customer_name ?></td>
                                            <td><span class="platform-badge platform-bl"><?= $order->marketplace_type ?></span></td>
                                            <td>€ <?= $order->subtotal ?></td>
                                            <td>€ <?= $order->total_amount ?></td>
                                            <!--<td>-->
                                            <!--    <a href="#" class="tracking-link" onclick="trackPackage('3SABCD1234567'); return false;">3SABCD1234567</a>-->
                                            <!--    <div class="tracking-info">📍 In transit - ETA: 31 Oct</div>-->
                                            </td>
                                            <!--<td><span style="color: #4CAF50; font-weight: 600;">✓ Sent</span></td>-->
                                            <!--<td>-->
                                            <!--    <div class="action-buttons">-->
                                            <!--        <button class="btn btn-primary btn-sm" onclick="viewOrder('A0007SABC')">👁️</button>-->
                                            <!--        <button class="btn btn-secondary btn-sm" onclick="trackPackage('3SABCD1234567')">📦</button>-->
                                            <!--    </div>-->
                                            <!--</td>-->
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    
                <br><br>
                <!-- Completed Orders -->
                <div class="section">
                    <div class="section-header" onclick="toggleSection('completed')">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span class="toggle-icon collapsed" id="completed-icon">▼</span>
                            <span class="section-title">
                                Completed Orders
                                <span class="section-count"><?= count($completed_orders) ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="section-content collapsed" id="completed-content">
                        <div class="bulk-actions">
                            <span class="bulk-label"><span id="completed-selected">0</span> orders selected</span>
                            <!--<button class="btn btn-primary btn-sm" onclick="bulkBricklinkFeedback('completed')">⭐ Bricklink Feedback</button>-->
                            <!--<button class="btn btn-secondary btn-sm" onclick="bulkReviews('completed')">⭐ Reviews</button>-->
                            <!--<button class="btn btn-secondary btn-sm" onclick="exportSelected('completed')">📥 Export</button>-->
                        </div>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" onclick="toggleAll('completed')"></th>
                                        <th>Created</th>
                                        <th>Status</th>
                                        <th>Order</th>
                                        <th>Customer</th>
                                        <th>Platform</th>
                                        <th>Subtotal</th>
                                        <th>Total</th>
                                        <!--<th>Delivered</th>-->
                                        <!--<th>Feedback</th>-->
                                        <!--<th>Actions</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($completed_orders as $order){ ?>
                                        <tr>
                                            <td><input type="checkbox" class="order-check"></td>
                                            <td><?= $order->created_at ?></td>
                                            <td><span class="badge badge-completed">COMPLETED</span></td>
                                            <td> <a href="http://a400wsckk88ogos84woksgog.185.222.240.190.sslip.io/shipping-detail/<?= $order->marketplace_order_id ?>"># <?= $order->marketplace_order_id ?></a></a></td>
                                            <td><?= $order->customer_name ?></td>
                                            <td><span class="platform-badge platform-bl"><?= $order->marketplace_type ?></span></td>
                                            <td>€ <?= $order->subtotal ?></td>
                                            <td>€ <?= $order->total_amount ?></td>
                                            <!--<td>26 Jul 2025</td>-->
                                            <!--<td><span style="color: #ff9800;">⏳ Waiting</span></td>-->
                                            <!--<td>-->
                                            <!--    <div class="action-buttons">-->
                                            <!--        <button class="btn btn-primary btn-sm" onclick="viewOrder('A0007CAAA')">👁️</button>-->
                                            <!--        <button class="btn btn-success btn-sm" onclick="requestFeedback('A0007CAAA')">✓</button>-->
                                            <!--    </div>-->
                                            <!--</td>-->
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    
                <br><br>
                <!-- Returns -->
                <div class="section">
                    <div style="padding: 20px; border-bottom: 1px solid #e0e0e0;">
                        <h3 style="margin-bottom: 20px; color: #333;">↩️ Returns Management</h3>
                        
                        <div class="stats-container" style="margin: 0; padding: 0; background: transparent; border: none;">
                            <div class="stat-card">
                                <div class="stat-label">Pending Returns</div>
                                <div class="stat-number"><?= $pending_returns ?></div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-label">Approved This Month</div>
                                <div class="stat-number"><?= $approved_returns ?></div>
                                <!--<div class="stat-sublabel" style="color: #4CAF50;">+12% vs last month</div>-->
                            </div>
                            <div class="stat-card">
                                <div class="stat-label">Rejected This Month</div>
                                <div class="stat-number"><?= $rejected_returns ?></div>
                                <!--<div class="stat-sublabel" style="color: #f44336;">-2% vs last month</div>-->
                            </div>
                            <div class="stat-card">
                                <div class="stat-label">Processed This Month</div>
                                <div class="stat-number"><?= $processed_returns_this_month ?></div>
                            </div>
                        </div>
    
                        <div class="reason-chart">
                            <h4>Top 5 Return Reasons</h4>
                        
                            @foreach ($top_return_reasons as $reason)
                                <div class="reason-item">
                                    <div class="reason-label">{{ $reason->return_reason }}</div>
                                    <div class="reason-bar">
                                        <div class="reason-bar-fill" style="width: {{ $reason->percentage }}%;">
                                            {{ $reason->percentage }}%
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        
                            @if ($top_return_reasons->isEmpty())
                                <p style="color: #777; margin-top: 10px;">No return data available.</p>
                            @endif
                        </div>

                    </div>
    
                    <div class="bulk-actions">
                        <!--<span class="bulk-label"><span id="returns-selected">0</span> returns selected</span>-->
                        <!--<button class="btn btn-success btn-sm" onclick="bulkApprove()">✓ Approve</button>-->
                        <!--<button class="btn btn-danger btn-sm" onclick="bulkReject()">✗ Reject</button>-->
                        <!--<button class="btn btn-primary btn-sm" onclick="bulkRefund()">💰 Refund</button>-->
                        <!--<button class="btn btn-secondary btn-sm" onclick="exportSelected('returns')">📥 Export</button>-->
                    </div>
    
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <!--<th><input type="checkbox" onclick="toggleAll('returns')"></th>-->
                                    <th>Sr #</th>
                                    <th>Return ID</th>
                                    <th>Platform</th>
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <th>Reason</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <!--<th>Deadline</th>-->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; foreach($return_orders as $order){ ?>
                                    <tr>
                                        <!--<td><input type="checkbox" class="return-check"></td>-->
                                        <td><?= $count ?></td>
                                        <td><?= $order->marketplace_return_id ?></td>
                                        <td><span class="platform-badge platform-bol"><?= $order->marketplace_type ?></span></td>
                                        <td> <a href="http://a400wsckk88ogos84woksgog.185.222.240.190.sslip.io/shipping-detail/<?= $order->marketplace_order_id ?>"># <?= $order->marketplace_order_id ?></a></a></td>
                                        <td><?= $order->customer_name ?? '--' ?></td>
                                        <td><?= $order->return_reason ?></td>
                                        <td>€<?= $order->total_amount ?></td>
                                        <td><span class="badge {{ ($order->return_status=='received') ? 'badge-pending' : 'badge-rejected'}}"><?= $order->return_status ?></span></td>
                                        <td><?= $order->created_at ?></td>
                                        <!--<td style="color: #f44336;">12 Aug (1 day)</td>-->
                                        <td>
                                            <div class="action-buttons">
                                                <!--<button class="btn btn-primary btn-sm" onclick="viewReturn('RET001')">👁️</button>-->
                                                <button class="btn btn-success btn-sm" onclick="approveReturn('<?= $order->id ?>')">✓</button>
                                                <button class="btn btn-danger btn-sm" onclick="rejectReturn('<?= $order->id ?>')">✗</button>
                                            </div>
                                        </td>
                                    </tr>  
                                <?php $count++; } ?>
                            </tbody>
                        </table>
                    </div>
    
                    <div class="info-box">
                        <strong>📋 Return Policy:</strong> Customers have 14 days after receipt to initiate a return.
                        <!--<a href="#">View full policy →</a>-->
                    </div>
                </div>
            </div>
        </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // Toggle sections
        function toggleSection(section) {
            const content = document.getElementById(section + '-content');
            const icon = document.getElementById(section + '-icon');
            content.classList.toggle('collapsed');
            icon.classList.toggle('collapsed');
        }

        // Toggle all checkboxes
        function toggleAll(section) {
            const checkboxes = document.querySelectorAll(`#${section}-content .order-check, #${section}-content .return-check`);
            const headerCheckbox = event.target;
            checkboxes.forEach(cb => cb.checked = headerCheckbox.checked);
            updateCount(section);
        }

        // Update selection count
        function updateCount(section) {
            const checked = document.querySelectorAll(`#${section}-content input[type="checkbox"]:checked`).length;
            const countEl = document.getElementById(section + '-selected');
            if (countEl) countEl.textContent = checked;
        }

        // Add listeners
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.order-check, .return-check').forEach(cb => {
                cb.addEventListener('change', function() {
                    const section = this.closest('.section-content').id.replace('-content', '');
                    updateCount(section);
                });
            });
        });

        // Search
        // document.getElementById('searchInput').addEventListener('input', (e) => {
        //     const term = e.target.value.toLowerCase();
        //     document.querySelectorAll('tbody tr').forEach(row => {
        //         row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
        //     });
        // });
        document.getElementById('searchInput').addEventListener('input', (e) => {
            const term = e.target.value.toLowerCase();
        
            // Loop through each section
            document.querySelectorAll('.section').forEach(section => {
                const content = section.querySelector('.section-content');
                const rows = section.querySelectorAll('tbody tr');
                const icon = section.querySelector('.toggle-icon');
        
                let hasMatch = false;
        
                rows.forEach(row => {
                    const match = row.textContent.toLowerCase().includes(term);
                    row.style.display = match ? '' : 'none';
                    if (match) hasMatch = true;
                });
        
                // 🔥 When search is cleared
                if (term === '') {
                    const isPacked = section.querySelector('.section-title')?.textContent.includes('Packed');
        
                    if (isPacked) {
                        // Open Packed section
                        content.classList.remove('collapsed');
                        icon.classList.remove('collapsed');
                    } else {
                        // Collapse all other sections
                        content.classList.add('collapsed');
                        icon.classList.add('collapsed');
                    }
                    return;
                }
        
                // Expand if rows match, collapse if no match
                if (hasMatch) {
                    content.classList.remove('collapsed');
                    icon.classList.remove('collapsed');
                } else {
                    content.classList.add('collapsed');
                    icon.classList.add('collapsed');
                }
            });
        });


        // Filter
        document.getElementById('statusFilter').addEventListener('change', filterOrders);
        document.getElementById('platformFilter').addEventListener('change', filterOrders);

        function filterOrders() {
            const status = document.getElementById('statusFilter').value;
            const platform = document.getElementById('platformFilter').value;
            document.querySelectorAll('tbody tr').forEach(row => {
                const statusMatch = !status || row.textContent.includes(status);
                const platformMatch = !platform || row.textContent.includes(platform);
                row.style.display = (statusMatch && platformMatch) ? '' : 'none';
            });
        }

        // N8N WEBHOOK FUNCTIONS - Update these URLs to your N8N endpoints

        // Sync functions
        function syncAllMarketplaces() {
            console.log('N8N Webhook: POST /webhook/sync-all-marketplaces');
            alert('Syncing to all marketplaces via N8N...');
        }

        function retrySync(orderId) {
            console.log(`N8N Webhook: POST /webhook/retry-sync/${orderId}`);
            alert(`Retry sync for order ${orderId} via N8N...`);
        }

        // Sendcloud functions
        function bulkSendcloud(section) {
            const count = document.querySelectorAll(`#${section}-content input:checked`).length;
            if (count === 0) return alert('Select orders first');
            console.log('N8N Webhook: POST /webhook/sendcloud-bulk-labels');
            alert(`Generating Sendcloud labels for ${count} orders via N8N...`);
        }

        function printLabel(orderId) {
            console.log(`N8N Webhook: POST /webhook/sendcloud-label/${orderId}`);
            alert(`Print Sendcloud label for ${orderId} via N8N...`);
        }

        // Bricklink functions
        function bulkBricklinkNotify(section) {
            const count = document.querySelectorAll(`#${section}-content input:checked`).length;
            if (count === 0) return alert('Select orders first');
            console.log('N8N Webhook: POST /webhook/bricklink-notify-bulk');
            alert(`Sending Bricklink shipping notifications for ${count} orders via N8N...`);
        }

        function bulkBricklinkFeedback(section) {
            const count = document.querySelectorAll(`#${section}-content input:checked`).length;
            if (count === 0) return alert('Select orders first');
            console.log('N8N Webhook: POST /webhook/bricklink-feedback-bulk');
            alert(`Sending Bricklink feedback requests for ${count} orders via N8N...`);
        }

        function requestFeedback(orderId) {
            console.log(`N8N Webhook: POST /webhook/bricklink-feedback/${orderId}`);
            alert(`Send feedback request for ${orderId} via N8N...`);
        }

        // Generic order functions
function bulkMarkShipped(section) {

    const checkedBoxes = document.querySelectorAll(`#packed-content .order-check:checked`);

    if (checkedBoxes.length === 0) {
        alert('Select orders first');
        return;
    }

    // Collect IDs
    let orderIds = [];
    checkedBoxes.forEach(cb => orderIds.push(cb.value));

    $.ajax({
        url: "/orders/change-status/" + section,   // <-- USE SECTION IN URL
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            orders: orderIds                       // send array of ids
        },
        success: function(res) {
            // alert("Status updated successfully!");
            location.reload();
        },
        error: function(xhr) {
            alert("Error updating orders");
            console.log(xhr.responseText);
        }
    });
}



        function markShipped(orderId) {
            console.log(`N8N Webhook: POST /webhook/mark-shipped/${orderId}`);
            alert(`Mark order ${orderId} as shipped via N8N...`);
        }

        function bulkTrackingEmail(section) {
            const count = document.querySelectorAll(`#${section}-content input:checked`).length;
            if (count === 0) return alert('Select orders first');
            console.log('N8N Webhook: POST /webhook/tracking-email-bulk');
            alert(`Sending tracking emails to ${count} customers via N8N...`);
        }

        function bulkReviews(section) {
            const count = document.querySelectorAll(`#${section}-content input:checked`).length;
            if (count === 0) return alert('Select orders first');
            console.log('N8N Webhook: POST /webhook/review-request-bulk');
            alert(`Sending review requests to ${count} customers via N8N...`);
        }

        // Return functions
        function bulkApprove() {
            const count = document.querySelectorAll('.return-check:checked').length;
            if (count === 0) return alert('Select returns first');
            if (!confirm(`Approve ${count} returns?`)) return;
            console.log('N8N Webhook: POST /webhook/returns-approve-bulk');
            alert(`${count} returns approved via N8N...`);
        }

        function bulkReject() {
            const count = document.querySelectorAll('.return-check:checked').length;
            if (count === 0) return alert('Select returns first');
            if (!confirm(`Reject ${count} returns?`)) return;
            console.log('N8N Webhook: POST /webhook/returns-reject-bulk');
            alert(`${count} returns rejected via N8N...`);
        }

        function bulkRefund() {
            const count = document.querySelectorAll('.return-check:checked').length;
            if (count === 0) return alert('Select returns first');
            if (!confirm(`Process refunds for ${count} returns?`)) return;
            console.log('N8N Webhook: POST /webhook/returns-refund-bulk');
            alert(`Refunds processed for ${count} returns via N8N...`);
        }

        function approveReturn(returnId) {
            if (!confirm(`Approve return ${returnId}?`)) return;
            // console.log(`N8N Webhook: POST /webhook/returns-approve/${returnId}`);
            // alert(`Return ${returnId} approved via N8N...`);
            
            $.ajax({
                url: "{{route('approve-return')}}",   // <-- USE SECTION IN URL
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    return_id: returnId                       // send array of ids
                },
                success: function(res) {
                    // alert("Status updated successfully!");
                    location.reload();
                },
                error: function(xhr) {
                    alert("Error updating orders");
                    console.log(xhr.responseText);
                }
            });
        }

        function rejectReturn(returnId) {
            if (!confirm(`Reject return ${returnId}?`)) return;
            // console.log(`N8N Webhook: POST /webhook/returns-reject/${returnId}`);
            // alert(`Return ${returnId} rejected via N8N...`);
            
            $.ajax({
                url: "{{route('reject-return')}}",   // <-- USE SECTION IN URL
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    return_id: returnId                       // send array of ids
                },
                success: function(res) {
                    // alert("Status updated successfully!");
                    location.reload();
                },
                error: function(xhr) {
                    alert("Error updating orders");
                    console.log(xhr.responseText);
                }
            });
        }

        function processRefund(returnId) {
            if (!confirm(`Process refund for ${returnId}?`)) return;
            console.log(`N8N Webhook: POST /webhook/returns-refund/${returnId}`);
            alert(`Refund processed for ${returnId} via N8N...`);
        }

        // View functions
        function viewOrder(orderId) {
            console.log(`View order details: ${orderId}`);
            alert(`Order details for ${orderId}`);
        }

        function viewReturn(returnId) {
            console.log(`View return details: ${returnId}`);
            alert(`Return details for ${returnId}`);
        }

        function trackPackage(trackingCode) {
            console.log(`Track package: ${trackingCode}`);
            alert(`Tracking info for ${trackingCode}`);
        }

        // Export functions
        function exportOrders() {
            console.log('N8N Webhook: POST /webhook/export-all-orders');
            alert('Exporting all orders via N8N...');
        }

        function exportSelected(section) {
            const count = document.querySelectorAll(`#${section}-content input:checked`).length;
            if (count === 0) return alert('Select items first');
            console.log(`N8N Webhook: POST /webhook/export-${section}`);
            alert(`Exporting ${count} items via N8N...`);
        }

        // Other functions
        function refreshData() {
            console.log('Refreshing data...');
            location.reload();
        }

        function openSettings() {
            alert('Opening settings...');
        }
    </script>

</body>

</html>