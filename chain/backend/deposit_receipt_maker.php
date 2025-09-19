
<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
include 'connection.php'; 
header('Content-Type: application/json');

require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Dompdf\Dompdf;
use Dompdf\Options;

function sendResponse($status, $message, $redirect = null, $data = null) {
    $response = ['status' => $status, 'message' => $message];
    if ($redirect) {
        $response['redirect'] = $redirect;
    }
    if ($data !== null) {
        $response['data'] = $data;
    }
    echo json_encode($response);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['htmlContent']) || empty(trim($_POST['htmlContent']))) {
        sendResponse('error', 'No HTML content provided.');
    }

    $html = $_POST['htmlContent'];

    try {
        $options = new Options();
        $options->set('isRemoteEnabled', true);  

        $dompdf = new Dompdf($options);

        $fullHtml = '
            <html>
            <head>
                <style>
                    :root {
                        --base-clr: #11121a;
                        --black-clr: #07070a;
                        --line-clr: #42434a;
                        --hover-clr: #222533;
                        --text-clr: #e6e6ef;
                        --accent-clr: #5e63ff;
                        --secondary-text-clr: #b0b3c1;
                        --negative-text-clr: #ff004a;
                        --positive-text-clr: #10B981;
                        --pending-text-clr: rgb(255, 255, 0);
                        --info-clr: rgb(0, 145, 255);

                        --negative-bg-clr: rgba(231, 76, 60, 0.15);
                        --positive-bg-clr: rgba(46, 204, 113, 0.15); 
                        --pending-bg-clr: rgba(255, 255, 0, 0.15); 

                        --input-focus-clr: rgba(94, 99, 255, 0.1);
                    } 
                    @page {
                        size: A4;
                        margin: 0;
                    }
                
                    body {
                        margin: 0;
                        padding: 0;
                        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                        background: var(--base-clr);
                        color: var(--text-clr);
                    }
                    
                    .receipt-container {
                        max-width: 210mm;
                        min-height: 297mm;
                        margin: 0 auto;
                        background: var(--base-clr);
                        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
                        border-radius: 12px;
                        overflow: hidden;
                        position: relative;
                        border: 1px solid var(--line-clr);
                        width: 100%;
                        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;

                    }

                    .receipt-header {
                        background: linear-gradient(135deg, var(--black-clr) 0%, var(--hover-clr) 100%);
                        color: var(--text-clr);
                        padding: 40px;
                        text-align: center;
                        position: relative;
                        overflow: hidden;
                        border-bottom: 2px solid var(--accent-clr);
                    }

                    .receipt-header::before {
                        content: "";
                        position: absolute;
                        top: -50%;
                        left: -50%;
                        width: 200%;
                        height: 200%;
                        background: repeating-linear-gradient(
                            45deg,
                            transparent,
                            transparent 10px,
                            rgba(94, 99, 255, 0.05) 10px,
                            rgba(94, 99, 255, 0.05) 20px
                        );
                        animation: shimmer 3s linear infinite;
                    }

                    @keyframes shimmer {
                        0% { transform: translateX(-100%); }
                        100% { transform: translateX(100%); }
                    }

                    .company-logo {
                        width: 80px;
                        height: 80px;
                        /* background: linear-gradient(135deg, var(--accent-clr), var(--info-clr)); */
                        border-radius: 50%;
                        margin: 0 auto 20px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 32px;
                        font-weight: bold;
                        position: relative;
                        z-index: 1;
                        color: var(--text-clr);
                    }

                    .company-name {
                        font-size: 38px;
                        font-weight: 700;
                        margin-bottom: 8px;
                        position: relative;
                        z-index: 1;
                        color: var(--text-clr);
                    }

                    .company-tagline {
                        font-size: 14px;
                        opacity: 0.9;
                        position: relative;
                        z-index: 1;
                        color: var(--secondary-text-clr);
                    }

                    .receipt-title {
                        /* background: linear-gradient(135deg, var(--accent-clr), var(--info-clr)); */
                        color: var(--text-clr);
                        padding: 25px 40px;
                        text-align: center;
                        font-size: 24px;
                        font-weight: 600;
                        letter-spacing: 1px;
                        text-transform: uppercase;
                    }

                    .receipt-body {
                        padding: 40px;
                        background: var(--base-clr);
                    }

                    .transaction-summary {
                        background: var(--hover-clr);
                        border-radius: 12px;
                        padding: 30px;
                        margin-bottom: 30px;
                        border-left: 6px solid var(--line-clr);
                        position: relative;
                        border: 1px solid var(--line-clr);
                    }

                    .transaction-summary::before {
                        content: "✓";
                        position: absolute;
                        top: -10px;
                        right: 20px;
                        background: var(--positive-text-clr);
                        color: var(--text-clr);
                        width: 40px;
                        height: 40px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-weight: bold;
                        font-size: 18px;
                    }

                    .amount-display {
                        text-align: center;
                        margin-bottom: 20px;
                    }

                    .amount-value {
                        font-size: 48px;
                        font-weight: 700;
                        color: var(--positive-text-clr);
                        margin-bottom: 5px;
                    }

                    .crypto-symbol {
                        font-size: 18px;
                        color: var(--secondary-text-clr);
                        font-weight: 500;
                    }

                    .status-badge {
                        display: inline-block;
                        padding: 8px 20px;
                        border-radius: 25px;
                        font-weight: 600;
                        font-size: 14px;
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                    }

                    .status-badge.approved {
                        background: var(--positive-bg-clr);
                        color: var(--positive-text-clr);
                        border: 1px solid var(--positive-text-clr);
                    }

                    .status-badge.pending {
                        background: var(--pending-bg-clr);
                        color: var(--pending-text-clr);
                        border: 1px solid var(--pending-text-clr);
                    }

                    .status-badge.declined {
                        background: var(--negative-bg-clr);
                        color: var(--negative-text-clr);
                        border: 1px solid var(--negative-text-clr);
                    }

                    .transaction-details {
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 30px;
                        margin-bottom: 30px;
                    }

                    .detail-group {
                        background: var(--hover-clr);
                        border-radius: 8px;
                        padding: 20px;
                        border: 1px solid var(--line-clr);
                    }

                    .detail-label {
                        font-size: 12px;
                        color: var(--secondary-text-clr);
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                        margin-bottom: 8px;
                        font-weight: 600;
                    }

                    .detail-value {
                        font-size: 16px;
                        color: var(--text-clr);
                        font-weight: 500;
                        word-break: break-all;
                    }

                    .miner-preference {
                        display: inline-block;
                        padding: 4px 12px;
                        border-radius: 15px;
                        font-size: 12px;
                        font-weight: 600;
                        text-transform: uppercase;
                    }

                    .miner-low {
                        background: var(--positive-bg-clr);
                        color: var(--positive-text-clr);
                        border: 1px solid var(--positive-text-clr);
                    }

                    .miner-medium {
                        background: var(--pending-bg-clr);
                        color: var(--pending-text-clr);
                        border: 1px solid var(--pending-text-clr);
                    }

                    .miner-high {
                        background: var(--negative-bg-clr);
                        color: var(--negative-text-clr);
                        border: 1px solid var(--negative-text-clr);
                    }

                    .transaction-type {
                        display: inline-block;
                        padding: 6px 15px;
                        border-radius: 20px;
                        font-size: 14px;
                        font-weight: 600;
                    }

                    .type-credit {
                        background: var(--positive-bg-clr);
                        color: var(--positive-text-clr);
                        border: 1px solid var(--positive-text-clr);
                    }

                    .type-debit {
                        background: var(--negative-bg-clr);
                        color: var(--negative-text-clr);
                        border: 1px solid var(--negative-text-clr);
                    }

                    .receipt-footer {
                        background: var(--hover-clr);
                        padding: 30px 40px;
                        border-top: 2px solid var(--line-clr);
                        text-align: center;
                    }

                    .footer-note {
                        font-size: 14px;
                        color: var(--secondary-text-clr);
                        margin-bottom: 15px;
                        line-height: 1.6;
                    }

                    .qr-placeholder {
                        width: 100px;
                        height: 100px;
                        background: linear-gradient(135deg, var(--black-clr), var(--hover-clr));
                        margin: 0 auto;
                        border-radius: 8px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: var(--text-clr);
                        font-size: 12px;
                        text-align: center;
                        border: 1px solid var(--line-clr);
                    }

                    .watermark {
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%) rotate(-45deg);
                        font-size: 120px;
                        color: rgba(255, 255, 255, 0.03);
                        font-weight: 900;
                        z-index: 0;
                        pointer-events: none;
                    }

                    .info-section {
                        background: var(--hover-clr);
                        border-radius: 8px;
                        padding: 20px;
                        margin-top: 30px;
                        border: 1px solid var(--line-clr);
                    }

                    .info-section h3 {
                        color: var(--text-clr);
                        margin-bottom: 15px;
                        font-size: 18px;
                    }

                    .info-section ul {
                        color: var(--secondary-text-clr);
                        font-size: 14px;
                        line-height: 1.6;
                        padding-left: 20px;
                    }

                    .info-section li {
                        margin-bottom: 5px;
                    }

                    @media (max-width: 768px) {
                        .receipt-container {
                            min-height: auto;
                            margin: 0;
                            border-radius: 8px;
                        }

                        .receipt-header {
                            padding: 30px 20px;
                        }

                        .company-logo {
                            width: 60px;
                            height: 60px;
                            font-size: 24px;
                        }

                        .company-name {
                            font-size: 24px;
                        }

                        .receipt-title {
                            padding: 20px;
                            font-size: 20px;
                        }

                        .receipt-body {
                            padding: 30px 20px;
                        }

                        .transaction-summary {
                            padding: 25px 20px;
                        }

                        .amount-value {
                            font-size: 36px;
                        }

                        .transaction-details {
                            gap: 20px;
                        }

                        .detail-group {
                            padding: 15px;
                        }

                        .receipt-footer {
                            padding: 25px 20px;
                        }

                        .watermark {
                            font-size: 80px;
                        }
                    }

                    /* Mobile styles */
                    @media (max-width: 480px) {
                    

                        .receipt-container {
                            border-radius: 6px;
                        }

                        .receipt-header {
                            padding: 25px 15px;
                        }

                        .company-logo {
                            width: 50px;
                            height: 50px;
                            font-size: 20px;
                            margin-bottom: 15px;
                        }

                        .company-name {
                            font-size: 20px;
                            margin-bottom: 6px;
                        }

                        .company-tagline {
                            font-size: 12px;
                        }

                        .receipt-title {
                            padding: 15px;
                            font-size: 18px;
                            letter-spacing: 0.5px;
                        }

                        .receipt-body {
                            padding: 20px 15px;
                        }

                        .transaction-summary {
                            padding: 20px 15px;
                            margin-bottom: 25px;
                        }

                        .transaction-summary::before {
                            width: 30px;
                            height: 30px;
                            font-size: 14px;
                            top: -8px;
                            right: 15px;
                        }

                        .amount-display {
                            margin-bottom: 15px;
                        }

                        .amount-value {
                            font-size: 28px;
                        }

                        .crypto-symbol {
                            font-size: 16px;
                        }

                        .status-badge {
                            padding: 6px 15px;
                            font-size: 12px;
                        }

                        .transaction-details {
                            grid-template-columns: 1fr;
                            gap: 15px;
                            margin-bottom: 25px;
                        }

                        .detail-group {
                            padding: 15px 12px;
                        }

                        .detail-label {
                            font-size: 11px;
                            margin-bottom: 6px;
                        }

                        .detail-value {
                            font-size: 14px;
                            line-height: 1.4;
                        }

                        .miner-preference {
                            padding: 3px 10px;
                            font-size: 11px;
                        }

                        .transaction-type {
                            padding: 5px 12px;
                            font-size: 12px;
                        }

                        .info-section {
                            padding: 15px;
                            margin-top: 25px;
                        }

                        .info-section h3 {
                            font-size: 16px;
                            margin-bottom: 12px;
                        }

                        .info-section ul {
                            font-size: 13px;
                            line-height: 1.5;
                            padding-left: 18px;
                        }

                        .receipt-footer {
                            padding: 20px 15px;
                        }

                        .footer-note {
                            font-size: 12px;
                            margin-bottom: 12px;
                        }

                        .qr-placeholder {
                            width: 80px;
                            height: 80px;
                            font-size: 10px;
                        }

                        .watermark {
                            font-size: 60px;
                        }
                    }

                    /* Extra small mobile styles (320px and below) */
                    @media (max-width: 320px) {
                        

                        .receipt-container {
                            border-radius: 4px;
                        }

                        .receipt-header {
                            padding: 20px 12px;
                        }

                        .company-logo {
                            width: 45px;
                            height: 45px;
                            font-size: 18px;
                            margin-bottom: 12px;
                        }

                        .company-name {
                            font-size: 18px;
                            margin-bottom: 5px;
                        }

                        .company-tagline {
                            font-size: 11px;
                        }

                        .receipt-title {
                            padding: 12px;
                            font-size: 16px;
                            letter-spacing: 0.3px;
                        }

                        .receipt-body {
                            padding: 15px 12px;
                        }

                        .transaction-summary {
                            padding: 15px 12px;
                            margin-bottom: 20px;
                        }

                        .transaction-summary::before {
                            width: 25px;
                            height: 25px;
                            font-size: 12px;
                            top: -6px;
                            right: 12px;
                        }

                        .amount-display {
                            margin-bottom: 12px;
                        }

                        .amount-value {
                            font-size: 24px;
                        }

                        .crypto-symbol {
                            font-size: 14px;
                        }

                        .status-badge {
                            padding: 5px 12px;
                            font-size: 11px;
                        }

                        .transaction-details {
                            gap: 12px;
                            margin-bottom: 20px;
                        }

                        .detail-group {
                            padding: 12px 10px;
                        }

                        .detail-label {
                            font-size: 10px;
                            margin-bottom: 5px;
                        }

                        .detail-value {
                            font-size: 13px;
                            line-height: 1.3;
                        }

                        .miner-preference {
                            padding: 2px 8px;
                            font-size: 10px;
                        }

                        .transaction-type {
                            padding: 4px 10px;
                            font-size: 11px;
                        }

                        .info-section {
                            padding: 12px;
                            margin-top: 20px;
                        }

                        .info-section h3 {
                            font-size: 15px;
                            margin-bottom: 10px;
                        }

                        .info-section ul {
                            font-size: 12px;
                            line-height: 1.4;
                            padding-left: 16px;
                        }

                        .info-section li {
                            margin-bottom: 4px;
                        }

                        .receipt-footer {
                            padding: 15px 12px;
                        }

                        .footer-note {
                            font-size: 11px;
                            margin-bottom: 10px;
                            line-height: 1.4;
                        }

                        .qr-placeholder {
                            width: 70px;
                            height: 70px;
                            font-size: 9px;
                        }

                        .watermark {
                            font-size: 50px;
                        }
                    }

                    @media print {
                        body {
                            background: var(--base-clr);
                            padding: 0;
                        }
                        
                        .receipt-container {
                            box-shadow: none;
                            border-radius: 0;
                            max-width: none;
                            min-height: auto;
                        }
                    }

                    
            
                </style>
            </head>
            <body>' . $html . '</body>
            </html>
        ';

        $dompdf->loadHtml($fullHtml);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $output = $dompdf->output();
        $dompdf->stream("receipt.pdf", ["Attachment" => true]);
        exit();

        sendResponse('success', 'PDF generated successfully.', null, [
            'pdf' => $dompdf->output(),
            'filename' => 'receipt.pdf'
        ]);

    } catch (Exception $e) {
        error_log("PDF generation error: " . $e->getMessage());
        sendResponse('error', 'Failed to generate PDF.');
    }
} else {
    sendResponse('error', 'Invalid request method.');
}
