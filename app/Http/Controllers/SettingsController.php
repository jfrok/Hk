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
        $settings = Setting::where('userId',Auth::id())->first();
        return inertia('Settings/Overview',[
            'apiRoutes' => $apiRoutesNames,
            'settings' => $settings
        ]);
    }
    public function changeToken(Request $request)
    {
        $request->validate([
            'api_token' => 'required|unique:users|max:145' ,

        ],
        [
            'api_token.unique' => 'Some thing wrong rest the token ones again'
        ]);
        $update = Setting::where('userId',Auth::id())->first();
        $update->api_token = $request->token;
        $update->save();
    }
    public function updateEvents(Request $request)
    {
        $request->validate([
            'sendReminders' => 'nullable|boolean|max:4',
            'sendBefore' => 'nullable|integer|max:30',
//            'sendTime' => 'nullable|date_format:H:i',
        ]);
        $update = Setting::where('userId',Auth::id())->first();
//        dd($update);
        $update->sendRemainders = $request->boolean('sendReminders');
       $update->sendBefore = $request->sendBefore;
//       $update->sendAt = $request->sendTime;
       $update->save();

    }
}
