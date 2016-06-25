@extends('index')

@section('title')
    Manage Users - Monmeter
@stop()

@section('user-control')

    {{--Sidebar--}}
    @include('dashboard.sidebar')

    {{--Super User Control Panel--}}
    <div class="super-user-control">

        {{--Header--}}
        <div class="header">
            @include('svg.dashboard.header.super_user_header')
        </div>

        {{--Content--}}
        <div class="content">

            {{--Tabs--}}
            <ul class="tabs">

                <a href="/dashboard/manage/users/location-list">
                    <li class="tab-link @if($active_tab === 'location-list') current @endif">Location List</li>
                </a>

                @if($active_tab != 'edit-location')
                <a href="/dashboard/manage/users/add-location">
                    <li class="tab-link @if($active_tab === 'add-location') current @endif add-user">@include('svg.dashboard.tabs.add_user_tab_icon') Add Location</li>
                </a>
                @endif

                @if($active_tab === 'edit-location')
                    <a href="/dashboard/manage/users/add-location">
                        <li class="tab-link @if($active_tab === 'edit-location') current @endif add-user">@include('svg.dashboard.tabs.add_user_tab_icon') Edit Location</li>
                    </a>
                @endif
            </ul>

            @if($active_tab === 'location-list')
            {{--Location List Tab--}}
            <div class="tab-content @if($active_tab === 'location-list') current @endif location-list">

                {{--Locations Table--}}
                <div class="data">
                    <table>
                        <thead>
                        <tr>
                            <td>
                                Location
                            </td>

                            <td>
                                Control Panel
                            </td>

                            <td>
                                Edit
                            </td>

                            <td>
                                Remove
                            </td>
                        </tr>
                        </thead>

                        <tbody>

                            @foreach($locations as $location)
                                <tr>
                                    <td>
                                        {{$location->location}}
                                    </td>

                                    <td class="view">
                                        <a href="/dashboard/manage/view/{{$location->user_id}}" target="_blank">View</a>
                                    </td>

                                    <td class="edit">
                                        <a href="/dashboard/manage/users/edit/{{$location->user_id}}">Edit</a>
                                    </td>

                                    <td class="remove">
                                        <a href="#" class="remove-location" data-id="{{$location->user_id}}">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @if($active_tab === 'add-location')
            {{--Add Location Tab--}}
            <div class="tab-content @if($active_tab === 'add-location') current @endif add-location">

                {{--Add Location Form--}}
                <div class="location-form">
                    <form action="/dashboard/manage/users/create" method="POST">
                        <div class="section">
                            <div class="subsection">
                                <div class="left">
                                    Location
                                </div>

                                <div class="right">
                                    <input type="text" name="loc_name" id="loc-name" placeholder="Name/code">
                                </div>
                            </div>

                            <div class="subsection">
                                <div class="left">
                                    Added to System
                                </div>

                                <div class="right">
                                    <input type="text" name="date" id="loc-date" id="loc-date" placeholder="Date">
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
                                    <input type="text" name="job_position" id="job-position" placeholder="Job Position">
                                </div>
                            </div>
                        </div>

                        <div class="section">
                            <div class="subsection">
                                <div class="left">
                                    Login Information
                                </div>

                                <div class="right">
                                    <input type="email" name="email" id="email" placeholder="email">
                                </div>
                            </div>

                            <div class="subsection">
                                <div class="left">

                                </div>

                                <div class="right">
                                    <input type="password" name="password" id="password" placeholder="password">
                                </div>
                            </div>
                        </div>

                        <div class="section">
                            <div class="subsection">
                                <div class="left">
                                    Setup Information
                                </div>

                                <div class="right">
                                    <input type="text" name="static_ip" id="static-ip" placeholder="static ip">
                                </div>
                            </div>

                            <div class="subsection">
                                <div class="left">

                                </div>

                                <div class="right">
                                    <input type="text" name="mac" placeholder="MAC" id="mac">
                                </div>
                            </div>
                            {{csrf_field()}}
                            <div class="subsection">
                                <div class="left">
                                </div>

                                <div class="right">
                                    <input type="submit" name="submit" id="add-client" value="Create">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            @endif

            @if($active_tab === 'edit-location')
                {{--Add Location Tab--}}
                <div class="tab-content @if($active_tab === 'edit-location') current @endif edit-location">

                    {{--Add Location Form--}}
                    <div class="edit-location-form">
                        <form action="/dashboard/manage/users/update" method="POST">

                            <div class="messages">
                                <div class="message edit-message">
                                    <div class="icon">
                                        @include('svg.dashboard.tabs.edit_mode_icon')
                                    </div>
                                    <div class="text">
                                        You are now in Edit mode
                                    </div>
                                </div>

                            </div>

                            <div class="section">
                                <div class="subsection">
                                    <div class="left">
                                        Location
                                    </div>

                                    <div class="right">
                                        <input type="text" name="loc_name" id="loc-name" value="{{$location->location}}" placeholder="Name/code">
                                    </div>
                                </div>

                                <div class="subsection">
                                    <div class="left">
                                        Added to System
                                    </div>

                                    <div class="right">
                                        <input type="text" name="date" id="loc-date" id="loc-date" value="{{$location->added}}" placeholder="Date">
                                    </div>
                                </div>
                            </div>

                            <div class="section">
                                <div class="subsection">
                                    <div class="left">
                                        Personal Information
                                    </div>

                                    <div class="right">
                                        <input type="text" name="name" id="name" value="{{$location->name}}" placeholder="Name">
                                    </div>
                                </div>

                                <div class="subsection">
                                    <div class="left">

                                    </div>

                                    <div class="right">
                                        <input type="text" name="job_position" id="job-position" value="{{$location->job_position}}" placeholder="Job Position">
                                    </div>
                                </div>
                            </div>

                            <div class="section">
                                <div class="subsection">
                                    <div class="left">
                                        Login Information
                                    </div>

                                    <div class="right">
                                        <input type="email" name="email" id="email" value="{{$location->email}}" data-old-email="{{$location->email}}" placeholder="email">
                                    </div>
                                </div>

                                <div class="subsection">
                                    <div class="left">

                                    </div>

                                    <div class="right">
                                        <input type="password" name="password" id="password" placeholder="password">
                                    </div>
                                </div>
                            </div>

                            <div class="section">
                                <div class="subsection">
                                    <div class="left">
                                        Setup Information
                                    </div>

                                    <div class="right">
                                        <input type="text" name="static_ip" id="static-ip" value="{{$location->static_ip}}" placeholder="static ip">
                                    </div>
                                </div>

                                <div class="subsection">
                                    <div class="left">

                                    </div>

                                    <div class="right">
                                        <input type="text" name="mac" placeholder="MAC" value="{{$location->mac_address}}" id="mac">
                                    </div>
                                </div>
                                {{csrf_field()}}

                                <input type="hidden" id="user-id" value="{{$location->user_id}}">

                                <div class="subsection">
                                    <div class="left">
                                    </div>

                                    <div class="right">
                                        <input type="submit" name="submit" id="add-client" value="Update">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop
