<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function calculateTrappedWater(Request $request)
    {
        $heights = $request->input('heights');

        if (empty($heights) || !is_array($heights)) {
            return response()->json(['error' => 'Invalid input. Please provide an array of heights.'], 400);
        }

        $left = 0;
        $right = count($heights) - 1;
        $left_max = $heights[$left];
        $right_max = $heights[$right];
        $trapped_water = 0;

        while ($left < $right) {
            if ($heights[$left] < $heights[$right]) {
                $left++;
                $left_max = max($left_max, $heights[$left]);
                $trapped_water += max(0, $left_max - $heights[$left]);
            } else {
                $right--;
                $right_max = max($right_max, $heights[$right]);
                $trapped_water += max(0, $right_max - $heights[$right]);
            }
        }

        return response()->json(['trapped_water' => $trapped_water], 200);
    }
}
