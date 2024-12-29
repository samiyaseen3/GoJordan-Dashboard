@extends('userside.source.template')

@section('content')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<style>
    /* Navbar override */
.ftco-navbar-light {
    background: #fff !important;
}

.ftco-navbar-light .navbar-brand {
    color: #000;
}

.ftco-navbar-light .navbar-nav>.nav-item>.nav-link {
    color: #000;
}

/* Base container styles */
.booking-container {
    padding: 60px 0;
    background: #f8f9fa;
}

.row {
    margin-top: 40px;
}

/* Steps indicator styles */
.steps-indicator {
    position: relative;
    padding: 20px 0;
    margin-bottom: 40px;
}

.steps-line {
    position: absolute;
    top: 35px;
    left: 50px;
    right: 50px;
    height: 3px;
    background: #e6e6e6;
    z-index: 1;
}

.steps-progress {
    position: absolute;
    top: 35px;
    left: 50px;
    height: 3px;
    background: #f15d30;
    transition: width 0.3s ease;
    z-index: 2;
}

.steps-progress[data-step="1"] {
    width: 0;
}

.steps-progress[data-step="2"] {
    width: calc(100% - 100px);
}

.steps-wrapper {
    display: flex;
    justify-content: space-between;
    position: relative;
    z-index: 3;
    padding: 0 50px;
}

.step {
    text-align: center;
    position: relative;
}

.step-number {
    width: 40px;
    height: 40px;
    background: #fff;
    border: 3px solid #e6e6e6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    font-weight: bold;
    color: #666;
    transition: all 0.3s ease;
}

.step.active .step-number {
    border-color: #f15d30;
    background: #f15d30;
    color: #fff;
}

.step.completed .step-number {
    border-color: #f15d30;
    background: #f15d30;
    color: #fff;
}

/* Booking form styles */
.booking-form {
    background: white;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}

.booking-form h2 {
    color: #2d3436;
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 30px;
}

/* Guest select styles */
.guest-select {
    margin-bottom: 30px;
    position: relative;
}

.guest-select select {
    width: 100%;
    padding: 15px 20px;
    font-size: 16px;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    appearance: none;
    background: white;
    cursor: pointer;
    transition: all 0.3s ease;
}

.guest-select select:focus {
    border-color: #f15d30;
    outline: none;
    box-shadow: 0 0 0 2px rgba(241,93,48,0.1);
}

/* Tour summary styles */
.tour-summary {
    background: white;
    border-radius: 16px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    padding: 30px;
}

.summary-section {
    margin-bottom: 25px;
}

.summary-label {
    color: #6c757d;
    font-size: 13px;
    margin-bottom: 8px;
}

.summary-value {
    color: #2d3436;
    font-size: 18px;
    font-weight: 600;
}

.total-section {
    border-top: 2px solid #f8f9fa;
    padding-top: 20px;
    margin-top: 20px;
}

.total-price {
    color: #f15d30;
    font-size: 24px;
    font-weight: 700;
}

/* Payment methods styles */
.payment-methods {
    margin-top: 20px;
    margin-bottom: 30px;
}

.payment-method {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 15px;
}

.payment-method:hover {
    border-color: #f15d30;
}

.payment-method.selected {
    border-color: #f15d30;
    background: rgba(241,93,48,0.05);
}

.payment-method img {
    width: 40px;
    height: 40px;
    object-fit: contain;
}

/* Payment form styles */
.payment-form {
    display: none;
    margin-top: 20px;
    padding: 20px;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    background: #f8f9fa;
}

.payment-form.active {
    display: block;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #2d3436;
    font-weight: 500;
}

