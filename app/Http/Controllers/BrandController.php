<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function getBrands()
    {
        $brands = Brand::all();

        return response()->json([
            'status' => 200,
            'brands' => $brands,
        ]);
    }


    
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



    public function getBrand($id)
    {
        $brand = Brand::find($id);

        if($brand){

            return response()->json([
                'status' => 200,
                'brand' => $brand,
            ]);

        }else{

            return response()->json([
                'status' => 404,
                'message' => 'Brand not found!',
            ]);

        }
    }

}
