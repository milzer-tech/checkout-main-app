<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            padding: 40px;
            text-align: center;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        h2 {
            margin-top: 0;
            font-size: 24px;
        }

        .status-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin: 22px 0;
        }

        .status-box {
            padding: 14px 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fafafa;
        }

        .status-box strong,
        .status-box span {
            display: block;
        }

        .status-box span {
            margin-top: 7px;
            font-size: 14px;
        }

        .status-ok {
            color: #2e7d32;
        }

        .status-error {
            color: #c62828;
        }

        .status-warning {
            color: #b26a00;
        }

        .code-box {
            background: #eee;
            padding: 12px;
            border-radius: 6px;
            overflow-x: auto;
            text-align: left;
            font-size: 14px;
        }

        .copy-btn {
            margin-top: 10px;
            padding: 8px 18px;
            font-size: 14px;
            cursor: pointer;
            border: none;
            background: #4caf50;
            color: white;
            border-radius: 6px;
        }

        .copy-btn:active {
            background: #439a48;
        }

        p, li {
            font-size: 15px;
            line-height: 1.5;
            text-align: left;
        }

        ol {
            margin-top: 15px;
            padding-left: 20px;
            text-align: left;
        }

        @media (max-width: 600px) {
            body {
                padding: 20px;
            }

            .status-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
<div class="container">
    <h2>The checkout app is running 🎉</h2>

    <div class="status-grid">
        <div class="status-box">
            <strong>Database</strong>
            <span class="{{ $databaseConnected ? 'status-ok' : 'status-error' }}">
                {{ $databaseConnected ? '✓ Connected' : '✕ Disconnected' }}
            </span>
        </div>

        <div class="status-box">
            <strong>Cache</strong>
            <span class="{{ $cacheConnected ? 'status-ok' : 'status-error' }}">
                {{ $cacheConnected ? '✓ Connected' : '✕ Disconnected' }}
            </span>
            <span>Driver: {{ $cacheDriver }}</span>
        </div>

        <div class="status-box">
            <strong>Horizon</strong>
            <span class="{{ $horizonStatus === 'running' ? 'status-ok' : ($horizonStatus === 'paused' ? 'status-warning' : 'status-error') }}">
                {{ $horizonStatus === 'running' ? '✓ Active' : ucfirst($horizonStatus) }}
            </span>
        </div>
    </div>

    <p>Please configure the following <strong>Custom Checkout URL</strong> in your Nezasa instance:</p>

    <div class="code-box">
        <pre id="checkoutUrl">{{ url('/') }}/checkout/details?checkoutId=${CHECKOUT_ID}&itineraryId=${ITINERARY_ID}&origin=${ORIGIN}&lang=${ITINERARY_LANG}</pre>
    </div>

    <button class="copy-btn" onclick="copyCheckoutUrl()">Copy URL</button>

    <h3 style="margin-top: 25px; font-size: 18px;">How to configure it:</h3>

    <ol>
        <li>Login to your Nezasa instance</li>
        <li>Open the <strong>Nezasa Cockpit</strong></li>
        <li>Go to <strong>Settings</strong></li>
        <li>Select your <strong>Distribution Channel</strong></li>
        <li>Open the <strong>Checkout</strong> section</li>
        <li>Scroll down to find <strong>Custom Checkout</strong></li>
        <li>Paste the copied URL into the <strong>Custom Checkout URL</strong> field</li>
    </ol>
</div>

<script>
    function copyCheckoutUrl() {
        const text = document.getElementById('checkoutUrl').innerText;
        navigator.clipboard.writeText(text);

        const btn = document.querySelector('.copy-btn');
        btn.innerText = 'Copied!';
        setTimeout(() => btn.innerText = 'Copy URL', 1500);
    }
</script>

</body>
</html>
