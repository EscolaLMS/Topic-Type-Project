<?php

namespace EscolaLms\TopicTypeProject\Database\Factories;

use EscolaLms\Auth\Models\User;
use EscolaLms\Courses\Enum\CourseStatusEnum;
use EscolaLms\Courses\Models\Course;
use EscolaLms\Courses\Models\Lesson;
use EscolaLms\Courses\Models\Topic;
use EscolaLms\TopicTypeProject\Models\ProjectSolution;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectSolutionFactory extends Factory
{
    protected $model = ProjectSolution::class;

    public function definition(): array
    {
        return [
            'path' => $this->faker->filePath(),
            'user_id' => User::factory(),
            'topic_id' => Topic::factory()
                ->has(Lesson::factory()
                    ->has(Course::factory()->state(['status' => CourseStatusEnum::PUBLISHED]))
                )
        ];
    }
}
