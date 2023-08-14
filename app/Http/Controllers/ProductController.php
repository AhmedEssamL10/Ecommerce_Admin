<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function index()
    {
        // $products = Product::all();
        $products = DB::table('products')->select('*')->get();
        return view('CRUD.Products.index', compact('products'));
    }
    public function create()
    {
        $brands = DB::table('brands')->select('id', 'en_name', 'ar_name')->orderBy('en_name')->get();
        $subcatigories = DB::table('subcatigories')->select('id', 'en_name', 'ar_name')->orderBy('en_name')->get();
        return view('CRUD.Products.create', compact('brands', 'subcatigories'));
    }
    public function store(Request $request)
    {
        //validation
        $validation = $request->validate([
            'en_name' => 'required|max:32',
            'ar_name' => 'required|max:32',
            'quantity' => 'required|max:3',
            'status' => 'required|in:0,1',
            'price' => 'required|max:6',
            'detiles_en' => 'required|max:255',
            'detiles_ar' => 'required|max:255',
            'code' => 'required|integer|max:20|unique:products,code',
            'brands_id' => 'integer|exists:brands,id',
            'subcatigories_id' => 'integer|exists:subcatigories,id',
            'image' => 'required|image'
        ]);

        //upload image
        // insert into database
        //redirect
    }
    public function edit($id)
    {
        $brands = DB::table('brands')->select('id', 'en_name', 'ar_name')->orderBy('en_name')->get();
        $subcatigories = DB::table('subcatigories')->select('id', 'en_name', 'ar_name')->orderBy('en_name')->get();
        $products = DB::table('products')->select('*')->where('id', '=', $id)->get();
        return view('CRUD.Products.edit', compact('products', 'brands', 'subcatigories'));
    }
}
