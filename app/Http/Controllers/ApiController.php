<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function projects($token)
    {
        $setting = Setting::where('api_token', $token)->first();
        // dd($setting);
        if ($setting) {

            $project = Project::all()->toArray();
            return response()->json(['projects' => $project]);
        } else {
            return response()->json(['error' => 'Invalid token'], 401); // HTTP status code 401: Unauthorized
        }
    }

    public function content($slug, $token)
    {
        $setting = Setting::where('api_token', $token)->first();
        // dd($setting);
        if ($setting) {
            $content = Content::select('contents.*')
                ->join('projects', 'contents.project_id', '=', 'projects.id')
                ->where('projects.slug', $slug)
                ->orderBy('sort')->get()->toArray();
            return response()->json(['content' => $content]);
        } else {
            return response()->json(['error' => 'Invalid token'], 401); // HTTP status code 401: Unauthorized
        }
    }

    public function personalDetails($token)
    {
        $setting = Setting::where('api_token', $token)->first();

        if ($setting) {
            $user = User::find(20);
            $userDetails = $user->only(['name', 'email', 'city', 'address', 'job', 'description']);
            $skills = $user->skills->pluck('name');

            return response()->json([
                'personalDetails' => [
                    'user' => $userDetails,
                    'skills' => $skills
                ]
            ]);
        } else {
            return response()->json(['error' => 'Invalid token'], 401);
        }
    }
}
