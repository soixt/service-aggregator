<?php

namespace App\Http\Controllers\Services;

use App\Models\Core\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Controller;
use App\Http\Requests\Payments\PayRequest;
use App\Http\Requests\Payments\StatusRequest;
use App\Http\Requests\Payments\WithdrawRequest;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\PaymentStatusResource;
use App\Utilities\MainServiceUtility;

class PaymentController extends Controller
{
    protected $providerUtility;

    public function __construct(Request $request, MainServiceUtility $serviceUtility, Provider $provider) {
        $providerPerServiceConfig = $request['project']->projectActiveService()->whereHas(["providersPerActiveService" => function($q) use ($provider) {
            $q->where('provider_project_active_services.provider_id', '=', $provider->id)->first();
        }])->first()->providersPerActiveService->first();

        $this->providerUtility = $serviceUtility->createUtility("payment", $provider->slug, $providerPerServiceConfig);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pay (PayRequest $request)
    {
        $payment = $this->providerUtility->pay($request->validated());
        
        return (new PaymentResource($payment['order']))->additional([
            'redirect_url' => $payment['redirect_url']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function status (StatusRequest $request)
    {
        $payment = $this->providerUtility->status($request->validated());
        
        return new PaymentStatusResource($payment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function withdraw (WithdrawRequest $request)
    {
        $payment = $this->providerUtility->withdraw($request->validated());
        
        return new PaymentResource($payment);
    }
}
