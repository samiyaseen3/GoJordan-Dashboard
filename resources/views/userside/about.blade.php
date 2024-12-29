@extends('userside.source.template')
@section('content')
	
<style>
  .hero-wrap {
    background-size: cover;
    background-position: center center;
    background-attachment: fixed;
}
@media (max-width: 768px) {
    .hero-wrap {
        background-size: contain;
        background-position: center;
    }
}
.hero-wrap {
    width: 100%;
    height: 100vh;
}

.ftco-about .img {
    margin-top: -40px}
</style>

<section class="hero-wrap hero-wrap-2 js-fullheight bg-cover bg-center bg-fixed" style="background-image: url('{{ asset('assets_userside/images/about-us.jpg') }}');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
       <p class="breadcrumbs"><span class="mr-2"><a href="{{route('userside.index')}}">Home <i class="fa fa-chevron-right"></i></a></span> <span>About us <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Discover Jordan With Us</h1>
     </div>
   </div>
 </div>
</section>

<section class="ftco-section services-section">
  <div class="container">
    <div class="row d-flex">
      <div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate d-flex align-items-center">
       <div class="w-100">
        <span class="subheading">Welcome to Your Jordan Adventure</span>
        <h2 class="mb-4">Experience the Wonders of Jordan</h2>
        <p>Embark on an unforgettable journey through Jordan's rich tapestry of history, culture, and natural beauty. From the ancient rose-red city of Petra to the serene depths of Wadi Rum, we craft experiences that bring Jordan's treasures to life.</p>
        <p>Our expert guides and carefully curated itineraries ensure you experience the best of Jordan, whether you're seeking full adventures, mini expeditions, day trips, or private tours. We combine cultural immersion, historical exploration, and outdoor activities to create truly memorable experiences.</p>
        <p><a href="{{route('tours.all-adventure')}}" class="btn btn-primary py-3 px-4">Explore Our Tours</a></p>
      </div>
    </div>
    <div class="col-md-6">
     <div class="row">
      <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
        <div class="services services-1 color-1 d-block img" style="background-image: url('{{ asset('assets_userside/images/services-1.jpg') }}');">
          <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-paragliding"></span></div>
          <div class="media-body">
            <h3 class="heading mb-3">Full Adventures</h3>
            <p>Comprehensive multi-day tours exploring Jordan's major attractions and hidden gems</p>
          </div>
        </div>      
      </div>
      <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
        <div class="services services-1 color-2 d-block img" style="background-image: url('{{ asset('assets_userside/images/services-2.jpg') }}');">
          <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
          <div class="media-body">
            <h3 class="heading mb-3">Mini Adventures</h3>
            <p>Compact 2-5 day experiences perfect for weekend explorers and short visits</p>
          </div>
        </div>    
      </div>
      <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
        <div class="services services-1 color-3 d-block img" style="background-image: url('{{ asset('assets_userside/images/services-3.jpg') }}');">
          <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-tour-guide"></span></div>
          <div class="media-body">
            <h3 class="heading mb-3">Day Adventures</h3>
            <p>Single-day excursions to key attractions, perfect for busy travelers</p>
          </div>
        </div>      
      </div>
      <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
        <div class="services services-1 color-4 d-block img" style="background-image: url('{{ asset('assets_userside/images/services-4.jpg') }}');">
          <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-map"></span></div>
          <div class="media-body">
            <h3 class="heading mb-3">Private Tours</h3>
            <p>Customized itineraries tailored to your preferences and schedule</p>
          </div>
        </div>      
      </div>
    </div>
  </div>
</div>
</div>
</section>

<section class="ftco-section ftco-about ftco-no-pt img">
 <div class="container">
  <div class="row d-flex">
   <div class="col-md-12 about-intro">
    <div class="row">
     <div class="col-md-6 d-flex align-items-stretch">
      <div class="img d-flex w-100 align-items-center justify-content-center" style="background-image: url('{{ asset('assets_userside/images/destination-2.jpg') }}');">
      </div>
    </div>
    <div class="col-md-6 pl-md-5 py-5">
      <div class="row justify-content-start pb-3">
        <div class="col-md-12 heading-section ftco-animate">
         <span class="subheading">Why Choose Us</span>
         <h2 class="mb-4">Your Gateway to Authentic Jordan</h2>
         <p>With deep local knowledge and a passion for sharing Jordan's wonders, we create immersive experiences that go beyond typical tourism. Our expert guides, detailed day-by-day itineraries, and commitment to responsible travel ensure you'll discover the true essence of Jordan safely and memorably.</p>
         <p><a href="{{route('tours.all-adventure')}}" class="btn btn-primary">Book Your Journey</a></p>
       </div>
     </div>
   </div>
 </div>
</div>
</div>
</div>
</section>
@endsection