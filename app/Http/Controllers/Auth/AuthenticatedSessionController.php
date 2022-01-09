<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Http;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function providerLogin($provider)
    {
        $user=Socialite::driver($provider)->user();
        $logged_user=User::where('email',$user->getEmail())
        ->orWhere(function($query) use($user,$provider){
            $query->where('provider_id',$user->getId())
            ->where('provider_type',$provider);
        })->first();
        if(!$logged_user){
            $logged_user=User::create([
                'email'=>$user->getEmail(),
                'name'=>$user->getName(),
                'provider_id'=>$user->getId(),
                'provider_type'=>$provider
            ]);            
            event(new Registered($user));
            $logged_user->profile()->firstOrCreate(['name'=>$logged_user->name]);
        }
        Auth::login($logged_user,true);
        return redirect()->intended(RouteServiceProvider::HOME);
    }
    public function matrixLogin(Request $request)
    {
        $query=$request->all();
        if(!isset($query['redirecturl'])){
            $query['redirecturl']='/';
        }
        $response=Http::withHeaders(["Authorization"=>"Bearer ".env("MATRIX_ACCESS_TOKEN")])->get("https://matrix.seedsaversclub.com/_synapse/admin/v2/users/".$query['id']);
        if($response->ok()){
            $user=extract_userinfo($response);
            $user_query=User::where(function($query) use($user){
                $query->where('provider_id',$user["provider_id"])
                ->where('provider_type',$user["provider_type"]);
            });
            if($user["email"]){
                $user_query=$user_query->orWhere('email',$user["email"]);
            }
            $logged_user=$user_query->first();
            if(!$logged_user){
                $logged_user=User::create([
                    'email'=>$user["email"],
                    'name'=>$user["name"],
                    'provider_id'=>$user["provider_id"],
                    'provider_type'=>$user["provider_type"]
                ]);            
                event(new Registered($user));
                $logged_user->profile()->firstOrCreate(['name'=>$logged_user->name]);
            }
            Auth::login($logged_user,true);
            return redirect($query['redirecturl']);
        }
        else{
            return redirect($query['redirecturl']);  
        }
    }
}
function extract_userinfo($response){
        $user=[];
        $user["name"]=$response["displayname"];
        if($response["external_ids"]){
            $provider=$response["external_ids"][0];
            $user["provider_type"]=str_replace("oidc-","",$provider["auth_provider"]);
            $user["provider_id"]=$provider["external_id"];
        }
        else{
         $user["provider_type"]=null;
         $user["provider_id"]=null;   
        }
        $threepids=array_filter($response["threepids"],function($item){
            if($item["medium"]=="email"){
                return $item;
            }
        });
        if($threepids){
            $user["email"]=$threepids[0]["address"];
        }
        else{
            $user["email"]=null;
        }
        return $user;
    }