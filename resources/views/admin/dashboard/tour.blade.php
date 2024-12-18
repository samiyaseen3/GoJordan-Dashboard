@extends('source.template')
@section('content')
<style>
    .carousel-inner img {
        width: 80px;
        /* Set a consistent width for the images */
        height: 80px;
        /* Set a consistent height for the images */
        border-radius: 10%;
        /* Add rounded corners */
        object-fit: cover;
        /* Ensure the image covers the entire area without distortion */
        margin: auto;
        /* Center the image horizontally */
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tours</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('tour.index')}}">Home</a></li>
                <li class="breadcrumb-item active">Tours</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tour Table</h5>
                        <a id="addUserBtn" href="{{route('tour.create')}}" class="btn" style="color: #fff;background:#d97706">Add new tour</a>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Days</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Images</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tours as $tour)
                                <tr>
                                    <td>{{ $tour->title }}</td>
                                    <td>{{$tour->category->name}}</td>
                                    <td>{{ $tour->price }}</td>
                                    <td>{{ $tour->duration }}</td>
                                    <td>{{ $tour->start_date }}</td>
                                    <td>{{ $tour->end_date }}</td>
                                    <td>
                                        <!-- Image Slider -->
                                        <div id="carousel-{{ $tour->id }}" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach($tour->images as $key => $image)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $image->file_name) }}"
                                                        alt="Tour Image" class="carousel-image">
                                                </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carousel-{{ $tour->id }}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carousel-{{ $tour->id }}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center mt-4">


                                            @if ($tour->trashed())
                                            <!-- Restore form -->
                                            <form id="restoreForm-{{ $tour->id }}"
                                                action="{{ route('tour.restore', $tour->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                            <button type="button" class="btn btn-warning btn-sm shadow-sm"
                                                onclick="confirmRestore({{ $tour->id }} , this)">
                                                <i class="bi bi-arrow-counterclockwise"></i> Restore
                                            </button>
                                            @else
                                            <a href="{{ route('tour.itinerary', ['tour' => $tour->id]) }}"
                                                class="btn btn-sm" style="color: #fff;background:#d97706">
                                                Itinerary
                                            </a>

                                            <!-- If the tour is not deleted, show the edit and delete buttons -->
                                            <a href="{{ route('tour.edit', $tour->id) }}"
                                                class="btn btn-sm" style="color: #fff;background:#d97706">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <!-- Delete form -->
                                            <form id="deleteForm-{{ $tour->id }}"
                                                action="{{ route('tour.destroy', $tour->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $tour->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            @endif

                                        </div>

                                    </td>
                                </tr>


                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(tourId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the delete form
                document.getElementById(`deleteForm-${tourId}`).submit();
            }
        });
    }

    function confirmRestore(tourId, button) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to restore this tour?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Disable the button and show restoring text
                button.disabled = true;
                button.textContent = 'Restoring...';
                // Submit the restore form
                document.getElementById(`restoreForm-${tourId}`).submit();
            }
        });
    }
</script>

@endsection