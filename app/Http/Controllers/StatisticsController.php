<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    
    public function getTotalCount(){

        $carsCount = Car::all()->count();
        $usersCount = User::all()->count();
        $reservationsCount = Reservation::all()->count();
        $income = DB::table('reservations')->sum('reservations.total_amount');

        return response()->json([
            'status' => 200,
            'carsCount' => $carsCount,
            'usersCount' => $usersCount,
            'reservationsCount' => $reservationsCount,
            'income' => $income
        ]);
    }
}
