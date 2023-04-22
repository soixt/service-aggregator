<?php

namespace App\Http\Controllers\Core;

use App\Actions\LoginAction;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Core\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request) {
        $user = User::create($request->all());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
        $user->update($request->all());

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user, LoginAction $loginAction) {
        $request->validate(['password' => 'required|min:8']);

        $user->update(['password' => bcrypt($request->password)]);

        $token = $loginAction->handle($user, true);

        return response()->json(['message' => 'Password has been changed!', 'token' => $token]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }
}
