<div>
    <div class="accordion-section bg-white radius7 dmb-45">
        <div class="accordion-item">
            <div
                class="accordion-header d-flex justify-content-between px-4 py-3">
                <div
                    class="tk-basic-sans font18 leading22 space-0_18 text-0F0F0F fw-normal">
                    Are your happy to review the file?
                </div>
                <div class="transition">
                    @if ($markAsSeen)
                        <a href="javascript:void(0);"
                        class="notify-btn text-decoration-none bg-DEDEDE tk-basic-sans font14 leading14 space-0_14 text-808080 py-2 px-5 radius5 ms-3 cursor-not-allowed">Mark as seen</a>
                    @else
                        <a href="#mark-as-seen" data-bs-toggle="modal" data-bs-target="#mark-as-seen"
                        class="notify-btn text-decoration-none bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-5 radius5 ms-3 bg-224598-btn">Mark as seen</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- remove-user-modal -->
    <div class="modal remove-user-modal fade" id="mark-as-seen" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="mark-as-seenLabel" aria-hidden="true">
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
                    <div class="tk-basic-sans font26 leading30 space-0_26 text-0F0F0F text-center dmb-25 col-11 px-2 mx-auto">
                        Are you sure you want confirm sight of notification
                    </div>
                    <div class="d-flex align-items-center row6">
                        <div class="col-6">
                            <button type="button" wire:click="markAsSeenUpdate()" data-bs-dismiss="modal" aria-label="Close"
                                class="large-btn blue-btn2 w-100 d-inline-flex align-items-center justify-content-center tk-basic-sans fw-normal font16 leading19 space-0_16 radius7 transition">Yes, confirm</button>
                        </div>
                        <div class="col-6">
                            <button
                                class="large-btn btn-808080 w-100 d-inline-flex align-items-center justify-content-center tk-basic-sans fw-normal font16 leading19 space-0_16 radius7 transition"
                                data-bs-dismiss="modal" aria-label="Close">No, go back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
