<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt {{ $sale->sale_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #fff;
        }
        .receipt {
            max-width: 400px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 5px 0;
            font-size: 14px;
        }
        .items {
            margin-bottom: 20px;
        }
        .item {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #ddd;
        }
        .item-header {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .item-details {
            font-size: 12px;
            color: #666;
        }
        .totals {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid #333;
        }
        .totals p {
            margin: 5px 0;
            font-size: 14px;
        }
        .total {
            font-weight: bold;
            font-size: 16px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
        .status {
            text-align: center;
            margin: 15px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .status.paid {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        @media print {
            body { padding: 0; }
            .receipt { border: none; box-shadow: none; }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h1>{{ $companyName }}</h1>
            <p>RECEIPT</p>
            <p>#{{ $sale->sale_number }}</p>
            <p>{{ $sale->created_at->format('M d, Y H:i') }}</p>
        </div>

        <div class="info">
            <p><strong>Customer:</strong> {{ $sale->customer_name }}</p>
            @if($sale->customer_phone)
                <p><strong>Phone:</strong> {{ $sale->customer_phone }}</p>
            @endif
            <p><strong>Payment:</strong> {{ ucfirst($sale->payment_method) }}</p>
        </div>

        <div class="status paid">
            <strong>PAID</strong>
        </div>

        <div class="items">
            @foreach($sale->saleItems as $item)
                <div class="item">
                    <div class="item-header">{{ $item->product_name }}</div>
                    <div class="item-details">
                        {{ $item->quantity }} x {{ $currencyCode }} {{ number_format($item->unit_price, 2) }} = {{ $currencyCode }} {{ number_format($item->total_price, 2) }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="totals">
            <p>Subtotal: {{ $currencyCode }} {{ number_format($sale->total_amount, 2) }}</p>
            <p>Tax: {{ $currencyCode }} {{ number_format($sale->tax_amount, 2) }}</p>
            <p class="total">Total: {{ $currencyCode }} {{ number_format($sale->final_amount, 2) }}</p>
        </div>

        @if($sale->notes)
            <div style="margin-top: 20px; font-size: 12px; color: #666;">
                <p><strong>Notes:</strong> {{ $sale->notes }}</p>
            </div>
        @endif

        <div class="footer">
            <p>Thank you for your business!</p>
            <p>This receipt serves as proof of payment.</p>
        </div>
    </div>
</body>
</html>
