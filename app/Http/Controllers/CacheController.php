<?php

namespace App\Http\Controllers;

use App\Models\LogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\ActionsModel;

class CacheController extends Controller
{
    public string $cacheKey = 'trapped_water_';

    public function __construct($heights)
    {
        $this->cacheKey .= implode('_',$heights);
    }

    public function checkCache()
    {
        if (Cache::has($this->cacheKey)) {
            $action = ActionsModel::getActionHit();
        } else {
            $action = ActionsModel::getActionMiss();
        }
        $this->createRecordLogDependOnAction($action);
        return $action;
    }

    private function createRecordLogDependOnAction(string $action) : void
    {
        if ($action == ActionsModel::getActionHit()) {
            Log::channel('trapped_water_log')
                ->info('Cache hit for key: ' . $this->cacheKey);
        } else {
            Cache::put($this->cacheKey, 'Cache hit', 60);
            Log::channel('trapped_water_log')
                ->info('Cache miss for key: ' . $this->cacheKey);
        }
    }
}
