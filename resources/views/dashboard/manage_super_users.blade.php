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

                <a href="/dashboard/manage/super-users/users-list">
                    <li class="tab-link @if($active_tab === 'users-list') current @endif">Super user</li>
                </a>

                <a href="/dashboard/manage/super-users/add-user">
                    <li class="tab-link @if($active_tab === 'add-user') current @endif add-user">@include('svg.dashboard.tabs.add_user_tab_icon') Add super user</li>
                </a>



            </ul>

            @if($active_tab === 'users-list')
            {{--Location List Tab--}}
            <div class="tab-content @if($active_tab === 'users-list') current @endif user-list">

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
                                Remove
                            </td>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($ssu_users as $ssu_user)
                            <tr>
                                <td>
                                    {{$ssu_user->email}}
                                </td>

                                <td class="view">
                                    <a href="">Enabled</a>
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

            @if($active_tab === 'add-user')
            {{--Add Location Tab--}}
            <div class="tab-content @if($active_tab === 'add-user') current @endif add-user">

                {{--Add Location Form--}}
                <div class="add-user-form">
                    <form action="/dashboard/manage/super-users/create" method="POST">
                        <div class="section">
                            <div class="subsection">
                                <div class="left">
                                    Email
                                </div>

                                <div class="right">
                                    <input type="email" name="email" placeholder="Email" required>
                                </div>
                            </div>

                            <div class="subsection">
                                <div class="left">
                                    Password
                                </div>

                                <div class="right">
                                    <input type="password" name="password" placeholder="Password" required>
                                </div>
                            </div>

                            <div class="subsection">
                                <div class="left">
                                    Confirm Password
                                </div>

                                <div class="right">
                                    <input type="password" name="password_confirmation" placeholder="Confirm password" required>
                                </div>
                            </div>
                            {{csrf_field()}}

                            <div class="subsection">
                                <div class="left">
                                </div>

                                <div class="right">
                                    <input type="submit" name="submit" value="Create User">
                                </div>
                            </div>

                            <div class="subsection">
                                <div class="left">
                                </div>

                                <div class="right">
                                    <ul>
                                        @foreach ($errors->all() as $message)
                                            <li>
                                                {{$message}}
                                            </li>
                                        @endforeach
                                    </ul>
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
