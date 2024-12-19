@extends('userside.source.template')

@section('content')

<body style="background:#f8f8f8">
<!-- Hero Section -->
<section class="hero-wrap hero-wrap-2 js-fullheight bg-cover bg-center bg-fixed" 
    style="
        background-image: url('{{ asset('assets_userside/images/Advanture.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        width: 100%;
    ">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
         <p class="breadcrumbs">
             <span class="mr-2"><a href="{{route('userside.index')}}">Home <i class="fa fa-chevron-right"></i></a></span> 
             <span>All Tours <i class="fa fa-chevron-right"></i></span>
         </p>
         <h1 class="mb-0 bread">All Tours</h1>
     </div>
   </div>
  </div>
</section>

<!-- Navigation Tabs -->
<section class="tour-nav sticky-nav">
    <div class="container">
        <ul class="nav nav-tabs border-0 justify-content-between">
            <li class="nav-item">
                <a class="nav-link active" href="#summary-section">SUMMARY</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#itinerary-section">ITINERARY</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#booking-section">BOOK NOW</a>
            </li>
        </ul>
    </div>
</section>

<!-- Main Content Section -->
<section class="ftco-section" id="main-content">
    <div class="container">
        <div class="row">
            <!-- Left Column - Content -->
            <div class="col-lg-8">
                <!-- Carousel Section -->
                <div class="mb-4">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('assets_userside/images/bg_1.jpg') }}" alt="First Slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('assets_userside/images/bg_2.jpg') }}" alt="Second Slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('assets_userside/images/bg_3.jpg') }}" alt="Third Slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

                <!-- Content Sections -->
                <div class="bg-white shadow-sm p-4 mb-4">
                    <!-- Summary Section -->
                    <div id="summary-section" class="mb-5">
                        <h2 class="mb-4">Summary</h2>
                        <p>Experience Jordan's most beautiful sights and places – all with a sense of adventure!</p>
                        <p>Combine two days in Petra, two days in Wadi Rum, and two days cycling the Jordan Bike Trail for an unforgettable multi-sport adventure!</p>
                    </div>

                    <!-- Itinerary Section -->
                    <div id="itinerary-section">
                        <h2 class="mb-4">Itinerary</h2>
                        <div class="itinerary-list">
                            <div class="itinerary-day mb-4">
                                <h4>
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#day1" aria-expanded="false" aria-controls="day1">+</button>
                                    <strong>Day 1: Arrival in Amman</strong>
                                </h4>
                                <div id="day1" class="collapse">
                                    <p>Arrive in Amman and transfer to your hotel.</p>
                                </div>
                            </div>

                            <div class="itinerary-day mb-4">
                                <h4>
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#day2" aria-expanded="false" aria-controls="day2">+</button>
                                    <strong>Day 2: Petra Back Way</strong>
                                </h4>
                                <div id="day2" class="collapse">
                                    <p>Explore the ancient city of Petra using the less crowded "Back Way" entrance.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Booking Card -->
            <div class="col-lg-4">
                <div id="booking-section" class="card shadow-sm sticky-booking">
                    <div class="card-body text-center">
                        <h3 class="card-title font-weight-bold">JORDAN ACTIVE ADVENTURE (HIKE & BIKE)</h3>
                        <p class="card-text"><strong>DAYS:</strong> 8</p>
                        <p class="card-text"><strong>PRICE (USD):</strong> $1,495</p>
                        <a href="#" class="btn btn-primary btn-block">BOOK A PRIVATE TOUR</a>
                        <p class="card-text mt-3 mb-1">Have a question?</p>
                        <a href="#" class="btn btn-secondary btn-block">CONTACT US</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.sticky-nav {
    position: sticky;
    top: 70px;
    z-index: 1020;
    background: #000;
    padding: 0;
}

.sticky-booking {
    position: sticky;
    top: 80px; /* Adjust based on your nav height + desired spacing */
}

.tour-nav .nav-link {
    color: #fff;
    padding: 1rem 2rem;
    border: none;
    border-radius: 0;
    transition: background-color 0.3s ease;
}

.tour-nav .nav-link:hover {
    background: rgba(255,255,255,0.1);
}

.tour-nav .nav-link.active {
    background: rgba(255,255,255,0.2);
    color: #fff;
}

/* Add smooth scrolling to the whole page */
html {
    scroll-behavior: smooth;
}

/* Offset for sticky header */
#summary-section,
#itinerary-section,
#booking-section {
    scroll-margin-top: 80px;
}

/* Active state for nav links based on scroll position */
.nav-link.active {
    background: rgba(255,255,255,0.2) !important;
}

/* Content styling */
.bg-white {
    border-radius: 8px;
}

.itinerary-day h4 {
    display: flex;
    align-items: center;
}

.itinerary-day .btn-link {
    padding: 0 10px;
    margin-right: 10px;
    text-decoration: none;
    color: #000;
}

/* Improve spacing for mobile */
@media (max-width: 991px) {
    .sticky-booking {
        position: static;
        margin-top: 2rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Collapsible sections
    var toggles = document.querySelectorAll('button[data-toggle="collapse"]');
    toggles.forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            var target = document.querySelector(this.dataset.target);
            if (target.classList.contains('show')) {
                target.classList.remove('show');
                this.innerHTML = '+';
            } else {
                target.classList.add('show');
                this.innerHTML = '−';
            }
        });
    });

    // Smooth scrolling with active state management
    const navLinks = document.querySelectorAll('.tour-nav .nav-link');
    const sections = document.querySelectorAll('section[id], div[id]');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            // Remove active class from all links
            navLinks.forEach(link => link.classList.remove('active'));
            
            // Add active class to clicked link
            this.classList.add('active');
            
            // Smooth scroll to target
            targetSection.scrollIntoView({ behavior: 'smooth' });
        });
    });

    // Update active state on scroll
    window.addEventListener('scroll', () => {
        let current = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= (sectionTop - 100)) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });
});
</script>

</body>
@endsection