<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function updateProfile(Request $request)
    {
        $chips = $request->input('chips', []); // Get the chips array from the request

        // Store each chip in the database
        foreach ($chips as $chip) {
            Skill::updateOrCreate([
                'name' => $chip,
                'userId' => Auth::id()
            ]);
        }
    }
}
