@extends('index')

@section('title')
    Dashboard - Monmeter
@stop()

@section('dashboard')

    {{--Sidebar--}}
    @include('dashboard.sidebar')

    <div class="dashboard">

        {{--Header--}}
        <div class="header">
            @include('svg.dashboard.header.dashboard_header')
        </div>

        {{--Content--}}
        <div class="content">

            {{--Tabs--}}
            <ul class="tabs">
                <a href="/dashboard/main/real-time">
                    <li class="tab-link @if($active_tab === 'real-time') current @endif">Real Time</li>
                </a>

                <a href="/dashboard/main/last-reading">
                    <li class="tab-link add-user @if($active_tab === 'last-reading') current @endif" > Last Reading</li>
                </a>

                <a href="/dashboard/main/log-history">
                    <li class="tab-link disabled-user @if($active_tab === 'log-history') current @endif" > Log History</li>
                </a>
            </ul>

            @if($active_tab === 'real-time')
            {{--Realtime Tab Content--}}
            <div class="tab-content @if($active_tab === 'real-time') current @endif real-time">
                {{--Header--}}
                <div class="tab-header">

                    {{--Client Details--}}
                    <div class="details">
                        <div class="left">
                            <p>
                                Name
                            </p>
                            <p>
                                Data & time activated
                            </p>
                        </div>

                        <div class="right">
                            <p>
                                {{$admin->name}}
                            </p>
                            <p>
                                {{$admin->added}} | {{date_format(new \DateTime($admin->created_at), 'H:i:s')}}
                            </p>
                        </div>
                    </div>

                    {{--Turn On Link Button--}}
                    <div class="raw-data">
                        <button class="get-data">
                            Turn ON Link <b>></b>
                        </button>
                    </div>
                </div>

                {{--Reading Section--}}
                <div class="reading">
                    <p>
                        0.0<span class="unit">Ltrs</span>
                    </p>
                </div>

                {{--Chart--}}
                <div class="chart">
                    <div id="chart_div" style="width: 900px; height: 300px;"> </div>
                </div>
            </div>
            @endif


            @if($active_tab === 'last-reading')
            {{--Last Reading Tab Content--}}
            <div class="tab-content @if($active_tab === 'last-reading') current @endif last-reading">
                {{--Header--}}
                <div class="tab-header">

                    {{--Client Details--}}
                    <div class="details">
                        <div class="left">
                            <p>
                                Name
                            </p>
                            <p>
                                Data & time activated
                            </p>
                        </div>

                        <div class="right">
                            <p>
                                {{$admin->name}}
                            </p>
                            <p>
                                {{$admin->added}} | {{date_format(new \DateTime($admin->created_at), 'H:i:s')}}
                            </p>
                        </div>
                    </div>

                    {{--Refresh Data Button--}}
                    <div class="raw-data">
                        <button class="get-data">
                            Refresh data <b>></b>
                        </button>
                    </div>
                </div>

                {{--Reading Section--}}
                <div class="reading">
                    <p>
                        13,454.8<span class="unit">Ltrs</span>
                    </p>
                </div>

                {{--Chart--}}
                <div class="chart">
                    <div id="chart_div" style="width: 900px; height: 300px;"> </div>
                </div>
            </div>
            @endif

            @if($active_tab === 'log-history')
            {{--Log History Tab--}}
            <div class="tab-content @if($active_tab === 'log-history') current @endif log-history">

                {{--Timeline Button bar--}}
                <div class="time-line">
                    <ul>
                        <li @if($request->input('time') === '24H') class="active" @endif>
                            <a href="{{$request->url().'?time=24H'}}">
                                24 H
                            </a>
                        </li>
                        <li @if($request->input('time') === '7D') class="active" @endif>
                            <a href="{{$request->url().'?time=7D'}}">
                                7 D
                            </a>
                        </li>

                        <li @if($request->input('time') === '30D') class="active" @endif>
                            <a href="{{$request->url().'?time=30D'}}">
                                30 D
                            </a>
                        </li>

                        <li @if($request->input('time') === '60D') class="active" @endif>
                            <a href="{{$request->url().'?time=60D'}}">
                                60 D
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="export">
                    <a href="/dashboard/download/logs">
                        <button class="exportBtn">
                            Export data to CSV
                        </button>
                    </a>

                </div>

                {{--Log Historu Table Data--}}
                <div class="data">
                    <table>
                        <thead>
                            <tr>
                                <td>
                                    Name

                                    @if($request->input('sort') === 'desc' && $request->input('orderBy') === 'name')
                                        <a href="{{$request->url().'?sort=asc&orderBy=name'}}@if($request->input('time'))&time={{$request->input('time')}} @endif">
                                            @include('svg.dashboard.tabs.filter_down')
                                        </a>
                                    @else
                                        <a href="{{$request->url().'?sort=desc&orderBy=name'}}@if($request->input('time'))&time={{$request->input('time')}} @endif">
                                            @include('svg.dashboard.tabs.filter_up')
                                        </a>
                                    @endif
                                </td>

                                <td>
                                    Company

                                    @if($request->input('sort') === 'desc' && $request->input('orderBy') === 'company')
                                        <a href="{{$request->url().'?sort=asc&orderBy=company'}}@if($request->input('time'))&time={{$request->input('time')}} @endif">
                                            @include('svg.dashboard.tabs.filter_down')
                                        </a>
                                    @else
                                        <a href="{{$request->url().'?sort=desc&orderBy=company'}}@if($request->input('time'))&time={{$request->input('time')}} @endif">
                                            @include('svg.dashboard.tabs.filter_up')
                                        </a>
                                    @endif
                                </td>

                                <td>
                                    Date | time activated

                                    @if($request->input('sort') === 'desc' && $request->input('orderBy') === 'clients.created_at')
                                        <a href="{{$request->url().'?sort=asc&orderBy=clients.created_at'}}@if($request->input('time'))&time={{$request->input('time')}} @endif">
                                            @include('svg.dashboard.tabs.filter_down')
                                        </a>
                                    @else
                                        <a href="{{$request->url().'?sort=desc&orderBy=clients.created_at'}}@if($request->input('time'))&time={{$request->input('time')}} @endif">
                                            @include('svg.dashboard.tabs.filter_up')
                                        </a>
                                    @endif
                                </td>

                                <td>
                                    Record (L)

                                    @if($request->input('sort') === 'desc' && $request->input('orderBy') === 'fuel_level')
                                        <a href="{{$request->url().'?sort=asc&orderBy=fuel_level'}}@if($request->input('time'))&time={{$request->input('time')}} @endif">
                                            @include('svg.dashboard.tabs.filter_down')
                                        </a>
                                    @else
                                        <a href="{{$request->url().'?sort=desc&orderBy=fuel_level'}}@if($request->input('time'))&time={{$request->input('time')}} @endif">
                                            @include('svg.dashboard.tabs.filter_up')
                                        </a>
                                    @endif
                                </td>

                                <td>
                                    Status
                                </td>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>
                                    {{$log->name}}
                                </td>

                                <td>
                                    {{$log->company}}
                                </td>

                                <td class="date-time">
                                    {{$log->added}} | {{date_format(new \DateTime($log->created_at), 'H:i:s')}}
                                </td>

                                <td class="litres">
                                    {{$log->fuel_level}}
                                </td>

                                <td class="status">
                                    @if(!$log->access)
                                        @include('svg.dashboard.tabs.log_history_status_hand_icon')
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="paginator">
                    {!! $logs->appends($request->except('page'))->links() !!}
                </div>
            </div>
            @endif
        </div>
    </div>
@stop
