
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
      <?php if(Auth::check()): ?>
          <li class="<?php echo e(Request::is('dashboard')?"active":""); ?>"><a href="/dashboard">Dashboard</a></li>
          <li class="<?php echo e(Request::is('rooms')?"active":""); ?>"><a href="<?php echo e(route('rooms.index')); ?>">Rooms</a></li>
          <li class="<?php echo e(Request::is('admissions')?"active":""); ?>"><a href="<?php echo e(route('admissions')); ?>">Admission</a></li>
          <li class="<?php echo e(Request::is('admitFee')?"active":""); ?>"><a href="<?php echo e(route('admitFee.index')); ?>">Admit Fee</a></li>
          <li class="<?php echo e(Request::is('roomRent')?"active":""); ?>"><a href="<?php echo e(route('roomRent.index')); ?>">Room Rent</a></li>
          <li class="<?php echo e(Request::is('messFee')?"active":""); ?>"><a href="<?php echo e(route('messFee.index')); ?>">Mess Fee</a></li>

          <li class="<?php echo e(Request::is('discharge')?"active":""); ?>"><a href="<?php echo e(route('discharge.index')); ?>">Discharge</a></li>
          

           <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Accounts <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo e(route('account.index')); ?>">Main A/C</a></li>
                <li><a href="<?php echo e(route('messAccount.index')); ?>">Mess A/C</a></li>
              </ul>
          </li>
          
          <li class="<?php echo e(Request::is('reports')?"active":""); ?>"><a href="<?php echo e(route('reports.index')); ?>">Reports</a></li>

          <li class="<?php echo e(Request::is('users')?"active":""); ?>"><a href="<?php echo e(route('users.index')); ?>">Users</a></li>
          
      <?php else: ?>
        <li class="<?php echo e(Request::is('/')?"active":""); ?>"><a href="/">Home</a></li>
      <?php endif; ?>

      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="<?php echo e(Request::is('contact')?"active":""); ?>"><a href="<?php echo e(route('public.contact')); ?>">Contact</a></li>
        <li class="<?php echo e(Request::is('about')?"active":""); ?>"><a href="<?php echo e(route('public.about')); ?>">About</a></li>
      <?php if(Auth::check()): ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello <?php echo e(Auth::user()->name); ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo e(route('logout')); ?>">Logout</a></li>
          </ul>
        </li>

        <?php else: ?>
          <ul class="nav navbar-nav">
            <li class=""><a href="<?php echo e(route('login')); ?>">Login</a></li>
            <!--Register link here-->
          </ul>
         
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>