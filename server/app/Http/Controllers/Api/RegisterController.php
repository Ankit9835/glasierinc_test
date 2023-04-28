<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'data' => $validator->errors()
            ]);       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
        $success['email'] =  $user->email;
   
        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'data' => $success
        ]);
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
            $success['email'] =  $user->email;

          
                return response()->json([
                    'status' => true,
                    'message' => 'Login successfully',
                    'data' => $success
                ]);
           
        } 
        else{ 
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ]);
        } 
    }

   
}
