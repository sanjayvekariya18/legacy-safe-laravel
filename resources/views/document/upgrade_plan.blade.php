@extends('layouts.app')

@section('content')
    <section class="admin bg-F5F5F5 h-vh">
        <div class="d-flex flex-wrap h-100">
            <div class="admin-wrapper">
                <div class="container-fluid h-100">
                    <div class="ps-5 h-100 d-flex flex-column">
                        <div class="col-11 pe-2">
                            <div class="d-flex justify-content-between align-items-center dmb-75">
                                <div class="title d-flex align-items-center">
                                    <div class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('images/star.svg') }}" alt="star icon">
                                    </div>
                                    <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                                        Upgrade your plan
                                    </div>
                                </div>
                                <ul class="nav nav-tabs create-account-tabs bg-EBEBEB border-0 d-inline-flex align-items-center radius5 overflow-hidden px-1" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active tk-basic-sans fw-normal font14 leading22 space-0_14 py-1 radius5 px-3 text-black btnB" id="monthly-tab" data-bs-toggle="tab" data-bs-target="#monthly" type="button" role="tab" aria-controls="monthly" aria-selected="true">
                                            Monthly billing
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link tk-basic-sans fw-normal font14 leading22 space-0_14 py-1 radius5 px-3 text-black btnB" id="yearly-tab" data-bs-toggle="tab" data-bs-target="#yearly" type="button" role="tab" aria-controls="yearly" aria-selected="false">
                                            Yearly billing
                                        </button>
                                    </li>
                                </ul>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPlansModal">
                                    Add Plans
                                </button>
                            </div>

                            <div class="tab-content" id="myTabContent">
                                {{-- Monthly plan --}}
                                <div class="tab-pane fade show active" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
                                    <div class="row row18" id="monthly-plans">
                                        @foreach ($allPlane as $PlanView)
                                            <div class="col-4">
                                                <div class="upgrade-cards bg-white radius5 dpt-35 dpb-45">
                                                    <div class="tk-basic-sans fw-normal font22 leading22 space-0_22 text-0F0F0F dmb-15">
                                                        {{ $PlanView->name }}
                                                    </div>
                                                    <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-808080 dmb-20">
                                                        All the basics of starting a new plan
                                                    </div>
                                                    <div class="tk-basic-sans fw-normal font32 leading22 space-0_32 text-0F0F0F dmb-30">
                                                        <span class="tk-basic-sans fw-normal font14 leading22 space-0_14 text-808080">{{ $PlanView->monthly_price }}/month</span>
                                                    </div>

                                                    <a href="{{ route('subscriptions.show', $PlanView->id) }}">
                                                        <button class="btnB blue-btn border-0 radius7 w-100 dmb-15">Select this plan</button>
                                                    </a>

                                                    <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black dmb-20">
                                                        What’s included:
                                                    </div>
                                                    <div class="tk-basic-sans fw-normal font12 leading22 space-0_12 text-808080 d-flex align-items-start dmb-20">
                                                        <img src="{{ asset('images/tick.svg') }}" class="correct-arrow mt-2 me-2" alt="tick">{{ $PlanView->description }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Yearly plan --}}
                                <div class="tab-pane fade" id="yearly" role="tabpanel" aria-labelledby="yearly-tab">
                                    <div class="row row18" id="yearly-plans">
                                        @foreach ($allPlane as $PlanView)
                                            <div class="col-4">
                                                <div class="upgrade-cards bg-white radius5 dpt-35 dpb-45">
                                                    <div class="tk-basic-sans fw-normal font22 leading22 space-0_22 text-0F0F0F dmb-15">
                                                        {{ $PlanView->name }}
                                                    </div>
                                                    <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-808080 dmb-20">
                                                        All the basics of starting a new plan
                                                    </div>
                                                    <div class="tk-basic-sans fw-normal font32 leading22 space-0_32 text-0F0F0F dmb-30">
                                                        <span class="tk-basic-sans fw-normal font14 leading22 space-0_14 text-808080">{{ $PlanView->yearly_price }}/year</span>
                                                    </div>

                                                    <a href="{{ route('subscriptions.show', $PlanView->id) }}">
                                                        <button class="btnB blue-btn border-0 radius7 w-100 dmb-15">Select this plan</button>
                                                    </a>

                                                    <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black dmb-20">
                                                        What’s included:
                                                    </div>
                                                    <div class="tk-basic-sans fw-normal font12 leading22 space-0_12 text-808080 d-flex align-items-start dmb-20">
                                                        <img src="{{ asset('images/tick.svg') }}" class="correct-arrow mt-2 me-2" alt="tick">{{ $PlanView->description }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Modal --}}
                            <div class="modal fade" id="addPlansModal" tabindex="-1" aria-labelledby="addPlansModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addPlansModalLabel">Add New Plan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('subscriptions.store') }}" method="POST">
                                                @csrf

                                                <div class="mb-3">
                                                    <x-text-input type="text" id="name" name="name" placeholder="Plan Name…" autofocus autocomplete="name" required />
                                                    <x-input-error :message="$errors->first('name')" />
                                                </div>

                                                <div class="mb-3">
                                                    <x-text-input type="text" id="title" name="title" placeholder="Plan Title" autofocus autocomplete="title" />
                                                    <x-input-error :message="$errors->first('title')" />
                                                </div>

                                                <div class="mb-3">
                                                    <x-text-input type="number" id="yearly_price" name="yearly_price" placeholder="Yearly Price" autocomplete="yearly_price" required />
                                                    <x-input-error :message="$errors->first('yearly_price')" />
                                                </div>

                                                <div class="mb-3">
                                                    <x-text-input type="number" id="monthly_price" name="monthly_price" placeholder="Monthly Price" autocomplete="monthly_price" required />
                                                    <x-input-error :message="$errors->first('monthly_price')" />
                                                </div>

                                                <div class="mb-3">
                                                    <select name="currency" id="currency" class="form-control" required>
                                                        <option value="">Select currency</option>
                                                        <option value="USD">USD - United States Dollar</option>
                                                        <option value="EUR">EUR - Euro</option>
                                                        <option value="GBP">GBP - British Pound</option>
                                                        <option value="INR">INR - Indian Rupee</option>
                                                        <option value="JPY">JPY - Japanese Yen</option>
                                                        <option value="AUD">AUD - Australian Dollar</option>
                                                    </select>
                                                    <x-input-error :message="$errors->first('currency')" />
                                                </div>

                                                <div class="mb-3">
                                                    <x-text-input type="text" id="description" name="description" placeholder="Description" autocomplete="description" />
                                                    <x-input-error :message="$errors->first('description')" />
                                                </div>

                                                <button type="submit" class="btn btn-primary">Create Plan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-specific-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const monthlyTab = document.getElementById('monthly-tab');
            const yearlyTab = document.getElementById('yearly-tab');
            const monthlyPlans = document.getElementById('monthly');
            const yearlyPlans = document.getElementById('yearly');

            monthlyTab.addEventListener('click', function () {
                monthlyPlans.classList.add('show', 'active');
                yearlyPlans.classList.remove('show', 'active');
            });

            yearlyTab.addEventListener('click', function () {
                yearlyPlans.classList.add('show', 'active');
                monthlyPlans.classList.remove('show', 'active');
            });
        });


    </script>
@endpush
