<?php
namespace App\Actions\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Http\Requests\LoginRequest;


class AuthenticateUser
{
public function __invoke(LoginRequest $request)
{
    $credentials = $request->only("email","password");
    $user = User::where("email", $credentials["email"])->first();
    if ($user)
    {
        $pepper = config("app.pepper");
        $passwordWithSaltPepper = $credentials["password"] . $user->salt . $pepper;
        if(Hash::check($passwordWithSaltPepper, $user->password)){
             Auth::login($user);
             Log::info("user $user->id logged in at ".now()."from".$request->ip());
             return $user;
        } 
    }
    return null;
}

}