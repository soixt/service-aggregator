<?php

namespace App\Http\Controllers\Core;

use App\Http\Resources\ProjectResource;
use App\Models\Core\APICall;
use App\Models\Core\Project;

class StatisticsController extends Controller
{
    public function dashboard () {
        $totalApiCallsCount = APICall::count();
        $projects = Project::all();
        $planPrice = 50;
        $planCalls = 50000;

        $leftApiCallsCount = 37021;
        $moneyLeft = ($planPrice / $planCalls) * $leftApiCallsCount;
        $currentPlan = "$$moneyLeft / $leftApiCallsCount calls";
        
        return response()->json([
            'totalApiCallsCount' => $totalApiCallsCount + 12979,
            'leftApiCallsCount' => $leftApiCallsCount,
            'currentPlan' => $currentPlan,
            'projects' => ProjectResource::collection($projects),
            'services' => [
                ['name' => 'SMS Service', 'totalApiCallsCount' => 2960],
                ['name' => 'Payment Service', 'totalApiCallsCount' => 10019],
                ['name' => 'Storage Service', 'totalApiCallsCount' => 200]
            ]
        ]);
    }
}
