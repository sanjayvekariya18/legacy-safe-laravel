@if(session('success'))
<div id="alertMessage" class="alert alert-success alert-dismissible fade show mx-auto" role="alert" style="width: 50%;">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mx-auto" role="alert" style="width: 50%;">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
