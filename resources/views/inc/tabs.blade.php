<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane animated fadeInDown show active" id="nav-reservation" role="tabpanel" aria-labelledby="nav-reservation-tab">
    <!-- reservations list -->
    <div class="row mt-5" id="results-list">
      <div class="col-xl-12 mx-auto mb-5 mb-xl-0">
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
              <div class="row">
                <div class="col-12">
                  <div class="col-xl-5 col-lg-6 col-md-10 col-sm-7 ml-auto pr-0">
                    <div class="form-group mx-md-5 mx-sm-3">
                      <label class="sr-only" for="reservation-search">search</label>
                      <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text" style="height: 46px;width:50px">
                            <i class="fas fa-search text-gradient-primary-dark"></i>
                          </div>
                        </div>
                        <input type="email" class="form-control text-right" id="reservation-search" placeholder="البحث في الحجوزات">
                      </div>
                      <h4 class="form-text text-muted text-right mr-3">
                        يمكنك البحث بالاسم او البداية او الوجهة  
                      </h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive" id="resv-table">
                <table class="table table-striped table-bordered table-hover direction-rtl">
                  <thead class="thead-light">
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">الإسم</th>
                      <th class="text-center">البداية</th>
                      <th class="text-center">الوجهة</th>
                      <th class="text-center">نوع الباص</th>
                      <th class="text-center">عدد المقاعد</th>
                      <th class="text-center">الدفع</th>
                      <th class="text-center">التاريخ</th>
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
                        <td class="text-center">
                          @if($resv->payed == 1)
                            <i class="fas fa-check-circle text-success"></i>
                          @else
                            <i class="fas fa-times-circle text-danger"></i>
                          @endif
                        </td>
                        <td class="text-center">{{ date('M d (h:ia)',strtotime($resv->created_at)) }}</td>
                        <td class="text-center tbl-btn animated slideInLeft px-1">
                          <a href="reservations/{{$resv->id}}/edit">
                            <i class="fas fa-edit text-primary mr-2"></i>
                          </a>  
                          <a href="reservations/{{$resv->id}}/delete">
                            <i class="fas fa-trash text-danger mr-2"></i>
                          </a> 
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
  <div class="tab-pane animated fadeInDown" id="nav-trip" role="tabpanel" aria-labelledby="nav-trip-tab">
    <!-- trips list -->
    <div class="row mt-5">
      <div class="col-xl-12 mx-auto mb-5 mb-xl-0">
        <div class="card shadow-custome">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col text-center">
                <h1 class="mb-0">الرحلات</h1>
              </div>
            </div>
            <hr class="bg-gradient-primary w-50 my-3" style="height:2px">
          </div>
          <div class="card-body">
              @if($trips)
              <div class="row">
                <div class="col-12">
                  <a href="tripes/truncate" class="btn btn-outline-warning">مسح جميع معلومات الرحلات</a>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="col-xl-5 col-lg-6 col-md-10 col-sm-7 ml-auto pr-0">
                    <div class="form-group mx-md-5 mx-sm-3">
                      <label class="sr-only" for="trip-search">search</label>
                      <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text" style="height: 46px;width:50px">
                            <i class="fas fa-search text-gradient-primary-dark"></i>
                          </div>
                        </div>
                        <input type="email" class="form-control text-right" id="trip-search" placeholder="البحث في الرحلات">
                      </div>
                      <h4 class="form-text text-muted text-right mr-3">
                        يمكنك البحث بالبداية او الوجهة او سعر التذكرة
                      </h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive" id="trip-table">
                <table class="table table-striped table-bordered hover direction-rtl">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">البداية</th>
                      <th class="text-center">الوجهة</th>
                      <th class="text-center">الحضور</th>
                      <th class="text-center">الانطلاق</th>
                      <th class="text-center">نوع الباص</th>
                      <th class="text-center">عدد المقاعد</th>
                      <th class="text-center tbl-btn-p">التذكرة</th>
                    </tr>
                  </thead>
                  <tbody class="tbl-btn-p" id="tbl-row-t" ondblclick="document.getElementById('tbl-row-t').classList.add('active');" onclick="document.getElementById('tbl-row-t').classList.remove('active')">
                    <?php $i = 1 ?>
                    @foreach($trips as $trip)
                      <tr>
                        <td class="text-center">{{$i}}</td>
                        <td class="text-center">{{$trip->source}}</td>
                        <td class="text-center">{{$trip->destination}}</td>
                        <td class="text-center">{{ date('h:ia', strtotime($trip->attend)) }}</td>
                        <td class="text-center">{{ date('h:ia', strtotime($trip->start)) }}</td>
                        <td class="text-center">{{$trip->bus_type}}</td>
                        <td class="text-center">{{$trip->seats}}</td>
                        <td class="text-center">{{$trip->price}}</td>
                        <td class="tbl-btn animated slideInLeft">
                          <a href="tripes/{{$trip->id}}/edit">
                            <i class="fas fa-edit text-primary sp-i mr-2"></i>
                          </a>
                          <a href="tripes/{{$trip->id}}/delete">
                            <i class="fas fa-trash text-danger sp-i mr-2"></i>
                          </a>
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
  <div class="tab-pane animated fadeInDown" id="nav-delayed" role="tabpanel" aria-labelledby="nav-delayed-tab">
    <!-- delayed list -->
    <div class="row mt-5" id="subjects-list">
      <div class="col-xl-12 mx-auto mb-5 mb-xl-0">
        <div class="card shadow-custome">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col text-center">
                <h1 class="mb-0">الحجوزات المؤجلة</h1>
              </div>
            </div>
            <hr class="bg-gradient-primary w-50 my-3" style="height:2px">
          </div>
          <div class="card-body">
              @if($delayed)
              <div class="row">
                <div class="col-12">
                  <div class="col-xl-5 col-lg-6 col-md-10 col-sm-7 ml-auto pr-0">
                    <div class="form-group mx-md-5 mx-sm-3">
                      <label class="sr-only" for="delayed-search">search</label>
                      <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text" style="height: 46px;width:50px">
                            <i class="fas fa-search text-gradient-primary-dark"></i>
                          </div>
                        </div>
                        <input type="email" class="form-control text-right" id="delayed-search" placeholder="البحث في الحجوزات المؤجلة">
                      </div>
                      <h4 class="form-text text-muted text-right mr-3">
                        يمكنك البحث بالاسم او البداية او الوجهة
                      </h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive" id="delayed-table">
                <table class="table table-striped table-bordered hover direction-rtl">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">الإسم</th>
                      <th class="text-center">البداية</th>
                      <th class="text-center">الوجهة</th>
                      <th class="text-center">التاريخ</th>
                      <th class="text-center tbl-btn-p">عدد المقاعد</th>
                    </tr>
                  </thead>
                  <tbody class="tbl-btn-p" id="tbl-row-d" ondblclick="document.getElementById('tbl-row-d').classList.add('active');" onclick="document.getElementById('tbl-row-d').classList.remove('active')">
                    <?php $i = 1 ?>
                    @foreach($delayed as $d)
                      <tr>
                        <td class="text-center">{{$i}}</td>
                        <td class="text-center">{{$d->client_name}}</td>
                        <td class="text-center">{{$d->trip_source}}</td>
                        <td class="text-center">{{$d->trip_destination}}</td>
                        <td class="text-center">{{ date('M d, Y', strtotime($d->date)) }}</td>
                        <td class="text-center">{{$d->booked_seats}}</td>
                        <td class="tbl-btn animated slideInLeft">
                          <a href="delayed/{{$d->id}}/edit">
                            <i class="fas fa-edit text-primary sp-i mr-2"></i>
                          </a>
                          <a href="delayed/{{$d->id}}/delete">
                            <i class="fas fa-trash text-danger sp-i mr-2"></i>
                          </a>
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
</div>