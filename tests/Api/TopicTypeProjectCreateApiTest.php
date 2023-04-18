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
                'notify_users' => [1, 2, 3]
            ])
            ->assertCreated();

        $data = $this->response->getData()->data;
        $project = Project::find($data->topicable->id);

        $this->assertEquals('lorem ipsum', $project->value);
        $this->assertEquals([1, 2, 3], $project->notify_users);
    }

    public function testCreateTopicProjectNotifyUsersEmptyArray(): void
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
                'notify_users' => []
            ])
            ->assertCreated();

        $data = $this->response->getData()->data;
        $project = Project::find($data->topicable->id);

        $this->assertEquals('lorem ipsum', $project->value);
        $this->assertEquals([], $project->notify_users);
    }

    public function testCreateTopicProjectNotifyUsersNullArray(): void
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
                'notify_users' => [null]
            ])
            ->assertCreated();

        $data = $this->response->getData()->data;
        $project = Project::find($data->topicable->id);

        $this->assertEquals('lorem ipsum', $project->value);
        $this->assertEquals([], $project->notify_users);
    }
}
