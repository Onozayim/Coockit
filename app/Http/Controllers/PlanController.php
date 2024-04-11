<?php

namespace App\Http\Controllers;

use App\Traits\Utils;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PlanController extends Controller
{
    //
    use Utils;

    public function getPlan()
    {
        $info = User::with('plan.user')->find(Auth::id());

        // echo $info;
        // return $this->returnDataJson($info);
        Log::debug($info->plan);
        $planArray = array();
        $caloriesArray = array();
        
        $caloriesArray[1] = 0;
        $caloriesArray[2] = 0;
        $caloriesArray[3] = 0;
        $caloriesArray[4] = 0;
        $caloriesArray[5] = 0;
        $caloriesArray[6] = 0;
        $caloriesArray[7] = 0;

        Log::debug($caloriesArray);
        foreach($info->plan as $pivot)
        {
            Log::debug($pivot->pivot);
            $planArray[$pivot->pivot->day][$pivot->pivot->meal] = $pivot;
            $caloriesArray[$pivot->pivot->day] += $pivot->calories;
        }
        // Log::debug($planArray[1][1]);
        return view('plan.index', compact('caloriesArray', 'planArray'));
    }

    public function getIngredientes()
    {
        $data = User::with('plan.ingredientes')->find(Auth::id());

        return view('plan.ingredientes', compact('data'));
    }
}
