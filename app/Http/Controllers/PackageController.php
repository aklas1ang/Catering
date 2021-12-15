<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Package;
use App\Models\Variant;
use Validator;

class PackageController extends Controller
{

    public function create()
    {
        $data = Variant::where('user_id', Auth::user()->id)
                        ->get();

        if(count($data) < 1)
        {
            return redirect("/variant/create")
                ->with('error', 'Create a variant first');
        }

        $data = $data->mapToGroups(function($item, $key) {
            return [$item->type => $item];
        });

        return view('user.createPackage', compact('data'));
    }

    public function store(Request $request)
    {

        $data = $this->validate($request, [
            'name' => 'required|unique:packages,name',
            'description' => 'required',
            'price' => 'required',
            'variants' => 'required|array',
            'variants.*' => 'exists:variants,id',
            'user_id' => 'required',
            'image' => 'image|required|max:1999'
        ]);

        if($request->hasFile('image'))
        {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/img', $fileNameToStore);
        }

        $data['image'] = $fileNameToStore;

        $createdPackage = Package::create($data);
        $createdPackage->variants()->attach($request->variants);

        return redirect("/packages/$request->user_id");
    }

    public function myPackages($userId)
    {
        $packages = Package::where('user_id', $userId)
                        ->get();
        
        $package_nav = 'active';
        return view('user.home', compact('packages', 'package_nav'));
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

    public function edit(Package $package)
    {
        $data = Variant::where('user_id', Auth::user()->id)
                        ->get();
        return view('user.updatePackage', compact('package', 'data'));
    }

    public function update(Package $package, Request $request)
    {

        $data = $this->validate($request, [
            'name' => 'required|unique:packages,name',
            'description' => 'required',
            'price' => 'required',
            'variants' => 'required|array',
            'variants.*' => 'exists:variants,id',
            'user_id' => 'required',
            'image' => 'image|required|max:1999'
        ]);

        if($request->hasFile('image'))
        {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/img', $fileNameToStore);
            Storage::delete('public/img/'.$package->image);
        }

        $data['image'] = $fileNameToStore;

        $package->update($data);

        return redirect("/packages/$package->user_id")
            ->with('success', 'Package updated successfully');
    }
    
    public function destroy(Request $request, Package $package)
    {
        // inverted validation
        $error = Validator::make(['id' => $package->id], [
            'id' => 'required|exists:bookings,package_id'
        ]);

        if ($error->fails()) {
            $package->delete();
            Storage::delete('public/img/'.$package->image);
            return redirect()->route('myPackages', Auth::user()->id)->withSuccess('Package deleted!');
        }

        
        return redirect()->route('myPackages', Auth::user()->id)->withErrors(['message' => 'Package in used!']);
    }

}
