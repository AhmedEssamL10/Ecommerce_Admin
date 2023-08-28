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
}
