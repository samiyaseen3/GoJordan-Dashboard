@extends('source.template')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tour Dates</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Tour Dates</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tour Dates Table</h5>
                        <a href="{{ route('tour_dates.create') }}" class="btn" style="color: #fff; background:#d97706">Add New Tour Date</a>
                        <table class="table datatable mt-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tour Title</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Availability</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tourDates as $tourDate)
                                    <tr>
                                        <td>{{ $tourDate->id }}</td>
                                        <td>{{ $tourDate->tour->title }}</td>
                                        <td>{{ $tourDate->start_date }}</td>
                                        <td>{{ $tourDate->end_date }}</td>
                                        <td>{{ $tourDate->availability }}</td>
                                        <td>
                                            <!-- Edit -->
                                            <a href="{{ route('tour_dates.edit', $tourDate->id) }}" class="btn btn-sm" style="color: #fff; background:#d97706">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <!-- Delete -->
                                            <form id="deleteForm-{{ $tourDate->id }}" action="{{ route('tour_dates.destroy', $tourDate->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $tourDate->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(tourDateId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`deleteForm-${tourDateId}`).submit();
            }
        });
    }
</script>
@endsection
