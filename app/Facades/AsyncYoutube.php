<?php
/**
 * Created by IntelliJ IDEA.
 * User: iraklid
 * Date: 24/10/2019
 * Time: 00:44
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AsyncYoutube extends Facade
{
    protected static function getFacadeAccessor() { return 'App\Youtube\AsyncYoutube'; }
}
