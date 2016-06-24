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

                <a href="/dashboard/manage/users/add-location">
                    <li class="tab-link @if($active_tab === 'add-location') current @endif add-user">@include('svg.dashboard.tabs.add_user_tab_icon') Add Location</li>
                </a>
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
                                        <a href="">View</a>
                                    </td>

                                    <td class="edit">
                                        <a href="">Edit</a>
                                    </td>

                                    <td class="remove">
                                        <a href="">Remove</a>
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
        </div>
    </div>
@stop
