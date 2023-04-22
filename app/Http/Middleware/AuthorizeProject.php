<?php

namespace App\Http\Middleware;

use App\Models\Core\Project;
use Closure;
use Illuminate\Http\Request;

class AuthorizeProject
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $projectPublicKey = $request->header('Authorization-Key');
        $request['project'] = Project::where('public_key', '=', $projectPublicKey)->firstOrFail();

        // $authorizationToken = $request->bearerToken();
        // $hashed = hash_hmac('sha512', $request->getContent()->toString(), $request['project']->private_key);

        // if ($hashed !== $authorizationToken) {
        //     return response('Unauthorized.', 401);
        // }
        return $next($request);
    }

    public function terminate($request, $response)
    {
        unset($request['project']);
    }
}
