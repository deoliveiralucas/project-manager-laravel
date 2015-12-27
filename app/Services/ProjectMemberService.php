<?php

namespace ProjectManager\Services;

use ProjectManager\Repositories\ProjectMemberRepository;
use ProjectManager\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectMemberService
{

    protected $memberRepository;
    protected $memberValidator;
    protected $storage;

    public function __construct(
        ProjectMemberRepository $memberRepository,
        ProjectMemberValidator $memberValidator
    ) {
        $this->memberRepository = $memberRepository;
        $this->memberValidator = $memberValidator;
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
            $this->memberRepository->deleteMember($id, $memberId);
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
        return $this
            ->memberRepository
            ->with(['project', 'user'])
            ->findWhere(['project_id' => $projectId])
        ;
    }

    public function findOneMember($projectId, $userId)
    {
        $member = $this
            ->memberRepository
            ->with(['project', 'user'])
            ->findWhere([
                'project_id' => $projectId,
                'user_id' => $userId
            ]);

        return array_shift($member['data']);
    }

    public function updateMember(array $data, $id, $idMember)
    {
        return $this
            ->memberRepository
            ->updateMember($data, $id, $idMember);
    }
}
