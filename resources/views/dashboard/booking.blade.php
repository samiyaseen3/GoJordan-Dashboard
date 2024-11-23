@extends('source.template')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Bookings</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('booking.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Bookings</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Booking Table</h5>
                        <table class="table datatable mt-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Tour</th>
                                    <th>Booking Date</th>
                                    <th>Number of Guests</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->id }}</td>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>{{ $booking->tour ? $booking->tour->title : 'N/A' }}</td>
                                        <td>{{ $booking->booking_date }}</td>
                                        <td>{{ $booking->number_of_guests }}</td>
                                        <td>${{ $booking->tour ? $booking->tour->price * $booking->number_of_guests : '0.00' }}</td>
                                        <td>
                                            <!-- Editable Status -->
                                            <select class="form-select form-select-sm update-status" data-id="{{ $booking->id }}">
                                                <option value="Pending" {{ $booking->booking_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Confirmed" {{ $booking->booking_status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="Cancelled" {{ $booking->booking_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                <option value="Completed" {{ $booking->booking_status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
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

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.querySelectorAll('.update-status').forEach(select => {
        select.addEventListener('change', function () {
            const bookingId = this.getAttribute('data-id');
            const newStatus = this.value;

            // Send the AJAX request
            axios.patch(`/booking/${bookingId}/status`, {
                status: newStatus,
                _token: '{{ csrf_token() }}',
            })
            .then(response => {
                if (response.data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.data.message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false,
                    });
                }
            })
            .catch(error => {
                console.error(error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Unable to update status. Please try again later.',
                    icon: 'error',
                });
            });
        });
    });
</script>


</script>

@endsection
