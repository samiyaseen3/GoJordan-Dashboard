<!-- resources/views/userside/contact.blade.php -->
@extends('userside.source.template')
@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('assets_userside/images/contact_us.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="overlay" style="background: rgba(0, 0, 0, 0.5);"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs">
                    <span class="mr-2">
                        <a href="{{ route('userside.index') }}">Home</a>
                        <i class="fa fa-chevron-right"></i>
                    </span> 
                    <span>Contact us <i class="fa fa-chevron-right"></i></span>
                </p>
                <h1 class="mb-0 bread">Contact us</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pb contact-section mb-4">
    <div class="container">
        <div class="row d-flex contact-info">
            <div class="col-md-3 d-flex">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-map-marker"></span>
                    </div>
                    <h3 class="mb-2">Address</h3>
                    <p>King Hussein Street, Amman 11181, Jordan</p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-phone"></span>
                    </div>
                    <h3 class="mb-2">Contact Number</h3>
                    <p><a href="tel://+962790000000">+962 79 000 0000</a></p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-paper-plane"></span>
                    </div>
                    <h3 class="mb-2">Email Address</h3>
                    <p><a href="mailto:info@jordantours.com">info@jordantours.com</a></p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-globe"></span>
                    </div>
                    <h3 class="mb-2">Website</h3>
                    <p><a href="#">jordantours.com</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section contact-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form id="contactForm" action="{{ route('contact.store') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject" value="{{ old('subject') }}" required>
                        @error('subject')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="7" placeholder="Message" required>{{ old('message') }}</textarea>
                        @error('message')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                    <div id="alertMessage" class="alert" style="display: none;"></div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
.contact-form {
    background: #fff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.contact-form .form-control {
    height: 50px;
    border: 1px solid rgba(0,0,0,0.1);
    padding: 0 20px;
    border-radius: 5px;
    margin-bottom: 20px;
}

.contact-form textarea.form-control {
    height: auto;
    padding: 20px;
}




.icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(241, 93, 48, 0.1);
    margin: 0 auto 1rem;
}

.icon span {
    color: #f15d30;
    font-size: 24px;
}

.box {
    border-radius: 10px;
    background: #fff;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.box:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
}

<style>
.alert {
    margin-top: 20px;
    display: none;
}

.alert ul {
    padding-left: 20px;
}

.alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}

.alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        
        let formData = $(this).serialize();
        let submitBtn = $(this).find('button[type="submit"]');
        let alertDiv = $('#alertMessage');
        
        // Disable submit button during submission
        submitBtn.prop('disabled', true);
        
        $.ajax({
            url: "{{ route('contact.store') }}",
            type: "POST",
            data: formData,
            success: function(response) {
                // Show success message
                alertDiv.removeClass('alert-danger').addClass('alert-success')
                    .html('Your message has been sent successfully!')
                    .fadeIn();
                
                // Reset form
                $('#contactForm')[0].reset();
                
                // Hide success message after 3 seconds
                setTimeout(function() {
                    alertDiv.fadeOut();
                }, 3000);
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMessage = '<ul class="mb-0">';
                
                // Compile validation errors
                if (errors) {
                    $.each(errors, function(key, value) {
                        errorMessage += '<li>' + value[0] + '</li>';
                    });
                } else {
                    errorMessage += '<li>Something went wrong. Please try again.</li>';
                }
                errorMessage += '</ul>';
                
                // Show error message
                alertDiv.removeClass('alert-success').addClass('alert-danger')
                    .html(errorMessage)
                    .fadeIn();
            },
            complete: function() {
                // Re-enable submit button
                submitBtn.prop('disabled', false);
            }
        });
    });
});
</script>
@endsection