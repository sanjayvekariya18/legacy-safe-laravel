@extends('layouts.app')
@section('title', 'Document')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="pe-3">
        <div class="d-flex align-items-end justify-content-between dmb-45">
            <div class="title dmb-5">
                <div class="d-inline-flex align-items-center">
                    <div class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('images/document.svg') }}" alt="">
                    </div>
                    <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                        {{ $document->name }}
                    </div>
                </div>
                <div class="ps-5 ms-3">
                    <a href="{{ route('view.shared.document', ['document' => $document]) }}"
                        class="tk-basic-sans font12 leading22 space-0_12 text-0F0F0F fw-normal text-capitalize me-4">View
                        File</a>
                </div>
            </div>
            <div class="col-6 ps-5 d-flex justify-content-between">
                <div class="">
                    <div class="tk-basic-sans font12 leading22 space-0_12 text-0F0F0F opacity-60 fw-normal  dmb-5">
                        Owner
                    </div>
                    <div class="tk-basic-sans font18 leading22 space-0_18 text-0F0F0F fw-normal">
                        {{ $document->user->name }}
                    </div>
                </div>
                <div class="">
                    <div class="tk-basic-sans font12 leading22 space-0_12 text-0F0F0F opacity-60 fw-normal  dmb-5">
                        Shared with
                    </div>
                    <div class="tk-basic-sans font18 leading22 space-0_18 text-0F0F0F fw-normal">
                        {{ $document->sharedWithUsers->count() }} Users
                    </div>
                </div>
                <div class="">
                    <div class="tk-basic-sans font12 leading22 space-0_12 text-0F0F0F opacity-60 fw-normal  dmb-5">
                        Last Modified
                    </div>
                    <div class="tk-basic-sans font18 leading22 space-0_18 text-0F0F0F fw-normal">
                        {{ $document->updated_at->format('d-m-Y') }}
                    </div>
                </div>
            </div>
        </div>
        @livewire('mark-as-seen', ['documentId' => $document->id])
        <div class="title dmb-20">
            <div class="d-inline-flex align-items-center">
                <div class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('images/mail.svg') }}" alt="">
                </div>
                <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                    Message area
                </div>
            </div>
        </div>
        <div class="message-area bg-white radius7 dpt-30 dpb-45 dmb-25">
            <div class="d-flex dmb-20">
                <div class="col-10 tk-basic-sans font12 leading22 space-0_12 text-0F0F0F opacity-60 fw-normal">
                    Message
                </div>
                <div class="col-2 tk-basic-sans font12 leading22 space-0_12 text-0F0F0F opacity-60 fw-normal text-end">
                    Submitted
                </div>
            </div>
            @livewire('document-message', ['documentId' => $document->id])
        </div>
        <div class="d-flex align-items-center justify-content-between dpb-65">
            <a href="{{ route('dashboard') }}"
                class="back-all text-decoration-none tk-basic-sans font13 leading22 space-0_13 text-black fw-normal d-inline-flex align-items-center">
                <div class="text-black d-flex align-items-center justify-content-center radius4 me-2">
                    <img src="{{ asset('images/left-arrow.svg') }}" class="w-100" alt="">
                </div>
                Back to all
            </a>
        </div>
    </div>
@endsection
