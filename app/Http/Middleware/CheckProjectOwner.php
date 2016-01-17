<?php

namespace ProjectManager\Http\Middleware;

use Closure;
use ProjectManager\Services\ProjectService;

class CheckProjectOwner
{

    /**
     * @var \ProjectManager\Service\ProjectService
     */
    protected $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $projectId = $request->route('id') ?: $request->route('project') ;

        if ($this->service->checkProjectOwner($projectId) == false) {
            return response('Unauthorized.', 403);
        }

        return $next($request);
    }
}
