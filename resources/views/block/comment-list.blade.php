@foreach ($post->parentComments as $comment)
    @include('block.comment', ['comment' => $comment])
@endforeach