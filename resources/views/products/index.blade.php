@extends('layouts.app')
@section('title', 'Products')

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
    <div class="col-11 pe-2">
        <div class="d-flex justify-content-between align-items-center dmb-75">
            <div class="title d-flex align-items-center">
                <div class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('images/star-icon.svg') }}" alt="">
                </div>
                <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                    Products
                </div>
            </div>
            @if (count($products) != 0)
                <ul class="nav nav-tabs create-account-tabs bg-EBEBEB border-0 d-inline-flex align-items-center radius5 overflow-hidden px-1"
                id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link active tk-basic-sans fw-normal font14 leading22 space-0_14 py-1 radius5 px-3 text-black"
                            id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab"
                            aria-controls="home" aria-selected="true">
                            Monthly billing
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link tk-basic-sans fw-normal font14 leading22 space-0_14 py-1 radius5 px-3 text-black"
                            id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab"
                            aria-controls="profile" aria-selected="false">
                            Yearly billing
                        </button>
                    </li>
                </ul>
            @endif
        </div>
        @if (count($products) == 0)
        <div class="accordion-section bg-white radius7 dmb-45">
            <div class="accordion-item">
                <div
                    class="accordion-header d-flex justify-content-between px-4 py-3">
                    <div
                        class="tk-basic-sans font18 leading22 space-0_18 text-0F0F0F fw-normal">
                        You do not have a product.
                    </div>
                    <div class="transition">
                            <a href="{{ route('products.create') }}" class="notify-btn text-decoration-none bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-5 radius5 ms-3">Add new product</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if (count($products) != 0)
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row row18">

                    @foreach ($products as $product)
                        <div class="col-4">
                            <div class="upgrade-cards bg-white radius5 dpt-35 dpb-45">
                                <div class="d-flex align-items-center dmb-15">
                                    <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                                        class="text-center flex-fill text-decoration-none border-0 bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5 me-1">View</a>
                                    <a href="#remove-user-modal" data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}" data-bs-toggle="modal"
                                        data-bs-target="#remove-user-modal"
                                        class="text-center flex-fill text-decoration-none border-0 btn btn-danger tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5 delete-product">
                                        delete
                                    </a>
                                </div>
                                <div class="tk-basic-sans fw-normal font22 leading22 space-0_22 text-0F0F0F dmb-15">
                                    {{ $product->name }}
                                </div>
                                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-808080 dmb-20">
                                    {{ $product->title }}</div>
                                <div class="tk-basic-sans fw-normal font32 leading22 space-0_32 text-0F0F0F dmb-30">
                                    £{{ $product->monthly_price }}<span
                                        class="tk-basic-sans fw-normal font14 leading22 space-0_14 text-808080">/mo</span>
                                </div>
                                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black dmb-20">
                                    What’s included:</div>
                                <div
                                    class="tk-basic-sans fw-normal font12 leading22 space-0_12 text-808080 d-flex align-items-start dmb-20">
                                    <img src="{{ asset('images/true-icon.svg') }}" class="correct-arrow mt-2 me-2"
                                        alt="">{{ $product->description }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row row18">
                    @foreach ($products as $product)
                        <div class="col-4">
                            <div class="upgrade-cards bg-white radius5 dpt-35 dpb-45">
                                <div class="d-flex align-items-center dmb-15">
                                    <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                                        class="text-center flex-fill text-decoration-none border-0 bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5 me-1">View</a>
                                    <a href="#remove-user-modal" data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}" data-bs-toggle="modal"
                                        data-bs-target="#remove-user-modal"
                                        class="text-center flex-fill text-decoration-none border-0 btn btn-danger tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5 delete-product">
                                        delete
                                    </a>
                                </div>
                                <div class="tk-basic-sans fw-normal font22 leading22 space-0_22 text-0F0F0F dmb-15">
                                    {{ $product->name }}</div>
                                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-808080 dmb-20">
                                    {{ $product->title }}</div>
                                <div class="tk-basic-sans fw-normal font32 leading22 space-0_32 text-0F0F0F dmb-30">
                                    £{{ $product->yearly_price }}<span
                                        class="tk-basic-sans fw-normal font14 leading22 space-0_14 text-808080">/mo</span>
                                </div>
                                <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black dmb-20">
                                    What’s included:</div>
                                <div
                                    class="tk-basic-sans fw-normal font12 leading22 space-0_12 text-808080 d-flex align-items-start dmb-20">
                                    <img src="{{ asset('images/true-icon.svg') }}" class="correct-arrow mt-2 me-2"
                                        alt="">{{ $product->description }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- remove-user-modal -->
    <div class="modal remove-user-modal fade" id="remove-user-modal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="remove-userLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div
                class="modal-content position-relative border-0 radius4 bg-white justify-content-lg-center justify-content-start">
                <div class="close-div position-absolute">
                    <button type="button"
                        class="modal-close p-0 close-round border-0 bg-224598 d-flex align-items-center justify-content-center rounded-circle"
                        data-bs-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('images/white-close.svg') }}" alt="" />
                    </button>
                </div>
                <div class="">
                    <div class="tk-basic-sans font26 leading30 space-0_26 text-0F0F0F text-center dmb-25 col-8 mx-auto">
                        Are you sure you want to remove <span id="product-name"></span>
                    </div>
                    <div class="d-flex align-items-center row6">
                        <div class="col-6">
                            <!-- Confirm Delete Button -->
                            <form id="delete-product-form" action="" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit"
                                    class="large-btn blue-btn2 w-100 d-inline-flex align-items-center justify-content-center tk-basic-sans fw-normal font16 leading19 space-0_16 radius7 transition">Yes,
                                    remove</button>
                            </form>

                        </div>
                        <div class="col-6">
                            <button
                                class="large-btn btn-808080 w-100 d-inline-flex align-items-center justify-content-center tk-basic-sans fw-normal font16 leading19 space-0_16 radius7 transition"
                                data-bs-dismiss="modal" aria-label="Close">No, keep Product</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-specific-scripts')
    <script type="module">
        // When a delete button is clicked
        $('.delete-product').on('click', function(event) {
            // Prevent the default action
            event.preventDefault();

            // Get the user data from the button's data attributes
            var productId = $(this).data('product-id');
            var userName = $(this).data('product-name');

            // Update the modal content with the user's name
            $('#product-name').text(userName);

            // Update the form's action with the correct delete URL
            var route = '{{ route('products.destroy', ':id') }}'.replace(':id',
            productId); // Update the URL for the user deletion

            $('#delete-product-form').attr('action', route);
        });
    </script>
@endpush
