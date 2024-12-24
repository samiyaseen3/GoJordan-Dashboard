@extends('userside.source.template')

@section('content')


<style>
    .ftco-navbar-light {
        background: #fff !important;
    }
    .ftco-navbar-light .navbar-brand {
        color: #000;
    }
    .ftco-navbar-light .navbar-nav > .nav-item > .nav-link {
        color: #000;
    }
    .row {
        margin-top: 80px;
    }
    .steps-progress {
        position: absolute;
        top: 25px;
        left: 50px;
        height: 3px;
        background: #f15d30;
        transition: width 0.3s ease;
        z-index: 2;
        width: {{ $step === 2 ? '100%' : '25%' }};
    }
    .payment-method {
        cursor: pointer;
        padding: 15px;
        border: 1px solid #ddd;
        margin: 10px 0;
        border-radius: 5px;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .payment-method.selected {
        border-color: #f15d30;
        background-color: rgba(241, 93, 48, 0.1);
    }
    .payment-method img {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }
    .payment-form {
        display: none;
        margin-top: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: #f9f9f9;
    }
    .payment-form.active {
        display: block;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
    }
    .card-input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }
    .card-row {
        display: flex;
        gap: 15px;
    }
    .card-expiry {
        width: 70px;
    }
    .card-cvv {
        width: 60px;
    }
    .sandbox-notice {
        background-color: #fff3cd;
        border: 1px solid #ffeeba;
        color: #856404;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 4px;
        font-size: 14px;
    }
    .test-cards {
        background-color: #e8f4fd;
        border: 1px solid #b8daff;
        color: #004085;
        padding: 10px;
        margin-top: 10px;
        border-radius: 4px;
        font-size: 13px;
    }
    .btn-next {
        background: #f15d30;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
        transition: background 0.3s;
    }
    .btn-next:hover {
        background: #d64a20;
    }
    .btn-back {
        background: #6c757d;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        margin-right: 10px;
    }
    .btn-back:hover {
        background: #5a6268;
        color: white;
        text-decoration: none;
    }
    .buttons-wrapper {
        margin-top: 20px;
        display: flex;
        align-items: center;
    }
    .invalid-feedback {
        color: #dc3545;
        font-size: 14px;
        margin-top: 5px;
        display: none;
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
                        <div class="steps-progress"></div>
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
                                    @for($i = 1; $i <= 6; $i++)
                                        <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'Guest' : 'Guests' }}</option>
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
                                <strong>Test Mode:</strong> This is a sandbox environment. Use test credentials for payments.
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
                                        <input type="text" id="cardNumber" name="card_number" class="card-input" placeholder="4111 1111 1111 1111" maxlength="19">
                                        <div class="invalid-feedback">Please enter a valid card number</div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="cardName">Cardholder Name</label>
                                        <input type="text" id="cardName" name="card_name" class="card-input" placeholder="John Doe">
                                        <div class="invalid-feedback">Please enter the cardholder name</div>
                                    </div>
                                    
                                    <div class="form-group card-row">
                                        <div>
                                            <label for="cardExpiry">Expiry</label>
                                            <input type="text" id="cardExpiry" name="card_expiry" class="card-input card-expiry" placeholder="MM/YY" maxlength="5">
                                            <div class="invalid-feedback">Invalid expiry date</div>
                                        </div>
                                        <div>
                                            <label for="cardCVV">CVV</label>
                                            <input type="text" id="cardCVV" name="card_cvv" class="card-input card-cvv" placeholder="123" maxlength="3">
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
                                        <input type="email" id="paypalEmail" name="paypal_email" class="card-input" placeholder="test@sandbox.paypal.com">
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
                            <span id="guestSummary">{{ $step === 2 ? $bookingData['number_of_guests'] : 1 }}</span> @ ${{ number_format($tour->price, 2) }}
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

    document.querySelectorAll('.payment-method').forEach(method => {
        method.addEventListener('click', function() {
            // Remove selected class from all methods
            document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('selected'));
            // Add selected class to clicked method
            this.classList.add('selected');
            
            // Update hidden payment method input
            document.querySelector('input[name="payment_method"]').value = this.dataset.method;
        });
    });

    // Form validation
    document.getElementById('paymentForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const selectedMethod = document.querySelector('.payment-method.selected');
        if (!selectedMethod) {
            alert('Please select a payment method');
            return;
        }
        
        this.submit();
    });

    document.getElementById('cardNumber')?.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
        let formattedValue = '';
        for(let i = 0; i < value.length; i++) {
            if(i > 0 && i % 4 === 0) {
                formattedValue += ' ';
            }
            formattedValue += value[i];
        }
        e.target.value = formattedValue;
    });

    // Format expiry date
    document.getElementById('cardExpiry')?.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 2) {
            value = value.slice(0,2) + '/' + value.slice(2);
        }
        e.target.value = value;
    });

    // Only allow numbers in CVV
    document.getElementById('cardCVV')?.addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\D/g, '');
    });

    // Show/hide payment forms
    document.querySelectorAll('.payment-method').forEach(method => {
        method.addEventListener('click', function() {
            // Hide all payment forms
            document.querySelectorAll('.payment-form').forEach(form => {
                form.classList.remove('active');
            });
            
            // Show selected payment form
            if(this.dataset.method === 'Credit Card') {
                document.getElementById('creditCardForm').classList.add('active');
            } else if(this.dataset.method === 'PayPal') {
                document.getElementById('paypalForm').classList.add('active');
            }

            // Update hidden payment method input
            document.querySelector('input[name="payment_method"]').value = this.dataset.method;
            
            // Remove selected class from all methods
            document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('selected'));
            // Add selected class to clicked method
            this.classList.add('selected');
        });
    });

    // Form validation
    document.getElementById('paymentForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const selectedMethod = document.querySelector('.payment-method.selected');
        if (!selectedMethod) {
            alert('Please select a payment method');
            return;
        }

        // Validate credit card details if credit card is selected
        if(selectedMethod.dataset.method === 'Credit Card') {
            const cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, '');
            const cardName = document.getElementById('cardName').value;
            const cardExpiry = document.getElementById('cardExpiry').value;
            const cardCVV = document.getElementById('cardCVV').value;

            if(cardNumber.length !== 16) {
                alert('Please enter a valid card number');
                return;
            }
            if(!cardName) {
                alert('Please enter cardholder name');
                return;
            }
            if(!cardExpiry || cardExpiry.length !== 5) {
                alert('Please enter a valid expiry date');
                return;
            }
            if(!cardCVV || cardCVV.length !== 3) {
                alert('Please enter a valid CVV');
                return;
            }
        }

        // Validate PayPal email if PayPal is selected
        if(selectedMethod.dataset.method === 'PayPal') {
            const email = document.getElementById('paypalEmail').value;
            if(!email || !email.includes('@')) {
                alert('Please enter a valid PayPal email');
                return;
            }
        }
        
        this.submit();
    });
</script>
@endsection