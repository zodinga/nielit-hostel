
<!--default bootstrap navbar-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Hostel Management System</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      @if(Auth::check())
          <li class="{{ Request::is('dashboard')?"active":"" }}"><a href="/dashboard">Dashboard</a></li>
          <li class="{{ Request::is('rooms')?"active":"" }}"><a href="{{route('rooms.index')}}">Rooms</a></li>
          <li class="{{ Request::is('admissions')?"active":"" }}"><a href="{{route('admissions')}}">Admission</a></li>
          <li class="{{ Request::is('admitFee')?"active":"" }}"><a href="{{route('admitFee.index')}}">Admit Fee</a></li>
          <li class="{{ Request::is('roomRent')?"active":"" }}"><a href="{{route('roomRent.index')}}">Room Rent</a></li>
          <li class="{{ Request::is('messFee')?"active":"" }}"><a href="{{route('messFee.index')}}">Mess Fee</a></li>

          <li class="{{ Request::is('discharge')?"active":"" }}"><a href="{{route('discharge.index')}}">Discharge</a></li>
          

           <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Accounts <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('account.index')}}">Main A/C</a></li>
                <li><a href="{{route('messAccount.index')}}">Mess A/C</a></li>
              </ul>
          </li>
          
          <li class="{{ Request::is('exports')?"active":"" }}"><a href="#">Exports</a></li>

          <li class="{{ Request::is('users')?"active":"" }}"><a href="{{route('users.index')}}">Users</a></li>
          
      @else
        <li class="{{ Request::is('/')?"active":"" }}"><a href="/">Home</a></li>
      @endif

      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="{{ Request::is('contact')?"active":"" }}"><a href="{{route('public.contact')}}">Contact</a></li>
        <li class="{{ Request::is('about')?"active":"" }}"><a href="{{route('public.about')}}">About</a></li>
      @if(Auth::check())
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello {{Auth::user()->name}}<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li role="separator" class="divider"></li>
            <li><a href="{{route('logout')}}">Logout</a></li>
          </ul>
        </li>

        @else
          <ul class="nav navbar-nav">
            <li class=""><a href="{{route('login')}}">Login</a></li>
            <!--Register link here-->
          </ul>
         
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>