.card-input {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.card-input:focus {
    border-color: #f15d30;
    outline: none;
    box-shadow: 0 0 0 2px rgba(241,93,48,0.1);
}

.card-row {
    display: flex;
    gap: 15px;
}

.card-expiry {
    width: 100px;
}

.card-cvv {
    width: 80px;
}

/* Invalid feedback */
.invalid-feedback {
    color: #dc3545;
    font-size: 14px;
    margin-top: 5px;
    display: none;
}

/* Button styles */
.buttons-wrapper {
    display: flex;
    align-items: center;
    margin-top: 30px;
    gap: 15px;
}

.btn-back {
    background: #fff;
    color: #f15d30;
    padding: 12px 25px;
    border-radius: 8px;
    border: 2px solid #f15d30;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}

.btn-back:hover {
    background: #fff5f2;
    text-decoration: none;
    color: #f15d30;
}

.btn-next {
    background: #f15d30;
    color: white;
    padding: 12px 25px;
    border-radius: 8px;
    border: none;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.btn-next:hover {
    background: #e44d20;
}

/* Notice boxes */
.sandbox-notice {
    background-color: #fff3cd;
    border: 1px solid #ffeeba;
    color: #856404;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
    font-size: 14px;
}

.test-cards {
    background-color: #e8f4fd;
    border: 1px solid #b8daff;
    color: #004085;
    padding: 15px;
    margin-top: 15px;
    border-radius: 8px;
    font-size: 13px;
}

/* Alert styles */
.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .tour-summary {
        margin-top: 30px;
    }
    
    .buttons-wrapper {
        flex-direction: column;
        gap: 10px;
    }
    
    .btn-back, .btn-next {
        width: 100%;
        justify-content: center;
    }
}
</style>

<div class="booking-container">
    <div class="container">
        <div class="row">
            <!-- Left Side - Booking Process -->
            <div class="col-md-8">
                <div class="booking-steps">
                    <!-- Step Indicators --> 
                    <div class="steps-indicator">
                        <div class="steps-line"></div>
                        <div class="steps-progress" data-step="{{$step}}"></div>
                        <div class="steps-wrapper">
                            <div class="step {{ $step === 1 ? 'active' : ($step === 2 ? 'completed' : '') }}">
                                <div class="step-number">1</div>
                                <div class="step-text">Guests</div>
                            </div>
                            <div class="step {{ $step === 2 ? 'active' : '' }}">
                                <div class="step-number">2</div>
                                <div class="step-text">Payment</div>
                            </div>
                        </div>
                    </div>

                    <div class="booking-form">
                        @if($step === 1)
                        <h2>How many guests are joining?</h2>
                        <form action="{{ route('booking.payment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                            <input type="hidden" name="tour_date_id" value="{{ $tourDate->id }}">

                            <div class="guest-select">
                                <select name="guests" id="guestCount" class="form-control">
                                    @for($i = 1; $i <= 6; $i++) <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'Guest'
                                        : 'Guests' }}</option>
                                        @endfor
                                </select>
                            </div>

                            <button type="submit" class="btn-next">
                                Continue to Payment <i class="fas fa-arrow-right"></i>
                            </button>
                        </form>
                        @else
                        <!-- Payment Form -->
                        <h2>Payment Details</h2>
                        <form action="{{ route('booking.payment.process') }}" method="POST" id="paymentForm">
                            @csrf
                            <input type="hidden" name="payment_method" value="">

                            <div class="sandbox-notice">
                                <strong>Test Mode:</strong> This is a sandbox environment. Use test credentials for
                                payments.
                            </div>

                            <!-- Payment Methods -->
                            <div class="payment-methods">
                                <div class="payment-method" data-method="Credit Card">
                                    <img src="{{asset('assets/img/credit-card.svg')}}" alt="Credit Card">
                                    <div>Credit Card</div>
                                </div>

                                <div id="creditCardForm" class="payment-form">
                                    <div class="form-group">
                                        <label for="cardNumber">Card Number</label>
                                        <input type="text" id="cardNumber" name="card_number" class="card-input"
                                            placeholder="4111 1111 1111 1111" maxlength="19">
                                        <div class="invalid-feedback">Please enter a valid card number</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cardName">Cardholder Name</label>
                                        <input type="text" id="cardName" name="card_name" class="card-input"
                                            placeholder="John Doe">
                                        <div class="invalid-feedback">Please enter the cardholder name</div>
                                    </div>

                                    <div class="form-group card-row">
                                        <div>
                                            <label for="cardExpiry">Expiry</label>
                                            <input type="text" id="cardExpiry" name="card_expiry"
                                                class="card-input card-expiry" placeholder="MM/YY" maxlength="5">
                                            <div class="invalid-feedback">Invalid expiry date</div>
                                        </div>
                                        <div>
                                            <label for="cardCVV">CVV</label>
                                            <input type="text" id="cardCVV" name="card_cvv" class="card-input card-cvv"
                                                placeholder="123" maxlength="3">
                                            <div class="invalid-feedback">Invalid CVV</div>
                                        </div>
                                    </div>

                                    <div class="test-cards">
                                        <strong>Test Card Numbers:</strong><br>
                                        Visa: 4111 1111 1111 1111<br>
                                        Mastercard: 5555 5555 5555 4444<br>
                                        Amex: 3782 822463 10005
                                    </div>
                                </div>

                                <div class="payment-method" data-method="PayPal">
                                    <img src="{{asset('assets/img/paypal.svg')}}" alt="PayPal">
                                    <div>PayPal</div>
                                </div>

                                <div id="paypalForm" class="payment-form">
                                    <div class="form-group">
                                        <label for="paypalEmail">PayPal Email</label>
                                        <input type="email" id="paypalEmail" name="paypal_email" class="card-input"
                                            placeholder="test@sandbox.paypal.com">
                                        <div class="invalid-feedback">Please enter a valid email</div>
                                    </div>
                                    <div class="sandbox-notice">
                                        <strong>Test PayPal Account:</strong><br>
                                        Email: sb-buyer@sandbox.paypal.com<br>
                                        Password: testpassword123
                                    </div>
                                </div>

                                <div class="payment-method" data-method="Cash">
                                    <img src="{{asset('assets/img/cash.svg')}}" alt="Cash">
                                    <div>Cash</div>
                                </div>
                            </div>
                            <div id="cashForm" class="payment-form">
                                <div class="sandbox-notice bg-warning">
                                    <strong>Note:</strong> For cash payments, your booking will be marked as pending
                                    until payment is received.
                                </div>
                            </div>

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <div class="buttons-wrapper">
                                <a href="{{ route('tour.details', ['id' => $tour->id]) }}" class="btn-back">
                                    <i class="fas fa-arrow-left"></i> Back to tour
                                </a>
                                <button type="submit" class="btn-next">
                                    Complete Booking <i class="fas fa-check"></i>
                                </button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Side - Tour Summary -->
            <div class="col-md-4">
                <div class="tour-summary">
                    <div class="summary-section">
                        <div class="summary-label">Your tour</div>
                        <div class="summary-value">{{ $tour->title }}</div>
                    </div>

                    <div class="summary-section">
                        <div class="summary-label">Tour date</div>
                        <div class="summary-value">{{ \Carbon\Carbon::parse($tourDate->date)->format('d M, Y') }}</div>
                    </div>

                    <div class="summary-section">
                        <div class="summary-label">Guest count</div>
                        <div class="summary-value">
                            <span id="guestSummary">{{ $step === 2 ? $bookingData['number_of_guests'] : 1 }}</span> @
                            ${{ number_format($tour->price, 2) }}
                        </div>
                    </div>

                    <div class="total-section">
                        <div class="summary-label">Total amount</div>
                        <div class="total-price" id="totalPrice">
                            ${{ number_format($tour->price * ($step === 2 ? $bookingData['number_of_guests'] : 1), 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Guest count and price calculation
    document.getElementById('guestCount')?.addEventListener('change', function() {
    const guests = this.value;
    const pricePerGuest = {{ $tour->price }};
    const totalPrice = guests * pricePerGuest;
    
    document.getElementById('guestSummary').textContent = guests;
    document.getElementById('totalPrice').textContent = '$' + totalPrice.toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
});

// Payment method selection
document.querySelectorAll('.payment-method').forEach(method => {
    method.addEventListener('click', function() {
        document.querySelectorAll('.payment-form').forEach(form => form.classList.remove('active'));
        document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('selected'));
        
        this.classList.add('selected');
        document.querySelector('input[name="payment_method"]').value = this.dataset.method;
        
        const formMap = {
            'Credit Card': 'creditCardForm',
            'PayPal': 'paypalForm',
            'Cash': 'cashForm'
        };
        
        const formId = formMap[this.dataset.method];
        if (formId) {
            document.getElementById(formId).classList.add('active');
        }
    });
});

// Card input formatting
const formatCardNumber = (e) => {
    let value = e.target.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
    let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
    e.target.value = formattedValue.substring(0, 19);
};

const formatExpiry = (e) => {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length >= 2) {
        value = value.slice(0,2) + '/' + value.slice(2);
    }
    e.target.value = value.substring(0, 5);
};

const formatCVV = (e) => {
    e.target.value = e.target.value.replace(/\D/g, '').substring(0, 3);
};

document.getElementById('cardNumber')?.addEventListener('input', formatCardNumber);
document.getElementById('cardExpiry')?.addEventListener('input', formatExpiry);
document.getElementById('cardCVV')?.addEventListener('input', formatCVV);

// Guest form submission
document.querySelector('form[action="{{ route('booking.payment') }}"]')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    Swal.fire({
        title: 'Proceeding to Payment',
        text: 'Continue with your booking?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#f15d30',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, continue'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
});

// Payment form validation and submission
document.getElementById('paymentForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const selectedMethod = document.querySelector('.payment-method.selected');
    if (!selectedMethod) {
        Swal.fire({
            title: 'Error',
            text: 'Please select a payment method',
            icon: 'error',
            confirmButtonColor: '#f15d30'
        });
        return;
    }

    const validationRules = {
        'Credit Card': () => {
            const cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, '');
            const cardName = document.getElementById('cardName').value;
            const cardExpiry = document.getElementById('cardExpiry').value;
            const cardCVV = document.getElementById('cardCVV').value;

            if(cardNumber.length !== 16) return 'Please enter a valid 16-digit card number';
            if(!cardName) return 'Please enter the cardholder name';
            if(!cardExpiry || cardExpiry.length !== 5) return 'Please enter a valid expiry date (MM/YY)';
            if(!cardCVV || cardCVV.length !== 3) return 'Please enter a valid 3-digit CVV';
            return null;
        },
        'PayPal': () => {
            const email = document.getElementById('paypalEmail').value;
            if(!email || !email.includes('@')) return 'Please enter a valid PayPal email';
            return null;
        },
        'Cash': () => null
    };

    const errorMessage = validationRules[selectedMethod.dataset.method]?.();
    if(errorMessage) {
        Swal.fire({
            title: 'Validation Error',
            text: errorMessage,
            icon: 'error',
            confirmButtonColor: '#f15d30'
        });
        return;
    }

    const confirmText = selectedMethod.dataset.method === 'Cash' 
        ? 'Your booking will be marked as pending until cash payment is received.' 
        : 'Are you sure you want to proceed with the payment?';

    try {
        const result = await Swal.fire({
            title: 'Complete Booking',
            text: confirmText,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, complete booking',
            cancelButtonText: 'No, cancel',
            confirmButtonColor: '#f15d30',
            cancelButtonColor: '#6c757d'
        });

        if (result.isConfirmed) {
            const formData = new FormData(this);
            
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (data.status === 'success') {
                window.location.href = data.redirect;
            } else {
                throw new Error(data.message || 'An error occurred');
            }
        }
    } catch (error) {
        Swal.fire({
            title: 'Error',
            text: error.message || 'An error occurred while processing your booking.',
            icon: 'error',
            confirmButtonColor: '#f15d30'
        });
    }
});

    
</script>
@endsection