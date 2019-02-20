<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Socialite, Auth, Hash;
use App\User;
use Illuminate\Http\Request;
use Image;
class SociaAuthController extends Controller
{

    public function redirectToGoogleProvider(){
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderGoogleCallback()
    {
        $auth_user = Socialite::driver('google')->stateless()->user();

        if(!empty($auth_user->getAvatar())){
            $fileContents = file_get_contents($auth_user->getAvatar());
            Image::make($fileContents)->resize(300,300)->save(public_path('/upload/images/profile/'. $auth_user->getId() . ".jpg"));
        }

        $imageUrl = $auth_user->getId() . ".jpg";

        if(!User::where('email',$auth_user->getEmail())->where('acc_type','google')->first()){
        $user = User::create([
        'email' => $auth_user->getEmail(),
        'full_name' => $auth_user->getName(),
        'base_avatar' => $imageUrl,
        'password' => Hash::make($auth_user->getId()),
        'acc_type' => 'google',
        'email_verified_at' => now(),
        ]);

        $user -> save();

        }/*elseif(User::where('email',$email)->first()){

            return redirect()->to('/login')->with('failed', 'Email is already used!!');
        }*/

        if(Auth::attempt(['full_name' => $auth_user->getName(),'password' => $auth_user->getId()])){

        return redirect()->to('/home');

        }

        return redirect()->to('/home');
    }


    public function redirectToFacebookProvider(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderFacebookCallback()
    {
        $auth_user = Socialite::driver('facebook')->stateless()->user();

        if(!empty($auth_user->getAvatar())){
            $fileContents = file_get_contents($auth_user->getAvatar());
            Image::make($fileContents)->resize(300,300)->save(public_path('/upload/images/profile/'. $auth_user->getId() . ".jpg"));
        }

        $imageUrl = $auth_user->getId() . ".jpg";

        if(!User::where('email',$auth_user->getEmail())->where('acc_type','facebook')->first()){
        $user = User::create([
        'email' => $auth_user->getEmail(),
        'full_name' => $auth_user->getName(),
        'base_avatar' => $imageUrl,
        'password' => Hash::make($auth_user->getId()),
        'acc_type' => 'facebook',
        'email_verified_at' => now(),
        ]);

        $user -> save();

        }

        if(Auth::attempt(['full_name' => $auth_user->getName(),'password' => $auth_user->getId()])){

        return redirect()->to('/home');

        }

        return redirect()->to('/home');
    }
}
