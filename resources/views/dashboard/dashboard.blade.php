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
                                Mr Nick Chan
                            </p>
                            <p>
                                21 June 2016 | 10:21:34
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
                    <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['corechart']}]}"></script>
                    <script src="/assets/charts/chart.js"></script>
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
                                Mr Nick Chan
                            </p>
                            <p>
                                21 June 2016 | 10:21:34
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
                    <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['corechart']}]}"></script>
                    <script src="/assets/charts/chart.js"></script>
                </div>
            </div>
            @endif

            @if($active_tab === 'log-history')
            {{--Log History Tab--}}
            <div class="tab-content @if($active_tab === 'log-history') current @endif log-history">

                {{--Timeline Button bar--}}
                <div class="time-line">
                    <ul>
                        <li>24 H</li>
                        <li class="active">7 D</li>
                        <li>30 D</li>
                        <li>60 D</li>
                    </ul>
                </div>

                {{--Log Historu Table Data--}}
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
                                    Data | time activated
                                </td>

                                <td>
                                    Record (L)
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
                                    21 Jun 2016 | 10:21:34
                                </td>

                                <td>
                                    10,784.4
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
                                    21 Jun 2016 | 10:21:34
                                </td>

                                <td>
                                    10,784.4
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
                                    21 Jun 2016 | 10:21:34
                                </td>

                                <td>
                                    10,784.4
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
                                    21 Jun 2016 | 10:21:34
                                </td>

                                <td>
                                    10,784.4
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
                                    21 Jun 2016 | 10:21:34
                                </td>

                                <td>
                                    10,784.4
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
                                    21 Jun 2016 | 10:21:34
                                </td>

                                <td>
                                    10,784.4
                                </td>

                                <td>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
@stop
