@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="title d-flex align-items-center dmb-25">
        <div class="title-icon bg-white radius7 d-flex align-items-center justify-content-center">
            <img src="{{ asset('images/file-maneger.svg') }}" alt="">
        </div>
        <div class="tk-basic-sans font22 leading22 space-0_22 text-0F0F0F fw-normal ms-3">
            File manager
        </div>
    </div>
    <div class="col-11">
        <form class="row row8 form-row" id="documentCreationForm" action="{{ route('documents.store') }}" method="post">
            @csrf
            <div class="col-6 dmt-15">
                <x-text-input class="white-b-input" type="text" name="name" placeholder="Document name…"
                    :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :message="$errors->first('name')" />
            </div>
            <div class="col-6 dmt-15">
                <div class="manager-check-select d-inline-flex w-100">
                    <select id="js-select2" name="users[]" class="d-none" multiple
                        data-placeholder="Select Users (Please select)">
                        <option></option>
                        @foreach ($inviteUsers as $user)
                            <option value="{{ $user->id }}" @if (in_array($user->id, old('users', []))) selected @endif>
                                {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error :message="$errors->first('users')" />
            </div>
            <div class="col-12 dmt-15 dmb-25">
                <div class="w-100 file-input bg-white text-center d-flex flex-column">
                    <div class="file-menu-bar dpt-25 dpb-15">
                        <div class="d-flex align-items-center">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="file-menu-icon w-100 me-3 d-flex align-items-center">
                                        <img src="{{ asset('images/document.svg') }}" alt="" class="w-100">
                                    </div>
                                    <div class="file-menu-text tk-basic-sans font16 leading19 space-0_16 text-0F0F0F">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-end">
                                <div
                                    class="tk-basic-sans font12 leading14 space-0_12 text-0F0F0F text-decoration-underline me-5 file-preview cursor-pointer">
                                    Preview uploaded File</div>
                                <div
                                    class="tk-basic-sans font12 leading14 space-0_12 text-0F0F0F text-decoration-underline file-preview cursor-pointer file-input-remove">
                                    Remove File</div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 d-flex align-items-center justify-content-center position-relative h-100">
                        <div class="file-input-data">
                            <img src="{{ asset('images/click-here-icon.svg') }}" alt="" class="upload-icon w-100 dmb-35">
                            <input type="file" name="document" id="document" onchange="uploadFile()"
                                class="position-absolute top-0 start-0 w-100 h-100 cursor-pointer z-1">
                            <div class="w-100 tk-basic-sans font18 leading22 space-0_18 text-0F0F0F">
                                Drag file to upload or
                                <span class="d-inline-block cursor-pointer text-decoration-underline z-1 mx-1">
                                    click
                                    here </span>
                                to select
                            </div>
                        </div>
                        <div class="w-100 file-input-progress">
                            <div id="status" class="tk-basic-sans font18 leading22 space-0_18 text-0F0F0F">
                            </div>
                            <progress id="progressBar" value="0" max="100" style="width:320px;"></progress>
                            <div id="loaded_n_total" class="opacity-0 visibility-hidden"></div>
                            <div
                                class="tk-basic-sans font12 leading14 space-0_12 text-0F0F0F text-decoration-underline file-input-remove cursor-pointer">
                                Click here to cancel</div>
                        </div>
                    </div>
                </div>
                <x-input-error :message="$errors->first('document')" />
            </div>
            <div>
                <button type="submit"
                    class="d-inline-flex align-items-center justify-content-center text-decoration-none tk-basic-sans fw-normal font16 leading19 space-0_16 large-btn blue-btn2 radius7 w-100 transition">Save
                    changes</button>
            </div>
        </form>
    </div>
@endsection
@push('page-specific-scripts')
    <script>
        function _(el) {
            return document.getElementById(el);
        }

        function uploadFile() {
            var file = _("document").files[0];
            var fileName = file.name;
            var fileExtension = fileName.split('.').pop().toLowerCase();

            document.querySelector(".file-menu-text").innerHTML = fileName;

            var formdata = new FormData();
            formdata.append("document", file);
            var ajax = new XMLHttpRequest();
            ajax.upload.addEventListener("progress", progressHandler, false);
            ajax.addEventListener("load", completeHandler, false);
            ajax.addEventListener("error", errorHandler, false);
            ajax.addEventListener("abort", abortHandler, false);
            ajax.open("POST", "{{ route('upload.document') }}");

            // Add the CSRF token to the request header
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            ajax.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            ajax.send(formdata);
        }

        function progressHandler(event) {
            _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
            var percent = (event.loaded / event.total) * 100;
            _("progressBar").value = Math.round(percent);
            _("status").innerHTML = "File uploading…";
            document.querySelector(".file-input").classList.add("file-progress");
        }

        function completeHandler(event) {
            // Parse the JSON response
            var response = JSON.parse(event.target.responseText);

            if (event.target.status === 200) {
                // Display a success message
                _("status").innerHTML = response.message;
                _("progressBar").value = 0;

                // Append the filePath to the document creation form
                if (response.filePath) {
                    var filePathInput = document.createElement('input');
                    filePathInput.type = 'hidden';
                    filePathInput.name = 'uploadedFilePath';
                    filePathInput.value = response.filePath;
                    document.querySelector('#documentCreationForm').appendChild(filePathInput);
                }
                document.querySelector(".file-input").classList.remove("file-progress");
                document.querySelector(".file-input").classList.add("file-preview-active");
            } else {
                // Handle any errors returned in the response
                _("status").innerHTML = "Error: " + response.errors.document[0];
            }
        }

        function errorHandler(event) {
            _("status").innerHTML = "Upload Failed";
        }

        function abortHandler(event) {
            _("status").innerHTML = "Upload Aborted";
        }

        function removeFile() {
            _("document").value = "";
            _("progressBar").value = 0;
            _("status").innerHTML = "";
            _("loaded_n_total").innerHTML = "";
            document.querySelector(".file-menu-text").innerHTML = "";
            document.querySelector(".file-input").classList.remove("file-preview-active");
            document.querySelector(".file-input").classList.remove("file-progress");
        }

        document.querySelector('.file-preview').addEventListener('click', function(event) {
            var file = _("document").files[0];

            if (file) {
                var fileExtension = file.name.split('.').pop().toLowerCase();
                var reader = new FileReader();

                reader.onload = function(e) {
                    var fileURL = e.target.result;
                    if (['png', 'jpg', 'jpeg', 'svg'].includes(fileExtension)) {
                        var newTab = window.open();
                        newTab.document.write('<iframe src="' + fileURL +
                            '" frameborder="0" style="width:100%;height:100%;"></iframe>');
                    } else {
                        var downloadLink = document.createElement("a");
                        downloadLink.href = fileURL;
                        downloadLink.download = file.name;
                        downloadLink.click();
                    }
                };

                reader.readAsDataURL(file);
            } else {
                alert("No file selected to preview.");
            }
        });

        var fileInputRemoveElements = document.querySelectorAll('.file-input-remove');
        fileInputRemoveElements.forEach(function(element) {
            element.addEventListener('click', function(event) {
                removeFile();
            });
        });
    </script>
@endpush
