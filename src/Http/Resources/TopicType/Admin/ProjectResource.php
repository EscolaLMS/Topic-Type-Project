<?php

namespace EscolaLms\TopicTypeProject\Http\Resources\TopicType\Admin;

use EscolaLms\TopicTypes\Http\Resources\TopicType\Contacts\TopicTypeResourceContract;
use EscolaLms\TopicTypeProject\Models\Project;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Project
 */
class ProjectResource extends JsonResource implements TopicTypeResourceContract
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
            'notify_users' => $this->notify_users,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
