@extends('layouts.app')
@section('title', 'Document')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div id="notified" class="alert alert-success" style="display: none">
        Professional Notified
    </div>
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
                    <a href="{{ route('view.document', ['document' => $document]) }}"
                        class="tk-basic-sans font12 leading22 space-0_12 text-0F0F0F fw-normal text-capitalize me-4">
                        View File
                    </a>
                    @can('removeDocument', $document)
                        <a href="{{ route('remove.document', ['document' => $document]) }}"
                            class="tk-basic-sans font12 leading22 space-0_12 text-0F0F0F fw-normal text-capitalize me-4">
                            Remove File
                        </a>
                    @endcan
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
        @can('removeDocument', $document)
        <div class="accordion-section bg-white radius7 dmb-45">
            <div class="accordion-item">
                <div class="accordion-header d-flex justify-content-between px-4 py-3">
                    <div class="tk-basic-sans font18 leading22 space-0_18 text-0F0F0F fw-normal">
                        Ready to send the file for approval?
                    </div>
                    <div class="accordion-header-btn transition">
                        @livewire('notify-professional', ['documentId' => $document->id])
                    </div>
                    <div class="close-arrow bg-224598 overflow-hidden rounded-circle cursor-pointer">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <img src="{{ asset('images/white-close.svg') }}" class="" alt="">
                        </div>
                    </div>
                </div>
                <div class="accordion-content dpt-50 dpb-35 px-4">
                    @livewire('document-user-status-toggle', ['documentId' => $document->id])
                </div>
            </div>
        </div>
        @endcan
        <div class="title dmb-20">
            <div class="d-inline-flex align-items-center">
                <div class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('images/post-icon.svg') }}" alt="">
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
            <a href="{{ route('documents.index') }}"
                class="back-all text-decoration-none tk-basic-sans font13 leading22 space-0_13 text-black fw-normal d-inline-flex align-items-center">
                <div class="text-black d-flex align-items-center justify-content-center radius4 me-2">
                    <img src="{{ asset('images/left-arrow.svg') }}" class="w-100" alt="">
                </div>
                Back to all
            </a>
            <a href="{{ route('documents.create') }}"
                class="text-decoration-none large-btn blue-btn tk-basic-sans font16 leading22 space-0_16 fw-normal d-inline-flex align-items-center justify-content-center px-5 radius7">
                <img src="{{ asset('images/plus-circle.svg') }}" alt="" class="me-2">
                Add new file
            </a>
        </div>
    </div>
@endsection
@push('page-specific-scripts')
    <script type="module">
        $(document).ready(function() {
            Livewire.on('openUserModal', () => {
                new bootstrap.Modal(document.getElementById('userModal'), {
                    keyboard: true
                }).show();
            });
            Livewire.on('openRemoveUserModal', (data) => {
                new bootstrap.Modal(document.getElementById('remove-user'), {
                    keyboard: false
                }).show();
            });
            Livewire.on('notified', () => {
                $('#notified').fadeIn();
                setTimeout(() => {
                    $('#notified').fadeOut();
                }, 2000);

            });
            //setting callback function for 'hidden.bs.modal' event
            $('#userModal, #remove-user').on('hidden.bs.modal', function() {
                console.log("backdrop");

                //remove the backdrop
                $('.modal-backdrop').remove();
            })
        });
    </script>
@endpush
