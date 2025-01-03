@extends('userside.source.template')
@section('content')


<style>
    /* Carousel Styles */
    .carousel-item img {
        height: 300px;
        object-fit: cover;
    }

    .carousel-price {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #f15d30;
        color: #fff;
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 5px;
        font-weight: bold;
    }

    .carousel-wrapper {
        position: relative;
        overflow: hidden;
    }

    .testimony-section {
        margin-bottom: 80px; /* Add margin to the bottom of testimonial section */
    }

    /* Testimony Styles */
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

    /* Adventure Types Styles */
    .adventure-types {
        background: #fff;
        padding: 0 !important;
    }
    
    .adventure-image {
        height: 500px;
        background-size: cover;
        background-position: center;
    }
    
    .adventure-title {
        font-size: 2.5rem;
        font-weight: 700;
        letter-spacing: 2px;
    }
    
    .adventure-text {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #666;
    }
    
    .green-line, .blue-line, .orange-line, .purple-line {
        width: 100px;
        height: 3px;
    }
    
    .green-line { background: #7ab800; }
    .blue-line { background: #00a0dc; }
    .orange-line { background: #f15d30; }
    .purple-line { background: #9c27b0; }
    
    .explore-btn {
        padding: 12px 30px;
        border-width: 2px;
        font-weight: 600;
        letter-spacing: 1px;
        transition: all 0.3s;
    }
    
    .explore-btn:hover {
        background: #f15d30;
        border-color: #f15d30;
        color: white;
    }

    /* Adventure Banner and Tabs */
    .adventure-banner {
        position: relative;
        width: 100%;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    .adventure-banner img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        display: block;
        margin: 0;
        padding: 0;
    }

    .tab-navigation {
        display: flex;
        width: 100%;
        margin: 0;
        padding: 0;
    }

    .tab-item {
        flex: 1;
        text-align: center;
        padding: 20px;
        color: white;
        font-weight: bold;
        text-decoration: none;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        margin: 0;
        border: none;
    }

    .full-adventure { background-color: #95c11f; }
    .mini-adventure { background-color: #00bfd6; }
    .day-adventure { background-color: #ff6b4a; }
    .private-tour { background-color: #9c27b0; }

    .tab-item:hover {
        opacity: 0.9;
        color: white;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .adventure-image {
            height: 400px;
        }
        
        .adventure-title {
            font-size: 2rem;
        }

        .tab-item {
            padding: 15px 10px;
            font-size: 14px;
        }
    }

    .services {
        position: relative;
        height: 400px;
        margin: 15px 0;
        border-radius: 10px;
        overflow: hidden;
    }

    .services::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.7) 100%);
        z-index: 1;
    }

    .services .icon {
        position: relative;
        z-index: 2;
        width: 60px;
        height: 60px;
        background: #f15d30;
        border-radius: 50%;
        margin: 20px auto;
    }

    .services .media-body {
        position: relative;
        z-index: 2;
        padding: 30px;
        color: white;
        text-align: center;
    }

    .services .heading {
        font-size: 24px;
        font-weight: 700;
        color: white;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .services p {
        font-size: 16px;
        line-height: 1.6;
        color: white;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.6);
        margin-bottom: 0;
    }

    .services.color-1, .services.color-2, .services.color-4 {
        background-size: cover;
        background-position: center;
        transition: transform 0.3s ease;
    }

    .services:hover {
        transform: translateY(-5px);
    }

    @media (max-width: 768px) {
        .services {
            height: 350px;
        }
        
        .services .heading {
            font-size: 20px;
        }
        
        .services p {
            font-size: 14px;
        }
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

    <section class="ftco-section adventure-types">
        <div class="container-fluid p-0">
            <!-- Full Adventures -->
            <div class="row no-gutters align-items-center">
                <div class="col-md-6">
                    <div class="adventure-image" style="background-image: url('{{ asset('assets_userside/images/full-adventure.jpg') }}');"></div>
                </div>
                <div class="col-md-6 px-5 py-5">
                    <h2 class="adventure-title">FULL ADVENTURES</h2>
                    <div class="green-line mb-4"></div>
                    <p class="adventure-text">The full adventure vacation! These trips are the ultimate adventures designed to make the most of your approximately week-long vacation in Jordan. Hike our infamous Dana to Petra Trek on the Jordan Trail, go on a multi-sport adventure, summit Jordan's highest peak. On each tour you will visit the top sights and adventure along the way.</p>
                    <a href="{{ route('tours.category', 'Full Adventure') }}" class="btn btn-primary explore-btn">EXPLORE</a>
                </div>
            </div>
        
            <!-- Mini Adventures -->
            <div class="row no-gutters align-items-center flex-row-reverse">
                <div class="col-md-6">
                    <div class="adventure-image" style="background-image: url('{{ asset('assets_userside/images/mini-adventure.jpg') }}');"></div>
                </div>
                <div class="col-md-6 px-5 py-5">
                    <h2 class="adventure-title">MINI ADVENTURES</h2>
                    <div class="blue-line mb-4"></div>
                    <p class="adventure-text">Have us arrange the perfect mini adventure supplement that fits into the rest of your trip. We'll cover the difficult adventure logistics and you can plan the rest of your trip. Not a full tour and not just a day trip, this category is for something in-between - a couple days. Venture off-the-beaten-path, hike, cycle, and explore in the Petra & Wadi Rum Region.</p>
                    <a href="{{ route('tours.category', 'Mini Adventure') }}" class="btn btn-primary explore-btn">EXPLORE</a>
                </div>
            </div>
        
            <!-- Day Adventures -->
            <div class="row no-gutters align-items-center">
                <div class="col-md-6">
                    <div class="adventure-image" style="background-image: url('{{ asset('assets_userside/images/day-adventure.jpg') }}');"></div>
                </div>
                <div class="col-md-6 px-5 py-5">
                    <h2 class="adventure-title">DAY ADVENTURES</h2>
                    <div class="orange-line mb-4"></div>
                    <p class="adventure-text">Perfect for those with limited time or looking to add an adventure day to their Jordan itinerary. Experience hiking, canyoning, or rock climbing in some of Jordan's most spectacular locations, all in a single day.</p>
                    <a href="{{ route('tours.category', 'Day Adventure') }}" class="btn btn-primary explore-btn">EXPLORE</a>
                </div>
            </div>
        
            <!-- Private Tours -->
            <div class="row no-gutters align-items-center flex-row-reverse">
                <div class="col-md-6">
                    <div class="adventure-image" style="background-image: url('{{ asset('assets_userside/images/private-tour.jpg') }}');"></div>
                </div>
                <div class="col-md-6 px-5 py-5">
                    <h2 class="adventure-title">PRIVATE TOURS</h2>
                    <div class="purple-line mb-4"></div>
                    <p class="adventure-text">Create your perfect adventure with a private guide. Whether you're traveling with family, friends, or solo, we'll customize the experience to match your interests and pace. Enjoy the flexibility of a private tour with expert local knowledge.</p>
                    <a href="{{ route('tours.category', 'Private Tour') }}" class="btn btn-primary explore-btn">EXPLORE</a>
                </div>
            </div>
        </div>
        <div class="adventure-banner">
            <div class="tab-navigation">
                @foreach(App\Models\Category::all() as $category)
                    <a href="{{ route('tours.category', $category->name) }}" 
                       class="tab-item {{ strtolower(str_replace(' ', '-', $category->name)) }}">
                        {{ strtoupper($category->name) }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    
	<section class="ftco-section testimony-section bg-bottom" style="background-image: url({{ asset('assets_userside/images/testimonial.jpg') }});">
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
	