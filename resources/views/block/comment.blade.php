<li>
    <div class="comment-img">
        <img src="{{ getAvatar($comment->user->avatar) }}" class="img-responsive img-circle" alt="{{ $comment->user->name }}"/>
    </div>
    <div class="comment-text">
        <strong><a href="{{ route('user.profile', $comment->user->username) }}">{{ $comment->user->name }}</a></strong>
        <p class="comment-content-{{ $comment->id }}">{{ $comment->content ?? ''}}</p> <span class="date sub-text">{{ getCreatedFromTime($comment) }}</span>
    </div>
</li>