<?php

namespace ProjectManager\Http\Controllers;

use Illuminate\Http\Request;

use ProjectManager\Services\ProjectService;
use ProjectManager\Http\Controllers\Controller;

class ProjectMemberController extends Controller
{
    /**
     * @var ProjectService
     */
    protected $service;

    public function __construct(ProjectService $service) {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        return $this->service->findMembers($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->service->addMember($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, $memberId)
    {
        return $this->service->removeMember($id, $memberId);
    }
    
    public function check($id, $memberId)
    {
        return $this->service->isMember($id, $memberId);
    }
}
