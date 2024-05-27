<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiRequest;
use App\Models\LogModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{
    private array $actions = ['hit', 'miss'];

    public function calculateTrappedWater(ApiRequest $request): JsonResponse
    {
        $heights = $request->input('heights');
        $cacheKey = 'trapped_water_' . implode('_', $heights);
        if (Cache::has($cacheKey)) {
            $trapped_water = Cache::get($cacheKey);
            Log::info('Cache hit for key: ' . $cacheKey);
            $log = new LogModel();
            $log->createLog($this->actions[0], $heights,$trapped_water);
            return response()->json(['trapped_water' => $trapped_water])->setStatusCode(200);
        } else {
            $trapped_water = Cache::remember($cacheKey, 60, function () use ($heights, $cacheKey) {
                Log::info('Cache miss for key: ' . $cacheKey);
                //make logs as LogModel model in db and save the logs
                $trapped_water = $this->calculateWater($heights);
                $log = new LogModel();
                $log->createLog($this->actions[1], $heights,$trapped_water);
                return $trapped_water;
            });
            return response()->json(['trapped_water' => $trapped_water])->setStatusCode(200);
        }

    }

    private function calculateWater($heights)
    {
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

        return $trapped_water;
    }
}
