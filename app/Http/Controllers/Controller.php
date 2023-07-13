<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Event;
use App\Models\Project;
use Carbon\Carbon;
use Carbon\Traits\Week;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

class Controller extends BaseController
{
    public function dashboard(Request $request)
    {
        $projects = Project::where('userId', Auth::id())->orderBy('created_at', 'DESC')->paginate(10);

        $past = $request->boolean('past');
        $upcoming = $request->boolean('upcoming');
        $closest = $request->boolean('closest');

        if ($past === true) {
            $upcoming = false;
            $closest = false;
        } elseif ($upcoming === true) {
            $past = false;
            $closest = false;
        } elseif ($closest === true) {
            $past = false;
            $upcoming = false;
        }

        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);
        $thisWeek = [
            'start' => $startOfWeek->format('Y-m-d'),
            'end' => $endOfWeek->format('Y-m-d'),
        ];

        $showMore = $request->query('showMore');

        //past keep it in mind
        $countNextEvent = Event::where('userId',Auth::id())
            ->when($past, function ($query){
              return  $query->where('dateFrom','<',Carbon::now());

            })
            ->when(!$past && !$upcoming && !$closest, function ($query){
               return $query->where('dateFrom','>',Carbon::now());

            })
            ->when($upcoming && !$past && !$closest, function ($query) {
                return $query->where('dateFrom', '>=', Carbon::now()->addWeek()->format('Y-m-d'));
            })
            ->when($closest && !$past && !$upcoming, function ($query) use ($thisWeek) {
                return $query->where(function ($query) use ($thisWeek) {
                    $query->whereBetween('dateFrom', [$thisWeek['start'], $thisWeek['end']]);
                });
            })
        ->skip($showMore ? $showMore : 10)->take(10)->get()->count();

//        $eventCounter = count(Event::where('userId',Auth::id())->where('dateFrom','>=',Carbon::now())->get());


        $events = Event::orderBy('dateFrom', $past ?? '' ? 'DESC' : 'ASC')
            ->where('userId', Auth::id())
            ->when(!$past && !$upcoming && !$closest, function ($query) {
                return $query->where('dateFrom', '>=', Carbon::now()->format('Y-m-d'));
            })
            ->when($past && !$upcoming && !$closest, function ($query) {
                return $query->where('dateFrom', '<', Carbon::now()->format('Y-m-d'));
            })
            ->when($upcoming && !$past && !$closest, function ($query) {
                return $query->where('dateFrom', '>=', Carbon::now()->addWeek()->format('Y-m-d'));
            })
            ->when($closest && !$past && !$upcoming, function ($query) use ($thisWeek) {
                return $query->where(function ($query) use ($thisWeek) {
                    $query->whereBetween('dateFrom', [$thisWeek['start'], $thisWeek['end']]);
                });
            })
            ->take($showMore ? $showMore : 10)->get();


        $counterTrueOrFalse = 0;


        if ($showMore >= $countNextEvent){
            //dd('yes reached max');
            $counterTrueOrFalse = 1;
        }
        $test = 0;
//        dd(count(Event::where('userId',Auth::id())->skip($showMore ? $showMore : 10)->take($showMore ? $showMore : 10)->get()));
//        if (){
//
//        }
//dd($countNextEvent);
        $totalEvents = Event::where('userId', Auth::id())->count();
        $totalProjects = Project::where('userId', Auth::id())->count();
//        dd(Auth::user()->created_at->format('Y-m-d') ?? '');
        $period = \Carbon\CarbonPeriod::create(Auth::user()->created_at->format('Y-m-d') ?? '2023-05-25', Carbon::today());

        $p = [];
        $count = [];
        $eventCount = [];
        // If you want just dates
        // Iterate over the period and create push to array
        foreach ($period as $date) {
            array_push($p, $date->format('Y-m-d'));
        }

        foreach ($p as $pd) {
            if (Project::where('userId', Auth::id())->whereDate('created_at', \Carbon\Carbon::parse($pd))->count() > 0 || !\Carbon\Carbon::parse($pd)->isFuture()) {
                array_push($count, Project::where('userId', Auth::id())->whereDate('created_at', \Carbon\Carbon::parse($pd))->count());
            } else {
                array_push($count, 0);
            }
        }
        foreach ($p as $pd) {
            if (Event::where('userId', Auth::id())->whereDate('created_at', \Carbon\Carbon::parse($pd))->count() > 0 || !\Carbon\Carbon::parse($pd)->isFuture()) {
                array_push($eventCount, Event::where('userId', Auth::id())->whereDate('created_at', \Carbon\Carbon::parse($pd))->count());
            } else {
                array_push($eventCount, 0);
            }
        }


        return inertia('Dashboard', [
            'p' => $p,
            'countNextEvent' => $countNextEvent,
            'counterTrueOrFalse' => $counterTrueOrFalse,
            'count' => $count,
            'eventCount' => $eventCount,
            'projects' => $projects,
            'events' => $events,
            'totalEvents' => $totalEvents,
            'totalProjects' => $totalProjects,

        ]);
    }

    use AuthorizesRequests, ValidatesRequests;

    public function trash()
    {
        $trashed = Project::onlyTrashed()->where('userId', Auth::id())->get();
        return inertia('Trash', [
            'trashed' => $trashed
        ]);
    }

    public function forceDelete($pId)
    {
        $project = Project::onlyTrashed()->find($pId);
        $content = Content::onlyTrashed()->where('project_id', $pId);
        if ($project == true) {
            $project->forceDelete();
            $content->forceDelete();
        }
        return back()->with('error', 'The project has been permanently deleted');
    }

    public function restore($pId)
    {
        $project = Project::onlyTrashed()->find($pId);
        $content = Content::onlyTrashed()->where('project_id', $pId);
        if ($project == true) {
            $project->restore();
            $content->restore();
        }
        return back()->with('warning', 'The project has been restored');
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
        $projects = Project::onlyTrashed()->whereIn('id', $request->checkIfAllSelected == false ? $request->pIds : '');
        $contents = Content::withTrashed()->whereIn('project_id', $request->checkIfAllSelected == false ? $request->pIds : '');
        if ($projects->count() > 0) {
            $projects->forceDelete();
            if ($contents->count() > 0) {
                $contents->forceDelete();
            }
            return back()->with('error', 'The content has been permanently deleted');
        } else {
            return back()->with('error', 'No content selected');

        }
    }

    public function PrivacyPolicy()
    {
        return \inertia('Privacy_policy');
    }

}
