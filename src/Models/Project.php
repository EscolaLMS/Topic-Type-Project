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
 *      )
 * )
 */

/**
 * EscolaLms\TopicTypeProject\Models\Project
 *
 * @property int $id
 * @property string $value
 * @property array $notify_users
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class Project extends AbstractTopicContent
{
    use HasFactory;

    public $table = 'topic_projects';

    protected $casts = [
        'notify_users' => 'array'
    ];

    protected $attributes = [
        'notify_users' => '[]'
    ];

    protected $fillable = [
        'value',
        'notify_users'
    ];

    public static function rules(): array
    {
        return [
            'value' => ['required', 'string'],
            'notify_users' => ['array'],
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
