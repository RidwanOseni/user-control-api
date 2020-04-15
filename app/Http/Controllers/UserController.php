<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    // @param  User $user
    // @return UserResource

    public function show(User $user): UserResource
    {
        
        return new UserResource($user);
    }

    //@return UserResourceCollection

    public function index(): UserResourceCollection 
    {

        return new UserResourceCollection(User::paginate());
    }

    //@param User $user
    //@return UserResource

    public function store(Request $request)
    {
        //create a user
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => ['required', 'unique:users'],
            'phone'         => 'required',
            'city'          => 'required'
        ]);
        
        $user = User::create($request->all());
        return new UserResource($user);
        
    }

    //@param User $user, Request $request
    //@return UserResource

    public function update(User $user, Request $request): UserResource
    {
        //Update user
        
        $user->update($request->all());
        return new UserResource($user);
    }

    //@param User $user
    //@return \Illuminate\Http\JsonResponse
    //@thows \Exception

    public function destroy(User $user)
    {
        //delete user
        
        $user->delete();
        return response()->json(["message" => "User Deleted"]);
    }

    public function restore($id)
    {
        //Restore softDeleted user

        // $data = User::withTrashed()->find($id);
        

        // $data->restore();


        // return response()->json(["data" => "User Restored"]);


        $user = User::onlyTrashed()->find($id);

        if (!is_null($user)) {

            $user->restore();
            
        } else {

            return response()->json();
        }
        return response()->json([
            "message" => "User Restored"
        ]);
    }

}

