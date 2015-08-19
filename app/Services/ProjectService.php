<?php

namespace ProjectManager\Services;

use ProjectManager\Repositories\ProjectRepository;
use ProjectManager\Validators\ProjectValidator;
use ProjectManager\Repositories\ProjectMemberRepository;
use ProjectManager\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;

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

    public function __construct(
        ProjectRepository $repository, 
        ProjectValidator $validator,
        ProjectMemberRepository $memberRepository,
        ProjectMemberValidator $memberValidator
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->memberRepository = $memberRepository;
        $this->memberValidator = $memberValidator;
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
                'message' => $e->getMessage()
            ];
        }
    }
    
    public function show($id)
    {
        try {
            return $this->repository->with(['client', 'user'])->find($id);
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
            $this->repository->find($id)->delete();
            return [$id];
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
}
