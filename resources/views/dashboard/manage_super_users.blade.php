@extends('index')

@section('title')
    Super Super Users - Monmeter
@stop()

@section('user-control')

    {{--Sidebar--}}
    @include('dashboard.sidebar')

    {{--Manage Super User Panel--}}
    <div class="manage-super-user">

        {{--Header--}}
        <div class="header">
            @include('svg.dashboard.header.super_super_user_header')
        </div>

        {{--Content--}}
        <div class="content">

            {{--Tabs--}}
            <ul class="tabs">
                <li class="tab-link current" data-tab="tab-1">Super user</li>
                <li class="tab-link add-user" data-tab="tab-2">@include('svg.dashboard.tabs.add_user_tab_icon') Add super user</li>
            </ul>

            {{--Location List Tab--}}
            <div id="tab-1" class="tab-content current user-list">

                {{--Locations Table--}}
                <div class="data">
                    <table>
                        <thead>
                        <tr>
                            <td>
                                Email
                            </td>

                            <td>
                                Status
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
                                useremail@gmail.com
                            </td>

                            <td class="view">
                                <a href="">Enabled</a>
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
                                useremail@gmail.com
                            </td>

                            <td class="view">
                                <a href="">Disabled</a>
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
                                useremail@gmail.com
                            </td>

                            <td class="view">
                                <a href="">Enabled</a>
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

            {{--Add Location Tab--}}
            <div id="tab-2" class="tab-content  add-user">

                {{--Add Location Form--}}
                <div class="add-user-form">
                    <form action="">
                        <div class="section">
                            <div class="subsection">
                                <div class="left">
                                    Email
                                </div>

                                <div class="right">
                                    <input type="text" name="location" placeholder="Email">
                                </div>
                            </div>

                            <div class="subsection">
                                <div class="left">
                                    Password
                                </div>

                                <div class="right">
                                    <input type="text" name="location" placeholder="Password">
                                </div>
                            </div>

                            <div class="subsection">
                                <div class="left">
                                    Confirm Password
                                </div>

                                <div class="right">
                                    <input type="text" name="location" placeholder="Confirm password">
                                </div>
                            </div>

                            <div class="subsection">
                                <div class="left">
                                </div>

                                <div class="right">
                                    <input type="button" name="submit" value="Create User">
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
