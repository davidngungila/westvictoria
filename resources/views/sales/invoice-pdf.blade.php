<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $sale->sale_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #fff;
        }
        .invoice {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .company-info {
            margin-bottom: 20px;
        }
        .billing-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .billing-info div {
            flex: 1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .totals {
            text-align: right;
            margin-top: 20px;
        }
        .totals div {
            margin-bottom: 5px;
        }
        .total {
            font-weight: bold;
            font-size: 18px;
            border-top: 2px solid #333;
            padding-top: 10px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
        @media print {
            body { padding: 0; }
            .invoice { border: none; box-shadow: none; }
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="header">
            <h1>{{ $companyName }}</h1>
            <h2>INVOICE</h2>
            <p>Invoice #: {{ $sale->sale_number }}</p>
            <p>Date: {{ $sale->created_at->format('M d, Y') }}</p>
        </div>

        <div class="billing-info">
            <div>
                <h3>Bill To:</h3>
                <p><strong>{{ $sale->customer_name }}</strong></p>
                @if($sale->customer_email)
                    <p>{{ $sale->customer_email }}</p>
                @endif
                @if($sale->customer_phone)
                    <p>{{ $sale->customer_phone }}</p>
                @endif
            </div>
            <div style="text-align: right;">
                <p><strong>Payment Method:</strong> {{ ucfirst($sale->payment_method) }}</p>
                <p><strong>Payment Status:</strong> {{ ucfirst($sale->payment_status) }}</p>
                <p><strong>Sale Type:</strong> {{ ucfirst($sale->sale_type) }}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Discount</th>
                    <th>Tax</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->saleItems as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->product_sku }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $currencyCode }} {{ number_format($item->unit_price, 2) }}</td>
                        <td>{{ $item->discount_percentage }}% ({{ $currencyCode }} {{ number_format($item->discount_amount, 2) }})</td>
                        <td>{{ $item->tax_percentage }}% ({{ $currencyCode }} {{ number_format($item->tax_amount, 2) }})</td>
                        <td>{{ $currencyCode }} {{ number_format($item->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <div>Subtotal: {{ $currencyCode }} {{ number_format($sale->total_amount, 2) }}</div>
            <div>Discount: {{ $currencyCode }} {{ number_format($sale->discount_amount, 2) }}</div>
            <div>Tax: {{ $currencyCode }} {{ number_format($sale->tax_amount, 2) }}</div>
            <div class="total">Total: {{ $currencyCode }} {{ number_format($sale->final_amount, 2) }}</div>
        </div>

        @if($sale->notes)
            <div style="margin-top: 30px;">
                <h3>Notes:</h3>
                <p>{{ $sale->notes }}</p>
            </div>
        @endif

        <div class="footer">
            <p>Thank you for your business!</p>
            <p>This is a computer-generated invoice and does not require a signature.</p>
        </div>
    </div>
</body>
</html>
