<div class="sidebar">
    <div class="logo">
        @include('svg.sidebar.dashboard_icon')
    </div>


    @if($_SERVER['REQUEST_URI'] === '/dashboard/main' || $_SERVER['REQUEST_URI'] === '/dashboard/user-control')
        <a href="/dashboard/main">
            <div class="dashboard @if($_SERVER['REQUEST_URI'] === '/dashboard/main') {{'active'}} @endif">
                @include('svg.sidebar.sub_dashboard_icon')
            </div>
        </a>

        <a href="/dashboard/user-control">
            <div class="users @if($_SERVER['REQUEST_URI'] === '/dashboard/user-control') {{'active'}} @endif">
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

    @if($_SERVER['REQUEST_URI'] === '/dashboard/manage/users' || $_SERVER['REQUEST_URI'] === '/dashboard/manage/super-users')
        <a href="/dashboard/manage/users">
            <div class="super-users @if($_SERVER['REQUEST_URI'] === '/dashboard/manage/users' || $_SERVER['REQUEST_URI'] === '/dashboard/manage/super-users') {{'active'}} @endif">
                @include('svg.sidebar.super_user_icon')
            </div>
        </a>
    @endif
</div>