<?php

namespace EscolaLms\TopicTypeProject\Http\Resources;

use EscolaLms\TopicTypeProject\Models\ProjectSolution;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Schema(
 *      schema="ProjectSolutionResource",
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          type="number"
 *      ),
 *      @OA\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="file_url",
 *          description="file_url",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="topic_id",
 *          description="topic_id",
 *          type="number"
 *      ),
 *      @OA\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="number"
 *      ),
 * )
 *
 */

/**
 * @mixin ProjectSolution
 */
class ProjectSolutionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->getKey(),
            'created_at' => $this->created_at,
            'file_url' => Storage::url($this->path),
            'file_name' => basename($this->path),
            'topic_id' => $this->topic_id,
            'user_id' => $this->user_id,
        ];
    }
}
