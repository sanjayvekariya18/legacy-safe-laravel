<div>
    @foreach ($chats as $chat)
        <div class="d-inline-flex dmb-45 w-100">
            <div class="col-10">
                <div class="col-11 pe-4">
                    <div class="d-inline-flex w-100">
                        <div
                            class="alphbet-icon bg-224598 tk-basic-sans font16 leading22 space-0_16 text-white text-uppercase fw-normal d-inline-flex align-items-center justify-content-center rounded-circle">
                            {{ substr($chat->user->first_name, 0, 1) }}
                        </div>
                        <div>
                            <div class="tk-basic-sans font16 leading22 space-0_16 text-black fw-normal dmb-15">
                                {{ $chat->user->first_name }} -
                                {{ $chat->user_id == $chat->document->user->id ? 'Account holder' : $chat->user->professional_type }}
                            </div>
                            <div class="tk-basic-sans font16 leading22 space-0_16 text-808080 fw-normal">
                                {{ $chat->message }}
                                @if ($chat->file)
                                    @php
                                        // Generate signed URL for private file
                                        $fileUrl = Storage::disk('s3')->temporaryUrl($chat->file, now()->addMinutes(5));
                                    @endphp
                                    <a href="{{ $fileUrl }}" download="" target="_blank">View Attachment</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2 tk-basic-sans font12 leading22 space-0_12 text-black fw-normal text-end">
                {{ $chat->created_at->format('d-m-Y') }}
            </div>
        </div>
    @endforeach
    <form wire:submit.prevent="sendMessage">
        <div class="textarea-input">
            <div class="dmb-20">
                <textarea wire:model="message" placeholder="Write your message…"
                    class="tk-basic-sans font16 leading22 space-0_16 text-808080 fw-normal w-100 radius5 px-3 py-3"></textarea>
                <x-input-error :message="$errors->first('message')" />
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <div class="message-files">
                    <!-- Display the uploaded file name -->
                    <span class="tk-basic-sans font13 leading22 space-0_13 text-black fw-normal me-3">
                        {{ $file ? $file->getClientOriginalName() : 'Select a file to upload' }}
                    </span>
                    <span wire:loading.remove wire:target="file">
                        <button class="bg-transparent tk-basic-sans font12 leading22 space-0_12 text-black fw-normal px-4 position-relative">
                        Browse files
                        <input type="file" wire:model="file"
                            class="position-absolute start-0 w-100 h-100 top-0 opacity-0">
                        </button>
                    </span>
                    <span wire:loading wire:target="file">
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </span>
                    <x-input-error :message="$errors->first('file')" />
                </div>
                <div>
                    <button type="submit" wire:loading.attr="disabled" wire:target="sendMessage"
                        class="text-decoration-none bg-224598 tk-basic-sans font14 leading14 space-0_14 text-white dpt-10 dpb-10 px-4 radius5 ms-3">
                        <span wire:loading.remove wire:target="sendMessage">Submit Message</span>
                        <span wire:loading wire:target="sendMessage">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
