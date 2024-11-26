<div>
    <div
        class="user-permission-edit-post radius5 d-flex align-items-center px-3 dmb-20 tk-basic-sans font16 leading24 space-0_16 text-black bg-white dpt-20 dpb-20">
        {{ $role->name }}
    </div>
    <form wire:submit.prevent="updatePermissions">
        <div class="pe-5 dmb-35">
            <div class="tk-basic-sans fw-normal font13 leading19 space-0_13 text-black dmb-15">
                Select access</div>
            <div class="row">
                @foreach ($permissions as $key => $permission)
                    <div class="col-4 dmb-15">
                        <div
                            class="checkbox-container position-relative  d-inline-flex align-items-center tk-basic-sans fw-normal font16 leading29 space-0_16 text-black">
                            <input type="checkbox" wire:model="selectedPermissions" value="{{ $permission->id }}" class="opacity-0 position-absolute top-0 start-0">
                            <span class="check-box black-checkbox radius5 position-relative me-3"></span>
                            {{ $permission->name }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-end align-items-center dmb-60">
            <button type="submit" wire:loading.attr="disabled" wire:target="updatePermissions"
                class="btnB blue-btn radius7 border-0 transition tk-basic-sans font16 leading19 space-0_16 text-808080">
                <span wire:loading.remove wire:target="updatePermissions">Save Changes</span>
                <span wire:loading wire:target="updatePermissions">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </span>
            </button>
        </div>
    </form>
</div>
