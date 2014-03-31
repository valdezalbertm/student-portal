<!-- S: Prompts for Account -->
@if (Session::get('action') == 'CREATE_SUCCESS')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Account created successfully!</center>
  </div>
@elseif (Session::get('action') == 'UPDATE_SUCCESS')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Account updated successfully!</center>
  </div>
@elseif (Session::get('action') == 'DELETE_FAILED')
  <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Account update failed!</center>
  </div>
@elseif (Session::get('action') == 'DELETE_SUCCESS')
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <center>Account deleted successfully!</center>
    </div>
<!-- E: Prompts for Account -->

<!-- S: Prompts for Student -->
@elseif (Session::get('action') == 'CREATE_STUDENT_SUCCESS')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Student successfully added!</center>
  </div>
<!-- E: Prompts for Student -->

<!-- S: Prompts for Subject -->
@elseif (Session::get('action') == 'SUBJECT_CREATE_SUCCESS')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Subject created successfully!</center>
  </div>
@elseif (Session::get('action') == 'SUBJECT_UPDATE_SUCCESS')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Subject updated successfully!</center>
  </div>
@elseif (Session::get('action') == 'SUBJECT_DELETE_SUCCESS')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Subject deleted successfully!</center>
  </div>
<!-- E: Prompts for Subject -->

<!-- S: Prompts for Section -->
@elseif (Session::get('action') == 'SECTION_CREATE_SUCCESS')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Section created successfully!</center>
  </div>
@elseif (Session::get('action') == 'SECTION_UPDATE_SUCCESS')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Section updated successfully!</center>
  </div>
@elseif (Session::get('action') == 'SECTION_DELETE_SUCCESS')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Section deleted successfully!</center>
  </div>
<!-- E: Prompts for Section -->


<!-- S: Prompts for Section Student -->
@elseif (Session::get('action') == 'SECTION_STUDENT_CREATE_SUCCESS')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Student(s) successfully added to section!</center>
  </div>
@elseif (Session::get('action') == 'SECTION_STUDENT_UPDATE_SUCCESS')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Section updated successfully!</center>
  </div>
@elseif (Session::get('action') == 'SECTION_STUDENT_DELETE_SUCCESS')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Student successfully removed to section!</center>
  </div>
<!-- E: Prompts for Section Student-->

<!-- S: Prompts for Professor Section -->
@elseif (Session::get('action') == 'PROFESSOR_SECTION_CREATE_SUCCESS')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Section successfully added to instructor!</center>
  </div>
@elseif (Session::get('action') == 'PROFESSOR_SECTION_UPDATE_SUCCESS')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Instructor updated successfully!</center>
  </div>
@elseif (Session::get('action') == 'PROFESSOR_SECTION_DELETE_SUCCESS')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Section successfully removed to instructor!</center>
  </div>
<!-- E: Prompts for Professor Section -->


<!-- S: Prompts for Student Grade -->
@elseif (Session::get('action') == 'STUDENT_GRADE_UPDATE_SUCESS')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Student grade updated successfully!</center>
  </div>
<!-- E: Prompts for Student Grade -->
@elseif (Session::get('action') == 'YEAR_LEVEL_UPDATED')
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <center>Year level updated successfully!</center>
  </div>
<!-- S: Update Year Level -->

<!-- E: Update Year Level -->
@endif
