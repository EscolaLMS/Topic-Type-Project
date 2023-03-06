<?php

namespace EscolaLms\TopicTypeProject\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EscolaLms\TopicTypeProject\Models\Project;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'value' => $this->faker->text(),
        ];
    }
}
