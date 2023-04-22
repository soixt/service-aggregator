<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Models\Core\Client;
use App\Models\Core\Project;
use App\Models\Core\Provider;

class RelationController extends Controller
{
    public function activateService (Request $request, Client $client) {
        $request->validate(['services' => 'required|array', 'services.*' => 'exists:services,id']);
        $client->services()->attach($request->services); // re-check this
        return response()->json([
            'message' => 'Services activated!'
        ]);
    }
    
    public function useActiveServiceInProject (Request $request, Project $project) {
        $request->validate(['activeServices' => 'required|array', 'activeServices.*' => 'exists:active_services,id']);
        $project->projectActiveService()->attach($request->services); // re-check this
        return response()->json([
            'message' => 'Active service added to project!'
        ]);
    }
    
    public function setupProviderConfigPerActiveServiceInProject (Request $request, Provider $provider) {
        $request->validate(['projectActiveService' => 'required|array', 'projectActiveService.*' => 'exists:project_active_services,id']);
        $provider->providersPerActiveService()->attach($request->projectActiveService); // re-check this
        return response()->json([
            'message' => 'Provider added for active services within project!'
        ]);
    }
}
