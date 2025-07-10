<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        /* General Reset and Body Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        /* Container */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Card */
        .card {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .card-body {
            padding: 40px;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 24px;
            margin-bottom: 24px;
        }

        .header-left h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .header-right {
            text-align: right;
        }

        .header-right h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .text-muted {
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Customer Info */
        .customer-info h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        /* Table */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        .table th,
        .table td {
            border: 1px solid #dee2e6;
            padding: 12px;
        }

        .table th {
            background-color: #f8f9fa;
            text-align: left;
            font-weight: 600;
        }

        .table td.text-end,
        .table th.text-end {
            text-align: right;
        }

        .table img {
            max-height: 50px;
            width: auto;
        }

        .table .fw-bold {
            font-weight: bold;
        }

        /* Footer */
        .footer {
            border-top: 1px solid #dee2e6;
            padding-top: 24px;
            font-size: 0.85rem;
            color: #6c757d;
        }

        /* Print Styles */
        @media print {
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            body {
                background-color: #fff;
            }
            .container {
                margin: 0;
                padding: 0;
                max-width: 100%;
            }
            .card {
                box-shadow: none;
                border: none;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
            }
            .header-right {
                text-align: center;
                margin-top: 20px;
            }
            .table th,
            .table td {
                font-size: 0.85rem;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <!-- Header -->
                <div class="header">
                    <div class="header-left">
                        <h1>Invoice</h1>
                        <p class="text-muted">Invoice #INV-001</p>
                        <p class="text-muted">Date: July 10, 2025</p>
                    </div>
                    <div class="header-right">
                        <h2>Socheat Online Shop</h2>
                        <p class="text-muted">Phum Tangun, Sangkat kakab, Khan Posenchey, Phnom Penh</p>
                        <p class="text-muted">Phnom Penh</p>
                        <p class="text-muted">Phone: (855) 92452831</p>
                        <p class="text-muted">Email: socheatkhom869@gmail.com</p>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="customer-info">
                    <h3>Bill To:</h3>
                    <p class="text-muted">Customer Name: {{ $order->name }}</p>
                    <p class="text-muted">Customer Address: {{ $order->rec_address }}</p>
                    <p class="text-muted">Phone: {{ $order->phone }}</p>
                </div>

                <!-- Product Table -->
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Title</th>
                                <th class="text-end">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ Storage::url($order->product->image) }}"
                                         alt="Product Image"
                                         style="width:50px; height:50px;">
                                </td>

                                <td>{{ $order->product->title }}</td>
                                <td class="text-end">${{ $order->product->price }}</td>
                            </tr>

                            <tr>
                                <td></td>
                                <td class="fw-bold">Total</td>
                                <td class="text-end fw-bold">${{ $order->product->price }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Footer -->
                <div class="footer">
                    <p>Thank you for your business!</p>
                    <p>Payment Terms: Due within 30 days</p>
                    <p>Please make checks payable to Your Company Name</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
