@extends('layouts.app')

@section('content')
<section class="admin bg-F5F5F5 h-vh">
    <div class="d-flex flex-wrap h-100">
        <div class="admin-wrapper h-100 overflow-auto">
            <div class="container-fluid h-100">
                <div class="ps-5 h-100 d-flex flex-column">
                    <div>
                        <div class="title d-flex align-items-center dmb-25">
                            <div class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/file.svg') }}" alt="file icon">
                            </div>
                            <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                                File manager
                            </div>
                        </div>

                        <div class="col-11">

                            <div>
                                <form wire:submit.prevent="saveFile" class="row row8 form-row dmb-25"
                                    enctype="multipart/form-data">
                                    <!-- Name field -->
                                    <div class="col-12 dmt-15">
                                        <x-text-input type="text" name="name" wire:model="name"
                                            placeholder="Enter document title…"
                                            class="input white-b-input tk-basic-sans font16 leading19 w-100 bg-white" />
                                        <x-input-error :message="$errors->first('name')" />
                                    </div>

                                    <!-- User selection -->
                                    <div class="col-6 dmt-15">
                                        <div class="manager-check-select d-inline-flex w-100">
                                            <select wire:model="user_id" name="user_id" class="js-select2 d-none"
                                                data-placeholder="Choose User (Please select)">
                                                <option></option>
                                                @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->invitedBy->name ?? 'No Inviter' }} - {{ $user->email ??
                                                    'No Email' }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- File upload -->
                                    <div class="col-12 dmt-15">
                                        <div class="w-100 file-input bg-white text-center d-flex flex-column">
                                            <div class="file-menu-bar dpt-25 dpb-15">
                                                <div class="d-flex align-items-center">
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <div
                                                                class="file-menu-icon w-100 me-3 d-flex align-items-center">
                                                                <img src="{{ asset('images/document.svg') }}"
                                                                    alt="document icon" class="w-100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 d-flex align-items-center justify-content-end">
                                                        <div
                                                            class="tk-basic-sans font12 leading14 space-0_12 text-0F0F0F text-decoration-underline me-5 file-preview cursor-pointer">
                                                            Preview uploaded File
                                                        </div>
                                                        <div
                                                            class="tk-basic-sans font12 leading14 space-0_12 text-0F0F0F text-decoration-underline file-preview cursor-pointer file-input-remove">
                                                            Remove File
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- File input area -->
                                            <div
                                                class="w-100 d-flex align-items-center justify-content-center position-relative h-100">
                                                <div x-data="fileUpload()" class="file-input-data">
                                                    <img src="{{ asset('images/upload.svg') }}" alt="upload icon"
                                                        class="upload-icon w-100 dmb-35">
                                                    <input type="file" id="file-upload" name="url" wire:model="url"
                                                        class="position-absolute top-0 start-0 w-100 h-100 cursor-pointer z-1"
                                                        for="file-upload" />


                                                    <div class="flex flex-col items-center justify-center h-screen bg-slate-200"
                                                        x-on:drop="isDroppingFile = false"
                                                        x-on:drop.prevent="handleFileDrop($event)"
                                                        x-on:dragover.prevent="isDroppingFile = true"
                                                        x-on:dragleave.prevent="isDroppingFile = false">


                                                        <div class="absolute top-0 bottom-0 left-0 right-0 z-30 flex items-center justify-center bg-blue-500 opacity-90"
                                                            x-show="isDropping">

                                                            <div
                                                                class="w-100 tk-basic-sans font18 leading22 space-0_18 text-0F0F0F">
                                                                Drag a file to upload or
                                                                <span
                                                                    class="d-inline-block cursor-pointer text-decoration-underline z-1 mx-1">
                                                                    click here
                                                                </span> to select
                                                            </div>
                                                        </div>

                                                        <div class="bg-blue-500 h-[2px]" style="transition: width 1s"
                                                            :style="`width: ${progress}%;`" x-show="isUploading">

                                                            <x-input-error :message="$errors->first('url')" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Submit button -->
                                                <div>
                                                    <button type="submit"
                                                        class="d-inline-flex align-items-center justify-content-center text-decoration-none tk-basic-sans fw-normal font16 leading19 space-0_16 large-btn blue-btn2 radius7 w-100 transition">
                                                        Save Document
                                                    </button>
                                                </div>
                                </form>
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
    console.log('hry');
    
    function fileUpload() {
        return {
            isDropping: false,
            isUploading: false,
            progress: 0,
            handleFileSelect(event) {
                if (event.target.files.length) {
                    this.uploadFiles(event.target.files)
                }
            },
            handleFileDrop(event) {
                if (event.dataTransfer.files.length > 0) {
                    this.uploadFiles(event.dataTransfer.files)
                }
            },
            uploadFiles(files) {
                const $this = this;
                this.isUploading = true
                @this.uploadMultiple('files', files,
                    function (success) {
                        $this.isUploading = false
                        $this.progress = 0
                    },
                    function(error) {
                        console.log('error', error)
                    },
                    function (event) {
                        $this.progress = event.detail.progress
                    }
                )
            },
            removeUpload(filename) { 
                @this.removeUpload('files', filename)
            }, 
        }
    }
</script>
@endpush

