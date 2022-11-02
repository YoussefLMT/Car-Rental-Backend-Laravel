<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Validator;


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



    public function addNewCar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'model_year'=> 'required',
            'brand' => 'required',
            'color' => 'required',
            'capacity' => 'required',
            'plate_number' => 'required',
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
                'plate_number' => $request->plate_number,
            ]);
    
            return response()->json([
                'status' => 200,
                'message' => "Car added successfully",
            ]);
        }
    }



    public function getCar($id)
    {
        $car = car::find($id);

        if($car){

            return response()->json([
                'status' => 200,
                'car' => $car,
            ]);

        }else{

            return response()->json([
                'status' => 404,
                'message' => 'Car not found!',
            ]);
        }
    }



    public function updateCar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'model_year'=> 'required',
            'brand' => 'required',
            'color' => 'required',
            'capacity' => 'required',
            'plate_number' => 'required',
        ]);


        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'validation_err' => $validator->messages(),
            ]);

        }else{

            $car = Car::find($id);

            if($car){

                $car->name = $request->name;
                $car->model_year = $request->model_year;
                $car->brand = $request->brand;
                $car->color = $request->color;
                $car->capacity = $request->capacity;
                $car->plate_number = $request->plate_number;
                $car->save();
        
                return response()->json([
                    'status' => 200,
                    'message' => 'Updated successully',
                ]);

            }else{

                return response()->json([
                    'status' => 404,
                    'message' => 'Car not found!',
                ]);
            }
        }
    }


    
    public function deleteCar($id)
    {
        $car = Car::find($id);

        if($car){

            $car->delete();
    
            return response()->json([
                'status' => 200,
                'message' => 'Deleted successfully',
            ]);

        }else{

            return response()->json([
                'status' => 404,
                'message' => 'Car not found!',
            ]);
        }
    }
}
