<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    
    public function AddNewBrand(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
        ]);

        if($validator->fails()){

            return response()->json([
                'validation_err' => $validator->messages(),
            ]);

        }else{

            Brand::create([
                'name'=> $request->name,
            ]);
    
            return response()->json([
                'status' => 200,
                'message' => 'Brand added successfully',
            ]);
        }
    }
}
