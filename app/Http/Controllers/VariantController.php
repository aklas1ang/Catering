<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Variant;
use Validator;

class VariantController extends Controller
{
    public function create()
    {
        return view('user.createVariant');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'image' => 'required|image|nullable|max:1999'
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
        Variant::create($data);

        return redirect("myVariants/$request->user_id")
            ->with('success', 'Variant Created');
    }

    public function myVariants($userId)
    {
        $data = Variant::where('user_id', $userId)
                        ->get();
        return view('user.variants', ['variants'=>$data, 'variant_nav'=>'active']);
    }

    public function edit(Variant $variant)
    {
        $data = Variant::where('user_id', Auth::user()->id)
                        ->get();
        return view('user.updateVariant', compact('variant', 'data'));
    }

    public function destroy(Request $request, Variant $variant)
    {
        $error = Validator::make(['variant_id' => $variant->id],[
            'variant_id' => 'required|exists:package_variant,variant_id'
        ]);

        if ($error->fails()) {
            $variant->delete();
            return redirect()->route('myVariants', Auth::user()->id)->withSuccess('Variant deleted!');
        }
        return redirect()->route('myVariants', Auth::user()->id)->withErrors(['message' => 'Variant in used!']);
    }
}
