<div class="modal fade" id="confirmDeleteModal{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Delete Post') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('Are you sure?. This post will be deleted and you won\'t be able to find it anymore.') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>