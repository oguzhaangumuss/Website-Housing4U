<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // Doğru yazım
use App\Models\Product;

class AdminController extends Controller
{
    // Admin dashboard'a yönlendir
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
    
        return redirect()->route('user.dashboard');
    }

    // Kategorileri listeleme
    public function category()
    {
        $data = Category::all();
        return view('admin.category', compact('data'));
    }   

    // Ürün ekleme sayfası
    public function product()
    {
        $categories = Category::all();
        return view('admin.product', compact('categories'));
    }

    // Kategori silme
    public function delete_category($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('message', 'Category has been deleted.');
    }

    // Kategori ekleme
    public function add_category(Request $request)
    {
        $validated = $request->validate([
            'categoryname' => 'required|string|max:255', // Veri doğrulama
        ]);
        
        $category = new Category;
        $category->category_name = $request->categoryname;
        $category->save();
        return redirect()->back()->with('message', 'Category Added Successfully!');
    }  

    // Ürün ekleme
    public function add_product(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'dprice' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|exists:categories,id',  // Kategori ID doğrulama
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Görsel doğrulama
        ]);

        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discountprice = $request->dprice;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category; // category_id olarak düzeltildi
        $image = $request->file('image');
        
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('products', $imagename);
            $product->image = $imagename;
        }

        $product->save();
        return redirect()->back()->with('message', 'Product Added Successfully!');
    }

    // Ürün sayfası
    public function productsPage()
    {
        $products = Product::all();
        return view('admin.productspage', compact('products'));
    }

    // Ürün silme
    public function delete_product($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'Product has been deleted.');
    }

    // Ürün güncelleme sayfası
    public function update_product($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.update_product', compact('product', 'categories'));
    }

    // Ürün güncelleme işlemi
    public function update_product_confirm(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'dprice' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discountprice = $request->dprice;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category;

        $image = $request->file('image');

        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('products', $imagename);
            $product->image = $imagename;
        }

        $product->save();
        return redirect()->back()->with('message', 'Product Updated Successfully!');
    }
}
