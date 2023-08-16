<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            'code' => 'required|integer|unique:products,code',
            'brands_id' => 'integer|exists:brands,id',
            'subcatigories_id' => 'integer|exists:subcatigories,id',
            'image' => 'required|image'
        ]);

        //upload image
        $imageName = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $imageName = 'product-' . uniqid() . '.' . $extention;
            Storage::disk('external')->put($imageName, file_get_contents($image));
            $path = public_path('images/product');
            $image->move($path, $imageName);
        }
        // insert into database
        DB::table('products')->insert([
            'en_name' => $request->en_name,
            'ar_name' => $request->ar_name,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'price' => $request->price,
            'detiles_en' => $request->detiles_en,
            'detiles_ar' => $request->detiles_ar,
            'code' => $request->code,
            'brands_id' => $request->brands_id,
            'subcatigories_id' => $request->subcatigories_id,
            'image' => $imageName,

        ]);
        //redirect
        return  redirect(route('products.index'))->with('success', 'the product create successfully');
    }
    public function edit($id)
    {
        $brands = DB::table('brands')->select('id', 'en_name', 'ar_name')->orderBy('en_name')->get();
        $subcatigories = DB::table('subcatigories')->select('id', 'en_name', 'ar_name')->orderBy('en_name')->get();
        $products = DB::table('products')->select('*')->where('id', '=', $id)->get();
        return view('CRUD.Products.edit', compact('products', 'brands', 'subcatigories'));
    }
    public function update(Request $request, $id)
    {
        //validation
        $validation = $request->validate([
            'en_name' => 'required|max:32',
            'ar_name' => 'required|max:32',
            'quantity' => 'required|max:3',
            'status' => 'in:0,1',
            'price' => 'required|max:6',
            'detiles_en' => 'required|max:255',
            'detiles_ar' => 'required|max:255',
            'code' => "required|integer|unique:products,code,$id,id",
            'brands_id' => 'integer|exists:brands,id',
            'subcatigories_id' => 'integer|exists:subcatigories,id',
            'image' => 'image'
        ]);

        //upload image
        $dbimage = DB::table('products')->select('image')->where('id', '=', $id)->first();
        $imageName = $dbimage->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $imageName = 'product-' . uniqid() . '.' . $extention;
            Storage::disk('external')->put($imageName, file_get_contents($image));
            $path = public_path('images\product');
            $dbimage = DB::table('products')->select('image')->where('id', '=', $id)->first();
            $oldpath1 = $path . '\\' . $dbimage->image;
            if (file_exists($oldpath1)) {
                unlink($oldpath1);
            }
            Storage::disk('external')->delete($dbimage->image);

            $image->move($path, $imageName);
        }
        // update database
        DB::table('products')->where('id', '=', $id)->update([
            'en_name' => $request->en_name,
            'ar_name' => $request->ar_name,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'price' => $request->price,
            'detiles_en' => $request->detiles_en,
            'detiles_ar' => $request->detiles_ar,
            'code' => $request->code,
            'brands_id' => $request->brands_id,
            'subcatigories_id' => $request->subcatigories_id,
            'image' => $imageName,
        ]);
        //redirect
        return  redirect(route('products.index'))->with('success', 'the product Updated successfully');
    }
    public function delete($id)
    {

        $path = public_path('images\product');
        $dbimage = DB::table('products')->select('image')->where('id', '=', $id)->first();
        $oldpath1 = $path . '\\' . $dbimage->image;
        if (file_exists($oldpath1)) {
            unlink($oldpath1);
        }
        Storage::disk('external')->delete($dbimage->image);
        DB::table('products')->where('id', '=', $id)->delete();
        return  back()->with('success', 'the product deleted successfully');
    }
}
