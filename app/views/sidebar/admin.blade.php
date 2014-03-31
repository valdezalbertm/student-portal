<!-- COLLECT THE NAV LINKS, FORMS, AND OTHER CONTENT FOR TOGGLING -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>{{ HTML::isActive("administrator", "<i class='fa fa-dashboard'></i> Dashboard") }}</li>

    <!-- S: Sidebar if Student Account -->
    @if (Session::get('account_type') == 'Student')
            <li><a href="{{ route('student.grade') }}"><i class="fa fa-eye"></i> View Grade</a></li>
            <li><a href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i> Log Out</a></li>
        </ul>
    <!-- E: Sidebar if Student Account -->
    @elseif (Session::get('account_type') == 'Professor')

    @else
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Account <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('prof.create') }}"> <i class="fa fa-plus"></i> Add Professor</a></li>
          <li><a href="{{ route('stud.create') }}"> <i class="fa fa-plus"></i> Add Student</a></li>
          <li><a href="{{ route('admin.list') }}"> <i class="fa fa-list-alt"></i> Account List</a></li>
        </ul>
      </li>
      <li><a href="{{ route('announce.index') }}"><i class="fa fa-plus"></i> Announcement</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Class Adviser <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <!-- <li><a href="{{ route('admin.create') }}"> <i class="fa fa-bar-chart-o"></i> List</a></li> -->
          <li><a href="{{ route('prof_sec.index') }}"> <i class="fa fa-bar-chart-o"></i> Assign Section</a></li>
        </ul>
      </li>
      <li><a href="{{ route('admin.grade.index') }}"><i class="fa fa-file-o"></i> Grade</a></li>
      
      <!-- <li><a href="{{ route('admin.settings') }}"><i class="fa fa-wrench"></i> Settings</a></li> -->
      
            <!-- <li><a href="{{ URL::to('/administrator'); }}"><i class="fa fa-dashboard"></i> DASHBOARD</a></li> -->
            <!-- <li><a href="#"><i class="fa fa-users"></i> USERS</a></li> -->
            <!-- <li><a href="#"><i class="fa fa-ban"></i> Penalty</a></li> -->
            
            <!-- <li class="dropdown">
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
            @endif -->

            <!-- <li><a href="#"><i class="fa fa-file-o"></i> GRADE</a></li> -->
            @if(isset($ux->quiz))
                <li class="dropdown active">
            @else
                <li class="dropdown">
            @endif
                <a href="#" class="dropdown-toggle {{ $ux->scholarship or '' }}" data-toggle="dropdown"><i class="fa fa-certificate"></i> Scholarship <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    {{ HTML::isActive("administrator/scholarship", "<i class='fa fa-gear'></i> Manage</a>") }}
                    {{ HTML::isActive("administrator/scholarship/reports", "<i class='fa fa-copy'></i> Reports</a>") }}

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle {{ $ux->quiz or '' }}" data-toggle="dropdown"><i class="fa fa-pencil"></i> Examination <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            {{ HTML::isActive("administrator/quiz", "<i class='fa fa-list'></i> Examination List</a>") }}
                            {{ HTML::isActive("administrator/quiz/create", "<i class='fa fa-plus'></i> Add Examination</a>") }}
                            {{ HTML::isActive("administrator/scholarship/quiz/exam-station-mode", "<i class='fa fa-laptop'></i> Exam Station Mode</a>") }}
                        </ul>
                    </li>
                    @if(isset($ux->quiz_question))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle {{ $ux->quiz or '' }}" data-toggle="dropdown"><i class="fa fa-question"></i> Question <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                {{ HTML::isActive("administrator/quiz/".$quiz_id."/question", "<i class='fa fa-list'></i> Question List</a>") }}
                                {{ HTML::isActive("administrator/quiz/".$quiz_id."/question/create", "<i class='fa fa-plus'></i> Add Question</a>") }}
                            </ul>
                        </li>
                    @endif
                    @if(isset($ux->question_choice))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle {{ $ux->quiz or '' }}" data-toggle="dropdown"><i class="fa fa-list-ul"></i> Choice <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                {{ HTML::isActive("administrator/quiz/".$quiz_id."/question/".$question_id."/choice", "<i class='fa fa-list'></i> Choice List</a>") }}
                                {{ HTML::isActive("administrator/quiz/".$quiz_id."/question/".$question_id."/choice/create", "<i class='fa fa-plus'></i> Add Choice</a>") }}
                            </ul>
                        </li>
                    @endif
                    @if(isset($ux->quiz_scholarship))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle {{ $ux->scholarship or '' }}" data-toggle="dropdown"><i class="fa fa-certificate"></i> Set Scholarship <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                {{ HTML::isActive("administrator/quiz/".$quiz_id."/scholarship/create", "<i class='fa fa-plus'></i> Add Scholarship</a>") }}
                            </ul>
                        </li>
                    @endif
                    @if(isset($ux->quiz_schedule))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle {{ $ux->schedule or '' }}" data-toggle="dropdown"><i class="fa fa-calendar"></i> Set Schedule <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                {{ HTML::isActive("administrator/quiz/".$quiz_id."/schedule/create", "<i class='fa fa-plus'></i> Add Schedule</a>") }}
                            </ul>
                        </li>
                    @endif
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-files-o"></i> Section <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('sec.create') }}"> <i class="fa fa-plus"></i> Create</a></li>
                  <li><a href="{{ route('sec.index') }}"> <i class="fa fa-list-alt"></i> List</a></li>
                </ul>
              </li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book"></i> Subject <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('subj.create') }}"> <i class="fa fa-plus"></i> Create</a></li>
                    <li><a href="{{ route('subj.index') }}"> <i class="fa fa-list-alt"></i> List</a></li>
                </ul>
              </li>
              <li><a href="{{ route('admin.yr.index') }}"><i class="fa fa-list-alt"></i> Year Level</a></li>
            <!-- 
            <li><a href="#"><i class="fa fa-book"></i> Subject</a></li> -->  
            <li><a href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
        </ul>
        
@endif

        <ul class="nav navbar-nav navbar-right navbar-user account-status">
<!--             <li class="dropdown messages-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">7 New Messages</li>
                    <li class="message-preview">
                        <a href="#">
                        <span class="avatar"><img src="http://placehold.it/50x50"></span>
                        <span class="name">John Smith:</span>
                        <span class="message">Hey there, I wanted to ask you something...</span>
                        <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li class="message-preview">
                        <a href="#">
                        <span class="avatar"><img src="http://placehold.it/50x50"></span>
                        <span class="name">John Smith:</span>
                        <span class="message">Hey there, I wanted to ask you something...</span>
                        <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li class="message-preview">
                        <a href="#">
                        <span class="avatar"><img src="http://placehold.it/50x50"></span>
                        <span class="name">John Smith:</span>
                        <span class="message">Hey there, I wanted to ask you something...</span>
                        <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="#">View Inbox <span class="badge">7</span></a></li>
                </ul>
            </li> -->
           <!--  <li class="dropdown alerts-dropdown">
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
          
          <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
          <li class="divider"></li>
          <li><a href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i> Log Out</a></li>
        </ul>

      </li>
        </ul>
    </div>