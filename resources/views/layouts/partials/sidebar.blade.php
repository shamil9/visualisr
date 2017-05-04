<aside class="menu">
    <p class="menu-label">General</p>
    <ul class="menu-list">
        <li>
            <a class="@activeClass('user.home')" href="{{ route('user.home') }}">Visuals</a>
        </li>
        <li>
            <a class="@activeClass('user.favorites')" href="{{ route('user.favorites') }}">Favorites</a>
        </li>
    </ul>
    <p class="menu-label">Account Management</p>
    <ul class="menu-list">
        <li><a>Change Password</a></li>
        <li><a>Change Email</a></li>
        <li><a>Change Avatar</a></li>
        <li>
            <a href="{{ route('twitter.login') }}">Twitter Account
                @if (auth()->user()->twitter_id)
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                @endif
            </a>
        </li>
    </ul>
    @if (auth()->user()->admin)
        <p class="menu-label">Administration</p>
        <ul class="menu-list">
            <li>
                <a class="@activeClass('admin.stats')" href="{{ route('admin.stats') }}">Stats</a>
            </li>
            <li>
                <a class="@activeClass('blog.create')" href="{{ route('blog.create') }}">
                    Add Blog Article
                </a>
            </li>
            <li>
                <a class="@activeClass('users.index')" href="{{ route('users.index') }}">
                    Members
                </a>
            </li>
            <li>
                <a class="@activeClass('contact.index')" href="{{ route('contact.index') }}">
                    Contact messages
                </a>
            </li>
        </ul>
    @endif
</aside>
