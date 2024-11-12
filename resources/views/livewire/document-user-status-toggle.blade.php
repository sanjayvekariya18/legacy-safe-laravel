<div>
    <table class="table common-table ready-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Permissions</th>
                <th>To be notified</th>
                <th>File Visibility</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($document->sharedWithProfessionalUsers as $professionalUser)
                <tr>
                    <td>{{ $professionalUser->user->name }}</td>
                    <td>{{ $professionalUser->user->company_name }}</td>
                    <td>{{ implode(',', $professionalUser->user->getRoleNames()->toArray()) }}</td>
                    <td>
                        <div class="d-inline-flex align-items-center position-relative switch-container">
                            <div class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                Yes
                            </div>
                            <input type="radio" name="to_be_notified"
                                {{ $professionalUser->to_be_notified ? 'checked' : '' }}
                                wire:click="toBeNotifiedToggleStatus({{ $professionalUser->id }})"
                                class="position-absolute top-0 start-0 h-100 w-50 cursor-pointer opacity-0 z-5 input" />
                            <input type="radio" {{ !$professionalUser->to_be_notified ? 'checked' : '' }}
                                name="to_be_notified" wire:click="toBeNotifiedToggleStatus({{ $professionalUser->id }})"
                                class="position-absolute top-0 end-0 h-100 w-50 cursor-pointer opacity-0 z-5 input2" />
                            <label class="switch me-2 transition"></label>
                            <div class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                No
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <div class="d-inline-flex align-items-center position-relative switch-container">
                                <div class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                    Yes
                                </div>
                                <input type="radio" name="to_be_visible"
                                    {{ $professionalUser->to_be_visible ? 'checked' : '' }}
                                    wire:click="toBeVisibleToggleStatus({{ $professionalUser->id }})"
                                    class="position-absolute top-0 start-0 h-100 w-50 cursor-pointer opacity-0 z-5 input">
                                <input type="radio" name="to_be_visible"
                                    {{ !$professionalUser->to_be_visible ? 'checked' : '' }}
                                    wire:click="toBeVisibleToggleStatus({{ $professionalUser->id }})"
                                    class="position-absolute top-0 end-0 h-100 w-50 cursor-pointer opacity-0 z-5 input2">
                                <label class="switch me-2 transition"></label>
                                <div class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal me-2">
                                    No
                                </div>
                            </div>
                            <a href="javascript:void(0);" wire:click="selectUser({{ $professionalUser->id }}, '{{ e($professionalUser->user->name) }}')"
                                class="text-decoration-none d-inline-flex text-decoration-none">
                                <img src="{{ asset('images/three-dot-menu.svg') }}" class="three-dot" alt="" />
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <td colspan="5" class="text-center">No User found.</td>
            @endforelse
        </tbody>
    </table>

    <div class="modal fade user-modal" id="userModal" tabindex="-1" role="dialog" aria-bs-labelledby="userModalLabel"
        aria-bs-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content radius4">
                <ul class="list-none ps-0 mb-0">
                    <li class="dmb-15">
                        <a href="javascript:void(0);"
                            class="d-inline-block text-decoration-none tk-basic-sans font14 leading22 space-0_14 text-black fw-normal">View
                            User</a>
                    </li>
                    <li class="dmb-15">
                        <a href="javascript:void(0);" wire:click="openRemoveUserModal()"
                            class="d-inline-block text-decoration-none tk-basic-sans font14 leading22 space-0_14 text-black fw-normal">
                            Remove User</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- remove-user-modal -->
    <div class="modal remove-user-modal fade" id="remove-user" data-bs-backdrop="static" data-bs-keyboard="false"
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
                    <div
                        class="tk-basic-sans font26 leading30 space-0_26 text-0F0F0F text-center dmb-25 col-9 px-2 mx-auto">
                        Are you sure you want to remove {{ $selectedUserName }}
                    </div>
                    <div class="d-flex align-items-center row6">
                        <div class="col-6">
                            <button type="button" wire:click="removeSharedUser()"
                                class="large-btn blue-btn2 w-100 d-inline-flex align-items-center justify-content-center tk-basic-sans fw-normal font16 leading19 space-0_16 radius7 transition" data-bs-dismiss="modal" aria-label="Close">Yes,
                                remove</button>
                        </div>
                        <div class="col-6">
                            <button type="button"
                                class="large-btn btn-808080 w-100 d-inline-flex align-items-center justify-content-center tk-basic-sans fw-normal font16 leading19 space-0_16 radius7 transition"
                                data-bs-dismiss="modal" aria-label="Close">No, keep user</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
