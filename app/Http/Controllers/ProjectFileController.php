<?php

namespace ProjectManager\Http\Controllers;

use Illuminate\Http\Request;

use ProjectManager\Repositories\ProjectFileRepository;
use ProjectManager\Services\ProjectFileService;
use ProjectManager\Http\Controllers\Controller;

class ProjectFileController extends Controller
{
    /**
     * @var ProjectRepository 
     */
    protected $repository;
    
    /**
     * @var ProjectService
     */
    protected $service;

    public function __construct(
        ProjectFileRepository $repository,
        ProjectFileService $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }
    
    public function index($id)
    {    
        return $this->repository->findWhere(['project_id' => $id]);
    }
    
    public function create()
    {
        return $this->repository->create($this->repository->all());
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (is_null($file = $request->file('file'))) {
            return [
                'error' => true,
                'message' => 'File invalid'
            ];
        }
        $extension = $file->getClientOriginalExtension();
        
        $data['file'] = $file;
        $data['extension'] = $extension;
        $data['name'] = $request->name;
        $data['project_id'] = $request->project_id;
        $data['description'] = $request->description;
        
        return $this->service->create($data);
    }

    public function showFile($idFile)
    {
        if ($this->service->checkProjectPermissions($idFile) == false) {
            return ['error' => 'Access Forbidden'];
        }

        $filePath = $this->service->getFilePath($idFile);
        $fileContent = file_get_contents($filePath);
        $file64 = base64_encode($fileContent);
        
        return[
            'file' => $file64,
            'size' => filesize($filePath),
            'name' => $this->service->getFileName($idFile)
        ];
    }
    
    public function show($idFile)
    {
        if ($this->service->checkProjectPermissions($idFile) == false) {
            return ['error' => 'Access Forbidden'];
        }
        return $this->repository->find($idFile);
    }
    
    public function update(Request $request, $idFile)
    {
        if ($this->service->checkProjectPermissions($idFile) == false) {
            return ['error' => 'Access Forbidden'];
        }
        return $this->service->update($request->all(), $idFile);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->service->checks($id) == false) {
            return ['error' => 'Access Forbidden or Project Not Found'];
        }
        
        $this->service->delete($id);
    }
}
