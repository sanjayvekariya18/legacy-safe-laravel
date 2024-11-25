<div>
    <a href="javascript:void(0);"
        class="ready-view-btn tk-basic-sans font12 leading22 space-0_12 text-0F0F0F fw-normal ms-3">
        View/Edit the recipients
    </a>
    <a href="javascript:void(0);" wire:click.prevent="notifyProfessional"   wire:loading.attr="disabled" wire:target="notifyProfessional"
        class="notify-btn text-decoration-none bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white py-2 px-4 radius5 ms-3">
        <span wire:loading.remove wire:target="notifyProfessional">Notify professional</span>
        <span wire:loading wire:target="notifyProfessional">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </span>
    </a>
</div>
