<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Menu;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public static function getMenu()
    {
        $menu = Menu::all();
        return $menu;
    }
    public static function cutString(string $line, int $length = 12, string $appends = '...'): string
    {

        if (mb_strlen($line) > $length) {
            $line = mb_substr($line, 0, $length) . $appends;
        }

        return $line;
    }
}
