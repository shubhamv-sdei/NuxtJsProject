<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Get a user details
     *
     * @return void
     */
    public function getUser(Request $request)
    {
        try{
            $token = $request->token; // Get Current User Token
            $userObj = User::where('token',$token)->first(); // Based on token we have fetch the users
            if($userObj){
                return response()->json($userObj,200);
            }else{
                return response()->json(['message' => 'User Not Found'], 201, ['X-Header-One' => 'User Not Found']);
            }
        }catch(Exception $ex){
            return response()->json(['message' => $ex->getMessage()], 500, ['X-Header-One' => 'User Not Found']);
        } 
    }

    /**
     * Update a user details
     *
     * @return void
     */
    public function updateUser(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255'],
                'country' => ['required','string','max:50'],
                'street' => ['required'],
                'city' => ['required','string','max:50'],
                'state' => ['required','string','max:50'],
                'zip' => ['required','numeric']
            ]);

            if ($validator->fails()) {
                return response()->json($validator->messages(), 201);
            }

            $data = [
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'email' => $request->email,
                    'country' => $request->country,
                    'street' => $request->street,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    ];

            $token = $request->token; // Get Current User Token
            $userObj = User::where('token',$token)->update($data); // Based on token we have update the users
            if($userObj){
                return response()->json(['message'=>'User Updated Successfully.'],200);
            }else{
                return response()->json(['message' => 'User Not Found'], 201, ['X-Header-One' => 'User Not Found']);
            }
        }catch(Exception $ex){
            return response()->json(['message' => $ex->getMessage()], 500, ['X-Header-One' => 'User Not Found']);
        }
    }
}
