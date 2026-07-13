<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;

class ActivityLogService
{
    public static function log(
        string $action,
        string $description,
        ?Model $entity = null,
        ?array $metadata = null,
    ): void {
        $user = currentUser();
        ActivityLog::create([
            'user_id' => $user?->id,
            'action' => $action,
            'entity_type' => $entity
                ? class_basename($entity)
                : null,
            'entity_id' => $entity?->id,
            'description' => $description,
            'metadata' => $metadata??null,
        ]);
    }
}
