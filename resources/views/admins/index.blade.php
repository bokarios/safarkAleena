@extends('layouts.main')
@section('content')

  <!-- Sidenav -->
  @include('inc.sidenav')

  <!-- Main content -->
  <div class="main-content pb-5">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->

        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-md rounded-circle bg-white">
                  <i class="fas fa-bus fa-2x text-gradient-primary-dark"></i>
                </span>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h5 class="text-overflow m-0 text-center direction-rtl">مرحبا!</h5>
              </div>
              {{-- <a href="#" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>الإعدادات</span>
              </a> --}}
              <div class="dropdown-divider"></div>
              <a href="/logout" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>الخروج</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
  <div class="header bg-gradient-primar pt-5 pt-md-8" style="padding-bottom:250px;background:linear-gradient(40deg, #11cdef 75%, #1faac3 60%)">
    {{-- @include('inc.stats')   --}}
  </div>
    <!-- Page content -->
    <div class="container-fluid mt--7" style="margin-top:-320px !important">
      @include('inc.tabs')
    </div>
  </div>

  @include('inc.modals')
    
@endsection