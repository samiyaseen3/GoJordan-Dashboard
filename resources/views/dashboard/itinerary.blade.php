@extends('source.template')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Itinerary for {{ $tour->title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tour.index') }}">Tours</a></li>
                <li class="breadcrumb-item active">Itinerary</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Discription Tour : {{ Str::limit($tour->description, 50) }}</h5>
                        <!-- Table with itinerary details -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Location</th>
                                    <th>Activity</th>
                                    <th>Meal Plan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($itineraries as $itinerary)
                                <tr>
                                    <td>{{ $itinerary->day_number }}</td>
                                    <td>{{ $itinerary->location }}</td>
                                    <td>{{ $itinerary->activity }}</td>
                                    <td>{{ $itinerary->meal_plan ?? 'N/A' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Itinerary Table -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
