<?php

namespace ProjectManager\Services;

use ProjectManager\Repositories\ProjectFileRepository;
use ProjectManager\Repositories\ProjectRepository;
use ProjectManager\Validators\ProjectFileValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class ProjectFileService 
{
    
    /*
     * @var ProjectFileRepository
     */
    protected $repository;
    /*
     * @var ProjectRepository
     */
    protected $projectRepository;

    /**
     * @var ProjectFileValidator
     */
    protected $validator;
    /*
     * @var Filesystem
     */
    protected $filesystem;
    /*
     * @var Storage
     */
    protected $storage;

    public function __construct(
        ProjectFileRepository $repository, 
        ProjectFileValidator $validator, 
        ProjectRepository $projectRepository, 
        Filesystem $filesystem, 
        Storage $storage
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->projectRepository = $projectRepository;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
    }

    public function create(array $data) 
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $project = $this->projectRepository->skipPresenter()->find($data['project_id']);
            
            $projectFile = $project->files()->create($data);
            $this->storage->put($projectFile->getFileName(), $this->filesystem->get($data['file']));
            
            return $projectFile;
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id) 
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            
            return $this->repository->update($data, $id);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function delete($id) 
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        
        if ($this->storage->exists($projectFile->getFileName())) {
            $this->storage->delete($projectFile->getFileName());
            
            return $projectFile->delete();
        }
    }

    public function getFilePath($id) 
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        
        return $this->getBaseURL($projectFile);
    }

    public function getFileName($id) 
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        
        return $projectFile->getFileName();
    }

    public function getBaseURL($projectFile) 
    {
        switch ($this->storage->getDefaultDriver()) {
            
            case 'local':
                return $this->storage->getDriver()->getAdapter()->getPathPrefix() . '/' . 
                       $projectFile->getFileName();
                
        }
    }

    public function checkProjectOwner($projectFileId) 
    {
        $userId = \Authorizer::getResourceOwnerId();
        $projectId = $this->repository->skipPresenter()->find($projectFileId)->project_id;
        
        return $this->projectRepository->isOwner($projectId, $userId);
    }

    public function checkProjectMember($projectFileId) 
    {
        $userId = \Authorizer::getResourceOwnerId();
        $projectId = $this->repository->skipPresenter()->find($projectFileId)->project_id;
        
        return $this->projectRepository->hasMember($projectId, $userId);
    }

    public function checkProjectPermissions($projectFileId) 
    {
        if ($this->checkProjectOwner($projectFileId) || $this->checkProjectMember($projectFileId)) {
            return true;
        }
        return false;
    }

    public function checkExist($id) 
    {
        if ($this->repository->find($id)) {
            return true;
        }
        return false;
    }

    public function checks($id) 
    {
        if ($this->checkProjectPermissions($id) == false || $this->checkExist($id) == false) {
            return false;
        }
        return true;
    }

}
