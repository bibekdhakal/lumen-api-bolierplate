<?php

namespace App\Http\Controllers\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRequest extends Controller
{

    public function __construct(Request $request)
    {
       $this->validate(
          $request, [
            'name' => 'required|max:50',
            // 'email' => request()->route('users') 
            //     ? 'required|email|max:255|unique:users,email,' . request()->route('users')
            //     : 'required|email|max:255|unique:users,email',
            // 'password' => request()->route('users') ? 'nullable' : 'required|max:50'
            'email' => request()->isMethod('post') ? 'required|max:255|unique:users|email' . request()->isMethod('pust') : 'required|max:255|email',
            'password' => 'required|max:255'
          ]
       );
 
       parent::__construct($request);
    }
}