@if($message = Session::get('success'))
  <div class="alert alert-success text-center alert-top animated slideOutUp delay-4s">
    <h3 class="text-white">{{$message}}</h3>
  </div>
@endif

@if($message = Session::get('error'))
  <div class="alert alert-error text-center alert-top animated slideOutUp delay-4s">
    <h3 class="text-white">{{$message}}</h3>
  </div>
@endif

@if($message = Session::get('warning'))
  <div class="alert alert-warning text-center alert-top animated slideOutUp delay-4s">
    <h3 class="text-white">{{$message}}</h3>
  </div>
@endif

@if($message = Session::get('danger'))
  <div class="alert alert-danger text-center alert-top animated slideOutUp delay-4s">
    <h3 class="text-white">{{$message}}</h3>
  </div>
@endif

@if($message = Session::get('info'))
  <div class="alert alert-info text-center alert-top animated slideOutUp delay-4s">
    <h3 class="text-white">{{$message}}</h3>
  </div>
@endif