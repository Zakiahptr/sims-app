<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

        $data = $request->validated();

        //jika menggunakan storagelink
        // $data['selling_price'] = $data['purchase_price'] + ($data['purchase_price'] * 0.3);

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');

        //     $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        //     $extension = $file->getClientOriginalExtension();

        //     $folder = 'uploads';

        //     $filenameToStore = $filename . '.' . $extension;

        //     $counter = 1;
        //     while (Storage::exists($folder . '/' . $filenameToStore)) {
        //         $filenameToStore = $filename . ' (' . $counter . ').' . $extension;
        //         $counter++;
        //     }

        //     $image = $file->storeAs($folder, $filenameToStore);
        //     $data['image'] = $image;
        //    }


        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');

        //     $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        //     $extension = $file->getClientOriginalExtension();

        //     $folder = 'uploads';
        //     $filenameToStore = $filename . '.' . $extension;


        //     $counter = 1;
        //     while (file_exists(public_path($folder . '/' . $filenameToStore))) {
        //         $filenameToStore = $filename . ' (' . $counter . ').' . $extension;
        //         $counter++;
        //     }


        //     $file->move(public_path($folder), $filenameToStore);

        //     $data['image'] = $folder . '/' . $filenameToStore;
        // }

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $folder = 'uploads';

            $filenameToStore = $filename . '.' . $extension;
            $counter = 1;


            while (Storage::exists("public/{$folder}/{$filenameToStore}")) {
                $filenameToStore = $filename . " ({$counter}).{$extension}";
                $counter++;
            }

            $path = $file->storeAs("public/{$folder}", $filenameToStore);

            $data['image'] = "{$folder}/{$filenameToStore}";
        }


        Product::create($data);

        return redirect()->route('product.index')->with('status', 'Data produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['selling_price'] = $data['purchase_price'] + ($data['purchase_price'] * 0.3);
        // if ($request->hasFile('image')) {

        //     if ($product->image && Storage::exists($product->image)) {
        //         Storage::delete($product->image);
        //     }

        //     $file = $request->file('image');
        //     $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        //     $extension = $file->getClientOriginalExtension();
        //     $folder = 'uploads/image';
        //     $filenameToStore = $filename . '.' . $extension;

        //     $counter = 1;
        //     while (Storage::exists($folder . '/' . $filenameToStore)) {
        //         $filenameToStore = $filename . ' (' . $counter . ').' . $extension;
        //         $counter++;
        //     }

        //     // Simpan file baru dengan nama yang unik
        //     $image = $file->storeAs($folder, $filenameToStore);
        //     $data['image'] = $image;
        // }

        if ($request->hasFile('image')) {

            // if ($product->image && file_exists(public_path($product->image))) {
            //     unlink(public_path($product->image));
            // }

            if ($product->image && Storage::exists("public/{$product->image}")) {
                Storage::delete("public/{$product->image}");
            }

            $file = $request->file('image');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $folder = 'uploads';
            $filenameToStore = $filename . '.' . $extension;


            $counter = 1;
            while (file_exists(public_path($folder . '/' . $filenameToStore))) {
                $filenameToStore = $filename . ' (' . $counter . ').' . $extension;
                $counter++;
            }


            // $file->move(public_path($folder), $filenameToStore);

            // $data['image'] = $folder . '/' . $filenameToStore;


            $path = $file->storeAs("public/{$folder}", $filenameToStore);

            $data['image'] = "{$folder}/{$filenameToStore}";
        }

        $product->update($data);

        return redirect()->route('product.index')->with('status', 'Data produk berhasil diedit!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Storage::delete($product->image);

        // if ($product->image && file_exists(public_path($product->image))) {
        //     unlink(public_path($product->image));
        // }

        if ($product->image && Storage::exists("public/{$product->image}")) {
            Storage::delete("public/{$product->image}");
        }
        $product->delete();

        return redirect()->route('product.index')->with('status', 'Data produk berhasil dihapus!');
    }

    public function exportExcel(Request $request)
    {
        $category = $request->query('category', 'Semua');

        $products = Product::query();

        if ($category !== 'Semua') {
            $products->whereHas('category', function ($query) use ($category) {
                $query->where('category_name', $category);
            });
        }

        return Excel::download(new ProductsExport($products->get()), 'products.xlsx');
    }
}
