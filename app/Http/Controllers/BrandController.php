<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;


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



    public function updateBrand(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
        ]);


        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'validation_err' => $validator->messages(),
            ]);

        }else{

            $brand = Brand::find($id);

            if($brand){

                $brand->name = $request->name;
                $brand->save();
        
                return response()->json([
                    'status' => 200,
                    'message' => 'Updated successully',
                ]);

            }else{

                return response()->json([
                    'status' => 404,
                    'message' => 'Brand not found!',
                ]);
            }
        }
    }



    public function deleteBrand($id)
    {
        $brand = Brand::find($id);

        if($brand){

            $brand->delete();
    
            return response()->json([
                'status' => 200,
                'message' => 'Deleted successfully',
            ]);

        }else{

            return response()->json([
                'status' => 404,
                'message' => 'Brand not found!',
            ]);
        }
    }
}
