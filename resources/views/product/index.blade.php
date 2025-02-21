@extends('layouts.app')

@section('content')
<div class="title-page">Daftar Produk</div>

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
<div class="table-responsive p-2">
    <div class="d-flex justify-content-end mb-2 gap-3">
        <select class="form-select form-select-sm w-auto" id="category">
            <option value="Semua" selected>Semua Kategori</option>
            <option value="Alat Olahraga">Alat Olahraga</option>
            <option value="Alat Musik">Alat Musik</option>
        </select>
        <a id="exportExcel" class="btn btn-success" href="{{ route('product.export', ['category' => 'Semua']) }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/>
                <path fill="#fff" d="M200 26H72a14 14 0 0 0-14 14v26H40a14 14 0 0 0-14 14v96a14 14 0 0 0 14 14h18v26a14 14 0 0 0 14 14h128a14 14 0 0 0 14-14V40a14 14 0 0 0-14-14m-42 76h44v52h-44Zm44-62v50h-44V80a14 14 0 0 0-14-14h-2V38h58a2 2 0 0 1 2 2M70 40a2 2 0 0 1 2-2h58v28H70ZM38 176V80a2 2 0 0 1 2-2h104a2 2 0 0 1 2 2v96a2 2 0 0 1-2 2H40a2 2 0 0 1-2-2m32 40v-26h60v28H72a2 2 0 0 1-2-2m130 2h-58v-28h2a14 14 0 0 0 14-14v-10h44v50a2 2 0 0 1-2 2M67.39 148.16L84.19 128l-16.8-20.16a6 6 0 1 1 9.22-7.68L92 118.63l15.39-18.47a6 6 0 0 1 9.22 7.68L99.81 128l16.8 20.16a6 6 0 1 1-9.22 7.68L92 137.37l-15.39 18.47a6 6 0 0 1-9.22-7.68"/>
            </svg>
            <span style="vertical-align: middle">Export to Excel</span>
        </a>


        <a href="{{ route('product.create') }}" class="btn btn-danger">
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 32 32"><path fill="#fff" d="M16 3C8.832 3 3 8.832 3 16s5.832 13 13 13s13-5.832 13-13S23.168 3 16 3m0 2c6.087 0 11 4.913 11 11s-4.913 11-11 11S5 22.087 5 16S9.913 5 16 5m-1 5v5h-5v2h5v5h2v-5h5v-2h-5v-5z"/></svg>
            Tambah Produk
        </a>
    </div>
    <table id="datatable" class="table table-hover text-center">
        <thead class="table-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Image</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Kategori Produk</th>
                <th scope="col">Harga Beli (Rp)</th>
                <th scope="col">Harga Jual (Rp)</th>
                <th scope="col">Stok Produk</th>
                <th scope="col">Aksi</th>

            </tr>
        </thead>
        <tbody style="vertical-align: middle;">
            @foreach ($products as $product )
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    {{-- <img width="10px" src="{{ $product->image() }}"> --}}
                    <img src="{{ route('image.view', ['filename' => basename($product->image)]) }}" alt="Gambar Produk">
                </td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->category->category_name }}</td>
                <td>{{ number_format($product->purchase_price, 0, ',', ',') }}</td>
                <td>{{ number_format($product->selling_price, 0, ',', ',') }}</td>
                <td>{{ $product->stock }}</td>
                <td >
                    <form method="POST" action="{{ route('product.destroy', $product->id) }}" class="m-0">
                        @csrf
                        @method('delete')
                        <a href="{{ route('product.edit', $product->id) }}" class="p-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#0d6efd" d="M20.71 7.04c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.37-.39-1.02-.39-1.41 0l-1.84 1.83l3.75 3.75M3 17.25V21h3.75L17.81 9.93l-3.75-3.75z"/></svg>
                        </a>
                        <button type="submit" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#dc3545" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6zM19 4h-3.5l-1-1h-5l-1 1H5v2h14z"/></svg>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>
@endsection

@section('custom-js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let alertBox = document.querySelector(".alert");

        if (alertBox) {
            setTimeout(function () {
                alertBox.style.transition = "opacity 0.5s ease-out";
                alertBox.style.opacity = "0";
                setTimeout(() => {
                    alertBox.remove();
                }, 500);
            }, 3000);
        }
    });
</script>

<script>
    document.getElementById('category').addEventListener('change', function() {
        let selectedCategory = this.value;
        let rows = document.querySelectorAll("#datatable tbody tr");

        rows.forEach(row => {
            let categoryCell = row.cells[3].innerText.trim();
            if (selectedCategory === "Semua" || categoryCell === selectedCategory) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
    </script>

<script>
    document.getElementById('category').addEventListener('change', function() {
        let selectedCategory = this.value;
        document.getElementById('exportExcel').href = "{{ route('product.export') }}?category=" + encodeURIComponent(selectedCategory);
    });
    </script>
@endsection
