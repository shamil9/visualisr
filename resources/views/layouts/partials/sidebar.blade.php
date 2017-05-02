<aside class="menu">
    <p class="menu-label">General</p>
    <ul class="menu-list">
        <li>
            <a href="{{ route('user.home') }}" class="is-active">Visuals</a>
        </li>
        <li>
            <a href="{{ route('user.favorites') }}">Favorites</a>
        </li>
    </ul>
    <p class="menu-label">Account Management</p>
    <ul class="menu-list">
        <li><a>Change Password</a></li>
        <li><a>Change Email</a></li>
        <li><a>Change Avatar</a></li>
        <li><a>Add Twitter account</a></li>
    </ul>
    @if ($user->admin)
        <p class="menu-label">Administration</p>
        <ul class="menu-list">
            <li>
                <a>Stats</a>
            </li>
            <li><a href="{{ route('blog.create') }}">Add Blog Article</a></li>
            <li><a>Members</a></li>
            <li><a>Visuals</a></li>
            <li><a>Contact messages</a></li>
        </ul>
    @endif
</aside>
