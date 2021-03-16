<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Requests\FormRequest;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponseTrait;

class Controller extends BaseController implements FormRequest
{
    use ApiResponseTrait;
    protected $service;
    protected $params;
    public $request;
 
    public function __construct(Request $request)
    {
       $this->params = $request->all();
       $this->request = $request;
    }
 
    /**
     * Return the Request Object
     *
     * @return \Illuminate\Http\Request
     */
    public function getParams(): Request
    {
       return $this->request->replace($this->params);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }
}
