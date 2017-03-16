<!DOCTYPE html>
<html lang="en">
  @include('partials._head')
  <body>
    @include('partials._nav')
    <div id="app" class="container">
      @include('partials._messages')

      <!--{{ Auth::check()?"Logged In":"Logged Out" }}-->

      @yield('content')
      @include('partials._footer')
    </div>
    @include('partials._javascript')
    @yield('scripts')
  </body>
</html>