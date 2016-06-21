<div class="sidebar">
    <div class="logo">
        @include('svg.sidebar.dashboard_icon')
    </div>


    @if($active_sidebar === 'main' || $active_sidebar === 'user-control')
        <a href="/dashboard/main">
            <div class="dashboard @if($active_sidebar === 'main') {{'active'}} @endif">
                @include('svg.sidebar.sub_dashboard_icon')
            </div>
        </a>

        <a href="/dashboard/user-control">
            <div class="users @if($active_sidebar === 'user-control') {{'active'}} @endif">
                @include('svg.sidebar.user_list_icon')
            </div>
        </a>

        <div class="label">
            <p>
                Development version 1.1v
            </p>

            <ul>
                <li>
                    - System accuracy +/- 0.5% or better
                </li>
                <li>
                    - If counter records zero (0). User logged
                    on, but...
                </li>
                <li>
                    <ul>
                        <li>
                            - did not dispense fuel
                        </li>
                        <li>
                            - was timed out by the systems
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    @endif

    @if($active_sidebar === 'super-users' || $active_sidebar === 'super-super-users')
        <a href="/dashboard/manage/users">
            <div class="super-users @if($active_sidebar === 'super-users' || $active_sidebar === 'super-super-users') {{'active'}} @endif">
                @include('svg.sidebar.super_user_icon')
            </div>
        </a>
    @endif
</div>