<div class="selectize-dropdown">
    @foreach($searchResult as $user)
    <div class="inline-items">
        <div class="mega-avatar">
            <img class="img-resonsive img-circle" src="{{ getAvatar($user->avatar) }}" width="25" height="25" alt="{{$user->name}}" onerror="this.src='{{ asset('assets/img/avatar.png') }}'">
        </div>
        <div class="notification-event">
            <a href="{{ route('user.profile', $user->username) }}">{{ $user->name }}</a>
        </div>
    </div>
    @endforeach
</div>
