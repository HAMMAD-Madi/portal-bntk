<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LoginController extends Controller
{

    public function authenticate(Request $request)
    {

        if (!Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return Response()->json(['status' => '__LOGIN_BAD_CREDENTIALS__']);
        }


        $user = User::with('deployments')->where('email', $request->input('email'))->first();

        $token = $user->createToken('applogin')->plainTextToken;


        return response()->json(['apitoken' => $token, 'user' => $user]);

        // $validator = Validator::make($request->all(), [
        //     'email' => 'required,email',
        //     'password' => 'required',

        // ]);
        // dd($validator);

        // if ($validator->fails()) {    
        //     return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        // }
        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     $user = User::where('email', $credentials['email'])->first();

        //     return response()->json(['user' => $user]);
        // }
 

    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
    }

}

?>