<div>
    <section class="admin bg-F5F5F5 h-vh">
        <div class="d-flex flex-wrap h-100">
            <div class="admin-wrapper h-100 overflow-auto">
                <div class="container-fluid h-100">
                    <div class="ps-5 h-100 d-flex flex-column">
                        <div>
                            <div class="title d-flex align-items-center dmb-25">
                                <div
                                    class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('images/file.svg') }}" alt="file icon">
                                </div>
                                <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
                                    File manager
                                </div>
                            </div>


                            <div class="col-11">

                                @if (session()->has('error'))
                                    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                                @endif

                                <form class="row row8 form-row dmb-25">
                                    <div class="col-12 dmt-15">
                                        <input type="text" wire:model="name" name="name"
                                            placeholder="Enter document title…"
                                            class="input white-b-input tk-basic-sans font16 leading19 w-100 bg-white" />

                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6 dmt-15">
                                        <div class="manager-check-select d-inline-flex w-100">
                                            <select wire:model="user_id">
                                                <option></option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">
                                                        {{ $user->name ?? 'No Inviter' }}
                                                        {{ $user->email ?? 'No Email' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @error('user_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

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
                                                </div>
                                            </div>

                                            <div
                                                class="w-100 d-flex align-items-center justify-content-center position-relative h-100">


                                                <div class="file-input-data">

                                                    <div x-data="{ isUploading: false, progress: 0 }"
                                                        x-on:livewire-upload-start="isUploading = true"
                                                        x-on:livewire-upload-finish="isUploading = false"
                                                        x-on:livewire-upload-error="isUploading = false"
                                                        x-on:livewire-upload-progress="progress = $event.detail.progress">


                                                        <img src="{{ asset('images/upload.svg') }}" alt="upload icon"
                                                            class="upload-icon w-100 dmb-35">

                                                        <input type="file" wire:model="url" name="url" multiple
                                                            onchange="handleImagePreview(event)"
                                                            class="position-absolute top-0 start-0 w-100 h-100 cursor-pointer z-1 file-input" />


                                                        <div x-show="isUploading">
                                                            <progress max="100"
                                                                x-bind:value="progress"></progress>
                                                        </div>

                                                        <div
                                                            class="w-100 tk-basic-sans font18 leading22 space-0_18 text-0F0F0F">
                                                            Drag a file to upload or
                                                            <span
                                                                class="d-inline-block cursor-pointer text-decoration-underline z-1 mx-1">
                                                                click here
                                                            </span> to select
                                                        </div>

                                                        @error('url')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>



                                            <div id="image-preview" class="mt-3" style="display: none;">
                                                <img id="preview-image" src="" alt="Image Preview"
                                                    class="img-fluid" />
                                                <button type="button" class="btn btn-danger"
                                                    onclick="removeImagePreview()"> Remove Preview</button>
                                            </div>


                                        </div>

                                        <div>
                                            <button type="submit" wire:click="submitForm"
                                                class="d-inline-flex align-items-center justify-content-center text-decoration-none tk-basic-sans fw-normal font16 leading19 space-0_16 large-btn blue-btn2 radius7 w-100 transition">
                                                Save Document
                                            </button>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


@push('page-specific-scripts')
    <script>
        console.log('hry');

        // function fileUpload() {
        //     return {
        //         isDropping: false,
        //         isUploading: false,
        //         progress: 0,
        //         handleFileSelect(event) {
        //             if (event.target.files.length) {
        //                 this.uploadFiles(event.target.files)
        //             }
        //         },
        //         handleFileDrop(event) {
        //             if (event.dataTransfer.files.length > 0) {
        //                 this.uploadFiles(event.dataTransfer.files)
        //             }
        //         },
        //         uploadFiles(files) {
        //             const $this = this;
        //             this.isUploading = true
        //             @this.uploadMultiple('files', files,
        //                 function (success) {
        //                     $this.isUploading = false
        //                     $this.progress = 0
        //                 },
        //                 function(error) {
        //                     console.log('error', error)
        //                 },
        //                 function (event) {
        //                     $this.progress = event.detail.progress
        //                 }
        //             )
        //         },
        //         removeUpload(filename) {
        //             @this.removeUpload('files', filename)
        //         },
        //     }
        // }

        function handleImagePreview(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image-preview');
            const previewImage = document.getElementById('preview-image');


            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        function removeImagePreview() {
            const preview = document.getElementById('image-preview');
            const inputFile = document.querySelector('input[type="file"]');
            preview.style.display = 'none';
            inputFile.value = '';
        }
    </script>
@endpush
