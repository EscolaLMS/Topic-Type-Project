<?php

namespace EscolaLms\TopicTypeProject\Enum;

use EscolaLms\Core\Enums\BasicEnum;

class TopicTypeProjectPermissionEnum extends BasicEnum
{
    public const CREATE_OWN_PROJECT_SOLUTION = 'project-solution_create-own';
    public const LIST_OWN_PROJECT_SOLUTION = 'project-solution_list-own';
    public const DELETE_OWN_PROJECT_SOLUTION = 'project-solution_delete-own';

    public const LIST_PROJECT_SOLUTION = 'project-solution_list';
    public const DELETE_PROJECT_SOLUTION = 'project-solution_delete';
}
