<?php

namespace App\Http\Controllers\Core;

use App\Actions\LoginAction;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Core\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return ClientResource::collection(Client::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request, LoginAction $loginAction) {
        $client = Client::create($request->only(['name', 'location']));
        $user = $client->users->create($request->only(['first_name', 'last_name', 'email', 'password']));
        $user['token'] = $loginAction->handle($user);
        $client['user'] = $user;
        return new ClientResource($client); //if this does not work use additional data
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client) {
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client) {
        $client = $client->update($request->only(['name', 'location', 'metadata']));

        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client) {
        $client->delete(); // delete users, projects, providers etc..

        return response()->json(['message' => 'Client was deleted!']);
    }
}
