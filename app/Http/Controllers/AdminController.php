<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catagory;
use App\Models\Product;

class AdminController extends Controller
{


    public function index()
    {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
    
        return redirect()->route('user.dashboard');
    }

    
        public function catagory() {
            $data=catagory::all();
    
            return view('admin.catagory',compact('data'));
        }   
        public function product() {
            $catagory=catagory::all();
    
            return view('admin.product',compact('catagory'));
        }
        public function delete_catagory($id) {
            $data=catagory::find($id);
            $data->delete();
            return redirect()->back()->with('message','Catagory has deleted.');
        }
        public function add_catagory(Request $request) {
            $data=new catagory; 
            $data->catagory_name=$request->catagoryname;
            $data->save();
            return redirect()->back()->with('message','Catagory Added Succesfully.!');
        }  
        public function add_product(Request $request) {
            $product=new product;
            $product->title=$request->title;
            $product->description=$request->description;
            $product->price=$request->price;
            $product->discountprice=$request->dprice;
            $product->quantity=$request->quantity;
            $product->catagory=$request->catagory;
            $image=$request->image;
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products',$imagename);
            $product->image=$imagename;
            $product->save();
            return redirect()->back()->with('message','Product Added Succesfully.!');
            
        }
    
        public function productspage() {
            $product=product::all();
    
            return view('admin.productspage',compact('product'));
        }
        public function delete_product($id) {
            $product=product::find($id);
            $product->delete();
            return redirect()->back()->with('message','Product has deleted.');
        }
        public function update_product($id) {
            $product=product::find($id);
            $catagory=catagory::all();
    
            return view('admin.update_product',compact('product','catagory'));
        }   
        public function update_product_confirm(Request $request,$id) {
            $product=product::find($id);
            $product->title=$request->title;
            $product->description=$request->description;
            $product->price=$request->price;
            $product->discountprice=$request->dprice;
            $product->quantity=$request->quantity;
            $product->catagory=$request->catagory;  
            $image=$request->image;
    
            if($image){
    
                $imagename=time().'.'.$image->getClientOriginalExtension();
                $request->image->move('products',$imagename);
                $product->image=$imagename;
            }
            $product->save();
            
            return redirect()->back()->with('message','Product Updated Succesfully.!');
        }
    }
    
