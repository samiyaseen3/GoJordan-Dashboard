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

<section class="hero-wrap hero-wrap-2 js-fullheight bg-cover bg-center bg-fixed" 
    style="
        background-image: url('{{ asset('assets_userside/images/Advanture.jpg') }}');
        background-size: cover; /* Stretch image to fill entire container */
        background-position: center; /* Center the image */
        background-repeat: no-repeat; /* Avoid image repetition */
        height: 100vh; /* Full viewport height */
        width: 100%; /* Ensure it spans full width */
    ">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
         <p class="breadcrumbs">
             <span class="mr-2"><a href="{{route('userside.index')}}">Home <i class="fa fa-chevron-right"></i></a></span> 
             <span>Mini-Adventure <i class="fa fa-chevron-right"></i></span>
         </p>
         <h1 class="mb-0 bread">Mini-Adventure</h1>
     </div>
   </div>
  </div>
</section>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Tours</span>
                <h2 class="mb-4">Our Mini Jordan Adventures</h2>
            </div>
        </div>

        <!-- Tour Listing -->
        <div class="row" id="tour-list">
            @foreach($tours as $tour)
                <div class="col-md-4 ftco-animate tour-card">
                    <div class="project-wrap">
                        <div id="carousel{{ $tour->id }}" class="carousel slide carousel-wrapper" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($tour->images as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . ($image->file_name ?? 'default.jpg')) }}" class="d-block w-100" alt="Tour Image">
                                        <span class="carousel-price">${{ $tour->price }}/person</span>
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carousel{{ $tour->id }}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel{{ $tour->id }}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                        <div class="text p-4">
                            <span class="days">{{ $tour->duration }} Days</span>
                            <h3><a href="{{ route('tour.details', ['id' => $tour->id]) }}">{{ $tour->title }}</a></h3>
                            <p class="location"><span class="fa fa-map-marker"></span> {{ $tour->category->name ?? 'Uncategorized' }}</p>
                            <a href="{{ route('tour.details', ['id' => $tour->id]) }}" class="btn btn-primary">View Tour</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                {{ $tours->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</section>







<section class="ftco-intro ftco-section ftco-no-pt">
 <div class="container">
    <div class="row justify-content-center">
       <div class="col-md-12 text-center">
          <div class="img"  style="background-image: url(images/bg_2.jpg);">
             <div class="overlay"></div>
             <h2>We Are Pacific A Travel Agency</h2>
             <p>We can manage your dream building A small river named Duden flows by their place</p>
             <p class="mb-0"><a href="#" class="btn btn-primary px-4 py-3">Ask For A Quote</a></p>
         </div>
     </div>
 </div>
</div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('load-more-btn');
    const tourList = document.getElementById('tour-list');
    let currentPage = 1;
    let isLoading = false;

    if (loadMoreBtn) {
        console.log('Load More Button Found'); // Debugging log

        loadMoreBtn.addEventListener('click', function() {
            console.log('Load More Button Clicked'); // Debugging log
            console.log('Current Page:', currentPage); // Debugging log

            if (isLoading) {
                console.log('Already loading, returning'); // Debugging log
                return;
            }
            
            isLoading = true;
            currentPage++;
            
            console.log('Fetching tours for page:', currentPage); // Debugging log

            fetch(`{{ route('tours.full-adventure') }}?page=${currentPage}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log('Response received'); // Debugging log
                return response.json();
            })
            .then(data => {
                console.log('Data received:', data); // Debugging log

                if (data.tours) {
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = data.tours;
                    
                    Array.from(tempDiv.children).forEach(child => {
                        tourList.appendChild(child);
                    });

                    // Hide load more button if no more tours
                    if (!data.has_more) {
                        loadMoreBtn.style.display = 'none';
                    }
                }
                isLoading = false;
            })
            .catch(error => {
                console.error('Error:', error);
                isLoading = false;
            });
        });
    } else {
        console.log('Load More Button Not Found'); // Debugging log
    }
});
</script>
@endpush


@endsection

