<?php

namespace App\Observers;

use App\Services\ActivityLogService;

class ActivityObserver
{
    public function created($model): void
    {
        ActivityLogService::log(
            'created',
            'Created ' . class_basename($model),
            $model
        );
    }

    public function updated($model): void
    {
        ActivityLogService::log(
            'updated',
            class_basename($model),
            $model
        );
    }

    public function deleted($model): void
    {
        ActivityLogService::log(
            'deleted',
            'Deleted ' . class_basename($model),
            $model
        );
    }
}
