<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    //
    public function index()
    {
        $brands = DB::table('brands')->get();
        return view('CRUD.Brands.index', compact('brands'));
    }
    public function create()
    {
        return view('CRUD.Brands.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'en_name' => 'required|max:32',
            'ar_name' => 'required|max:32',
            'status' => 'required|in:0,1',
            'image' => 'required|image'
        ]);
        $imageName = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $imageName = 'brand-' . uniqid() . '.' . $extention;
            $path = public_path('iamges/brand-logo');
            Storage::disk('external-2')->put($imageName, file_get_contents($image));
            $image->move($path, $imageName);
        }
        DB::table('brands')->insert([
            'en_name' => $request->en_name,
            'ar_name' => $request->ar_name,
            'status' => $request->status,
            'image' => $imageName,
        ]);
        return redirect(route('brands.index'))->with('success', 'the brand create successfully');
    }
}
