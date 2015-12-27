<?php

namespace ProjectManager\Services;

use ProjectManager\Repositories\ProjectNoteRepository;
use ProjectManager\Validators\ProjectNoteValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService
{
    
    protected $repository;
    protected $validator;

    public function __construct(
        ProjectNoteRepository $repository,
        ProjectNoteValidator $validator
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
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function show($id, $noteId)
    {
        try {
            $result = $this
                ->repository
                ->findWhere(['project_id' => $id, 'id' => $noteId]);

            if (isset($result['data']) && count($result['data'] == 1)) {
                $result = [
                    'data' => $result['data'][0]
                ];
            }

            return $result;
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
}
