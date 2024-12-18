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
 
	<section class="ftco-section ftco-no-pb ftco-no-pt">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="ftco-search d-flex justify-content-center">
						<div class="row">
							<div class="col-md-12 nav-link-wrap">
								<div class="nav nav-pills text-center" id="v-pills-tab" role="tablist"
									aria-orientation="vertical">
									<a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill"
										href="#v-pills-1" role="tab" aria-controls="v-pills-1"
										aria-selected="true">Search Tour</a>

									

								</div>
							</div>
							<div class="col-md-12 tab-wrap">

								<div class="tab-content" id="v-pills-tabContent">

									<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
										aria-labelledby="v-pills-nextgen-tab">
										<form action="#" class="search-property-1">
											<div class="row no-gutters">
												<div class="col-md d-flex">
													<div class="form-group p-4 border-0">
														<label for="#">Destination</label>
														<div class="form-field">
															<div class="icon"><span class="fa fa-search"></span></div>
															<input type="text" class="form-control"
																placeholder="Search place">
														</div>
													</div>
												</div>
												<div class="col-md d-flex">
													<div class="form-group p-4">
														<label for="#">Check-in date</label>
														<div class="form-field">
															<div class="icon"><span class="fa fa-calendar"></span></div>
															<input type="text" class="form-control checkin_date"
																placeholder="Check In Date">
														</div>
													</div>
												</div>
												<div class="col-md d-flex">
													<div class="form-group p-4">
														<label for="#">Check-out date</label>
														<div class="form-field">
															<div class="icon"><span class="fa fa-calendar"></span></div>
															<input type="text" class="form-control checkout_date"
																placeholder="Check Out Date">
														</div>
													</div>
												</div>
												<div class="col-md d-flex">
													<div class="form-group p-4">
														<label for="#">Price Limit</label>
														<div class="form-field">
															<div class="select-wrap">
																<div class="icon"><span
																		class="fa fa-chevron-down"></span></div>
																<select name="" id="" class="form-control">
																	<option value="">$100</option>
																	<option value="">$10,000</option>
																	<option value="">$50,000</option>
																	<option value="">$100,000</option>
																	<option value="">$200,000</option>
																	<option value="">$300,000</option>
																	<option value="">$400,000</option>
																	<option value="">$500,000</option>
																	<option value="">$600,000</option>
																	<option value="">$700,000</option>
																	<option value="">$800,000</option>
																	<option value="">$900,000</option>
																	<option value="">$1,000,000</option>
																	<option value="">$2,000,000</option>
																</select>
															</div>
														</div>
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
	</section>

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
								<h3><a href="#">{{ $tour->title }}</a></h3>
								<p class="location">
									<span class="fa fa-map-marker"></span> {{ $tour->category->name ?? 'Uncategorized' }}
								</p>
								<a href="" class="btn btn-primary">View Tour</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
	

	

	

	<section class="ftco-section testimony-section bg-bottom" style="background-image: url(images/bg_1.jpg);">
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
						<div class="item">
							<div class="testimony-wrap py-4">
								<div class="text">
									<p class="star">
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
									</p>
									<p class="mb-4">Far far away, behind the word mountains, far from the countries
										Vokalia and Consonantia, there live the blind texts.</p>
									<div class="d-flex align-items-center">
										<div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
										<div class="pl-3">
											<p class="name">Roger Scott</p>
											<span class="position">Marketing Manager</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="testimony-wrap py-4">
								<div class="text">
									<p class="star">
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
									</p>
									<p class="mb-4">Far far away, behind the word mountains, far from the countries
										Vokalia and Consonantia, there live the blind texts.</p>
									<div class="d-flex align-items-center">
										<div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
										<div class="pl-3">
											<p class="name">Roger Scott</p>
											<span class="position">Marketing Manager</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="testimony-wrap py-4">
								<div class="text">
									<p class="star">
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
									</p>
									<p class="mb-4">Far far away, behind the word mountains, far from the countries
										Vokalia and Consonantia, there live the blind texts.</p>
									<div class="d-flex align-items-center">
										<div class="user-img" style="background-image: url(images/person_3.jpg)"></div>
										<div class="pl-3">
											<p class="name">Roger Scott</p>
											<span class="position">Marketing Manager</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="testimony-wrap py-4">
								<div class="text">
									<p class="star">
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
									</p>
									<p class="mb-4">Far far away, behind the word mountains, far from the countries
										Vokalia and Consonantia, there live the blind texts.</p>
									<div class="d-flex align-items-center">
										<div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
										<div class="pl-3">
											<p class="name">Roger Scott</p>
											<span class="position">Marketing Manager</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="testimony-wrap py-4">
								<div class="text">
									<p class="star">
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
									</p>
									<p class="mb-4">Far far away, behind the word mountains, far from the countries
										Vokalia and Consonantia, there live the blind texts.</p>
									<div class="d-flex align-items-center">
										<div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
										<div class="pl-3">
											<p class="name">Roger Scott</p>
											<span class="position">Marketing Manager</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	

	<section class="ftco-intro ftco-section ftco-no-pt">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 text-center">
					<div class="img" style="background-image: url('{{ asset('assets_userside/images/bg_2.jpg') }}');">
						<div class="overlay"></div>
						<h2>We Are Pacific A Travel Agency</h2>
						<p>We can manage your dream building A small river named Duden flows by their place</p>
						<p class="mb-0"><a href="#" class="btn btn-primary px-4 py-3">Ask For A Quote</a></p>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endsection
	