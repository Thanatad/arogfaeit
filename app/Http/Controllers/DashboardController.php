<?php

namespace App\Http\Controllers;

use App\Event;
use App\Favorite;
use App\User;
use App\UserEvent;
use Carbon\Carbon;
use Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $events = UserEvent::count();
        $join = Favorite::count();

        $jointopuser = Favorite::selectRaw("user_id,count(user_id) as most")
            ->groupBy('user_id')
            ->orderBy('most', 'DESC')
            ->first();
        $jointopevent = Favorite::selectRaw("event_id,count(event_id) as most")
            ->groupBy('event_id')
            ->orderBy('most', 'DESC')
            ->first();
        $userjoin = User::select('full_name')
            ->where('id', $jointopuser->user_id)
            ->first();
        $eventjoin = Event::select('name')
            ->where('id', $jointopevent->event_id)
            ->first();
        $eactive = UserEvent::join('events', 'events.id', 'user_events.event_id')
            ->select('events.id', 'events.end')
            ->where('events.end', '>=', date('Y-m-d'))
            ->count();
        $eexp = UserEvent::join('events', 'events.id', 'user_events.event_id')
            ->select('events.id', 'events.end')
            ->where('events.end', '<', date('Y-m-d'))
            ->count();

        if (Request::ajax()) {
            $ebyy = UserEvent::join('events', 'events.id', 'user_events.event_id')
                ->select('events.id', 'events.start')
                ->whereYear('events.start', date('Y'))
                ->get()
                ->groupBy(function ($date) {
                    //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                    return Carbon::parse($date->start)->format('m'); // grouping by months
                });

            $eventmcount = [];
            $eventArr = [];

            foreach ($ebyy as $key => $value) {
                $eventmcount[(int) $key] = count($value);
            }

            for ($i = 1; $i <= 12; $i++) {
                if (!empty($eventmcount[$i])) {
                    $eventArr[$i] = $eventmcount[$i];
                } else {
                    $eventArr[$i] = 0;
                }
            }

            return response()->json(['success' => true, 'eventArr' => $eventArr]);

        }
        return view('back.dashboard')->with(['users' => $users, 'events' => $events, 'eactive' => $eactive, 'eexp' => $eexp, 'join' => $join, 'userjoin' => $userjoin->full_name, 'eventjoin' => $eventjoin->name]);
    }
}
