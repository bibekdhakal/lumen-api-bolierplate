<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Traits\ApiResponseTrait;
use App\Models\User;
use DB;

class UserRepository implements UserInterface
{
    // Use ResponseAPI Trait in this repository
    use ApiResponseTrait;

    public function getAllUsers()
    {
        $users = User::all();
        return $users;   
    }

    public function getUserById($id)
    {
        
        $user = User::find($id);
        
        // Check the user
        if(!$user) 
            throw new \Exception("No user with ID $id");

        return $user;
    }

    public function requestUser(UserRequest $request, $id = null)
    {
        DB::beginTransaction();
        // If user exists when we find it
        // Then update the user
        // Else create the new one.
        $user = $id ? User::find($id) : new User;

        // Check the user 
        if($id && !$user) throw new \Exception("No user with ID $id");
        
        $user->name = $request->getParams()->name;
        // Remove a whitespace and make to lowercase
        $user->email = preg_replace('/\s+/', '', strtolower($request->getParams()->email));
        
        // I dont wanna to update the password, 
        // Password must be fill only when creating a new user.
        if(!$id) $user->password = Hash::make($request->getParams()->password);

        // Save the user
        $user->save();

        DB::commit();
        return $user;
        
    }

    public function deleteUser($id)
    {
        DB::beginTransaction();
        $user = User::find($id);

        // Check the user
        if(!$user) throw new \Exception("No user with ID $id");

        // Delete the user
        $user->delete();

        DB::commit();
        return $user;
    }
}