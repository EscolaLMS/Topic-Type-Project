<?php

namespace EscolaLms\TopicTypeProject\Tests\Api;

use EscolaLms\Core\Tests\CreatesUsers;
use EscolaLms\Courses\Database\Seeders\CoursesPermissionSeeder;
use EscolaLms\Courses\Models\Course;
use EscolaLms\Courses\Models\Lesson;
use EscolaLms\Courses\Models\Topic;
use EscolaLms\TopicTypeProject\Models\Project;
use EscolaLms\TopicTypeProject\Tests\TestCase;

class TopicTypeProjectClientApiTest extends TestCase
{
    use CreatesUsers;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CoursesPermissionSeeder::class);

        $this->user = $this->makeAdmin();
        $this->topic = Topic::factory()
            ->for(Lesson::factory()
                ->for(Course::factory()))
            ->create();
    }

    public function testGetProjectTopic(): void
    {
        $project = Project::factory()->create();
        $this->topic->topicable()->associate($project)->save();

        $this->actingAs($this->user, 'api')
            ->getJson('/api/admin/topics/' . $this->topic->getKey())
            ->assertOk()
            ->assertJsonFragment([
                'topicable_type' => Project::class,
            ]);
    }
}
