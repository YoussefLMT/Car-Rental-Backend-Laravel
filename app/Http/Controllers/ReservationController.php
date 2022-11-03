<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{

    public function getReservations()
    {
        $reservations = Reservation::join('cars', 'reservation.car_id', '=', 'cars.id')
               ->get(['reservation.*', 'cars.name']);

        return response()->json([
            'status' => 200,
            'reservations' => $reservations
        ]);
    }

    
    public function addReservation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'=> 'required',
            'last_name'=> 'required',
            'phone' => 'required',
            'car_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'total_amount' => 'required'
        ]);

        if($validator->fails()){

            return response()->json([
                'validation_err' => $validator->messages(),
            ]);

        }else{

            Reservation::create([
                'first_name'=> $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'car_id' => $request->car_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'total_amount' => $request->total_amount
            ]);
    
            return response()->json([
                'status' => 200,
                'message' => "Reservation added successfully",
            ]);
        }
    }

}
