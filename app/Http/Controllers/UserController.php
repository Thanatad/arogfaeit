<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use DB;
use Gate;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if (!Gate::allows('isAdmin')) {
            abort(404);
        }

        $users = User::leftjoin('user_profiles', 'users.id', '=', 'user_profiles.user_id')
        ->select('users.id', 'users.full_name', 'users.base_avatar', 'users.role', 'users.email', 'users.acc_type', 'users.created_at', 'user_profiles.dob', 'user_profiles.sex', 'user_profiles.site', 'user_profiles.province', 'user_profiles.address', 'user_profiles.mobile')
        ->get();

        /*
        $users = DB::table('users')->leftjoin('user_profiles','users.id','=','user_profiles.user_id')
        ->select('users.id','users.full_name','users.base_avatar','users.role','users.email','users.acc_type','users.created_at','user_profiles.dob','user_profiles.sex','user_profiles.site','user_profiles.province','user_profiles.address','user_profiles.mobile')
        ->get();
        */
        return view('back.user')->with(['users' => $users]);
    }

    public function update(Request $request)
    {
        $chk = Profile::where('user_id', '=', $request->id)->count();
        if ($chk != 0) {
            $user = User::find($request->id);
            $user->full_name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->acc_type = $request->acc_type;
            if ($user->save()) {
                $profile = Profile::where('user_id', '=', $request->id)->first();
                $profile->province = $request->province;
                $profile->address = $request->address;
                $profile->mobile = $request->mobile;
                $profile->save();
            }

            return response()->json(['status' => 1, 'user' => $user, 'profile' => $profile]);
        } else {
            $user = User::find($request->id);
            $user->full_name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->acc_type = $request->acc_type;
            $user->save();

            return response()->json(['status' => 0, 'user' => $user]);
        }
    }

    public function delete(Request $request)
    {
        $chk = Profile::where('user_id', '=', $request->id)->count();
        if ($chk != 0) {
            User::join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->where('user_profiles.user_id', '=', $request->id)->forceDelete();

            return response()->json();
        } else {
            User::find($request->id)->delete();

            return response()->json();
        }
    }
}
