
      <div class="row">
        <div class="col-lg-12">
          <h1>Student <small>Menu</small></h1>
          <!-- <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
          </ol> -->

          {{-- @include('admin.prompt') --}}
          <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <center><h2>School Announcement!</h2></center>
            <p align="left">
              <h3><b>Subject:</b> {{ $ann[0]->subject }}</h3>
              <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $ann[0]->description }}</h4>
              <h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $ann[0]->create_date }}</h6>
            </p>
          </div>

          <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Welcome Student. Date today: <b>{{ date('d M Y' ,time()) }}</b>.<br />
          </div>

        </div>
      </div>

      <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-user fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">1</p>
                    <p class="announcement-text">Student</p>
                  </div>
                </div>
              </div>
              <a href="{{ route('student.grade') }}">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      View Grades
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
        </div>
      </div>

      <?php $scholarships = Auth::user()->student->scholarship; ?>
      @if($scholarships->count())
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6 text-left">
                    <p class="announcement-text fa-2x">My Scholarship List</p>
                  </div>
                </div>
              </div>
                <div class="panel-body announcement-bottom">
                  <div class="row">
                    <div class="col-xs-12">
                      <table class="table table-bordered table-hover table-striped tablesorter">
                            <thead>
                        <tr>
                            <th class="header"> No. <i class="close fa fa-sort pull-right hidden-phone"></i></th>
                            <th class="header"><i class="fa fa-list-alt"></i> Name <i class="close fa fa-sort pull-right hidden-phone"></i></th>
                            <th class="header"><i class="fa fa-list-alt"></i> Type <i class="close fa fa-sort pull-right hidden-phone"></i></th>
                            <th class="header"><i class="fa fa-list-alt"></i> Value <i class="close fa fa-sort pull-right hidden-phone"></i></th>
                            <th class="header"><i class="fa fa-list-alt"></i> School Year <i class="close fa fa-sort pull-right hidden-phone"></i></th>
                        </tr>
                        </thead>
                        <?php $no = 1; ?>
                        @foreach ($scholarships as $scholarship)
                        <tr>
                          <td> {{ $no }} </td>
                          <td> {{{ $scholarship->name }}} </td>
                          <td> {{{ $scholarship->discount_type }}} </td>
                          <td> {{{ $scholarship->discount }}} </td>
                          <td> {{{ $scholarship->school_year }}} </td>
                          <?php $no++; ?>
                        </tr>
                        @endforeach
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      @else
            <div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              No <b>Assigned Scholarships</b> for you yet.
            </div>
      @endif

      <?php $violations = Auth::user()->student->penalty; ?>
      @if($violations->count()) 
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6 text-left">
                    <p class="announcement-text fa-2x">My Violation List</p>
                  </div>
                </div>
              </div>
                <div class="panel-body announcement-bottom">
                  <div class="row">
                    <div class="col-xs-12">
                        <?php $no = 1; ?>
                        <table class="table table-bordered table-hover table-striped tablesorter">
                              <thead>
                          <tr>
                              <th class="header"> No. <i class="close fa fa-sort pull-right hidden-phone"></i></th>
                              <th class="header"><i class="fa fa-list-alt"></i> Type <i class="close fa fa-sort pull-right hidden-phone"></i></th>
                              <th class="header"><i class="fa fa-list-alt"></i> Description <i class="close fa fa-sort pull-right hidden-phone"></i></th>
                              <th class="header"><i class="fa fa-list-alt"></i> Date <i class="close fa fa-sort pull-right hidden-phone"></i></th>
                          </tr>
                          </thead>
                          @foreach ($violations as $violation)
                          <tr>
                            <td> {{ $no }} </td>
                            <td> {{{ $violation->type }}} </td>
                            <td> {{{ $violation->description }}} </td>
                            <td> {{{ $violation->date }}} </td>
                            <?php $no++; ?>
                          </tr>
                          @endforeach
                        </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      @else
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              No Record of <b>Violations</b>.
            </div>
      @endif