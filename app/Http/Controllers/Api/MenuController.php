<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MealResource;
use App\Models\Meal;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function listMenuItems()
    {
        $meals = Meal::all();
        return response()->json(['data' => MealResource::collection($meals)]);
    }
}
