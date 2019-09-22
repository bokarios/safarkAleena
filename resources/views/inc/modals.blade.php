<!-- Modals -->
  <!-- add bus -->
  <div class="modal fade" id="add-bus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title text-center ml-auto">اضافة باص جديد</h1>
          <button type="button" class="close text-danger" data-dismiss="modal" aria-label="close" id="add-bus-x">
            <i class="fa fa-times text-danger"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <form id="add-bus-form">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                  <div id="add-bus-feedback"></div>
                  <div class="form-group">
                    <input type="text" class="form-control text-right" id="bus-name" placeholder="اسم الناقل">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control text-right" id="bus-type" placeholder="اسم الباص">
                  </div>
                  <div class="form-group">
                      <input type="number" class="form-control text-right" id="bus-seats" placeholder="عدد المقاعد">
                    </div>
                  <div class="form-group">
                    <div class="row mt-5 direction-rtl">
                      <div class="col">
                        <button class="btn btn-primary btn-block" type="button" id="bus-add-btn">اضافة</button>
                      </div>
                      <div class="col">
                        <button class="btn btn-light btn-block" type="button" id="bus-reset-btn">اعادة ضبط</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- add tripes -->
  <div class="modal fade" id="add-trip" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title text-center ml-auto">اضافة رحلة جديدة</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="close" id="add-trip-x">
            <i class="fa fa-times text-danger text-center"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <form id="add-trip-form">
                  <div id="add-trip-feedback"></div>
                  <div class="row direction-rtl">
                    <div class="col-6">
                      <div class="form-group">
                        <select class="form-control direction-rtl" id="trip-bus">
                          <option value="" disabled selected>الباصات</option>
                          @foreach($buses as $bus)
                            <option value="{{$bus->id}}">{{ $bus->name }}-{{$bus->type}}</option>
                          @endforeach
                        </select>
                      </div>
                        <div class="form-group">
                          <input type="text" class="form-control text-right" id="trip-source" placeholder="البداية">
                        </div>
                      <div class="form-group">
                        <input type="text" class="form-control text-right" id="trip-destination" placeholder="الوجهة">
                      </div>
                      <div class="form-group">
                        <input type="number" class="form-control text-right" id="trip-seats" placeholder="عدد المقاعد المتاحة">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="trip-attend" class="float-right mr-2">زمن الحضور</label>
                        <input type="time" class="form-control text-right" id="trip-attend">
                      </div>
                      <div class="form-group">
                          <label for="trip-start" class="float-right mr-2">زمن الانطلاق</label>
                        <input type="time" class="form-control text-right" id="trip-start">
                      </div>
                      <div class="form-group">
                        <input type="number" class="form-control text-right" id="trip-price" placeholder="سعر التذكرة">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row mt-5 direction-rtl">
                      <div class="col">
                        <button class="btn btn-primary btn-block" type="button" id="trip-add-btn">اضافة</button>
                      </div>
                      <div class="col">
                        <button class="btn btn-light btn-block" type="button" id="trip-reset-btn">اعادة ضبط</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- add static tripes -->
  <div class="modal fade" id="add-static" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title text-center ml-auto">اضافة رحلة افتراضية</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="close" id="add-trip-x">
              <i class="fa fa-times text-danger text-center"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <form id="add-static-form">
                    <h4 class="text-center text-muted mb-4">
                      الرحلات الافتراضية هي التي تظهر للعميل عند القيام بحجز آجل
                    </h4>
                    <div id="add-static-feedback"></div>
                    <div class="form-group">
                        <input type="text" class="form-control text-right" id="static-source" placeholder="البداية">
                      </div>
                    <div class="form-group">
                      <input type="text" class="form-control text-right" id="static-destination" placeholder="الوجهة">
                    </div>
                    <div class="form-group">
                      <div class="row mt-5 direction-rtl">
                        <div class="col">
                          <button class="btn btn-primary btn-block" type="button" id="static-add-btn">اضافة</button>
                        </div>
                        <div class="col">
                          <button class="btn btn-light btn-block" type="button" id="static-reset-btn">اعادة ضبط</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- add admin -->
  <div class="modal fade" id="add-admin" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title text-center ml-auto">اضافة مدير جديد</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="close" id="add-admin-x">
            <i class="fa fa-times text-danger"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <form id="add-admin-form">
                  <div id="add-admin-feedback"></div>
                  <div class="form-group">
                    <input type="text" class="form-control text-right" id="admin-name" placeholder="اسم المدير">
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control text-right" id="admin-email" placeholder="البريد الالكتروني">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control text-right" id="admin-password" placeholder="كلمة المرور" min="8">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control text-right" id="admin-password2" placeholder="تأكيد كلمة المرور" min="8">
                  </div>
                  <div class="form-group">
                    <select id="access" class="form-control direction-rtl">
                      <option value="" disabled selected>مستوى الوصول</option>
                      <option value="0">صلاحية كاملة</option>
                      <option value="1">صلاحية المشاهدة و التعديل</option>
                      <option value="3">صلاحية المشاهدة فقط</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row mt-5 direction-rtl">
                      <div class="col">
                        <button class="btn btn-primary btn-block" type="button" id="admin-add-btn">اضافة</button>
                      </div>
                      <div class="col">
                        <button class="btn btn-light btn-block" type="button" id="admin-reset-btn">اعادة ضبط</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>