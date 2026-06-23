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
 *      ),
 *      @OA\Property(
 *          property="notify_users",
 *          description="notify_users",
 *          type="array",
 *          @OA\Items(
 *              type="integer",
 *          )
 *      ),
 *      @OA\Property(
 *          property="counts_to_grade",
 *          description="whether the project counts towards the final grade",
 *          type="boolean"
 *      ),
 *      @OA\Property(
 *          property="max_score",
 *          description="maximum obtainable score for the project (same for all solutions)",
 *          type="number"
 *      )
 * )
 */

/**
 * EscolaLms\TopicTypeProject\Models\Project
 *
 * @property int $id
 * @property string $value
 * @property array $notify_users
 * @property bool $counts_to_grade
 * @property ?float $max_score
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class Project extends AbstractTopicContent
{
    use HasFactory;

    public $table = 'topic_projects';

    protected $casts = [
        'notify_users' => 'array',
        'counts_to_grade' => 'boolean',
        'max_score' => 'float',
    ];

    protected $attributes = [
        'notify_users' => '[]'
    ];

    protected $fillable = [
        'value',
        'notify_users',
        'counts_to_grade',
        'max_score',
    ];

    public static function rules(): array
    {
        return [
            'value' => ['required', 'string'],
            'notify_users' => ['array'],
            'counts_to_grade' => ['boolean'],
            'max_score' => ['nullable', 'numeric', 'min:1'],
        ];
    }

    protected static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }

    public function setNotifyUsersAttribute($value): void
    {
        $this->attributes['notify_users'] = json_encode(array_filter($value), JSON_NUMERIC_CHECK);
    }

    public function getMorphClass()
    {
        return self::class;
    }
}
