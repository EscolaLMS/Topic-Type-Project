<?php

namespace EscolaLms\TopicTypeProject\Models;

use EscolaLms\TopicTypeProject\Database\Factories\ProjectFactory;
use EscolaLms\TopicTypes\Facades\Markdown;
use EscolaLms\TopicTypes\Models\TopicContent\AbstractTopicContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * @OA\Schema(
 *      schema="TopicProject",
 *      required={"value"},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          @OA\Schema(
 *             type="integer",
 *         )
 *      ),
 *      @OA\Property(
 *          property="value",
 *          description="value",
 *          type="string"
 *      )
 * )
 */

/**
 * EscolaLms\TopicTypeProject\Models\Project
 *
 * @property int $id
 * @property string $value
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class Project extends AbstractTopicContent
{
    use HasFactory;

    public $table = 'topic_projects';

    public static function rules(): array
    {
        return [
            'value' => ['required', 'string'],
        ];
    }

    protected static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }

    public function fixAssetPaths(): array
    {
        $topic = $this->topic;
        $course = $topic->lesson->course;
        $destinationPrefix = sprintf('course/%d/topic/%d/', $course->id, $topic->id);

        $result = Markdown::convertImagesPathsForImageApi($this->value, $destinationPrefix);

        if ($result['value'] !== $this->value) {
            $this->value = $result['value'];
            $this->save();
        }

        return $result['results'];
    }

    public function getMorphClass()
    {
        return self::class;
    }
}
