<?php

namespace ProjectManager\Http\Controllers;

use Illuminate\Http\Request;
use ProjectManager\Repositories\ClientRepository;
use ProjectManager\Services\ClientService;

class ClientController extends Controller
{

    protected $repository;
    protected $service;

    public function __construct(
        ClientRepository $repository,
        ClientService $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }


    public function index(Request $request)
    {
        $limit = $request->query->get('limit', 15);
        return $this->repository->paginate($limit);
    }

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
