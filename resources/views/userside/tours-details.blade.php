@extends('userside.source.template')

@section('content')

<body style="background:#f8f8f8">
    <!-- Hero Section -->
    <section class="hero-wrap hero-wrap-2 js-fullheight bg-cover bg-center bg-fixed" style="
        background-image: url('{{ asset('storage/' . ($tour->images->first()->file_name ?? 'default.jpg')) }}');
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
                    <h1 class="mb-0 bread">{{ $tour->title }}</h1>
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
                            <div class="carousel-inner">
                                @foreach($tour->images as $key => $image)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img class="d-block w-100" src="{{ asset('storage/' . $image->file_name) }}"
                                        alt="Tour Image">
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
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
                            <p>{{ $tour->description }}</p>
                        </div>

                        <!-- Itinerary Section -->
                        <!-- Itinerary Section -->
                        <div id="itinerary-section">
                            <h2 class="mb-4">Itinerary</h2>
                            <div class="itinerary-list">
                                @foreach($tour->itineraries as $day => $detail)
                                    <div class="itinerary-day">
                                        <div class="day-header">
                                            <h3 class="mb-0 text-white">
                                                Day {{ $day + 1 }}: {{ $detail->title }}
                                                <span class="toggle-icon">+</span>
                                            </h3>
                                        </div>
                                        <div class="day-content">
                                            <p><span style="font-weight: bold">Location</span>: {{ $detail->location }}</p>
                                            <p><span style="font-weight: bold">Activity</span>: {{ $detail->activity }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Booking Card -->
                <div class="col-lg-4">
                    <div id="booking-section" class="card shadow-sm sticky-booking">
                        <div id="booking-section" class="card shadow-sm sticky-booking">
                            <div class="card-body text-center">
                                <h3 class="card-title font-weight-bold">{{ $tour->title }}</h3>
                                <p class="card-text"><strong>DAYS:</strong> {{ $tour->duration }}</p>
                                <p class="card-text"><strong>PRICE (USD):</strong> ${{ $tour->price }}</p>
                                <a href="#" class="btn btn-primary btn-block">BOOK NOW!</a>
                                <p class="card-text mt-3 mb-1">Have a question?</p>
                                <a href="#" class="btn btn-secondary btn-block">CONTACT US</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .carousel-item img {
            height: 500px;
            /* Set the desired fixed height */
            object-fit: cover;
            /* Ensures the image covers the area without distortion */
        }

        /* Price styling - similar to your original style */
        .carousel-price {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #f15d30;
            /* Customize color */
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

        .sticky-nav {
            position: sticky;
            top: 70px;
            z-index: 2;
            background: #000;
            padding: 0;
        }

        .sticky-booking {
            position: sticky;
            top: 150px;
            /* Adjust based on your nav height + desired spacing */
        }

        .tour-nav .nav-link {
            color: #fff;
            padding: 1rem 2rem;
            border: none;
            border-radius: 0;
            transition: background-color 0.3s ease;
        }

        .tour-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .tour-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
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
            background: rgba(255, 255, 255, 0.2) !important;
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


        .tour-day-item {
    margin-bottom: 2px;
}

.itinerary-day {
    margin-bottom: 2px;
}

.day-header {
    background-color: #f15d30;
    padding: 15px 20px;
    cursor: pointer;
    position: relative;
}

.day-header h3 {
    font-size: 18px;
    margin: 0;
    padding-right: 30px;
}

.toggle-icon {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 20px;
    font-weight: bold;
}

.day-content {
    background: #f9f9f9;
    border: 1px solid #eee;
    max-height: 0;
    overflow: hidden;
    transition: all 0.3s ease-out;
    padding: 0;
    opacity: 0;
}

.day-content.active {
    max-height: 500px;
    padding: 20px;
    opacity: 1;
    transition: all 0.3s ease-in;
}

        /* Improve spacing for mobile */
        @media (max-width: 991px) {
            .sticky-booking {
                position: static;
                margin-top: 2rem;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       $(document).ready(function() {
    // Hide all content initially
    $('.day-content').removeClass('active');
    
    // Handle click on day headers
    $('.day-header').click(function() {
        const content = $(this).next('.day-content');
        const icon = $(this).find('.toggle-icon');
        
        // Toggle the clicked content
        content.toggleClass('active');
        
        // Update the icon
        if (content.hasClass('active')) {
            icon.text('−');
        } else {
            icon.text('+');
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

    </script>

</body>
@endsection