<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->stateless()->user();
       
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
                \Session::put('user',$finduser);
                return redirect()->to('/');
       
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'provider'=> 'Google',
                    'password' => encrypt('123456dummy')
                ]);
      
                Auth::login($newUser);
                \Session::put('user',$newUser);
      
                return redirect()->to('/');
            }
      
        } catch (Exception $e) {
            
            \DB::table('error_logs')->insert([
                    'error' => $e->getMessage(),
                    'title'=> 'twitter login'
                ]);
            return redirect('/');
        }
    }
}