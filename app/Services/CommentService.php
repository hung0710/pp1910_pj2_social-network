<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use App\Services\ActivityService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommentService
{
    protected $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    /**
     * Store Comment in DB
     *
     * @param Array $data['user_id', 'content', 'post_id']
     * @return Boolean | App\Models\Comment
     */
    public function storeComment($data)
    {
        $senderId = $data['user_id'];
        $post = Post::findOrFail($data['post_id']);
        $receiverId = $post->user->id;

        $activityData = [
            'user_id' => $senderId,
            'post_id' => $data['post_id']
        ];
        $activityData['type'] = config('activity.type.comment');
        DB::beginTransaction();

        try {
            $comment = Comment::create($data);

            if ($senderId != $receiverId) {
                $this->activityService->storeActivity($activityData);
            }

            DB::commit();
        } catch (\Throwable $throwable) {
            Log::error($throwable);

            DB::rollBack();

            return false;
        }

        return $comment;
    }
}