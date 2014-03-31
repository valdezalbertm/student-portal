@extends('layout')

@section('head')
    <title>{{ Session::get('account_type') }}</title>

    <link href="{{ URL::asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    
    <style type="text/css" media="print">
        @page {
            size: landscape;
            border: none;
            margin: none;
        }
    </style>
@stop

@section('body')
    <div class="col-lg-12">
        <h4><b>Name:</b> {{ $stud->first_name }} {{ $stud->middle_name }}. {{ $stud->last_name }}</h4>
        <h4><b>Contact:</b>  {{ $stud->contact }} / {{ $stud->email }}</h4>
        
        <br />

        <div class="table-responsive"> 
            <!-- S: First Year -->
                <!-- <h4> * First Grading Period *</h4> -->
                <table class="table">
                    
                      <tr>
                        <th>English</th>
                        <th>Filipino</th>
                        <th>Mathematics</th>
                        <th>Science</th>
                        <th>Social Studies</th>
                        <th>Computer Studies</th>
                        <th>T. L. E.</th>
                        <th>MAPEH</th>
                        <th> <b> Average </b></th>
                      </tr>
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
                    
                </table>
                
                <!-- E: First Year -->

                <!-- S: Second Year -->
                <!-- <h4> * Second Grading Period *</h4> -->
                <table class="table">
                  <tr>
                    <th>English</th>
                    <th>Filipino</th>
                    <th>Mathematics</th>
                    <th>Science</th>
                    <th>Social Studies</th>
                    <th>Computer Studies</th>
                    <th>T. L. E.</th>
                    <th>MAPEH</th>
                    <th> <b> Average </b></th>
                  </tr>
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
                </table>
                
                <!-- E: Second Year -->

                <!-- S: Third Year-->
                <!-- <h4> * Third Grading Period *</h4> -->
                <table class="table">
          
                      <tr>
                        <th>English</th>
                        <th>Filipino</th>
                        <th>Mathematics</th>
                        <th>Science</th>
                        <th>Social Studies</th>
                        <th>Computer Studies</th>
                        <th>T. L. E.</th>
                        <th>MAPEH</th>
                        <th> <b> Average </b></th>
                      </tr>
          
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
          
                </table>
                
                <!-- E: Third Year -->

                <!-- S: Fourth Year -->
                <!-- <h4> * Fourth Grading Period *</h4> -->
                <table class="table">
          
                      <tr>
                        <th>English</th>
                        <th>Filipino</th>
                        <th>Mathematics</th>
                        <th>Science</th>
                        <th>Social Studies</th>
                        <th>Computer Studies</th>
                        <th>T. L. E.</th>
                        <th>MAPEH</th>
                        <th> <b> Average </b></th>
                      </tr>
          
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
          
                </table>
                <!-- E: Fourst Year -->

                <h4><n>Total Average: <small> GPA : {{ (int) $gpa }}</small></b></h4>
        </div>
    </div>
     
    <!-- JavaScript -->
    @include('include.javascript')
    <script>
        //function print_page() {
            window.print();
        //}
   </script>
@stop