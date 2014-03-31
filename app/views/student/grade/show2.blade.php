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
                    <h1>{{ $stud->first_name }} {{ $stud->middle_name }}. {{ $stud->last_name }}<small> View</small></h1>

                    <!-- S: Prompt -->
                    @include('admin.prompt')
                    @include('include.error')
                    <!-- E: Prompt -->

                    <div class="table-responsive"> 
                        <!-- S: First Year -->
                            <h4>First Year Subject</h4>
                            <table class="table table-hover table-striped tablesorter">
                                <thead>
                                  <tr>
                                    <th>English 1 <i class="fa fa-sort"></i></th>
                                    <th>Filipino 1 <i class="fa fa-sort"></i></th>
                                    <th>Mathematics 1 <i class="fa fa-sort"></i></th>
                                    <th>Science 1 <i class="fa fa-sort"></i></th>
                                    <th>Social Studies 1 <i class="fa fa-sort"></i></th>
                                    <th>Computer Studies 1 <i class="fa fa-sort"></i></th>
                                    <th>T. L. E. 1 <i class="fa fa-sort"></i></th>
                                    <th>MAPEH 1 <i class="fa fa-sort"></i></th>
                                    <th> <b> Average </b> <i class="fa fa-sort"></i></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ Form::input('text', 'eng1', $grade[0]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'fil1', $grade[1]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'mat1', $grade[2]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'sci1', $grade[3]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'soc1', $grade[4]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'com1', $grade[5]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'tle1', $grade[6]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'map1', $grade[7]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td> 100</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                            <!-- E: First Year -->

                            <!-- S: Second Year -->
                            <h4>Second Year Subject</h4>
                            <table class="table table-hover table-striped tablesorter">
                                <thead>
                                  <tr>
                                    <th>English 2 <i class="fa fa-sort"></i></th>
                                    <th>Filipino 2 <i class="fa fa-sort"></i></th>
                                    <th>Mathematics 2 <i class="fa fa-sort"></i></th>
                                    <th>Science 2 <i class="fa fa-sort"></i></th>
                                    <th>Social Studies 2 <i class="fa fa-sort"></i></th>
                                    <th>Computer Studies 2 <i class="fa fa-sort"></i></th>
                                    <th>T. L. E. 2 <i class="fa fa-sort"></i></th>
                                    <th>MAPEH 2 <i class="fa fa-sort"></i></th>
                                    <th> <b> Average </b> <i class="fa fa-sort"></i></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ Form::input('text', 'eng2', $grade[8]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'fil2', $grade[9]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'mat2', $grade[10]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'sci2', $grade[11]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'soc2', $grade[12]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'com2', $grade[13]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'tle2', $grade[14]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'map2', $grade[15]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td> 100</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                            <!-- E: Second Year -->

                            <!-- S: Third Year-->
                            <h4>Third Year Subject</h4>
                            <table class="table table-hover table-striped tablesorter">
                                <thead>
                                  <tr>
                                    <th>English 3 <i class="fa fa-sort"></i></th>
                                    <th>Filipino 3 <i class="fa fa-sort"></i></th>
                                    <th>Mathematics 3 <i class="fa fa-sort"></i></th>
                                    <th>Science 3 <i class="fa fa-sort"></i></th>
                                    <th>Social Studies 3 <i class="fa fa-sort"></i></th>
                                    <th>Computer Studies 3 <i class="fa fa-sort"></i></th>
                                    <th>T. L. E. 3 <i class="fa fa-sort"></i></th>
                                    <th>MAPEH 3 <i class="fa fa-sort"></i></th>
                                    <th> <b> Average </b> <i class="fa fa-sort"></i></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ Form::input('text', 'eng3', $grade[16]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'fil3', $grade[17]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'mat3', $grade[18]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'sci3', $grade[19]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'soc3', $grade[20]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'com3', $grade[21]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'tle3', $grade[22]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'map3', $grade[23]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td> 100</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                            <!-- E: Third Year -->

                            <!-- S: Fourth Year -->
                            <h4>Fourth Year Subject</h4>
                            <table class="table table-hover table-striped tablesorter">
                                <thead>
                                  <tr>
                                    <th>English 4 <i class="fa fa-sort"></i></th>
                                    <th>Filipino 4 <i class="fa fa-sort"></i></th>
                                    <th>Mathematics 4 <i class="fa fa-sort"></i></th>
                                    <th>Science 4 <i class="fa fa-sort"></i></th>
                                    <th>Social Studies 4 <i class="fa fa-sort"></i></th>
                                    <th>Computer Studies 4 <i class="fa fa-sort"></i></th>
                                    <th>T. L. E. 4 <i class="fa fa-sort"></i></th>
                                    <th>MAPEH 4 <i class="fa fa-sort"></i></th>
                                    <th> <b> Average </b> <i class="fa fa-sort"></i></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ Form::input('text', 'eng4', $grade[24]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'fil4', $grade[25]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'mat4', $grade[26]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'sci4', $grade[27]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'soc4', $grade[28]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'com4', $grade[29]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'tle4', $grade[30]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td>{{ Form::input('text', 'map4', $grade[31]->score, ['class' => 'form-control', 'readonly']) }}</td>
                                        <td> </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                            <!-- E: Fourst Year -->
                    </div>
                </div>
            </div><!-- /.row -->

        </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    @include('include.javascript')
@stop