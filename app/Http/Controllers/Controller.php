<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Event;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;

class Controller extends BaseController
{
    public function dashboard()
    {
        $projects = Project::orderBy('created_at', 'DESC')->paginate(10);
        $events = Event::orderBy('dateFrom', 'DESC')->where('dateFrom', '>=', Carbon::now()->format('Y-m-d'))->paginate(10);
        $totalEvents = Event::count();
        $totalProjects = Project::count();
        $period = \Carbon\CarbonPeriod::create('2023-05-25', Carbon::today());

        $p = [];
        $count = [];
        // If you want just dates
        // Iterate over the period and create push to array
        foreach ($period as $date) {
            array_push($p, $date->format('Y-m-d'));
        }

        foreach ($p as $pd){
            if (Project::whereDate('created_at', \Carbon\Carbon::parse($pd))->count() > 0 || !\Carbon\Carbon::parse($pd)->isFuture()){
                array_push($count,  Project::whereDate('created_at', \Carbon\Carbon::parse($pd))->count());
            }else{
                array_push($count,  0);
            }
}

        return inertia('Dashboard', [
            'p' => $p,
            'count' => $count,
            'projects' => $projects,
            'events' => $events,
            'totalEvents' => $totalEvents,
            'totalProjects' => $totalProjects
        ]);
    }

    use AuthorizesRequests, ValidatesRequests;
    public function trash()
    {
        $trashed = Project::onlyTrashed()->get();
        return inertia('Trash',[
            'trashed' => $trashed
        ]);
    }
    public function forceDelete($pId)
    {
        $project = Project::onlyTrashed()->find($pId);
        $content = Content::onlyTrashed()->where('project_id',$pId);
        if ($project == true){
            $project->forceDelete();
            $content->forceDelete();
        }
        return back()->with('error','The project has been permanently deleted');
    }
    public function restore($pId)
    {
        $project =  Project::onlyTrashed()->find($pId);
        $content = Content::onlyTrashed()->where('project_id',$pId);
        if ($project == true){
            $project->restore();
            $content->restore();
        }
        return back()->with('warning','The project has been restored');
    }
    public function groupDelete(Request $request)
    {
       // dd($request->all());
        if ($request->checkIfAllSelected === true) {
            $allProjectSelected = Project::onlyTrashed();
            // dd($allContentSelected);
            if ($allProjectSelected->count() > 0) {
                $allProjectSelected->forceDelete();
                return back()->with('error', 'The content has been permanently deleted');
            }
        }
        $projects = Project::onlyTrashed()->whereIn('id',$request->checkIfAllSelected == false ? $request->pIds : '');
        $contents = Content::withTrashed()->whereIn('project_id',$request->checkIfAllSelected == false ? $request->pIds : '');
        if ($projects->count() > 0){
            $projects->forceDelete();
            if ($contents->count() > 0) {
                $contents->forceDelete();
            }
            return back()->with('error','The content has been permanently deleted');
        }else{
            return back()->with('error','No content selected');

        }
    }
    public function steamApiTest(Request $request){
//        $request->steamKey = ;
//        $request->steamId = ;
//
        return redirect('https://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key='.$request->steamKey.'&steamid='.$request->steamId.'&format=json');
    }
}
