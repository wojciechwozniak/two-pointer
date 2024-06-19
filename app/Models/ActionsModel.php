<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionsModel
{
    private static $actionHit = 'hit';
    private static $actionMiss = 'miss';

    public static function getActionHit()
    {
        return self::$actionHit;
    }
    public static function getActionMiss()
    {
        return self::$actionMiss;
    }
}
