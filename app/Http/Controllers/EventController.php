<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return inertia('Calendar/Index', [
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
       //  dd($request->all());
        $new = new Event();
        $new->title = $request->title;
        $new->dateFrom = $request->dateFrom;
        $new->dateTo = $request->dateTo;
        $new->timeFrom = $request->timeFrom;
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
        $update->dateTo = $request->dateTo;
        $update->timeFrom = $request->timeFrom;
        $update->timeTo = $request->timeTo;
        $update->save();
        return to_route('calendar.overview');
    }
    public function remove($eId)
    {
        Event::find($eId)->delete();
    }
    public function getEvents(){
        $events = Event::all();
        return response()->json(['events' => $events]);
    }
}
