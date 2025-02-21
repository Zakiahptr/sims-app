@extends('layouts.app')

@section('content')
<x-breadcrumbs>
    <x-slot name="title">Daftar Produk</x-slot>
    <x-slot name="menu_1">Tambah Produk</x-slot>

</x-breadcrumbs>

<form id="productForm" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="category" class="form-label">Kategori</label>
            <select class="form-select" id="cateogry" name="category_id">
                <option selected>Pilih Kategori</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-8">
            <label for="product_name" class="form-label">Nama Barang</label>
            <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}" placeholder="Masukkan nama barang">

            @error('product_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="purchase_price" class="form-label">Harga Beli</label>
            <input id="purchase_price" type="text" class="form-control @error('purchase_price') is-invalid @enderror"
                   name="purchase_price" value="{{ old('purchase_price') }}"
                   placeholder="Masukkan harga beli" oninput="formatPrice(this); calculateSellingPrice();">

            @error('purchase_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="selling_price" class="form-label">Harga Jual</label>
            <input id="selling_price" type="text" class="form-control @error('selling_price') is-invalid @enderror"
                   name="selling_price" value="{{ old('selling_price') }}"
                   placeholder="Masukkan harga jual" oninput="formatPrice(this);">

            @error('selling_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="stock" class="form-label">Stock</label>
            <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror"
                   name="stock" value="{{ old('stock') }}" placeholder="Masukkan stok">

            @error('stock')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>



    <div class="row mb-3">
        <div class="col-md-12">
            <label for="image" class="form-label">Upload Image</label>
            <div id="image-upload-container" class="image-upload-box text-center">
                <input type="file" id="image" name="image" class="d-none" accept="image/*">
                <div id="upload-content">
                    <svg id="preview-icon" xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 256 256">
                        <path fill="#0d6efd" d="M216 40H40a16 16 0 0 0-16 16v144a16 16 0 0 0 16 16h176a16 16 0 0 0 16-16V56a16 16 0 0 0-16-16m0 16v102.75l-26.07-26.06a16 16 0 0 0-22.63 0l-20 20l-44-44a16 16 0 0 0-22.62 0L40 149.37V56ZM40 172l52-52l80 80H40Zm176 28h-21.37l-36-36l20-20L216 181.38zm-72-100a12 12 0 1 1 12 12a12 12 0 0 1-12-12"/>
                    </svg>
                    <p id="upload-text">Upload gambar disini</p>
                </div>
                <div id="preview-container" class="d-none">
                    <img id="preview-image">
                    <p id="file-name"></p>
                </div>
            </div>
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>



    <div class="form-group row">
        <div class="col-md-12">
            <div class="d-flex justify-content-end gap-3">
                <a href="{{ route('product.index') }}" type="button" class="btn btn-outline-primary px-5">Batalkan</a>
                <button type="submit" class="btn btn-primary px-5">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('custom-js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let imageUploadContainer = document.getElementById("image-upload-container");
        let imageInput = document.getElementById("image");
        let previewImage = document.getElementById("preview-image");
        let previewIcon = document.getElementById("preview-icon");
        let uploadText = document.getElementById("upload-text");
        let previewContainer = document.getElementById("preview-container");
        let fileName = document.getElementById("file-name");

        imageUploadContainer.addEventListener("click", function () {
            imageInput.click();
        });

        imageInput.addEventListener("change", function (event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove("d-none");
                    previewIcon.classList.add("d-none");
                    uploadText.classList.add("d-none");
                    fileName.textContent = file.name;
                };
                reader.readAsDataURL(file);
            }
        });

        imageUploadContainer.addEventListener("dragover", function (e) {
            e.preventDefault();
            imageUploadContainer.style.backgroundColor = "#e9ecef";
        });

        imageUploadContainer.addEventListener("dragleave", function (e) {
            imageUploadContainer.style.backgroundColor = "transparent";
        });

        imageUploadContainer.addEventListener("drop", function (e) {
            e.preventDefault();
            imageUploadContainer.style.backgroundColor = "transparent";
            let file = e.dataTransfer.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove("d-none");
                    previewIcon.classList.add("d-none");
                    uploadText.classList.add("d-none");
                    fileName.textContent = file.name;
                };
                reader.readAsDataURL(file);
                imageInput.files = e.dataTransfer.files;
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let purchaseInput = document.getElementById("purchase_price");
        let sellingInput = document.getElementById("selling_price");

        // Format angka ke ribuan dengan koma
        function formatPrice(input) {
            let value = input.value.replace(/\D/g, ""); // Hanya angka
            if (!value) {
                input.value = "";
                return;
            }
            input.value = new Intl.NumberFormat("en-US").format(value);
        }

        // Hitung harga jual otomatis (Harga Beli + 30%)
        function calculateSellingPrice() {
            let purchaseValue = purchaseInput.value.replace(/\D/g, ""); // Ambil angka tanpa koma
            if (purchaseValue) {
                let sellingValue = Math.round(purchaseValue * 1.3); // Harga Beli + 30%
                sellingInput.value = new Intl.NumberFormat("en-US").format(sellingValue);
            } else {
                sellingInput.value = "";
            }
        }

        // Event saat harga beli diketik
        purchaseInput.addEventListener("input", function () {
            formatPrice(this);
            calculateSellingPrice();
        });

        // Event saat harga jual diketik (format ribuan)
        sellingInput.addEventListener("input", function () {
            formatPrice(this);
        });

        // Sebelum submit, ubah format angka agar tersimpan tanpa koma
        document.getElementById("productForm").addEventListener("submit", function () {
            purchaseInput.value = purchaseInput.value.replace(/\D/g, "");
            sellingInput.value = sellingInput.value.replace(/\D/g, "");
        });
    });
</script>





@endsection
