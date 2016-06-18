@extends('index')

@section('title')
    Dashboard - Monmeter
@stop()

@section('dashboard')
    @include('dashboard.sidebar')
    <div class="dashboard">
        <div class="header">
            @include('svg.dashboard_header')
        </div>

        <div class="content">
            <ul class="tabs">
                <li class="tab-link current" data-tab="tab-1">Real Time</li>
                <li class="tab-link add-user" data-tab="tab-2"> Last Reading</li>
                <li class="tab-link disabled-user" data-tab="tab-3"> Log History</li>
            </ul>

            <div id="tab-1" class="tab-content current real-time">
                <div class="tab-header">
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

                    <div class="raw-data">
                        <button class="get-data">
                            Turn ON Link <b>></b>
                        </button>
                    </div>
                </div>

                <div class="reading">
                    <p>
                        0.0<span class="unit">Ltrs</span>
                    </p>
                </div>

            </div>
            <div id="tab-2" class="tab-content last-reading">
                <div class="tab-header log-history">
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

                    <div class="raw-data">
                        <button class="get-data">
                            Refresh data <b>></b>
                        </button>
                    </div>
                </div>

                <div class="reading">
                    <p>
                        13,454.8<span class="unit">Ltrs</span>
                    </p>
                </div>
            </div>
            <div id="tab-3" class="tab-content log-history">
                <div class="time-line">
                    <ul>
                        <li>24 H</li>
                        <li class="active">7 D</li>
                        <li>30 D</li>
                        <li>60 D</li>
                    </ul>
                </div>

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
                                    @include('svg.log_history_status_hand_icon')
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
        </div>
    </div>
@stop
