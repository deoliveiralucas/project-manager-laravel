<?php

namespace ProjectManager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Factory;

use ProjectManager\Repositories\ProjectFileRepository;
use ProjectManager\Services\ProjectFileService;
use ProjectManager\Services\ProjectService;
use ProjectManager\Http\Controllers\Controller;

class ProjectFileController extends Controller
{

    protected $repository;
    protected $service;
    protected $projectService;
    protected $storage;

    public function __construct(
        ProjectFileRepository $repository,
        ProjectFileService $service,
        ProjectService $projectService,
        Factory $storage
    ) {
        $this->repository = $repository;
        $this->service = $service;
        $this->projectService = $projectService;
        $this->storage = $storage;
    }

    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    public function create()
    {
        return $this->repository->create($this->repository->all());
    }

    public function store(Request $request, $id)
    {
        if ($this->projectService->checkProjectPermissions($id) == false) {
            return ['error' => 'Access Forbidden'];
        }

        if (is_null($file = $request->file('file'))) {
            return [
                'error' => true,
                'message' => 'File invalid'
            ];
        }
        $extension = $file->getClientOriginalExtension();

        $data['file']        = $file;
        $data['extension']   = $extension;
        $data['name']        = $request->name;
        $data['project_id']  = $request->project_id;
        $data['description'] = $request->description;

        return $this->service->create($data);
    }

    public function showFile($id, $idFile)
    {
        if ($this->projectService->checkProjectPermissions($id) == false) {
            return ['error' => 'Access Forbidden'];
        }

        $model = $this->repository->skipPresenter()->find($idFile);
        $filePath = $this->service->getFilePath($idFile);
        $fileContent = file_get_contents($filePath);
        $file64 = base64_encode($fileContent);

        return[
            'file'      => $file64,
            'size'      => filesize($filePath),
            'name'      => $this->service->getFileName($idFile),
            'mime_type' => $this->storage->mimeType($model->getFileName())
        ];
    }

    public function show($id, $idFile)
    {
        if ($this->projectService->checkProjectPermissions($id) == false) {
            return ['error' => 'Access Forbidden'];
        }
        return $this->repository->find($idFile);
    }

    public function update(Request $request, $id, $idFile)
    {
        if ($this->projectService->checkProjectPermissions($id) == false) {
            return ['error' => 'Access Forbidden'];
        }
        return $this->service->update($request->all(), $idFile);
    }

    public function destroy($id, $idFile)
    {
        if ($this->projectService->checks($id) == false) {
            return ['error' => 'Access Forbidden or Project Not Found'];
        }

        $this->service->delete($idFile);
    }
}
