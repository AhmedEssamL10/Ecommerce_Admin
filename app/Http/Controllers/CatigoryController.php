<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatigoryController extends Controller
{
    //
    public function index()
    {
        $catigories = DB::table('catigories')->get();
        return view('CRUD.Catigories.index', compact('catigories'));
    }
    public function create()
    {
        return view('CRUD.Catigories.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'en_name' => 'required|max:32',
            'ar_name' => 'required|max:32',
            'status' => 'required|in:0,1'
        ]);
        DB::table('catigories')->insert([
            'en_name' => $request->en_name,
            'ar_name' => $request->ar_name,
            'status' => $request->status,
        ]);
        return redirect(route('catigories.index'))->with('success', 'the brand created successfully');
    }
}
