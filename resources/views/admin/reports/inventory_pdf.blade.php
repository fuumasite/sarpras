<!DOCTYPE html>
<html>
<head>
    <title>Inventory Report</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<body>

    <div class="header">
        <h1>Laporan Inventaris</h1>
        <p>Daftar Inventaris Lengkap</p>
        <p>Tanggal Dibuat: {{ $date }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th class="text-right">Price</th>
                <th class="text-center">Stock</th>
                <th class="text-right">Total Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td class="text-right">Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td class="text-center">{{ $product->quantity }}</td>
                    <td class="text-right">Rp {{ number_format($product->price * $product->quantity, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        Total Nilai Inventaris: Rp {{ number_format($totalValue, 2, ',', '.') }}
    </div>

    <div class="footer">
        Dihasilkan oleh Administrator Sistem | Sistem Manajemen Inventaris
    </div>

</body>
</html>