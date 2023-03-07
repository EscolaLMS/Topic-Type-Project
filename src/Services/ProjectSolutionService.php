<?php

namespace EscolaLms\TopicTypeProject\Services;

use EscolaLms\Core\Repositories\Criteria\Primitives\EqualCriterion;
use EscolaLms\TopicTypeProject\Dtos\CreateProjectSolutionDto;
use EscolaLms\TopicTypeProject\Dtos\CriteriaDto;
use EscolaLms\TopicTypeProject\Dtos\PageDto;
use EscolaLms\TopicTypeProject\Models\ProjectSolution;
use EscolaLms\TopicTypeProject\Repositories\Contracts\ProjectSolutionRepositoryContract;
use EscolaLms\TopicTypeProject\Services\Contracts\ProjectSolutionServiceContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class ProjectSolutionService implements ProjectSolutionServiceContract
{
    public const DIR = 'project-solutions';

    private ProjectSolutionRepositoryContract $projectSolutionRepository;

    public function __construct(ProjectSolutionRepositoryContract $projectSolutionRepository)
    {
        $this->projectSolutionRepository = $projectSolutionRepository;
    }

    public function findAll(CriteriaDto $criteriaDto, PageDto $pageDto): LengthAwarePaginator
    {
        return $this->projectSolutionRepository->findByCriteria($criteriaDto->toArray(), $pageDto->getPerPage());
    }

    public function findAllByUser(CriteriaDto $criteriaDto, PageDto $pageDto, int $userId): LengthAwarePaginator
    {
        $criteria = $criteriaDto->toArray();
        $criteria[] = new EqualCriterion('user_id', $userId);

        return $this->projectSolutionRepository->findByCriteria($criteria, $pageDto->getPerPage());
    }

    public function create(CreateProjectSolutionDto $dto): ProjectSolution
    {
        $path = $dto->getFile()->storePublicly(self::DIR . DIRECTORY_SEPARATOR . $dto->getTopicId() . DIRECTORY_SEPARATOR . $dto->getUserId());

        /** @var ProjectSolution $model */
        $model = $this->projectSolutionRepository->create(array_merge($dto->toArray(), [
                'path' => $path,
            ])
        );

        return $model;
    }

    public function delete(int $id): void
    {
        $solution = $this->projectSolutionRepository->findById($id);
        Storage::delete($solution->path);
        $this->projectSolutionRepository->delete($id);
    }
}
