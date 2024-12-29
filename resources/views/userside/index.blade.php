@extends('userside.source.template')
@section('content')


<style>
    /* Ensure all images in the carousel have the same size */
    .carousel-item img {
        height: 300px; /* Set the desired fixed height */
        object-fit: cover; /* Ensures the image covers the area without distortion */
    }

    /* Price styling - similar to your original style */
    .carousel-price {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #f15d30; /* Customize color */
        color: #fff;
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 5px;
        font-weight: bold;
    }

    /* Carousel Wrapper Styling */
    .carousel-wrapper {
        position: relative;
        overflow: hidden;
    }

	<style>
    .testimony-wrap {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 10px;
        padding: 2rem !important;
        margin: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .testimony-wrap .name {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
    }
    
    .testimony-wrap .position {
        font-size: 0.9rem;
        color: #f15d30 !important;
    }
    
    .testimony-wrap .star {
        margin-bottom: 1rem;
    }
    
    .testimony-wrap .star .fa-star {
        color: #f15d30;
    }
    
    .testimony-wrap .text p {
        font-style: italic;
        line-height: 1.6;
    }
</style>
</style>
	<div class="hero-wrap js-fullheight">
		<div class="overlay">
			<div class="hero-video">
				<video autoplay muted playsinline loop src="{{asset('assets_userside/images/DISCOVER JORDAN - Cinematic 4K Travel Film 🇯🇴.mp4')}}">

				</video>
			</div>
		</div>
		<div class="container">
			<div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
				<div class="col-md-7 ftco-animate">
					<span class="subheading">Welcome to Jordan</span>
					<h1 class="mb-4">Your Gateway to Jordan’s Hidden Treasures</h1>
					<p class="caps">Experience the Magic of History, Culture, and Adventure</p>
					<div>
						<a href="{{route('tours.all-adventure')}}" class="btn btn-primary py-3 px-4">View Our Tour</a>
					</div>
				</div>

			</div>
		</div>
	</div>
	<section class="ftco-section services-section">
		<div class="container">
			<div class="row d-flex">
				<div class="col-md-12 order-md-first heading-section pl-md-5 ftco-animate d-flex align-items-center text-center">
					<div class="w-100">
						<span class="subheading">What We Do?</span>
						<h2 class="mb-4">It's time to start your adventure</h2>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12 col-lg-4 d-flex align-self-stretch ftco-animate">
							<div class="services services-1 color-1 d-block img"
							style="background-image: url('{{ asset('assets_userside/images/services-1.jpg') }}');">
								<div class="icon d-flex align-items-center justify-content-center"><span
										class="flaticon-paragliding"></span></div>
								<div class="media-body">
									<h3 class="heading mb-3">Group Adventures</h3>
									<p>Connect with fellow adventurous travelers on our planned hiking, cycling, and sightseeing tours.
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-lg-4 d-flex align-self-stretch ftco-animate">
							<div class="services services-1 color-2 d-block img"
							style="background-image: url('{{ asset('assets_userside/images/services-2.jpg') }}');">
								<div class="icon d-flex align-items-center justify-content-center"><span
										class="flaticon-route"></span></div>
								<div class="media-body">
									<h3 class="heading mb-3">Day, Mini, and Full Adventures</h3>
									<p>Adventure with us on a full tour, for a couple days, or for just a Day Adventure.
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-lg-4 d-flex align-self-stretch ftco-animate">
							<div class="services services-1 color-4 d-block img"
							style="background-image: url('{{ asset('assets_userside/images/services-3.jpg') }}');">
								<div class="icon d-flex align-items-center justify-content-center"><span
										class="flaticon-map"></span></div>
								<div class="media-body">
									<h3 class="heading mb-3">Exclusive Private Tours</h3>
									<p>Experience Jordan like never before with a fully private, customized adventure designed just for you.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center pb-4">
				<div class="col-md-12 heading-section text-center ftco-animate">
					<span class="subheading">Tours</span>
					<h2 class="mb-4">Our Most Popular Tours</h2>
				</div>
			</div>
			<div class="row">
				@foreach($popularTours as $tour)
					<div class="col-md-4 ftco-animate">
						<div class="project-wrap">
							<!-- Carousel Wrapper -->
							<div id="carousel{{ $tour->id }}" class="carousel slide carousel-wrapper" data-ride="carousel">
								<!-- Price Label -->
								
								
	
								<div class="carousel-inner">
									@foreach($tour->images as $key => $image)
										<div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
											<img src="{{ asset('storage/' . $image->file_name ?? 'default.jpg') }}" class="d-block w-100" alt="Tour Image">
											<span class="carousel-price">${{ $tour->price }}/person</span>
										</div>
									@endforeach
								</div>
	
								<!-- Carousel Controls -->
								<a class="carousel-control-prev" href="#carousel{{ $tour->id }}" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#carousel{{ $tour->id }}" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>
	
							<!-- Tour Details -->
							<div class="text p-4">
								<span class="days">{{ $tour->duration }} Days</span>
								<h3><a href="{{ route('tour.details', ['id' => $tour->id]) }}">{{ $tour->title }}</a></h3>
								<p class="location">
									<span class="fa fa-map-marker"></span> {{ $tour->category->name ?? 'Uncategorized' }}
								</p>
								<a href="{{ route('tour.details', ['id' => $tour->id]) }}" class="btn btn-primary">View Tour</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
	<section class="ftco-section testimony-section bg-bottom" style="background-image: url({{ asset('assets_userside/images/mini-advanture.jpg') }});">
		<div class="overlay"></div>
		<div class="container">
			<div class="row justify-content-center pb-4">
				<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
					<span class="subheading">Testimonial</span>
					<h2 class="mb-4">Tourist Feedback</h2>
				</div>
			</div>
			<div class="row ftco-animate">
				<div class="col-md-12">
					<div class="carousel-testimony owl-carousel">
						@foreach($testimonials as $testimonial)
							<div class="item">
								<div class="testimony-wrap py-4">
									<div class="text">
										<p class="star">
											@for($i = 1; $i <= 5; $i++)
												<span class="fa fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-secondary' }}"></span>
											@endfor
										</p>
										<p class="mb-4">{{ $testimonial->comment }}</p>
										<div class="d-flex align-items-center">
											<div class="pl-3">
												<p class="name mb-0">{{ $testimonial->user->name }}</p>
												<span class="position text-muted">{{ $testimonial->tour->title }}</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
	@endsection
	