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


    public function getReservationsStatistics(){

        $monthlyArray = array();
        $emptyMonth = array('count' => 0, 'month' => 0);
        for($i = 1; $i <= 12; $i++){
            $emptyMonth['month'] = $i;
            $monthlyArray[$i-1] = $emptyMonth;
        }
        
        $count = Reservation::select(DB::raw('YEAR(created_at) year'), DB::raw('MONTH(created_at) month'), DB::raw('count(id) as `count`'))
        ->groupBy('year','month')
        ->orderByRaw('month')
        ->get()
        ->toArray();

        // $pendingOrdersCount = Order::where('status', 'pending')->count();
        // $inProgressOrdersCount = Order::where('status', 'in progress')->count();
        // $shippingOrdersCount = Order::where('status', 'shipping')->count();
        // $shippedOrdersCount = Order::where('status', 'shipped')->count();


        foreach($count as $key => $array){
            $monthlyArray[$array['month']-1] = $array;
        }

        return response()->json([
            'status' => 200,
            'reservationsCount' => $monthlyArray,
            // 'pendingOrdersCount' => $pendingOrdersCount,
            // 'inProgressOrdersCount' => $inProgressOrdersCount,
            // 'shippingOrdersCount' => $shippingOrdersCount,
            // 'shippedOrdersCount' => $shippedOrdersCount
        ]);
    }
}
