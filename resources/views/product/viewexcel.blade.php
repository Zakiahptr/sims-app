<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $index => $product)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>
                <img src="{{ $product->image}}" alt="" height="50" width="50">
                {{-- {{ $product->image }} --}}
            </td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->category->category_name }}</td>
            <td>{{ number_format($product->purchase_price, 0, ',', ',') }}</td>
            <td>{{ number_format($product->selling_price, 0, ',', ',') }}</td>
            <td>{{ $product->stock }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
