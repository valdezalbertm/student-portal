<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">

	    <link rel="shortcut icon" href="{{ URL::asset('assets/img/sjaod-logo.ico') }}">

		<!-- BOOTSTRAP CORE CSS -->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
		
		<!-- ADD CUSTOM CSS HERE -->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/administrator/sb-admin.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/font-awesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/custom.css') }}">
		<style type="text/css">
			@media print {
				body * {
					visibility: hidden;
				}
				#section-to-print, #section-to-print * {
					visibility: visible;
				}
				#section-to-print {
					position: absolute;
					left: 0;
					top: 0;
					width: 100%;
				}
			}
		</style>

		<title>Examination Result - St. Jude Academy Student Portal</title>
	</head>
    <body>
		<div class="container result-form">
			<div class="result-nav">
				<h2 class="pull-right"><a href="#" onclick="print_page()"><i class="fa fa-print"></i> PRINT</a></h2>
			</div>

			<div id="section-to-print">
				<!-- <h2>{{ Str::upper($user_type) }} SCHOLARSHIP EXAMINATION RESULT SUMMARY ({{ Str::upper($print_type) }})</h2> -->
	            <table class="table table-striped table-bordered tablesorter">
	                <thead>
	                    <tr>
	                        <th class="col-md-1">ID <i class="fa fa-sort"></i></th>
	                        <th>NAME <i class="fa fa-sort"></i></th>
	                        <th>SCHOLARSHIP <i class="fa fa-sort"></i></th>
	                        <th class="score">SCORE <i class="fa fa-sort"></i></th>
	                        <th class="percent"><i class="icon-percent"></i> <i class="fa fa-sort"></i></th>
	                        <th>DATE TAKEN <i class="fa fa-sort"></i></th>
	                        <th class="validation">VALIDATION <i class="fa fa-sort"></i></th>
	                    </tr>
	                </thead>
	                <tbody>
	                    @foreach($scholarship_quiz_result as $user)
	                        <tr>
	                            <td class="center">{{ $user->id }}</td>
	                            <td>{{ $user->$user_type->last_name .', '.$user->$user_type->first_name.' '.$user->$user_type->middle_name.'.'}}</td>
	                            <td class="center">{{ $user->scholarship->name.' - '. $user->school_year }}</td>
	                            <td class="center">{{ ($user->procedure == 'pass' ) ? $user->score.'/'.$user->overall : "UF" }}</td>
                                <td class="center">{{ ($user->procedure == 'pass' ) ? round(($user->score / $user->overall) * 100, 2) : "UF" }}</td>
	                            <td>{{ date('F d, Y', strtotime($user->date_started)) }}</td>
	                            <td class="center">{{ $user->validation_key or 'UNFINISHED' }}</td>
	                        </tr>
	                    @endforeach
	                </tbody>
	                </div>
	            </table>
			</div>
		</div>
		<!-- JAVASCRIPT -->
		<script src="{{ URL::asset('assets/js/jquery-1.10.2.min.js') }}"></script>
		<script src="{{ URL::asset('assets/js/bootstrap.js') }}"></script>

		<!-- PAGE SPECIFIC PLUGINS -->
		<script src="{{ URL::asset('assets/js/tablesorter/jquery.tablesorter.js') }}"></script>
		<script src="{{ URL::asset('assets/js/tablesorter/tables.js') }}"></script>
	    <script>
	      function print_page() {
	        window.print();
	      }
	    </script>
    </body>
</html>