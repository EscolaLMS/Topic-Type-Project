<?php

namespace EscolaLms\TopicTypeProject\Services\Contracts;

use EscolaLms\TopicTypeProject\Dtos\CreateProjectSolutionDto;
use EscolaLms\TopicTypeProject\Dtos\CriteriaDto;
use EscolaLms\TopicTypeProject\Dtos\PageDto;
use EscolaLms\TopicTypeProject\Models\ProjectSolution;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProjectSolutionServiceContract
{
    public function findAll(CriteriaDto $criteriaDto, PageDto $pageDto): LengthAwarePaginator;
    public function findAllByUser(CriteriaDto $criteriaDto, PageDto $pageDto, int $userId): LengthAwarePaginator;
    public function create(CreateProjectSolutionDto $dto): ProjectSolution;
    public function delete(int $id): void;
}
