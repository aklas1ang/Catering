<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variant;

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
        Variant::create($data);
        
        return redirect("myVariants/$request->user_id");
    }

    public function myVariants($userId)
    {   
        $variants = Variant::where('user_id', $userId)
                        ->get();
        return view('user.myVariants', compact('variants'));
    }
}
