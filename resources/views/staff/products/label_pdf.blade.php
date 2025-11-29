<!DOCTYPE html>
<html>
<head>
    <title>Product Labels</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <link rel="stylesheet" href="{{ public_path('css/label.css') }}">
</head>
<body>

    <table>
        <tbody>
            {{-- PHP Logic to split items into rows of 3 --}}
            @php
                $stickers = array_fill(0, $product->quantity, 1);
                $rows = array_chunk($stickers, 3);
            @endphp

            @foreach($rows as $row)
                <tr>
                    @foreach($row as $item)
                        <td>
                            <div class="title">{{ Str::limit($product->name, 20) }}</div>
                            <div class="meta">{{ $product->category->name ?? 'N/A' }}</div>
                            
                            <div class="barcode-wrapper">
                                <img src="data:image/png;base64,{{ $barcodeBase64 }}" class="barcode-img">
                            </div>
                            
                            <div class="barcode-num">{{ $product->barcode }}</div>
                            <div class="price">Rp {{ number_format($product->price, 2, ',', '.') }}</div>
                        </td>
                    @endforeach

                    {{-- Empty cells filler --}}
                    @for($k = 0; $k < (3 - count($row)); $k++)
                        <td style="border: none;"></td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>