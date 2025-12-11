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
    </style>
</head>

<body>
<div class="container">
    <h2>The checkout app is running 🎉</h2>

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
