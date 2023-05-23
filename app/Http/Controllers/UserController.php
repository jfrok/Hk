<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function updateProfile(ProfileUpdateRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->job = $request->input('job');
        $user->city = $request->input('city');
        $user->address = $request->input('address');
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    public function updateProfileSkills(Request $request)
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
    public function removeSkill($skillId)
    {
        // Find the skill by its ID
        $skill = Skill::find($skillId);
//dd($skill);
        // Check if the skill exists
        if ($skill) {
            // Delete the skill
            $skill->delete();

            return back()->with('message', 'Skill removed successfully');
        }

        return back()->with('message', 'Skill not found', 404);
    }
}
