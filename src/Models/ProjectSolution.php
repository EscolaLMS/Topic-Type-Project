<?php

namespace EscolaLms\TopicTypeProject\Models;

use EscolaLms\Auth\Models\User;
use EscolaLms\Courses\Models\Topic;
use EscolaLms\TopicTypeProject\Database\Factories\ProjectSolutionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * EscolaLms\TopicTypeProject\Models\ProjectSolution
 *
 * @property int $id
 * @property string $path
 * @property int $topic_id
 * @property int $user_id
 * @property string|null $tutor_feedback
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read User $user
 * @property-read Topic $topic
 *
 */
class ProjectSolution extends Model
{
    use HasFactory;

    protected $table = 'topic_project_solutions';

    protected $fillable = [
        'path',
        'topic_id',
        'user_id',
        'tutor_feedback',
    ];

    protected $casts = [
        'tutor_feedback' => 'string',
    ];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function newFactory(): ProjectSolutionFactory
    {
        return ProjectSolutionFactory::new();
    }
}
