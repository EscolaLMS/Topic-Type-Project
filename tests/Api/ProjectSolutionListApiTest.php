<?php

namespace EscolaLms\TopicTypeProject\Tests\Api;

use EscolaLms\Core\Tests\CreatesUsers;
use EscolaLms\Courses\Enum\CourseStatusEnum;
use EscolaLms\Courses\Models\Course;
use EscolaLms\Courses\Models\Lesson;
use EscolaLms\Courses\Models\Topic;
use EscolaLms\TopicTypeProject\Database\Seeders\TopicTypeProjectPermissionSeeder;
use EscolaLms\TopicTypeProject\Models\Project;
use EscolaLms\TopicTypeProject\Models\ProjectSolution;
use EscolaLms\TopicTypeProject\Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProjectSolutionListApiTest extends TestCase
{
    use CreatesUsers;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake();
        $this->seed(TopicTypeProjectPermissionSeeder::class);
    }

    public function testListProjectSolutionUnauthorized(): void
    {
        $this->getJson('api/topic-project-solutions')
            ->assertUnauthorized();
    }

    public function testListProjectSolution(): void
    {
        $student = $this->makeStudent();

        ProjectSolution::factory()
            ->state(['user_id' => $student->getKey()])
            ->count(3)
            ->create();

        ProjectSolution::factory()
            ->count(2)
            ->create();

        $this->actingAs($student, 'api')->getJson('api/topic-project-solutions')
            ->assertOk()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [[
                    'id',
                    'created_at',
                    'topic_id',
                    'user_id',
                    'file_url',
                ]],
            ]);
    }
}
