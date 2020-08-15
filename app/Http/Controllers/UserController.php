<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        try {
            $user = User::create($validated);
            $arr = [
                'code'      => 200,
                'message'   => 'User created.',
                'user'      => $user
            ];
        } catch(\Exeption $e) {
            $arr = [
                'code'      => 500,
                'message'   => 'Error creating user.',
                'user'      => $e->getMessage()
            ];
        }
        return response(json_encode($arr), $arr['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            $arr = [
                'code'      => 200,
                'message'   => 'User Found.',
                'user'      => $user
            ];
        } catch(\Exeption $e) {
            $arr = [
                'code'      => 404,
                'message'   => 'User not found.',
                'user'      => $e->getMessage()
            ];
        }
        return response(json_encode($arr), $arr['code']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $validated = $request->validated();
        try {
            $user = User::find($validated['id']);
            $user->update($validated);
            $arr = [
                'code'      => 200,
                'message'   => 'User Updated.',
                'user'      => $user
            ];
        } catch(\Exeption $e) {
            $arr = [
                'code'      => 500,
                'message'   => 'Error updating user.',
                'user'      => $e->getMessage()
            ];
        }
        return response(json_encode($arr), $arr['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        try {
            $user = User::findOrFail($id);
            $user->delete();
            $arr = [
                'code'      => 200,
                'message'   => 'User Deleted.',
            ];
        } catch(\Exeption $e) {
            $arr = [
                'code'      => 500,
                'message'   => 'Error Deleting user.',
                'user'      => $e->getMessage()
            ];
        }
        return response(json_encode($arr), $arr['code']);
    }
}
