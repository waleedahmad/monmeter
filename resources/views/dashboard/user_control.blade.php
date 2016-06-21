@extends('index')

@section('title')
    User Control - Monmeter
@stop()

@section('user-control')

    {{--Sidebar--}}
    @include('dashboard.sidebar')

    {{--User Control Panel--}}
    <div class="user-control">

        {{--Header--}}
        <div class="header">
            @include('svg.dashboard.header.user_control_header')
        </div>

        {{--Content--}}
        <div class="content">

            {{--Tabs--}}
            <ul class="tabs">
                <a href="/dashboard/user-control/user-list">
                    <li class="tab-link @if($active_tab === 'user-list') current @endif" data-tab="tab-1">User List</li>
                </a>

                <a href="/dashboard/user-control/add-user">
                    <li class="tab-link add-user @if($active_tab === 'add-user') current @endif" data-tab="tab-2">@include('svg.dashboard.tabs.add_user_tab_icon') Add User</li>
                </a>

                <a href="/dashboard/user-control/disabled-users">
                    <li class="tab-link disabled-user @if($active_tab === 'disabled-users') current @endif" data-tab="tab-3">@include('svg.dashboard.tabs.disabled_users_tab_icon') Disabled User List</li>
                </a>
            </ul>

            {{--User List Tab--}}
            <div id="tab-1" class="tab-content @if($active_tab === 'user-list') current @endif user-list">

                {{--User List Table--}}
                <div class="data">
                    <table>
                        <thead>
                        <tr>
                            <td>
                                Name
                            </td>

                            <td>
                                Company
                            </td>

                            <td>
                                Data issued
                            </td>

                            <td>
                                Edit
                            </td>

                            <td>
                                Status
                            </td>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td>
                                Nick Chan
                            </td>

                            <td>
                                Star Fuels
                            </td>

                            <td>
                                21 Jun 2016
                            </td>

                            <td>
                                @include('svg.dashboard.tabs.user_edit_icon')
                            </td>

                            <td>

                            </td>
                        </tr>

                        <tr>
                            <td>
                                Nick Chan
                            </td>

                            <td>
                                Star Fuels
                            </td>

                            <td>
                                21 Jun 2016
                            </td>

                            <td>
                                @include('svg.dashboard.tabs.user_edit_icon')
                            </td>

                            <td>
                                @include('svg.dashboard.tabs.log_history_status_hand_icon')
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Nick Chan
                            </td>

                            <td>
                                Star Fuels
                            </td>

                            <td>
                                21 Jun 2016
                            </td>

                            <td>
                                @include('svg.dashboard.tabs.user_edit_icon')
                            </td>

                            <td>

                            </td>
                        </tr>

                        <tr>
                            <td>
                                Nick Chan
                            </td>

                            <td>
                                Star Fuels
                            </td>

                            <td>
                                21 Jun 2016
                            </td>

                            <td>
                                @include('svg.dashboard.tabs.user_edit_icon')
                            </td>

                            <td>

                            </td>
                        </tr>

                        <tr>
                            <td>
                                Nick Chan
                            </td>

                            <td>
                                Star Fuels
                            </td>

                            <td>
                                21 Jun 2016
                            </td>

                            <td>
                                @include('svg.dashboard.tabs.user_edit_icon')
                            </td>

                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                Nick Chan
                            </td>

                            <td>
                                Star Fuels
                            </td>

                            <td>
                                21 Jun 2016
                            </td>

                            <td>
                                @include('svg.dashboard.tabs.user_edit_icon')
                            </td>

                            <td>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{--Add User Tab--}}
            <div id="tab-2" class="tab-content @if($active_tab === 'add-user') current @endif">
                Add User
            </div>

            {{--Disabled Users Tab--}}
            <div id="tab-3" class="tab-content @if($active_tab === 'disabled-users') current @endif disabled-users">

                {{--Disabled Users Table--}}
                <div class="data">
                    <table>
                        <thead>
                            <tr>
                                <td>
                                    Name
                                </td>

                                <td>
                                    Company
                                </td>

                                <td>
                                    Data issued
                                </td>

                                <td>
                                    Edit
                                </td>

                                <td>
                                    Status
                                </td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    Lee Hargreaves
                                </td>

                                <td>
                                    AKA Flying School
                                </td>

                                <td>
                                    21 Jun 2016
                                </td>

                                <td>
                                    @include('svg.dashboard.tabs.user_edit_icon')
                                </td>

                                <td>
                                    @include('svg.dashboard.tabs.log_history_status_hand_icon')
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@stop
