<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Package;

class AppController extends Controller
{
    public function index()
    {
        if (Auth::user())
        {
            $packages = Package::whereNotIn('user_id', [Auth::user()->id])
                        ->get();
        }
        
        else 
        {
            $packages = Package::all();
        }

        return view('welcome', compact('packages'));
    }

}
