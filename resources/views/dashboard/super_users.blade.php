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
                    <li class="tab-link @if($active_tab === 'location-list') current @endif" data-tab="tab-1">Location List</li>
                </a>

                <a href="/dashboard/manage/users/add-location">
                    <li class="tab-link @if($active_tab === 'add-location') current @endif add-user" data-tab="tab-2">@include('svg.dashboard.tabs.add_user_tab_icon') Add Location</li>
                </a>




            </ul>

            @if($active_tab === 'location-list')
            {{--Location List Tab--}}
            <div id="tab-1" class="tab-content @if($active_tab === 'location-list') current @endif location-list">

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
                        <tr>
                            <td>
                                Essex Flying school
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

                        <tr>
                            <td>
                                Essex Flying school
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

                        <tr>
                            <td>
                                Essex Flying school
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
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @if($active_tab === 'add-location')
            {{--Add Location Tab--}}
            <div id="tab-2" class="tab-content @if($active_tab === 'add-location') current @endif add-location">

                {{--Add Location Form--}}
                <div class="location-form">
                    <form action="">
                        <div class="section">
                            <div class="subsection">
                                <div class="left">
                                    Location
                                </div>

                                <div class="right">
                                    <input type="text" name="location" placeholder="Name/code">
                                </div>
                            </div>

                            <div class="subsection">
                                <div class="left">
                                    Added to System
                                </div>

                                <div class="right">
                                    <input type="text" name="location" placeholder="Date">
                                </div>
                            </div>
                        </div>

                        <div class="section">
                            <div class="subsection">
                                <div class="left">
                                    Personal Information
                                </div>

                                <div class="right">
                                    <input type="text" name="location" placeholder="Name">
                                </div>
                            </div>

                            <div class="subsection">
                                <div class="left">

                                </div>

                                <div class="right">
                                    <input type="text" name="location" placeholder="Job Position">
                                </div>
                            </div>
                        </div>

                        <div class="section">
                            <div class="subsection">
                                <div class="left">
                                    Login Information
                                </div>

                                <div class="right">
                                    <input type="text" name="location" placeholder="email">
                                </div>
                            </div>

                            <div class="subsection">
                                <div class="left">

                                </div>

                                <div class="right">
                                    <input type="text" name="location" placeholder="password"> @include('svg.dashboard.tabs.invalid_field_tool_tip')
                                </div>
                            </div>
                        </div>

                        <div class="section">
                            <div class="subsection">
                                <div class="left">
                                    Setup Information
                                </div>

                                <div class="right">
                                    <input type="text" name="location" placeholder="static ip">
                                </div>
                            </div>

                            <div class="subsection">
                                <div class="left">

                                </div>

                                <div class="right">
                                    <input type="text" name="location" placeholder="MAC">
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
