@extends('layout')

@section('head')
    <title>{{ Session::get('account_type') }}</title>

    <!-- Bootstrap core CSS -->
    @include('include.css')
@stop

@section('body')
    <div id="wrapper">

        <!-- Sidebar -->
        @include('administrator.sidebar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1>{{ $stud->first_name }} {{ $stud->middle_name }}. {{ $stud->last_name }}<small> GPA : {{ (int) $gpa }}</small></h1>
                    <br />
                    <!-- S: Prompt -->
                    @include('admin.prompt')
                    @include('include.error')
                    <!-- E: Prompt -->

                    <div class="table-responsive"> 
                        <!-- S: First Grading -->
                            <h3> * First Grading Period *</h3>
                            <table class="table table-hover  tablesorter">
                                <thead>
                                  <tr>
                                    <th>English 1</th>
                                    <th>Filipino 1</th>
                                    <th>Mathematics 1</th>
                                    <th>Science 1</th>
                                    <th>Social Studies 1</th>
                                    <th>Computer Studies 1</th>
                                    <th>T. L. E. 1</th>
                                    <th>MAPEH 1</th>
                                    <th> <b> Average </b></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $grade[0]->score }}</td>
                                        <td>{{ $grade[1]->score }}</td>
                                        <td>{{ $grade[2]->score }}</td>
                                        <td>{{ $grade[3]->score }}</td>
                                        <td>{{ $grade[4]->score }}</td>
                                        <td>{{ $grade[5]->score }}</td>
                                        <td>{{ $grade[6]->score }}</td>
                                        <td>{{ $grade[7]->score }}</td>
                                        <td> <b> {{ (int) $ave1 }} </b></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                            <!-- E: First Grading -->

                            <br />

                            <!-- S: Second Grading -->
                            <h3> * Second Grading Period *</h3>
                            <table class="table table-hover  tablesorter">
                                <thead>
                                  <tr>
                                    <th>English 2</th>
                                    <th>Filipino 2</th>
                                    <th>Mathematics 2</th>
                                    <th>Science 2</th>
                                    <th>Social Studies 2</th>
                                    <th>Computer Studies 2</th>
                                    <th>T. L. E. 2</th>
                                    <th>MAPEH 2</th>
                                    <th> <b> Average </b></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $grade[8]->score }}</td>
                                        <td>{{ $grade[9]->score }}</td>
                                        <td>{{ $grade[10]->score }}</td>
                                        <td>{{ $grade[11]->score }}</td>
                                        <td>{{ $grade[12]->score }}</td>
                                        <td>{{ $grade[13]->score }}</td>
                                        <td>{{ $grade[14]->score }}</td>
                                        <td>{{ $grade[15]->score }}</td>
                                        <td> <b> {{ (int) $ave2 }} </b></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                            <!-- E: Second Grading -->

                            <br />

                            <!-- S: Third Grading-->
                            <h3> * Third Grading Period *</h3>
                            <table class="table table-hover  tablesorter">
                                <thead>
                                  <tr>
                                    <th>English 3</th>
                                    <th>Filipino 3</th>
                                    <th>Mathematics 3</th>
                                    <th>Science 3</th>
                                    <th>Social Studies 3</th>
                                    <th>Computer Studies 3</th>
                                    <th>T. L. E. 3</th>
                                    <th>MAPEH 3</th>
                                    <th> <b> Average </b></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $grade[16]->score }}</td>
                                        <td>{{ $grade[17]->score }}</td>
                                        <td>{{ $grade[18]->score }}</td>
                                        <td>{{ $grade[19]->score }}</td>
                                        <td>{{ $grade[20]->score }}</td>
                                        <td>{{ $grade[21]->score }}</td>
                                        <td>{{ $grade[22]->score }}</td>
                                        <td>{{ $grade[23]->score }}</td>
                                        <td> <b> {{ (int) $ave3 }} </b></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                            <!-- E: Third Grading -->

                            <br />

                            <!-- S: Fourth Grading -->
                            <h3> * Fourth Grading Period *</h3>
                            <table class="table table-hover  tablesorter">
                                <thead>
                                  <tr>
                                    <th>English 4</th>
                                    <th>Filipino 4</th>
                                    <th>Mathematics 4</th>
                                    <th>Science 4</th>
                                    <th>Social Studies 4</th>
                                    <th>Computer Studies 4</th>
                                    <th>T. L. E. 4</th>
                                    <th>MAPEH 4</th>
                                    <th> <b> Average </b></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $grade[24]->score }}</td>
                                        <td>{{ $grade[25]->score }}</td>
                                        <td>{{ $grade[26]->score }}</td>
                                        <td>{{ $grade[27]->score }}</td>
                                        <td>{{ $grade[28]->score }}</td>
                                        <td>{{ $grade[29]->score }}</td>
                                        <td>{{ $grade[30]->score }}</td>
                                        <td>{{ $grade[31]->score }}</td>
                                        <td> <b> {{ (int) $ave4 }} </b></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                            <!-- E: Fourth Grading -->
                    </div>
                </div>
            </div><!-- /.row -->

        </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    @include('include.javascript')
@stop