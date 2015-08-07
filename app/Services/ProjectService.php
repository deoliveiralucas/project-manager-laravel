<?php

namespace ProjectManager\Services;

use ProjectManager\Repositories\ProjectRepository;
use ProjectManager\Validators\ProjectValidator;
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
    
    public function __construct(
        ProjectRepository $repository, 
        ProjectValidator $validator
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
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
}
