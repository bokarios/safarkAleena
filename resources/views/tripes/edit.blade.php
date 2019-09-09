@extends('layouts.main')
@section('content')
	<div class="container pt-3 mb-5">
		<div class="row">
			<div class="col-xl-7 col-lg-10 col-md-10 col-sm-12 mx-auto">
				<div class="row">
					<div class="col-12 px-lg-5 text-center bg-white shadow-sp-sm pt-5" style="border-radius: 4px;background: linear-gradient(40deg, #dee2e6 50%, #c5c9ca 40%)">
						<div class="row text-center">
							<div class="col-12 px-lg-5 px-sm-5 text-center">
								<h1 class="text-dark">
									تعديل معلومات الرحلة
                </h1>
								<form class="mt-5 px-lg-5 px-md-5 px-sm-5" method="POST" action="/tripes/{{$trip->id}}/edit">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="form-group mx-md-5 mx-sm-3">
										<label class="sr-only" for="bus">
											bus
										</label>
										<div class="input-group mb-2 mr-sm-2">
											<div class="input-group-prepend" style="cursor: pointer">
												<div class="input-group-text {{$errors->has('trip')?'border-danger':''}}" style="height: 46px;width:50px">
													<i class="fas fa-bus text-muted"></i>
												</div>
											</div>
											<select name="bus" id="bus" class="form-control direction-rtl">
                        <option value="{{ $bus->id }}" selected>{{ $bus->name }} ({{ $bus->type }})</option>
                        @foreach($buses as $b)
                          <option value="{{ $b->id }}">{{ $b->name }} ({{ $b->name }})</option>
                        @endforeach
                      </select>
										</div>
										<h4 class="form-text text-right text-muted mr-3 simple-transition animated">
											@if($errors->has('trip'))
												{!! $errors->first('trip', '<span class="text-danger">:message</span>') !!}
											@else
											  يمكنك تعديل الباص
											@endif											
										</h4>
									</div>
									<div class="form-group mx-md-5 mx-sm-3">
										<label class="sr-only" for="name">name</label>
										<div class="input-group mb-2 mr-sm-2">
											<div class="input-group-prepend">
												<div class="input-group-text" style="height: 46px;width:50px">
													<i class="fas fa-map-marked text-muted"></i>
												</div>
											</div>
											<input type="text" class="form-control bg-secondary text-right disabled" name="source" value="{{ $trip->source }}">
										</div>
										<h4 class="form-text text-muted text-right mr-3">
												يمكنك تعديل البداية
										</h4>
									</div>
									<div class="form-group mx-md-5 mx-sm-3">
										<label class="sr-only" for="name">name</label>
										<div class="input-group mb-2 mr-sm-2">
											<div class="input-group-prepend">
												<div class="input-group-text" style="height: 46px;width:50px">
													<i class="fas fa-map-marked text-muted"></i>
												</div>
											</div>
											<input type="text" class="form-control bg-secondary text-right" name="destination" value="{{ $trip->destination }}">
										</div>
										<h4 class="form-text text-muted text-right mr-3">
												يمكنك تعديل الوجهة
										</h4>
									</div>
                  <div class="form-group mx-md-5 mx-sm-3">
                    <label class="sr-only" for="seats">seats</label>
                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text" style="height: 46px;width:50px">
                          <span style="font-size:22px" class="text-muted">#</span>
                        </div>
                      </div>
                      <input type="number" class="form-control bg-secondary text-right" name="seats" id="seats" value="{{ $trip->avilable_seats }}">
                    </div>
                    <h4 class="form-text text-muted text-right mr-3">
                      @if($errors->has('seats'))
												{!! $errors->first('seats', '<span class="text-danger">:message</span>') !!}
											@else
											  يمكنك تعديل عدد المقاعد المتاحة
											@endif
                    </h4>
									</div>
									<div class="form-group mx-md-5 mx-sm-3">
										<label class="sr-only" for="name">name</label>
										<div class="input-group mb-2 mr-sm-2">
											<div class="input-group-prepend">
												<div class="input-group-text" style="height: 46px;width:50px">
													<i class="fas fa-clock text-muted"></i>
												</div>
											</div>
											<input type="time" class="form-control bg-secondary text-right" name="attend" value="{{ $trip->attend_time }}">
										</div>
										<h4 class="form-text text-muted text-right mr-3">
												يمكنك تعديل زمن الحضور
										</h4>
									</div>
									<div class="form-group mx-md-5 mx-sm-3">
										<label class="sr-only" for="name">name</label>
										<div class="input-group mb-2 mr-sm-2">
											<div class="input-group-prepend">
												<div class="input-group-text" style="height: 46px;width:50px">
													<i class="fas fa-clock text-muted"></i>
												</div>
											</div>
											<input type="time" class="form-control bg-secondary text-right" name="start" value="{{ $trip->trip_start_time }}">
										</div>
										<h4 class="form-text text-muted text-right mr-3">
												يمكنك تعديل زمن الانطلاق
										</h4>
									</div>
									<div class="form-group mx-md-5 mx-sm-3">
										<label class="sr-only" for="name">name</label>
										<div class="input-group mb-2 mr-sm-2">
											<div class="input-group-prepend">
												<div class="input-group-text" style="height: 46px;width:50px">
													<i class="fas fa-credit-card text-muted"></i>
												</div>
											</div>
											<input type="number" class="form-control bg-secondary text-right" name="price" value="{{ $trip->price }}">
										</div>
										<h4 class="form-text text-muted text-right mr-3">
												يمكنك تعديل سعر التذكرة
										</h4>
									</div>
									<div class="form-group text-center mt-4 mb-4 direction-rtl">
										<button type="submit" class="btn btn-outline-dark btn-md">
											تعديل المعلومات
                    </button>
                    <button type="submit" class="btn btn-outline-dark btn-md mr-5">العودة الى القائمة</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection