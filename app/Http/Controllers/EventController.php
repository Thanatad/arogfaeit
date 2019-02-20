<?php

namespace App\Http\Controllers;

use App\Daylist;
use App\Event;
use App\Favorite;
use App\Location;
use App\User;
use App\UserEvent;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Image;
use Validator;
use Redirect;
class EventController extends Controller
{
    public function e_index()
    {
        if (!(Gate::allows('isAdmin') or Gate::allows('isUser'))) {
            abort(404);
        }

        $profile = User::leftjoin('user_profiles', 'users.id', 'user_profiles.user_id')
            ->where('users.id', Auth::User()->id)
            ->select('user_profiles.mobile', 'users.email')
            ->first();

        $daylist = Daylist::select('name')->where('type', 'วันหยุดราชการ')->distinct()->get();
        return view('back.event')->with(['profile' => $profile, 'daylists' => $daylist]);

    }

    public function v_index()
    {
        if (!(Gate::allows('isAdmin') or Gate::allows('isUser'))) {
            abort(404);
        }

        $userID = Auth::User()->id;
        $events = UserEvent::join('events', 'events.id', 'user_events.event_id')
            ->join('locations', 'locations.id', 'user_events.location_id')
            ->select('user_events.id AS ueid', 'locations.id AS lid', 'events.id AS eid', 'user_events.destroy', 'user_events.created_at', 'events.name', 'events.short_des', 'events.description', 'events.budget', 'events.count_day', 'events.day', 'events.start', 'events.end', 'events.timestart', 'events.mobile', 'events.email', 'events.highlight', 'events.hashtag', 'events.picture', 'events.assign', 'locations.place_name', 'locations.place_des', 'locations.district', 'locations.zipcode', 'locations.province', 'locations.amphoe', 'locations.road', 'locations.more_address', 'locations.lat', 'locations.lon')
            ->where('user_events.destroy', 0)
            ->where('user_events.user_id', $userID)
            ->orderBy('user_events.created_at', 'DESC')
            ->paginate(4);

        $daylist = Daylist::select('name')->distinct()->get();

        if ($events->isEmpty()) {
            return redirect()->action('EventController@e_index')->with('failure', trans('messes.event.list.empty'));
        }

        return view('back.eventview')->with(['events' => $events, 'daylists' => $daylist]);
    }

    public function em_index()
    {
        $events = UserEvent::join('events', 'events.id', 'user_events.event_id')
            ->join('locations', 'locations.id', 'user_events.location_id')
            ->join('users', 'users.id', 'user_events.user_id')
            ->select('users.full_name', 'user_events.id AS ueid', 'locations.id AS lid', 'events.id AS eid', 'user_events.destroy', 'user_events.created_at', 'events.name', 'events.short_des', 'events.description', 'events.budget', 'events.count_day', 'events.day', 'events.start', 'events.end', 'events.timestart', 'events.mobile', 'events.email', 'events.highlight', 'events.hashtag', 'events.picture', 'events.assign', 'locations.place_name', 'locations.place_des', 'locations.district', 'locations.zipcode', 'locations.province', 'locations.amphoe', 'locations.road', 'locations.more_address', 'locations.lat', 'locations.lon')
            ->orderBy('user_events.created_at', 'DESC')
            ->get();

        $daylist = Daylist::select('name')->distinct()->get();

        return view('back.eventmanage')->with(['events' => $events, 'daylists' => $daylist]);
    }

    public function ej_index()
    {

        $favorite = Favorite::join('events', 'events.id', 'favorites.event_id')
->join('user_events','user_events.event_id','events.id')
            ->select('favorites.id as fid', 'events.id as eid','user_events.id as ueid', 'favorites.created_at', 'events.name', 'events.count_day', 'events.day', 'events.start', 'events.end', 'events.picture')
            ->where('favorites.user_id', Auth::User()->id)
            ->get();

        return view('back.favorite')->with(['favorite' => $favorite]);

    }

