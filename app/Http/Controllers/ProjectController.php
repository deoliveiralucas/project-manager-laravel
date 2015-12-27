<?php

namespace ProjectManager\Http\Controllers;

use Illuminate\Http\Request;

use ProjectManager\Repositories\ProjectRepository;
use ProjectManager\Services\ProjectService;
use ProjectManager\Http\Controllers\Controller;

class ProjectController extends Controller
{

    protected $repository;
    protected $service;

    public function __construct(
        ProjectRepository $repository,
        ProjectService $service
    ) {
        $this->repository = $repository;
        $this->service = $service;

        $this->middleware('check-project-owner', ['except' => ['store', 'show', 'index']]);
        $this->middleware('check-project-permission', ['except' => ['index', 'store', 'update', 'destroy']]);
    }

    public function index(Request $request)
    {
        return $this
            ->repository
            ->findOwner(\Authorizer::getResourceOwnerId(), $request->query->get('limit'));
    }

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id)
    {
        if ($this->service->checks($id) == false) {
            return ['error'=>'Access Forbidden or Project Not Found'];
        }
        return $this->service->show($id);
    }

    public function update(Request $request, $id)
    {
        if ($this->service->checks($id) == false) {
            return ['error'=>'Access Forbidden or Project Not Found'];
        }
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        if ($this->service->checks($id) == false) {
            return ['error'=>'Access Forbidden or Project Not Found'];
        }
        return $this->service->destroy($id);
    }
}
