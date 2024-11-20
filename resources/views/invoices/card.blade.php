@extends('layouts.app')
@section('title', 'Subscription')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="col-11 pe-4 dmt-55">
        <div class="row row18">
            <div class="col-8">
                <div class="upgrade-cards radius5 bg-white dpt-35 dpb-30">
                    <div class="dmb-20 d-flex justify-content-between align-items-center">
                        <div class="tk-basic-sans fw-normal font22 leading22 space-0_22 text-0F0F0F">
                            Pay your invoice</div>
                        <div class="">
                            <img src="{{ asset('images/brand-icon.svg') }}" class="upgrade-brand-logo ms-1" alt="">
                            <img src="{{ asset('images/brand-icon2.svg') }}" class="upgrade-brand-logo ms-1" alt="">
                            <img src="{{ asset('images/brand-icon3.svg') }}" class="upgrade-brand-logo ms-1" alt="">
                        </div>
                    </div>
                    <form action="{{ route('invoices.pay', ['invoice' => $invoice]) }}" method="POST" id="payment-form">
                        @csrf
                        <div>
                            <div id="cardNumber" style="padding-top: 20px !important"
                                class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100 dmb-10">
                            </div> <!-- Stripe will mount here -->
                            <div class="row row8 dmb-10">
                                <div class="col-8">
                                    <div id="expiryDate" style="padding-top: 20px !important"
                                        class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100">
                                    </div> <!-- Stripe will mount here -->
                                </div>
                                <div class="col-4">
                                    <div id="cvc" style="padding-top: 20px !important"
                                        class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100">
                                    </div> <!-- Stripe will mount here -->
                                </div>
                            </div>
                            <input id="postcode" type="text" placeholder="Postcode…"
                                class="tk-basic-sans fw-normal input white-b-input font16 leading24 space-0_16 w-100"></input>

                            <span id="card-errors" class="invalid-feedback d-block text-start d-flex dmb-30" role="alert">
                                <strong></strong>
                            </span>

                            <div class="d-flex align-items-center justify-content-between dmb-35">
                                <div class="tk-basic-sans fw-normal font14 leading22 space-0_14 text-808080">
                                    Total</div>
                                <div class="tk-basic-sans fw-normal font32 leading22 space-0_32 text-0F0F0F">
                                    £{{ $invoice->amount }}
                                    <span class="tk-basic-sans fw-normal font14 leading22 space-0_14 text-808080">/mo</span>
                                </div>
                            </div>
                            <button class="btnB blue-btn border-0 radius7 w-100 dmb-15">Purchase this plan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-4">
                <div class="upgrade-cards radius5 bg-white dpt-35 dpb-45">
                    <div class="tk-basic-sans fw-normal font22 leading22 space-0_22 text-black dmb-15">Invoice details</div>
                    <div
                        class="tk-basic-sans fw-normal font12 leading22 space-0_12 text-808080 d-flex align-items-start dmb-20">
                        {{ $invoice->description }}
                    </div>
                    <a href="{{ route('invoices.download', ['invoice' => $invoice]) }}" class="tk-basic-sans fw-normal font16 leading24 space-0_16 text-808080">View PDF</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-specific-scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var stripe = Stripe("{{ $stripePublicKey }}");
            const elements = stripe.elements();

            // Custom style for the Stripe Elements including the placeholder text
            var style = {
                base: {
                    fontFamily: '"basic-sans",sans-serif',
                    fontSmoothing: "antialiased",
                    fontSize: "16px",
                    fontWeight: "400", // Adjust font size for placeholder text
                    "::placeholder": {
                        color: "#000", // Placeholder color
                        fontSize: "16px" // Adjust font size for placeholder text
                    }
                },
                invalid: {
                    color: "#fa755a",
                    iconColor: "#fa755a"
                }
            };

            // Create instances of the card elements
            var cardNumber = elements.create('cardNumber', {
                style: style
            });
            var expiry = elements.create('cardExpiry', {
                style: style
            });
            var cvc = elements.create('cardCvc', {
                style: style
            });

            // Mount the elements into the DOM
            cardNumber.mount('#cardNumber');
            expiry.mount('#expiryDate');
            cvc.mount('#cvc');

            // Show error to the user
            const errorElement = document.getElementById('card-errors');
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const {
                    setupIntent,
                    error
                } = await stripe.confirmCardSetup(
                    '{{ $clientSecret }}', {
                        payment_method: {
                            card: cardNumber,
                            billing_details: {
                                name: "{{ auth()->user()->name }}",
                                email: "{{ auth()->user()->email }}",
                                address: {
                                    postal_code: $('#postcode').val()
                                }
                            },
                        },
                    }
                );

                if (error) {
                    console.error('Error creating payment method:', error);
                    errorElement.innerHTML = `<strong>${error.message}</strong>`;
                } else {
                    console.log(setupIntent);
                    // Set the payment method ID in the hidden input and submit the form
                    var tokenInput = document.createElement('input');
                    tokenInput.setAttribute('type', 'hidden');
                    tokenInput.setAttribute('name', 'payment_method_id');
                    tokenInput.setAttribute('value', setupIntent.payment_method);
                    form.appendChild(tokenInput);

                    form.submit(); // Submit the form once the payment method ID is set
                }
            });
        });
    </script>
@endpush
