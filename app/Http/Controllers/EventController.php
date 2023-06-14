<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request)
    {

        $events = Event::where('userId',Auth::id())->get();
        $date = $request->input('date');
        return inertia('Calendar/Overview',  [
            'date' => $date,
            'events' => $events->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'dateFrom' => $event->dateFrom,
                    'dateTo' => $event->dateTo,
                ];

            })

        ]);

    }
    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required|max:2048',
            'dateFrom' => 'required|max:148',
        ]);
       //  dd($request->all());
        $new = new Event();
        $new->userId = Auth::id();
        $new->title = $request->title;
        $new->dateFrom = $request->dateFrom;
        $new->dateTo = $request->dateTo;
        $new->timeFrom = $request->timeFrom;
        if (!is_null($request->timeFrom) && is_null($request->timeTo)) {
            $startTime = \Carbon\Carbon::parse($request->timeFrom)->format('H:i');
            $endTime = \Carbon\Carbon::parse($startTime)->addHour()->format('H:i');
            $request->merge(['timeTo' => $endTime]);
        } else {
            $request->merge(['timeTo' => $request->timeTo]);
        }
        $new->timeTo = $request->timeTo;
        $new->save();
        return to_route('calendar.overview');
    }
    public function update($eId,Request $request)
    {
       // dd($request->all());
        $update = Event::find($eId);
        $update->title = $request->title;
        $update->dateFrom = $request->dateFrom;
       $request->dateTo == 'Invalid date' ? $update->dateTo = null : $update->dateTo = $request->dateTo;

        $update->timeFrom = $request->timeFrom;
        if (!is_null($request->timeFrom) && is_null($request->timeTo)) {
            $startTime = \Carbon\Carbon::parse($request->timeFrom)->format('H:i');
            $endTime = \Carbon\Carbon::parse($startTime)->addHour()->format('H:i');
            $request->merge(['timeTo' => $endTime]);
        } else {
            $request->merge(['timeTo' => $request->timeTo]);
        }
        $update->timeTo = $request->timeTo;
        $update->save();
        return to_route('calendar.overview');
    }
    public function remove($eId)
    {
        Event::find($eId)->delete();
    }
    public function getEvents(){
        $events = Event::where('userId',Auth::id())->get();
        return response()->json(['events' => $events]);
    }
}
