<nav class="navbar navbar-vertical fixed-right navbar-expand-md navbar-light bg-white" id="sidenav-main" style="box-shadow: 2px 0px 2px 0px rgba(136, 152, 170, .15) !important">
  <div class="container-fluid">
    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Brand -->
    <a class="navbar-brand text-gradient-primary-dark" href="/panel">
      <i class="fas fa-bus"></i> سفرك علينا
    </a>
    <!-- User -->
    <ul class="nav align-items-center d-md-none">
      <li class="nav-item dropdown">
        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <i class="fas fa-bus"></i>
              </span>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <i class="ni ni-settings-gear-65"></i>
            <span>الإعدادات</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="/logout" class="dropdown-item">
            <i class="ni ni-user-run"></i>
            <span>الخروج</span>
          </a>
        </div>
      </li>
    </ul>
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
      <!-- Collapse header -->
      <div class="navbar-collapse-header d-md-none">
        <div class="row">
          <div class="col-6 collapse-brand">
            <a href="#">
              Safark <i class="fa fa-car"></i>
            </a>
          </div>
          <div class="col-6 collapse-close">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
              <span></span>
              <span></span>
            </button>
          </div>
        </div>
      </div>
      <!-- Navigation -->
      <ul class="navbar-nav nav nav-tabs pr-0" id="myTab" style="direction:rtl">
        @if($admin->access == 0 || $admin->access == 1)
        <li class="nav-item text-center" style="font-size:22px">
          الاضافة
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-outline-secondary btn-block" href="#" data-toggle="modal" data-target="#add-bus">
            <i class="fa fa-plus-circle text-muted"></i> إضافة باص جديد
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-outline-secondary btn-block" href="#" data-toggle="modal" data-target="#add-trip">
            <i class="fa fa-plus-circle text-muted"></i> إضافة رحلة جديدة
          </a>
        </li>
        @if($admin->access == 0)
        <li class="nav-item">
          <a class="nav-link btn btn-outline-secondary btn-block" href="#" data-toggle="modal" data-target="#add-admin">
            <i class="fa fa-plus-circle text-muted"></i> إضافة مدير جديد
          </a>
        </li>
        @endif
        @endif
        <li class="nav-divider"><hr class="my-1"></li>
        <li class="nav-item-circle text-center" style="font-size:22px">
          القوائم
        </li>
        <li class="nav-item">
          <a class="nav-item nav-link active btn btn-outline-secondary btn-block" id="nav-reservation-tab" data-toggle="tab" href="#nav-reservation" role="tab" aria-controls="nav-reservation" aria-selected="true">
            <i class="fa fa-table text-muted"></i> قائمة الحجوزات
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-item nav-link btn btn-outline-secondary btn-block" id="nav-delayed-tab" data-toggle="tab" href="#nav-delayed" role="tab" aria-controls="nav-delayed" aria-selected="true">
            <i class="fa fa-clock text-muted"></i> الحجوزات المؤجلة
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-item nav-link btn btn-outline-secondary btn-block" id="nav-trip-tab" data-toggle="tab" href="#nav-trip" role="tab" aria-controls="nav-trip" aria-selected="true">
            <i class="fa fa-table text-muted"></i> قائمة الرحلات
          </a>
        </li>
      </ul>
      <!-- Navigation -->
      <ul class="navbar-nav mb-md-3" style="direction:rtl">
        <li class="nav-item">
          <a class="nav-link btn btn-outline-secondary btn-block" href="/logout">
            <i class="ni ni-user-run text-dark"></i> الخروج
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>