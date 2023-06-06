<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
        $apiToken = Setting::where('userId',Auth::id())->first();
        return inertia('Settings/Overview',[
            'apiRoutes' => $apiRoutesNames,
            'apiToken' => $apiToken
        ]);
    }
    public function changeToken(Request $request)
    {
        $update = Setting::where('userId',Auth::id())->first();
        $update->api_token = $request->token;
        $update->save();
    }
}
