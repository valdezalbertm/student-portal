<!-- COLLECT THE NAV LINKS, FORMS, AND OTHER CONTENT FOR TOGGLING -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>{{ HTML::isActive("administrator", "<i class='fa fa-dashboard'></i> Dashboard") }}</li>

        <!-- <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Account <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('prof.create') }}"> <i class="fa fa-plus"></i> Add Professor</a></li>
              <li><a href="{{ route('stud.create') }}"> <i class="fa fa-plus"></i> Add Student</a></li>
              <li><a href="{{ route('admin.list') }}"> <i class="fa fa-list-alt"></i> Account List</a></li>
            </ul>
        </li> -->
        <!-- <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Instructor <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('admin.create') }}"> <i class="fa fa-bar-chart-o"></i> List</a></li>
          <li><a href="{{ route('prof_sec.index') }}"> <i class="fa fa-bar-chart-o"></i> Assign Section</a></li>
        </ul>
        </li>
         --><!--
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-o"></i> Subject <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('subj.create') }}"> <i class="fa fa-plus"></i> Create</a></li>
                <li><a href="{{ route('subj.index') }}"> <i class="fa fa-list-alt"></i> List</a></li>
            </ul>
          </li>
        -->
        <!-- <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-o"></i> Section <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('sec.create') }}"> <i class="fa fa-plus"></i> Create</a></li>
          <li><a href="{{ route('sec.index') }}"> <i class="fa fa-list-alt"></i> List</a></li>
        </ul>
        </li> -->
        <li><a href="{{ route('grade.index') }}"><i class="fa fa-list-alt"></i> Grade</a></li>
        <!-- <li><a href="{{ route('admin.settings') }}"><i class="fa fa-wrench"></i> Settings</a></li> -->
  
        <!-- <li><a href="{{ URL::to('/administrator'); }}"><i class="fa fa-dashboard"></i> DASHBOARD</a></li> -->
        <!-- <li><a href="#"><i class="fa fa-users"></i> USERS</a></li> -->
        <!-- <li><a href="#"><i class="fa fa-ban"></i> Penalty</a></li> -->
        
<!--         <li class="dropdown">
            <a href="#" class="dropdown-toggle {{ $ux->quiz or '' }}" data-toggle="dropdown"><i class="fa fa-pencil"></i> Quiz <b class="caret"></b></a>
            <ul class="dropdown-menu">
                {{ HTML::isActive("administrator/quiz", "<i class='fa fa-list'></i> Quiz List</a>") }}
                {{ HTML::isActive("administrator/quiz/create", "<i class='fa fa-plus'></i> Add Quiz</a>") }}
            </ul>
        </li>
        @if(isset($ux->quiz_question))
            <li class="dropdown">
                <a href="#" class="dropdown-toggle {{ $ux->quiz or '' }}" data-toggle="dropdown"><i class="fa fa-question"></i> Question <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    {{ HTML::isActive("administrator/quiz/".$quiz_id."/question", "<i class='fa fa-list'></i> Question LIST</a>") }}
                    {{ HTML::isActive("administrator/quiz/".$quiz_id."/question/create", "<i class='fa fa-plus'></i> ADD Question</a>") }}
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
        
        @if(isset($ux->quiz_scholarship))
            <li class="dropdown">
                <a href="#" class="dropdown-toggle {{ $ux->scholarship or '' }}" data-toggle="dropdown"><i class="fa fa-certificate"></i> Scholarship <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    {{ HTML::isActive("administrator/quiz/".$quiz_id."/scholarship/create", "<i class='fa fa-plus'></i> Add Scholarship</a>") }}
                </ul>x
            </li>
        @endif

        <!-- <li><a href="#"><i class="fa fa-file-o"></i> GRADE</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle {{ $ux->scholarship or '' }}" data-toggle="dropdown"><i class="fa fa-certificate"></i> Scholarship <b class="caret"></b></a>
            <ul class="dropdown-menu">
                {{ HTML::isActive("administrator/scholarship", "<i class='fa fa-gear'></i> Manage</a>") }}
                {{ HTML::isActive("administrator/scholarship/reports", "<i class='fa fa-copy'></i> Reports</a>") }}
            </ul>
        </li>
         -->
        <!-- <li><a href="#"><i class="fa fa-book"></i> Subject</a></li> -->
        <li><a href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
    </ul>
 -->
    <ul class="nav navbar-nav navbar-right navbar-user account-status">
        <li class="dropdown user-dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Session::get('username') }}, <b>Class Adviser</b>  <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('admin.show', Session::get('user_id')) }}"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="{{ route('admin.edit', Session::get('user_id')) }}"><i class="fa fa-lock"></i> Password</a></li>

                <!-- <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li> -->
                <li class="divider"></li>
                <li><a href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i> Log Out</a></li>
            </ul>
        </li>
    </ul>
</div>