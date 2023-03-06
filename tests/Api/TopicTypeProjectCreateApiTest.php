<?php

namespace EscolaLms\TopicTypeProject\Tests\Api;

use EscolaLms\Core\Tests\CreatesUsers;
use EscolaLms\Courses\Database\Seeders\CoursesPermissionSeeder;
use EscolaLms\Courses\Models\Course;
use EscolaLms\Courses\Models\Lesson;
use EscolaLms\TopicTypeProject\Models\Project;
use EscolaLms\TopicTypeProject\Tests\TestCase;

class TopicTypeProjectCreateApiTest extends TestCase
{
    use CreatesUsers;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CoursesPermissionSeeder::class);
    }

    public function testCreateTopicProject(): void
    {
        $lesson = Lesson::factory()
            ->for(Course::factory())
            ->create();

        $this->response = $this->actingAs($this->makeAdmin(), 'api')
            ->postJson('/api/admin/topics', [
                'title' => 'Hello World',
                'lesson_id' => $lesson->getKey(),
                'topicable_type' => Project::class,
                'value' => 'lorem ipsum',
            ])
            ->assertCreated();

        $data = $this->response->getData()->data;
        $value = $data->topicable->value;

        $this->assertDatabaseHas('topic_projects', [
            'value' => $value,
        ]);
    }
}
