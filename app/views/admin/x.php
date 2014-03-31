<!-- Sidebar -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{ route('admin.index') }}">Student Portal</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">

      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Account <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('prof.create') }}"> <i class="fa fa-plus"></i> Add Professor</a></li>
          <li><a href="{{ route('stud.create') }}"> <i class="fa fa-plus"></i> Add Student</a></li>
          <li><a href="{{ route('admin.list') }}"> <i class="fa fa-list-alt"></i> Account List</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-o"></i> Subject <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('subj.create') }}"> <i class="fa fa-plus"></i> Create</a></li>
        	<li><a href="{{ route('subj.index') }}"> <i class="fa fa-list-alt"></i> List</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-o"></i> Section <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('sec.create') }}"> <i class="fa fa-plus"></i> Create</a></li>
          <li><a href="{{ route('sec.index') }}"> <i class="fa fa-list-alt"></i> List</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bar-chart-o"></i> Scholarship <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('admin.create') }}"> <i class="fa fa-bar-chart-o"></i> List</a></li>
          <li><a href="{{ route('admin.create') }}"> <i class="fa fa-bar-chart-o"></i> Scholar List</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bar-chart-o"></i> Report <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('admin.create') }}"> <i class="fa fa-bar-chart-o"></i> Professor List</a></li>
          <li><a href="{{ route('admin.create') }}"> <i class="fa fa-bar-chart-o"></i> Subject List</a></li>
          <li><a href="{{ route('admin.create') }}"> <i class="fa fa-bar-chart-o"></i> Student List</a></li>
          <li><a href="{{ route('admin.create') }}"> <i class="fa fa-bar-chart-o"></i> Scholar List</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bar-chart-o"></i> Quiz <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('admin.create') }}"> <i class="fa fa-bar-chart-o"></i> List</a></li>
          <li><a href="{{ route('admin.create') }}"> <i class="fa fa-bar-chart-o"></i> Add New</a></li>
        </ul>
      </li>
      <li><a href="{{ route('admin.settings') }}"><i class="fa fa-wrench"></i> Settings</a></li>
      <li><a href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>



<!-- Christian -->
<li>{{ HTML::isActive("administrator", "<i class='fa fa-dashboard'></i> DASHBOARD") }}</li>
            <!-- <li><a href="{{ URL::to('/administrator'); }}"><i class="fa fa-dashboard"></i> DASHBOARD</a></li> -->
            <li><a href="#"><i class="fa fa-users"></i> USERS</a></li>
            <li><a href="#"><i class="fa fa-ban"></i> PENALTY</a></li>
            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle {{ $ux->quiz or '' }}" data-toggle="dropdown"><i class="fa fa-pencil"></i> QUIZ <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    {{ HTML::isActive("administrator/quiz", "<i class='fa fa-list'></i> QUIZ LIST</a>") }}
                    {{ HTML::isActive("administrator/quiz/create", "<i class='fa fa-plus'></i> ADD QUIZ</a>") }}
                </ul>
            </li>
            @if(isset($ux->quiz_question))
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle {{ $ux->quiz or '' }}" data-toggle="dropdown"><i class="fa fa-question"></i> QUESTION <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        {{ HTML::isActive("administrator/quiz/".$quiz_id."/question", "<i class='fa fa-list'></i> QUESTION LIST</a>") }}
                        {{ HTML::isActive("administrator/quiz/".$quiz_id."/question/create", "<i class='fa fa-plus'></i> ADD QUESTION</a>") }}
                    </ul>
                </li>
            @endif
            @if(isset($ux->question_choice))
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle {{ $ux->quiz or '' }}" data-toggle="dropdown"><i class="fa fa-list-ul"></i> CHOICE <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        {{ HTML::isActive("administrator/quiz/".$quiz_id."/question/".$question_id."/choice", "<i class='fa fa-list'></i> CHOICE LIST</a>") }}
                        {{ HTML::isActive("administrator/quiz/".$quiz_id."/question/".$question_id."/choice/create", "<i class='fa fa-plus'></i> ADD CHOICE</a>") }}
                    </ul>
                </li>
            @endif
<!--  Christian  -->

    </ul>

    <ul class="nav navbar-nav navbar-right navbar-user">
      <!-- <li class="dropdown messages-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li class="dropdown-header">7 New Messages</li>
          <li class="message-preview">
            <a href="#">
              <span class="avatar"><img src="{{ URL::asset('img\img.jpg') }}"></span>
              <span class="name">John Smith:</span>
              <span class="message">Hey there, I wanted to ask you something...</span>
              <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
            </a>
          </li>
          <li class="divider"></li>
          <li class="message-preview">
            <a href="#">
              <span class="avatar"><img src="{{ URL::asset('img\img.jpg') }}"></span>
              <span class="name">John Smith:</span>
              <span class="message">Hey there, I wanted to ask you something...</span>
              <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
            </a>
          </li>
          <li class="divider"></li>
          <li class="message-preview">
            <a href="#">
              <span class="avatar"><img src="{{ URL::asset('img\img.jpg') }}"></span>
              <span class="name">John Smith:</span>
              <span class="message">Hey there, I wanted to ask you something...</span>
              <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
            </a>
          </li>
          <li class="divider"></li>
          <li><a href="#">View Inbox <span class="badge">7</span></a></li>
        </ul>
      </li> -->
      <!-- <li class="dropdown alerts-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Default <span class="label label-default">Default</span></a></li>
          <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
          <li><a href="#">Success <span class="label label-success">Success</span></a></li>
          <li><a href="#">Info <span class="label label-info">Info</span></a></li>
          <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
          <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
          <li class="divider"></li>
          <li><a href="#">View All</a></li>
        </ul>
      </li> -->
      <li class="dropdown user-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Session::get('username') }}, <b>{{ Session::get('account_type') }}</b>  <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('admin.show', Session::get('user_id')) }}"><i class="fa fa-user"></i> Profile</a></li>
          <li><a href="{{ route('admin.edit', Session::get('user_id')) }}"><i class="fa fa-lock"></i> Password</a></li>
          <!-- <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li> -->
          <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
          <li class="divider"></li>
          <li><a href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i> Log Out</a></li>
        </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>