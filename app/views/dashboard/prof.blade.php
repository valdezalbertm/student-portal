<div class="row">
  <div class="col-lg-12">
    <h1>Class Adviser <small>Menu</small></h1>
    <!-- <ol class="breadcrumb">
      <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
    </ol> -->

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
      Welcome Class Adviser. Date today: <b>{{ date('d M Y' ,time()) }}</b>.<br />
    </div>

    @include('admin.prompt')

  </div>
</div><!-- /.row -->

<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-6">
            <i class="fa fa-user fa-5x"></i>
          </div>
          <div class="col-xs-6 text-right">
            <p class="announcement-heading">1</p>
            <p class="announcement-text">Class Adviser</p>
          </div>
        </div>
      </div>
      <a href="{{ route('admin.show', Session::get('user_id')) }}">
        <div class="panel-footer announcement-bottom">
          <div class="row">
            <div class="col-xs-6">
              View Profile
            </div>
            <div class="col-xs-6 text-right">
              <i class="fa fa-arrow-circle-right"></i>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>

<!--   <div class="col-lg-4">
    <div class="panel panel-danger">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-6">
            <i class="fa fa-plus-square-o fa-5x"></i>
          </div>
          <div class="col-xs-6 text-right">
            <p class="announcement-heading">{{ $stud_num }}</p>
            <p class="announcement-text">Student</p>
          </div>
        </div>
      </div>
      <a href="{{ route('stud.create') }}">
        <div class="panel-footer announcement-bottom">
          <div class="row">
            <div class="col-xs-6">
              Register Student
            </div>
            <div class="col-xs-6 text-right">
              <i class="fa fa-arrow-circle-right"></i>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div> -->

  <!-- <div class="col-lg-3">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-6">
            <i class="fa fa-plus-square fa-5x"></i>
          </div>
          <div class="col-xs-6 text-right">
            <p class="announcement-heading">{{ $subj_num }}</p>
            <p class="announcement-text">Subject</p>
          </div>
        </div>
      </div>
        <div class="panel-footer announcement-bottom">
          <div class="row">
            <div class="col-xs-6">
              Subjects
            </div>
            <div class="col-xs-6 text-right">
            </div>
          </div>
        </div>
    </div>
  </div> -->

<div class="col-lg-6">
  <div class="panel panel-warning">
    <div class="panel-heading">
      <div class="row">
        <div class="col-xs-6">
          <i class="fa fa-cog fa-5x"></i>
        </div>
        <div class="col-xs-6 text-right">
          <p class="announcement-heading">{{ $prof_num }}</p>
          <p class="announcement-text">Settings</p>
        </div>
      </div>
    </div>
    <a href="{{ route('admin.edit', 1) }}">
      <div class="panel-footer announcement-bottom">
        <div class="row">
          <div class="col-xs-6">
            Change Password
          </div>
          <div class="col-xs-6 text-right">
            <i class="fa fa-arrow-circle-right"></i>
          </div>
        </div>
      </div>
    </a>
  </div>
</div>


</div><!-- /.row -->