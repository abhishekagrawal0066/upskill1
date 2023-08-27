<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        try{
            dd("dsd");
            $SocialUser = Socialite::driver($provider)->user();
            dd($SocialUser->getNickname());
            $nickname = $SocialUser->getNickname();
            if ($SocialUser->getName() == '') {
                $SocialUser->name = $nickname;
            }
            if(User::where('email',$SocialUser->getEmail())->exists()){
                return redirect('/login')->withErrors(['email'=> 'This Email is uses different method to login']);
            }
            $user = User::where([
                'provider' => $provider,
                'provider_id'=>$SocialUser->id
            ])->first();

            if(!$user){
                $user = user::create([
                    'name' => $SocialUser->getName(),
                    'email' => $SocialUser->getEmail(),
                    'username' => User::generateUserName($SocialUser->getNickname()),
                    'provider' => $provider,
                    'provider_id' => $SocialUser->getId(),
                    'provider_token' => $SocialUser->token,
                    'email_verified_at' => now()
                ]);
            }
                // $user = User::updateOrCreate([
                //     'provider_id'=>$SocialUser->id,
                //     'provider' => $provider
                // ],[
                //     'name' => $SocialUser->name,
                //     'username' => User::generateUserName($SocialUser->nickname),
                //     'email' => $SocialUser->email,
                //     'provider_token' => $SocialUser->token,
                // ]);
            Auth::login($user);
            return redirect()->route('/dashboard');
        } catch (\Exception $e){
            return redirect('/login');
        }
    }
    //google login
    // //google callback
    // public function handleGoogleCallback()
    // {
    //     $user = Socialite::driver('google')->user();
    //     // dd($user);
    //     $this->_registerOrLoginUser($user);
    //     //rerurn after login home page
    //     return redirect()->route('home');
    // }
    // public function redirectToFacebook()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }
    // //Facebook callback
    // public function handleFacebookCallback()
    // {
    //     $user = Socialite::driver('facebook')->user();
    //     // dd($user/);
    //     $this->_registerOrLoginUser($user);
    //     //rerurn after login home page
    //     return redirect()->route('home');
    // }
    // //Github login
    // public function redirectToGithub()
    // {
    //     return Socialite::driver('github')->redirect();
    // }
    // //Github callback
    // public function handleGithubCallback()
    // {
    //     $user = Socialite::driver('github')->user();
    //     // dd($us/er);
    //     $this->_registerOrLoginUser($user);
    //     //rerurn after login home page
    //     return redirect()->route('home');
    // }
    // protected function _registerOrLoginUser($data){
    //     $user = User::updateOrCreate([
    //         'provider_id'=>$user->id,
    //         'provider' => $data
    //     ],[
    //         'name' => $user->name,
    //         'username' => $user->nickname,
    //         'email' => $data->email,
    //         'provider_token' => $data->token,
            

    //     ]);
       
    //     // if (!$user) {
    //     //     $user = new User();
    //     //     $user->provide_id = $data->provide_id;
    //     //     $user->save();
    //     // }  
    //     
    // }
}