    public function create(Request $request)
    {
        $highlight = substr(str_replace(array('["', '"]'), '', json_encode($request->input('highlight'), JSON_UNESCAPED_UNICODE)), 0);
        $hashtag = substr(str_replace(array('["', '"]'), '', json_encode($request->input('hashtag'), JSON_UNESCAPED_UNICODE)), 0);

        $event = new Event();
        $event->name = $request->input('txt_event');
        $event->short_des = $request->input('txt_short_des');
        $event->description = $request->input('txt_description');
        $event->budget = $request->input('numb_budget');
        $event->count_day = $request->input('numb_c_day');
        $event->day = $request->input('daylist');
        $event->start = $request->input('date_start');
        $event->end = $request->input('date_end');
        $event->timestart = $request->input('time_start');
        $event->mobile = $request->input('txt_phone');
        $event->email = $request->input('txt_email');
        $event->highlight = $highlight;
        $event->hashtag = $hashtag;
        if ($event->save()) {
            if ($request->hasFile('eimage')) {
                $rules = array(
                    'eimage' => 'mimes:jpeg,jpg,png,gif|required|max:5000',
                );
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
                }
                $fileContents = $request->file('eimage');
                Image::make($fileContents)->resize(1280, 720)->save(public_path('/upload/images/event/' . $event->id . '.jpg'));
                $imageUrl = $event->id . '.jpg';
                $event->picture = $imageUrl;
                $event->save();
            }
            $location = new Location();
            $location->place_name = $request->input('txt_place');
            $location->place_des = $request->input('txt_describe_place');
            $location->district = $request->input('txt_district');
            $location->zipcode = $request->input('txt_zipcode');
            $location->province = $request->input('txt_province');
            $location->amphoe = $request->input('txt_amphoe');
            $location->road = $request->input('txt_road');
            $location->more_address = $request->input('txt_address');
            $location->lat = $request->input('lat');
            $location->lon = $request->input('lon');
            if ($location->save()) {
                $e_create = new UserEvent();
                $e_create->user_id = Auth::User()->id;
                $e_create->event_id = $event->id;
                $e_create->location_id = $location->id;
                if ($e_create->save()) {
                    return redirect()->action('EventController@e_index')->with('success', trans('messes.event.create.success'));
                }
            }
        }
    }

    public function update(Request $request)
    {
      
        
        if ($request->ajax()) {
            $highlight = substr(str_replace(array('["', '"]', '"'), '', json_encode($request->get('highlight'), JSON_UNESCAPED_UNICODE)), 0);
            $hashtag = substr(str_replace(array('["', '"]', '"'), '', json_encode($request->get('hashtag'), JSON_UNESCAPED_UNICODE)), 0);
            $eid = $request->get('id_event');
            $current = $request->get('pcurrent');
            if ($request->hasFile('eimage')) {
                $rules = array(
                    'eimage' => 'mimes:jpeg,jpg,png,gif|required|max:5000',
                );
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['success' => false,]);
                }
                $fileContents = $request->file('eimage');
                Image::make($fileContents)->resize(1280, 720)->save(public_path('/upload/images/event/' . $eid . '.jpg'));
                $imageUrl = $eid . '.jpg';
            }
            $event = Event::find($eid);
            $event->name = $request->get('txt_event');
            $event->short_des = $request->get('txt_short_des');
            $event->description = $request->get('txt_description');
            $event->budget = $request->get('numb_budget');
            $event->count_day = $request->get('numb_c_day');
            $event->day = $request->get('daylist');
            $event->start = $request->get('date_start');
            $event->end = $request->get('date_end');
            $event->timestart = $request->get('time_start');
            $event->mobile = $request->get('txt_phone');
            $event->email = $request->get('txt_email');
            if (!(Gate::allows('isAdmin') or Gate::allows('isExpert'))) {
                $event->assign = 0;
            }
            $event->highlight = $highlight;
            $event->hashtag = $hashtag;
            if ($request->hasFile('eimage')) {
                $event->picture = $imageUrl;
            }
            if ($event->save()) {
                $location = Location::find($request->get('id_location'));
                $location->place_name = $request->get('txt_place');
                $location->place_des = $request->get('txt_describe_place');
                $location->district = $request->get('txt_district');
                $location->zipcode = $request->get('txt_zipcode');
                $location->province = $request->get('txt_province');
                $location->amphoe = $request->get('txt_amphoe');
                $location->road = $request->get('txt_road');
                $location->more_address = $request->get('txt_address');
                $location->lat = $request->get('lat');
                $location->lon = $request->get('lon');
                if ($location->save()) {
                    if ($request->get('page') == 'view') {
                        $userID = Auth::User()->id;
                        if ($current == '') {
                            $events = UserEvent::JOIN('events', 'events.id', 'user_events.event_id')
                                ->JOIN('locations', 'locations.id', 'user_events.location_id')
                                ->SELECT('user_events.id AS ueid', 'locations.id AS lid', 'events.id AS eid', 'user_events.destroy', 'user_events.created_at', 'events.name', 'events.short_des', 'events.description', 'events.budget', 'events.count_day', 'events.day', 'events.start', 'events.end', 'events.timestart', 'events.mobile', 'events.email', 'events.highlight', 'events.hashtag', 'events.picture', 'events.assign', 'locations.place_name', 'locations.place_des', 'locations.district', 'locations.zipcode', 'locations.province', 'locations.amphoe', 'locations.road', 'locations.more_address', 'locations.lat', 'locations.lon')
                                ->WHERE('user_events.destroy', 0)
                                ->WHERE('user_events.user_id', $userID)
                                ->orderBy('user_events.created_at', 'DESC')
                                ->paginate(4);
                        } else {
                            $events = UserEvent::JOIN('events', 'events.id', 'user_events.event_id')
                                ->JOIN('locations', 'locations.id', 'user_events.location_id')
                                ->SELECT('user_events.id AS ueid', 'locations.id AS lid', 'events.id AS eid', 'user_events.destroy', 'user_events.created_at', 'events.name', 'events.short_des', 'events.description', 'events.budget', 'events.count_day', 'events.day', 'events.start', 'events.end', 'events.timestart', 'events.mobile', 'events.email', 'events.highlight', 'events.hashtag', 'events.picture', 'events.assign', 'locations.place_name', 'locations.place_des', 'locations.district', 'locations.zipcode', 'locations.province', 'locations.amphoe', 'locations.road', 'locations.more_address', 'locations.lat', 'locations.lon')
                                ->WHERE('user_events.destroy', 0)
                                ->WHERE('user_events.user_id', $userID)
                                ->orderBy('user_events.created_at', 'DESC')
                                ->paginate(4, ['*'], 'page', $current);
                        }

                        $return = view('components.eventview-item', ['events' => $events])->render();

                        return response()->json(['success' => true, 'html' => $return, 'status' => 'view']);
                    } else {
                        $events = UserEvent::JOIN('events', 'events.id', 'user_events.event_id')
                            ->JOIN('locations', 'locations.id', 'user_events.location_id')
                            ->JOIN('users', 'users.id', 'user_events.user_id')
                            ->SELECT('user_events.id AS ueid', 'locations.id AS lid', 'events.id AS eid', 'users.full_name', 'user_events.destroy', 'user_events.created_at', 'events.name', 'events.short_des', 'events.description', 'events.budget', 'events.count_day', 'events.day', 'events.start', 'events.end', 'events.timestart', 'events.mobile', 'events.email', 'events.highlight', 'events.hashtag', 'events.picture', 'events.assign', 'locations.place_name', 'locations.place_des', 'locations.district', 'locations.zipcode', 'locations.province', 'locations.amphoe', 'locations.road', 'locations.more_address', 'locations.lat', 'locations.lon')
                            ->where('user_events.event_id', $eid)
                            ->first();

                        return response()->json(['success' => true, 'event' => $events, 'status' => 'manage']);
                    }
                }
            }
        }
    }

    public function change(Request $request)
    {
        if ($request->ajax()) {
            $eid = $request->id;

            if ($request->status == 'assign') {
                $assign = Event::find($eid);
                $assign->assign = $request->data;
                $assign->save();
            } else {
                UserEvent::where('event_id', $eid)->update(['destroy' => $request->data]);
            }

            return response()->json(['success' => true]);
        }
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            if ($request->page == 'view') {
                UserEvent::find($request->id)->update(['destroy' => 1]);
            } else {
                Event::join('user_events', 'user_events.event_id', 'events.id', '')
                    ->where('user_events.id', $request->id)
                    ->forceDelete();
            }

            return response()->json(['page' => $request->page, 'id' => $request->id]);
        }
    }

    public function daylist(Request $request)
    {
        $daylist = Daylist::select('name')->where('type', $request->type)->distinct()->get();

        $return = view('components.daylists-item', ['daylists' => $daylist])->render();

        return response()->json(['success' => true, 'html' => $return]);
    }

    public function event_list(Request $data)
    {

        if ($data->ajax()) {

            $lastdate = date('Y-m-d');
            $ope = '1';

            if ($data->numbday == 4) {
                $ope = '2';
            }

            $events = UserEvent::join('events', 'events.id', 'user_events.event_id')
                ->join('locations', 'locations.id', 'user_events.location_id')
                ->select('user_events.id AS ueid', 'locations.id AS lid', 'events.id AS eid', 'user_events.destroy', 'user_events.created_at', 'events.name', 'events.short_des', 'events.description', 'events.budget', 'events.count_day', 'events.day', 'events.start', 'events.end', 'events.timestart', 'events.mobile', 'events.email', 'events.highlight', 'events.hashtag', 'events.picture', 'events.assign', 'locations.place_name', 'locations.place_des', 'locations.district', 'locations.zipcode', 'locations.province', 'locations.amphoe', 'locations.road', 'locations.more_address', 'locations.lat', 'locations.lon')
                ->where('user_events.destroy', 0)
                ->where('events.assign', 1)
                ->when(!empty($data->numbday) && $data->numbday != 0 && $ope == 1, function ($query) use ($data) {
                    return $query->where('count_day', $data->numbday);
                })
                ->when(!empty($data->numbday) && $data->numbday != 0 && $ope == 2, function ($query) use ($data) {
                    return $query->where('count_day', '>=', $data->numbday);
                })
                ->when(!empty($data->province), function ($query) use ($data) {
                    return $query->where('locations.province', $data->province);
                })
                ->when(!empty($data->startdate) && !empty($data->enddate), function ($query) use ($data) {
                    return $query->WhereBetween('start', [$data->startdate, $data->enddate]);
                })
                ->when(!empty($data->day), function ($query) use ($data) {
                    return $query->where('events.day', $data->day);
                })
                ->where('events.end', '>=', $lastdate)
                ->orderBy('events.start', 'ASC')
                ->skip($data->start)
                ->take($data->limit)
                ->get();

            $return = view('components.eventindex-item', ['events' => $events])->render();
            return response()->json(['success' => true, 'html' => $return]);
        }
    }

    public function event_map(Request $data)
    {
        if ($data->ajax()) {

            $lastdate = date('Y-m-d');
            $ope = '1';

            if ($data->numbday == 4) {
                $ope = '2';
            }

            $events = UserEvent::join('events', 'events.id', 'user_events.event_id')
                ->join('locations', 'locations.id', 'user_events.location_id')
                ->select('user_events.id AS ueid', 'locations.id AS lid', 'events.id AS eid', 'user_events.destroy', 'user_events.created_at', 'events.name', 'events.short_des', 'events.count_day', 'events.day', 'events.start', 'events.end', 'events.timestart', 'events.mobile', 'events.email', 'events.picture', 'events.assign', 'locations.place_name', 'locations.province', 'locations.lat', 'locations.lon')
                ->where('user_events.destroy', 0)
                ->where('events.assign', 1)
                ->when(!empty($data->numbday) && $data->numbday != 0 && $ope == 1, function ($query) use ($data) {
                    return $query->where('count_day', $data->numbday);
                })
                ->when(!empty($data->numbday) && $data->numbday != 0 && $ope == 2, function ($query) use ($data) {
                    return $query->where('count_day', '>=', $data->numbday);
                })
                ->when(!empty($data->province), function ($query) use ($data) {
                    return $query->where('locations.province', $data->province);
                })
                ->when(!empty($data->status) && $data->status == 1, function ($query) use ($lastdate) {
                    return $query->where('events.end', '>=', $lastdate);
                })
                ->when(!empty($data->status) && $data->status == 2, function ($query) use ($lastdate) {
                    return $query->where('events.end', '<', $lastdate);
                })
                ->when(!empty($data->startdate) && !empty($data->enddate), function ($query) use ($data) {
                    return $query->WhereBetween('start', [$data->startdate, $data->enddate]);
                })
                ->when(!empty($data->day), function ($query) use ($data) {
                    return $query->where('events.day', $data->day);
                })
                ->take($data->numbevent)
                ->orderBy('events.start', 'ASC')
                ->get();

            return response()->json(['success' => true, 'map' => $events]);
        }
    }

    public function event_detail($ueid)
    {

        if ((Gate::allows('isAdmin') or Gate::allows('isExprt'))) {
            $event = UserEvent::join('events', 'events.id', 'user_events.event_id')
                ->join('locations', 'locations.id', 'user_events.location_id')
                ->join('users', 'users.id', 'user_events.user_id')
                ->select('user_events.id AS ueid', 'locations.id AS lid', 'events.id AS eid', 'users.full_name', 'user_events.destroy', 'user_events.created_at', 'events.name', 'events.short_des', 'events.description', 'events.budget', 'events.count_day', 'events.day', 'events.start', 'events.end', 'events.timestart', 'events.mobile', 'events.email', 'events.highlight', 'events.hashtag', 'events.picture', 'events.assign', 'locations.place_name', 'locations.place_des', 'locations.district', 'locations.zipcode', 'locations.province', 'locations.amphoe', 'locations.road', 'locations.more_address', 'locations.lat', 'locations.lon')
                ->where('user_events.id', $ueid)
                ->first();
        }else{

        $event = UserEvent::join('events', 'events.id', 'user_events.event_id')
            ->join('locations', 'locations.id', 'user_events.location_id')
            ->join('users', 'users.id', 'user_events.user_id')
            ->select('user_events.id AS ueid', 'locations.id AS lid', 'events.id AS eid', 'users.full_name', 'user_events.destroy', 'user_events.created_at', 'events.name', 'events.short_des', 'events.description', 'events.budget', 'events.count_day', 'events.day', 'events.start', 'events.end', 'events.timestart', 'events.mobile', 'events.email', 'events.highlight', 'events.hashtag', 'events.picture', 'events.assign', 'locations.place_name', 'locations.place_des', 'locations.district', 'locations.zipcode', 'locations.province', 'locations.amphoe', 'locations.road', 'locations.more_address', 'locations.lat', 'locations.lon')
            ->where('user_events.id', $ueid)
            ->where('events.assign', 1)
            ->first();
        }

        if ($event== null) {
            abort(404);
        }
        
        $favorite = 0;
        if (Auth::User() != null) {
            $favorite = Favorite::where('user_id', Auth::User()->id)
                ->where('event_id', $event->eid)
                ->count();
        }
        $highlightraw = explode(',', $event->highlight);
        $highlight = [];
        foreach ($highlightraw as $data) {
            $highlight[] = $data;
        }

        $hashtagraw = explode(",", str_replace(["#"], "", $event->hashtag));
        $hashtag = [];
        foreach ($hashtagraw as $data) {
            $hashtag[] = $data;
        }

        return view('e-detail')->with(['event' => $event, 'highlight' => $highlight, 'hashtag' => $hashtag, 'favorite' => $favorite]);
        
    }

    public function join(Request $data)
    {
        if ($data->ajax()) {
            $favorite = new Favorite();
            $favorite->user_id = Auth::User()->id;
            $favorite->event_id = $data->eID;
            $favorite->save();

            return response()->json(['success' => true]);
        }
    }

    public function ejdelete(Request $data)
    {
        if ($data->ajax()) {
            Favorite::where('id', $data->fid)->delete();

            return response()->json(['success' => true]);
        }
    }
}
