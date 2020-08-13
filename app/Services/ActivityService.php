<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\Activity;
use App\Services\FriendService;

class ActivityService
{
    protected $friendService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Store Activity in database.
     *
     * @param Array $data['user_id', 'post_id', 'status']
     * @return Boolean
     */
    public function storeActivity($data)
    {
        try {
            Activity::create($data);
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }

    /**
     * Delete Activity
     *
     * @param int $postId
     * @return boolean
     *
     */
    public function deleteActivity($postId)
    {
        $activity = Activity::where('post_id', $postId);

        try {
            $activity->delete();
        } catch (\Throwable $throwable) {
            Log::error($throwable);

            return false;
        }

        return true;
    }
}
