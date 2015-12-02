<?php

namespace ProjectManager\Services;

use ProjectManager\Repositories\ProjectRepository;
use ProjectManager\Validators\ProjectValidator;
use ProjectManager\Repositories\ProjectMemberRepository;
use ProjectManager\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class ProjectService 
{
    /**
     * @var ProjectRepository
     */
    protected $repository;
    
    /**
     * @var ProjectValidator
     */
    protected $validator;
    
    /**
     * @var ProjectMemberRepository
     */
    protected $memberRepository;
    
    /**
     * @var ProjectMemberValidator
     */
    protected $memberValidator;
    
    /**
     * @var Illuminate\Filesystem\Filesystem
     */
    protected $filesystem;
    
    /**
     * @var Illuminate\Contracts\Filesystem\Factory
     */
    protected $storage;

    public function __construct(
        ProjectRepository $repository, 
        ProjectValidator $validator,
        ProjectMemberRepository $memberRepository,
        ProjectMemberValidator $memberValidator,
        Filesystem $fileSystem,
        Storage $storage
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->memberRepository = $memberRepository;
        $this->memberValidator = $memberValidator;
        $this->filesystem = $fileSystem;
        $this->storage = $storage;
    }
    
    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
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
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }
    
    public function show($id)
    {
        try {
            return $this->repository->with(['client', 'user', 'notes', 'tasks'])->find($id);
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
    
    public function destroy($id)
    {
        try {
            $this->repository->skipPresenter()->find($id)->delete();
            return json_encode('{id: ' + $id + '}');
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
    
    public function addMember(array $data)
    {
        try {
            $this->memberValidator->with($data)->passesOrFail();
            return $this->memberRepository->create($data);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }
    
    public function removeMember($id, $memberId)
    {
        try {
            $this->memberRepository->findWhere(['project_id' => $id, 'user_id' => $memberId])->delete();
            return [$id];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
    
    public function isMember($id, $memberId)
    {
        if (count($this->memberRepository->findWhere(['project_id' => $id, 'user_id' => $memberId]))) {
            return ['ismember' => true];
        }
        return ['ismember' => false];
    }
    
    public function findMembers($projectId)
    {
        return $this->memberRepository->with(['project', 'user'])->findWhere(['project_id' => $projectId]);
    }
    
    public function createFile(array $data)
    {
        try {
            $project = $this->repository->skipPresenter()->find($data['project_id']);
            $projectFile = $project->files()->create($data);
            
            $this->storage->put($projectFile->id . "." . $data['extension'], $this->filesystem->get($data['file']));
            return [
                'success' => true,
                'message' => sprintf('The file was created to the project %s', $project->id)
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
    
    public function destroyFile($projectId)
    {
        try {
            $project = $this->repository->skipPresenter()->find($projectId);
            $projectFile = $project->files()->get();
            
            $files = [];
            foreach ($projectFile as $file) {
                array_push($files, sprintf('%s.%s', $file['id'], $file['extension']));
            }
            
            $this->storage->delete($files);
            $project->files()->delete();
            
            return [
                'success' => true,
                'project' => $project
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
    
    public function checkProjectOwner($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($projectId, $userId);
    }
    
    public function checkProjectMember($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($projectId, $userId);
    }
    
    public function checkProjectPermissions($projectId)
    {
        if ($this->checkProjectOwner($projectId) || $this->checkProjectMember($projectId)) {
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
