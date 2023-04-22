<?php

namespace App\Http\Controllers\Core;

use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use App\Http\Resources\ProviderResource;
use App\Models\Core\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return ProviderResource::collection(Provider::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreProviderRequest  $request
     * @return App\Http\Resources\ProviderResource
     */
    public function store(StoreProviderRequest $request) {
        return new ProviderResource(Provider::create($request->all()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateProviderRequest  $request
     * @param  App\Models\Core\Provider $provider
     * @return App\Http\Resources\ProviderResource
     */
    public function update(UpdateProviderRequest $request, Provider $provider) {
        return new ProviderResource($provider->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Core\Provider $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider) {
        $provider->delete();
        return response()->json(['message' => 'Provider deleted!']);
    }
}
