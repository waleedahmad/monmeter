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

                @if($active_tab != 'edit-user')
                <a href="/dashboard/user-control/add-user">
                    <li class="tab-link add-user @if($active_tab === 'add-user') current @endif">@include('svg.dashboard.tabs.add_user_tab_icon') Add User</li>
                </a>
                @endif

                @if($active_tab === 'edit-user')
                <a href="/dashboard/user-control/add-user">
                    <li class="tab-link add-user @if($active_tab === 'edit-user') current @endif">@include('svg.dashboard.tabs.add_user_tab_icon') Edit User</li>
                </a>
                @endif

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
                                    @if($request->input('sort') === 'desc' && $request->input('orderBy') === 'name')
                                        <a href="{{$request->url().'?sort=asc&orderBy=name'}}">
                                            @include('svg.dashboard.tabs.filter_down')
                                        </a>
                                    @else
                                        <a href="{{$request->url().'?sort=desc&orderBy=name'}}">
                                            @include('svg.dashboard.tabs.filter_up')
                                        </a>
                                    @endif
                                </td>

                                <td>
                                    Company

                                    @if($request->input('sort') === 'desc' && $request->input('orderBy') === 'company')
                                        <a href="{{$request->url().'?sort=asc&orderBy=company'}}">
                                            @include('svg.dashboard.tabs.filter_down')
                                        </a>
                                    @else
                                        <a href="{{$request->url().'?sort=desc&orderBy=company'}}">
                                            @include('svg.dashboard.tabs.filter_up')
                                        </a>
                                    @endif
                                </td>

                                <td>
                                    Data issued

                                    @if($request->input('sort') === 'desc' && $request->input('orderBy') === 'added')
                                        <a href="{{$request->url().'?sort=asc&orderBy=added'}}">
                                            @include('svg.dashboard.tabs.filter_down')
                                        </a>
                                    @else
                                        <a href="{{$request->url().'?sort=desc&orderBy=added'}}">
                                            @include('svg.dashboard.tabs.filter_up')
                                        </a>
                                    @endif
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
                                        <a href="/dashboard/user-control/edit-user/{{$client->id}}">
                                            @include('svg.dashboard.tabs.user_edit_icon')
                                        </a>
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
                                        <input type="text" name="name" id="name" placeholder="Name">
                                    </div>
                                </div>

                                <div class="subsection">
                                    <div class="left">

                                    </div>

                                    <div class="right">
                                        <input type="text" name="company" id="company" placeholder="Company">
                                    </div>
                                </div>
                            </div>

                            <div class="section">
                                <div class="subsection">
                                    <div class="left">
                                        Added to System
                                    </div>

                                    <div class="right">
                                        <input type="text" name="date" id="uc-date" placeholder="Date">
                                    </div>
                                </div>

                            </div>

                            <div class="section">
                                <div class="subsection">
                                    <div class="left">
                                        Card/tag Identifier
                                    </div>

                                    <div class="right">
                                        <input type="text" name="card_identifier" id="card-identifier" placeholder="0x8D 0xFD 0x72 0x65">
                                    </div>
                                </div>
                            </div>

                            <div class="section enotes">
                                <div class="subsection">
                                    <div class="left">
                                        eNotes
                                    </div>

                                    <div class="right">
                                        <textarea name="enote" id="enotes"></textarea>
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
                                    @if($request->input('sort') === 'desc' && $request->input('orderBy') === 'name')
                                        <a href="{{$request->url().'?sort=asc&orderBy=name'}}">
                                            @include('svg.dashboard.tabs.filter_down')
                                        </a>
                                    @else
                                        <a href="{{$request->url().'?sort=desc&orderBy=name'}}">
                                            @include('svg.dashboard.tabs.filter_up')
                                        </a>
                                    @endif
                                </td>

                                <td>
                                    Company

                                    @if($request->input('sort') === 'desc' && $request->input('orderBy') === 'company')
                                        <a href="{{$request->url().'?sort=asc&orderBy=company'}}">
                                            @include('svg.dashboard.tabs.filter_down')
                                        </a>
                                    @else
                                        <a href="{{$request->url().'?sort=desc&orderBy=company'}}">
                                            @include('svg.dashboard.tabs.filter_up')
                                        </a>
                                    @endif
                                </td>

                                <td>
                                    Data issued

                                    @if($request->input('sort') === 'desc' && $request->input('orderBy') === 'added')
                                        <a href="{{$request->url().'?sort=asc&orderBy=added'}}">
                                            @include('svg.dashboard.tabs.filter_down')
                                        </a>
                                    @else
                                        <a href="{{$request->url().'?sort=desc&orderBy=added'}}">
                                            @include('svg.dashboard.tabs.filter_up')
                                        </a>
                                    @endif
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
                                        <a href="/dashboard/user-control/edit-user/{{$client->id}}">
                                            @include('svg.dashboard.tabs.user_edit_icon')
                                        </a>
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

            @if($active_tab === 'edit-user')
                {{--Add User Tab--}}
                <div class="tab-content @if($active_tab === 'edit-user') current @endif edit-user">
                    {{--Add Location Form--}}
                    <div class="edit-user-form">
                        <form action="/dashboard/user-control/update" method="POST">

                            <div class="messages">
                                <div class="message edit-message">
                                    <div class="icon">
                                        @include('svg.dashboard.tabs.edit_mode_icon')
                                    </div>
                                    <div class="text">
                                        You are now in Edit mode
                                    </div>
                                </div>

                                <div class="message disabled-message @if($client->access){{'hide'}}@endif">

                                    <div class="icon">
                                        @include('svg.dashboard.tabs.edit_mode_disable_user_icon')
                                    </div>
                                    <div class="text">
                                        User has been Disabled - This user can't access this system
                                    </div>
                                </div>
                            </div>

                            <div class="section">
                                <div class="subsection">
                                    <div class="left">
                                        Access Control
                                    </div>

                                    <div class="right">
                                        <ul>
                                            <li>Enable</li>
                                            <li class="access access-enable @if($client->access) ticked @endif">@include('svg.dashboard.tabs.user_access_logo')</li>
                                            <li>Disable</li>
                                            <li class="access access-disable @if(!$client->access) ticked @endif">@include('svg.dashboard.tabs.user_access_logo')</li>
                                        </ul>

                                        <input type="button" value="Update" class="accessUpdateBtn">
                                    </div>
                                </div>
                            </div>

                            <div class="section">
                                <div class="subsection">
                                    <div class="left">
                                        Personal Information
                                    </div>

                                    <div class="right">
                                        <input type="text" name="name" id="name" placeholder="Name" value="{{$client->name}}" >
                                    </div>
                                </div>

                                <div class="subsection">
                                    <div class="left">

                                    </div>

                                    <div class="right">
                                        <input type="text" name="company" id="company" placeholder="Company" value="{{$client->company}}">
                                    </div>
                                </div>
                            </div>

                            <div class="section">
                                <div class="subsection">
                                    <div class="left">
                                        Added to System
                                    </div>

                                    <div class="right">
                                        <input type="text" name="date" id="uc-date" placeholder="Date"  value="{{$client->added}}">
                                    </div>
                                </div>

                            </div>

                            <div class="section">
                                <div class="subsection">
                                    <div class="left">
                                        Card/tag Identifier
                                    </div>

                                    <div class="right">
                                        <input type="text" name="card_identifier" id="card-identifier" placeholder="0x8D 0xFD 0x72 0x65" value="{{$client->card_tag}}" data-old-tag="{{$client->card_tag}}">
                                    </div>
                                </div>
                            </div>

                            <div class="section enotes">
                                <div class="subsection">
                                    <div class="left">
                                        eNotes
                                    </div>

                                    <div class="right">
                                        <textarea name="enote" id="enotes">{{$client->enote}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="user_access" id="user-access" value="@if($client->access){{'enabled'}}@else{{'disabled'}}@endif">
                            <input type="hidden" name="client_id" id="client-id" value="{{$client->id}}">
                            {{csrf_field()}}

                            <div class="submit">
                                <input type="submit" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop
