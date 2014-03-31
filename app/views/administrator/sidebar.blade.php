<!-- SIDEBAR -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- BRAND AND TOGGLE GET GROUPED FOR BETTER MOBILE DISPLAY -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::to('/administrator'); }}">ST. JUDE ACADEMY OF DASMARINAS ACADEMIC PORTAL</a>
    </div>

    @if (Session::get('account_type') == 'Student')
        @include('sidebar.stud')
    @elseif (Session::get('account_type') == 'Professor')
        @include('sidebar.prof')
    @elseif (Session::get('account_type') == 'Administrator')
        @include('sidebar.admin')
    @else
        "No sidebar"
    @endif
</nav>