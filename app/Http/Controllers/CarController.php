<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{

    public function getCars()
    {
        $cars = Car::all();

        return response()->json([
            'status' => 200,
            'cars' => $cars
        ]);
    }



    public function addNewECar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'model_year'=> 'required',
            'brand' => 'required',
            'color' => 'required',
            'capacity' => 'required',
            'plat_number' => 'required',
        ]);

        if($validator->fails()){

            return response()->json([
                'validation_err' => $validator->messages(),
            ]);

        }else{

            Car::create([
                'name'=> $request->name,
                'model_year' => $request->model_year,
                'brand'=> $request->brand,
                'color' => $request->color,
                'capacity' => $request->capacity,
                'plat_number' => $request->plat_number,
            ]);
    
            return response()->json([
                'status' => 200,
                'message' => "Car added successfully",
            ]);
        }
    }
}
