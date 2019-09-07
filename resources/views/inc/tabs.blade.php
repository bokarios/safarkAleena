<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane animated fadeInDown show active" id="nav-reservation" role="tabpanel" aria-labelledby="nav-reservation-tab">
    <!-- reservations list -->
    <div class="row mt-5" id="results-list">
      <div class="col-xl-10 mx-auto mb-5 mb-xl-0">
        <div class="card shadow-custome">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col text-center">
                <h1 class="mb-0">الحجوزات</h1>
              </div>
            </div>
            <hr class="bg-gradient-primary w-50 my-3" style="height:2px">
          </div>
          <div class="card-body">
            @if($reservations)
              <div class="table-responsive">
                <table class="table table-striped table-bordered hover direction-rtl">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">الإسم</th>
                      <th class="text-center">البداية</th>
                      <th class="text-center">الوجهة</th>
                      <th class="text-center">نوع الباص</th>
                      <th class="text-center tbl-btn-p">عدد المقاعد</th>
                    </tr>
                  </thead>
                  <tbody class="tbl-btn-p" id="tbl-row" ondblclick="document.getElementById('tbl-row').classList.add('active');" onclick="document.getElementById('tbl-row').classList.remove('active')">
                    <?php $i = 1 ?>
                    @foreach($reservations as $resv)
                      <tr>
                        <td class="text-center">{{$i}}</td>
                        <td class="text-center">{{$resv->client_name}}</td>
                        <td class="text-center">{{$resv->trip_source}}</td>
                        <td class="text-center">{{$resv->trip_destination}}</td>
                        <td class="text-center">{{$resv->bus_type}}</td>
                        <td class="text-center">{{$resv->booked_seats}}</td>
                        <td class="tbl-btn animated slideInLeft">
                          <i class="fas fa-edit text-primary sp-i mr-2"></i>
                          <i class="fas fa-trash text-danger sp-i mr-2"></i>
                        </td>
                      </tr>
                      <?php $i++ ?>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
            <div class="row">
              <div class="col-12 text-center">
                <i class="fa fa-times-circle text-danger fa-2x text-center"></i>
                <h2 class="text-center text-danger">لا يوجد بيانات حاليا</h2>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane animated fadeInDown" id="nav-sure" role="tabpanel" aria-labelledby="nav-sure-tab">
    <!-- confirmed reservations list -->
    <div class="row mt-5">
      <div class="col-xl-10 mx-auto mb-5 mb-xl-0">
        <div class="card shadow-custome">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col text-center">
                <h1 class="mb-0">الحجوزات المؤكدة</h1>
              </div>
            </div>
          </div>
          <div class="card-body">
            @if(true)
              <div class="table-responsive">
                <table class="table table-striped table-hover direction-rtl">
                  <thead>
                    <th class="text-center">#</th>
                    <th class="text-center">الإسم</th>
                    <th class="text-center">الموقع</th>
                    <th class="text-center">الوجهة</th>
                    <th class="text-center">نوع الباص</th>
                    <th class="text-center">عدد المقاعد</th>
                  </thead>
                  <tbody>
                    @for($i=1;$i<=8;$i++)
                      <tr>
                      <td class="text-center">{{$i}}</td>
                        <td class="text-center">data</td>
                        <td class="text-center">data</td>
                        <td class="text-center">data</td>
                        <td class="text-center">data</td>
                        <td class="text-center">data</td>
                      </tr>
                    @endfor
                  </tbody>
                </table>
              </div>
            @else
              <i class="fas fa-warning text-center fa-2x"></i>
              <h5 class="text-cenetr text-muted">لا يوجد بيانات حاليا</h5>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane animated fadeInDown" id="nav-company" role="tabpanel" aria-labelledby="nav-company-tab">
    <!-- company list -->
    <div class="row mt-5">
      <div class="col-xl-10 mx-auto mb-5 mb-xl-0">
        <div class="card shadow-custome">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col text-center">
                <h2 class="mb-0 text-muted">الشركات</h2>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover" style="direction:rtl">
                <thead>
                  <th class="text-center">#</th>
                  <th class="text-center">الإسم</th>
                  <th class="text-center">الموقع</th>
                  <th class="text-center">المدير</th>
                  <th class="text-center">الطلبات</th>
                  <th class="text-center">الحجوزات المؤكدة</th>
                </thead>
                <tbody>
                  @for($i=1;$i<=8;$i++)
                    <tr>
                      <td class="text-center">data</td>
                      <td class="text-center">data</td>
                      <td class="text-center">data</td>
                      <td class="text-center">data</td>
                      <td class="text-center">data</td>
                      <td class="text-center">data</td>
                    </tr>
                  @endfor
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane animated fadeInDown" id="nav-delayed" role="tabpanel" aria-labelledby="nav-delayed-tab">
    <!-- delayed list -->
    <div class="row mt-5" id="subjects-list">
      <div class="col-xl-10 mx-auto mb-5 mb-xl-0">
        <div class="card shadow-custome">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col text-center">
                <h3 class="mb-0 text-muted">الحجوزات المؤخرة</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <th class="text-center">#</th>
                  <th class="text-center">الإسم</th>
                  <th class="text-center">الموقع</th>
                  <th class="text-center">المدير</th>
                  <th class="text-center">الطلبات</th>
                  <th class="text-center">الحجوزات المؤكدة</th>
                </thead>
                <tbody>
                  @for($i=1;$i<=8;$i++)
                    <tr>
                      <td class="text-center">data</td>
                      <td class="text-center">data</td>
                      <td class="text-center">data</td>
                      <td class="text-center">data</td>
                      <td class="text-center">data</td>
                      <td class="text-center">data</td>
                    </tr>
                  @endfor
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane animated fadeInDown" id="nav-stat" role="tabpanel" aria-labelledby="nav-stat-tab">
    <!-- statistics -->
    <div class="row mt-5">
      <div class="col-xl-10 mx-auto mb-5 mb-xl-0">
        <div class="card shadow-custome">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col text-center">
                <h2 class="mb-0 text-muted">الإحصائيات</h2>
              </div>
            </div>
          </div>
          <div class="card-body">
            <ul class="list-group">
              <li class="list-group-item" style="direction:rtl">
                <h4 class="text-right mr-3">عدد الشركات</h4>
                <div class="progress" style="height: 25px">
                  <div class="progress-bar text-light progress-bar-striped text-center" role="progressbar" style="width: 25%" aria-valuenow="200" aria-valuemin="0" aria-valuemax="1000">
                    200
                  </div>
                </div>
              </li>
              <li class="list-group-item" style="direction:rtl">
                <h4 class="text-right mr-3">عدد الرحلات</h4>
                <div class="progress" style="height: 25px">
                  <div class="progress-bar text-light progress-bar-striped text-center" role="progressbar" style="width: 45%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                    3000
                  </div>
                </div>
              </li>
              <li class="list-group-item" style="direction:rtl">
                <h4 class="text-right mr-3">عدد طلبات الحجز</h4>
                <div class="progress" style="height: 25px">
                  <div class="progress-bar text-light progress-bar-striped text-center" role="progressbar" style="width: 45%" aria-valuenow="12000" aria-valuemin="0" aria-valuemax="40000">
                    12000
                  </div>
                </div>
              </li>
              <li class="list-group-item" style="direction:rtl">
                <h4 class="text-right mr-3">عدد الحجوزات المؤكدة</h4>
                <div class="progress" style="height: 25px">
                  <div class="progress-bar text-light progress-bar-striped text-center" role="progressbar" style="width: 55%" aria-valuenow="38000" aria-valuemin="0" aria-valuemax="40000">
                    38000
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>