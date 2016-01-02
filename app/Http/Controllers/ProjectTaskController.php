<?php

namespace ProjectManager\Http\Controllers;

use Illuminate\Http\Request;

use ProjectManager\Repositories\ProjectTaskRepository;
use ProjectManager\Services\ProjectTaskService;
use ProjectManager\Http\Controllers\Controller;

class ProjectTaskController extends Controller
{

    protected $repository;
    protected $service;

    public function __construct(
        ProjectTaskRepository $repository,
        ProjectTaskService $service
    ) {
        $this->repository = $repository;
        $this->service = $service;

        $this->middleware('check-project-owner', ['except' => ['index','show']]);
        $this->middleware('check-project-permission', ['except' => ['store','destroy']]);
    }

    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    public function store(Request $request, $id)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->create($data);
    }

    public function show($id, $taskId)
    {
        return $this->service->show($id, $taskId);
    }

    public function update(Request $request, $id, $taskId)
    {
        return $this->service->update($request->all(), $taskId);
    }

    public function destroy($id, $taskId)
    {
        return $this->service->destroy($taskId);
    }
}
