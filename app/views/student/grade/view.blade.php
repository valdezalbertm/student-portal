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
                        @foreach ($grade as $g)
                            @if ($g->school_year == 1)
                                <th> {{ $g->name }} </th>    
                            @endif
                        @endforeach
                        <th> <b> Average </b></th>
                      </tr>
                        <tr>
                            @foreach ($grade as $g)
                                @if ($g->school_year == 1)
                                    <td>{{ $g->score }}</td>
                                @endif
                            @endforeach
                            <td> <b> {{ (int) $ave1 }} </b></td>
                        </tr>
                    
                </table>

                <!-- E: First Year -->

                <!-- S: Second Year -->
                <!-- <h4> * Second Grading Period *</h4> -->
                <table class="table">
                  <tr>
                    @foreach ($grade as $g)
                            @if ($g->school_year == 2)
                                <th> {{ $g->name }} </th>    
                            @endif
                        @endforeach
                    <th> <b> Average </b></th>
                  </tr>
                    <tr>
                        @foreach ($grade as $g)
                            @if ($g->school_year == 2)
                                <td>{{ $g->score }}</td>
                            @endif
                        @endforeach
                        <td> <b> {{ (int) $ave2 }} </b></td>
                    </tr>
                </table>
                
                <!-- E: Second Year -->

                <!-- S: Third Year-->
                <!-- <h4> * Third Grading Period *</h4> -->
                <table class="table">
          
                      <tr>
                        @foreach ($grade as $g)
                            @if ($g->school_year == 3)
                                <th> {{ $g->name }} </th>    
                            @endif
                        @endforeach
                        <th> <b> Average </b></th>
                      </tr>
          
                        <tr>
                            @foreach ($grade as $g)
                            @if ($g->school_year == 3)
                                <td>{{ $g->score }}</td>
                            @endif
                        @endforeach
                            <td> <b> {{ (int) $ave3 }} </b></td>
                        </tr>
          
                </table>
                
                <!-- E: Third Year -->

                <!-- S: Fourth Year -->
                <!-- <h4> * Fourth Grading Period *</h4> -->
                <table class="table">
          
                      <tr>
                        @foreach ($grade as $g)
                            @if ($g->school_year == 4)
                                <th> {{ $g->name }} </th>    
                            @endif
                        @endforeach
                        <th> <b> Average </b></th>
                      </tr>
                        <tr>
                            @foreach ($grade as $g)
                            @if ($g->school_year == 4)
                                <td>{{ $g->score }}</td>
                            @endif
                        @endforeach
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