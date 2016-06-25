<div class="sidebar">
    <div class="logo">
        @include('svg.sidebar.dashboard_icon')
    </div>


    @if($active_sidebar === 'main' || $active_sidebar === 'user-control')
        <a href="/dashboard/main" title="Dashboard">
            <div class="dashboard @if($active_sidebar === 'main') {{'active'}} @endif">
                @include('svg.sidebar.sub_dashboard_icon')
            </div>
        </a>

        <a href="/dashboard/user-control" title="Control Panel">
            <div class="users @if($active_sidebar === 'user-control') {{'active'}} @endif">
                @include('svg.sidebar.user_list_icon')
            </div>
        </a>

        @if(Auth::user()->role === 'super')
            <a href="/dashboard/manage/users" title="Super User">
                <div class="super-users @if($active_sidebar === 'super-users' || $active_sidebar === 'super-super-users') {{'active'}} @endif">
                    @include('svg.sidebar.super_user_icon')
                </div>
            </a>
        @endif

        <a href="/logout" title="Logout">
            <div class="logout">
                @include('svg.sidebar.logout')
            </div>
        </a>
    @endif

    @if($active_sidebar === 'super-users' || $active_sidebar === 'super-super-users')
        <a href="/dashboard/manage/users" @if($active_sidebar === 'super-users') title="Super User" @endif @if($active_sidebar === 'super-super-users') title="Super Super User" @endif>
            <div class="super-users @if($active_sidebar === 'super-users' || $active_sidebar === 'super-super-users') {{'active'}} @endif">
                @include('svg.sidebar.super_user_icon')
            </div>
        </a>

        <a href="/logout" title="Logout">
            <div class="logout">
                @include('svg.sidebar.logout')
            </div>
        </a>
    @endif

</div>