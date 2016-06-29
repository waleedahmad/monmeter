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
                    <li class="tab-link @if($active_tab === 'users-list') current @endif">Super Users</li>
                </a>

                @if($active_tab != 'edit-user')
                <a href="/dashboard/manage/super-users/add-user">
                    <li class="tab-link @if($active_tab === 'add-user') current @endif add-user">@include('svg.dashboard.tabs.add_user_tab_icon') Add Super User</li>
                </a>
                @endif

                @if($active_tab === 'edit-user')
                    <a href="/dashboard/manage/super-users/edit-user/{{$su_user->id}}">
                        <li class="tab-link @if($active_tab === 'edit-user') current @endif add-user">@include('svg.dashboard.tabs.add_user_tab_icon') Edit Super User</li>
                    </a>
                @endif

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
                                @if($request->input('sort') === 'desc')
                                    <a href="{{$request->url().'?sort=asc'}}">
                                        @include('svg.dashboard.tabs.filter_down')
                                    </a>
                                @else
                                    <a href="{{$request->url().'?sort=desc'}}">
                                        @include('svg.dashboard.tabs.filter_up')
                                    </a>
                                @endif
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
                        @foreach($ssu_users as $ssu_user)
                            <tr>
                                <td>
                                    {{$ssu_user->email}}
                                </td>

                                <td class="edit-column">
                                    <a href="/dashboard/manage/super-users/edit-user/{{$ssu_user->id}}">
                                        @include('svg.dashboard.tabs.user_edit_icon')
                                    </a>
                                </td>

                                <td class="remove-column">
                                    <a href="#" class="remove-suser" data-id="{{$ssu_user->id}}">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="paginator">
                    {!! $ssu_users->appends($request->except('page'))->links() !!}
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
                                    <input type="email" name="email" id="email" placeholder="Email">
                                </div>
                            </div>

                            <div class="subsection">
                                <div class="left">
                                    Password
                                </div>

                                <div class="right">
                                    <input type="password" name="password" id="password" placeholder="Password">
                                </div>
                            </div>

                            <div class="subsection">
                                <div class="left">
                                    Confirm Password
                                </div>

                                <div class="right">
                                    <input type="password" name="password_confirmation" id="password-confirm" placeholder="Confirm password">
                                </div>
                            </div>
                            {{csrf_field()}}

                            <div class="subsection">
                                <div class="left">
                                </div>

                                <div class="right">
                                    <input type="submit" name="submit" id="create-su-user" value="Create User">
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

            @if($active_tab === 'edit-user')
                {{--Add Location Tab--}}
                <div class="tab-content @if($active_tab === 'edit-user') current @endif edit-user">

                    {{--Add Location Form--}}
                    <div class="edit-user-form">
                        <form action="/dashboard/manage/super-users/update" method="POST">

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
                                        Email
                                    </div>

                                    <div class="right">
                                        <input type="email" name="email" id="email" value="{{$su_user->email}}" data-old-email="{{$su_user->email}}" placeholder="Email">
                                    </div>
                                </div>

                                <div class="subsection">
                                    <div class="left">
                                        Password
                                    </div>

                                    <div class="right">
                                        <input type="password" name="password" id="password" placeholder="Password">
                                    </div>
                                </div>

                                <div class="subsection">
                                    <div class="left">
                                        Confirm Password
                                    </div>

                                    <div class="right">
                                        <input type="password" name="password_confirmation" id="password-confirm" placeholder="Confirm password">
                                    </div>
                                </div>
                                {{csrf_field()}}

                                <div class="subsection">
                                    <div class="left">
                                    </div>

                                    <div class="right">
                                        <input type="submit" name="submit" id="create-su-user" value="Update User">
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
