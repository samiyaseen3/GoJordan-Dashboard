@extends('userside.source.template')
@section('content')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
   
    <style>        
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
        }
        .ftco-navbar-light{
            background: #fff !important;
        }

        .btn.btn-primary {
    background: linear-gradient(45deg, #FA4032, #FA812F);
    border: none;
    padding: 0.4rem 1rem;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
}
        
        .profile-card {
    background: #fff;
    border-radius: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    overflow: hidden;
    margin-top: 120px;
    margin-bottom: 80px;
    transition: transform 0.3s ease;
    max-width: fit-content;  /* Ensures the width adjusts to content */
    margin-left: auto;       /* Centers the card horizontally */
    margin-right: auto;      /* Centers the card horizontally */
    height: auto;            /* Reduces height */
}
        
        .profile-card:hover {
            transform: translateY(-5px);
        }
        
        .profile-header {
    background: linear-gradient(135deg, #f15d30 0%, #f17530 100%);
    padding: 2rem 1.5rem; /* Reduces padding to reduce height */
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
}
        
        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='rgba(255,255,255,0.05)' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .profile-header h2{
            color: #fff;
            font-weight: bolder;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            position: relative;
            border: 4px solid rgba(255,255,255,0.2);
            font-size: 2.5rem;
            font-weight: 600;
            color: #f15d30;
            text-transform: uppercase;
        }
        
        .profile-avatar .camera-btn {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #f15d30;
            color: white;
            padding: 0.75rem;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid white;
            transition: all 0.3s ease;
        }
        
        .profile-avatar .camera-btn:hover {
            transform: scale(1.1);
        }
        
        .profile-stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-top: 2rem;
            padding: 1rem;
            background: rgba(255,255,255,0.1);
            border-radius: 1rem;
        }
        
        .nav-tabs {
            border: none;
            display: flex;
            justify-content: center;
            padding: 1rem;
            gap: 2rem;
        }
        
        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            padding: 1rem 2rem;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-tabs .nav-link:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: #f15d30;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-tabs .nav-link.active {
            color: #f15d30;
            background: transparent;
        }
        
        .nav-tabs .nav-link.active:after {
            width: 100%;
        }
        
        .nav-tabs .nav-link:hover {
            color: #f15d30;
        }
        
        .tab-content {
            padding: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .input-group {
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .input-group-text {
            background: #f8f9fa;
            border: none;
            padding: 0.75rem 1rem;
        }
        
        .form-control {
            border: none;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
        }
        
        .form-control:focus {
            box-shadow: none;
            border-color: #f15d30;
        }
        
        .btn-update {
            background: #f15d30;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            border: none;
            font-weight: 600;
            transition: all 0.3s;
            margin-top: 1rem;
        }
        
        .btn-update:hover {
            background: #e44d20;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(241,93,48,0.2);
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.show.active {
            display: block;
        }

        .ftco-navbar-light .navbar-brand {
    color: #000;
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.ftco-navbar-light .navbar-nav > .nav-item > .nav-link {
    color: #000;}
    </style>
</head>

<div class="container">
    <div class="profile-card">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-avatar">
                {{ substr($user->name, 0, 2) }}
            </div>
            <h2 class="mt-4 font-bold">{{ $user->name }}</h2>
            <p class="text-sm opacity-80">Member since {{ $user->created_at->format('M Y') }}</p>
        </div>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" onclick="showTab('personal')" id="personalTab" data-toggle="tab" href="#" role="tab">
                    Personal Information
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="showTab('password')" id="passwordTab" data-toggle="tab" href="#" role="tab">
                    Change Password
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="showTab('history')" id="historyTab" data-toggle="tab" href="#" role="tab">
                    Booking History
                </a>
            </li>
        </ul>

        <!-- Tab Contents -->
        <div class="tab-content p-4">
            <!-- Personal Information Form -->
            <div id="personalInfo" class="tab-pane active now">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('userside.update.profile') }}">
                    @csrf
                    @method('put')
                    
                    <div class="form-group">
                        <label>Full Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror">
                        </div>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="tel" name="phone" value="{{ old('phone', $user->phone_number) }}" class="form-control @error('phone') is-invalid @enderror">
                                </div>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                    </div>
                                    <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                        <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-city"></i></span>
                                    </div>
                                    <input type="text" name="city" value="{{ old('city', $user->city) }}" class="form-control @error('city') is-invalid @enderror">
                                </div>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn-update">Update Profile</button>
                    </div>
                </form>
            </div>

            <!-- Password Change Form -->
            <div id="passwordChange" class="tab-pane">
                <form id="passwordChangeForm" class="space-y-6">
                    @csrf
                    @method('put')
                    
                    <div class="form-group">
                        <label>Current Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>New Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="new_password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn-update">Update Password</button>
                    </div>
                </form>
            </div>

            <!-- Booking History -->
            <!-- Booking History -->
<div id="bookingHistory" class="tab-pane">
    @if($bookings->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>View Tour</th>
                        <th>Tour</th>
                        <th>Check Out</th>
                        <th>Guests</th>
                        <th>Status</th>
                        <th>Payment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td><a href="{{ route('tour.details', ['id' => $booking->tour->id]) }}" class="btn btn-primary">View</a></td>
                            <td>{{ $booking->tour->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->check_out_date)->format('M d, Y') }}</td>
                            <td>{{ $booking->number_of_guests }} guests</td>
                            <td>
                                <span class="badge rounded-pill 
                                    @if($booking->booking_status == 'completed') bg-success
                                    @elseif($booking->booking_status == 'cancelled') bg-danger
                                    @elseif($booking->booking_status == 'pending') bg-warning
                                    @else bg-info
                                    @endif">
                                    {{ ucfirst($booking->booking_status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $booking->payment_method }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-4">
            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">No booking history found</h5>
            <p class="text-muted">You haven't made any tour bookings yet.</p>
            <a href="{{ route('tours.all-adventure') }}" class="btn-update mt-3">
                Book a Tour Now
            </a>
        </div>
    @endif
</div>
        </div>
    </div>
</div>

<script>
    // Tab switching function
    function showTab(tabName) {
    // Hide all content
    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.classList.remove('show', 'active');
    });
    
    // Remove active class from all tabs
    document.querySelectorAll('.nav-link').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Show selected content and activate tab
    if (tabName === 'personal') {
        document.getElementById('personalInfo').classList.add('show', 'active');
        document.getElementById('personalTab').classList.add('active');
    } else if (tabName === 'password') {
        document.getElementById('passwordChange').classList.add('show', 'active');
        document.getElementById('passwordTab').classList.add('active');
    } else if (tabName === 'history') {
        document.getElementById('bookingHistory').classList.add('show', 'active');
        document.getElementById('historyTab').classList.add('active');
    }
}
    // Password change form submission
    $('#passwordChangeForm').on('submit', function(e) {
        e.preventDefault();
        
        let formData = {
            current_password: $('input[name="current_password"]').val(),
            new_password: $('input[name="new_password"]').val(),
            new_password_confirmation: $('input[name="new_password_confirmation"]').val(),
            _token: $('meta[name="csrf-token"]').attr('content'),
        };

        $.ajax({
            url: "{{ route('userside.change.password') }}",
            method: 'PUT',
            data: formData,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                });
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = '';
                    for (let key in errors) {
                        errorMessages += errors[key][0] + '\n';
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: errorMessages,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An unexpected error occurred. Please try again.',
                    });
                }
            },
        });
    });
</script>
@endsection