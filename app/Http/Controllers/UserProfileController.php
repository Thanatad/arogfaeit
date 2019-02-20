<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\User;
use App\Profile;
use DB;
use Illuminate\Http\Request;
use Validator;
use Redirect;
class UserProfileController extends Controller
{
    public function index()
    {
        $user_id = Auth::User()->id;

        $check = DB::table('users')->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->where(['user_profiles.user_id' => $user_id])
            ->count();
        if ($check == 1) {
            $profile = DB::table('users')->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->select('users.id', 'users.full_name', 'users.role', 'users.email', 'users.created_at', 'user_profiles.user_id', 'user_profiles.dob', 'user_profiles.sex', 'user_profiles.site', 'user_profiles.province', 'user_profiles.address', 'user_profiles.mobile')
            ->where(['user_profiles.user_id' => $user_id])
            ->first();
        } else {
            Profile::create(['user_id' => $user_id]);
            $profile = User::where('id', '=', $user_id)->first();
        }

        return view('back.userprofile')->with(['profile' => $profile]);
    }

    public function update(Request $request, $id)
    {

        if ($request->hasFile('avatar')) {

            $rules = array(
                'avatar' => 'mimes:jpeg,jpg,png,gif|required|max:5000',
            );
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $fileContents = $request->file('avatar');
            Image::make($fileContents)->resize(300, 300)->save(public_path('/upload/images/profile/'.$id.'.jpg'));
            $imageUrl = $id.'.jpg';
        }

        $user = User::find($id);
        $user = User::where('id', $id)->first();
        $user->full_name = $request->input('full_name');
        if ($request->hasFile('avatar')) {
            $user->base_avatar = $imageUrl;
        }

        if ($user->save()) {
            $profile = Profile::where('user_id', '=', $id)->first();
            $profile->dob = $request->input('dob');
            $profile->sex = $request->input('sex');
            $profile->site = $request->input('site');
            $profile->province = $request->input('province');
            $profile->address = $request->input('address');
            $profile->mobile = $request->input('mobile');
        }

        $profile->save();

        return redirect()->action('UserProfileController@index')->with('success', trans('messes.profile.update.success'));
    }
}
