<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogModel extends Model
{
    use HasFactory;

    public function createLog(string $action, array $heights, int $trapped_water){
        $log = new LogModel();
        $log->action = 'miss';
        $log->query = json_encode($heights);
        $log->response = $trapped_water;
        $log->save();
    }
}
