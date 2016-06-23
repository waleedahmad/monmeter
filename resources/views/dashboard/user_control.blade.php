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
                    <li class="tab-link @if($active_tab === 'user-list') current @endif">User List</li>
                </a>

                <a href="/dashboard/user-control/add-user">
                    <li class="tab-link add-user @if($active_tab === 'add-user') current @endif">@include('svg.dashboard.tabs.add_user_tab_icon') Add User</li>
                </a>

                <a href="/dashboard/user-control/disabled-users">
                    <li class="tab-link disabled-user @if($active_tab === 'disabled-users') current @endif">@include('svg.dashboard.tabs.disabled_users_tab_icon') Disabled User List</li>
                </a>
            </ul>

            @if($active_tab === 'user-list')
                {{--User List Tab--}}
                <div class="tab-content @if($active_tab === 'user-list') current @endif user-list">

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
                            @foreach($clients as $client)
                                <tr>
                                    <td>
                                        {{$client->name}}
                                    </td>

                                    <td>
                                        {{$client->company}}
                                    </td>

                                    <td>
                                        {{$client->added}}
                                    </td>

                                    <td class="edit-column">
                                        @include('svg.dashboard.tabs.user_edit_icon')
                                    </td>

                                    <td class="status-column">
                                        @if(!$client->access)
                                            @include('svg.dashboard.tabs.user_status_hand_icon')
                                        @endif
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if($active_tab === 'add-user')
                {{--Add User Tab--}}
                <div class="tab-content @if($active_tab === 'add-user') current @endif add-user">
                    {{--Add Location Form--}}
                    <div class="add-user-form">
                        <form action="/dashboard/user-control/create" method="POST">
                            <div class="section">
                                <div class="subsection">
                                    <div class="left">
                                        Access Control
                                    </div>

                                    <div class="right">
                                        <ul>
                                            <li>Enable</li>
                                            <li class="access access-enable ticked">@include('svg.dashboard.tabs.user_access_logo')</li>
                                            <li>Disable</li>
                                            <li class="access access-disable">@include('svg.dashboard.tabs.user_access_logo')</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="section">
                                <div class="subsection">
                                    <div class="left">
                                        Personal Information
                                    </div>

                                    <div class="right">
                                        <input type="text" name="name" placeholder="Name" required>
                                    </div>
                                </div>

                                <div class="subsection">
                                    <div class="left">

                                    </div>

                                    <div class="right">
                                        <input type="text" name="company" placeholder="Company" required>
                                    </div>
                                </div>
                            </div>

                            <div class="section">
                                <div class="subsection">
                                    <div class="left">
                                        Added to System
                                    </div>

                                    <div class="right">
                                        <input type="text" name="date" id="uc-date" placeholder="Date" required>
                                    </div>
                                </div>

                            </div>

                            <div class="section">
                                <div class="subsection">
                                    <div class="left">
                                        Card/tag Identifier
                                    </div>

                                    <div class="right">
                                        <input type="text" name="card_identifier" placeholder="0x8D 0xFD 0x72 0x65" required>
                                    </div>
                                </div>
                            </div>

                            <div class="section enotes">
                                <div class="subsection">
                                    <div class="left">
                                        eNotes
                                    </div>

                                    <div class="right">
                                        <textarea name="enotes" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="user-access" id="user-access" value="enabled">
                            {{csrf_field()}}

                            <div class="submit">
                                <input type="submit" value="Create">
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            @if($active_tab === 'disabled-users')
                {{--Disabled Users Tab--}}
                <div class="tab-content @if($active_tab === 'disabled-users') current @endif disabled-users">

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
                            @foreach($clients as $client)
                                <tr>
                                    <td>
                                        {{$client->name}}
                                    </td>

                                    <td>
                                        {{$client->company}}
                                    </td>

                                    <td>
                                        {{$client->added}}
                                    </td>

                                    <td class="edit-column">
                                        @include('svg.dashboard.tabs.user_edit_icon')
                                    </td>

                                    <td class="status-column">
                                        @if(!$client->access)
                                            @include('svg.dashboard.tabs.user_status_hand_icon')
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop
