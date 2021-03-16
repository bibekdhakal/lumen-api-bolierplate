<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Requests\UserRequest;
use App\Interfaces\UserInterface;

class UserController extends Controller
{
    protected $userInteface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data = $this->userInterface->getAllUsers();
            return $this->respondSuccess($data, "All Users");

        } catch(\Exception $e) {
            return $this->respondError($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try{
            $data = $this->userInterface->requestUser($request);

            return $this->respondSuccess(
                $data, $data->id ? "User updated"
                    : "User created",
                $data->id ? 200 : 201);

        } catch(\Exception $e) {
            return $this->respondError($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $data = $this->userInterface->getUserById($id);
            return $this->respondSuccess($data,"User Detail");

        } catch(\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        return $this->userInterface->requestUser($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $this->userInterface->deleteUser($id);
            return $this->respondSuccess('', "User deleted");
        } catch(\Exception $e) {
            return $this->respondError($e->getMessage(), $e->getCode());
        }
    }
}