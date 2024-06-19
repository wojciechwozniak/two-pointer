<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CacheController;
use App\Http\Requests\ApiRequest;
use App\Models\ActionsModel;
use App\Models\LogModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

    private LogModel $Log;
    private int $trapped_water;
    public function __construct()
    {
        $this->Log = new LogModel();
        $this->trapped_water = 0;
    }

    public function run(ApiRequest $request): JsonResponse
    {
        $heights = $request->input('heights');
        $cacheController = new CacheController($heights);
        $this->prepareResult($cacheController->checkCache(), $heights);
        return response()->json(['trapped_water' => $this->trapped_water])->setStatusCode(200);
    }

    public function prepareResult(string $action, $heights){
        if($action === ActionsModel::getActionHit()) {
            $this->trapped_water = LogModel::where('query', json_encode($heights))->first()->response;
        }else{
            $this->calculateWater($heights);
        }
        $this->Log->createLog($action, $heights,  $this->trapped_water);
    }
    public function calculateWater($heights): int
    {
        $left = 0;
        $right = count($heights) - 1;
        $left_max = $heights[$left];
        $right_max = $heights[$right];


        while ($left < $right) {
            if ($heights[$left] < $heights[$right]) {
                $left++;
                $left_max = max($left_max, $heights[$left]);
                $this->trapped_water += max(0, $left_max - $heights[$left]);
            } else {
                $right--;
                $right_max = max($right_max, $heights[$right]);
                $this->trapped_water += max(0, $right_max - $heights[$right]);
            }
        }
        return $this->trapped_water;
    }


}
