<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - CrocoBricks</title>
    <style>
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin-bottom: 0;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: normal;
        }

        .header-actions {
            display: flex;
            gap: 10px;
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

        .btn-warning {
            background: #ff9800;
            color: white;
        }

        .btn-danger {
            background: #f44336;
            color: white;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        .order-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            color: white;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 12px;
            opacity: 0.9;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 500;
        }

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

        .platform-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: 600;
        }

        .platform-bl {
            background: #ffeaa7;
            color: #6c5ce7;
        }

        .platform-bol {
            background: #74b9ff;
            color: #0984e3;
        }

        .platform-croco {
            background: #a29bfe;
            color: #6c5ce7;
        }

        .platform-ebay {
            background: #fab1a0;
            color: #e17055;
        }

        .content {
            background: white;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .section {
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }

        /* Sync Status Section */
        .sync-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .sync-card {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            border-left: 4px solid #4CAF50;
        }

        .sync-card.error {
            border-left-color: #f44336;
        }

        .sync-card.warning {
            border-left-color: #ff9800;
        }

        .sync-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .sync-name {
            font-weight: 600;
            color: #333;
        }

        .sync-status {
            font-size: 11px;
            padding: 4px 8px;
            border-radius: 3px;
            font-weight: 600;
        }

        .sync-status.active {
            background: #d4edda;
            color: #155724;
        }

        .sync-status.error {
            background: #f8d7da;
            color: #721c24;
        }

        .sync-status.pending {
            background: #fff3cd;
            color: #856404;
        }

        .sync-time {
            font-size: 12px;
            color: #666;
        }

        /* Alert Box */
        .alert-box {
            background: #fff3cd;
            border-left: 4px solid #ff9800;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-box h4 {
            color: #856404;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .alert-item {
            padding: 8px 0;
            border-bottom: 1px solid rgba(133, 100, 4, 0.1);
            font-size: 13px;
            color: #856404;
        }

        .alert-item:last-child {
            border-bottom: none;
        }

        .alert-critical {
            color: #f44336;
            font-weight: 600;
        }

        .alert-warning {
            color: #ff9800;
            font-weight: 600;
        }

        /* Sendcloud Carrier Selection */
        .sendcloud-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .sendcloud-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .sendcloud-logo {
            background: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 700;
            color: #00A3E0;
            font-size: 16px;
            border: 2px solid #00A3E0;
        }

        .carrier-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
    margin-bottom: 15px;
    padding: 20px;
    width: 100%;
}


        .carrier-card {
            background: white;
            padding: 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .carrier-card:hover {
            border-color: #4CAF50;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .carrier-card.selected {
            border-color: #4CAF50;
            background: #e8f5e9;
        }

        .carrier-card.selected::after {
            content: '✓';
            position: absolute;
            top: 10px;
            right: 10px;
            background: #4CAF50;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        .carrier-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .carrier-logo {
            font-size: 32px;
        }

        .carrier-info {
            flex: 1;
        }

        .carrier-name {
            font-weight: 700;
            color: #333;
            font-size: 16px;
            margin-bottom: 4px;
        }

        .carrier-service {
            font-size: 12px;
            color: #666;
        }

        .carrier-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            padding-top: 12px;
            border-top: 1px solid #e0e0e0;
        }

        .carrier-detail {
            display: flex;
            flex-direction: column;
        }

        .carrier-detail-label {
            font-size: 11px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .carrier-detail-value {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-top: 4px;
        }

        .carrier-price {
            color: #4CAF50;
        }

        .carrier-recommended {
            position: absolute;
            top: -8px;
            left: 12px;
            background: #ff9800;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        /* Horizontal Timeline */
        .timeline-horizontal {
            padding: 30px 20px;
            overflow-x: auto;
        }

        .timeline-track {
            display: flex;
            align-items: flex-start;
            position: relative;
            min-width: 800px;
        }

        .timeline-step {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            padding: 0 10px;
        }

        .timeline-step::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 50%;
            right: -50%;
            height: 3px;
            background: #e0e0e0;
            z-index: 0;
        }

        .timeline-step:last-child::before {
            display: none;
        }

        .timeline-step.completed::before {
            background: #4CAF50;
        }

        .timeline-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            border: 3px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-bottom: 12px;
            z-index: 1;
            position: relative;
        }

        .timeline-step.completed .timeline-icon {
            background: #4CAF50;
            border-color: #4CAF50;
            color: white;
        }

        .timeline-step.active .timeline-icon {
            background: #fff3cd;
            border-color: #ff9800;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(255, 152, 0, 0.4);
            }
            50% {
                box-shadow: 0 0 0 8px rgba(255, 152, 0, 0);
            }
        }

        .timeline-content {
            text-align: center;
        }

        .timeline-title {
            font-weight: 600;
            color: #333;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .timeline-step.completed .timeline-title {
            color: #4CAF50;
        }

        .timeline-date {
            font-size: 11px;
            color: #666;
            margin-bottom: 4px;
        }

        .timeline-detail {
            font-size: 11px;
            color: #999;
        }

        .tracking-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            margin-top: 20px;
        }

        .tracking-number {
            font-size: 14px;
            color: #333;
            margin-bottom: 8px;
        }

        .tracking-number a {
            color: #2196F3;
            text-decoration: none;
            font-weight: 600;
        }

        .tracking-number a:hover {
            text-decoration: underline;
        }

        .customer-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-card {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
        }

        .info-card h4 {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-card p {
            font-size: 14px;
            color: #333;
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
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
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 12px 8px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        .item-image {
            font-size: 24px;
        }

        .item-info {
            font-weight: 600;
            color: #333;
        }

        .part-id {
            font-size: 12px;
            color: #666;
            margin-top: 2px;
        }

        .color-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: 600;
            background: #e0e0e0;
            color: #333;
        }

        .condition-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: 600;
        }

        .condition-new {
            background: #d4edda;
            color: #155724;
        }

        .condition-used {
            background: #fff3cd;
            color: #856404;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 10px;
            max-width: 400px;
            margin-left: auto;
        }

        .summary-label {
            color: #666;
            font-size: 14px;
        }

        .summary-value {
            text-align: right;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .summary-total {
            padding-top: 10px;
            border-top: 2px solid #e0e0e0;
            margin-top: 10px;
        }

        .summary-total .summary-label {
            font-weight: 600;
            color: #333;
            font-size: 16px;
        }

        .summary-total .summary-value {
            font-size: 18px;
            color: #4CAF50;
        }

        .payment-status {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            margin-top: 15px;
            font-size: 13px;
        }

        .notes-section {
            background: #fff3cd;
            padding: 15px;
            border-radius: 6px;
            border-left: 4px solid #ff9800;
        }

        .notes-section h4 {
            font-size: 14px;
            color: #856404;
            margin-bottom: 8px;
        }

        .notes-section p {
            font-size: 13px;
            color: #856404;
            line-height: 1.6;
        }

        .action-section {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-top {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .header-actions {
                width: 100%;
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .order-info {
                grid-template-columns: 1fr;
            }

            .customer-info {
                grid-template-columns: 1fr;
            }

            .sync-grid {
                grid-template-columns: 1fr;
            }

            .carrier-grid {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 8px 4px;
            }

            .timeline-track {
                min-width: 600px;
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
            color: white !important;
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
                    <div class="header">
            <div class="header-top">
                <h1>📦 Order Details: #<?= $order->marketplace_order_id ?></h1>
                <div class="header-actions">
                    <button class="btn btn-primary" onclick="printPackingSlip()">🖨️ Print Packing Slip</button>
                    <!--<button class="btn btn-primary" onclick="downloadInvoice()">📄 Download Invoice</button>-->
                    <button class="btn btn-secondary"> <a style="text-decoration: none; color: white;" href="https://portal.bntk.eu/all-shippings"> ← Back to Orders </a></button>
                </div>
            </div>
            <div class="order-info">
                <div class="info-item">
                    <div class="info-label" style="color: white !important;">Order Date</div>
                    <div class="info-value"><?= $order->created_at ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label" style="color: white !important;">Status</div>
                    <div class="info-value"><span class="badge badge-packed">PACKED</span></div>
                </div>
                <div class="info-item">
                    <div class="info-label" style="color: white !important;">Platform</div>
                    <div class="info-value"><span class="platform-badge platform-bol"><?= $order->marketplace_type ?></span></div>
                </div>
                <div class="info-item">
                    <div class="info-label" style="color: white !important;">Customer</div>
                    <div class="info-value"><?= $order->customer_name ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label" style="color: white !important;">Total Amount</div>
                    <div class="info-value">€<?= $order->total_amount ?></div>
                </div>
            </div>
        </div>

        <div class="content">
            <!-- Marketplace Sync Status -->
            <!--<div class="section">-->
            <!--    <h3 class="section-title">🔗 Marketplace Synchronization Status</h3>-->
            <!--    <div class="sync-grid">-->
            <!--        <div class="sync-card">-->
            <!--            <div class="sync-header">-->
            <!--                <div class="sync-name">Bol.com LVB Labels</div>-->
            <!--                <span class="sync-status active">✓ ACTIVE</span>-->
            <!--            </div>-->
            <!--            <div class="sync-time">Last sync: 2 min ago</div>-->
            <!--        </div>-->
            <!--        <div class="sync-card">-->
            <!--            <div class="sync-header">-->
            <!--                <div class="sync-name">Bricklink Notifications</div>-->
            <!--                <span class="sync-status active">✓ ACTIVE</span>-->
            <!--            </div>-->
            <!--            <div class="sync-time">Last sync: 5 min ago</div>-->
            <!--        </div>-->
            <!--        <div class="sync-card">-->
            <!--            <div class="sync-header">-->
            <!--                <div class="sync-name">Sendcloud API</div>-->
            <!--                <span class="sync-status active">✓ ACTIVE</span>-->
            <!--            </div>-->
            <!--            <div class="sync-time">Last sync: 1 min ago</div>-->
            <!--        </div>-->
            <!--    </div>-->

                <!--<div class="alert-box">-->
                <!--    <h4>⚠️ Sync Alerts & Warnings</h4>-->
                <!--    <div class="alert-item alert-critical">-->
                <!--        🔴 Bol.com order >24h without tracking (Deadline approaching!)-->
                <!--    </div>-->
                <!--</div>-->

            <!--    <div class="action-section">-->
            <!--        <button class="btn btn-success btn-sm" onclick="retrySyncAll()">🔄 Retry All Syncs</button>-->
            <!--        <button class="btn btn-primary btn-sm" onclick="syncToBol()">🔄 Sync to Bol.com</button>-->
            <!--        <button class="btn btn-primary btn-sm" onclick="syncToBricklink()">🔄 Sync to Bricklink</button>-->
            <!--    </div>-->
            <!--</div>-->

            <!-- Sendcloud Carrier Selection -->
            <!--<div class="section">-->
            <!--    <div class="sendcloud-section">-->
            <!--        <div class="sendcloud-header">-->
            <!--            <div class="sendcloud-logo">SENDCLOUD</div>-->
            <!--            <h3 style="margin: 0; color: #333;">Select Shipping Carrier</h3>-->
            <!--        </div>-->
                    
            <!--        <div class="carrier-grid">-->
                        <!-- PostNL -->
            <!--            <div class="carrier-card" onclick="selectCarrier('postnl', this)">-->
            <!--                <span class="carrier-recommended">Recommended</span>-->
            <!--                <div class="carrier-header">-->
            <!--                    <div class="carrier-logo">📦</div>-->
            <!--                    <div class="carrier-info">-->
            <!--                        <div class="carrier-name">PostNL</div>-->
            <!--                        <div class="carrier-service">Standard Shipping</div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="carrier-details">-->
            <!--                    <div class="carrier-detail">-->
            <!--                        <div class="carrier-detail-label">Price</div>-->
            <!--                        <div class="carrier-detail-value carrier-price">€6.95</div>-->
            <!--                    </div>-->
            <!--                    <div class="carrier-detail">-->
            <!--                        <div class="carrier-detail-label">Delivery</div>-->
            <!--                        <div class="carrier-detail-value">2-3 days</div>-->
            <!--                    </div>-->
            <!--                    <div class="carrier-detail">-->
            <!--                        <div class="carrier-detail-label">Weight</div>-->
            <!--                        <div class="carrier-detail-value">Up to 10kg</div>-->
            <!--                    </div>-->
            <!--                    <div class="carrier-detail">-->
            <!--                        <div class="carrier-detail-label">Tracking</div>-->
            <!--                        <div class="carrier-detail-value">✓ Included</div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->

                        <!-- DHL -->
            <!--            <div class="carrier-card selected" onclick="selectCarrier('dhl', this)">-->
            <!--                <div class="carrier-header">-->
            <!--                    <div class="carrier-logo">🚚</div>-->
            <!--                    <div class="carrier-info">-->
            <!--                        <div class="carrier-name">DHL Express</div>-->
            <!--                        <div class="carrier-service">Express Delivery</div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="carrier-details">-->
            <!--                    <div class="carrier-detail">-->
            <!--                        <div class="carrier-detail-label">Price</div>-->
            <!--                        <div class="carrier-detail-value carrier-price">€12.50</div>-->
            <!--                    </div>-->
            <!--                    <div class="carrier-detail">-->
            <!--                        <div class="carrier-detail-label">Delivery</div>-->
            <!--                        <div class="carrier-detail-value">1-2 days</div>-->
            <!--                    </div>-->
            <!--                    <div class="carrier-detail">-->
            <!--                        <div class="carrier-detail-label">Weight</div>-->
            <!--                        <div class="carrier-detail-value">Up to 20kg</div>-->
            <!--                    </div>-->
            <!--                    <div class="carrier-detail">-->
            <!--                        <div class="carrier-detail-label">Tracking</div>-->
            <!--                        <div class="carrier-detail-value">✓ Live Updates</div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->

                        <!-- UPS -->
            <!--            <div class="carrier-card" onclick="selectCarrier('ups', this)">-->
            <!--                <div class="carrier-header">-->
            <!--                    <div class="carrier-logo">📮</div>-->
            <!--                    <div class="carrier-info">-->
            <!--                        <div class="carrier-name">UPS Standard</div>-->
            <!--                        <div class="carrier-service">Economy Shipping</div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="carrier-details">-->
            <!--                    <div class="carrier-detail">-->
            <!--                        <div class="carrier-detail-label">Price</div>-->
            <!--                        <div class="carrier-detail-value carrier-price">€9.95</div>-->
            <!--                    </div>-->
            <!--                    <div class="carrier-detail">-->
            <!--                        <div class="carrier-detail-label">Delivery</div>-->
            <!--                        <div class="carrier-detail-value">2-4 days</div>-->
            <!--                    </div>-->
            <!--                    <div class="carrier-detail">-->
            <!--                        <div class="carrier-detail-label">Weight</div>-->
            <!--                        <div class="carrier-detail-value">Up to 15kg</div>-->
            <!--                    </div>-->
            <!--                    <div class="carrier-detail">-->
            <!--                        <div class="carrier-detail-label">Tracking</div>-->
            <!--                        <div class="carrier-detail-value">✓ Included</div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->

                        <!-- DPD -->
            <!--            <div class="carrier-card" onclick="selectCarrier('dpd', this)">-->
            <!--                <div class="carrier-header">-->
            <!--                    <div class="carrier-logo">🚐</div>-->
            <!--                    <div class="carrier-info">-->
            <!--                        <div class="carrier-name">DPD</div>-->
            <!--                        <div class="carrier-service">Predict Delivery</div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="carrier-details">-->
            <!--                    <div class="carrier-detail">-->
            <!--                        <div class="carrier-detail-label">Price</div>-->
            <!--                        <div class="carrier-detail-value carrier-price">€8.50</div>-->
            <!--                    </div>-->
            <!--                    <div class="carrier-detail">-->
            <!--                        <div class="carrier-detail-label">Delivery</div>-->
            <!--                        <div class="carrier-detail-value">1-3 days</div>-->
            <!--                    </div>-->
            <!--                    <div class="carrier-detail">-->
            <!--                        <div class="carrier-detail-label">Weight</div>-->
            <!--                        <div class="carrier-detail-value">Up to 31.5kg</div>-->
            <!--                    </div>-->
            <!--                    <div class="carrier-detail">-->
            <!--                        <div class="carrier-detail-label">Tracking</div>-->
            <!--                        <div class="carrier-detail-value">✓ Time Window</div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
                    
            <!--        <button class="btn btn-success" onclick="generateSendcloudLabel()" style="margin-top: 15px;">-->
            <!--            🏷️ Generate Sendcloud Label for Selected Carrier-->
            <!--        </button>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="carrier-grid" id="carrierGrid">
                <!-- Dynamic carriers will be injected here -->
            </div>
            <button id="generateLabelBtn" class="btn btn-success" onclick="generateSendcloudLabel()" style="margin-left: 20px;">
                🏷️ Generate Sendcloud Label for Selected Carrier
            </button>
            

            <!-- Horizontal Timeline -->
            <div class="section">
                <h3 class="section-title">📍 Shipping Status & Timeline</h3>
                <div class="timeline-horizontal">
                    <div class="timeline-track">
                        <div class="timeline-step completed">
                            <div class="timeline-icon">✓</div>
                            <div class="timeline-content">
                                <div class="timeline-title">Order Placed</div>
                                <div class="timeline-date">20 Jul 2025, 14:32</div>
                                <!--<div class="timeline-detail">Order received from Bol.com</div>-->
                            </div>
                        </div>

                        <div class="timeline-step completed">
                            <div class="timeline-icon">✓</div>
                            <div class="timeline-content">
                                <div class="timeline-title">Payment Confirmed</div>
                                <div class="timeline-date">20 Jul 2025, 14:35</div>
                                <!--<div class="timeline-detail">Payment successful via iDEAL</div>-->
                            </div>
                        </div>

                        <div class="timeline-step completed">
                            <div class="timeline-icon">✓</div>
                            <div class="timeline-content">
                                <div class="timeline-title">Order Packed</div>
                                <div class="timeline-date">21 Jul 2025, 09:15</div>
                                <!--<div class="timeline-detail">Package ready for shipment</div>-->
                            </div>
                        </div>

                        <div class="timeline-step active">
                            <div class="timeline-icon">⏳</div>
                            <div class="timeline-content">
                                <div class="timeline-title">Awaiting Shipment</div>
                                <div class="timeline-date">Expected: 22 Jul 2025</div>
                                <!--<div class="timeline-detail">Label created, awaiting pickup</div>-->
                            </div>
                        </div>

                        <div class="timeline-step">
                            <div class="timeline-icon">📦</div>
                            <div class="timeline-content">
                                <div class="timeline-title">In Transit</div>
                                <div class="timeline-date">Expected: 23-24 Jul</div>
                                <!--<div class="timeline-detail">On the way to customer</div>-->
                            </div>
                        </div>

                        <div class="timeline-step">
                            <div class="timeline-icon">🏠</div>
                            <div class="timeline-content">
                                <div class="timeline-title">Delivered</div>
                                <div class="timeline-date">Expected: 25 Jul 2025</div>
                                <!--<div class="timeline-detail">Package delivered</div>-->
                            </div>
                        </div>

                        <div class="timeline-step">
                            <div class="timeline-icon">⭐</div>
                            <div class="timeline-content">
                                <div class="timeline-title">Completed</div>
                                <div class="timeline-date">Auto: 3 Aug 2025</div>
                                <!--<div class="timeline-detail">Feedback requested</div>-->
                            </div>
                        </div>
                    </div>
                </div>

                <!--<div class="tracking-info">-->
                <!--    <div class="tracking-number">-->
                <!--        <strong>Tracking Number:</strong> -->
                <!--        <a href="#" onclick="trackPackage('3SABCD1234567'); return false;">3SABCD1234567</a>-->
                <!--        (DHL Express)-->
                <!--    </div>-->
                <!--    <div style="font-size: 13px; color: #666;">-->
                <!--        📍 Current Status: Package packed and ready at warehouse-->
                <!--    </div>-->
                <!--</div>-->

                <div class="action-section" style="margin-top: 15px;">
                    <button class="btn btn-success" onclick="markAsShipped(<?= $order->id ?>, 'shipped')">✓ Mark as Shipped</button>
                    <!--<button class="btn btn-primary" onclick="sendTrackingEmail()">📧 Send Tracking Email</button>-->
                    <!--<button class="btn btn-warning" onclick="updateTracking()">🔄 Update Tracking</button>-->
                </div>
            </div>

            <!-- Customer Information -->
            <div class="section">
                <h3 class="section-title">👤 Customer Information</h3>
                <div class="customer-info">
                    <div class="info-card">
                        <h4>Shipping Address</h4>
                        <p>
                            <b>Name: </b><?= $order->shipping_name ?? "--" ?><br>
                            <b>Address: </b><?= $order->shipping_address_1 ?? "--" ?><br>
                            <b>Country Code: </b><?= $order->shipping_country ?? "--" ?><br>
                            <b>City: </b><?= $order->shipping_city ?? "--" ?><br>
                            <b>State: </b><?= $order->shipping_state ?? "--" ?><br>
                            <b>Postcode: </b><?= $order->shipping_postcode ?? "--" ?>
                        </p>
                    </div>
                    <div class="info-card">
                        <h4>Billing Address</h4>
                        <p>
                            <b>Name: </b><?= $order->billing_name ?? "--" ?><br>
                            <b>Address: </b><?= $order->billing_address_1 ?? "--" ?><br>
                            <b>Country Code: </b><?= $order->shipping_city ?? "--" ?><br>
                            <b>City: </b><?= $order->billing_city ?? "--" ?><br>
                            <b>State: </b>><?= $order->billing_state ?? "--" ?><br>
                            <b>Postcode: </b><?= $order->billing_postcode ?? "--" ?>
                        </p>
                    </div>
                    <div class="info-card">
                        <h4>Contact Details</h4>
                        <p>
                            <strong>Email:</strong> <?= $order->customer_email ?? "--" ?><br>
                            <strong>Phone:</strong> <?= $order->customer_phone ?? "--" ?><br>
                            <strong>Customer:</strong> <?= $order->customer_name ?? "--" ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="section">
                <h3 class="section-title">📦 Order Items</h3>
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Item & Item No</th>
                                <th>Color</th>
                                <th>Condition</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orderItems as $item){ ?>
                                <tr>
                                    <td>
                                        <span class="item-image">
                                            <a href="<?= $item->image_url ?>" target="_blank">
                                                <img style="width: 40px; cursor: pointer;" src="<?= $item->image_url ?>">
                                            </a>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="item-info"><?= $item->title ?></div>
                                        <div class="part-id">Part: <?= $item->item_no ?></div>
                                    </td>
                                    <td><span class="color-badge"><?= $item->color_name ?></span></td>
                                    <td><span class="condition-badge condition-new"><?= $item->condition_type ?></span></td>
                                    <td><?= $item->quantity ?></td>
                                    <td>€ <?= $item->unit_price ?></td>
                                    <td>€ <?= $item->total_price ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="summary-grid" style="margin-top: 20px;">
                    <div class="summary-label">Subtotal (<?= count($orderItems) ?> items)</div>
                    <div class="summary-value">€ <?= $order->subtotal ?></div>
                    
                    <!--<div class="summary-label">Shipping (DHL Express)</div>-->
                    <!--<div class="summary-value">€12.50</div>-->
                    
                    <!--<div class="summary-label">VAT (21%)</div>-->
                    <!--<div class="summary-value">€5.05</div>-->
                    
                    <!--<div class="summary-label">Bol.com Fee (15%)</div>-->
                    <!--<div class="summary-value">-€17.33</div>-->
                    
                    <!--<div class="summary-total">-->
                        <div class="summary-label">Total Amount</div>
                        <div class="summary-value">€ <?= $order->total_amount ?></div>
                    <!--</div>-->
                    
                    <!--<div style="padding-top: 10px; border-top: 1px solid #e0e0e0; margin-top: 10px;">-->
                    <!--    <div class="summary-label">Net Profit</div>-->
                    <!--    <div class="summary-value" style="color: #4CAF50;">€92.67</div>-->
                    <!--</div>-->
                </div>

                <!--<div class="payment-status">-->
                <!--    ✓ Payment confirmed on 20 Jul at 14:35. Refund eligible until 27 Jul.-->
                <!--</div>-->
            </div>

            <!-- Special Notes -->
            <div class="section">
                <h3 class="section-title">📝 Order Notes & Instructions</h3>
                <div class="notes-section">
                    <h4>⚠️ Customer Note:</h4>
                    <p>"Please pack carefully! These pieces are for a birthday gift. If possible, include a small LEGO sticker or card. Thank you!"</p>
                </div>

                <div style="margin-top: 15px; padding: 15px; background: #f8f9fa; border-radius: 6px;">
                    <h4 style="font-size: 14px; color: #666; margin-bottom: 8px;">📋 Internal Notes:</h4>
                    <p style="font-size: 13px; color: #333; line-height: 1.6;">
                        • Priority order - customer is a repeat buyer<br>
                        • Use bubble wrap for minifigure heads<br>
                        • Check all pieces for quality before packing<br>
                        • Include CrocoBricks business card
                    </p>
                </div>
            </div>

            <!-- Actions -->
            <!--<div class="section">-->
            <!--    <h3 class="section-title">⚙️ Order Actions</h3>-->
            <!--    <div class="action-section">-->
            <!--        <button class="btn btn-success" onclick="markAsShipped(<?= $order->id ?>, 'shipped')">✓ Mark as Shipped</button>-->
            <!--        <button class="btn btn-primary" onclick="sendTrackingEmail()">📧 Send Tracking Email</button>-->
            <!--        <button class="btn btn-primary" onclick="syncToBol()">🔄 Sync to Bol.com</button>-->
            <!--        <button class="btn btn-primary" onclick="syncToBricklink()">🔄 Sync to Bricklink</button>-->
            <!--        <button class="btn btn-danger" onclick="cancelOrder()">✗ Cancel Order</button>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // let selectedCarrier = 'dhl';
        let selectedCarrierData = {
            name: 'DHL Express',
            price: '€12.50',
            delivery: '1-2 days'
        };

        // Carrier Selection
        function sselectCarrier(carrier, element) {
            selectedCarrier = carrier;
            
            // Update selected state
            document.querySelectorAll('.carrier-card').forEach(card => {
                card.classList.remove('selected');
            });
            element.classList.add('selected');
            
            // Get carrier data
            const carrierNames = {
                'postnl': 'PostNL Standard',
                'dhl': 'DHL Express',
                'ups': 'UPS Standard',
                'dpd': 'DPD Predict'
            };
            
            selectedCarrierData.name = carrierNames[carrier];
            
            console.log(`Selected carrier: ${carrier}`);
        }

        function sgenerateSendcloudLabel() {
            console.log(`N8N Webhook: POST /webhook/sendcloud/generate-label`);
            console.log(`Carrier: ${selectedCarrier}`);
            console.log(`Order: A0007PLLF`);
            alert(`Generating ${selectedCarrierData.name} label via Sendcloud API for order A0007PLLF...\n\nN8N will:\n1. Create shipment in Sendcloud\n2. Generate label PDF\n3. Return tracking number\n4. Update order status`);
        }

        // Sync Functions
        function retrySyncAll() {
            console.log('N8N Webhook: POST /webhook/retry-all-syncs/A0007PLLF');
            alert('Retrying all marketplace syncs via N8N...');
        }

        function syncToBol() {
            console.log('N8N Webhook: POST /webhook/sync-to-bol/A0007PLLF');
            alert('Syncing order status to Bol.com via N8N...');
        }

        function syncToBricklink() {
            console.log('N8N Webhook: POST /webhook/sync-to-bricklink/A0007PLLF');
            alert('Syncing order status to Bricklink via N8N...');
        }

        // Shipping Functions
function markAsShipped(orderId, section) {
    // Ensure orderId is always an array
    let orderIds = Array.isArray(orderId) ? orderId : [orderId];

    $.ajax({
        url: "/orders/change-status/" + section,
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            orders: orderIds // send as array
        },
        success: function(res) {
            console.log("Status updated successfully");
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert("Error updating orders");
        }
    });
}


        function updateTracking() {
            const tracking = prompt('Enter tracking number:');
            if (!tracking) return;
            console.log(`N8N Webhook: POST /webhook/update-tracking/A0007PLLF with ${tracking}`);
            alert(`Tracking number ${tracking} updated via N8N...`);
        }

        function sendTrackingEmail() {
            if (!confirm('Send tracking email to customer?')) return;
            console.log('N8N Webhook: POST /webhook/send-tracking-email/A0007PLLF');
            alert('Tracking email sent via N8N...');
        }

        // Order Management
        function editOrder() {
            alert('Redirect to order edit page...');
        }

        function cancelOrder() {
            if (!confirm('Are you sure you want to cancel this order? This will restore inventory and notify all platforms.')) return;
            console.log('N8N Webhook: POST /webhook/cancel-order/A0007PLLF');
            alert('Order cancelled, inventory restored, and platforms notified via N8N...');
        }

        // Tracking
        function trackPackage(trackingNumber) {
            console.log(`Track package: ${trackingNumber}`);
            window.open(`https://www.dhl.com/nl-en/home/tracking/tracking-express.html?submit=1&tracking-id=${trackingNumber}`, '_blank');
        }

        // Export Functions
        function printPackingSlip() {
            console.log('Printing packing slip...');
            window.print();
        }

        function downloadInvoice() {
            console.log('N8N Webhook: POST /webhook/generate-invoice/A0007PLLF');
            alert('Generating invoice PDF via N8N...');
        }

        // Navigation
        function goBack() {
            window.history.back();
        }

</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const url = "{{ route('get-shipping-options') }}" +
        "?order_id={{ $order->id }}" +
        "&order_number={{ urlencode($order->order_number) }}" +
        "&weight={{ urlencode($order->package_weight_grams) }}" +
        "&postcode={{ urlencode($order->shipping_postcode) }}" +
        "&country={{ urlencode($order->shipping_country) }}";

    fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && Array.isArray(data.data)) {
            renderCarriers(data.data);   // ✅ FIXED
        } else {
            alert('No shipping options available');
        }
    })
    .catch(console.error);
});

