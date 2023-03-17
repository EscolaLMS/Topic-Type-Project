<?php

namespace EscolaLms\TopicTypeProject\Events;

use EscolaLms\Core\Models\User;
use EscolaLms\TopicTypeProject\Models\ProjectSolution;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class ProjectSolutionEvent
{
    use Dispatchable, SerializesModels;

    private User $user;

    private ProjectSolution $projectSolution;

    public function __construct(User $user, ProjectSolution $projectSolution)
    {
        $this->user = $user;
        $this->projectSolution = $projectSolution;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getProjectSolution(): ProjectSolution
    {
        return $this->projectSolution;
    }
}
