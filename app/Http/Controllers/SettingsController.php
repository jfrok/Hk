<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Inertia\Inertia;

class SettingsController extends Controller
{
    //
    public function settings()
    {
        $apiRoutes = collect();
        $apiRoutesNames = [];
        foreach (Route::getRoutes() as $route) {
            if ($route->action['prefix'] !== 'api') {
                continue;
            }
            $apiRoutes->push($route);
            $apiRoutesNames[] = $route;
        }

        $apiRoutesNames = array_filter($apiRoutesNames);
        $apiToken = Setting::where('id',1)->first();
        return inertia('Settings/Index',[
            'apiRoutes' => $apiRoutesNames,
            'apiToken' => $apiToken
        ]);
    }
    public function changeToken(Request $request)
    {
        $update = Setting::where('id',1)->first();
        $update->api_token = $request->token;
        $update->save();
    }
}
