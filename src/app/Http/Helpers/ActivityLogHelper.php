<?php

namespace App\Http\Helpers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogHelper
{
    public static function generateLogFromMiddleware(Request $request): ActivityLog
    {
        $activityLog = ActivityLog::create([
            'method' => $request->getMethod(),
            'endpoint' => $request->getPathInfo(),
            'request' => $request->all(),
        ]);

        return $activityLog;
    }

    public static function updateLog(int $id, array $data): void
    {
        $activityLog = ActivityLog::find($id);
        $activityLog->update($data);
    }
}
