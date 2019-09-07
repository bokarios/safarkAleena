@extends('layouts.app')
@section('content')
  <header class='roomsHero'>
    <div class='banner'>
      <h1>قائمة الرحلات</h1>
      <div class="bg-secondary"></div>
        <p>هنا قائمة بجميع الرحلات الموجودة حاليا</p>
        <a href='/' class='btn btn-dark btn-lg'>الرئيسية</a> 
    </div>
  </header>
  <section class='filter-container'>
    <div class='section-title'>
      <h1>البحث عن رحلة</h1>
      <div class="bg-secondary"></div>
    </div>
    <form class='filter-form direction-rtl'>
      <div class='form-group'>
        <label for='type' class="text-right">البداية</label>
        <select name='type' id='type' class='form-control direction-rtl'>
          <option value=''>الخرطوم</option>
          <option value=''>مدني</option>
          <option value=''>كسلا</option>
        </select>
      </div>
      <div class='form-group'>
        <label for='capacity' class="text-right">الوجهة</label>
        <select name='capacity' id='capacity' class='form-control direction-rtl'>
          <option value=''>الخرطوم</option>
          <option value=''>مدني</option>
          <option value=''>القضارف</option>
        </select>
      </div>
      <div class='form-group'>
        <label for='price' class="direction-rtl text-right">التذكرة 200</label>
        <input type='range' name='price' id='price' class='form-control direction-rtl' min='200' max='600'>
      </div>
      <div class='form-group'>
        <label for='capacity' class="text-right">شركة النقل</label>
        <select name='capacity' id='capacity' class='form-control direction-rtl'>
          <option value=''>الوهج للنقل</option>
          <option value=''>الصفصاف للنقل</option>
          <option value=''>الجقول للنقل</option>
        </select>
      </div>
      <div class='form-group'>
        <label for='price' class="direction-rtl text-right">زمن الانطلاق</label>
        <input type='time' name='price' id='price' class='form-control direction-rtl' min='200' max='600'>
      </div>
    </form>
  </section>
  <section class="roomslist">
    <div class="roomslist-center">
      <article class='room'>
				<div class='img-container'>
					<img src='{{asset("img/mainBcg.jpg")}}' alt='single room'>
					<div class='price-top'>
						<h5 class="direction-rtl">150 جنيه</h5>
						<h6>للراكب</h6>
					</div>
					<a href='#' class='btn-custom room-link'>
						حجز الرحلة
					</a>  
				</div>
				<h4 class='text-center room-info'>من الخرطوم الى الابيض</h4> 
      </article>
      <article class='room'>
				<div class='img-container'>
					<img src='{{asset("img/mainBcg.jpg")}}' alt='single room'>
					<div class='price-top'>
						<h5 class="direction-rtl">150 جنيه</h5>
						<h6>للراكب</h6>
					</div>
					<a href='#' class='btn-custom room-link'>
						حجز الرحلة
					</a>  
				</div>
				<h4 class='text-center room-info'>من الخرطوم الى كسلا</h4> 
      </article>
      <article class='room'>
				<div class='img-container'>
					<img src='{{asset("img/mainBcg.jpg")}}' alt='single room'>
					<div class='price-top'>
						<h5 class="direction-rtl">150 جنيه</h5>
						<h6>للراكب</h6>
					</div>
					<a href='#' class='btn-custom room-link'>
						حجز الرحلة
					</a>  
				</div>
				<h4 class='text-center room-info'>من الخرطوم الى رفاعة</h4> 
      </article>
      <article class='room'>
				<div class='img-container'>
					<img src='{{asset("img/mainBcg.jpg")}}' alt='single room'>
					<div class='price-top'>
						<h5 class="direction-rtl">150 جنيه</h5>
						<h6>للراكب</h6>
					</div>
					<a href='#' class='btn-custom room-link'>
						حجز الرحلة
					</a>  
				</div>
				<h4 class='text-center room-info'>من الخرطوم الى بارا</h4> 
      </article>
      <article class='room'>
				<div class='img-container'>
					<img src='{{asset("img/mainBcg.jpg")}}' alt='single room'>
					<div class='price-top'>
						<h5 class="direction-rtl">150 جنيه</h5>
						<h6>للراكب</h6>
					</div>
					<a href='#' class='btn-custom room-link'>
						حجز الرحلة
					</a>  
				</div>
				<h4 class='text-center room-info'>من الخرطوم الى مدني</h4> 
      </article>
      <article class='room'>
				<div class='img-container'>
					<img src='{{asset("img/mainBcg.jpg")}}' alt='single room'>
					<div class='price-top'>
						<h5 class="direction-rtl">150 جنيه</h5>
						<h6>للراكب</h6>
					</div>
					<a href='#' class='btn-custom room-link'>
						حجز الرحلة
					</a>  
				</div>
				<h4 class='text-center room-info'>من الخرطوم الى الرصيرص</h4> 
      </article>
      <article class='room'>
				<div class='img-container'>
					<img src='{{asset("img/mainBcg.jpg")}}' alt='single room'>
					<div class='price-top'>
						<h5 class="direction-rtl">150 جنيه</h5>
						<h6>للراكب</h6>
					</div>
					<a href='#' class='btn-custom room-link'>
						حجز الرحلة
					</a>  
				</div>
				<h4 class='text-center room-info'>من الخرطوم الى عطبرة</h4> 
      </article>
      <article class='room'>
				<div class='img-container'>
					<img src='{{asset("img/mainBcg.jpg")}}' alt='single room'>
					<div class='price-top'>
						<h5 class="direction-rtl">150 جنيه</h5>
						<h6>للراكب</h6>
					</div>
					<a href='#' class='btn-custom room-link'>
						حجز الرحلة
					</a>  
				</div>
				<h4 class='text-center room-info'>من الخرطوم الى بورتسودان</h4> 
      </article>
      <article class='room'>
				<div class='img-container'>
					<img src='{{asset("img/mainBcg.jpg")}}' alt='single room'>
					<div class='price-top'>
						<h5 class="direction-rtl">150 جنيه</h5>
						<h6>للراكب</h6>
					</div>
					<a href='#' class='btn-custom room-link'>
						حجز الرحلة
					</a>  
				</div>
				<h4 class='text-center room-info'>من الخرطوم الى نيالا</h4> 
			</article>
    </div>
  </section>
@endsection