let selectedCarrier = null;

function renderCarriers(carriers) {
    const grid = document.getElementById('carrierGrid');
    grid.innerHTML = '';

    carriers.forEach((carrier, index) => {
        const card = document.createElement('div');
        card.className = 'carrier-card' + (index === 0 ? ' selected' : '');
        card.onclick = () => selectCarrier(carrier, card);

        card.innerHTML = `
            <div class="carrier-header">
                <div class="carrier-logo">🚚</div>
                <div class="carrier-info">
                    <div class="carrier-name">${carrier.carrier.replace('_',' ').toUpperCase()}</div>
                    <div class="carrier-service">${carrier.method_name}</div>
                </div>
            </div>

            <div class="carrier-details">
                <div class="carrier-detail">
                    <div class="carrier-detail-label">Price</div>
                    <div class="carrier-detail-value carrier-price">€${carrier.price}</div>
                </div>

                <div class="carrier-detail">
                    <div class="carrier-detail-label">Delivery</div>
                    <div class="carrier-detail-value">${carrier.delivery_days} days</div>
                </div>

                <div class="carrier-detail">
                    <div class="carrier-detail-label">Weight</div>
                    <div class="carrier-detail-value">
                        ${carrier.min_weight} – ${carrier.max_weight} kg
                    </div>
                </div>

                <div class="carrier-detail">
                    <div class="carrier-detail-label">Tracking</div>
                    <div class="carrier-detail-value">
                        ${carrier.tracking === 'included' ? '✓ Included' : '—'}
                    </div>
                </div>
            </div>
        `;

        grid.appendChild(card);

        if (index === 0) selectedCarrier = carrier;
    });
}

function selectCarrier(carrier, el) {
    document.querySelectorAll('.carrier-card').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    selectedCarrier = carrier;
}

function generateSendcloudLabel() {
    
    // Disable button and show loading text
    const btn = document.getElementById('generateLabelBtn');
    btn.disabled = true;
    const originalText = btn.innerHTML;
    btn.innerHTML = '⏳ Generating Label...';
    
    if (!selectedCarrier) {
        alert('Please select a shipping carrier');
        return;
    }

    const payload = {
        order_id: "{{ $order->id }}",
        marketplace_order_id: "{{ $order->marketplace_order_id }}",
        marketplace_type: "{{ $order->marketplace_type }}",

        customer_name: "{{ addslashes($order->shipping_name) }}",
        customer_email: "{{ $order->customer_email }}",

        address_line_1: "{{ addslashes($order->shipping_address_1) }}",
        address_line_2: "{{ addslashes($order->shipping_address_2) }}",
        city: "{{ addslashes($order->shipping_city) }}",
        postal_code: "{{ $order->shipping_postcode }}",
        country_code: "{{ $order->shipping_country }}",

        weight: "{{ $order->package_weight_grams }}",

        shipping_method_id: selectedCarrier.method_id,
        carrier: selectedCarrier.carrier
    };
    
    const query = new URLSearchParams(payload).toString();

    fetch("{{ route('create-shipping-label') }}?" + query, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    }).then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.pdf_url;
                // alert('✅ Shipping label created successfully');
                console.log('Label response:', data.data);
            } else {
                alert('❌ Failed to create shipping label');
                console.error(data);
            }
        })
        .catch(err => {
            console.error('Label error:', err);
            alert('Something went wrong while creating label');
        }).finally(() => {
        // Re-enable button and restore original text
        btn.disabled = false;
        btn.innerHTML = originalText;
    });
    }

</script>



</body>
</html>