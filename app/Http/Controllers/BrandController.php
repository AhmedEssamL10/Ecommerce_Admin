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
            $path = public_path('images/brand-logo');
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
    public function edit($id)
    {
        $brands = DB::table('brands')->where('id', '=', $id)->first();
        return view('CRUD.Brands.edit', compact('brands'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'en_name' => 'required|max:32',
            'ar_name' => 'required|max:32',
            'status' => 'required|in:0,1',
            'image' => 'image'
        ]);
        $dbimage = DB::table('brands')->select('image')->where('id', '=', $id)->first();
        $imageName = $dbimage->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $imageName = 'brands-' . uniqid() . '.' . $extention;
            Storage::disk('external-2')->put($imageName, file_get_contents($image));
            $path = public_path('images\brand-logo');
            $dbimage = DB::table('brands')->select('image')->where('id', '=', $id)->first();
            $oldpath1 = $path . '\\' . $dbimage->image;
            if (file_exists($oldpath1)) {
                unlink($oldpath1);
            }
            Storage::disk('external-2')->delete($dbimage->image);

            $image->move($path, $imageName);
        }
        DB::table('brands')->where('id', '=', $id)->update([
            'en_name' => $request->en_name,
            'ar_name' => $request->ar_name,
            'status' => $request->status,
            'image' => $imageName,
        ]);
        return  redirect(route('brands.index'))->with('success', 'the brand updated successfully');
    }
    public function delete($id)
    {
        $path = public_path('images\brand-logo');
        $dbimage = DB::table('brands')->select('image')->where('id', '=', $id)->first();
        $oldpath1 = $path . '\\' . $dbimage->image;
        if (file_exists($oldpath1)) {
            unlink($oldpath1);
        }
        Storage::disk('external-2')->delete($dbimage->image);
        DB::table('brands')->where('id', '=', $id)->delete();
        return back()->with('success', 'the brand deleted successfully');
    }
}
