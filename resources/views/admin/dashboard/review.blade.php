@extends('source.template')

@section('content')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
    .view-comment {
        text-decoration: none !important;
        color: #333 !important;
        padding: 0;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .view-comment:hover {
        color: #666 !important;
    }

    .view-comment i {
        font-size: 1.2rem;
        color: #4154f1;
    }

    .date-column {
        font-weight: 500;
        color: #444;
    }

    .status-badge {
        padding: 0.35rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        white-space: nowrap;
    }

    .status-pending {
        background-color: #fff4e5;
        color: #ffa000;
    }

    .status-approved {
        background-color: #e8f5e9;
        color: #2e7d32;
    }

    .action-icons {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
    }
</style>
<main id="main" class="main">
    <!-- ... (previous header content remains the same) ... -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Review Management</h5>
                        <table class="table datatable mt-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Tour</th>
                                    <th>Rating</th>
                                    <th>Comment</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $review->id }}</td>
                                        <td>{{ $review->user->name }}</td>
                                        <td>{{ $review->tour ? $review->tour->title : 'N/A' }}</td>
                                        <td>
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star-fill" style="color: {{ $i <= $review->rating ? '#ffd700' : '#e4e5e9' }}"></i>
                                            @endfor
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-link view-comment" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#commentModal" 
                                                    data-comment="{{ $review->comment }}"
                                                    data-tour="{{ $review->tour ? $review->tour->title : 'N/A' }}"
                                                    data-user="{{ $review->user->name }}">
                                                <i class="bi bi-eye-fill"></i>
                                                View Comment
                                            </button>
                                        </td>
                                        <td class="date-column">
                                            {{ $review->created_at->format('M d, Y') }}
                                        </td>
                                        <td>
                                            <span class="status-badge {{ $review->is_approved ? 'status-approved' : 'status-pending' }}"
                                                  id="status-badge-{{ $review->id }}">
                                                {{ $review->is_approved ? 'Approved' : 'Pending' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-icons">
                                                <select class="form-select form-select-sm update-status" 
                                                        style="width: auto;" 
                                                        data-id="{{ $review->id }}">
                                                    <option value="0" {{ !$review->is_approved ? 'selected' : '' }}>Pending</option>
                                                    <option value="1" {{ $review->is_approved ? 'selected' : '' }}>Approved</option>
                                                </select>
                                                <button type="button" class="btn btn-danger btn-sm action-btn delete-review" 
                                                        data-id="{{ $review->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
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

    <!-- Comment Modal -->
    <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentModalLabel">Review Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Tour:</strong> <span id="modalTour"></span></p>
                    <p><strong>User:</strong> <span id="modalUser"></span></p>
                    <p><strong>Comment:</strong></p>
                    <p id="modalComment"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Status update handler
    document.addEventListener('change', function (event) {
        if (event.target.classList.contains('update-status')) {
            const reviewId = event.target.getAttribute('data-id');
            const newStatus = event.target.value;
            const statusBadge = document.getElementById(`status-badge-${reviewId}`);

            axios.patch(`/review/${reviewId}/status`, {
                status: newStatus,
                _token: '{{ csrf_token() }}',
            })
            .then(response => {
                if (response.data.success) {
                    // Update the badge class and text
                    statusBadge.className = `status-badge ${newStatus === '1' ? 'status-approved' : 'status-pending'}`;
                    statusBadge.textContent = newStatus === '1' ? 'Approved' : 'Pending';

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
                // Revert the select value on error
                event.target.value = newStatus === '1' ? '0' : '1';
                
                Swal.fire({
                    title: 'Error!',
                    text: 'Unable to update status. Please try again later.',
                    icon: 'error',
                });
            });
        }
    });

    // Delete review handler
    document.querySelectorAll('.delete-review').forEach(button => {
        button.addEventListener('click', function() {
            const reviewId = this.getAttribute('data-id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/review/${reviewId}`, {
                        data: {
                            _token: '{{ csrf_token() }}'
                        }
                    })
                    .then(response => {
                        if (response.data.success) {
                            Swal.fire(
                                'Deleted!',
                                'Review has been deleted.',
                                'success'
                            ).then(() => {
                                // Reload the page after deletion
                                window.location.reload();
                            });
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire(
                            'Error!',
                            'Unable to delete review.',
                            'error'
                        );
                    });
                }
            });
        });
    });

    // Comment modal handler
    document.querySelectorAll('.view-comment').forEach(button => {
        button.addEventListener('click', function() {
            const comment = this.getAttribute('data-comment');
            const tour = this.getAttribute('data-tour');
            const user = this.getAttribute('data-user');
            
            document.getElementById('modalComment').textContent = comment;
            document.getElementById('modalTour').textContent = tour;
            document.getElementById('modalUser').textContent = user;
        });
    });
});


</script>

@endsection