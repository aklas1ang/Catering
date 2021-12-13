<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Package;
use App\Models\Variant;

class PackageController extends Controller
{

    public function create()
    {
        $data = Variant::where('user_id', Auth::user()->id)
                        ->get();
        return view('user.createPackage', compact('data'));
    }
    
    public function store(Request $request)
    {
        
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'variants' => 'required|array',
            'variants.*' => 'exists:variants,id',
            'user_id' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('image'))
        {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/img', $fileNameToStore);
        }else
        {
            $fileNameToStore = 'noImage.png';
        }

        $data['image'] = $fileNameToStore;

        $createdPackage = Package::create($data);
        $createdPackage->variants()->attach($request->variants);

        return redirect("/myPackages/$request->user_id");
    }

    public function packages()
    {
        return Package::all()->take(6);
    }

    public function myPackages($userId)
    {
        $packages = Package::where('user_id', $userId)
                        ->get();
        return $packages;
    }

    public function dashboard($userId) {
        $data = Package::whereNotIn('user_id', [$userId])
                        ->get();
        return $data;
    }

    public function delete(Package $package)
    {
        if($package->image != 'noImage.png') {
            Storage::delete('public/storage/img/'.$package->image);
        }
    }
    
    public function details($id)
    {
        $package = Package::with('user', 'variants')->find($id);
        
        return view('viewDetails', compact('package'));
    }

}
