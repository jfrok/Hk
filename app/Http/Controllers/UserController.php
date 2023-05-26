<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    //
 public function accounts(){
     return Inertia::render('Accounts/Index');
 }
    public function updateProfile(ProfileUpdateRequest $request)
    {
       // dd($request->all());
        if ($request->file('img') != null){

            $imageName = $request->file('img')->getClientOriginalName();
        }
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->job = $request->input('job');
        $user->city = $request->input('city');
        $user->address = $request->input('address');
        $user->description = $request->input('description');
        if ($request->file('img') != null) {
            $user->avatar = '/img/cases/' . $imageName ?? $request->img;
        }
        $user->save();
        if ($request->file('img') != null) {
            $request->img->move(public_path('/img/avatar'), $imageName);
        }
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
    public function createAccount(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'img' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
        ]);
        $imageName = null;
        if ($request->img !== null) {
            $imageName = $request->img->getClientOriginalName();
            $request->img->move(public_path('/img/avatar'), $imageName);
        }
        $user = new User();
        $user->subscription_end_date = now()->addMonths(1); // Set the end date to one month from now
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->job = $request->job;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->description = $request->description;
        if ($imageName !== null) {
            $user->avatar = '/img/avatar/' . $imageName;
        }
        $user->save();
        return redirect()->route('dashboard')->with('success', 'Account created successfully.');
    }
}
